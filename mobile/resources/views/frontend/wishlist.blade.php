@extends('frontend.layouts.app')

@section('title', 'Wishlist')

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
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <section class="container my-5">
      <div class="product-table">
        <div class="bg-white px-4 pb-2">
          <h5 class="mb-0 fw-semibold">Wishlist</h5>
        </div>

        @if($products->count() > 0)
        <div class="table-responsive">
          <table class="table align-middle mb-0 text-center">
            <thead class="header">
              <tr>
                <th scope="col" class="text-start ps-4">PRODUCTS</th>
                <th scope="col">PRICE</th>
                <th scope="col">STOCK STATUS</th>
                <th scope="col">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr id="wishlist-row-{{ $product->id }}">
                <td>
                  <div class="flex-center gap-1">
                    <a href="{{ route('frontend.product-detail', $product->slug) }}">
                      <img
                        src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/phone-1.svg') }}"
                        alt="{{ $product->name }}"
                        class="product-img"
                        style="width: 80px; height: 80px; object-fit: contain;"
                      />
                    </a>
                    <p class="text-start mb-0">
                      <a href="{{ route('frontend.product-detail', $product->slug) }}" class="text-decoration-none text-dark">
                        {{ $product->name }}
                      </a>
                    </p>
                  </div>
                </td>
                <td>
                  <div class="d-flex align-items-center justify-content-center gap-2">
                    @if($product->compare_at_price)
                    <span class="text-decoration-line-through text-muted">
                      {{ $currencySymbol }}{{ number_format($product->compare_at_price, 2) }}
                    </span>
                    @endif
                    <span class="original-price">{{ $currencySymbol }}{{ number_format($product->price, 2) }}</span>
                  </div>
                </td>
                <td>
                  @if($product->availability === 'in_stock' && $product->quantity > 0)
                    <span class="in-stock">IN STOCK</span>
                  @elseif($product->availability === 'pre_order')
                    <span class="text-warning">PRE ORDER</span>
                  @else
                    <span class="text-danger">OUT OF STOCK</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex justify-content-center align-items-center gap-3">
                    <button class="btn-gradient text-nowrap add-to-cart-wishlist" data-product-id="{{ $product->id }}">
                      ADD TO CART <i class="bi bi-cart ms-2"></i>
                    </button>
                    <button class="btn btn-link text-muted p-0 remove-from-wishlist" data-product-id="{{ $product->id }}" title="Remove from Wishlist">
                      <i class="bi bi-x-circle fs-5"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <div class="text-center py-5">
          <i class="bi bi-heart fs-1 text-muted d-block mb-3"></i>
          <h5 class="text-muted">Your wishlist is empty</h5>
          <p class="text-muted">Start adding products to your wishlist!</p>
          <a href="{{ route('frontend.marketplace') }}" class="btn-gradient mt-3">Browse Products</a>
        </div>
        @endif
      </div>
    </section>

    
    

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Add to cart from wishlist
  document.querySelectorAll('.add-to-cart-wishlist').forEach(button => {
    button.addEventListener('click', function() {
      const productId = this.getAttribute('data-product-id');
      addToCartFromWishlist(productId);
    });
  });
  
  // Remove from wishlist
  document.querySelectorAll('.remove-from-wishlist').forEach(button => {
    button.addEventListener('click', function() {
      const productId = this.getAttribute('data-product-id');
      removeFromWishlist(productId);
    });
  });
});

function addToCartFromWishlist(productId) {
  fetch(`{{ url('/cart/add') }}/${productId}`, {
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
      showNotification('Product added to cart!', 'success');
      // Update cart bar if it exists
      if (typeof updateCartBar === 'function') {
        updateCartBar();
      }
    } else {
      showNotification(data.message || 'Failed to add product to cart', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('An error occurred. Please try again.', 'error');
  });
}

function removeFromWishlist(productId) {
  fetch(`{{ url('/wishlist/remove') }}/${productId}`, {
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
      // Remove the row from the table
      const row = document.getElementById(`wishlist-row-${productId}`);
      if (row) {
        row.style.transition = 'opacity 0.3s';
        row.style.opacity = '0';
        setTimeout(() => {
          row.remove();
          
          // Check if table is empty
          const tbody = document.querySelector('tbody');
          if (tbody && tbody.children.length === 0) {
            location.reload(); // Reload to show empty state
          }
        }, 300);
      }
      showNotification('Product removed from wishlist!', 'success');
      
      // Reload page after a short delay to update navigation
      setTimeout(() => {
        location.reload();
      }, 1000);
    } else {
      showNotification('Failed to remove product from wishlist', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('An error occurred. Please try again.', 'error');
  });
}

function showNotification(message, type) {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `cart-notification cart-notification-${type}`;
  notification.textContent = message;
  notification.style.cssText = 'position: fixed; top: 20px; right: 20px; padding: 1rem 1.5rem; border-radius: 5px; color: #fff; font-weight: 500; z-index: 9999; opacity: 0; transform: translateX(400px); transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);';
  
  if (type === 'success') {
    notification.style.background = '#28a745';
  } else {
    notification.style.background = '#dc3545';
  }
  
  document.body.appendChild(notification);
  
  // Show notification
  setTimeout(() => {
    notification.style.opacity = '1';
    notification.style.transform = 'translateX(0)';
  }, 10);
  
  // Hide and remove notification after 3 seconds
  setTimeout(() => {
    notification.style.opacity = '0';
    notification.style.transform = 'translateX(400px)';
    setTimeout(() => {
      notification.remove();
    }, 300);
  }, 3000);
}
</script>
@endpush
