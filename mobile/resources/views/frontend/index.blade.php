@extends('frontend.layouts.app')

@section('title', 'Ecommerce')

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

        <a href="#" class="btn btn-gradient"> {{ $content->hero_button_text ?? 'Book a repair!' }} </a>
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
            <button class="btn-gradient">{{ $content->what_we_offer_button_text ?? 'Contact Us' }}</button>
          </div>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-3">
          @php
            $services = $content->services ?? [
              ['title' => 'Smartphone Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Laptop Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Tablet Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Console Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Gaming Pc Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
              ['title' => 'Software Optimization', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
            ];
            $serviceImages = ['service-img-1.svg', 'service-img-2.svg', 'service-img-3.svg', 'service-img-4.svg', 'service-img-5.svg', 'service-img-6.svg'];
          @endphp
          @foreach($services as $index => $service)
            <div class="col">
              <div class="repair-service-card">
                <img src="{{ asset('front-assets/img/' . ($serviceImages[$index] ?? 'service-img-1.svg')) }}" alt="" />
                <h3 class="fs-24">{{ $service['title'] ?? 'Service' }}</h3>
                <p class="fs-16">
                  {{ $service['description'] ?? '' }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Trending Phones  -->
    <section class="mb-custom">
      <div class="container">
        <button class="btn-gradient-outline mb-4">{{ $content->hot_selling_badge ?? 'Hot Selling' }}</button>

        <div class="flex-between flex-wrap flex-md-nowrap mb-5">
          <h3 class="fs-40">{{ $content->hot_selling_title ?? 'Trending Phones' }}</h3>
          <ul
            class="nav nav-pills justify-content-between justify-content-md-end mb-3 gap-3 mt-md-0 mt-3"
            id="pills-tab"
            role="tablist"
          >
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="pills-all-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-all"
                type="button"
                role="tab"
                aria-controls="pills-all"
                aria-selected="true"
              >
                All
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-apple-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-apple"
                type="button"
                role="tab"
                aria-controls="pills-apple"
                aria-selected="false"
              >
                Apple
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-samsung-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-samsung"
                type="button"
                role="tab"
                aria-controls="pills-samsung"
                aria-selected="false"
              >
                Samsung
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-others-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-others"
                type="button"
                role="tab"
                aria-controls="pills-others"
                aria-selected="false"
              >
                Others
              </button>
            </li>
          </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
          <div
            class="tab-pane fade show active"
            id="pills-all"
            role="tabpanel"
            aria-labelledby="pills-all-tab"
          >
            <div
              class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3"
            >
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <span class="product-badge badge-danger">HOT</span>

                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-1.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price text-promo">$70</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-2.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price">$70</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <span class="product-badge badge-secondary">BEST DEALS</span>

                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-3.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price">$70</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-4.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price">$70</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="pills-apple"
            role="tabpanel"
            aria-labelledby="pills-apple-tab"
          >
            ...
          </div>
          <div
            class="tab-pane fade"
            id="pills-samsung"
            role="tabpanel"
            aria-labelledby="pills-samsung-tab"
          >
            ...
          </div>
          <div
            class="tab-pane fade"
            id="pills-others"
            role="tabpanel"
            aria-labelledby="pills-others-tab"
          >
            ...
          </div>
        </div>
      </div>
    </section>

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

    <!-- Accessories   -->
    <section class="mb-custom">
      <div class="container">
        <button class="btn-gradient-outline mb-4">{{ $content->accessories_badge ?? 'Accessories' }}</button>

        <div class="flex-between flex-wrap flex-md-nowrap mb-5">
          <h3 class="fs-40">{{ $content->accessories_title ?? 'Must Have Accessories' }}</h3>
          <ul
            class="nav nav-pills justify-content-between justify-content-md-end mb-3 gap-3 mt-md-0 mt-3"
            id="pills-tab"
            role="tablist"
          >
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="pills-chargers-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-chargers"
                type="button"
                role="tab"
                aria-controls="pills-chargers"
                aria-selected="true"
              >
                chargers
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-headphones-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-headphones"
                type="button"
                role="tab"
                aria-controls="pills-headphones"
                aria-selected="false"
              >
                Headphones
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-cables-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-cables"
                type="button"
                role="tab"
                aria-controls="pills-cables"
                aria-selected="false"
              >
                Cables
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="pills-watches-tab"
                data-bs-toggle="pill"
                data-bs-target="#pills-watches"
                type="button"
                role="tab"
                aria-controls="pills-watches"
                aria-selected="false"
              >
                Watches
              </button>
            </li>
          </ul>
        </div>
        <div class="tab-content" id="pills-tabContent">
          <div
            class="tab-pane fade show active"
            id="pills-chargers"
            role="tabpanel"
            aria-labelledby="pills-chargers-tab"
          >
            <div
              class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3"
            >
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <span class="product-badge badge-danger">HOT</span>

                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-1.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price text-promo">$70</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-2.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price">$70</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <span class="product-badge badge-secondary">BEST DEALS</span>

                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-3.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price">$70</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="product-card h-100 position-relative">
                  <div class="card-body">
                    <!-- Product Image -->
                    <div class="ratio ratio-1x1 thumb">
                      <img
                        src="{{ asset('front-assets/img/phone-4.svg') }}"
                        alt="img"
                        class="w-100 h-100 p-2 rounded"
                      />

                      <!-- Hover Overlay Icons -->
                      <div class="product-actions">
                        <div class="action-btn">
                          <i class="bi bi-heart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="action-btn">
                          <i class="bi bi-eye"></i>
                        </div>
                      </div>
                    </div>

                    <!-- Rating -->
                    <div class="rating mt-3 d-flex align-items-center">
                      <span class="text-primary-custom">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                      </span>
                      <span class="rating-count">(738)</span>
                    </div>

                    <!-- Title -->
                    <p class="product-title mt-2 mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones
                    </p>

                    <!-- Price -->
                    <div class="product-price">$70</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="pills-headphones"
            role="tabpanel"
            aria-labelledby="pills-headphones-tab"
          >
            ...
          </div>
          <div
            class="tab-pane fade"
            id="pills-cables"
            role="tabpanel"
            aria-labelledby="pills-cables-tab"
          >
            ...
          </div>
          <div
            class="tab-pane fade"
            id="pills-watches"
            role="tabpanel"
            aria-labelledby="pills-watches-tab"
          >
            ...
          </div>
        </div>
      </div>
    </section>

    

@endsection
