@extends('frontend.layouts.app')

@section('title', $product->name ?? 'Product Detail')

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
            <li class="breadcrumb-item"><a href="{{ route('frontend.marketplace') }}">Marketplace</a></li>
            @if($product->category)
            <li class="breadcrumb-item"><a href="{{ route('frontend.marketplace', ['category' => $product->category->id]) }}">{{ $product->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">
              {{ $product->name }}
            </li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <!-- Begin:: Product Detail -->
    <section class="py-5 product-detail">
      <div class="container">
        <div class="row align-items-start">
          <!-- Gallery -->
          <div class="col-12 col-lg-6">
            <div class="pd-gallery">
              <div class="pd-main ratio ratio-16x9 bg-light rounded">
                <img
                  id="pdMainImg"
                  src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/phone-1.svg') }}"
                  alt="{{ $product->name }}"
                  class="img-fluid rounded"
                />
              </div>
              @if($product->galleryImages->count() > 0 || $product->featured_image)
              <div class="pd-thumbs mt-3 position-relative">
                <button
                  class="btn rounded-circle p-0 pd-nav pd-nav-prev"
                  data-dir="prev"
                  aria-label="Previous"
                  style="width: 40px; height: 40px"
                >
                  <i class="bi bi-arrow-left"></i>
                </button>
                <div
                  class="d-flex gap-2 px-3 flex-nowrap pd-thumbs-track overflow-auto"
                >
                  @if($product->featured_image)
                  <img
                    class="pd-thumb active"
                    src="{{ asset('storage/' . $product->featured_image) }}"
                    alt="{{ $product->name }}"
                  />
                  @endif
                  @foreach($product->galleryImages as $galleryImage)
                  <img
                    class="pd-thumb {{ !$product->featured_image && $loop->first ? 'active' : '' }}"
                    src="{{ asset('storage/' . $galleryImage->image) }}"
                    alt="{{ $product->name }}"
                  />
                  @endforeach
                </div>
                <button
                  class="btn rounded-circle p-0 pd-nav pd-nav-next"
                  data-dir="next"
                  aria-label="Next"
                  style="width: 40px; height: 40px"
                >
                  <i class="bi bi-arrow-right"></i>
                </button>
              </div>
              @endif
            </div>
          </div>

          <!-- Details -->
          <div class="col-12 col-lg-6">
            <div class="pd-info">
              @php
                $roundedRating = $reviewsCount > 0 ? round($averageRating * 2) / 2 : 0;
                $fullStars = (int) floor($roundedRating);
                $hasHalfStar = ($roundedRating - $fullStars) === 0.5;
                $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
              @endphp
              <div class="d-flex align-items-center gap-2 mb-2">
                <div class="text-primary-custom rating-stars">
                  @for ($i = 0; $i < $fullStars; $i++)
                  <i class="bi bi-star-fill"></i>
                  @endfor
                  @if ($hasHalfStar)
                  <i class="bi bi-star-half"></i>
                  @endif
                  @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="bi bi-star"></i>
                  @endfor
                </div>
                <small class="text-heading fw-600">
                  @if($reviewsCount > 0)
                    {{ number_format($averageRating, 1) }} Star Rating
                    <span class="pd-feedback">
                      ({{ $reviewsCount }} {{ \Illuminate\Support\Str::plural('Review', $reviewsCount) }})
                    </span>
                  @else
                    No reviews yet
                  @endif
                </small>
              </div>

              <h3 class="title-head my-3">
                {{ $product->name }}
              </h3>
              <div class="row gy-2 mb-3 row-cols-2">
                <div class="col">
                  <small class="text-gray-600"
                    >SKU:
                    <span class="fw-600 text-heading">{{ $product->sku }}</span></small
                  >
                </div>
                <div class="col">
                  <small class="text-gray-600"
                    >Availability:
                    <span class="fw-600 text-stock">{{ $product->availability === 'in_stock' ? 'In Stock' : ($product->availability === 'out_of_stock' ? 'Out of Stock' : 'Pre-order') }}</span></small
                  >
                </div>
                @if($product->brand)
                <div class="col">
                  <small class="text-gray-600"
                    >Brand:
                    <span class="fw-600 text-heading">{{ $product->brand->name }}</span></small
                  >
                </div>
                @endif
                @if($product->category)
                <div class="col">
                  <small class="text-gray-600"
                    >Category:
                    <span class="fw-600 text-heading">{{ $product->category->name }}</span></small
                  >
                </div>
                @endif
              </div>

              <div class="d-flex align-items-center gap-3 mb-3" id="priceDisplay">
                <div class="pd-price mb-0" id="productPrice">{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->price, 2) }}</div>
                @if($product->compare_at_price)
                <del class="text-gray-600 fw-400 fs-18" id="productComparePrice">{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->compare_at_price, 2) }}</del>
                @php
                  $discount = (($product->compare_at_price - $product->price) / $product->compare_at_price) * 100;
                @endphp
                <span class="off-badge" id="productDiscount">{{ number_format($discount, 0) }}% OFF</span>
                @else
                <del class="text-gray-600 fw-400 fs-18" id="productComparePrice" style="display: none;"></del>
                <span class="off-badge" id="productDiscount" style="display: none;"></span>
                @endif
              </div>

              <hr />

              <!-- Options -->
              @if($product->variants->count() > 0)
              <div class="row g-3 mb-3" id="variantOptions">
                @foreach($product->variants as $variant)
                <div class="col-12 col-lg-6">
                  @if($variant->type === 'color')
                  @php
                    $defaultOption = $variant->options->first();
                  @endphp
                  <div>
                    <label class="label-text">{{ $variant->name }}</label>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                      @foreach($variant->options as $index => $option)
                      <input
                        class="btn-check variant-option"
                        type="radio"
                        name="variant_{{ $variant->id }}"
                        id="variant_{{ $variant->id }}_option_{{ $option->id }}"
                        value="{{ $option->id }}"
                        data-variant-id="{{ $variant->id }}"
                        data-variant-name="{{ $variant->name }}"
                        data-option-value="{{ $option->value }}"
                        {{ $index === 0 ? 'checked' : '' }}
                      />
                      <label for="variant_{{ $variant->id }}_option_{{ $option->id }}" class="pd-color {{ $option->color_code ? '' : 'no-color' }}" style="{{ $option->color_code ? '--swatch-color: ' . $option->color_code . ';' : '' }}" title="{{ $option->value }}">
                        @if(!$option->color_code)
                        <span>{{ $option->value }}</span>
                        @endif
                      </label>
                      @endforeach
                    </div>
                    <div class="selected-variant-label mt-2 text-muted" data-variant-id="{{ $variant->id }}">
                      <small>Selected: <span>{{ optional($defaultOption)->value }}</span></small>
                  </div>
                </div>
                  @else
                  @php
                    $defaultOption = $variant->options->first();
                  @endphp
                  <div>
                    <label class="label-text">{{ $variant->name }}</label>
                    <select class="custom-form-select variant-option" name="variant_{{ $variant->id }}" data-variant-id="{{ $variant->id }}" data-variant-name="{{ $variant->name }}">
                      @foreach($variant->options as $option)
                      <option value="{{ $option->id }}" data-option-value="{{ $option->value }}">{{ $option->value }}</option>
                      @endforeach
                  </select>
                    <div class="selected-variant-label mt-2 text-muted" data-variant-id="{{ $variant->id }}">
                      <small>Selected: <span>{{ optional($defaultOption)->value }}</span></small>
                </div>
                </div>
                  @endif
                </div>
                @endforeach
              </div>
              @endif

              <!-- Qty + Actions -->
              <div class="d-flex flex-lg-nowrap gap-1 gap-sm-3 my-4">
                <div class="pd-qty">
                  <button class="qty-btn" type="button" id="qtyMinus">
                    <i class="bi bi-dash"></i>
                  </button>
                  <input
                    id="qtyInput"
                    type="text"
                    class="text-center"
                    value="1"
                    aria-label="Quantity"
                  />
                  <button class="qty-btn" type="button" id="qtyPlus">
                    <i class="bi bi-plus"></i>
                  </button>
                </div>

                <button
                  class="flex-1 btn-gradient d-flex align-items-center justify-content-center text-center gap-2 px-4 add-to-cart-btn-detail"
                  data-product-id="{{ $product->id }}"
                >
                  ADD TO CART
                  <i class="bi bi-cart"></i>
                </button>

                <button
                  class="btn-gradient-outline px-4 text-decoration-none buy-now-btn"
                  data-product-id="{{ $product->id }}"
                >
                  BUY NOW
                </button>
              </div>

              <div class="flex-between my-4">
                <a href="#"
                   class="add-wishlist add-wishlist-btn {{ $isInWishlist ? 'active' : '' }}"
                   data-product-id="{{ $product->id }}">
                  <i class="bi {{ $isInWishlist ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>
                  <span class="wishlist-label">{{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}</span>
                </a>

                <div class="flex-center gap-3">
                  <label class="share-product">Share product:</label>
                  <div class="flex-between gap-2 share-actions">
                    <button type="button" class="share-btn share-copy" data-share="copy" aria-label="Copy product link">
                      <img src="{{ asset('front-assets/img/Copy.svg') }}" alt="Copy link" />
                    </button>
                    <a href="#" class="share-btn" data-share="facebook" aria-label="Share on Facebook">
                      <img src="{{ asset('front-assets/img/facebook.svg') }}" alt="Facebook" />
                    </a>
                    <a href="#" class="share-btn" data-share="twitter" aria-label="Share on Twitter">
                      <img src="{{ asset('front-assets/img/Twitter.svg') }}" alt="Twitter" />
                    </a>
                    <a href="#" class="share-btn" data-share="pinterest" aria-label="Share on Pinterest">
                      <img src="{{ asset('front-assets/img/Pinterest.svg') }}" alt="Pinterest" />
                    </a>
                  </div>
                </div>
              </div>

              <div class="safe-checkout-card mt-3">
                <p class="mb-2">100% Guarantee Safe Checkout</p>
                <div class="d-flex gap-2 flex-wrap">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg"
                    alt="Visa"
                    height="28"
                  />
                  <img
                    src="{{ asset('front-assets/img/mastercard.png') }}"
                    alt="Mastercard"
                    height="28"
                  />
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png"
                    alt="PayPal"
                    height="28"
                  />
                  <img
                    src="{{ asset('front-assets/img/apple-pay.png') }}"
                    alt="Apple Pay"
                    height="28"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End:: Product Detail -->

    <!-- Begin:: shipping_information -->
    <section class="shipping_information container my-5">
      <ul
        class="flex-stack nav nav-tabs border-0 mb-4 pt-3"
        id="descTab"
        role="tablist"
      >
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="desc-tab"
            data-bs-toggle="tab"
            data-bs-target="#descPane"
            type="button"
            role="tab"
            aria-controls="descPane"
            aria-selected="true"
          >
            DESCRIPTION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="info-tab"
            data-bs-toggle="tab"
            data-bs-target="#infoPane"
            type="button"
            role="tab"
            aria-controls="infoPane"
            aria-selected="false"
          >
            ADDITIONAL INFORMATION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="spec-tab"
            data-bs-toggle="tab"
            data-bs-target="#specPane"
            type="button"
            role="tab"
            aria-controls="specPane"
            aria-selected="false"
          >
            SPECIFICATION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="review-tab"
            data-bs-toggle="tab"
            data-bs-target="#reviewPane"
            type="button"
            role="tab"
            aria-controls="reviewPane"
            aria-selected="false"
          >
            REVIEW
          </button>
        </li>
      </ul>
      <div class="tab-content bg-white p-4 rounded-3">
        <div
          class="tab-pane fade show active"
          id="descPane"
          role="tabpanel"
          aria-labelledby="desc-tab"
        >
          <div class="row g-4 align-items-start">
            <div class="col-md-6 col-lg-5">
              <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                Description
              </h6>
              @if($product->description)
              @php
                $descriptionHtml = html_entity_decode($product->description);
              @endphp
              <div class="mb-3 fw-400 fs-14 text-muted-custom">
                {!! $descriptionHtml !!}
              </div>
              @else
              <p class="mb-3 fw-400 fs-14 text-muted-custom">
                No description available for this product.
              </p>
              @endif
            </div>
            <div class="col-md-3 col-lg-4 border-start">
              <div class="ps-md-4">
                <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                  Feature
                </h6>
                @if($displayFeatures->count() > 0)
                <ul class="list-unstyled mb-0">
                  @foreach($displayFeatures as $feature)
                  <li class="{{ !$loop->last ? 'mb-2' : '' }} d-flex align-items-center gap-2 text-heading fs-14 fw-400">
                    <i class="{{ $feature->icon ?? 'bi bi-check-circle' }} fs-5 text-primary-custom"></i>
                    {{ $feature->title }}
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
            @if($displayFeatures->count() > 0)
            <div class="col-md-3 border-start">
              <div class="ps-md-4">
                <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                  Shipping Information
                </h6>
                <ul class="list-unstyled mb-0 text-muted small">
                  @forelse($shippingOptions as $shipping)
                  <li class="text-muted-custom fs-14 fw-400 {{ !$loop->last ? 'mb-3' : '' }}">
                    <span class="fw-500 text-heading fs-14">{{ $shipping->name }}:</span>
                    {{ $shipping->description }}
                    @if($shipping->cost > 0)
                    , {{ $settings->currency_symbol ?? '$' }}{{ number_format($shipping->cost, 2) }}
                    @else
                    , free shipping
                    @endif
                  </li>
                  @empty
                  <li class="text-muted-custom fs-14 fw-400">
                    No shipping options available.
                  </li>
                  @endforelse
                </ul>
              </div>
            </div>
            @else
            <div class="col-md-3 col-lg-4 border-start">
              <div class="ps-md-4">
                <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                  Shipping Information
                </h6>
                <ul class="list-unstyled mb-0 text-muted small">
                  @forelse($shippingOptions as $shipping)
                  <li class="text-muted-custom fs-14 fw-400 {{ !$loop->last ? 'mb-3' : '' }}">
                    <span class="fw-500 text-heading fs-14">{{ $shipping->name }}:</span>
                    {{ $shipping->description }}
                    @if($shipping->cost > 0)
                    , {{ $settings->currency_symbol ?? '$' }}{{ number_format($shipping->cost, 2) }}
                    @else
                    , free shipping
                    @endif
                  </li>
                  @empty
                  <li class="text-muted-custom fs-14 fw-400">
                    No shipping options available.
                  </li>
                  @endforelse
                </ul>
              </div>
            </div>
            @endif
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="infoPane"
          role="tabpanel"
          aria-labelledby="info-tab"
        >
          @if($product->additional_information)
          @php
            $additionalInfoHtml = html_entity_decode($product->additional_information);
          @endphp
          <div class="fw-400 fs-14 text-muted-custom">
            {!! $additionalInfoHtml !!}
          </div>
          @else
          <p class="fw-400 fs-14 text-muted-custom">
            No additional information available for this product.
          </p>
          @endif
        </div>
        <div
          class="tab-pane fade"
          id="specPane"
          role="tabpanel"
          aria-labelledby="spec-tab"
        >
          @if($product->specifications)
          @php
            $specificationsHtml = html_entity_decode($product->specifications);
          @endphp
          <div class="fw-400 fs-14 text-muted-custom">
            {!! $specificationsHtml !!}
          </div>
          @else
          <p class="fw-400 fs-14 text-muted-custom">
            No specifications available for this product.
          </p>
          @endif
        </div>
        <div
          class="tab-pane fade"
          id="reviewPane"
          role="tabpanel"
          aria-labelledby="review-tab"
        >
          <div class="row g-4">
            <div class="col-lg-6">
              <div class="review-summary-card p-4 bg-white rounded-3 shadow-sm h-100">
                <h5 class="fw-600 text-heading mb-3">Customer Reviews</h5>
                @if ($reviewsCount > 0)
                <div class="d-flex align-items-center gap-3 mb-3">
                  <div class="display-4 text-heading mb-0">{{ number_format($averageRating, 1) }}</div>
                  <div>
                    <div class="text-primary-custom rating-stars-lg mb-1">
                      @for ($i = 0; $i < $fullStars; $i++)
                        <i class="bi bi-star-fill"></i>
                      @endfor
                      @if ($hasHalfStar)
                        <i class="bi bi-star-half"></i>
                      @endif
                      @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="bi bi-star"></i>
                      @endfor
        </div>
                    <small class="text-muted">{{ $reviewsCount }} {{ \Illuminate\Support\Str::plural('review', $reviewsCount) }}</small>
      </div>
                </div>
                <div class="review-list">
                  @foreach ($recentReviews as $review)
                  <div class="review-item border rounded-3 p-3 mb-3">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
              <div>
                        <strong>{{ $review->reviewer_name ?? 'Anonymous' }}</strong>
                        <div class="text-primary-custom rating-stars-sm">
                          @for ($i = 0; $i < $review->rating; $i++)
                            <i class="bi bi-star-fill"></i>
                          @endfor
                          @for ($i = $review->rating; $i < 5; $i++)
                            <i class="bi bi-star"></i>
                          @endfor
                    </div>
                  </div>
                      <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                </div>
                    @if ($review->title)
                      <div class="text-heading fw-600 mt-2">{{ $review->title }}</div>
                    @endif
                    <p class="mb-0 text-muted fs-14 mt-2">{{ $review->comment }}</p>
              </div>
                  @endforeach
            </div>
                @else
                  <p class="text-muted mb-0">There are no reviews yet. Be the first to share your experience with this product.</p>
                @endif
                    </div>
                  </div>
            <div class="col-lg-6">
              <div class="review-form-card p-4 bg-white rounded-3 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="fw-600 text-heading mb-0">Share Your Feedback</h5>
                  <span class="badge bg-light text-dark border">{{ $product->name }}</span>
                </div>
                <p class="text-muted fs-14 mb-4">
                  We’d love to hear what you think! Tell us about your experience with this product and help others make the best choice.
                </p>
                @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                @endif
                <form action="{{ route('frontend.product.reviews.store', $product->slug) }}" method="POST" class="review-form needs-validation" novalidate>
                  @csrf
                  <div class="mb-3">
                    <label class="label-text mb-2 d-block">Your Rating <span class="text-danger">*</span></label>
                    <div class="rating-input d-flex align-items-center gap-2">
                      @for ($i = 5; $i >= 1; $i--)
                      <input type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" class="d-none review-star-input" {{ old('rating', 5) == $i ? 'checked' : '' }}>
                      <label for="rating{{ $i }}" class="review-star"><i class="bi bi-star-fill"></i></label>
                      @endfor
            </div>
                    @error('rating')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="label-text mb-2" for="reviewer_name">Your Name <span class="text-danger">*</span></label>
                      <input type="text" id="reviewer_name" name="reviewer_name" class="form-control" value="{{ old('reviewer_name') }}" required>
                      @error('reviewer_name')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                  </div>
                    <div class="col-md-6">
                      <label class="label-text mb-2" for="reviewer_email">Email (optional)</label>
                      <input type="email" id="reviewer_email" name="reviewer_email" class="form-control" value="{{ old('reviewer_email') }}">
                      @error('reviewer_email')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                </div>
              </div>
                  <div class="mt-3">
                    <label class="label-text mb-2" for="title">Review Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Give your review a title" value="{{ old('title') }}">
                    @error('title')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
                  <div class="mt-3">
                    <label class="label-text mb-2" for="comment">Your Review <span class="text-danger">*</span></label>
                    <textarea id="comment" name="comment" rows="4" class="form-control" placeholder="Tell us about your experience..." required>{{ old('comment') }}</textarea>
                    @error('comment')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
          </div>
                  <div class="mt-4">
                    <button type="submit" class="btn btn-gradient w-100 text-uppercase fw-600">
                      Submit Review
                    </button>
        </div>
                  <p class="text-muted fs-12 mt-3 mb-0">
                    By submitting a review, you acknowledge that your feedback may be visible to other customers. We appreciate constructive, honest opinions that help our community.
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End:: shipping_information -->

    <section class="container">
      <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
        @if($relatedProducts->count() > 0)
        <div class="col">
          <h2 class="font-sans fw-600 fs-16 text-heading my-3">
            RELATED PRODUCTS
          </h2>
          <div class="row row-cols-1">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col mb-3">
              <div>
                <a href="{{ route('frontend.product-detail', $relatedProduct->slug) }}" class="text-decoration-none">
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                        src="{{ $relatedProduct->featured_image ? asset('storage/' . $relatedProduct->featured_image) : asset('front-assets/img/phone-1.svg') }}"
                        alt="{{ $relatedProduct->name }}"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                          {{ Str::limit($relatedProduct->name, 60) }}
                      </h6>

                        <div class="prdoduct-price-s1">{{ $settings->currency_symbol ?? '$' }}{{ number_format($relatedProduct->price, 2) }}</div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            @endforeach
                    </div>
                  </div>
        @endif
        
        @if($brandProducts->count() > 0)
        <div class="col">
          <h2 class="font-sans fw-600 fs-16 text-heading my-3">
            MORE FROM {{ strtoupper($product->brand->name ?? 'BRAND') }}
          </h2>
          <div class="row row-cols-1">
            @foreach($brandProducts as $brandProduct)
            <div class="col mb-3">
              <div>
                <a href="{{ route('frontend.product-detail', $brandProduct->slug) }}" class="text-decoration-none">
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                        src="{{ $brandProduct->featured_image ? asset('storage/' . $brandProduct->featured_image) : asset('front-assets/img/phone-1.svg') }}"
                        alt="{{ $brandProduct->name }}"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                          {{ Str::limit($brandProduct->name, 60) }}
                      </h6>

                        <div class="prdoduct-price-s1">{{ $settings->currency_symbol ?? '$' }}{{ number_format($brandProduct->price, 2) }}</div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endif
        
        @if($featuredProducts->count() > 0)
        <div class="col">
          <h2 class="font-sans fw-600 fs-16 text-heading my-3">
            FEATURED PRODUCTS
          </h2>
          <div class="row row-cols-1">
            @foreach($featuredProducts as $featuredProduct)
            <div class="col mb-3">
              <div>
                <a href="{{ route('frontend.product-detail', $featuredProduct->slug) }}" class="text-decoration-none">
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                        src="{{ $featuredProduct->featured_image ? asset('storage/' . $featuredProduct->featured_image) : asset('front-assets/img/phone-1.svg') }}"
                        alt="{{ $featuredProduct->name }}"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                          {{ Str::limit($featuredProduct->name, 60) }}
                      </h6>

                        <div class="prdoduct-price-s1">{{ $settings->currency_symbol ?? '$' }}{{ number_format($featuredProduct->price, 2) }}</div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>
            @endforeach
                    </div>
                  </div>
        @endif
                </div>
    </section>

    <!-- Cart Bar -->
    <div id="cartBar" class="cart-bar" style="display: none;">
      <div class="container">
        <div class="cart-bar-content">
          <div class="cart-bar-info">
            <div class="cart-icon-wrapper">
              <i class="bi bi-cart-fill"></i>
              <span class="cart-count-badge" id="cartCountBadge">0</span>
                    </div>
            <div class="cart-summary">
              <span class="cart-items-text" id="cartItemsText">0 items</span>
              <span class="cart-total-text" id="cartTotalText">$0.00</span>
                  </div>
                </div>
          <div class="cart-bar-actions">
            <a href="{{ route('frontend.cart') }}" class="btn btn-view-cart">View Cart</a>
            <a href="{{ route('frontend.checkout') }}" class="btn btn-checkout">Checkout</a>
              </div>
            </div>
          </div>
        </div>

@endsection

@push('styles')
<style>
/* Cart Bar Styles */
.cart-bar {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #fff;
  border-top: 2px solid #5B265D;
  box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1050;
  padding: 1rem 0;
  animation: slideUp 0.3s ease-out;
}

@keyframes slideUp {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.cart-bar-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1.5rem;
  flex-wrap: wrap;
}

.cart-bar-info {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex: 1;
  min-width: 200px;
}

.cart-icon-wrapper {
  position: relative;
  width: 50px;
  height: 50px;
  background: linear-gradient(135deg, #5B265D 0%, #7a3a7d 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 1.5rem;
}

.cart-count-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: #ff4444;
  color: #fff;
  border-radius: 50%;
  width: 24px;
  height: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 600;
  border: 2px solid #fff;
}

.cart-summary {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.cart-items-text {
  font-size: 0.875rem;
  color: #5F6C72;
  font-weight: 400;
}

.cart-total-text {
  font-size: 1.25rem;
  color: #5B265D;
  font-weight: 600;
}

.cart-bar-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

.btn-view-cart {
  background: #fff;
  color: #5B265D;
  border: 2px solid #5B265D;
  padding: 0.75rem 1.5rem;
  border-radius: 5px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-view-cart:hover {
  background: #5B265D;
  color: #fff;
}

.btn-checkout {
  background: linear-gradient(135deg, #5B265D 0%, #7a3a7d 100%);
  color: #fff;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 5px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-checkout:hover {
  background: linear-gradient(135deg, #7a3a7d 0%, #5B265D 100%);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(91, 38, 93, 0.3);
}

/* Cart Notification */
.cart-notification {
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
}

.cart-notification.show {
  opacity: 1;
  transform: translateX(0);
}

.cart-notification-success {
  background: #28a745;
}

.cart-notification-error {
  background: #dc3545;
}

/* Price Update Animation */
.pd-price {
  transition: opacity 0.3s ease;
}

#productPrice,
#productComparePrice,
#productDiscount {
  transition: opacity 0.2s ease;
}

#priceDisplay {
  min-height: 50px;
  align-items: center;
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.rating-stars i,
.rating-stars-lg i,
.rating-stars-sm i {
  color: #ffb648;
}

.rating-stars i {
  font-size: 1.1rem;
}

.rating-stars-lg i {
  font-size: 1.5rem;
}

.rating-stars-sm i {
  font-size: 1rem;
}

.review-form-card .rating-input {
  direction: rtl;
}

.review-form-card .review-star {
  cursor: pointer;
  font-size: 1.6rem;
  color: #d0d5dd;
  transition: color 0.2s ease, transform 0.2s ease;
}

.review-form-card .review-star.active,
.review-form-card .review-star:hover,
.review-form-card .review-star:hover ~ .review-star {
  color: #ffb648;
  transform: scale(1.05);
}

.review-item {
  border-color: rgba(91, 38, 93, 0.08) !important;
  background: #faf6fc;
}

.review-summary-card,
.review-form-card {
  border: 1px solid rgba(91, 38, 93, 0.08);
}

.pd-color {
  width: 38px;
  height: 38px;
  border-radius: 999px;
  border: 2px solid transparent;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  position: relative;
  background: transparent;
}

.pd-color::before {
  content: "";
  position: absolute;
  inset: 2px;
  border-radius: 999px;
  background: var(--swatch-color, linear-gradient(135deg, #f7f2ff 0%, #efe2ff 100%));
  transition: inherit;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.pd-color span {
  font-size: 0.72rem;
  font-weight: 600;
  color: #5B265D;
  text-transform: capitalize;
  position: relative;
  z-index: 1;
}

.variant-option[type="radio"]:checked + .pd-color {
  border-color: #6D4975;
  box-shadow: 0 0 0 4px rgba(109, 73, 117, 0.12);
}

.variant-option[type="radio"]:checked + .pd-color::before {
  box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.85);
}

.variant-option[type="radio"] + .pd-color:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 14px rgba(91, 38, 93, 0.12);
}

.pd-color.no-color::before {
  background: linear-gradient(135deg, #f7f2ff 0%, #efe2ff 100%);
}

.selected-variant-label small {
  font-size: 0.75rem;
  font-weight: 500;
  color: #5F6C72;
}

.selected-variant-label span {
  color: #5B265D;
}

.share-actions .share-btn {
  background: #f8f0fb;
  border: 1px solid transparent;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  padding: 0;
}

.share-actions .share-btn:hover {
  border-color: rgba(91, 38, 93, 0.25);
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(91, 38, 93, 0.15);
}

.share-actions .share-btn img {
  width: 18px;
  height: 18px;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .cart-bar {
    padding: 0.75rem 0;
  }
  
  .cart-bar-content {
    flex-direction: column;
    gap: 1rem;
    align-items: stretch;
  }
  
  .cart-bar-info {
    justify-content: center;
  }
  
  .cart-bar-actions {
    flex-direction: column;
    width: 100%;
  }
  
  .btn-view-cart,
  .btn-checkout {
    width: 100%;
    text-align: center;
  }
  
  .cart-summary {
    text-align: center;
  }
  
  .cart-notification {
    right: 10px;
    left: 10px;
    transform: translateY(-100px);
  }
  
  .cart-notification.show {
    transform: translateY(0);
  }
}
</style>
@endpush

@push('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
  // Image gallery functionality
        const mainImg = document.getElementById("pdMainImg");
        const thumbs = Array.from(document.querySelectorAll(".pd-thumb"));
        const prevBtn = document.querySelector('.pd-nav[data-dir="prev"]');
        const nextBtn = document.querySelector('.pd-nav[data-dir="next"]');

  if (thumbs.length > 0) {
        function getActiveIndex() {
          return Math.max(
            0,
            thumbs.findIndex((el) => el.classList.contains("active"))
          );
        }

        function setActive(index) {
          const boundedIndex = (index + thumbs.length) % thumbs.length;
          thumbs.forEach((x) => x.classList.remove("active"));
          const target = thumbs[boundedIndex];
          target.classList.add("active");
          mainImg.src = target.src;
          target.scrollIntoView({
            behavior: "smooth",
            inline: "center",
            block: "nearest",
          });
        }

        thumbs.forEach((t, i) => {
          t.addEventListener("click", () => setActive(i));
        });

        if (prevBtn)
          prevBtn.addEventListener("click", () =>
            setActive(getActiveIndex() - 1)
          );
        if (nextBtn)
          nextBtn.addEventListener("click", () =>
            setActive(getActiveIndex() + 1)
          );
  }

  // Quantity controls
        const qtyInput = document.getElementById("qtyInput");
  const qtyMinus = document.getElementById("qtyMinus");
  const qtyPlus = document.getElementById("qtyPlus");
  
  if (qtyMinus) {
    qtyMinus.addEventListener("click", () => {
          const v = Math.max(1, parseInt(qtyInput.value || "1", 10) - 1);
          qtyInput.value = v;
        });
  }
  
  if (qtyPlus) {
    qtyPlus.addEventListener("click", () => {
          const v = Math.min(99, parseInt(qtyInput.value || "1", 10) + 1);
          qtyInput.value = v;
        });
  }

  // Add to cart button handler
  const addToCartBtn = document.querySelector('.add-to-cart-btn-detail');
  if (addToCartBtn) {
    addToCartBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const productId = this.getAttribute('data-product-id');
      const quantity = parseInt(qtyInput.value || '1', 10);
      const selectedVariants = getSelectedVariants();
      
      addToCart(productId, quantity, selectedVariants);
    });
  }

  const buyNowBtn = document.querySelector('.buy-now-btn');
  if (buyNowBtn) {
    buyNowBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const productId = this.getAttribute('data-product-id');
      const quantity = parseInt(qtyInput.value || '1', 10);
      const selectedVariants = getSelectedVariants();
      
      buyNow(productId, quantity, selectedVariants);
    });
  }

  // Cart functionality
  function addToCart(productId, quantity = 1, variants = {}) {
    fetch(`{{ url('/cart/add') }}/${productId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({ 
        quantity: quantity,
        variants: variants
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        updateCartBar();
        showCartNotification('Product added to cart!', 'success');
      } else {
        showCartNotification(data.message || 'Failed to add product to cart', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showCartNotification('An error occurred. Please try again.', 'error');
    });
  }

  function buyNow(productId, quantity = 1, variants = {}) {
    fetch(`{{ url('/cart/add') }}/${productId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({
        quantity: quantity,
        variants: variants,
        replace: true
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        window.location.href = '{{ route("frontend.checkout") }}';
      } else {
        showCartNotification(data.message || 'Failed to process request', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showCartNotification('An error occurred. Please try again.', 'error');
    });
  }

  function updateCartBar() {
    fetch('{{ route("frontend.cart.get") }}', {
      method: 'GET',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const cartBar = document.getElementById('cartBar');
        const cartCountBadge = document.getElementById('cartCountBadge');
        const cartItemsText = document.getElementById('cartItemsText');
        const cartTotalText = document.getElementById('cartTotalText');
        
        if (data.cart_count > 0) {
          cartBar.style.display = 'block';
          cartCountBadge.textContent = data.cart_count;
          cartItemsText.textContent = data.cart_count === 1 ? '1 item' : `${data.cart_count} items`;
          cartTotalText.textContent = data.cart_total_formatted;
          document.body.style.paddingBottom = window.innerWidth <= 768 ? '140px' : '100px';
        } else {
          cartBar.style.display = 'none';
          document.body.style.paddingBottom = '0';
        }
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }

  function showCartNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `cart-notification cart-notification-${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
      notification.classList.remove('show');
      setTimeout(() => {
        notification.remove();
      }, 300);
    }, 3000);
  }

  // Variant price update functionality
  const productSlug = '{{ $product->slug }}';
  const productShareUrl = '{{ url()->current() }}';
  const productShareTitle = @json($product->name);
  let priceUpdateTimeout = null;
  
  function getSelectedVariants() {
    const selectedVariants = {};
    
    // Get all radio buttons that are checked
    const checkedRadios = document.querySelectorAll('.variant-option[type="radio"]:checked');
    checkedRadios.forEach(radio => {
      const variantId = radio.getAttribute('data-variant-id');
      selectedVariants[variantId] = radio.value;
    });
    
    // Get all select elements with variant-option class
    const selectElements = document.querySelectorAll('select.variant-option');
    selectElements.forEach(select => {
      const variantId = select.getAttribute('data-variant-id');
      selectedVariants[variantId] = select.value;
    });
    
    return selectedVariants;
  }

  function updateVariantLabels() {
    const labelElements = document.querySelectorAll('.selected-variant-label');
    labelElements.forEach(label => {
      const variantId = label.getAttribute('data-variant-id');
      let valueText = '';

      const checkedRadio = document.querySelector(`.variant-option[type="radio"][data-variant-id="${variantId}"]:checked`);
      if (checkedRadio) {
        valueText = checkedRadio.getAttribute('data-option-value');
      } else {
        const select = document.querySelector(`select.variant-option[data-variant-id="${variantId}"]`);
        if (select) {
          valueText = select.options[select.selectedIndex]?.getAttribute('data-option-value') || select.value;
        }
      }

      if (!valueText) {
        const fallbackButton = document.querySelector(`.variant-option[data-variant-id="${variantId}"]`);
        valueText = fallbackButton?.getAttribute('data-option-value') || '';
      }

      const valueSpan = label.querySelector('span');
      if (valueSpan) {
        valueSpan.textContent = valueText;
      }
    });
  }
  
  function updatePrice() {
    const selectedVariants = getSelectedVariants();
    const priceElement = document.getElementById('productPrice');
    const comparePriceElement = document.getElementById('productComparePrice');
    const discountElement = document.getElementById('productDiscount');
    
    // Store current price for fallback
    const currentPrice = priceElement ? priceElement.textContent : '';
    
    // Show subtle loading state (don't change text, just opacity)
    if (priceElement) {
      priceElement.style.transition = 'opacity 0.2s ease';
      priceElement.style.opacity = '0.6';
    }
    
    // Prepare request data
    const formData = new FormData();
    Object.keys(selectedVariants).forEach(variantId => {
      formData.append(`variants[${variantId}]`, selectedVariants[variantId]);
    });
    
    fetch(`{{ route('frontend.product.variant-price', $product->slug) }}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if (data.success) {
        // Update price with smooth animation
        if (priceElement) {
          // Fade out
          priceElement.style.transition = 'opacity 0.2s ease';
          priceElement.style.opacity = '0';
          
          setTimeout(() => {
            // Update content and fade in
            priceElement.textContent = data.price_formatted;
            priceElement.style.opacity = '1';
          }, 200);
        }
        
        // Update compare price
        if (comparePriceElement) {
          if (data.compare_at_price_formatted) {
            comparePriceElement.style.transition = 'opacity 0.2s ease';
            comparePriceElement.style.opacity = '0';
            setTimeout(() => {
              comparePriceElement.textContent = data.compare_at_price_formatted;
              comparePriceElement.style.display = '';
              comparePriceElement.style.opacity = '1';
            }, 200);
          } else {
            comparePriceElement.style.opacity = '0';
            setTimeout(() => {
              comparePriceElement.style.display = 'none';
            }, 200);
          }
        }
        
        // Update discount badge
        if (discountElement) {
          if (data.discount) {
            discountElement.style.transition = 'opacity 0.2s ease';
            discountElement.style.opacity = '0';
            setTimeout(() => {
              discountElement.textContent = data.discount + '% OFF';
              discountElement.style.display = '';
              discountElement.style.opacity = '1';
            }, 200);
          } else {
            discountElement.style.opacity = '0';
            setTimeout(() => {
              discountElement.style.display = 'none';
            }, 200);
          }
        }
      }
    })
    .catch(error => {
      console.error('Error updating price:', error);
      // Restore original price on error
      if (priceElement) {
        priceElement.style.opacity = '1';
        if (currentPrice) {
          priceElement.textContent = currentPrice;
        }
      }
    });
  }
  
  // Add event listeners to variant options
  const variantOptionsContainer = document.getElementById('variantOptions');
  if (variantOptionsContainer) {
    const handleVariantChange = () => {
      clearTimeout(priceUpdateTimeout);
      priceUpdateTimeout = setTimeout(() => {
        updatePrice();
      }, 200);
    };

    variantOptionsContainer.addEventListener('change', function(e) {
      const target = e.target;
      if (target.classList.contains('variant-option') || target.closest('.variant-option')) {
        handleVariantChange();
        updateVariantLabels();
      }
    });
    
    variantOptionsContainer.addEventListener('click', function(e) {
      const target = e.target;
      if (target.type === 'radio' && target.classList.contains('variant-option')) {
        clearTimeout(priceUpdateTimeout);
        priceUpdateTimeout = setTimeout(() => {
          updatePrice();
        }, 150);
        updateVariantLabels();
      }
    });
    
    const selectElements = variantOptionsContainer.querySelectorAll('select.variant-option');
    selectElements.forEach(select => {
      select.addEventListener('change', handleVariantChange);
      select.addEventListener('change', updateVariantLabels);
    });

    // Set initial price state
    updatePrice();
    updateVariantLabels();
  }

  // Review star interactions
  const reviewStarInputs = document.querySelectorAll('.review-star-input');
  const reviewStarLabels = document.querySelectorAll('.review-star');

  const setReviewStarState = (value) => {
    reviewStarLabels.forEach(label => {
      const starValue = parseInt(label.getAttribute('for').replace('rating', ''), 10);
      if (starValue <= value) {
        label.classList.add('active');
      } else {
        label.classList.remove('active');
      }
    });
  };

  reviewStarInputs.forEach(input => {
    input.addEventListener('change', () => {
      setReviewStarState(parseInt(input.value, 10));
    });
  });

  reviewStarLabels.forEach(label => {
    label.addEventListener('mouseenter', () => {
      setReviewStarState(parseInt(label.getAttribute('for').replace('rating', ''), 10));
    });
    label.addEventListener('mouseleave', () => {
      const checked = document.querySelector('.review-star-input:checked');
      setReviewStarState(checked ? parseInt(checked.value, 10) : 0);
    });
  });

  const initialCheckedStar = document.querySelector('.review-star-input:checked');
  setReviewStarState(initialCheckedStar ? parseInt(initialCheckedStar.value, 10) : 0);

  // Share buttons
  const shareButtons = document.querySelectorAll('.share-actions .share-btn');
  if (shareButtons.length > 0) {
    shareButtons.forEach(btn => {
      btn.addEventListener('click', function(e) {
        const type = this.getAttribute('data-share');
        if (!type) return;

        if (type === 'copy') {
          e.preventDefault();
          if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(productShareUrl)
              .then(() => showCartNotification('Product link copied to clipboard!', 'success'))
              .catch(() => {
                showCartNotification('Unable to copy. Please try again.', 'error');
              });
          } else {
            // Fallback for older browsers
            const tempInput = document.createElement('input');
            tempInput.value = productShareUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            tempInput.setSelectionRange(0, 99999);
            try {
              document.execCommand('copy');
              showCartNotification('Product link copied to clipboard!', 'success');
            } catch (err) {
              showCartNotification('Unable to copy. Please try again.', 'error');
            }
            document.body.removeChild(tempInput);
          }
        } else {
          e.preventDefault();
          let shareUrl = '';
          const encodedUrl = encodeURIComponent(productShareUrl);
          const encodedTitle = encodeURIComponent(productShareTitle);

          switch (type) {
            case 'facebook':
              shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
              break;
            case 'twitter':
              shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedTitle}`;
              break;
            case 'pinterest':
              shareUrl = `https://pinterest.com/pin/create/button/?url=${encodedUrl}&description=${encodedTitle}`;
              break;
            default:
              return;
          }

          window.open(shareUrl, '_blank', 'width=600,height=600,noopener,noreferrer');
        }
      });
    });
  }

  // Wishlist toggle
  const wishlistButton = document.querySelector('.add-wishlist-btn');
  if (wishlistButton) {
    const wishlistLabel = wishlistButton.querySelector('.wishlist-label');
    const wishlistIcon = wishlistButton.querySelector('i');
    const wishlistProductId = wishlistButton.getAttribute('data-product-id');
    const wishlistEndpoints = {
      add: '{{ url('/wishlist/add') }}',
      remove: '{{ url('/wishlist/remove') }}',
    };

    const updateWishlistButtonState = (isActive) => {
      if (isActive) {
        wishlistButton.classList.add('active');
        wishlistIcon.classList.remove('bi-heart');
        wishlistIcon.classList.add('bi-heart-fill');
        wishlistLabel.textContent = 'Added to Wishlist';
      } else {
        wishlistButton.classList.remove('active');
        wishlistIcon.classList.remove('bi-heart-fill');
        wishlistIcon.classList.add('bi-heart');
        wishlistLabel.textContent = 'Add to Wishlist';
      }
    };

    wishlistButton.addEventListener('click', function(event) {
      event.preventDefault();
      const isCurrentlyActive = wishlistButton.classList.contains('active');
      const action = isCurrentlyActive ? 'remove' : 'add';
      const endpoint = `${wishlistEndpoints[action]}/${wishlistProductId}`;

      fetch(endpoint, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
          'X-Requested-With': 'XMLHttpRequest'
        },
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          updateWishlistButtonState(action === 'add');
          showCartNotification(data.message, 'success');
        } else {
          showCartNotification('Unable to update wishlist. Please try again.', 'error');
        }
      })
      .catch(() => {
        showCartNotification('Unable to update wishlist. Please try again.', 'error');
      });
    });
  }

  // Initialize cart bar on page load
  updateCartBar();
});
</script>
@endpush

