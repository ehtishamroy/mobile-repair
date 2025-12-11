@extends('frontend.layouts.app')

@section('title', 'Booking Confirmed')

@section('content')
<section class="marketplace-navigation">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center gap-3 mb-0">
                <li class="breadcrumb-item">
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z"
                            stroke="#5F6C72"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Booking Confirmed
                </li>
            </ol>
        </nav>
    </div>
</section>
<!-- End:: marketplace-navigation -->

@if($order)
<section>
    <div class="container my-5">
        <div class="flex-center flex-column justify-content-center gap-3 mt-5 pt-5 mb-custom">
            <img src="{{ asset('front-assets/img/success-check.svg') }}" alt="" />
            <h3 class="fw-500 fs-24">Booking Confirmed!</h3>
            <p class="fw-400 fs-14 text-center">
                Thank you for your order. We've sent a confirmation email to <strong>{{ $order->customer_email }}</strong> with all the details.
            </p>
            
            <!-- Order Details -->
            <div class="card mt-4" style="max-width: 800px; width: 100%;">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 text-center">
                        <i class="fas fa-clipboard-check text-success me-2"></i>
                        Booking Details
                    </h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Order Number:</strong>
                            <p class="mb-0 fs-5 fw-bold text-primary-custom">#{{ $order->order_number }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Order Date:</strong>
                            <p class="mb-0">{{ $order->created_at->format('d M, Y g:i A') }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Delivery Method Section -->
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <strong class="text-muted">Delivery Method:</strong>
                            <p class="mb-0">
                                @if($order->delivery_method === 'visit')
                                    <span class="badge bg-primary fs-6 px-3 py-2">
                                        <i class="fas fa-store me-1"></i> Visit Us
                                    </span>
                                @else
                                    <span class="badge bg-info fs-6 px-3 py-2">
                                        <i class="fas fa-shipping-fast me-1"></i> Online Delivery
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Appointment Date/Time (for Visit Us) -->
                    @if($order->delivery_method === 'visit' && ($order->appointment_date || $order->appointment_time))
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="alert alert-info p-3 mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <strong>Appointment Scheduled:</strong>
                                <p class="mb-0 mt-2 fs-5 fw-semibold">
                                    @if($order->appointment_date)
                                        {{ \Carbon\Carbon::parse($order->appointment_date)->format('l, d F Y') }}
                                    @endif
                                    @if($order->appointment_time)
                                        @ 
                                        @php
                                            $timeSlots = [
                                                '09:00:00' => '9:00 AM - 12:00 PM',
                                                '12:00:00' => '12:00 PM - 3:00 PM',
                                                '15:00:00' => '3:00 PM - 6:00 PM',
                                            ];
                                            $timeDisplay = $timeSlots[$order->appointment_time] ?? $order->appointment_time;
                                        @endphp
                                        {{ $timeDisplay }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Service:</strong>
                            <p class="mb-0 fw-semibold">{{ $order->service->name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted">Device Model:</strong>
                            <p class="mb-0">{{ $order->device_model }}</p>
                        </div>
                    </div>
                    
                    @if($order->selected_issues && count($order->selected_issues) > 0)
                    <div class="mb-3">
                        <strong class="text-muted">Selected Issues:</strong>
                        <p class="mb-0">
                            @php
                                $issueNames = \App\Models\RepairIssue::whereIn('id', $order->selected_issues)->pluck('name')->toArray();
                            @endphp
                            @foreach($issueNames as $issueName)
                                <span class="badge bg-light text-dark border me-1 mb-1">{{ $issueName }}</span>
                            @endforeach
                        </p>
                    </div>
                    @else
                    <div class="mb-3">
                        <strong class="text-muted">Issue:</strong>
                        <p class="mb-0"><span class="badge bg-warning text-dark">Inspection Required</span></p>
                    </div>
                    @endif
                    
                    @if($order->qualityTier)
                    <div class="mb-3">
                        <strong class="text-muted">Quality/Part Type:</strong>
                        <p class="mb-0">
                            <span class="badge bg-success fs-6 px-3 py-2">{{ $order->qualityTier->name }}</span>
                            @if($order->qualityTier->price_modifier > 0)
                                <span class="text-muted ms-2">(+{{ $currencySymbol }}{{ number_format($order->qualityTier->price_modifier, 2) }})</span>
                            @endif
                        </p>
                    </div>
                    @endif
                    
                    @if($order->issue_description)
                    <div class="mb-3">
                        <strong class="text-muted">Additional Description:</strong>
                        <p class="mb-0 fst-italic">"{{ $order->issue_description }}"</p>
                    </div>
                    @endif
                    
                    <hr>
                    
                    <h6 class="mb-3"><i class="fas fa-user me-2"></i> Customer Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-2">
                            <strong class="text-muted">Name:</strong>
                            <p class="mb-0">{{ $order->customer_name }}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <strong class="text-muted">Email:</strong>
                            <p class="mb-0">{{ $order->customer_email }}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <strong class="text-muted">Phone:</strong>
                            <p class="mb-0">{{ $order->customer_phone }}</p>
                        </div>
                    </div>
                    
                    @if($order->address)
                    <div class="mb-3">
                        <strong class="text-muted">Shipping Address:</strong>
                        <p class="mb-0" style="white-space: pre-line;">{{ $order->address }}</p>
                    </div>
                    @endif
                    
                    <hr>
                    
                    <h6 class="mb-3"><i class="fas fa-receipt me-2"></i> Cost Summary</h6>
                    <div class="row">
                        <div class="col-12">
                            @if($order->subtotal > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Repair Cost:</span>
                                <span>{{ $currencySymbol }}{{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            @endif
                            @if($order->inspection_fee > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Inspection Fee:</span>
                                <span>{{ $currencySymbol }}{{ number_format($order->inspection_fee, 2) }}</span>
                            </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong class="fs-5">Total:</strong>
                                <strong class="fs-5 text-primary-custom">{{ $currencySymbol }}{{ number_format($order->total, 2) }}</strong>
                            </div>
                            
                            @if($order->total == 0)
                            <div class="alert alert-warning mt-3 mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Quote Request:</strong> The final cost will be provided after inspection at our store.
                            </div>
                            @endif
                            
                            @if($order->delivery_method === 'visit')
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Payment:</strong> {{ $order->total > 0 && $order->payment_intent_id ? 'Paid via Card' : 'Pay when you visit our store' }}
                            </div>
                            @else
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Payment Status:</strong> {{ $order->status === 'paid' ? 'Payment Successful' : 'Pending' }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Store Information for Visit Us -->
            @if($order->delivery_method === 'visit')
            <div class="card mt-4" style="max-width: 800px; width: 100%;">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 text-center">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        Store Location
                    </h5>
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-building text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="mb-0 fw-semibold">Unit-2, 260 Streatfield Road</p>
                            <p class="mb-0 text-muted">Harrow, London, HA3 9BY</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-phone text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="mb-0 fw-semibold"><a href="tel:+447503683786">+44 7503 683786</a></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-envelope text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="mb-0 fw-semibold"><a href="mailto:harrowmobiles@gmail.com">harrowmobiles@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="flex-center gap-3 mt-4">
                <a href="{{ route('frontend.marketplace') }}" class="btn-gradient-outline py-3 flex-center gap-3 text-decoration-none">
                    <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0_110_9672)">
                            <path
                                d="M2.5 13.75L10 18.125L17.5 13.75"
                                stroke="#5B265D"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M2.5 10L10 14.375L17.5 10"
                                stroke="#5B265D"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M2.5 6.25L10 10.625L17.5 6.25L10 1.875L2.5 6.25Z"
                                stroke="#5B265D"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0_110_9672">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    Go to Marketplace
                </a>
            </div>
        </div>
    </div>
</section>
@else
<section>
    <div class="container my-5">
        <div class="flex-center flex-column justify-content-center gap-3 mt-5 pt-5 mb-custom">
            <img src="{{ asset('front-assets/img/success-check.svg') }}" alt="" />
            <h3 class="fw-500 fs-24">Booking Request Received</h3>
            <p class="fw-400 fs-14 text-center" style="max-width: 600px;">
                Thank you for your booking request. We couldn't find specific order details to display, 
                but if you completed the booking, a confirmation email should have been sent to you with your booking reference number.
            </p>
            
            <div class="alert alert-info text-center" style="max-width: 600px;">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Important:</strong> Please check your email inbox (and spam folder) for your booking confirmation with detailed order information.
            </div>
            
            <!-- Contact Card -->
            <div class="card mt-3" style="max-width: 600px; width: 100%;">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 text-center">
                        <i class="fas fa-question-circle text-primary me-2"></i>
                        Need Assistance?
                    </h5>
                    <div class="row text-center">
                        <div class="col-md-6 mb-3">
                            <i class="fas fa-phone text-muted mb-2" style="font-size: 1.5rem;"></i>
                            <p class="mb-0 fw-semibold"><a href="tel:+447503683786">+44 7503 683786</a></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <i class="fas fa-envelope text-muted mb-2" style="font-size: 1.5rem;"></i>
                            <p class="mb-0 fw-semibold"><a href="mailto:harrowmobiles@gmail.com">harrowmobiles@gmail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex-center gap-3 mt-4">
                <a href="{{ route('frontend.book-repair') }}" class="btn-gradient py-3 px-4 text-white text-decoration-none rounded">
                    <i class="fas fa-tools me-2"></i> Book a New Repair
                </a>
                <a href="{{ route('frontend.marketplace') }}" class="btn-gradient-outline py-3 flex-center gap-3 text-decoration-none">
                    Go to Marketplace
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
