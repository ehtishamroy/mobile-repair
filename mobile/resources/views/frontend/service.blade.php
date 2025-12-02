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
          <button class="btn-gradient"
            onclick="window.location.href='{{ route('frontend.contact') }}'">{{ $content->what_we_offer_button_text ?? 'Contact Us' }}</button>
        </div>
      </div>
      <div class="row row-cols-lg-3 row-cols-2 g-3">
        @php
          $services = \App\Models\RepairService::where('is_active', true)->orderBy('order')->get();
          // Fallback to default services if none exist (though links won't work without IDs)
          if ($services->isEmpty()) {
            $services = collect([]);
          }
        @endphp

        @if($services->isEmpty())
          <div class="col-12 text-center">
            <p>No services available at the moment.</p>
          </div>
        @else
          @foreach($services as $service)
            <div class="col d-flex">
              <a href="{{ route('frontend.mobile-repair', ['service' => $service->id]) }}" class="text-decoration-none w-100">
                <div class="repair-service-card h-100">
                  @if(isset($service->image) && $service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                  @else
                    <img src="{{ asset('front-assets/img/service-img-' . (($loop->index % 6) + 1) . '.svg') }}"
                      alt="{{ $service->name }}">
                  @endif
                  <h3 class="fs-24">{{ $service->name }}</h3>
                  <p>
                    {{ $service->description ?? 'Lorem Ipsum is simply dummy text' }}
                  </p>
                </div>
              </a>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>




@endsection