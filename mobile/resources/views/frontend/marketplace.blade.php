@extends('frontend.layouts.app')

@section('title', 'Marketplace')

@section('content')
<!-- Begin:: marketplace-header  -->

    <div class="marketplace-header py-3">
      <div class="container flex-center flex-wrap gap-3">
        <div class="dropdown show-on-hover">
          <button
            class="btn dropdown-toggle category-btn"
            type="button"
            id="categoryDropdown"
            data-bs-toggle="dropdown"
            data-bs-auto-close="true"
            aria-expanded="false"
          >
            @if(request('category'))
              @php
                $selectedCategory = $categories->firstWhere('id', request('category'));
              @endphp
              {{ $selectedCategory ? $selectedCategory->name : 'All Category' }}
            @else
              All Category
            @endif
          </button>
          <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
            <li>
              <a class="dropdown-item {{ !request('category') ? 'active' : '' }}" href="{{ route('frontend.marketplace') }}">
                <i class="bi bi-grid me-2"></i> All Category
              </a>
            </li>
            @if($categories->count() > 0)
            <li><hr class="dropdown-divider"></li>
            @endif
            @foreach($categories as $category)
            <li>
              <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}" href="{{ route('frontend.marketplace', ['category' => $category->id]) }}">
                {{ $category->name }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="d-flex align-items-center gap-4 text-muted">
          <a href="{{ route('frontend.track-order') }}" class="top-link d-flex align-items-center gap-2">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M5.25 21.75H18.75"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M19.5 9.75C19.5 16.5 12 21.75 12 21.75C12 21.75 4.5 16.5 4.5 9.75C4.5 7.76088 5.29018 5.85322 6.6967 4.4467C8.10322 3.04018 10.0109 2.25 12 2.25C13.9891 2.25 15.8968 3.04018 17.3033 4.4467C18.7098 5.85322 19.5 7.76088 19.5 9.75V9.75Z"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 12.75C13.6569 12.75 15 11.4069 15 9.75C15 8.09315 13.6569 6.75 12 6.75C10.3431 6.75 9 8.09315 9 9.75C9 11.4069 10.3431 12.75 12 12.75Z"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            Track Order
          </a>
          <a href="{{ route('frontend.contact') }}" class="top-link d-flex align-items-center gap-2">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M21.1406 12.7503H18.1406C17.7428 12.7503 17.3613 12.9083 17.08 13.1897C16.7987 13.471 16.6406 13.8525 16.6406 14.2503V18.0003C16.6406 18.3981 16.7987 18.7797 17.08 19.061C17.3613 19.3423 17.7428 19.5003 18.1406 19.5003H19.6406C20.0384 19.5003 20.42 19.3423 20.7013 19.061C20.9826 18.7797 21.1406 18.3981 21.1406 18.0003V12.7503ZM21.1406 12.7503C21.1407 11.5621 20.9054 10.3856 20.4484 9.28875C19.9915 8.1919 19.3218 7.1964 18.4781 6.35969C17.6344 5.52297 16.6334 4.86161 15.5328 4.41375C14.4322 3.96589 13.2538 3.74041 12.0656 3.75031C10.8782 3.74165 9.70083 3.96805 8.60132 4.41647C7.5018 4.86488 6.50189 5.52645 5.6592 6.36304C4.81651 7.19963 4.1477 8.19471 3.69131 9.29094C3.23492 10.3872 2.99997 11.5629 3 12.7503V18.0003C3 18.3981 3.15804 18.7797 3.43934 19.061C3.72064 19.3423 4.10218 19.5003 4.5 19.5003H6C6.39782 19.5003 6.77936 19.3423 7.06066 19.061C7.34196 18.7797 7.5 18.3981 7.5 18.0003V14.2503C7.5 13.8525 7.34196 13.471 7.06066 13.1897C6.77936 12.9083 6.39782 12.7503 6 12.7503H3"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            Customer Support
          </a>
          <a href="{{ route('frontend.contact') }}" class="top-link d-flex align-items-center gap-2">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11.25 11.25H12V16.5H12.75"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11.8125 7.5C12.0196 7.5 12.1875 7.66789 12.1875 7.875C12.1875 8.08211 12.0196 8.25 11.8125 8.25C11.6054 8.25 11.4375 8.08211 11.4375 7.875C11.4375 7.66789 11.6054 7.5 11.8125 7.5Z"
                fill="#191C1F"
                stroke="#5F6C72"
                stroke-width="1.5"
              />
            </svg>
            Need Help
          </a>
        </div>
      </div>
    </div>
    <!-- End:: marketplace-header  -->

    <!-- Begin:: marketplace-navigation  -->
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
            @php
              $categoryFilter = collect($activeFilters)->firstWhere('type', 'category');
              $brandFilter = collect($activeFilters)->firstWhere('type', 'brand');
              $tagFilter = collect($activeFilters)->firstWhere('type', 'tag');
            @endphp
            @if($categoryFilter)
              <li class="breadcrumb-item active" aria-current="page">
                {{ $categoryFilter['label'] }}
              </li>
            @elseif($brandFilter)
              <li class="breadcrumb-item active" aria-current="page">
                {{ $brandFilter['label'] }}
              </li>
            @elseif($tagFilter)
              <li class="breadcrumb-item active" aria-current="page">
                {{ $tagFilter['label'] }}
              </li>
            @else
              <li class="breadcrumb-item active" aria-current="page">
                All Products
              </li>
            @endif
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <!-- ðŸ”¹ Market Place Main Layout -->
    <section class="marketplace-main-layout">
      <div class="container py-3">
        <!-- Toolbar Row (Search, Sort, etc.) -->
        <div
          class="d-flex flex-wrap align-items-center justify-content-between mb-3"
        >
          <div>
            <button
              class="btn btn-light d-lg-none"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasFilters"
            >
              <i class="bi bi-sliders"></i> Filters
            </button>
          </div>
          <div class="sort-section flex-center gap-3 d-sm-none">
            <div class="dropdown">
              <button
                class="btn dropdown-toggle sortby-btn"
                type="button"
                id="sortDropdownMobile"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                @php
                  $sortOptions = [
                    'popular' => 'Most Popular',
                    'price_low' => 'Price: Low to High',
                    'price_high' => 'Price: High to Low',
                    'newest' => 'Newest First',
                    'oldest' => 'Oldest First',
                    'name_asc' => 'Name: A to Z',
                    'name_desc' => 'Name: Z to A',
                  ];
                  $currentSortLabel = $sortOptions[$sortBy] ?? 'Most Popular';
                @endphp
                {{ $currentSortLabel }}
              </button>
              <ul class="dropdown-menu" aria-labelledby="sortDropdownMobile">
                @php
                  $currentParams = request()->query();
                  unset($currentParams['sort']);
                @endphp
                <li>
                  <a class="dropdown-item {{ $sortBy == 'popular' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'popular'])) }}">
                    Most Popular
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ $sortBy == 'price_low' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'price_low'])) }}">
                    Price: Low to High
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ $sortBy == 'price_high' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'price_high'])) }}">
                    Price: High to Low
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ $sortBy == 'newest' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'newest'])) }}">
                    Newest First
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ $sortBy == 'oldest' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'oldest'])) }}">
                    Oldest First
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ $sortBy == 'name_asc' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'name_asc'])) }}">
                    Name: A to Z
                  </a>
                </li>
                <li>
                  <a class="dropdown-item {{ $sortBy == 'name_desc' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'name_desc'])) }}">
                    Name: Z to A
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- ðŸ”¹ Content Layout -->
        <div class="row g-3">
          <!-- Sidebar (lg+) -->
          <aside class="col-lg-3 d-none d-lg-block">
            <h3 class="sidebar-heading">Category</h3>
            <form class="filter-options mt-3" id="categoryFilter">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat_all"
                  value=""
                  {{ !request('category') ? 'checked' : '' }}
                />
                <label class="form-check-label" for="cat_all">All Categories</label>
              </div>
              @foreach($categories as $category)
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat_{{ $category->id }}"
                  value="{{ $category->id }}"
                  {{ request('category') == $category->id ? 'checked' : '' }}
                />
                <label class="form-check-label" for="cat_{{ $category->id }}">{{ $category->name }}</label>
              </div>
              @endforeach
            </form>
            <hr />
            <h3 class="sidebar-heading">Price Range</h3>
            <!-- Slider -->

            <div class="double_range_slider">
              <span class="range_track" id="range_track"></span>

              <input
                type="range"
                class="min_range"
                min="0"
                max="10000"
                value="{{ request('min_price') ?? 0 }}"
                step="1"
              />
              <input
                type="range"
                class="max_range"
                min="0"
                max="10000"
                value="{{ request('max_price') ?? 10000 }}"
                step="1"
              />
            </div>

            <div class="flex-center gap-3">
              <input
                type="text"
                id="minInput"
                placeholder="Min price"
                class="custom-range-input"
                value="{{ request('min_price') ?? '' }}"
              />
              <input
                type="text"
                id="maxInput"
                placeholder="Max price"
                class="custom-range-input"
                value="{{ request('max_price') ?? '' }}"
              />
            </div>

            <form class="filter-options mt-3" id="priceRadioFilter">
              @php
                $currentMin = (int)request('min_price', 0);
                $currentMax = (int)request('max_price', 0);
                $hasPriceFilter = request()->has('min_price') || request()->has('max_price');
              @endphp
              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price1"
                  value="all"
                  data-min=""
                  data-max=""
                  {{ !$hasPriceFilter ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price1"> All Price </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price2"
                  value="under_20"
                  data-min="0"
                  data-max="20"
                  {{ $currentMin == 0 && $currentMax == 20 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price2"> Under {{ $settings->currency_symbol ?? '$' }}20 </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price3"
                  value="25_100"
                  data-min="25"
                  data-max="100"
                  {{ $currentMin == 25 && $currentMax == 100 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price3">
                  {{ $settings->currency_symbol ?? '$' }}25 to {{ $settings->currency_symbol ?? '$' }}100
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price4"
                  value="100_300"
                  data-min="100"
                  data-max="300"
                  {{ $currentMin == 100 && $currentMax == 300 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price4">
                  {{ $settings->currency_symbol ?? '$' }}100 to {{ $settings->currency_symbol ?? '$' }}300
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price5"
                  value="300_500"
                  data-min="300"
                  data-max="500"
                  {{ $currentMin == 300 && $currentMax == 500 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price5">
                  {{ $settings->currency_symbol ?? '$' }}300 to {{ $settings->currency_symbol ?? '$' }}500
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price6"
                  value="500_1000"
                  data-min="500"
                  data-max="1000"
                  {{ $currentMin == 500 && $currentMax == 1000 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price6">
                  {{ $settings->currency_symbol ?? '$' }}500 to {{ $settings->currency_symbol ?? '$' }}1,000
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price7"
                  value="1000_10000"
                  data-min="1000"
                  data-max="10000"
                  {{ $currentMin == 1000 && $currentMax == 10000 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price7">
                  {{ $settings->currency_symbol ?? '$' }}1,000 to {{ $settings->currency_symbol ?? '$' }}10,000
                </label>
              </div>
            </form>
            <hr />
            <div class="brand-filter">
              <h3 class="sidebar-heading">popular Brands</h3>
              <div class="row g-2 mt-3" id="brandFilter">
                @php
                  $brandChunks = $brands->chunk(ceil($brands->count() / 2));
                @endphp
                @foreach($brandChunks as $chunk)
                <div class="col-6">
                  @foreach($chunk as $brand)
                  <div class="form-check">
                    <input
                      class="form-check-input brand-checkbox"
                      type="checkbox"
                      id="brand_{{ $brand->id }}"
                      value="{{ $brand->id }}"
                      {{ request('brand') == $brand->id ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                  </div>
                  @endforeach
                </div>
                @endforeach
              </div>
            </div>
            <hr />
            <div class="popular-tags mt-4">
              <h6 class="fw-bold mb-3">POPULAR TAG</h6>
              <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('frontend.marketplace') }}" class="tag-btn {{ !request('tag') ? 'active' : '' }}">All</a>
                @foreach($tags as $tag)
                <a href="{{ route('frontend.marketplace', ['tag' => $tag->id]) }}" class="tag-btn {{ request('tag') == $tag->id ? 'active' : '' }}">{{ $tag->name }}</a>
                @endforeach
              </div>
            </div>
            @if($featuredProducts->count() > 0)
            <div class="side-product-card text-center p-4 mt-3" id="featuredProductCard">
              @foreach($featuredProducts as $index => $product)
              <div class="featured-product-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                <img
                  src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/watch-collection.svg') }}"
                  alt="{{ $product->name }}"
                  class="img-fluid mb-3"
                />

                @if($product->brand && $product->brand->logo)
                <img
                  src="{{ asset('storage/' . $product->brand->logo) }}"
                  alt="{{ $product->brand->name }}"
                  class="apple-logo"
                />
                @endif

                <h6 class="product-subtitle mb-3">
                  {{ Str::limit($product->name, 50) }}
                </h6>

                <p class="price-text mb-4">
                  Only for: <span class="price-tag">{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->price, 2) }}</span>
                  @if($product->compare_at_price)
                  <small class="text-muted text-decoration-line-through d-block">{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->compare_at_price, 2) }}</small>
                  @endif
                </p>

                <div class="d-grid gap-2">
                  <button class="add-cart-btn" onclick="addToCart({{ $product->id }})">
                    <svg
                      width="20"
                      height="20"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M3.125 10H16.875"
                        stroke="#5B265D"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M11.25 4.375L16.875 10L11.25 15.625"
                        stroke="#5B265D"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                    ADD TO CART
                  </button>

                  <a href="{{ route('frontend.product-detail', $product->slug) }}" class="view-details-btn text-decoration-none">
                    VIEW DETAILS <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
              @endforeach
            </div>
            @endif
          </aside>

          <!-- Main Content -->
          <main class="col-lg-9">
            <div class="h-100">
              <header class="flex-between">
                <div class="search w-100 w-sm-50">
                  <input type="text" id="searchInput" placeholder="Search for anything..." value="{{ request('search') ?? '' }}" />
                  <i class="bi bi-search"></i>
                </div>
                <div class="sort-section flex-center gap-3 d-none d-sm-flex">
                  <label for="">Sort by:</label>
                  <div class="dropdown">
                    <button
                      class="btn dropdown-toggle sortby-btn"
                      type="button"
                      id="sortDropdownDesktop"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      @php
                        $sortOptions = [
                          'popular' => 'Most Popular',
                          'price_low' => 'Price: Low to High',
                          'price_high' => 'Price: High to Low',
                          'newest' => 'Newest First',
                          'oldest' => 'Oldest First',
                          'name_asc' => 'Name: A to Z',
                          'name_desc' => 'Name: Z to A',
                        ];
                        $currentSortLabel = $sortOptions[$sortBy] ?? 'Most Popular';
                      @endphp
                      {{ $currentSortLabel }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdownDesktop">
                      @php
                        $currentParams = request()->query();
                        unset($currentParams['sort']);
                      @endphp
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'popular' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'popular'])) }}">
                          Most Popular
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'price_low' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'price_low'])) }}">
                          Price: Low to High
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'price_high' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'price_high'])) }}">
                          Price: High to Low
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'newest' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'newest'])) }}">
                          Newest First
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'oldest' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'oldest'])) }}">
                          Oldest First
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'name_asc' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'name_asc'])) }}">
                          Name: A to Z
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item {{ $sortBy == 'name_desc' ? 'active' : '' }}" href="{{ route('frontend.marketplace', array_merge($currentParams, ['sort' => 'name_desc'])) }}">
                          Name: Z to A
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </header>
              <!-- Begin::filter section  -->
              <section class="filter-section my-3">
                <div
                  class="d-flex align-items-center justify-content-between py-2"
                >
                  <div class="d-flex align-items-center flex-wrap gap-2" id="activeFiltersContainer">
                    @if(count($activeFilters) > 0)
                    <span class="text-secondary me-1 fs-14 fw-400"
                      >Active Filters:</span
                    >
                    @foreach($activeFilters as $filter)
                    <span class="d-inline-flex align-items-center fs-14 fw-400 badge bg-light text-dark border">
                      {{ $filter['label'] }}
                      <button
                        type="button"
                        class="btn-close ms-2"
                        aria-label="Remove"
                        onclick="removeFilter('{{ $filter['type'] }}')"
                      ></button>
                    </span>
                    @endforeach
                    @if(count($activeFilters) > 0)
                    <button
                      type="button"
                      class="btn btn-sm btn-outline-secondary"
                      onclick="clearAllFilters()"
                    >
                      Clear All
                    </button>
                    @endif
                    @else
                    <span class="text-secondary fs-14 fw-400">No active filters</span>
                    @endif
                  </div>

                  <div class="text-heading fs-14 fw-400">
                    <span class="fw-600 text-dark" id="totalResults">{{ number_format($totalResults) }}</span> Results found.
                  </div>
                </div>
              </section>
              <!-- End::filter section  -->

              <div
                class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3"
                id="productGrid"
              >
                @forelse($products as $product)
                <div class="col">
                  <div class="product-card h-100 position-relative">
                    @if($product->is_hot_product)
                    <span class="product-badge badge-danger">HOT</span>
                    @elseif($product->is_best_deal)
                    <span class="product-badge badge-danger">BEST DEALS</span>
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
                        $marketplaceRating = round($product->approved_rating ?? 0, 1);
                        $marketplaceReviewCount = $product->approved_reviews_count ?? 0;
                        $marketplaceRounded = $marketplaceReviewCount > 0 ? round($marketplaceRating * 2) / 2 : 0;
                        $marketplaceFull = (int) floor($marketplaceRounded);
                        $marketplaceHalf = ($marketplaceRounded - $marketplaceFull) === 0.5;
                        $marketplaceEmpty = 5 - $marketplaceFull - ($marketplaceHalf ? 1 : 0);
                      @endphp
                      <div class="rating mt-3 d-flex align-items-center gap-2">
                        <span class="text-primary-custom rating-stars-sm">
                          @for ($i = 0; $i < $marketplaceFull; $i++)
                            <i class="bi bi-star-fill"></i>
                          @endfor
                          @if ($marketplaceHalf)
                            <i class="bi bi-star-half"></i>
                          @endif
                          @for ($i = 0; $i < $marketplaceEmpty; $i++)
                            <i class="bi bi-star"></i>
                          @endfor
                        </span>
                        <span class="rating-count">
                          @if($marketplaceReviewCount > 0)
                            {{ number_format($marketplaceRating, 1) }} ({{ $marketplaceReviewCount }})
                          @else
                            (0)
                          @endif
                        </span>
                      </div>
                      <a href="{{ route('frontend.product-detail', $product->slug) }}" class="text-decoration-none text-dark">
                        <p class="product-title mt-2 mb-0">{{ Str::limit($product->name, 50) }}</p>
                      </a>
                      <div class="product-price text-promo">
                        {{ $settings->currency_symbol ?? '$' }}{{ number_format($product->price, 2) }}
                        @if($product->compare_at_price)
                        <small class="text-muted text-decoration-line-through">{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->compare_at_price, 2) }}</small>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                <div class="col-12">
                  <p class="text-center py-5">No products found.</p>
                </div>
                @endforelse
              </div>
              <div id="paginationContainer">
                @if($products->hasPages())
                <nav
                  class="pagination-nav d-flex justify-content-center mt-5"
                  aria-label="Page navigation"
                >
                  {{ $products->links() }}
                </nav>
                @endif
              </div>
            </div>
          </main>
        </div>
      </div>

      <!-- ðŸ”¹ Offcanvas Sidebar (md and below) -->
      <div
        class="offcanvas offcanvas-start"
        tabindex="-1"
        id="offcanvasFilters"
      >
        <div class="offcanvas-header">
          <h5 class="mb-0">Filters</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
          ></button>
        </div>
        <div class="offcanvas-body">
          <aside class="">
            <h3 class="sidebar-heading">Category</h3>
            <form class="filter-options mt-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat1"
                />
                <label class="form-check-label" for="cat1"
                  >Computer &amp; Laptop</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat2"
                />
                <label class="form-check-label" for="cat2"
                  >Computer Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat3"
                />
                <label class="form-check-label" for="cat3">SmartPhone</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat4"
                />
                <label class="form-check-label" for="cat4">Headphone</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat5"
                />
                <label class="form-check-label" for="cat5"
                  >Mobile Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat6"
                />
                <label class="form-check-label" for="cat6"
                  >Gaming Console</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat7"
                />
                <label class="form-check-label" for="cat7"
                  >Camera &amp; Photo</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat8"
                />
                <label class="form-check-label" for="cat8"
                  >TV &amp; Homes Appliances</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat9"
                />
                <label class="form-check-label" for="cat9"
                  >Watches &amp; Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat10"
                />
                <label class="form-check-label" for="cat10"
                  >GPS &amp; Navigation</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat11"
                />
                <label class="form-check-label" for="cat11"
                  >Wearable Technology</label
                >
              </div>
            </form>
            <hr />
            <h3 class="sidebar-heading">Price Range</h3>
            <!-- Slider -->

            <div class="double_range_slider">
              <span class="range_track" id="range_track"></span>

              <input
                type="range"
                class="min_range"
                min="0"
                max="10000"
                value="{{ request('min_price') ?? 0 }}"
                step="1"
              />
              <input
                type="range"
                class="max_range"
                min="0"
                max="10000"
                value="{{ request('max_price') ?? 10000 }}"
                step="1"
              />
            </div>

            <div class="flex-center gap-3">
              <input
                type="text"
                id="minInput"
                placeholder="Min price"
                class="custom-range-input"
                value="{{ request('min_price') ?? '' }}"
              />
              <input
                type="text"
                id="maxInput"
                placeholder="Max price"
                class="custom-range-input"
                value="{{ request('max_price') ?? '' }}"
              />
            </div>

            <form class="filter-options mt-3" id="priceRadioFilter">
              @php
                $currentMin = (int)request('min_price', 0);
                $currentMax = (int)request('max_price', 0);
                $hasPriceFilter = request()->has('min_price') || request()->has('max_price');
              @endphp
              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price1"
                  value="all"
                  data-min=""
                  data-max=""
                  {{ !$hasPriceFilter ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price1"> All Price </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price2"
                  value="under_20"
                  data-min="0"
                  data-max="20"
                  {{ $currentMin == 0 && $currentMax == 20 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price2"> Under {{ $settings->currency_symbol ?? '$' }}20 </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price3"
                  value="25_100"
                  data-min="25"
                  data-max="100"
                  {{ $currentMin == 25 && $currentMax == 100 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price3">
                  {{ $settings->currency_symbol ?? '$' }}25 to {{ $settings->currency_symbol ?? '$' }}100
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price4"
                  value="100_300"
                  data-min="100"
                  data-max="300"
                  {{ $currentMin == 100 && $currentMax == 300 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price4">
                  {{ $settings->currency_symbol ?? '$' }}100 to {{ $settings->currency_symbol ?? '$' }}300
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price5"
                  value="300_500"
                  data-min="300"
                  data-max="500"
                  {{ $currentMin == 300 && $currentMax == 500 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price5">
                  {{ $settings->currency_symbol ?? '$' }}300 to {{ $settings->currency_symbol ?? '$' }}500
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price6"
                  value="500_1000"
                  data-min="500"
                  data-max="1000"
                  {{ $currentMin == 500 && $currentMax == 1000 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price6">
                  {{ $settings->currency_symbol ?? '$' }}500 to {{ $settings->currency_symbol ?? '$' }}1,000
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input price-radio"
                  type="radio"
                  name="price"
                  id="price7"
                  value="1000_10000"
                  data-min="1000"
                  data-max="10000"
                  {{ $currentMin == 1000 && $currentMax == 10000 ? 'checked' : '' }}
                />
                <label class="form-check-label" for="price7">
                  {{ $settings->currency_symbol ?? '$' }}1,000 to {{ $settings->currency_symbol ?? '$' }}10,000
                </label>
              </div>
            </form>
            <hr />
            <div class="brand-filter">
              <h3 class="sidebar-heading">popular Brands</h3>
              <div class="row g-2 mt-3">
                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="apple"
                      checked
                    />
                    <label class="form-check-label" for="apple">Apple</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="microsoft"
                      checked
                    />
                    <label class="form-check-label" for="microsoft"
                      >Microsoft</label
                    >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dell" />
                    <label class="form-check-label" for="dell">Dell</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="symphony"
                    />
                    <label class="form-check-label" for="symphony"
                      >Symphony</label
                    >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sony" />
                    <label class="form-check-label" for="sony">Sony</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="lg"
                      checked
                    />
                    <label class="form-check-label" for="lg">LG</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="oneplus"
                    />
                    <label class="form-check-label" for="oneplus"
                      >One Plus</label
                    >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="google"
                      checked
                    />
                    <label class="form-check-label" for="google">Google</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="samsung"
                    />
                    <label class="form-check-label" for="samsung"
                      >Samsung</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="hp"
                      checked
                    />
                    <label class="form-check-label" for="hp">HP</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="xiaomi"
                    />
                    <label class="form-check-label" for="xiaomi">Xiaomi</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="panasonic"
                      checked
                    />
                    <label class="form-check-label" for="panasonic"
                      >Panasonic</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="intel"
                    />
                    <label class="form-check-label" for="intel">Intel</label>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="popular-tags mt-4">
              <h6 class="fw-bold mb-3">POPULAR TAG</h6>
              <div class="d-flex flex-wrap gap-2">
                <button class="tag-btn">Game</button>
                <button class="tag-btn">iPhone</button>
                <button class="tag-btn">TV</button>
                <button class="tag-btn">Asus Laptops</button>
                <button class="tag-btn">Macbook</button>
                <button class="tag-btn">SSD</button>
                <button class="tag-btn active">Graphics Card</button>
                <button class="tag-btn">Power Bank</button>
                <button class="tag-btn">Smart TV</button>
                <button class="tag-btn">Speaker</button>
                <button class="tag-btn">Tablet</button>
                <button class="tag-btn">Microwave</button>
                <button class="tag-btn">Samsung</button>
              </div>
            </div>
            <div class="side-product-card text-center p-4 mt-3">
              <img
                src="{{ asset('front-assets/img/watch-collection.svg') }}"
                alt="Apple Watch"
                class="img-fluid mb-3"
              />

              <img
                src="{{ asset('front-assets/img/apple-watch-7.svg') }}"
                alt="Apple Logo"
                class="apple-logo"
              />

              <h6 class="product-subtitle mb-3">
                Heavy on Features. <br />
                Light on Price.
              </h6>

              <p class="price-text mb-4">
                Only for: <span class="price-tag">$299 USD</span>
              </p>

              <div class="d-grid gap-2">
                <button class="add-cart-btn">
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M3.125 10H16.875"
                      stroke="#5B265D"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M11.25 4.375L16.875 10L11.25 15.625"
                      stroke="#5B265D"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  ADD TO CART
                </button>

                <button class="view-details-btn">
                  VIEW DETAILS <i class="bi bi-arrow-right"></i>
                </button>
              </div>
            </div>
          </aside>
        </div>
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
.featured-product-item {
  display: none;
}
.featured-product-item.active {
  display: block;
}

/* Category dropdown hover effect */
.dropdown.show-on-hover {
  position: relative;
}

.dropdown.show-on-hover .dropdown-menu {
  display: none;
  margin-top: 0;
  min-width: 200px;
  max-height: 400px;
  overflow-y: auto;
}

.dropdown.show-on-hover:hover .dropdown-menu,
.dropdown.show-on-hover.show .dropdown-menu {
  display: block;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
}

.dropdown.show-on-hover .dropdown-menu:hover {
  display: block;
}

.dropdown-item.active {
  background-color: #f8f9fa;
  color: #5B265D;
  font-weight: 500;
}

.dropdown-item:hover {
  background-color: #f8f9fa;
  color: #5B265D;
}

.rating-stars-sm i {
  color: #ffb648;
  font-size: 1rem;
}

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

/* Add padding to body when cart bar is visible */
body:has(#cartBar[style*="display: block"]) {
  padding-bottom: 100px;
}

@media (max-width: 768px) {
  body:has(#cartBar[style*="display: block"]) {
    padding-bottom: 140px;
  }
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

@media (max-width: 576px) {
  .cart-icon-wrapper {
    width: 45px;
    height: 45px;
    font-size: 1.25rem;
  }
  
  .cart-total-text {
    font-size: 1.1rem;
  }
  
  .cart-items-text {
    font-size: 0.8rem;
  }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const featuredProducts = document.querySelectorAll('.featured-product-item');
  if (featuredProducts.length > 1) {
    let currentIndex = 0;
    setInterval(function() {
      featuredProducts[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % featuredProducts.length;
      featuredProducts[currentIndex].classList.add('active');
    }, 7000); // Rotate every 7 seconds
  }
  
  // Loading state
  let isLoading = false;
  let searchTimeout = null;
  
  // Unified AJAX filter function
  function applyFilters() {
    if (isLoading) return;
    
    isLoading = true;
    const productGrid = document.getElementById('productGrid');
    const paginationContainer = document.getElementById('paginationContainer');
    const activeFiltersContainer = document.getElementById('activeFiltersContainer');
    const totalResults = document.getElementById('totalResults');
    
    // Show loading state
    if (productGrid) {
      productGrid.style.opacity = '0.5';
      productGrid.style.pointerEvents = 'none';
    }
    
    // Collect all filter values
    const formData = new FormData();
    
    // Search
    const searchInput = document.getElementById('searchInput');
    if (searchInput && searchInput.value.trim()) {
      formData.append('search', searchInput.value.trim());
    }
    
    // Category
    const categoryInput = document.querySelector('#categoryFilter input[type="radio"]:checked');
    if (categoryInput && categoryInput.value) {
      formData.append('category', categoryInput.value);
    }
    
    // Brand
    const brandCheckbox = document.querySelector('.brand-checkbox:checked');
    if (brandCheckbox) {
      formData.append('brand', brandCheckbox.value);
    }
    
    // Price range
    const minInput = document.getElementById('minInput');
    const maxInput = document.getElementById('maxInput');
    if (minInput && minInput.value.trim()) {
      formData.append('min_price', minInput.value.trim());
    }
    if (maxInput && maxInput.value.trim()) {
      formData.append('max_price', maxInput.value.trim());
    }
    
    // Sort
    const urlParams = new URLSearchParams(window.location.search);
    const sortParam = urlParams.get('sort');
    if (sortParam) {
      formData.append('sort', sortParam);
    }
    
    // Tag
    const tagParam = urlParams.get('tag');
    if (tagParam) {
      formData.append('tag', tagParam);
    }
    
    // Page
    const pageParam = urlParams.get('page');
    if (pageParam) {
      formData.append('page', pageParam);
    }
    
    // Update URL without reload
    const newUrl = new URL(window.location.pathname, window.location.origin);
    if (searchInput && searchInput.value.trim()) {
      newUrl.searchParams.set('search', searchInput.value.trim());
    } else {
      newUrl.searchParams.delete('search');
    }
    if (categoryInput && categoryInput.value) {
      newUrl.searchParams.set('category', categoryInput.value);
    } else {
      newUrl.searchParams.delete('category');
    }
    if (brandCheckbox) {
      newUrl.searchParams.set('brand', brandCheckbox.value);
    } else {
      newUrl.searchParams.delete('brand');
    }
    if (minInput && minInput.value.trim()) {
      newUrl.searchParams.set('min_price', minInput.value.trim());
    } else {
      newUrl.searchParams.delete('min_price');
    }
    if (maxInput && maxInput.value.trim()) {
      newUrl.searchParams.set('max_price', maxInput.value.trim());
    } else {
      newUrl.searchParams.delete('max_price');
    }
    if (sortParam) {
      newUrl.searchParams.set('sort', sortParam);
    }
    if (tagParam) {
      newUrl.searchParams.set('tag', tagParam);
    }
    if (pageParam) {
      newUrl.searchParams.set('page', pageParam);
    } else {
      newUrl.searchParams.delete('page');
    }
    
    window.history.pushState({}, '', newUrl.toString());
    
    // Make AJAX request
    fetch('{{ route("frontend.marketplace.filter") }}', {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update product grid
        if (productGrid) {
          productGrid.innerHTML = data.products_html;
          productGrid.style.opacity = '1';
          productGrid.style.pointerEvents = 'auto';
        }
        
        // Update pagination
        if (paginationContainer) {
          paginationContainer.innerHTML = data.pagination_html;
        }
        
        // Update active filters
        if (activeFiltersContainer) {
          if (data.has_filters) {
            activeFiltersContainer.innerHTML = '<span class="text-secondary me-1 fs-14 fw-400">Active Filters:</span>' + data.active_filters_html + '<button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearAllFilters()">Clear All</button>';
          } else {
            activeFiltersContainer.innerHTML = '<span class="text-secondary fs-14 fw-400">No active filters</span>';
          }
        }
        
        // Update total results
        if (totalResults) {
          totalResults.textContent = new Intl.NumberFormat().format(data.total_results);
        }
      }
      isLoading = false;
    })
    .catch(error => {
      console.error('Error:', error);
      isLoading = false;
      if (productGrid) {
        productGrid.style.opacity = '1';
        productGrid.style.pointerEvents = 'auto';
      }
    });
  }
  
  // Make applyFilters globally accessible
  window.applyFilters = applyFilters;
  
  // Search input with debouncing
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(function() {
        applyFilters();
      }, 500); // 500ms debounce
    });
  }
  
  // Category filter
  const categoryInputs = document.querySelectorAll('#categoryFilter input[type="radio"]');
  categoryInputs.forEach(input => {
    input.addEventListener('change', function() {
      applyFilters();
    });
  });
  
  // Brand filter
  const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
  brandCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      applyFilters();
    });
  });
  
  // Price range filter
  const minInput = document.getElementById('minInput');
  const maxInput = document.getElementById('maxInput');
  const minRange = document.querySelector('.min_range');
  const maxRange = document.querySelector('.max_range');
  
  // Apply filter on Enter key or when input loses focus
  if (minInput && maxInput) {
    minInput.addEventListener('blur', applyFilters);
    maxInput.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        applyFilters();
      }
    });
    maxInput.addEventListener('blur', applyFilters);
  }
  
  // Update range sliders
  if (minRange && maxRange && minInput && maxInput) {
    minRange.addEventListener('input', function() {
      minInput.value = this.value;
    });
    maxRange.addEventListener('input', function() {
      maxInput.value = this.value;
    });
    minRange.addEventListener('change', applyFilters);
    maxRange.addEventListener('change', applyFilters);
  }
  
  // Price radio buttons
  const priceRadios = document.querySelectorAll('.price-radio');
  priceRadios.forEach(radio => {
    radio.addEventListener('change', function() {
      const minPrice = this.getAttribute('data-min');
      const maxPrice = this.getAttribute('data-max');
      
      // Update the manual price inputs to match
      if (minInput && maxInput) {
        if (this.value === 'all') {
          minInput.value = '';
          maxInput.value = '';
        } else {
          minInput.value = minPrice;
          maxInput.value = maxPrice;
        }
      }
      
      // Update range sliders if they exist
      if (minRange && maxRange) {
        if (this.value === 'all') {
          minRange.value = 0;
          maxRange.value = 10000;
        } else {
          minRange.value = minPrice;
          maxRange.value = maxPrice;
        }
      }
      
      applyFilters();
    });
  });
  
  // Tag links - convert to AJAX
  const tagLinks = document.querySelectorAll('.popular-tags a.tag-btn');
  tagLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const tagId = this.getAttribute('href').split('tag=')[1];
      const url = new URL(window.location.href);
      if (tagId && tagId !== '') {
        url.searchParams.set('tag', tagId);
      } else {
        url.searchParams.delete('tag');
      }
      window.history.pushState({}, '', url.toString());
      applyFilters();
    });
  });
  
  // Category dropdown - ensure it works on both click and hover
  const categoryDropdown = document.querySelector('.show-on-hover');
  const categoryDropdownMenu = categoryDropdown?.querySelector('.dropdown-menu');
  
  if (categoryDropdown && categoryDropdownMenu) {
    let hoverTimeout;
    
    // Show dropdown on hover
    categoryDropdown.addEventListener('mouseenter', function() {
      clearTimeout(hoverTimeout);
      this.classList.add('show');
      categoryDropdownMenu.classList.add('show');
    });
    
    // Hide dropdown when mouse leaves (with small delay to allow moving to menu)
    categoryDropdown.addEventListener('mouseleave', function() {
      const self = this;
      hoverTimeout = setTimeout(function() {
        self.classList.remove('show');
        categoryDropdownMenu.classList.remove('show');
      }, 200); // 200ms delay
    });
    
    // Keep dropdown open when hovering over menu
    categoryDropdownMenu.addEventListener('mouseenter', function() {
      clearTimeout(hoverTimeout);
      categoryDropdown.classList.add('show');
      this.classList.add('show');
    });
    
    // Handle click to toggle (for mobile/touch devices)
    const categoryButton = categoryDropdown.querySelector('[data-bs-toggle="dropdown"]');
    if (categoryButton) {
      categoryButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const isOpen = categoryDropdown.classList.contains('show');
        if (isOpen) {
          categoryDropdown.classList.remove('show');
          categoryDropdownMenu.classList.remove('show');
        } else {
          categoryDropdown.classList.add('show');
          categoryDropdownMenu.classList.add('show');
        }
      });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if (!categoryDropdown.contains(e.target)) {
        categoryDropdown.classList.remove('show');
        categoryDropdownMenu.classList.remove('show');
      }
    });
  }
  
  // Handle pagination links with AJAX (delegated event listener)
  document.addEventListener('click', function(e) {
    const paginationLink = e.target.closest('.pagination a, .pagination-nav a');
    if (paginationLink) {
      e.preventDefault();
      const url = new URL(paginationLink.href);
      const page = url.searchParams.get('page');
      if (page) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('page', page);
        window.history.pushState({}, '', currentUrl.toString());
        if (typeof window.applyFilters === 'function') {
          window.applyFilters();
        }
      }
    }
  });
});

// Cart functionality
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
      updateCartBar();
      // Show success notification
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
        // Add padding to body to prevent content from being hidden
        document.body.style.paddingBottom = window.innerWidth <= 768 ? '140px' : '100px';
      } else {
        cartBar.style.display = 'none';
        // Remove padding when cart is empty
        document.body.style.paddingBottom = '0';
      }
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
}

function showCartNotification(message, type) {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `cart-notification cart-notification-${type}`;
  notification.textContent = message;
  document.body.appendChild(notification);
  
  // Show notification
  setTimeout(() => {
    notification.classList.add('show');
  }, 10);
  
  // Hide and remove notification after 3 seconds
  setTimeout(() => {
    notification.classList.remove('show');
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
        showCartNotification('Product added to wishlist!', 'success');
      } else {
        wishlistBtn.classList.remove('active');
        icon.classList.remove('bi-heart-fill');
        icon.classList.add('bi-heart');
        wishlistBtn.setAttribute('title', 'Add to Wishlist');
        showCartNotification('Product removed from wishlist!', 'success');
      }
    } else {
      showCartNotification('Unable to update wishlist. Please try again.', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showCartNotification('Unable to update wishlist. Please try again.', 'error');
  });
}

// Initialize cart bar on page load
document.addEventListener('DOMContentLoaded', function() {
  updateCartBar();
  
  // Add click handlers to all cart icons (including dynamically loaded ones)
  document.addEventListener('click', function(e) {
    const cartBtn = e.target.closest('.add-to-cart-btn');
    if (cartBtn) {
      e.preventDefault();
      e.stopPropagation();
      const productId = cartBtn.getAttribute('data-product-id');
      if (productId) {
        addToCart(productId);
      }
    }
    
    // Handle wishlist toggle
    const wishlistBtn = e.target.closest('.wishlist-btn');
    if (wishlistBtn) {
      e.preventDefault();
      e.stopPropagation();
      toggleWishlist(wishlistBtn);
    }
  });
});

