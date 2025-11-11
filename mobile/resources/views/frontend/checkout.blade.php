@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')
<!-- Begin:: marketplace-header -->
<div class="marketplace-header py-3">
  <div class="container flex-center flex-wrap gap-3">
    <div class="dropdown">
      <button
        class="btn dropdown-toggle category-btn"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        All Category
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Mobiles</a></li>
        <li><a class="dropdown-item" href="#">Laptops</a></li>
        <li><a class="dropdown-item" href="#">Accessories</a></li>
      </ul>
    </div>

    <div class="d-flex align-items-center gap-4 text-muted">
      <a href="{{ route('frontend.track-order') }}" class="top-link d-flex align-items-center gap-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.25 21.75H18.75" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M19.5 9.75C19.5 16.5 12 21.75 12 21.75C12 21.75 4.5 16.5 4.5 9.75C4.5 7.76088 5.29018 5.85322 6.6967 4.4467C8.10322 3.04018 10.0109 2.25 12 2.25C13.9891 2.25 15.8968 3.04018 17.3033 4.4467C18.7098 5.85322 19.5 7.76088 19.5 9.75V9.75Z" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12 12.75C13.6569 12.75 15 11.4069 15 9.75C15 8.09315 13.6569 6.75 12 6.75C10.3431 6.75 9 8.09315 9 9.75C9 11.4069 10.3431 12.75 12 12.75Z" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Track Order
      </a>
      <a href="{{ route('frontend.contact') }}" class="top-link d-flex align-items-center gap-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M21.1406 12.7503H18.1406C17.7428 12.7503 17.3613 12.9083 17.08 13.1897C16.7987 13.471 16.6406 13.8525 16.6406 14.2503V18.0003C16.6406 18.3981 16.7987 18.7797 17.08 19.061C17.3613 19.3423 17.7428 19.5003 18.1406 19.5003H19.6406C20.0384 19.5003 20.42 19.3423 20.7013 19.061C20.9826 18.7797 21.1406 18.3981 21.1406 18.0003V12.7503ZM21.1406 12.7503C21.1407 11.5621 20.9054 10.3856 20.4484 9.28875C19.9915 8.1919 19.3218 7.1964 18.4781 6.35969C17.6344 5.52297 16.6334 4.86161 15.5328 4.41375C14.4322 3.96589 13.2538 3.74041 12.0656 3.75031C10.8782 3.74165 9.70083 3.96805 8.60132 4.41647C7.5018 4.86488 6.50189 5.52645 5.6592 6.36304C4.81651 7.19963 4.1477 8.19471 3.69131 9.29094C3.23492 10.3872 2.99997 11.5629 3 12.7503V18.0003C3 18.3981 3.15804 18.7797 3.43934 19.061C3.72064 19.3423 4.10218 19.5003 4.5 19.5003H6C6.39782 19.5003 6.77936 19.3423 7.06066 19.061C7.34196 18.7797 7.5 18.3981 7.5 18.0003V14.2503C7.5 13.8525 7.34196 13.471 7.06066 13.1897C6.77936 12.9083 6.39782 12.7503 6 12.7503H3" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Customer Support
      </a>
      <a href="{{ route('frontend.contact') }}" class="top-link d-flex align-items-center gap-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M11.25 11.25H12V16.5H12.75" stroke="#5F6C72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M11.8125 7.5C12.0196 7.5 12.1875 7.66789 12.1875 7.875C12.1875 8.08211 12.0196 8.25 11.8125 8.25C11.6054 8.25 11.4375 8.08211 11.4375 7.875C11.4375 7.66789 11.6054 7.5 11.8125 7.5Z" fill="#191C1F" stroke="#5F6C72" stroke-width="1.5"/>
        </svg>
        Need Help
      </a>
    </div>
  </div>
</div>
<!-- End:: marketplace-header -->

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
        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
      </ol>
    </nav>
  </div>
</section>
<!-- End:: marketplace-navigation -->

