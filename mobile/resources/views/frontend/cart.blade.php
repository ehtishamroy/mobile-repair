@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

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
              Shopping Card
            </li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <section class="container my-5">
      <div class="row">
        <div class="col-lg-8">
          <div class="product-table">
            <div class="bg-white px-4 pb-2">
              <h5 class="mb-3 fw-500 fs-18">Shopping Card</h5>
            </div>

            <div class="table-responsive">
              <table class="table align-middle mb-0 text-center">
                <thead>
                  <tr>
                    <th scope="col" class="text-start ps-4">PRODUCTS</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub-Total</th>
                  </tr>
                </thead>
                <tbody id="cartItemsBody">
                  @forelse($cartItems as $item)
                  <tr data-product-id="{{ $item['id'] }}" data-cart-key="{{ $item['cart_key'] }}">
                    <td>
                      <div class="flex-center gap-1">
                        <button class="btn btn-link text-muted p-0 remove-cart-item" data-cart-key="{{ $item['cart_key'] }}" data-product-id="{{ $item['id'] }}" title="Remove from cart">
                          <i class="bi bi-x-circle fs-5"></i>
                        </button>
                        <a href="{{ route('frontend.product-detail', $item['slug']) }}">
                          <img
                            src="{{ $item['featured_image'] ? asset('storage/' . $item['featured_image']) : asset('front-assets/img/phone-1.svg') }}"
                            alt="{{ $item['name'] }}"
                            class="product-img"
                          />
                        </a>
                        <p class="text-start mb-0">
                          <a href="{{ route('frontend.product-detail', $item['slug']) }}" class="text-decoration-none text-heading">
                            {{ $item['name'] }}
                          </a>
                          @if(!empty($item['variants']))
                          <br>
                          <small class="text-muted">
                            @foreach($item['variants'] as $variantName => $variantValue)
                              <span class="d-inline-block me-2">
                                <strong>{{ $variantName }}:</strong> {{ $variantValue }}
                              </span>
                            @endforeach
                          </small>
                          @endif
                        </p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2 justify-content-center">
                        @if($item['compare_at_price'])
                        <span class="text-decoration-line-through text-muted">
                          {{ $currencySymbol }}{{ number_format($item['compare_at_price'], 2) }}
                        </span>
                        @endif
                        <span class="original-price">{{ $currencySymbol }}{{ number_format($item['price'], 2) }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="product-quantity">
                        <button class="btn-minus" data-cart-key="{{ $item['cart_key'] }}">-</button>
                        <span class="quantity-value" data-cart-key="{{ $item['cart_key'] }}">{{ str_pad($item['quantity'], 2, '0', STR_PAD_LEFT) }}</span>
                        <button class="btn-plus" data-cart-key="{{ $item['cart_key'] }}">+</button>
                      </div>
                    </td>
                    <td class="item-subtotal" data-cart-key="{{ $item['cart_key'] }}">
                      {{ $currencySymbol }}{{ number_format($item['subtotal'], 2) }}
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center py-5">
                      <p class="text-muted mb-3">Your cart is empty.</p>
                      <a href="{{ route('frontend.marketplace') }}" class="btn btn-gradient">
                        Continue Shopping
                      </a>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <hr />
            <div class="flex-between px-3">
              <a href="{{ route('frontend.marketplace') }}" class="btn-gradient-outline text-promo border-promo py-3 fw-600 text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i> Return to Shop
              </a>
              @if(count($cartItems) > 0)
              <button
                class="btn-gradient-outline text-promo border-promo py-3 fw-600"
                id="updateCartBtn"
              >
                Update cart
              </button>
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          @if(count($cartItems) > 0)
          <div class="card-summary">
            <div class="card-total">
              <h5 class="fw-500 fs-18 mb-3">Card Totals</h5>

              <ul class="totals-list list-unstyled mb-3">
                <li class="d-flex justify-content-between mb-2">
                  <span>Sub-total</span>
                  <span class="text-heading fw-500" id="cartSubtotal">{{ $currencySymbol }}{{ number_format($subtotal, 2) }}</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <span>Discount</span>
                  <span class="text-heading fw-500" id="cartDiscount">
                    @if($discount > 0)
                      -{{ $currencySymbol }}{{ number_format($discount, 2) }}
                    @else
                      {{ $currencySymbol }}0.00
                    @endif
                  </span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <span>Tax</span>
                  <span class="text-heading fw-500" id="cartTax">
                    @if($tax > 0)
                      {{ $currencySymbol }}{{ number_format($tax, 2) }}
                    @else
                      {{ $currencySymbol }}0.00
                    @endif
                  </span>
                </li>
              </ul>

              <hr class="my-3" />

              <div
                class="d-flex justify-content-between align-items-center mb-4"
              >
                <span class="text-heading">Total</span>
                <span class="fw-600 text-heading fs-16" id="cartTotal">{{ $currencySymbol }}{{ number_format($total, 2) }} {{ $settings->currency ?? 'USD' }}</span>
              </div>

              <a href="{{ route('frontend.checkout') }}" class="btn btn-gradient w-100 text-decoration-none">
                PROCEED TO CHECKOUT <i class="bi bi-arrow-right ms-2"></i>
              </a>
            </div>

            <div class="coupon-box mt-4">
              <h5 class="text-heading fw-500 fs-18 mb-3">Coupon Code</h5>
              @if($appliedCoupon)
              <div class="alert alert-success mb-3">
                <div class="d-flex justify-content-between align-items-center">
                  <span><strong>Applied:</strong> {{ $appliedCoupon }}</span>
                  <button type="button" class="btn btn-sm btn-link text-danger p-0" id="removeCouponBtn">
                    <i class="bi bi-x-circle"></i> Remove
                  </button>
                </div>
              </div>
              @endif
              <div class="coupon-form">
                <input
                  type="text"
                  class="form-control mb-3"
                  id="couponCode"
                  placeholder="Enter coupon code"
                  value="{{ $appliedCoupon ?? '' }}"
                  {{ $appliedCoupon ? 'disabled' : '' }}
                />
                @if(!$appliedCoupon)
                <button class="btn btn-danger w-100" id="applyCouponBtn">APPLY COUPON</button>
                @endif
              </div>
            </div>
          </div>
          @else
          <div class="card-summary">
            <div class="card-total text-center py-4">
              <p class="text-muted mb-3">Your cart is empty.</p>
              <a href="{{ route('frontend.marketplace') }}" class="btn btn-gradient">
                Continue Shopping
              </a>
            </div>
          </div>
          @endif
        </div>
      </div>
    </section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const currencySymbol = '{{ $currencySymbol }}';
  
  // Quantity controls
  document.querySelectorAll(".product-quantity").forEach((qty) => {
    const valueEl = qty.querySelector(".quantity-value");
    const plusBtn = qty.querySelector(".btn-plus");
    const minusBtn = qty.querySelector(".btn-minus");
    const cartKey = valueEl.getAttribute('data-cart-key');
    const productId = valueEl.closest('tr').getAttribute('data-product-id');

    plusBtn.addEventListener("click", () => {
      let value = parseInt(valueEl.textContent);
      if (value < 99) {
        updateCartQuantity(cartKey, productId, value + 1);
      }
    });

    minusBtn.addEventListener("click", () => {
      let value = parseInt(valueEl.textContent);
      if (value > 1) {
        updateCartQuantity(cartKey, productId, value - 1);
      }
    });
  });

  // Remove item
  document.querySelectorAll('.remove-cart-item').forEach(btn => {
    btn.addEventListener('click', function() {
      const cartKey = this.getAttribute('data-cart-key');
      const productId = this.getAttribute('data-product-id');
      removeCartItem(cartKey, productId);
    });
  });

  // Update cart function
  function updateCartQuantity(cartKey, productId, quantity) {
    fetch(`{{ url('/cart/update') }}/${productId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        updateCartDisplay();
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  function removeCartItem(cartKey, productId) {
    if (!confirm('Are you sure you want to remove this item from your cart?')) {
      return;
    }

    fetch(`{{ url('/cart/remove') }}/${productId}`, {
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
        // Remove row from table
        const row = document.querySelector(`tr[data-cart-key="${cartKey}"]`);
        if (row) {
          row.remove();
        }
        updateCartDisplay();
        
        // Reload page if cart is empty
        fetch('{{ route("frontend.cart.get") }}')
          .then(response => response.json())
          .then(data => {
            if (data.cart_count === 0) {
              location.reload();
            }
          });
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  function updateCartDisplay() {
    fetch('{{ route("frontend.cart.get") }}', {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update all quantity displays
        data.cart.forEach(item => {
          const qtyEl = document.querySelector(`.quantity-value[data-cart-key="${item.cart_key}"]`);
          if (qtyEl) {
            qtyEl.textContent = item.quantity.toString().padStart(2, '0');
          }
          
          const subtotalEl = document.querySelector(`.item-subtotal[data-cart-key="${item.cart_key}"]`);
          if (subtotalEl) {
            subtotalEl.textContent = data.currency_symbol + parseFloat(item.subtotal).toFixed(2);
          }
        });

        // Reload page to update totals with coupon
        location.reload();
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  // Update cart button
  const updateCartBtn = document.getElementById('updateCartBtn');
  if (updateCartBtn) {
    updateCartBtn.addEventListener('click', function() {
      // Get all quantities and update them
      const quantities = {};
      document.querySelectorAll('.quantity-value').forEach(el => {
        const cartKey = el.getAttribute('data-cart-key');
        const productId = el.closest('tr').getAttribute('data-product-id');
        const quantity = parseInt(el.textContent);
        quantities[productId] = { cartKey: cartKey, quantity: quantity };
      });

      // Update each item
      let updatePromises = [];
      Object.keys(quantities).forEach(productId => {
        updatePromises.push(
          fetch(`{{ url('/cart/update') }}/${productId}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ quantity: quantities[productId].quantity })
          })
        );
      });

      Promise.all(updatePromises).then(() => {
        updateCartDisplay();
      });
    });
  }

  // Coupon functionality
  const applyCouponBtn = document.getElementById('applyCouponBtn');
  const removeCouponBtn = document.getElementById('removeCouponBtn');
  const couponCodeInput = document.getElementById('couponCode');

  if (applyCouponBtn) {
    applyCouponBtn.addEventListener('click', function() {
      const code = couponCodeInput.value.trim().toUpperCase();
      
      if (!code) {
        alert('Please enter a coupon code');
        return;
      }

      fetch('{{ route("frontend.coupon.validate") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ code: code })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert(data.message || 'Invalid coupon code');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
      });
    });
  }

  if (removeCouponBtn) {
    removeCouponBtn.addEventListener('click', function() {
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
        console.error('Error:', error);
      });
    });
  }

  // Allow Enter key to apply coupon
  if (couponCodeInput) {
    couponCodeInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter' && applyCouponBtn) {
        applyCouponBtn.click();
      }
    });
  }
});
</script>
@endpush

    


@endsection
