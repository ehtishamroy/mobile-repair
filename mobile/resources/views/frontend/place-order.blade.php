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
                    <h5 class="card-title mb-4">Order Details</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Order Number:</strong>
                            <p class="mb-0">#{{ $order->order_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Order Date:</strong>
                            <p class="mb-0">{{ $order->created_at->format('d M, Y g:i A') }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Service:</strong>
                            <p class="mb-0">{{ $order->service->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Device Model:</strong>
                            <p class="mb-0">{{ $order->device_model }}</p>
                        </div>
                    </div>
                    
                    @if($order->selected_issues && count($order->selected_issues) > 0)
                    <div class="mb-3">
                        <strong>Selected Issues:</strong>
                        <p class="mb-0">
                            @php
                                $issueNames = \App\Models\RepairIssue::whereIn('id', $order->selected_issues)->pluck('name')->toArray();
                            @endphp
                            {{ implode(', ', $issueNames) }}
                        </p>
                    </div>
                    @else
                    <div class="mb-3">
                        <strong>Issue:</strong>
                        <p class="mb-0">Inspection Required</p>
                    </div>
                    @endif
                    
                    @if($order->issue_description)
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p class="mb-0">{{ $order->issue_description }}</p>
                    </div>
                    @endif
                    
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Customer Name:</strong>
                            <p class="mb-0">{{ $order->customer_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong>
                            <p class="mb-0">{{ $order->customer_phone }}</p>
                        </div>
                    </div>
                    
                    @if($order->address)
                    <div class="mb-3">
                        <strong>Shipping Address:</strong>
                        <p class="mb-0" style="white-space: pre-line;">{{ $order->address }}</p>
                    </div>
                    @endif
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Repair Cost:</span>
                                <span>{{ $currencySymbol }}{{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            @if($order->inspection_fee > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Inspection Fee:</span>
                                <span>{{ $currencySymbol }}{{ number_format($order->inspection_fee, 2) }}</span>
                            </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong>{{ $currencySymbol }}{{ number_format($order->total, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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
            <h3 class="fw-500 fs-24">Booking Confirmed</h3>
            <p class="fw-400 fs-14 text-center">
                Thank you for your booking. A confirmation email has been sent to you.
            </p>
            <div class="flex-center gap-3 mt-4">
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
