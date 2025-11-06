@extends('frontend.layouts.app')

@section('title', 'Our Services')

@section('content')
<section class="service-hero-section flex-stack mb-custom">
      <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
          {{ $content->hero_title ?? 'Our Services' }}
        </h1>

        <p class="text-white text-center fw-400 fs-18 mb-4">
          {!! nl2br(e($content->hero_description ?? 'Reliable Phone Repair Services, Guaranteed to Meet Expectations')) !!}
        </p>
      </div>
    </section>
    <!-- Hero Section End -->

    <!-- repairing Service section  -->
    <section class="mb-custom">
      <div class="container">
        <div class="row mb-custom">
          <div class="col-6">
            <button class="btn-gradient-outline">{{ $content->what_we_offer_badge ?? 'WHAT WE OFFER' }}</button>
            <h1 class="fs-40 pt-4">
              {{ $content->what_we_offer_title ?? 'Driven By Quality, Focused On Customer Satisfaction' }}
            </h1>
          </div>
          <div class="col-6">
            <p class="pb-3">
              {{ $content->what_we_offer_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,' }}
            </p>
            <button class="btn-gradient" onclick="window.location.href='{{ route('frontend.contact') }}'">{{ $content->what_we_offer_button_text ?? 'Contact Us' }}</button>
          </div>
        </div>
        <div class="row row-cols-lg-3 row-cols-2 g-3">
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
                <p>
                  {{ $service['description'] ?? '' }}
                </p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    


@endsection
