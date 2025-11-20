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
    <div id="stepper" class="stepper d-flex justify-content-between align-items-center position-relative mb-5 overflow-auto">
        <div class="step active">
            <div class="circle">1</div>
            <div class="label">Information</div>
        </div>
        <div class="step">
            <div class="circle">2</div>
            <div class="label">Payment Method</div>
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
        <input type="hidden" name="device_type_id" id="device_type_id" value="{{ $deviceType->id ?? '' }}">
        <input type="hidden" name="device_type" id="device_type" value="{{ $deviceType ? $deviceType->name : 'Other' }}">
        
        <div id="form-steps">
            <!-- Step 1: Information -->
            <div class="step-content active">
                <h1 class="text-center my-4">Let's get started!</h1>
                <div class="row mt-3 gy-5">
                    <div class="col-md-6 col-12">
                        <div class="">
                            <label class="form-label" for="customer_name">Your name <span class="text-danger">*</span></label>
                            <input id="customer_name" name="customer_name" type="text" placeholder="Full name" class="custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="">
                            <label class="form-label" for="customer_email">Your email address <span class="text-danger">*</span></label>
                            <input id="customer_email" name="customer_email" type="email" placeholder="Email address" class="custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="">
                            <label class="form-label" for="customer_phone">Your phone number <span class="text-danger">*</span></label>
                            <input id="customer_phone" name="customer_phone" type="tel" placeholder="Phone number" class="custom-input" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="">
                            <label class="form-label" for="device_model">Model of device <span class="text-danger">*</span></label>
                            @if($deviceType && $deviceType->id)
                            <input type="text" class="custom-input" id="device_model" name="device_model" value="{{ $deviceType->name }}" readonly>
                            @else
                            <select class="custom-select" id="device_model_select" name="device_model" required>
                                <option value="">Please select</option>
                                @foreach($service->deviceTypes as $dt)
                                <option value="{{ $dt->name }}" {{ $deviceType && $deviceType->id == $dt->id ? 'selected' : '' }}>{{ $dt->name }}</option>
                                @endforeach
                                <option value="other">Other (Please specify)</option>
                            </select>
                            <input type="text" class="custom-input mt-2" id="device_model_custom" name="device_model" placeholder="Enter device model" style="display: none;">
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="device-issues mt-4">
                            <label class="form-label">Device Issue <span class="text-danger">*</span></label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($service->issues as $issue)
                                <div class="form-check custom-check">
                                    <input class="form-check-input issue-checkbox" type="checkbox" name="issues[]" id="issue_{{ $issue->id }}" value="{{ $issue->id }}">
                                    <label class="form-check-label" for="issue_{{ $issue->id }}">{{ $issue->name }}</label>
                                </div>
                                @endforeach
                                <div class="form-check custom-check">
                                    <input class="form-check-input" type="checkbox" id="issue_unknown" name="issue_unknown">
                                    <label class="form-check-label" for="issue_unknown">I don't know the issue</label>
                                </div>
                            </div>
                            <small class="text-muted d-block mt-2">If you don't know the issue, we'll charge an inspection fee.</small>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <label class="form-label" for="issue_description">Describe your issue</label>
                            <textarea class="custom-input" name="issue_description" id="issue_description" cols="30" rows="5" placeholder="Additional comments here...."></textarea>
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

            <!-- Step 2: Payment Method Selection -->
            <div class="step-content">
                <h1 class="text-sm-center my-4 mb-5">How do you want to pay?</h1>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="py-3 flex-center flex-column gap-2 border payment-option-item" data-payment="stripe" style="cursor: pointer; border-radius: 8px;">
                            <img src="{{ asset('front-assets/img/CreditCard.svg') }}" alt="Stripe" style="height: 40px;">
                            <label class="form-label fw-500 w-100 text-center">Stripe</label>
                            <input type="radio" name="payment_method" value="stripe" class="custom-radio" checked>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="py-3 flex-center flex-column gap-2 border payment-option-item" data-payment="paypal" style="cursor: pointer; border-radius: 8px;">
                            <img src="{{ asset('front-assets/img/paypal.svg') }}" alt="PayPal" style="height: 40px;">
                            <label class="form-label fw-500 w-100 text-center">PayPal</label>
                            <input type="radio" name="payment_method" value="paypal" class="custom-radio">
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

            <!-- Step 4: Confirm Details -->
            <div class="step-content">
                <h1 class="text-center mb-5 pb-3">Please Confirm Your Details:</h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header">Your Details</div>
                        <div class="row">
                            <div class="col-12 section-details">
                                <label>Your name:</label>
                                <p id="confirm_name"></p>
                            </div>
                            <div class="col-12 section-details">
                                <label>Your email:</label>
                                <p id="confirm_email"></p>
                            </div>
                            <div class="col-12 section-details">
                                <label>Your phone:</label>
                                <p id="confirm_phone"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="section-header">Device Details</div>
                        <div class="row">
                            <div class="col-12 section-details">
                                <label>Device model:</label>
                                <p id="confirm_device"></p>
                            </div>
                            <div class="col-12 section-details">
                                <label>Selected Issues:</label>
                                <p id="confirm_issues"></p>
                            </div>
                            <div class="col-12 section-details">
                                <label>Comments:</label>
                                <p id="confirm_comments"></p>
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
                            <div class="flex-between section-details" id="confirm_inspection_row" style="display: none;">
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
                <div class="mb-4">
                    <label class="form-label">Shipping Address <span class="text-danger">*</span></label>
                    <textarea class="custom-input" name="address" id="address" rows="4" placeholder="Enter your full shipping address" required></textarea>
                </div>
                
                <!-- Stripe Payment Section -->
                <div id="stripePaymentSection" class="p-3">
                    <div class="mb-3">
                        <label class="form-label">Card Details</label>
                        <div id="card-element" class="custom-input p-3"></div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                    </div>
                </div>
                
                <!-- PayPal Button -->
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
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', '') }}&currency=GBP&intent=capture"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const steps = document.querySelectorAll(".step");
    const contents = document.querySelectorAll(".step-content");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    let currentStep = 0;
    let stripe = null;
    let cardElement = null;
    let paypalButtons = null;
    let formData = {};

    // Initialize Stripe
    const stripeKey = '{{ env('STRIPE_KEY', '') }}';
    if (stripeKey && stripeKey !== 'pk_test_...') {
        stripe = Stripe(stripeKey);
        const elements = stripe.elements();
        cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        });
    }

    function updateStepper() {
        steps.forEach((step, index) => {
            step.classList.remove("active", "completed");
            if (index < currentStep) step.classList.add("completed");
            if (index === currentStep) step.classList.add("active");
        });

        contents.forEach((content, index) => {
            content.classList.toggle("active", index === currentStep);
        });

        prevBtn.disabled = currentStep === 0;
        
        if (currentStep === 0) {
            nextBtn.textContent = "Continue";
        } else if (currentStep === 1) {
            nextBtn.textContent = "Continue";
        } else if (currentStep === 2) {
            nextBtn.textContent = "Continue";
        } else if (currentStep === 3) {
            nextBtn.textContent = "Proceed to Payment";
        } else if (currentStep === 4) {
            nextBtn.textContent = "Pay Now";
        }
        
        // Update confirmation step when entering step 3
        if (currentStep === 3) {
            updateConfirmStep();
        }

        // Initialize payment sections on step 4
        if (currentStep === 4) {
            const paymentMethodRadio = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethodRadio) return;
            
            const paymentMethod = paymentMethodRadio.value;
            const stripeSection = document.getElementById('stripePaymentSection');
            const paypalSection = document.getElementById('paypalPaymentSection');
            
            if (paymentMethod === 'stripe') {
                stripeSection.style.display = 'block';
                paypalSection.style.display = 'none';
                nextBtn.style.display = 'block';
                nextBtn.textContent = 'Pay Now';
                if (cardElement && !cardElement._mounted) {
                    cardElement.mount('#card-element');
                    cardElement.on('change', function(event) {
                        const displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });
                }
            } else {
                stripeSection.style.display = 'none';
                paypalSection.style.display = 'block';
                nextBtn.style.display = 'none'; // Hide Pay Now button for PayPal
                initPayPal();
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
                createOrder: function(data, actions) {
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
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        submitForm('paypal', null, details.id);
                    });
                },
                onError: function(err) {
                    console.error('PayPal error:', err);
                    alert('An error occurred with PayPal. Please try again or select Stripe.');
                },
                onCancel: function(data) {
                    console.log('PayPal payment cancelled');
                }
            });
            
            paypalButtons.render('#paypal-button-container').catch(function(err) {
                console.error('PayPal render error:', err);
                paypalContainer.innerHTML = '<p class="text-danger">Failed to load PayPal button. Please select Stripe or refresh the page.</p>';
            });
        } catch (error) {
            console.error('PayPal initialization error:', error);
            paypalContainer.innerHTML = '<p class="text-danger">PayPal initialization failed. Please select Stripe or contact support.</p>';
        }
    }

    // Device model select handler
    const deviceModelSelect = document.getElementById('device_model_select');
    const deviceModelCustom = document.getElementById('device_model_custom');
    if (deviceModelSelect) {
        deviceModelSelect.addEventListener('change', function() {
            if (this.value === 'other') {
                deviceModelCustom.style.display = 'block';
                deviceModelCustom.required = true;
            } else {
                deviceModelCustom.style.display = 'none';
                deviceModelCustom.required = false;
            }
        });
    }

    // Issue checkbox handler
    const issueUnknown = document.getElementById('issue_unknown');
    const issueCheckboxes = document.querySelectorAll('.issue-checkbox');
    
    issueUnknown.addEventListener('change', function() {
        if (this.checked) {
            issueCheckboxes.forEach(cb => cb.checked = false);
            calculatePricing();
        }
    });
    
    issueCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (this.checked) {
                issueUnknown.checked = false;
            }
            calculatePricing();
        });
    });

    function calculatePricing() {
        const selectedIssues = Array.from(document.querySelectorAll('.issue-checkbox:checked')).map(cb => cb.value);
        const isUnknown = issueUnknown && issueUnknown.checked;
        const deviceTypeId = document.getElementById('device_type_id') ? document.getElementById('device_type_id').value : null;
        
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
                issue_unknown: isUnknown
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
        
        // Get selected issues
        const checkedIssues = document.querySelectorAll('.issue-checkbox:checked');
        formData.issues = Array.from(checkedIssues).map(cb => {
            const label = document.querySelector(`label[for="${cb.id}"]`);
            return label ? label.textContent.trim() : '';
        }).filter(issue => issue !== '');
        
        if (issueUnknown && issueUnknown.checked) {
            formData.issues = ['I don\'t know the issue'];
        }
        
        formData.comments = issueDescriptionEl ? issueDescriptionEl.value.trim() : '';
        if (!formData.comments) {
            formData.comments = 'None';
        }

        // Update confirmation display
        const confirmNameEl = document.getElementById('confirm_name');
        const confirmEmailEl = document.getElementById('confirm_email');
        const confirmPhoneEl = document.getElementById('confirm_phone');
        const confirmDeviceEl = document.getElementById('confirm_device');
        const confirmIssuesEl = document.getElementById('confirm_issues');
        const confirmCommentsEl = document.getElementById('confirm_comments');
        
        if (confirmNameEl) confirmNameEl.textContent = formData.name || 'Not provided';
        if (confirmEmailEl) confirmEmailEl.textContent = formData.email || 'Not provided';
        if (confirmPhoneEl) confirmPhoneEl.textContent = formData.phone || 'Not provided';
        if (confirmDeviceEl) confirmDeviceEl.textContent = formData.device || 'Not specified';
        if (confirmIssuesEl) confirmIssuesEl.textContent = formData.issues.length > 0 ? formData.issues.join(', ') : 'None';
        if (confirmCommentsEl) confirmCommentsEl.textContent = formData.comments || 'None';

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
            if (formData.total === undefined || formData.total === 0) {
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
            // Payment method selection - no validation needed, just ensure one is selected
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                alert('Please select a payment method.');
                return false;
            }
        }
        if (step === 4) {
            const address = document.getElementById('address').value.trim();
            if (!address) {
                alert('Please enter your shipping address.');
                return false;
            }
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
        
        // Get address
        const addressEl = document.getElementById('address');
        if (!addressEl || !addressEl.value.trim()) {
            alert('Please enter your shipping address.');
            return;
        }
        
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
        orderData.append('payment_method', paymentMethod);
        orderData.append('address', addressEl.value.trim());
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
        if (!validateStep(currentStep)) {
            return;
        }

        // Update confirmation step when moving to step 3
        if (currentStep === 2) {
            updateConfirmStep();
        }

        if (currentStep === 4) {
            // Payment step - only handle Stripe here, PayPal is handled by its button
            const paymentMethodRadio = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethodRadio) {
                alert('Please select a payment method.');
                return;
            }
            
            const paymentMethod = paymentMethodRadio.value;
            const addressEl = document.getElementById('address');
            const address = addressEl ? addressEl.value.trim() : '';
            
            if (!address) {
                alert('Please enter your shipping address.');
                return;
            }
            
            // Only process Stripe here - PayPal handles its own submission
            if (paymentMethod === 'stripe') {
                if (!stripe || !cardElement) {
                    alert('Stripe is not configured. Please contact support.');
                    return;
                }
                
                try {
                    const {token, error} = await stripe.createToken(cardElement);
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
            }
            // PayPal payment is handled by the PayPal button's onApprove callback
            return;
        }

        if (currentStep < steps.length - 1) {
            currentStep++;
            updateStepper();
            
            // Update confirmation step when entering step 3
            if (currentStep === 3) {
                updateConfirmStep();
            }
        }
    });

    prevBtn.addEventListener("click", () => {
        if (currentStep > 0) {
            currentStep--;
            updateStepper();
        }
    });

    // Payment method change handler
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const stripeSection = document.getElementById('stripePaymentSection');
            const paypalSection = document.getElementById('paypalPaymentSection');
            
            if (this.value === 'stripe') {
                stripeSection.style.display = 'block';
                paypalSection.style.display = 'none';
                if (currentStep === 4) {
                    nextBtn.style.display = 'block';
                    nextBtn.textContent = 'Pay Now';
                }
            } else {
                stripeSection.style.display = 'none';
                paypalSection.style.display = 'block';
                if (currentStep === 4) {
                    nextBtn.style.display = 'none'; // Hide Pay Now button for PayPal
                }
                initPayPal();
            }
        });
    });

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
</style>
@endsection
