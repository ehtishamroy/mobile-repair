@extends('frontend.layouts.app')

@section('title', 'Book a Repair')

@section('content')
<section class="service-hero-section flex-stack mb-custom">
    <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
            Book a Repair
        </h1>
        <p class="text-white text-center fw-400 fs-18 mb-4">
            Choose the service you need
        </p>
    </div>
</section>

<section class="mb-custom">
    <div class="container">
        @php
            $services = \App\Models\RepairService::where('is_active', true)->orderBy('order')->get();
            // Fallback to default services if none exist
            if ($services->isEmpty()) {
                $defaultServices = [
                    ['name' => 'Smartphone Repair', 'id' => null],
                    ['name' => 'Laptop Repair', 'id' => null],
                    ['name' => 'Tablet Repair', 'id' => null],
                    ['name' => 'Console Repair', 'id' => null],
                    ['name' => 'Gaming PC Repair', 'id' => null],
                    ['name' => 'Software Optimization', 'id' => null],
                ];
                $services = collect($defaultServices);
            }
        @endphp
        
        @if($services->isEmpty())
        <div class="alert alert-info text-center">
            <p>No repair services are currently available. Please check back later.</p>
        </div>
        @else
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 g-3">
            @foreach($services as $service)
            <div class="col d-flex">
                @if($service->id ?? false)
                <a href="{{ route('frontend.mobile-repair', ['service' => $service->id]) }}" class="text-decoration-none w-100">
                    <div class="repair-service-card">
                        @if(isset($service->image) && $service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                        @else
                        <img src="{{ asset('front-assets/img/service-img-' . (($loop->index % 6) + 1) . '.svg') }}" alt="{{ $service->name }}">
                        @endif
                        <h3 class="fs-24">{{ $service->name }}</h3>
                    </div>
                </a>
                @else
                <div class="repair-service-card w-100">
                    <img src="{{ asset('front-assets/img/service-img-' . (($loop->index % 6) + 1) . '.svg') }}" alt="{{ $service['name'] }}">
                    <h3 class="fs-24">{{ $service['name'] }}</h3>
                    <p class="text-muted small mt-2">Coming soon</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection

