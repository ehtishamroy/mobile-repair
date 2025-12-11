@extends('frontend.layouts.app')

@section('title', 'Book Repair')

@section('content')
    @php
        $settings = \App\Models\Setting::first();
        $currencySymbol = $settings->currency_symbol ?? '£';
    @endphp

    @if(!$service)
        <div class="container my-5">
            <div class="alert alert-warning text-center">
                <p>Please select a service from the <a href="{{ route('frontend.book-repair') }}">Book Repair</a> page.</p>
            </div>
        </div>
    @else
        <div class="container my-5">
            <!-- Stepper -->
            <div id="stepper"
                class="stepper d-flex justify-content-between align-items-center position-relative mb-5 overflow-auto">
                <div class="step active">
                    <div class="circle">1</div>
                    <div class="label">Information</div>
                </div>
                <div class="step">
                    <div class="circle">2</div>
                    <div class="label">Delivery Method</div>
                </div>
                <div class="step">
                    <div class="circle">3</div>
                    <div class="label">Process Info</div>
                </div>
                <div class="step">
                    <div class="circle">4</div>
                    <div class="label">Confirm Details</div>
                </div>
                <div class="step">
                    <div class="circle">5</div>
                    <div class="label">Payment</div>
                </div>
            </div>

            <!-- Step Content -->
            <form id="repairForm" action="{{ route('frontend.repair.process') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                @php
                    $deviceTypeIdValue = request()->get('device_type_id');
                    if ($deviceTypeIdValue === 'other') {
                        $deviceTypeIdValue = 'other';
                    } else {
                        $deviceTypeIdValue = $deviceType->id ?? '';
                    }
                @endphp
                <input type="hidden" name="device_type_id" id="device_type_id" value="{{ $deviceTypeIdValue }}">
                <input type="hidden" name="device_type" id="device_type"
                    value="{{ $deviceType ? $deviceType->name : 'Other' }}">
                <input type="hidden" name="delivery_method" id="delivery_method" value="">
                <input type="hidden" name="payment_method" value="stripe">

                <div id="form-steps">
                    <!-- Step 1: Information -->
                    <div class="step-content active">
                        <h1 class="text-center my-4">Let's get started!</h1>
                        <div class="row mt-3 gy-5">
                            <div class="col-md-6 col-12">
                                <div class="">
                                    <label class="form-label" for="customer_name">Your name <span
                                            class="text-danger">*</span></label>
                                    <input id="customer_name" name="customer_name" type="text" placeholder="Full name"
                                        class="custom-input" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="">
                                    <label class="form-label" for="customer_email">Your email address <span
                                            class="text-danger">*</span></label>
                                    <input id="customer_email" name="customer_email" type="email" placeholder="Email address"
                                        class="custom-input" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="">
                                    <label class="form-label" for="customer_phone">Your phone number <span
                                            class="text-danger">*</span></label>
                                    <input id="customer_phone" name="customer_phone" type="tel" placeholder="Phone number"
                                        class="custom-input" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="">
                                    <label class="form-label" for="device_model">Model of device <span
                                            class="text-danger">*</span></label>
                                    @if($deviceType && $deviceType->id)
                                        <input type="text" class="custom-input" id="device_model" name="device_model"
                                            value="{{ $deviceType->name }}" readonly>
                                    @else
                                        @php
                                            $isOtherSelected = request()->get('device_type_id') === 'other';
                                        @endphp
                                        <select class="custom-select" id="device_model_select" name="device_model" required>
                                            <option value="">Please select</option>
                                            @foreach($service->deviceTypes as $dt)
                                                <option value="{{ $dt->name }}" {{ $deviceType && $deviceType->id == $dt->id ? 'selected' : '' }}>{{ $dt->name }}</option>
                                            @endforeach
                                            <option value="other" {{ $isOtherSelected ? 'selected' : '' }}>Other (Please specify)
                                            </option>
                                        </select>
                                        <input type="text" class="custom-input mt-2" id="device_model_custom" name="device_model"
                                            placeholder="Enter device model"
                                            style="display: {{ $isOtherSelected ? 'block' : 'none' }};" {{ $isOtherSelected ? 'required' : '' }}>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="device-issues mt-4">
                                    <label class="form-label">Device Issue <span class="text-danger">*</span></label>
                                    <div class="d-flex flex-wrap gap-3">
                                        @foreach($service->issues as $issue)
                                            <div class="form-check custom-check">
                                                <input class="form-check-input issue-checkbox" type="checkbox" name="issues[]"
                                                    id="issue_{{ $issue->id }}" value="{{ $issue->id }}">
                                                <label class="form-check-label"
                                                    for="issue_{{ $issue->id }}">{{ $issue->name }}</label>
                                            </div>
                                        @endforeach
                                        <div class="form-check custom-check">
                                            <input class="form-check-input" type="checkbox" id="issue_unknown"
                                                name="issue_unknown">
                                            <label class="form-check-label" for="issue_unknown">I don't know the issue</label>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-2">If you don't know the issue, we'll charge an
                                        inspection fee.</small>
                                </div>

                                <!-- Quality Tier Selection (shown dynamically) -->
                                <!-- Quality Tier Selection (shown dynamically) -->
                                <div id="quality-tier-selection" class="mt-4 p-4 rounded border"
                                    style="display: none; background-color: #f8f9fa; border-color: #e9ecef !important;">
                                    <label class="form-label fs-18 fw-bold mb-3">Select Quality/Part Type <span
                                            class="text-danger">*</span></label>
                                    <div id="quality-tier-options" class="d-flex flex-column gap-3">
                                        <!-- Tiers will be loaded dynamically -->
                                    </div>
                                    <input type="hidden" name="quality_tier_id" id="selected_tier_id">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label class="form-label" for="issue_description">Describe your issue</label>
                                    <textarea class="custom-input" name="issue_description" id="issue_description" cols="30"
                                        rows="5" placeholder="Additional comments here...."></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="pricing-preview" class="alert alert-info" style="display: none;">
                                    <strong>Estimated Cost:</strong>
                                    <div id="pricing-breakdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Delivery Method Selection -->
                    <div class="step-content">
                        <h1 class="text-sm-center my-4 mb-5" id="delivery-step-title">How would you like to proceed?</h1>

                        <!-- Normal delivery options (shown when cost > 0) -->
                        <div class="row" id="normal-delivery-options">
                            <div class="col-md-6 mb-3">
                                <div class="py-5 px-4 flex-center flex-column gap-3 border delivery-option-item shadow-sm"
                                    data-delivery="visit"
                                    style="cursor: pointer; border-radius: 12px; min-height: 240px; transition: all 0.3s; background-color: #fff;">
                                    <i class="fas fa-store text-primary-custom" style="font-size: 3.5rem;"></i>
                                    <div class="text-center">
                                        <label class="form-label fw-bold w-100 text-center mb-1 cursor-pointer"
                                            style="font-size: 1.4rem;">Visit Us</label>
                                        <p class="text-center text-muted mb-0 fs-16">Pay when you visit our store</p>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" name="delivery_method" value="visit" id="delivery_visit"
                                            class="form-check-input" style="width: 1.5em; height: 1.5em; cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="py-5 px-4 flex-center flex-column gap-3 border delivery-option-item shadow-sm"
                                    data-delivery="online"
                                    style="cursor: pointer; border-radius: 12px; min-height: 240px; transition: all 0.3s; background-color: #fff;">
                                    <i class="fas fa-shipping-fast text-primary-custom" style="font-size: 3.5rem;"></i>
                                    <div class="text-center">
                                        <label class="form-label fw-bold w-100 text-center mb-1 cursor-pointer"
                                            style="font-size: 1.4rem;">Online Delivery</label>
                                        <p class="text-center text-muted mb-0 fs-16">Pay online for delivery</p>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="radio" name="delivery_method" value="online" id="delivery_online"
                                            class="form-check-input" style="width: 1.5em; height: 1.5em; cursor: pointer;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Appointment Scheduling (shown when Visit Us is selected) -->
                        <div class="row justify-content-center mt-4" id="appointment-fields" style="display: none;">
                            <div class="col-md-8">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-body p-4">
                                        <h5 class="card-title mb-4 text-center">
                                            <i class="fas fa-calendar-alt text-primary mr-2"></i>
                                            Select Your Appointment
                                        </h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="appointment_date" class="form-label">
                                                    Preferred Date <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="custom-input" id="appointment_date"
                                                    name="appointment_date">
                                                <small class="text-muted">Select a date within the next 30 days</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="appointment_time" class="form-label">
                                                    Preferred Time <span class="text-danger">*</span>
                                                </label>
                                                <select class="custom-input" id="appointment_time" name="appointment_time">
                                                    <option value="">Select a time slot</option>
                                                    <option value="09:00:00">9:00 AM - 12:00 PM</option>
                                                    <option value="12:00:00">12:00 PM - 3:00 PM</option>
                                                    <option value="15:00:00">3:00 PM - 6:00 PM</option>
                                                </select>
                                                <small class="text-muted">Choose your preferred time slot</small>
                                            </div>
                                        </div>
                                        <div class="alert alert-info mb-0 mt-2">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <small>Please arrive within your selected time slot. We'll confirm your appointment
                                                via email.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Zero-cost visit option (shown when cost = 0) -->
                        <div id="zero-cost-visit-option" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="alert alert-info text-center mb-4">
                                        <i class="fas fa-info-circle"></i> We need to inspect your device to provide an accurate
                                        quote. Please visit our store.
                                    </div>
                                    <div class="card border-primary">
                                        <div class="card-body text-center p-4">
                                            <i class="fas fa-store mb-3" style="font-size: 3rem; color: #684471;"></i>
                                            <h4 class="mb-3">Visit Our Store</h4>
                                            <div class="text-left" style="max-width: 500px; margin: 0 auto;">
                                                <p class="mb-2"><i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                                    <strong>Address:</strong>
                                                </p>
                                                <p class="ml-4 mb-3">Unit-2, 260 Streatfield Road<br>Harrow, London<br>United
                                                    Kingdom, HA3 9BY</p>

                                                <p class="mb-2"><i class="fas fa-phone text-primary mr-2"></i>
                                                    <strong>Phone:</strong>
                                                </p>
                                                <p class="ml-4 mb-3"><a href="tel:+447503683786">+44 7503 683786</a></p>

                                                <p class="mb-2"><i class="fas fa-envelope text-primary mr-2"></i>
                                                    <strong>Email:</strong>
                                                </p>
                                                <p class="ml-4 mb-0"><a
                                                        href="mailto:harrowmobiles@gmail.com">harrowmobiles@gmail.com</a></p>
                                            </div>
                                            <input type="radio" name="delivery_method" value="visit" id="delivery_visit_zero"
                                                checked style="display: none;">
                                        </div>
                                    </div>

                                    <!-- Appointment Scheduling for Zero-Cost Quote -->
                                    <div class="card border-primary shadow-sm mt-4">
                                        <div class="card-body p-4">
                                            <h5 class="card-title mb-4 text-center">
                                                <i class="fas fa-calendar-alt text-primary mr-2"></i>
                                                Schedule Your Visit
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="appointment_date_zero" class="form-label">
                                                        Preferred Date <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="date" class="custom-input" id="appointment_date_zero"
                                                        name="appointment_date" required>
                                                    <small class="text-muted">Select a date within the next 30 days</small>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="appointment_time_zero" class="form-label">
                                                        Preferred Time <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="custom-input" id="appointment_time_zero"
                                                        name="appointment_time" required>
                                                        <option value="">Select a time slot</option>
                                                        <option value="09:00:00">9:00 AM - 12:00 PM</option>
                                                        <option value="12:00:00">12:00 PM - 3:00 PM</option>
                                                        <option value="15:00:00">3:00 PM - 6:00 PM</option>
                                                    </select>
                                                    <small class="text-muted">Choose your preferred time slot</small>
                                                </div>
                                            </div>
                                            <div class="alert alert-info mb-0 mt-2">
                                                <i class="fas fa-info-circle mr-2"></i>
                                                <small>Please arrive within your selected time slot. We'll confirm your
                                                    appointment
                                                    via email.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Mail-in Process Information -->
                    <div class="step-content">
                        <div class="d-flex flex-column gap-4">
                            <h1 class="text-center">{{ $mailInProcess->title }}</h1>
                            <p class="text-center fw-400 fs-18">{{ $mailInProcess->description }}</p>
                            <h1 class="text-center">{{ $mailInProcess->process_title }}</h1>
                            <p class="text-center fw-400 fs-18">{{ $mailInProcess->process_description }}</p>
                            <h1 class="text-center">{{ $mailInProcess->timeline_title }}</h1>
                            <p class="text-center fw-400 fs-18">{{ $mailInProcess->timeline_description }}</p>
                        </div>
                    </div>

                    <!-- Step 5: Confirm Details -->
                    <div class="step-content">
                        <h1 class="text-center mb-5 pb-3 display-4 fw-bold text-primary-custom">Please Confirm Your Details</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="section-header">Your Details</div>
                                <div class="row">
                                    <div class="col-12 section-details">
                                        <labelclass="fw-bold">Your name:</label>
                                            <p id="confirm_name"></p>
                                    </div>
                                    <div class="col-12 section-details">
                                        <label class="fw-bold">Your email:</label>
                                        <p id="confirm_email"></p>
                                    </div>
                                    <div class="col-12 section-details">
                                        <label class="fw-bold">Your phone:</label>
                                        <p id="confirm_phone"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="section-header">Device Details</div>
                                <div class="row">
                                    <div class="col-12 section-details">
                                        <label class="fw-bold">Device model:</label>
                                        <p id="confirm_device"></p>
                                    </div>
                                    <div class="col-12 section-details">
                                        <label class="fw-bold">Selected Issues:</label>
                                        <p id="confirm_issues"></p>
                                    </div>
                                    <div class="col-12 section-details" id="confirm_quality_tier_row" style="display: none;">
                                        <label class="fw-bold">Quality/Part Type:</label>
                                        <p id="confirm_quality_tier"></p>
                                    </div>
                                    <div class="col-12 section-details">
                                        <label class="fw-bold">Comments:</label>
                                        <p id="confirm_comments"></p>
                                    </div>
                                    <div class="col-12 section-details">
                                        <label class="fw-bold">Delivery Method:</label>
                                        <p id="confirm_delivery"></p>
                                    </div>
                                    <div class="col-12 section-details" id="confirm_appointment_row" style="display: none;">
                                        <label class="fw-bold">Appointment:</label>
                                        <p id="confirm_appointment"></p>
                                    </div>
                                    <div class="col-12 section-details">
                                        <label>Payment Method:</label>
                                        <p id="confirm_payment_method"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="section-header text-center">Total Cost</div>
                                <div>
                                    <div class="flex-between section-details" id="confirm_subtotal_row" style="display: none;">
                                        <label>Repair Cost:</label>
                                        <p id="confirm_subtotal"></p>
                                    </div>
                                    <div class="flex-between section-details" id="confirm_inspection_row"
                                        style="display: none;">
                                        <label>Inspection Fee:</label>
                                        <p id="confirm_inspection"></p>
                                    </div>
                                    <hr />
                                    <div class="flex-between section-details">
                                        <label><strong>Total Cost:</strong></label>
                                        <p id="confirm_total"><strong></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5: Payment -->
                    <div class="step-content">
                        <h1 class="text-center mb-4">Complete Your Payment</h1>

                        <!-- Shipping Address removed as per request -->

                        <!-- Stripe Payment Section -->
                        <div id="stripePaymentSection" class="p-3">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Cardholder Name <span class="text-danger">*</span></label>
                                    <input type="text" id="cardholder-name" class="custom-input" placeholder="John Doe"
                                        required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Card Number <span class="text-danger">*</span></label>
                                    <div id="card-number" class="custom-input p-3"></div>
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                    <div id="card-expiry" class="custom-input p-3"></div>
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label class="form-label">CVC <span class="text-danger">*</span></label>
                                    <div id="card-cvc" class="custom-input p-3"></div>
                                </div>
                                <div class="col-md-4 col-12 mb-3">
                                    <label class="form-label">ZIP Code <span class="text-danger">*</span></label>
                                    <input type="text" id="card-zip" class="custom-input" placeholder="12345" maxlength="10"
                                        required>
                                </div>
                                <div class="col-12">
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>
                            </div>
                        </div>

                        <!-- PayPal Button (hidden, not used) -->
                        <div id="paypalPaymentSection" class="p-3" style="display: none;">
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary fs-12" id="prevBtn" disabled>Previous</button>
                    <button type="button" class="btn btn-gradient rounded w-md-25" id="nextBtn">Confirm</button>
                </div>
            </form>
        </div>
    @endif

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <!-- PayPal SDK -->
    <script
        src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', '') }}&currency=GBP&intent=capture"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const steps = document.querySelectorAll(".step");
            const contents = document.querySelectorAll(".step-content");
            const nextBtn = document.getElementById("nextBtn");
            const prevBtn = document.getElementById("prevBtn");
            let currentStep = 0;
            let stripe = null;
            let cardNumberElement = null;
            let cardExpiryElement = null;
            let cardCvcElement = null;
            let paypalButtons = null;
            let formData = {};

            // Initialize Stripe
            const stripeKey = '{{ env('STRIPE_KEY', '') }}';
            if (stripeKey && stripeKey !== 'pk_test_...') {
                stripe = Stripe(stripeKey);
                const elements = stripe.elements();

                const elementStyles = {
                    base: {
                        fontSize: '16px',
                        color: '#424770',
                        '::placeholder': {
                            color: '#aab7c4',
                        },
                    },
                    invalid: {
                        color: '#dc3545',
                    },
                };

                cardNumberElement = elements.create('cardNumber', { style: elementStyles });
                cardExpiryElement = elements.create('cardExpiry', { style: elementStyles });
                cardCvcElement = elements.create('cardCvc', { style: elementStyles });
            }

            function updateStepper() {
                const isZeroCost = !formData.total || formData.total === 0;

                steps.forEach((step, index) => {
                    step.classList.remove("active", "completed");
                    if (index < currentStep) step.classList.add("completed");
                    if (index === currentStep) step.classList.add("active");
                });

                contents.forEach((content, index) => {
                    content.classList.toggle("active", index === currentStep);
                });

                // prevBtn.disabled = currentStep === 0; // Enable previous button on step 0
                prevBtn.disabled = false;

                if (currentStep === 0) {
                    nextBtn.textContent = "Continue";
                } else if (currentStep === 1) {
                    // Delivery method step
                    const normalDeliveryOptions = document.getElementById('normal-delivery-options');
                    const zeroCostVisitOption = document.getElementById('zero-cost-visit-option');
                    const deliveryStepTitle = document.getElementById('delivery-step-title');

                    if (isZeroCost) {
                        // Show only Visit Us option with contact info
                        if (normalDeliveryOptions) normalDeliveryOptions.style.display = 'none';
                        if (zeroCostVisitOption) zeroCostVisitOption.style.display = 'block';
                        if (deliveryStepTitle) deliveryStepTitle.textContent = 'Visit Us for a Quote';

                        // Auto-select visit option
                        const visitRadioZero = document.getElementById('delivery_visit_zero');
                        if (visitRadioZero) {
                            visitRadioZero.checked = true;
                            document.getElementById('delivery_method').value = 'visit';
                        }

                        // Initialize zero-cost appointment fields
                        const appointmentDateZero = document.getElementById('appointment_date_zero');
                        const appointmentTimeZero = document.getElementById('appointment_time_zero');

                        if (appointmentDateZero) {
                            const today = new Date();
                            const maxDate = new Date();
                            maxDate.setDate(today.getDate() + 30);
                            appointmentDateZero.min = today.toISOString().split('T')[0];
                            appointmentDateZero.max = maxDate.toISOString().split('T')[0];
                            appointmentDateZero.required = true;
                        }
                        if (appointmentTimeZero) {
                            appointmentTimeZero.required = true;
                        }

                        nextBtn.textContent = "Submit Request";
                    } else {
                        // Show normal delivery options
                        if (normalDeliveryOptions) normalDeliveryOptions.style.display = 'flex';
                        if (zeroCostVisitOption) zeroCostVisitOption.style.display = 'none';
                        if (deliveryStepTitle) deliveryStepTitle.textContent = 'How would you like to proceed?';
                        nextBtn.textContent = "Continue";
                    }
                } else if (currentStep === 2) {
                    // Process info step
                    nextBtn.textContent = "Continue";
                } else if (currentStep === 3) {
                    // Confirm details step
                    if (isZeroCost) {
                        nextBtn.textContent = "Submit Request";
                    } else {
                        nextBtn.textContent = "Proceed to Payment";
                    }
                } else if (currentStep === 4) {
                    // Payment step - always show Pay Now
                    nextBtn.textContent = "Pay Now";
                }

                // Update confirmation step when entering step 3
                if (currentStep === 3) {
                    updateConfirmStep();
                }

                // Initialize payment sections on step 4 (always use Stripe)
                if (currentStep === 4) {
                    const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
                    const addressField = document.getElementById('address');
                    const addressSection = document.getElementById('shippingAddressSection');
                    const stripeSection = document.getElementById('stripePaymentSection');
                    const paypalSection = document.getElementById('paypalPaymentSection');

                    // Always hide PayPal section
                    if (paypalSection) paypalSection.style.display = 'none';

                    // Always show Stripe section
                    if (stripeSection) stripeSection.style.display = 'block';

                    if (deliveryMethod && deliveryMethod.value === 'visit') {
                        // Visit us - hide shipping address, show Stripe payment
                        if (addressSection) addressSection.style.display = 'none';
                        if (addressField) {
                            addressField.required = false;
                            addressField.value = '';
                        }
                        nextBtn.style.display = 'block';
                        nextBtn.textContent = 'Pay Now';
                    } else if (deliveryMethod && deliveryMethod.value === 'online') {
                        // Online delivery - Stripe payment
                        if (addressSection) addressSection.style.display = 'none'; // Ensure hidden
                        nextBtn.style.display = 'block';
                        nextBtn.textContent = 'Pay Now';
                    }

                    // Mount Stripe card elements if not already mounted
                    if (cardNumberElement && !cardNumberElement._mounted) {
                        cardNumberElement.mount('#card-number');
                        cardExpiryElement.mount('#card-expiry');
                        cardCvcElement.mount('#card-cvc');

                        // Add error handling for all card elements
                        const displayError = document.getElementById('card-errors');
                        const handleCardChange = function (event) {
                            if (event.error) {
                                displayError.textContent = event.error.message;
                            } else {
                                displayError.textContent = '';
                            }
                        };

                        cardNumberElement.on('change', handleCardChange);
                        cardExpiryElement.on('change', handleCardChange);
                        cardCvcElement.on('change', handleCardChange);
                    }
                } else {
                    // Show next button for non-payment steps
                    nextBtn.style.display = 'block';
                }
            }

            function initPayPal() {
                if (paypalButtons) return;

                const paypalContainer = document.getElementById('paypal-button-container');
                if (!paypalContainer) return;

                const paypalClientId = '{{ env('PAYPAL_CLIENT_ID', '') }}';
                if (!paypalClientId || paypalClientId === '') {
                    paypalContainer.innerHTML = '<p class="text-danger">PayPal is not configured. Please select Stripe or contact support.</p>';
                    return;
                }

                // Check if PayPal SDK is loaded
                if (typeof paypal === 'undefined') {
                    paypalContainer.innerHTML = '<p class="text-danger">PayPal SDK failed to load. Please refresh the page or select Stripe.</p>';
                    return;
                }

                try {
                    paypalButtons = paypal.Buttons({
                        createOrder: function (data, actions) {
                            const addressEl = document.getElementById('address');
                            if (!addressEl || !addressEl.value.trim()) {
                                alert('Please enter your shipping address first.');
                                return;
                            }

                            return fetch('{{ route('frontend.checkout.create-paypal-order') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    amount: formData.total || 0
                                })
                            })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Failed to create PayPal order');
                                    }
                                    return response.json();
                                })
                                .then(order => {
                                    if (!order || !order.id) {
                                        throw new Error('Invalid PayPal order response');
                                    }
                                    return order.id;
                                });
                        },
                        onApprove: function (data, actions) {
                            return actions.order.capture().then(function (details) {
                                submitForm('paypal', null, details.id);
                            });
                        },
                        onError: function (err) {
                            console.error('PayPal error:', err);
                            alert('An error occurred with PayPal. Please try again or select Stripe.');
                        },
                        onCancel: function (data) {
                            console.log('PayPal payment cancelled');
                        }
                    });

                    paypalButtons.render('#paypal-button-container').catch(function (err) {
                        console.error('PayPal render error:', err);
                        paypalContainer.innerHTML = '<p class="text-danger">Failed to load PayPal button. Please select Stripe or refresh the page.</p>';
                    });
                } catch (error) {
                    console.error('PayPal initialization error:', error);
                    paypalContainer.innerHTML = '<p class="text-danger">PayPal initialization failed. Please select Stripe or contact support.</p>';
                }
            }

            // Delivery method handler
            const deliveryMethodRadios = document.querySelectorAll('input[name="delivery_method"]');
            const deliveryMethodHidden = document.getElementById('delivery_method');
            const addressField = document.getElementById('address');
            const addressSection = document.getElementById('shippingAddressSection');

            deliveryMethodRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (deliveryMethodHidden) {
                        deliveryMethodHidden.value = this.value;
                    }

                    // Update delivery option styling
                    document.querySelectorAll('.delivery-option-item').forEach(item => {
                        item.style.borderColor = '#dee2e6';
                        item.style.backgroundColor = '';
                    });
                    const selectedItem = document.querySelector(`.delivery-option-item[data-delivery="${this.value}"]`);
                    if (selectedItem) {
                        selectedItem.style.borderColor = '#684471';
                        selectedItem.style.borderWidth = '2px';
                        selectedItem.style.backgroundColor = '#f8f9fa';
                    }

                    // Handle appointment fields
                    const appointmentFields = document.getElementById('appointment-fields');
                    const appointmentDate = document.getElementById('appointment_date');
                    const appointmentTime = document.getElementById('appointment_time');

                    if (this.value === 'visit') {
                        // Show appointment fields
                        if (appointmentFields) {
                            appointmentFields.style.display = '';

                            // Set date constraints
                            if (appointmentDate) {
                                const today = new Date();
                                const maxDate = new Date();
                                maxDate.setDate(today.getDate() + 30);
                                appointmentDate.min = today.toISOString().split('T')[0];
                                appointmentDate.max = maxDate.toISOString().split('T')[0];
                                appointmentDate.required = true;
                            }
                            if (appointmentTime) {
                                appointmentTime.required = true;
                            }
                        }
                    } else {
                        // Hide appointment fields for online delivery
                        if (appointmentFields) {
                            appointmentFields.style.display = 'none';
                            if (appointmentDate) {
                                appointmentDate.required = false;
                                appointmentDate.value = '';
                            }
                            if (appointmentTime) {
                                appointmentTime.required = false;
                                appointmentTime.value = '';
                            }
                        }
                    }

                    // Update address field visibility and requirements
                    if (this.value === 'visit') {
                        // Visit us - hide shipping address section
                        if (addressSection) addressSection.style.display = 'none';
                        if (addressField) {
                            addressField.required = false;
                            addressField.value = '';
                        }
                    } else if (this.value === 'online') {
                        // Online delivery - hide shipping address section (removed)
                        if (addressSection) addressSection.style.display = 'none';
                        if (addressField) {
                            addressField.required = false;
                            addressField.value = '';
                        }
                    }
                });
            });

            // Initialize delivery option styling
            document.querySelectorAll('.delivery-option-item').forEach(item => {
                item.addEventListener('click', function () {
                    const radio = this.querySelector('input[type="radio"]');
                    if (radio) {
                        radio.checked = true;
                        radio.dispatchEvent(new Event('change'));
                    }
                });
            });

            // Device model select handler
            const deviceModelSelect = document.getElementById('device_model_select');
            const deviceModelCustom = document.getElementById('device_model_custom');
            const deviceTypeIdHidden = document.getElementById('device_type_id');

            if (deviceModelSelect) {
                // Check if "other" is already selected on page load
                if (deviceModelSelect.value === 'other') {
                    if (deviceModelCustom) {
                        deviceModelCustom.style.display = 'block';
                        deviceModelCustom.required = true;
                    }
                    if (deviceTypeIdHidden) {
                        deviceTypeIdHidden.value = 'other';
                    }
                }

                deviceModelSelect.addEventListener('change', function () {
                    if (this.value === 'other') {
                        if (deviceModelCustom) {
                            deviceModelCustom.style.display = 'block';
                            deviceModelCustom.required = true;
                            deviceModelCustom.focus();
                        }
                        if (deviceTypeIdHidden) {
                            deviceTypeIdHidden.value = 'other';
                        }
                    } else {
                        if (deviceModelCustom) {
                            deviceModelCustom.style.display = 'none';
                            deviceModelCustom.required = false;
                            deviceModelCustom.value = ''; // Clear the value when hidden
                        }
                        if (deviceTypeIdHidden && this.value !== '') {
                            // Reset to empty if a specific device type is selected
                            // The actual device_type_id will be handled by the form submission
                            deviceTypeIdHidden.value = '';
                        }
                    }
                });
            }

            // Issue checkbox handler
            const issueUnknown = document.getElementById('issue_unknown');
            const issueCheckboxes = document.querySelectorAll('.issue-checkbox');

            issueUnknown.addEventListener('change', function () {
                if (this.checked) {
                    issueCheckboxes.forEach(cb => cb.checked = false);
                    calculatePricing();
                }
            });

            issueCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    if (this.checked && issueUnknown) {
                        issueUnknown.checked = false;
                    }
                    calculatePricing();
                    loadQualityTiersForSelectedIssues();
                });
            });

            // Load quality tiers when issues are selected
            function loadQualityTiersForSelectedIssues() {
                const selectedIssues = Array.from(document.querySelectorAll('.issue-checkbox:checked')).map(cb => cb.value);
                const qualityTierSection = document.getElementById('quality-tier-selection');
                const qualityTierOptions = document.getElementById('quality-tier-options');

                // Hide tier selection if no issues or unknown issue is selected
                if (selectedIssues.length === 0 || (issueUnknown && issueUnknown.checked)) {
                    qualityTierSection.style.display = 'none';
                    qualityTierOptions.innerHTML = ''; // Clear tier radio buttons
                    document.getElementById('selected_tier_id').value = '';
                    calculatePricing(); // Recalculate pricing without tier modifier
                    return;
                }

                // For simplicity, check only the first selected issue for tiers
                // You can modify this to handle multiple issues differently
                const firstIssueId = selectedIssues[0];
                const deviceTypeId = document.getElementById('device_type_id').value;

                fetch(`/api/quality-tiers/${firstIssueId}?device_type_id=${deviceTypeId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Check if quality tier selection is required
                            if (data.requires_quality_tier === false) {
                                // No quality tier needed - hide the section
                                qualityTierSection.style.display = 'none';
                                qualityTierOptions.innerHTML = '';
                                document.getElementById('selected_tier_id').value = '';

                                // Store base price for pricing calculation
                                window.issueBasePrice = data.base_price || 0;

                                calculatePricing();
                            } else if (data.tiers && data.tiers.length > 0) {
                                // Quality tier required and tiers available - show tier selection
                                window.issueBasePrice = null; // Clear base price
                                qualityTierSection.style.display = 'block';

                                // Get currently selected tier ID (if any)
                                const currentlySelectedTierId = document.getElementById('selected_tier_id').value;

                                // Build tier options
                                let tiersHtml = '';
                                let currentTierStillExists = false;

                                data.tiers.forEach(tier => {
                                    const isCurrentlySelected = currentlySelectedTierId && tier.id == currentlySelectedTierId;
                                    const isDefault = tier.is_default;

                                    // Check if currently selected tier exists in new tier list
                                    if (isCurrentlySelected) {
                                        currentTierStillExists = true;
                                    }

                                    // Only check as default if no tier is currently selected
                                    const shouldBeChecked = currentlySelectedTierId
                                        ? isCurrentlySelected
                                        : isDefault;

                                    const priceText = tier.price_modifier > 0
                                        ? ` (+{{ $currencySymbol }}${parseFloat(tier.price_modifier).toFixed(2)})`
                                        : '';

                                    tiersHtml += `
                                                                                                                                                                        <div class="form-check custom-check p-3 border rounded bg-white">
                                                                                                                                                                            <input class="form-check-input tier-radio mt-1" type="radio" 
                                                                                                                                                                                   name="quality_tier" id="tier_${tier.id}" 
                                                                                                                                                                                   value="${tier.id}" data-price="${tier.price_modifier}"
                                                                                                                                                                                   ${shouldBeChecked ? 'checked' : ''}>
                                                                                                                                                                            <label class="form-check-label w-100 cursor-pointer ps-2" for="tier_${tier.id}">
                                                                                                                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                                                                                                                    <strong class="fs-16">${tier.name}</strong>
                                                                                                                                                                                    <span class="badge bg-light text-dark border">${priceText}</span>
                                                                                                                                                                                </div>
                                                                                                                                                                                ${tier.description ? `<small class="text-muted d-block mt-1">${tier.description}</small>` : ''}
                                                                                                                                                                            </label>
                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                            `;
                                            });

                                            qualityTierOptions.innerHTML = tiersHtml;

                                            // Update selected_tier_id based on what's checked
                                            if (currentlySelectedTierId && currentTierStillExists) {
                                                // Keep the current selection
                                                document.getElementById('selected_tier_id').value = currentlySelectedTierId;
                                            } else {
                                                // Set default tier if exists and no previous selection
                                                const defaultTier = data.tiers.find(t => t.is_default);
                                                if (defaultTier) {
                                                    document.getElementById('selected_tier_id').value = defaultTier.id;
                                                }
                                            }

                                            // Add event listeners to tier radios
                                            document.querySelectorAll('.tier-radio').forEach(radio => {
                                                radio.addEventListener('change', function () {
                                                    document.getElementById('selected_tier_id').value = this.value;
                                                    calculatePricing();
                                                });
                                            });

                                            // Recalculate pricing with the selected tier
                                            calculatePricing();
                                        } else {
                                            // No tiers available and quality tier is required - hide section
                                            window.issueBasePrice = null;
                                            qualityTierSection.style.display = 'none';
                                            qualityTierOptions.innerHTML = '';
                                            document.getElementById('selected_tier_id').value = '';
                                            calculatePricing();
                                        }
                                    }
                                })
                                .catch(error => {
                                    console.error('Error loading quality tiers:', error);
                                    window.issueBasePrice = null;
                                    qualityTierSection.style.display = 'none';
                                    qualityTierOptions.innerHTML = ''; // Clear tier radio buttons
                                    document.getElementById('selected_tier_id').value = '';
                                    calculatePricing(); // Recalculate pricing without tier modifier
                                });
                        }

                        function calculatePricing() {
                            const selectedIssues = Array.from(document.querySelectorAll('.issue-checkbox:checked')).map(cb => cb.value);
                            const isUnknown = issueUnknown && issueUnknown.checked;
                            const deviceTypeId = document.getElementById('device_type_id') ? document.getElementById('device_type_id').value : null;

                            const selectedTier = document.querySelector('.tier-radio:checked');
                            // Use tier modifier if tier is selected, otherwise use base price if available
                            let tierModifier = 0;
                            if (selectedTier) {
                                tierModifier = parseFloat(selectedTier.dataset.price) || 0;
                            } else if (window.issueBasePrice !== undefined && window.issueBasePrice !== null) {
                                // Add base price as modifier when no tier selection is required
                                tierModifier = parseFloat(window.issueBasePrice) || 0;
                            }

                            if (selectedIssues.length === 0 && !isUnknown) {
                                document.getElementById('pricing-preview').style.display = 'none';
                                formData.subtotal = 0;
                                formData.inspection_fee = 0;
                                formData.total = 0;
                                return;
                            }

                            return fetch('{{ route('frontend.repair.process') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    service_id: {{ $service->id }},
                                    device_type_id: deviceTypeId && deviceTypeId !== 'other' ? deviceTypeId : null,
                                    issues: selectedIssues,
                                    issue_unknown: isUnknown,
                                    tier_modifier: tierModifier
                                })
                            })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        formData.subtotal = parseFloat(data.subtotal) || 0;
                                        formData.inspection_fee = parseFloat(data.inspection_fee) || 0;
                                        formData.total = parseFloat(data.total) || 0;

                                        let breakdown = '';
                                        if (formData.subtotal > 0) {
                                            breakdown += `<div>Repair Cost: ${data.currency_symbol || '{{ $currencySymbol }}'}${formData.subtotal.toFixed(2)}</div>`;
                                        }
                                        if (formData.inspection_fee > 0) {
                                            breakdown += `<div>Inspection Fee: ${data.currency_symbol || '{{ $currencySymbol }}'}${formData.inspection_fee.toFixed(2)}</div>`;
                                        }
                                        breakdown += `<div><strong>Total: ${data.currency_symbol || '{{ $currencySymbol }}'}${formData.total.toFixed(2)}</strong></div>`;

                                        document.getElementById('pricing-breakdown').innerHTML = breakdown;
                                        document.getElementById('pricing-preview').style.display = 'block';
                                    } else {
                                        console.error('Pricing calculation failed:', data);
                                        alert('Failed to calculate pricing. Please try again.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error calculating pricing:', error);
                                    alert('Failed to calculate pricing. Please check your selections and try again.');
                                });
                        }

                        function updateConfirmStep() {
                            const nameEl = document.getElementById('customer_name');
                            const emailEl = document.getElementById('customer_email');
                            const phoneEl = document.getElementById('customer_phone');
                            const deviceModelEl = document.getElementById('device_model');
                            const deviceModelSelectEl = document.getElementById('device_model_select');
                            const deviceModelCustomEl = document.getElementById('device_model_custom');
                            const issueDescriptionEl = document.getElementById('issue_description');
                            const deliveryMethodEl = document.querySelector('input[name="delivery_method"]:checked');
                            const paymentMethodEl = document.querySelector('input[name="payment_method"]');

                            formData.name = nameEl ? nameEl.value.trim() : '';
                            formData.email = emailEl ? emailEl.value.trim() : '';
                            formData.phone = phoneEl ? phoneEl.value.trim() : '';

                            // Get device model from whichever field exists
                            if (deviceModelEl && deviceModelEl.value) {
                                formData.device = deviceModelEl.value.trim();
                            } else if (deviceModelSelectEl && deviceModelSelectEl.value) {
                                if (deviceModelSelectEl.value === 'other' && deviceModelCustomEl && deviceModelCustomEl.value) {
                                    formData.device = deviceModelCustomEl.value.trim();
                                } else {
                                    formData.device = deviceModelSelectEl.value.trim();
                                }
                            } else if (deviceModelCustomEl && deviceModelCustomEl.value) {
                                formData.device = deviceModelCustomEl.value.trim();
                            } else {
                                formData.device = 'Not specified';
                            }

                            // Get delivery method
                            formData.deliveryMethod = deliveryMethodEl ? deliveryMethodEl.value : 'Not selected';
                            formData.deliveryMethodText = deliveryMethodEl && deliveryMethodEl.value === 'visit' ? 'Visit Us' : (deliveryMethodEl && deliveryMethodEl.value === 'online' ? 'Online Delivery' : 'Not selected');

                            // Get payment method - always Stripe (Card)
                            formData.paymentMethod = 'stripe';
                            formData.paymentMethodText = 'Card';

                            // Get selected issues
                            const checkedIssues = document.querySelectorAll('.issue-checkbox:checked');
                            formData.issues = Array.from(checkedIssues).map(cb => {
                                const label = document.querySelector(`label[for="${cb.id}"]`);
                                return label ? label.textContent.trim() : '';
                            }).filter(issue => issue !== '');

                            if (issueUnknown && issueUnknown.checked) {
                                formData.issues = ["I don't know the issue"];
                            }

                            formData.comments = issueDescriptionEl ? issueDescriptionEl.value.trim() : '';
                            if (!formData.comments) {
                                formData.comments = 'None';
                            }

                            // Get selected quality tier
                            const selectedTierRadio = document.querySelector('.tier-radio:checked');
                            if (selectedTierRadio) {
                                const tierLabel = document.querySelector(`label[for="${selectedTierRadio.id}"]`);
                                formData.qualityTier = tierLabel ? tierLabel.textContent.trim() : 'Not selected';
                            } else {
                                formData.qualityTier = null;
                            }

                            // Update confirmation display
                            const confirmNameEl = document.getElementById('confirm_name');
                            const confirmEmailEl = document.getElementById('confirm_email');
                            const confirmPhoneEl = document.getElementById('confirm_phone');
                            const confirmDeviceEl = document.getElementById('confirm_device');
                            const confirmIssuesEl = document.getElementById('confirm_issues');
                            const confirmCommentsEl = document.getElementById('confirm_comments');
                            const confirmDeliveryEl = document.getElementById('confirm_delivery');
                            const confirmPaymentMethodEl = document.getElementById('confirm_payment_method');
                            const confirmQualityTierRow = document.getElementById('confirm_quality_tier_row');
                            const confirmQualityTierEl = document.getElementById('confirm_quality_tier');

                            if (confirmNameEl) confirmNameEl.textContent = formData.name || 'Not provided';
                            if (confirmEmailEl) confirmEmailEl.textContent = formData.email || 'Not provided';
                            if (confirmPhoneEl) confirmPhoneEl.textContent = formData.phone || 'Not provided';
                            if (confirmDeviceEl) confirmDeviceEl.textContent = formData.device || 'Not specified';
                            if (confirmIssuesEl) confirmIssuesEl.textContent = formData.issues.length > 0 ? formData.issues.join(', ') : 'None';
                            if (confirmCommentsEl) confirmCommentsEl.textContent = formData.comments || 'None';
                            if (confirmDeliveryEl) confirmDeliveryEl.textContent = formData.deliveryMethodText || 'Not selected';
                            if (confirmPaymentMethodEl) confirmPaymentMethodEl.textContent = formData.paymentMethodText || 'Not selected';

                            // Show/hide quality tier row based on selection
                            if (formData.qualityTier && confirmQualityTierRow && confirmQualityTierEl) {
                                confirmQualityTierRow.style.display = 'block';
                                confirmQualityTierEl.textContent = formData.qualityTier;
                            } else if (confirmQualityTierRow) {
                                confirmQualityTierRow.style.display = 'none';
                            }

                            // Show/hide and populate appointment information
                            const confirmAppointmentRow = document.getElementById('confirm_appointment_row');
                            const confirmAppointmentEl = document.getElementById('confirm_appointment');
                            const deliveryMethod = document.getElementById('delivery_method');

                            if (deliveryMethod && deliveryMethod.value === 'visit') {
                                const appointmentDate = document.getElementById('appointment_date') || document.getElementById('appointment_date_zero');
                                const appointmentTime = document.getElementById('appointment_time') || document.getElementById('appointment_time_zero');

                                if (appointmentDate && appointmentTime && appointmentDate.value && appointmentTime.value) {
                                    const dateObj = new Date(appointmentDate.value);
                                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                    const formattedDate = dateObj.toLocaleDateString('en-GB', options);

                                    const timeSlotText = appointmentTime.options[appointmentTime.selectedIndex].text;

                                    if (confirmAppointmentEl) {
                                        confirmAppointmentEl.textContent = `${formattedDate} at ${timeSlotText}`;
                                    }
                                    if (confirmAppointmentRow) {
                                        confirmAppointmentRow.style.display = 'block';
                                    }
                                } else {
                                    if (confirmAppointmentRow) confirmAppointmentRow.style.display = 'none';
                                }
                            } else {
                                if (confirmAppointmentRow) confirmAppointmentRow.style.display = 'none';
                            }

                            // Update pricing display
                            const confirmSubtotalRow = document.getElementById('confirm_subtotal_row');
                            const confirmSubtotal = document.getElementById('confirm_subtotal');
                            const confirmInspectionRow = document.getElementById('confirm_inspection_row');
                            const confirmInspection = document.getElementById('confirm_inspection');
                            const confirmTotal = document.getElementById('confirm_total');

                            if (formData.subtotal > 0) {
                                if (confirmSubtotalRow) confirmSubtotalRow.style.display = 'flex';
                                if (confirmSubtotal) confirmSubtotal.textContent = '{{ $currencySymbol }}' + (formData.subtotal || 0).toFixed(2);
                            } else {
                                if (confirmSubtotalRow) confirmSubtotalRow.style.display = 'none';
                            }

                            if (formData.inspection_fee > 0) {
                                if (confirmInspectionRow) confirmInspectionRow.style.display = 'flex';
                                if (confirmInspection) confirmInspection.textContent = '{{ $currencySymbol }}' + (formData.inspection_fee || 0).toFixed(2);
                            } else {
                                if (confirmInspectionRow) confirmInspectionRow.style.display = 'none';
                            }

                            if (confirmTotal) {
                                const total = (formData.total || 0).toFixed(2);
                                confirmTotal.innerHTML = '<strong>{{ $currencySymbol }}' + total + '</strong>';
                            }
                        }

                        function validateStep(step) {
                            if (step === 0) {
                                const name = document.getElementById('customer_name').value.trim();
                                const email = document.getElementById('customer_email').value.trim();
                                const phone = document.getElementById('customer_phone').value.trim();
                                const deviceModel = document.getElementById('device_model');
                                const deviceModelSelect = document.getElementById('device_model_select');
                                const deviceModelCustom = document.getElementById('device_model_custom');
                                const device = (deviceModel && deviceModel.value) || (deviceModelSelect && deviceModelSelect.value) || (deviceModelCustom && deviceModelCustom.value);
                                const hasIssues = document.querySelectorAll('.issue-checkbox:checked').length > 0 || (issueUnknown && issueUnknown.checked);

                                if (!name || !email || !phone || !device || !hasIssues) {
                                    alert('Please fill in all required fields.');
                                    return false;
                                }

                                // Calculate pricing if not already done
                                // Check if pricing has been calculated (formData.total should be defined, even if 0)
                                if (formData.total === undefined) {
                                    const pricingPromise = calculatePricing();
                                    if (pricingPromise) {
                                        pricingPromise.then(() => {
                                            // Pricing calculated, user can proceed
                                        }).catch(() => {
                                            // Error already handled in calculatePricing
                                        });
                                    }
                                    return false; // Prevent moving to next step until pricing is calculated
                                }
                            }
                            if (step === 1) {
                                // Delivery method selection - must select one
                                const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
                                if (!deliveryMethod) {
                                    alert('Please select a delivery method.');
                                    return false;
                                }
                                if (deliveryMethodHidden) {
                                    deliveryMethodHidden.value = deliveryMethod.value;
                                }

                                // For Visit Us delivery, validate appointment fields
                                if (deliveryMethod.value === 'visit') {
                                    // Helper function to check if element is visible
                                    const isVisible = (element) => {
                                        if (!element) return false;
                                        return element.offsetParent !== null;
                                    };

                                    // Check which appointment fields are visible
                                    const regularDateField = document.getElementById('appointment_date');
                                    const regularTimeField = document.getElementById('appointment_time');
                                    const zeroDateField = document.getElementById('appointment_date_zero');
                                    const zeroTimeField = document.getElementById('appointment_time_zero');

                                    // Determine which set of fields to validate based on visibility
                                    let dateField = null;
                                    let timeField = null;

                                    if (isVisible(zeroDateField)) {
                                        // Zero-cost fields are visible
                                        dateField = zeroDateField;
                                        timeField = zeroTimeField;
                                    } else if (isVisible(regularDateField)) {
                                        // Regular fields are visible
                                        dateField = regularDateField;
                                        timeField = regularTimeField;
                                    }

                                    // Validate the visible fields
                                    if (dateField && !dateField.value) {
                                        alert('Please select an appointment date for your visit.');
                                        dateField.focus();
                                        return false;
                                    }

                                    if (timeField && !timeField.value) {
                                        alert('Please select an appointment time slot for your visit.');
                                        timeField.focus();
                                        return false;
                                    }
                                }
                            }
                            if (step === 2) {
                                // Process info step - no validation needed, just informational
                                // Payment method is always Stripe, no need to validate
                            }
                            if (step === 5) {
                                // Validation for step 5 if needed
                            }
                            return true;
                        }

                        async function submitForm(paymentMethod, stripeToken, paypalOrderId) {
                            const form = document.getElementById('repairForm');
                            const formDataObj = new FormData(form);

                            // Get device model
                            const deviceModelEl = document.getElementById('device_model');
                            const deviceModelSelectEl = document.getElementById('device_model_select');
                            const deviceModelCustomEl = document.getElementById('device_model_custom');

                            let deviceModel = '';
                            if (deviceModelEl && deviceModelEl.value) {
                                deviceModel = deviceModelEl.value.trim();
                            } else if (deviceModelSelectEl && deviceModelSelectEl.value) {
                                if (deviceModelSelectEl.value === 'other' && deviceModelCustomEl && deviceModelCustomEl.value) {
                                    deviceModel = deviceModelCustomEl.value.trim();
                                } else {
                                    deviceModel = deviceModelSelectEl.value.trim();
                                }
                            } else if (deviceModelCustomEl && deviceModelCustomEl.value) {
                                deviceModel = deviceModelCustomEl.value.trim();
                            }

                            // Get selected issues
                            const selectedIssues = Array.from(document.querySelectorAll('.issue-checkbox:checked')).map(cb => cb.value);

                            // Get delivery method
                            const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
                            const deliveryMethodValue = deliveryMethod ? deliveryMethod.value : '';

                            // Get payment method
                            const paymentMethodEl = document.querySelector('input[name="payment_method"]');
                            const paymentMethodValue = paymentMethodEl ? paymentMethodEl.value : '';

                            // Get address (required only for online delivery) - REMOVED
                            // const addressEl = document.getElementById('address');
                            // if (deliveryMethodValue === 'online' && (!addressEl || !addressEl.value.trim())) {
                            //     alert('Please enter your shipping address.');
                            //     return;
                            // }

                            // If payment method is "visit", set it to empty string for backend
                            const finalPaymentMethod = paymentMethodValue === 'visit' ? '' : paymentMethodValue;

                            // Prepare complete order data to send in one request
                            const orderData = new FormData();
                            orderData.append('service_id', formDataObj.get('service_id'));
                            const deviceTypeId = formDataObj.get('device_type_id');
                            if (deviceTypeId && deviceTypeId !== 'other') {
                                orderData.append('device_type_id', deviceTypeId);
                            }
                            orderData.append('device_type', formDataObj.get('device_type') || 'Other');
                            orderData.append('device_model', deviceModel);
                            orderData.append('customer_name', formDataObj.get('customer_name'));
                            orderData.append('customer_email', formDataObj.get('customer_email'));
                            orderData.append('customer_phone', formDataObj.get('customer_phone'));
                            selectedIssues.forEach(issueId => orderData.append('issues[]', issueId));
                            orderData.append('issue_description', formDataObj.get('issue_description') || '');
                            orderData.append('delivery_method', deliveryMethodValue);

                            // Add appointment fields if Visit Us is selected (check both regular and zero-cost fields)
                            // Zero-cost fields take priority when visible and filled, otherwise use regular fields
                            const appointmentDateZero = document.getElementById('appointment_date_zero');
                            const appointmentTimeZero = document.getElementById('appointment_time_zero');
                            const appointmentDateRegular = document.getElementById('appointment_date');
                            const appointmentTimeRegular = document.getElementById('appointment_time');

                            // Use zero-cost fields if they have values, otherwise use regular fields
                            const appointmentDateValue = (appointmentDateZero && appointmentDateZero.value) ? appointmentDateZero.value : 
                                                          (appointmentDateRegular && appointmentDateRegular.value) ? appointmentDateRegular.value : '';
                            const appointmentTimeValue = (appointmentTimeZero && appointmentTimeZero.value) ? appointmentTimeZero.value : 
                                                          (appointmentTimeRegular && appointmentTimeRegular.value) ? appointmentTimeRegular.value : '';

                            if (appointmentDateValue) {
                                orderData.append('appointment_date', appointmentDateValue);
                            }
                            if (appointmentTimeValue) {
                                orderData.append('appointment_time', appointmentTimeValue);
                            }

                            orderData.append('payment_method', finalPaymentMethod);
                            // orderData.append('address', addressEl ? addressEl.value.trim() : ''); // REMOVED
                            orderData.append('subtotal', formData.subtotal || 0);
                            orderData.append('inspection_fee', formData.inspection_fee || 0);
                            orderData.append('total', formData.total || 0);

                            if (stripeToken) {
                                orderData.append('stripe_token', stripeToken);
                            }
                            if (paypalOrderId) {
                                orderData.append('paypal_order_id', paypalOrderId);
                            }

                            try {
                                // Submit everything in one request
                                const response = await fetch('{{ route('frontend.repair.payment') }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    credentials: 'same-origin', // Ensure cookies are sent
                                    body: orderData
                                });

                                // Check if response is JSON
                                const contentType = response.headers.get('content-type');
                                if (!contentType || !contentType.includes('application/json')) {
                                    const text = await response.text();
                                    console.error('Non-JSON response:', text);
                                    throw new Error('Server returned an invalid response. Please try again.');
                                }

                                const result = await response.json();
                                if (result.success) {
                                    // Redirect with order number if available
                                    const redirectUrl = result.redirect || '{{ route('frontend.place-order') }}';
                                    if (result.order_number) {
                                        window.location.href = redirectUrl + '?order=' + result.order_number;
                                    } else {
                                        window.location.href = redirectUrl;
                                    }
                                } else {
                                    const errorMsg = result.message || (result.errors ? JSON.stringify(result.errors) : 'Payment failed. Please try again.');
                                    alert(errorMsg);
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                alert('An error occurred: ' + error.message);
                            }
                        }

                        nextBtn.addEventListener("click", async () => {
                            const isZeroCost = !formData.total || formData.total === 0;

                            if (!validateStep(currentStep)) {
                                return;
                            }

                            // Update confirmation step when moving to step 3
                            if (currentStep === 1) {
                                updateConfirmStep();
                            }

                            // Handle zero-cost submission on step 3 (Confirm Details)
                            if (currentStep === 3 && isZeroCost) {
                                // Submit form without payment for zero-cost orders
                                submitForm('visit', null, null);
                                return;
                            }

                            if (currentStep === 4) {
                                // Payment step - always use Stripe for both delivery methods
                                const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked');

                                // For online delivery, validate shipping address - REMOVED
                                if (deliveryMethod && deliveryMethod.value === 'online') {
                                    // Address validation removed
                                }
                                // Always process Stripe payment
                                if (!stripe || !cardNumberElement) {
                                    alert('Stripe is not configured. Please contact support.');
                                    return;
                                }

                                // Validate cardholder name and zip code
                                const cardholderName = document.getElementById('cardholder-name');
                                const cardZip = document.getElementById('card-zip');

                                if (!cardholderName || !cardholderName.value.trim()) {
                                    alert('Please enter the cardholder name.');
                                    cardholderName.focus();
                                    return;
                                }

                                if (!cardZip || !cardZip.value.trim()) {
                                    alert('Please enter the ZIP code.');
                                    cardZip.focus();
                                    return;
                                }

                                try {
                                    const { token, error } = await stripe.createToken(cardNumberElement, {
                                        name: cardholderName.value.trim(),
                                        address_zip: cardZip.value.trim()
                                    });

                                    if (error) {
                                        const cardErrorsEl = document.getElementById('card-errors');
                                        if (cardErrorsEl) cardErrorsEl.textContent = error.message;
                                        return;
                                    }

                                    if (!token || !token.id) {
                                        alert('Failed to create payment token. Please try again.');
                                        return;
                                    }

                                    submitForm('stripe', token.id, null);
                                } catch (error) {
                                    console.error('Stripe error:', error);
                                    alert('An error occurred with Stripe. Please try again.');
                                }
                                return;
                            }

                            if (currentStep < steps.length - 1) {
                                currentStep++;

                                // Get selected delivery method
                                const selectedDeliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
                                const isVisitUs = selectedDeliveryMethod && selectedDeliveryMethod.value === 'visit';

                                // Skip Process Info step (step 2) if zero cost OR if Visit Us is selected
                                // Process Info is only relevant for mail-in/online delivery
                                if (currentStep === 2 && (isZeroCost || isVisitUs)) {
                                    currentStep++; // Skip to step 3 (Confirm Details)
                                }

                                // Skip Payment step (step 4) if zero cost - should not reach here
                                if (currentStep === 4 && isZeroCost) {
                                    currentStep++; // This shouldn't happen, but just in case
                                }

                                updateStepper();

                                // Update confirmation step when entering step 4
                                if (currentStep === 4) {
                                    updateConfirmStep();
                                }
                            }
                        });

                        prevBtn.addEventListener("click", () => {
                            const isZeroCost = !formData.total || formData.total === 0;

                            if (currentStep === 0) {
                                window.history.back();
                                return;
                            }
                            if (currentStep > 0) {
                                currentStep--;

                                // Get selected delivery method
                                const selectedDeliveryMethod = document.querySelector('input[name="delivery_method"]:checked');
                                const isVisitUs = selectedDeliveryMethod && selectedDeliveryMethod.value === 'visit';

                                // Skip Process Info step (step 2) if zero cost OR Visit Us when going backwards
                                if (currentStep === 2 && (isZeroCost || isVisitUs)) {
                                    currentStep--; // Skip back to step 1 (Delivery Method)
                                }

                                updateStepper();
                            }
                        });

                        // Payment option click handler
                        document.querySelectorAll('.payment-option-item').forEach(item => {
                            item.addEventListener('click', function (e) {
                                // Don't trigger if clicking directly on the radio input
                                if (e.target.type === 'radio') {
                                    return;
                                }
                                const radio = this.querySelector('input[type="radio"]');
                                if (radio) {
                                    radio.checked = true;
                                    radio.dispatchEvent(new Event('change'));

                                    // Update visual styling
                                    document.querySelectorAll('.payment-option-item').forEach(opt => {
                                        opt.style.borderColor = '#dee2e6';
                                        opt.style.backgroundColor = '';
                                        opt.style.borderWidth = '1px';
                                    });
                                    this.style.borderColor = '#684471';
                                    this.style.borderWidth = '2px';
                                    this.style.backgroundColor = '#f8f9fa';
                                }
                            });
                        });

                        // Payment method is always Stripe - no handler needed

                        updateStepper();
                    });
                </script>

                <style>
                    .step-content {
                        display: none;
                    }

                    .step-content.active {
                        display: block;
                    }

                    .delivery-option-item:hover {
                        border-color: #684471 !important;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 8px rgba(104, 68, 113, 0.2);
                    }

                    .payment-option-item:hover {
                        border-color: #684471 !important;
                        transform: translateY(-2px);
                        box-shadow: 0 4px 8px rgba(104, 68, 113, 0.2);
                    }

                    /* Hide Pay on Visit option */
                    #payOnVisitOption {
                        display: none !important;
                    }
                </style>
@endsection