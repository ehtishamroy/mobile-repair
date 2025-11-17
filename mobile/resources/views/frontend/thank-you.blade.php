@extends('frontend.layouts.app')

@section('title', 'Thank You - Order Confirmation')

@section('content')
<!-- Begin:: marketplace-navigation -->
<section class="marketplace-navigation">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb align-items-center gap-3 mb-0">
        <li class="breadcrumb-item">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Thank You</li>
      </ol>
    </nav>
  </div>
</section>
<!-- End:: marketplace-navigation -->

<section class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <!-- Success Message -->
      <div class="text-center mb-5">
        <div class="mb-4">
          <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
            <circle cx="40" cy="40" r="40" fill="#28a745" opacity="0.1"/>
            <path d="M40 20C28.9543 20 20 28.9543 20 40C20 51.0457 28.9543 60 40 60C51.0457 60 60 51.0457 60 40C60 28.9543 51.0457 20 40 20ZM35 47.5L27.5 40L29.75 37.75L35 43L50.25 27.75L52.5 30L35 47.5Z" fill="#28a745"/>
          </svg>
        </div>
        <h1 class="fw-600 text-heading mb-3">Thank You for Your Order!</h1>
        <p class="text-muted fs-16 mb-0">Your order has been received and is being processed.</p>
      </div>

      <!-- Order Details Card -->
      <div class="card-summary mb-4">
        <div class="card-total">
          <h5 class="fw-500 fs-18 mb-4">Order Details</h5>
          
          <div class="row mb-4">
            <div class="col-md-6 mb-3">
              <div class="d-flex flex-column">
                <span class="text-muted fs-14 mb-1">Order Number</span>
                <span class="text-heading fw-600 fs-16">{{ $order->order_number }}</span>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="d-flex flex-column">
                <span class="text-muted fs-14 mb-1">Order Date</span>
                <span class="text-heading fw-500 fs-14">{{ $order->created_at->format('F d, Y') }}</span>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="d-flex flex-column">
                <span class="text-muted fs-14 mb-1">Payment Status</span>
                <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }} fs-12">
                  {{ ucfirst($order->payment_status) }}
                </span>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="d-flex flex-column">
                <span class="text-muted fs-14 mb-1">Order Status</span>
                <span class="badge bg-{{ $order->statusBadge }} fs-12">
                  {{ ucfirst($order->status) }}
                </span>
              </div>
            </div>
          </div>

          <hr class="my-4" />

          <!-- Order Items -->
          <h6 class="fw-500 fs-16 mb-3">Order Items</h6>
          <div class="order-items mb-4">
            @foreach($order->items as $item)
            <div class="d-flex align-items-center mb-4">
              <img
                src="{{ ($item->product && $item->product->featured_image) ? asset('storage/' . $item->product->featured_image) : asset('front-assets/img/phone-1.svg') }}"
                alt="{{ $item->product_name }}"
                width="70"
                class="me-3 rounded"
              />
              <div class="flex-grow-1">
                <small class="fw-400 fs-14 mb-1 text-truncate text-wrap d-block">
                  {{ $item->product_name }}
                </small>
                @if($item->variant_data && !empty($item->variant_data))
                <small class="text-muted d-block mb-1">
                  @foreach($item->variant_data as $variantName => $variantValue)
                    {{ $variantName }}: {{ $variantValue }}@if(!$loop->last), @endif
                  @endforeach
                </small>
                @endif
                <div class="d-flex align-items-center">
                  <span class="fs-14 fw-400 text-muted-custom me-1">{{ $item->quantity }} x</span>
                  <span class="text-promo fw-500 fs-14">{{ $currencySymbol }}{{ number_format($item->price, 2) }}</span>
                </div>
              </div>
              <div class="text-end">
                <span class="text-heading fw-600 fs-16">{{ $currencySymbol }}{{ number_format($item->subtotal, 2) }}</span>
              </div>
            </div>
            @endforeach
          </div>

          <hr class="my-4" />

          <!-- Order Summary -->
          <ul class="totals-list list-unstyled mb-3">
            <li class="d-flex justify-content-between mb-2">
              <span>Sub-total</span>
              <span class="text-heading fw-500">{{ $currencySymbol }}{{ number_format($order->subtotal, 2) }}</span>
            </li>
            @if($order->discount > 0)
            <li class="d-flex justify-content-between mb-2">
              <span>Discount</span>
              <span class="text-heading fw-500">-{{ $currencySymbol }}{{ number_format($order->discount, 2) }}</span>
            </li>
            @endif
            @if($order->shipping_cost > 0)
            <li class="d-flex justify-content-between mb-2">
              <span>Shipping</span>
              <span class="text-heading fw-500">{{ $currencySymbol }}{{ number_format($order->shipping_cost, 2) }}</span>
            </li>
            @endif
            @if($order->tax > 0)
            <li class="d-flex justify-content-between mb-2">
              <span>VAT</span>
              <span class="text-heading fw-500">{{ $currencySymbol }}{{ number_format($order->tax, 2) }}</span>
            </li>
            @endif
          </ul>

          <hr class="my-3" />

          <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="text-heading fw-600">Total</span>
            <span class="fw-600 text-heading fs-18">{{ $currencySymbol }}{{ number_format($order->total, 2) }} {{ $settings->currency ?? 'GBP' }}</span>
          </div>
        </div>
      </div>

      <!-- Shipping & Billing Address -->
      <div class="row mb-4">
        <div class="col-md-6 mb-3">
          <div class="card-summary">
            <div class="card-total">
              <h6 class="fw-500 fs-16 mb-3">Shipping Address</h6>
              <p class="text-muted fs-14 mb-0">
                {{ $order->customer_name }}<br>
                {{ $order->shipping_address }}<br>
                {{ $order->city }}, {{ $order->state }}<br>
                {{ $order->zip_code }}<br>
                {{ $order->country }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="card-summary">
            <div class="card-total">
              <h6 class="fw-500 fs-16 mb-3">Billing Address</h6>
              <p class="text-muted fs-14 mb-0">
                {{ $order->customer_name }}<br>
                {{ $order->billing_address }}<br>
                {{ $order->city }}, {{ $order->state }}<br>
                {{ $order->zip_code }}<br>
                {{ $order->country }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="text-center mb-5">
        <a href="{{ route('frontend.track-order') }}" class="btn btn-gradient radius-3 me-3">
          Track Your Order
        </a>
        <a href="{{ route('frontend.marketplace') }}" class="btn btn-outline-secondary radius-3">
          Continue Shopping
        </a>
      </div>
    </div>
  </div>
</section>

@endsection

