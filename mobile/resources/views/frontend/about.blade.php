@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Hero Section Start -->
    <section class="about-hero-section flex-stack mb-custom">
      <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">{{ $content->hero_title ?? 'About us' }}</h1>

        <p class="text-white text-center fw-400 fs-18 mb-4">
          {!! nl2br(e($content->hero_description ?? 'Reliable Phone Repair Services, Guaranteed to Meet Expectations')) !!}
        </p>
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

    <!-- Customer Satisfaction  -->
    <section class="customer_satisfaction mb-custom">
      <div class="container">
        <div class="text-center">
          <button class="btn-gradient-outline">{{ $content->customer_satisfaction_badge ?? 'OUR VALUE' }}</button>
        </div>
        <h1 class="text-center my-4">
          {!! $content->customer_satisfaction_title ?? 'Driven By Quality, Focused On <br /> Customer Satisfaction' !!}
        </h1>
        <div class="row row-cols-lg-2 row-cols-1 g-3 mt-5">
          @php
            $customerItems = $content->customer_satisfaction_items ?? [
              ['title' => 'Our experienced technicians are ready to repair your device right now', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
              ['title' => 'Our technicians can fix any issue you\'re facing with your smartphone or computer', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
            ];
            $customerImages = ['customer-satisfaction-1.svg', 'customer-satisfaction-2.svg'];
          @endphp
          @foreach($customerItems as $index => $item)
            <div class="col">
              <div class="flex-stack flex-column">
                <h4 class="fw-500 fs-24 text-center">
                  {{ $item['title'] ?? '' }}
                </h4>
                <p class="text-center fs-16">
                  {{ $item['description'] ?? '' }}
                </p>
                <img
                  src="{{ asset('front-assets/img/' . ($customerImages[$index] ?? 'customer-satisfaction-1.svg')) }}"
                  class="img-fluid"
                  alt=""
                />
              </div>
            </div>
          @endforeach
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

        <div class="repair-cards w-lg-75 mt-2">
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

    

@endsection