function removeFilter(filterType) {
  const url = new URL(window.location.href);
  url.searchParams.delete(filterType);
  
  // Also uncheck the corresponding filter
  if (filterType === 'category') {
    const categoryInput = document.querySelector('#categoryFilter input[value=""]');
    if (categoryInput) categoryInput.checked = true;
  } else if (filterType === 'brand') {
    const brandCheckbox = document.querySelector('.brand-checkbox:checked');
    if (brandCheckbox) brandCheckbox.checked = false;
  } else if (filterType === 'min_price' || filterType === 'max_price') {
    const minInput = document.getElementById('minInput');
    const maxInput = document.getElementById('maxInput');
    if (filterType === 'min_price' && minInput) minInput.value = '';
    if (filterType === 'max_price' && maxInput) maxInput.value = '';
    const allPriceRadio = document.querySelector('.price-radio[value="all"]');
    if (allPriceRadio) allPriceRadio.checked = true;
  } else if (filterType === 'tag') {
    url.searchParams.delete('tag');
  } else if (filterType === 'search') {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) searchInput.value = '';
  }
  
  window.history.pushState({}, '', url.toString());
  
  // Trigger filter update
  if (typeof window.applyFilters === 'function') {
    window.applyFilters();
  }
}

function clearAllFilters() {
  const url = new URL(window.location.href);
  // Remove all filter parameters
  url.searchParams.delete('category');
  url.searchParams.delete('brand');
  url.searchParams.delete('tag');
  url.searchParams.delete('min_price');
  url.searchParams.delete('max_price');
  url.searchParams.delete('search');
  url.searchParams.delete('page');
  
  // Reset form elements
  const categoryInput = document.querySelector('#categoryFilter input[value=""]');
  if (categoryInput) categoryInput.checked = true;
  
  const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
  brandCheckboxes.forEach(cb => cb.checked = false);
  
  const searchInput = document.getElementById('searchInput');
  if (searchInput) searchInput.value = '';
  
  const minInput = document.getElementById('minInput');
  const maxInput = document.getElementById('maxInput');
  if (minInput) minInput.value = '';
  if (maxInput) maxInput.value = '';
  
  const allPriceRadio = document.querySelector('.price-radio[value="all"]');
  if (allPriceRadio) allPriceRadio.checked = true;
  
  window.history.pushState({}, '', url.toString());
  
  // Trigger filter update
  if (typeof window.applyFilters === 'function') {
    window.applyFilters();
  }
}
</script>
@endpush