<section class="container my-5">
  <div class="row">
    <div class="col-lg-8">
      <section class="checkout-main">
        <h3 class="fw-500 fs-18 mb-4">Billing Information</h3>
        <form id="checkoutForm" action="{{ route('frontend.checkout.process') }}" method="POST">
          @csrf
          <input type="hidden" name="payment_method" id="payment_method" value="">
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
              <input type="text" class="custom-input" placeholder="First name" name="first_name" id="first_name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
              <input type="text" class="custom-input" placeholder="Last name" name="last_name" id="last_name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="company_name" class="form-label">Company Name <span class="text-muted">(Optional)</span></label>
              <input type="text" class="custom-input" placeholder="Company name" name="company_name" id="company_name">
            </div>
            <div class="col-md-6 mb-3">
              <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" class="custom-input" placeholder="your@email.com" name="email" id="email" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
              <input type="tel" class="custom-input" placeholder="+44 20 1234 5678" name="phone" id="phone" required>
            </div>
            <div class="col-12 mb-3">
              <label for="address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
              <input type="text" class="custom-input" placeholder="House number and street name" name="address_line_1" id="address_line_1" required>
            </div>
            <div class="col-12 mb-3">
              <label for="address_line_2" class="form-label">Address Line 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="custom-input" placeholder="Apartment, suite, unit, etc." name="address_line_2" id="address_line_2">
            </div>
            <div class="col-md-6 mb-3">
              <label for="city" class="form-label">Town/City <span class="text-danger">*</span></label>
              <input type="text" class="custom-input" placeholder="City" name="city" id="city" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="county" class="form-label">County <span class="text-danger">*</span></label>
              <input type="text" class="custom-input" placeholder="County" name="county" id="county" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="postcode" class="form-label">Postcode <span class="text-danger">*</span></label>
              <input type="text" class="custom-input" placeholder="SW1A 1AA" name="postcode" id="postcode" required pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}">
            </div>
            <div class="col-md-6 mb-3">
              <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
              <select name="country" id="country" class="custom-select" required>
                <option value="GB" selected>United Kingdom</option>
              </select>
            </div>
            <div class="col-12 mb-3">
              <div class="flex-center gap-2">
                <div class="custom-check">
                  <input type="checkbox" class="form-check-input" name="ship_to_different_address" id="ship_to_different_address">
                  <label for="ship_to_different_address" class="form-label mb-0">Ship to a different address</label>
                </div>
              </div>
            </div>
            
            <!-- Shipping Address (Hidden by default) -->
            <div id="shippingAddressSection" class="col-12" style="display: none;">
              <h4 class="fw-500 fs-16 mb-3 mt-3">Shipping Address</h4>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="shipping_first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="custom-input" placeholder="First name" name="shipping_first_name" id="shipping_first_name">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping_last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="custom-input" placeholder="Last name" name="shipping_last_name" id="shipping_last_name">
                </div>
                <div class="col-12 mb-3">
                  <label for="shipping_address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                  <input type="text" class="custom-input" placeholder="House number and street name" name="shipping_address_line_1" id="shipping_address_line_1">
                </div>
                <div class="col-12 mb-3">
                  <label for="shipping_address_line_2" class="form-label">Address Line 2 <span class="text-muted">(Optional)</span></label>
                  <input type="text" class="custom-input" placeholder="Apartment, suite, unit, etc." name="shipping_address_line_2" id="shipping_address_line_2">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping_city" class="form-label">Town/City <span class="text-danger">*</span></label>
                  <input type="text" class="custom-input" placeholder="City" name="shipping_city" id="shipping_city">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping_county" class="form-label">County <span class="text-danger">*</span></label>
                  <input type="text" class="custom-input" placeholder="County" name="shipping_county" id="shipping_county">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping_postcode" class="form-label">Postcode <span class="text-danger">*</span></label>
                  <input type="text" class="custom-input" placeholder="SW1A 1AA" name="shipping_postcode" id="shipping_postcode">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="shipping_country" class="form-label">Country <span class="text-danger">*</span></label>
                  <select name="shipping_country" id="shipping_country" class="custom-select">
                    <option value="GB" selected>United Kingdom</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="payment-option mb-4">
            <h3 class="fw-500 fs-18 p-3">Payment Option</h3>
            <hr class="mt-0" />
            <div class="p-3">
              <div class="row text-center border-bottom mb-3">
                <div class="col-md-6">
                  <div class="py-3 flex-center flex-column gap-2 border-end payment-option-item" data-payment="stripe">
                    <img src="{{ asset('front-assets/img/CreditCard.svg') }}" alt="Stripe" style="height: 40px;">
                    <label class="form-label fw-500 w-100">Stripe</label>
                    <input type="radio" name="payment_method_radio" value="stripe" class="custom-radio" checked>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="py-3 flex-center flex-column gap-2 payment-option-item" data-payment="paypal">
                    <img src="{{ asset('front-assets/img/paypal.svg') }}" alt="PayPal" style="height: 40px;">
                    <label class="form-label fw-500 w-100">PayPal</label>
                    <input type="radio" name="payment_method_radio" value="paypal" class="custom-radio">
                  </div>
                </div>
              </div>
            </div>

            <!-- Stripe Card Details -->
            <div id="stripePaymentSection" class="p-3">
              <div class="mb-3">
                <label class="form-label">Name on Card</label>
                <input type="text" class="custom-input" placeholder="Enter name on card" id="cardholder_name" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Card Number</label>
                <div id="card-element" class="custom-input" style="padding: 0.75rem;">
                  <!-- Stripe Elements will create form elements here -->
                </div>
                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
              </div>
            </div>

            <!-- PayPal Button -->
            <div id="paypalPaymentSection" class="p-3" style="display: none;">
              <div id="paypal-button-container"></div>
            </div>
          </div>

          <div class="additional-information">
            <h3 class="fw-500 fs-18 p-3">Additional Information</h3>
            <div class="p-3">
              <label for="order_notes" class="form-label">Order Notes <span class="text-muted">(Optional)</span></label>
              <textarea name="order_notes" rows="5" class="w-100 custom-input" placeholder="Notes about your order, e.g. special notes for delivery" id="order_notes" style="resize: vertical;"></textarea>
            </div>
          </div>
        </form>
      </section>
    </div>
    
    <div class="col-lg-4">
      <div class="card-summary">
        <div class="card-total">
          <h5 class="fw-500 fs-18 mb-3">Order Summary</h5>

          <div class="order-items">
            @foreach($cartItems as $item)
            <div class="d-flex align-items-center mb-4">
              <img
                src="{{ $item['featured_image'] ? asset('storage/' . $item['featured_image']) : asset('front-assets/img/phone-1.svg') }}"
                alt="{{ $item['name'] }}"
                width="70"
                class="me-3 rounded"
              />
              <div class="flex-grow-1">
                <small class="fw-400 fs-14 mb-1 text-truncate text-wrap d-block">
                  {{ $item['name'] }}
                </small>
                @if(!empty($item['variants']))
                <small class="text-muted d-block mb-1">
                  @foreach($item['variants'] as $variantName => $variantValue)
                    {{ $variantName }}: {{ $variantValue }}@if(!$loop->last), @endif
                  @endforeach
                </small>
                @endif
                <div class="d-flex align-items-center">
                  <span class="fs-14 fw-400 text-muted-custom me-1">{{ $item['quantity'] }} x</span>
                  <span class="text-promo fw-500 fs-14">{{ $currencySymbol }}{{ number_format($item['price'], 2) }}</span>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <ul class="totals-list list-unstyled mb-3">
            <li class="d-flex justify-content-between mb-2">
              <span>Sub-total</span>
              <span class="text-heading fw-500">{{ $currencySymbol }}{{ number_format($subtotal, 2) }}</span>
            </li>
            @if($discount > 0)
            <li class="d-flex justify-content-between mb-2">
              <span>Discount</span>
              <span class="text-heading fw-500">-{{ $currencySymbol }}{{ number_format($discount, 2) }}</span>
            </li>
            @endif
            @if($tax > 0)
            <li class="d-flex justify-content-between mb-2">
              <span>VAT</span>
              <span class="text-heading fw-500">{{ $currencySymbol }}{{ number_format($tax, 2) }}</span>
            </li>
            @endif
          </ul>

          <div class="coupon-box mb-3">
            <h6 class="fw-500 fs-16 mb-3">Coupon Code</h6>
            @if($appliedCoupon)
            <div class="alert alert-success mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <span><strong>Applied:</strong> {{ $appliedCoupon }}</span>
                <button type="button" class="btn btn-sm btn-link text-danger p-0" id="checkoutRemoveCouponBtn">
                  <i class="bi bi-x-circle"></i> Remove
                </button>
              </div>
            </div>
            @endif
            <div class="coupon-form">
              <input
                type="text"
                class="custom-input mb-3"
                id="checkoutCouponCode"
                placeholder="Enter coupon code"
                value="{{ $appliedCoupon ?? '' }}"
                {{ $appliedCoupon ? 'disabled' : '' }}
              />
              @if(!$appliedCoupon)
              <button class="btn btn-gradient w-100" id="checkoutApplyCouponBtn">Apply Coupon</button>
              @endif
            </div>
          </div>

          <hr class="my-3" />

          <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="text-heading">Total</span>
            <span class="fw-600 text-heading fs-16">{{ $currencySymbol }}{{ number_format($total, 2) }} {{ $settings->currency ?? 'GBP' }}</span>
          </div>

          <button type="submit" form="checkoutForm" class="btn btn-gradient radius-3 w-100" id="placeOrderBtn">
            Place order <i class="bi bi-arrow-right ms-2"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<!-- Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<!-- PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID', 'YOUR_PAYPAL_CLIENT_ID') }}&currency=GBP&intent=capture"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const stripeKey = '{{ env('STRIPE_KEY', 'pk_test_...') }}';
  if (!stripeKey || stripeKey === 'pk_test_...') {
    console.warn('Stripe key not configured. Please set STRIPE_KEY in your .env file.');
  }
  
  const stripe = Stripe(stripeKey);
  const elements = stripe.elements();
  const cardElement = elements.create('card', {
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
  
  cardElement.mount('#card-element');
  
  const cardErrors = document.getElementById('card-errors');
  cardElement.on('change', ({error}) => {
    if (error) {
      cardErrors.textContent = error.message;
    } else {
      cardErrors.textContent = '';
    }
  });

  // Payment method selection
  const paymentRadios = document.querySelectorAll('input[name="payment_method_radio"]');
  const stripeSection = document.getElementById('stripePaymentSection');
  const paypalSection = document.getElementById('paypalPaymentSection');
  const paymentMethodInput = document.getElementById('payment_method');
  
  paymentRadios.forEach(radio => {
    radio.addEventListener('change', function() {
      paymentMethodInput.value = this.value;
      
      if (this.value === 'stripe') {
        stripeSection.style.display = 'block';
        paypalSection.style.display = 'none';
        document.getElementById('cardholder_name').required = true;
      } else if (this.value === 'paypal') {
        stripeSection.style.display = 'none';
        paypalSection.style.display = 'block';
        document.getElementById('cardholder_name').required = false;
        initPayPal();
      }
    });
  });
  
  // Set default payment method
  paymentMethodInput.value = 'stripe';
  
  // Ship to different address toggle
  document.getElementById('ship_to_different_address').addEventListener('change', function() {
    const shippingSection = document.getElementById('shippingAddressSection');
    if (this.checked) {
      shippingSection.style.display = 'block';
      document.querySelectorAll('#shippingAddressSection input[required], #shippingAddressSection select[required]').forEach(el => {
        el.setAttribute('required', 'required');
      });
    } else {
      shippingSection.style.display = 'none';
      document.querySelectorAll('#shippingAddressSection input, #shippingAddressSection select').forEach(el => {
        el.removeAttribute('required');
      });
    }
  });
  
  // PayPal initialization
  let paypalButtons;
  function initPayPal() {
    if (paypalButtons) return;
    
    const paypalClientId = '{{ env('PAYPAL_CLIENT_ID', '') }}';
    if (!paypalClientId || paypalClientId === 'YOUR_PAYPAL_CLIENT_ID') {
      document.getElementById('paypal-button-container').innerHTML = '<p class="text-danger">PayPal is not configured. Please set PAYPAL_CLIENT_ID in your .env file.</p>';
      return;
    }
    
    paypalButtons = paypal.Buttons({
      createOrder: function(data, actions) {
        return fetch('{{ route('frontend.checkout.create-paypal-order') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify({
            total: {{ $total }},
            currency: 'GBP'
          })
        })
        .then(response => response.json())
        .then(data => data.id);
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          // Submit form with PayPal payment ID
          const form = document.getElementById('checkoutForm');
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'paypal_order_id';
          input.value = data.orderID;
          form.appendChild(input);
          form.submit();
        });
      },
      onError: function(err) {
        console.error('PayPal error:', err);
        alert('An error occurred with PayPal. Please try again.');
      }
    });
    
    paypalButtons.render('#paypal-button-container');
  }
  
  // Form submission
  document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const paymentMethod = paymentMethodInput.value;
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    placeOrderBtn.disabled = true;
    placeOrderBtn.innerHTML = 'Processing...';
    
    if (paymentMethod === 'stripe') {
      const {token, error} = await stripe.createToken(cardElement, {
        name: document.getElementById('cardholder_name').value
      });
      
      if (error) {
        cardErrors.textContent = error.message;
        placeOrderBtn.disabled = false;
        placeOrderBtn.innerHTML = 'Place order <i class="bi bi-arrow-right ms-2"></i>';
        return;
      }
      
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'stripe_token';
      input.value = token.id;
      this.appendChild(input);
    }
    
    this.submit();
  });
  
  // Payment option styling
  document.querySelectorAll('.payment-option-item').forEach(item => {
    item.addEventListener('click', function() {
      const radio = this.querySelector('input[type="radio"]');
      if (radio) {
        radio.checked = true;
        radio.dispatchEvent(new Event('change'));
      }
    });
  });

  // Coupon functionality
  const checkoutApplyCouponBtn = document.getElementById('checkoutApplyCouponBtn');
  const checkoutRemoveCouponBtn = document.getElementById('checkoutRemoveCouponBtn');
  const checkoutCouponInput = document.getElementById('checkoutCouponCode');

  if (checkoutApplyCouponBtn) {
    checkoutApplyCouponBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const code = checkoutCouponInput.value.trim().toUpperCase();

      if (!code) {
        alert('Please enter a coupon code.');
        return;
      }

      fetch('{{ route("frontend.coupon.validate") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ code })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert(data.message || 'Invalid coupon code.');
        }
      })
      .catch(error => {
        console.error('Coupon apply error:', error);
        alert('An error occurred. Please try again.');
      });
    });
  }

  if (checkoutRemoveCouponBtn) {
    checkoutRemoveCouponBtn.addEventListener('click', function () {
      fetch('{{ route("frontend.coupon.remove") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        }
      })
      .catch(error => {
        console.error('Coupon remove error:', error);
      });
    });
  }

  if (checkoutCouponInput) {
    checkoutCouponInput.addEventListener('keypress', function (e) {
      if (e.key === 'Enter' && checkoutApplyCouponBtn) {
        e.preventDefault();
        checkoutApplyCouponBtn.click();
      }
    });
  }
});
</script>

<style>
.payment-option-item {
  cursor: pointer;
  transition: background-color 0.2s;
}
.payment-option-item:hover {
  background-color: #f8f9fa;
}
.payment-option-item input[type="radio"]:checked + label,
.payment-option-item:has(input[type="radio"]:checked) {
  background-color: #f0f0f0;
}
#card-element {
  border: 1px solid transparent;
  border-radius: 0.5rem;
  padding: 0.75rem;
  background: #f6f6f6;
}
#card-element .StripeElement {
  background: transparent;
}
</style>
@endpush

@endsection
