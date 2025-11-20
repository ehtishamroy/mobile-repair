@extends('frontend.layouts.app')

@section('title', $service ? $service->name . ' - Book Repair' : 'Book Repair')

@section('content')
<section class="service-hero-section flex-stack mb-custom">
    <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
            {{ $service ? $service->name : 'Harrow Mobiles' }}
        </h1>
        <p class="text-white text-center fw-400 fs-18 mb-4">
            Reliable Repair Services, Guaranteed to <br />
            Meet Expectations
        </p>
    </div>
</section>

@if($service)
<section>
    <div class="container mb-custom">
        <div class="text-center">
            <button class="btn-gradient-outline Choose">Choose</button>
            <h1 class="text-center my-4">Please Select Your Device</h1>
        </div>
        <form id="deviceSelectionForm" action="{{ route('frontend.select') }}" method="GET">
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <div class="d-flex flex-wrap gap-3 mt-5 pt-5 justify-content-center">
                @foreach($service->deviceTypes as $deviceType)
                <input
                    type="radio"
                    class="btn-check"
                    name="device_type_id"
                    id="device_{{ $deviceType->id }}"
                    value="{{ $deviceType->id }}"
                    autocomplete="off"
                    {{ $loop->first ? 'checked' : '' }}
                />
                <label class="device-card flex-center gap-3" for="device_{{ $deviceType->id }}">
                    @if($deviceType->brand === 'Apple')
                    <i class="bi bi-apple"></i> {{ $deviceType->name }}
                    @elseif($deviceType->brand === 'Samsung')
                    <img src="{{ asset('front-assets/img/repair-samsung-2.svg') }}" alt="{{ $deviceType->name }}" style="height: 40px;">
                    {{ $deviceType->name }}
                    @else
                    {{ $deviceType->name }}
                    @endif
                    <span class="check-icon">
                        <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                    </span>
                </label>
                @endforeach
                
                <input
                    type="radio"
                    class="btn-check"
                    name="device_type_id"
                    id="device_other"
                    value="other"
                    autocomplete="off"
                />
                <label class="device-card" for="device_other">
                    Others
                    <span class="check-icon">
                        <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                    </span>
                </label>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn-gradient py-3 rounded w-lg-25">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</section>
@else
<section>
    <div class="container mb-custom">
        <div class="alert alert-warning text-center">
            <p>Please select a service from the <a href="{{ route('frontend.book-repair') }}">Book Repair</a> page.</p>
        </div>
    </div>
</section>
@endif

@endsection
