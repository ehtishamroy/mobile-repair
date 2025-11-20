@extends('frontend.layouts.app')

@section('title', 'Careers')

@section('content')
<!-- Hero Section Start -->
<section class="about-hero-section flex-stack mb-custom">
    <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">{{ $content->hero_title ?? 'Careers' }}</h1>
        <p class="text-white text-center fw-400 fs-18 mb-4">
            {!! nl2br(e($content->hero_description ?? 'Join our team and help us deliver exceptional repair services')) !!}
        </p>
    </div>
</section>
<!-- Hero Section End -->

<!-- Why Join Us Section -->
<section class="mb-custom">
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-6">
                <button class="btn-gradient-outline">{{ $content->why_join_badge ?? 'WHY JOIN US' }}</button>
                <h1 class="fs-40 pt-4">
                    {{ $content->why_join_title ?? 'Build Your Career With Us' }}
                </h1>
                <p class="py-3 fs-16">
                    {{ $content->why_join_description ?? 'We are looking for talented individuals to join our growing team.' }}
                </p>
                @php
                    $whyJoinItems = $content->why_join_items ?? ['Competitive Salary', 'Growth Opportunities', 'Great Work Environment'];
                @endphp
                <div class="mt-4">
                    @foreach($whyJoinItems as $index => $item)
                        <div class="choose-card h-auto mt-3 w-md-75">
                            <img src="{{ asset('front-assets/img/choose-' . (($index % 4) + 1) . '.svg') }}" alt="icon" />
                            <span>{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="h-100">
                    <img class="img-fluid" src="{{ asset('front-assets/img/hardware.svg') }}" alt="Careers" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Open Positions Section -->
<section class="mb-custom">
    <div class="container">
        <div class="text-center mb-5">
            <button class="btn-gradient-outline">{{ $content->open_positions_badge ?? 'OPEN POSITIONS' }}</button>
            <h1 class="my-4 fs-40">
                {{ $content->open_positions_title ?? 'Current Job Openings' }}
            </h1>
            <p class="fs-18 fw-400">
                {{ $content->open_positions_description ?? 'Explore our current job openings and find the perfect role for you.' }}
            </p>
        </div>
        
        @php
            $jobPositions = $content->job_positions ?? [
                ['title' => 'Mobile Repair Technician', 'department' => 'Technical', 'location' => 'London', 'type' => 'Full-time', 'description' => 'We are seeking an experienced mobile repair technician.'],
                ['title' => 'Customer Service Representative', 'department' => 'Customer Service', 'location' => 'London', 'type' => 'Full-time', 'description' => 'Join our customer service team.'],
            ];
        @endphp
        
        @if(!empty($jobPositions) && count($jobPositions) > 0)
        <div class="row row-cols-lg-2 row-cols-1 g-4">
            @foreach($jobPositions as $position)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fs-24 fw-600 mb-3">{{ $position['title'] ?? 'Job Title' }}</h3>
                            <div class="d-flex flex-wrap gap-3 mb-3">
                                @if(!empty($position['department']))
                                <span class="badge bg-primary-custom">{{ $position['department'] }}</span>
                                @endif
                                @if(!empty($position['location']))
                                <span class="badge bg-secondary"><i class="bi bi-geo-alt me-1"></i>{{ $position['location'] }}</span>
                                @endif
                                @if(!empty($position['type']))
                                <span class="badge bg-info">{{ $position['type'] }}</span>
                                @endif
                            </div>
                            @if(!empty($position['description']))
                            <p class="fs-16 text-muted mb-0">{{ $position['description'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <p class="text-muted fs-18">No positions available at the moment. Please check back later.</p>
        </div>
        @endif
    </div>
</section>

<!-- Benefits Section -->
<section class="mb-custom">
    <div class="container">
        <div class="text-center mb-5">
            <button class="btn-gradient-outline">{{ $content->benefits_badge ?? 'BENEFITS' }}</button>
            <h1 class="my-4 fs-40">
                {{ $content->benefits_title ?? 'Employee Benefits & Perks' }}
            </h1>
        </div>
        
        @php
            $benefitsItems = $content->benefits_items ?? [
                ['title' => 'Health Insurance', 'description' => 'Comprehensive health coverage'],
                ['title' => 'Paid Time Off', 'description' => 'Generous vacation and sick leave'],
                ['title' => 'Professional Development', 'description' => 'Training and career growth opportunities'],
                ['title' => 'Flexible Schedule', 'description' => 'Work-life balance'],
            ];
        @endphp
        
        <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1 g-3">
            @foreach($benefitsItems as $index => $item)
                <div class="col">
                    <div class="choose-card h-100">
                        <img src="{{ asset('front-assets/img/choose-' . (($index % 4) + 1) . '.svg') }}" alt="icon" />
                        <div>
                            <h5 class="mb-2 fw-600">{{ $item['title'] ?? 'Benefit' }}</h5>
                            <p class="mb-0 fs-16">{{ $item['description'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How to Apply Section -->
<section class="mb-custom">
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-6">
                <div class="h-100">
                    <img class="img-fluid" src="{{ asset('front-assets/img/join-us-2.svg') }}" alt="How to Apply" />
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <button class="btn-gradient-outline">{{ $content->how_to_apply_badge ?? 'HOW TO APPLY' }}</button>
                <h1 class="my-3 fs-40">
                    {{ $content->how_to_apply_title ?? 'Application Process' }}
                </h1>
                <p class="fs-18 fw-400 my-4">
                    {{ $content->how_to_apply_description ?? 'Follow these simple steps to apply for a position.' }}
                </p>
                
                @php
                    $applicationSteps = $content->application_steps ?? [
                        ['step' => 'Step 1', 'description' => 'Submit your resume'],
                        ['step' => 'Step 2', 'description' => 'Initial interview'],
                        ['step' => 'Step 3', 'description' => 'Final interview'],
                    ];
                @endphp
                
                <div class="mt-4">
                    @foreach($applicationSteps as $index => $step)
                        <div class="d-flex align-items-start mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-primary-custom text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-weight: 600;">
                                    {{ $index + 1 }}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="fw-600 mb-1">{{ $step['step'] ?? 'Step ' . ($index + 1) }}</h5>
                                <p class="mb-0 fs-16">{{ $step['description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="mb-custom">
    <div class="container">
        <div class="row g-5">
            <div class="col-12 col-lg-6">
                <button class="btn-gradient-outline">{{ $content->contact_badge ?? 'CONTACT US' }}</button>
                <h1 class="my-3 fs-40">
                    {{ $content->contact_title ?? 'Have Questions?' }}
                </h1>
                <p class="fs-18 fw-400 my-4">
                    {{ $content->contact_description ?? 'Reach out to us for more information about career opportunities.' }}
                </p>
                @if(!empty($content->contact_email))
                <p class="fs-16 mb-4">
                    <strong>Email:</strong> <a href="mailto:{{ $content->contact_email }}" class="text-primary-custom">{{ $content->contact_email }}</a>
                </p>
                @endif
                <a href="{{ route('frontend.contact') }}" class="btn btn-gradient rounded">
                    {{ $content->contact_button_text ?? 'Contact Us' }}
                </a>
            </div>
            <div class="col-12 col-lg-6">
                <div class="h-100">
                    <img class="img-fluid" src="{{ asset('front-assets/img/offer-bg.svg') }}" alt="Contact" />
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

