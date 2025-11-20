@extends('frontend.layouts.app')

@php
    // Use settings from view composer, fallback to default
    $pageTitle = $settings->meta_title ?? $settings->website_title ?? $settings->website_name ?? 'Home';
@endphp
@section('title', $pageTitle)

@section('content')
<!-- Hero Section Start -->
    <section class="hero-section mb-custom d-flex align-items-center">
      <div class="container text-center text-md-start">
        <span
          class="badge rounded-pill bg-light fw-semibold px-3 py-2 mb-3 text-primary-custom text-uppercase"
        >
          {{ $content->hero_badge ?? '100% Satisfaction Guaranteed!' }}
        </span>

        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
          {!! $content->hero_title ?? 'Fast, Reliable Phone &<br /> Laptop Repairs' !!}
        </h1>

        <p class="text-white fs-18 mb-4">
          {!! nl2br(e($content->hero_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard.')) !!}
        </p>

        <a href="{{ route('frontend.book-repair') }}" class="btn btn-gradient"> {{ $content->hero_button_text ?? 'Book a repair!' }} </a>
      </div>
    </section>
    <!-- Hero Section End -->
    <section class="mb-custom">
      <div class="container">
        <div class="row g-5">
          <div class="col-12 col-lg-5 col-xl-6">
            <button class="btn-gradient-outline">{{ $content->who_we_are_badge ?? 'WHO WE ARE' }}</button>
            <h1 class="fs-40 pt-4">
              {{ $content->who_we_are_title ?? 'Driven By Quality, Focused On Customer Satisfaction' }}
            </h1>
            <p class="py-3 fs-16">
              {{ $content->who_we_are_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,' }}
            </p>
            <div class="d-flex justify-content-center gap-3">
              <div>
                <p class="text-primary-custom display-2 fw-900 font-satoshi">
                  {{ $content->who_we_are_stat_number ?? '25+' }}
                </p>
                <p class="fw-400 fs-18">{{ $content->who_we_are_stat_label ?? 'YEARS EXPERIENCE' }}</p>
              </div>
              <div class="vertical-line"></div>
              <div>
                <h6 class="fs-24">{{ $content->who_we_are_warranty_title ?? 'Comprehensive Warranty' }}</h6>
                <p class="fs-16">
                  {!! nl2br(e($content->who_we_are_warranty_description ?? 'dummy text Lorem Ipsum is simply dummy text')) !!}
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-7 col-xl-6">
            <div class="feature-card">
              <!-- Left: image -->
              <div class="left-side h-100">
                <img class="feature-img mt-4" src="{{ asset('front-assets/img/hardware.svg') }}" />
              </div>

              <!-- Right: text + checklist -->
              <div class="right-side">
                <h2 class="feature-title mb-4">
                  {!! $content->feature_title ?? 'Fast, Reliable Solutions<br />For All Device Problem' !!}
                </h2>

                <ul class="list-unstyled feature-list m-0">
                  @php
                    $featureItems = $content->feature_items ?? ['Affordable Pricing', 'Expert Technicians', 'High-Quality Parts', 'Free Diagnostics', 'Convenient Service'];
                  @endphp
                  @foreach($featureItems as $item)
                    <li>
                      <img src="{{ asset('front-assets/img/tick.svg') }}" alt="" />
                      {{ $item }}
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- repairing Service section  -->
    <section class="mb-custom">
      <div class="container">
        <div class="row mb-custom">
          <div class="col-md-6">
            <button class="btn-gradient-outline">{{ $content->what_we_offer_badge ?? 'WHAT WE OFFER' }}</button>
            <h1 class="fs-40 pt-4">
              {{ $content->what_we_offer_title ?? 'Driven By Quality, Focused On Customer Satisfaction' }}
            </h1>
          </div>
          <div class="col-md-6">
            <p class="pb-3 fs-16">
              {{ $content->what_we_offer_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,' }}
            </p>
            <a href="{{ route('frontend.contact') }}" class="btn btn-gradient text-decoration-none">{{ $content->what_we_offer_button_text ?? 'Contact Us' }}</a>
          </div>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-3">
          @php
            $allServices = $content->services ?? [
              ['title' => 'Smartphone Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Laptop Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Tablet Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Console Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Gaming Pc Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Software Optimization', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
            ];
            // Convert to array if collection
            if (is_object($allServices) && method_exists($allServices, 'toArray')) {
              $allServices = $allServices->toArray();
            } elseif (is_object($allServices) && method_exists($allServices, 'take')) {
              $allServices = $allServices->take(6)->toArray();
            }
            // Limit to exactly 6 items for 3 columns × 2 rows
            $services = array_slice((array)$allServices, 0, 6);
            $serviceImages = ['service-img-1.svg', 'service-img-2.svg', 'service-img-3.svg', 'service-img-4.svg', 'service-img-5.svg', 'service-img-6.svg'];
          @endphp
          @foreach($services as $index => $service)
            <div class="col">
              <a href="{{ route('frontend.book-repair') }}" class="text-decoration-none d-block h-100">
                <div class="repair-service-card h-100">
                  <img src="{{ asset('front-assets/img/' . ($serviceImages[$index] ?? 'service-img-1.svg')) }}" alt="{{ $service['title'] ?? 'Service' }}" />
                  <h3 class="fs-24">{{ $service['title'] ?? 'Service' }}</h3>
                  <p class="fs-16">
                    {{ $service['description'] ?? '' }}
                  </p>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Trending Phones  -->
    @if($smartphoneCategory && ($trendingBrands->count() > 0 || $trendingProducts->count() > 0))
    <section class="mb-custom">
      <div class="container">
        <button class="btn-gradient-outline mb-4">{{ $content->hot_selling_badge ?? 'Hot Selling' }}</button>

        <div class="flex-between flex-wrap flex-md-nowrap mb-5">
          <h3 class="fs-40">Smart Phones</h3>
          @if($trendingBrands->count() > 0)
          <ul
            class="nav nav-pills justify-content-between justify-content-md-end mb-3 gap-3 mt-md-0 mt-3"
            id="pills-tab"
            role="tablist"
          >
            @foreach($trendingBrands as $index => $brand)
            <li class="nav-item" role="presentation">
              <a
                href="{{ route('frontend.marketplace', ['category' => $smartphoneCategory->id, 'brand' => $brand->id]) }}"
                class="nav-link {{ $index === 0 ? 'active' : '' }}"
              >
                {{ $brand->name }}
              </a>
            </li>
            @endforeach
          </ul>
          @endif
        </div>
        
        @if($trendingProducts->count() > 0)
        <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3">
          @php
            $wishlist = session()->get('wishlist', []);
            $currencySymbol = $settings->currency_symbol ?? '$';
          @endphp
          @foreach($trendingProducts as $product)
          <div class="col">
            <div class="product-card h-100 position-relative">
              @if($product->is_hot_product)
              <span class="product-badge badge-danger">HOT</span>
              @elseif($product->is_best_deal)
              <span class="product-badge badge-secondary">BEST DEALS</span>
              @endif
              <div class="card-body">
                <div class="ratio ratio-1x1 thumb">
                  <a href="{{ route('frontend.product-detail', $product->slug) }}" class="d-block h-100">
                    <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/phone-1.svg') }}" alt="{{ $product->name }}" class="w-100 h-100 p-2 rounded" />
                  </a>
                  <div class="product-actions">
                    @php
                      $isInWishlist = in_array($product->id, $wishlist ?? []);
                    @endphp
                    <div class="action-btn wishlist-btn {{ $isInWishlist ? 'active' : '' }}" data-product-id="{{ $product->id }}" title="{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                      <i class="bi {{ $isInWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                    </div>
                    <div class="action-btn add-to-cart-btn" data-product-id="{{ $product->id }}" title="Add to Cart">
                      <i class="bi bi-cart"></i>
                    </div>
                    <a href="{{ route('frontend.product-detail', $product->slug) }}" class="action-btn" title="View Product">
                      <i class="bi bi-eye"></i>
                    </a>
                  </div>
                </div>
                @php
                  $rating = round($product->approved_rating ?? 0, 1);
                  $reviewCount = $product->approved_reviews_count ?? 0;
                  $rounded = $reviewCount > 0 ? round($rating * 2) / 2 : 0;
                  $full = (int) floor($rounded);
                  $half = ($rounded - $full) === 0.5;
                  $empty = 5 - $full - ($half ? 1 : 0);
                @endphp
                <div class="rating mt-3 d-flex align-items-center gap-2">
                  <span class="text-primary-custom rating-stars-sm">
                    @for ($i = 0; $i < $full; $i++)
                      <i class="bi bi-star-fill"></i>
                    @endfor
                    @if ($half)
                      <i class="bi bi-star-half"></i>
                    @endif
                    @for ($i = 0; $i < $empty; $i++)
                      <i class="bi bi-star"></i>
                    @endfor
                  </span>
                  <span class="rating-count">
                    @if($reviewCount > 0)
                      {{ number_format($rating, 1) }} ({{ $reviewCount }})
                    @else
                      (0)
                    @endif
                  </span>
                </div>
                <a href="{{ route('frontend.product-detail', $product->slug) }}" class="text-decoration-none text-dark">
                  <p class="product-title mt-2 mb-0">{{ Str::limit($product->name, 50) }}</p>
                </a>
                <div class="product-price {{ $product->compare_at_price ? 'text-promo' : '' }}">
                  {{ $currencySymbol }}{{ number_format($product->price, 2) }}
                  @if($product->compare_at_price)
                  <small class="text-muted text-decoration-line-through">{{ $currencySymbol }}{{ number_format($product->compare_at_price, 2) }}</small>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        <div class="text-center mt-4">
          <a href="{{ route('frontend.marketplace', ['category' => $smartphoneCategory->id]) }}" class="btn btn-gradient">
            View All
          </a>
        </div>
        @else
        <div class="text-center py-5">
          <p class="text-muted">No products available in this category.</p>
        </div>
        @endif
      </div>
    </section>
    @endif

    <!-- quality repairs section -->
    <section class="quality-repair-section mb-custom py-5 py-sm-0">
      <div
        class="container d-flex flex-column align-items-center text-center gap-lg-5 gap-4"
      >
        <span class="qm-badge text-uppercase">{{ $content->quality_repairs_badge ?? 'Harrow Mobile & Laptop at Glance' }}</span>

        <h1 class="qm-title display-5 m-0">
          {!! $content->quality_repairs_title ?? 'Top-Quality Repairs, Ensuring Your <br class="d-none d-md-block" /> Phone\'s Perfect Performance' !!}
        </h1>

        <div class="repair-cards mt-2 w-md-75">
          @php
            $stats = $content->quality_repairs_stats ?? [
              ['number' => '1K+', 'label' => 'HAPPY CLIENTS'],
              ['number' => '1000+', 'label' => 'PROJECTS DONE'],
              ['number' => '4.9', 'label' => 'CLIENTS RATING'],
            ];
          @endphp
          @foreach($stats as $stat)
            <div class="repair-service-card">
              <span class="stat">{{ $stat['number'] ?? '' }}</span>
              <span class="stat-label">{{ $stat['label'] ?? '' }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- why choose us  -->
    <section>
      <div class="container text-center mb-custom">
        <button class="btn-gradient-outline">{{ $content->why_choose_us_badge ?? 'WHY CHOOSE US' }}</button>
        <h3 class="my-4 fs-40">{{ $content->why_choose_us_title ?? 'Fast Repairs, No Hassle' }}</h3>
        <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1 g-3">
          @php
            $whyChooseItems = $content->why_choose_us_items ?? ['Fast Turnaround Time', 'Comprehensive Warranty', 'Multi-Device Expertise', 'Customer-Centric Support'];
            $whyChooseImages = ['choose-1.svg', 'choose-2.svg', 'choose-3.svg', 'choose-4.svg'];
          @endphp
          @foreach($whyChooseItems as $index => $item)
            <div class="col">
              <div class="choose-card">
                <img src="{{ asset('front-assets/img/' . ($whyChooseImages[$index] ?? 'choose-1.svg')) }}" alt="img" />
                <span>{{ $item }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Latest Products   -->
    @if(isset($latestProductsData) && count($latestProductsData) > 0)
    <section class="mb-custom">
      <div class="container">
        <button class="btn-gradient-outline mb-4">{{ $content->accessories_badge ?? 'Latest Products' }}</button>

        <div class="flex-between flex-wrap flex-md-nowrap mb-5">
          <h3 class="fs-40">{{ $content->accessories_title ?? 'Latest Products' }}</h3>
          @if(count($latestProductsData) > 1)
          <ul
            class="nav nav-pills justify-content-between justify-content-md-end mb-3 gap-3 mt-md-0 mt-3"
            id="pills-latest-products-tab"
            role="tablist"
          >
            @foreach($latestProductsData as $categoryId => $data)
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link {{ $loop->first ? 'active' : '' }}"
                  id="pills-category-{{ $categoryId }}-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-category-{{ $categoryId }}"
                  type="button"
                  role="tab"
                  aria-controls="pills-category-{{ $categoryId }}"
                  aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                >
                  {{ $data['category']->name }}
                </button>
              </li>
            @endforeach
          </ul>
          @endif
        </div>
        <div class="tab-content" id="pills-latest-products-tabContent">
          @php
            $wishlist = session()->get('wishlist', []);
            $currencySymbol = $settings->currency_symbol ?? '$';
          @endphp
          @foreach($latestProductsData as $categoryId => $data)
            <div
              class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
              id="pills-category-{{ $categoryId }}"
              role="tabpanel"
              aria-labelledby="pills-category-{{ $categoryId }}-tab"
            >
              <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3">
                @foreach($data['products'] as $product)
                <div class="col">
                  <div class="product-card h-100 position-relative">
                    @if($product->is_hot_product)
                    <span class="product-badge badge-danger">HOT</span>
                    @elseif($product->is_best_deal)
                    <span class="product-badge badge-secondary">BEST DEALS</span>
                    @endif
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <a href="{{ route('frontend.product-detail', $product->slug) }}" class="d-block h-100">
                          <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/phone-1.svg') }}" alt="{{ $product->name }}" class="w-100 h-100 p-2 rounded" />
                        </a>
                        <div class="product-actions">
                          @php
                            $isInWishlist = in_array($product->id, $wishlist ?? []);
                          @endphp
                          <div class="action-btn wishlist-btn {{ $isInWishlist ? 'active' : '' }}" data-product-id="{{ $product->id }}" title="{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                            <i class="bi {{ $isInWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                          </div>
                          <div class="action-btn add-to-cart-btn" data-product-id="{{ $product->id }}" title="Add to Cart">
                            <i class="bi bi-cart"></i>
                          </div>
                          <a href="{{ route('frontend.product-detail', $product->slug) }}" class="action-btn" title="View Product">
                            <i class="bi bi-eye"></i>
                          </a>
                        </div>
                      </div>
                      @php
                        $rating = round($product->approved_rating ?? 0, 1);
                        $reviewCount = $product->approved_reviews_count ?? 0;
                        $rounded = $reviewCount > 0 ? round($rating * 2) / 2 : 0;
                        $full = (int) floor($rounded);
                        $half = ($rounded - $full) === 0.5;
                        $empty = 5 - $full - ($half ? 1 : 0);
                      @endphp
                      <div class="rating mt-3 d-flex align-items-center gap-2">
                        <span class="text-primary-custom rating-stars-sm">
                          @for ($i = 0; $i < $full; $i++)
                            <i class="bi bi-star-fill"></i>
                          @endfor
                          @if ($half)
                            <i class="bi bi-star-half"></i>
                          @endif
                          @for ($i = 0; $i < $empty; $i++)
                            <i class="bi bi-star"></i>
                          @endfor
                        </span>
                        <span class="rating-count">
                          @if($reviewCount > 0)
                            {{ number_format($rating, 1) }} ({{ $reviewCount }})
                          @else
                            (0)
                          @endif
                        </span>
                      </div>
                      <a href="{{ route('frontend.product-detail', $product->slug) }}" class="text-decoration-none text-dark">
                        <p class="product-title mt-2 mb-0">{{ Str::limit($product->name, 50) }}</p>
                      </a>
                      <div class="product-price {{ $product->compare_at_price ? 'text-promo' : '' }}">
                        {{ $currencySymbol }}{{ number_format($product->price, 2) }}
                        @if($product->compare_at_price)
                        <small class="text-muted text-decoration-line-through">{{ $currencySymbol }}{{ number_format($product->compare_at_price, 2) }}</small>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              
              <div class="text-center mt-4">
                <a href="{{ route('frontend.marketplace', ['category' => $data['category']->id]) }}" class="btn btn-gradient">
                  View All {{ $data['category']->name }}
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    

@push('scripts')
<script>
// Add to cart functionality
function addToCart(productId) {
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
      showCartNotification('Product added to cart!', 'success');
      // Update cart bar if it exists
      if (typeof updateCartBar === 'function') {
        updateCartBar();
      }
    } else {
      showCartNotification(data.message || 'Unable to add product to cart.', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showCartNotification('Unable to add product to cart. Please try again.', 'error');
  });
}

// Notification function
function showCartNotification(message, type = 'success') {
  const notification = document.createElement('div');
  notification.className = `cart-notification cart-notification-${type}`;
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 1rem 1.5rem;
    border-radius: 5px;
    color: #fff;
    font-weight: 500;
    z-index: 9999;
    opacity: 0;
    transform: translateX(400px);
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    max-width: 400px;
    ${type === 'success' ? 'background: #28a745;' : 'background: #dc3545;'}
  `;
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

// Wishlist functionality
function toggleWishlist(wishlistBtn) {
  if (!wishlistBtn) return;
  
  const productId = wishlistBtn.getAttribute('data-product-id');
  if (!productId) return;
  
  const isCurrentlyActive = wishlistBtn.classList.contains('active');
  const action = isCurrentlyActive ? 'remove' : 'add';
  const endpoint = `{{ url('/wishlist') }}/${action}/${productId}`;
  
  fetch(endpoint, {
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
      const icon = wishlistBtn.querySelector('i');
      if (action === 'add') {
        wishlistBtn.classList.add('active');
        icon.classList.remove('bi-heart');
        icon.classList.add('bi-heart-fill');
        wishlistBtn.setAttribute('title', 'Remove from Wishlist');
        // Use server message or default message
        showCartNotification(data.message || 'Product added to wishlist!', 'success');
      } else {
        wishlistBtn.classList.remove('active');
        icon.classList.remove('bi-heart-fill');
        icon.classList.add('bi-heart');
        wishlistBtn.setAttribute('title', 'Add to Wishlist');
        // Use server message or default message
        showCartNotification(data.message || 'Product removed from wishlist!', 'success');
      }
    } else {
      showCartNotification(data.message || 'Unable to update wishlist. Please try again.', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showCartNotification('Unable to update wishlist. Please try again.', 'error');
  });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
  // Add click handlers to all cart icons (including dynamically loaded ones)
  document.addEventListener('click', function(e) {
    // Handle cart button clicks
    const cartBtn = e.target.closest('.add-to-cart-btn');
    if (cartBtn) {
      e.preventDefault();
      e.stopPropagation();
      const productId = cartBtn.getAttribute('data-product-id');
      if (productId) {
        addToCart(productId);
      }
      return;
    }
    
    // Handle wishlist toggle - closest() will find parent button even if icon is clicked
    const wishlistBtn = e.target.closest('.wishlist-btn');
    if (wishlistBtn) {
      e.preventDefault();
      e.stopPropagation();
      toggleWishlist(wishlistBtn);
      return;
    }
  });
});
</script>
@endpush

@endsection
