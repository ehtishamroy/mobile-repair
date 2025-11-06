@extends('frontend.layouts.app')

@section('title', 'Mobile Repair')

@section('content')
<section class="service-hero-section flex-stack mb-custom">
      <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
          Mobile Repairs
        </h1>

        <p class="text-white text-center fw-400 fs-18 mb-4">
          Reliable Phone Repair Services, Guaranteed to <br />
          Meet Expectations
        </p>
      </div>
    </section>
    <!-- Hero Section End -->

    <section>
      <div class="container mb-custom">
        <div class="text-center">
          <button class="btn-gradient-outline Choose">Choose</button>
          <h1 class="text-center my-4">Please Select Your Mobile</h1>
        </div>
        <div class="d-flex flex-wrap gap-3 mt-5 pt-5">
          <input
            type="radio"
            class="btn-check"
            name="device"
            id="apple"
            autocomplete="off"
            checked
          />
          <label class="device-card flex-center gap-3" for="apple">
            <i class="bi bi-apple"></i> Apple Device
            <span class="check-icon">
              <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
            </span>
          </label>

          <input
            type="radio"
            class="btn-check"
            name="device"
            id="samsung"
            autocomplete="off"
          />
          <label class="device-card" for="samsung">
            <img src="{{ asset('front-assets/img/repair-samsung-2.svg') }}" alt="" />
            <span class="check-icon">
              <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
            </span>
          </label>

          <input
            type="radio"
            class="btn-check"
            name="device"
            id="others"
            autocomplete="off"
          />
          <label class="device-card" for="others">
            Others
            <span class="check-icon">
              <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
            </span>
          </label>
        </div>
        <div class="text-center mt-5">
          <a href="{{ route('frontend.select') }}" class="btn-gradient py-3 rounded w-lg-25 text-decoration-none">
            Confirm
          </a>
        </div>
      </div>
    </section>

    


@endsection
