@extends('admin.layouts.app')

@section('title', 'Service Page Content')
@section('page-title', 'Edit Service Page Content')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Service Page Content</li>
@endsection

@section('content')
<form action="{{ route('admin.service-page-content.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Hero Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-home mr-2"></i>Hero Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="hero_title">Hero Title</label>
                        <textarea class="form-control @error('hero_title') is-invalid @enderror" 
                                  id="hero_title" name="hero_title" rows="2" 
                                  placeholder="Enter hero title">{{ old('hero_title', $content->hero_title ?? 'Our Services') }}</textarea>
                        @error('hero_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hero_description">Hero Description</label>
                        <textarea class="form-control @error('hero_description') is-invalid @enderror" 
                                  id="hero_description" name="hero_description" rows="3" 
                                  placeholder="Enter hero description">{{ old('hero_description', $content->hero_description ?? 'Reliable Phone Repair Services, Guaranteed to Meet Expectations') }}</textarea>
                        <small class="form-text text-muted">Use &lt;br /&gt; for line breaks</small>
                        @error('hero_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- What We Offer Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-gift mr-2"></i>What We Offer Section</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="what_we_offer_badge">Badge Text</label>
                                <input type="text" class="form-control @error('what_we_offer_badge') is-invalid @enderror" 
                                       id="what_we_offer_badge" name="what_we_offer_badge" 
                                       value="{{ old('what_we_offer_badge', $content->what_we_offer_badge ?? 'WHAT WE OFFER') }}" 
                                       placeholder="e.g., WHAT WE OFFER">
                                @error('what_we_offer_badge')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="what_we_offer_button_text">Button Text</label>
                                <input type="text" class="form-control @error('what_we_offer_button_text') is-invalid @enderror" 
                                       id="what_we_offer_button_text" name="what_we_offer_button_text" 
                                       value="{{ old('what_we_offer_button_text', $content->what_we_offer_button_text ?? 'Contact Us') }}" 
                                       placeholder="e.g., Contact Us">
                                @error('what_we_offer_button_text')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="what_we_offer_title">Section Title</label>
                        <textarea class="form-control @error('what_we_offer_title') is-invalid @enderror" 
                                  id="what_we_offer_title" name="what_we_offer_title" rows="2" 
                                  placeholder="Enter section title">{{ old('what_we_offer_title', $content->what_we_offer_title ?? 'Driven By Quality, Focused On Customer Satisfaction') }}</textarea>
                        @error('what_we_offer_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="what_we_offer_description">Description</label>
                        <textarea class="form-control @error('what_we_offer_description') is-invalid @enderror" 
                                  id="what_we_offer_description" name="what_we_offer_description" rows="3" 
                                  placeholder="Enter description">{{ old('what_we_offer_description', $content->what_we_offer_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.') }}</textarea>
                        @error('what_we_offer_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Services</label>
                        <div id="services-container">
                            @php
                                $services = old('services', $content->services ?? [
                                    ['title' => 'Smartphone Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
                                    ['title' => 'Laptop Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
                                    ['title' => 'Tablet Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
                                    ['title' => 'Console Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
                                    ['title' => 'Gaming Pc Repair', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
                                    ['title' => 'Software Optimization', 'description' => 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy text'],
                                ]);
                            @endphp
                            @foreach($services as $index => $service)
                                <div class="card mb-3 service-item">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Service Title</label>
                                                    <input type="text" class="form-control" name="services[{{ $index }}][title]" value="{{ $service['title'] ?? '' }}" placeholder="Enter service title">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Service Description</label>
                                                    <textarea class="form-control" name="services[{{ $index }}][description]" rows="2" placeholder="Enter service description">{{ $service['description'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-service-item">Remove Service</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-service-item">Add Service</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Update Service Page Content
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Services
    let serviceIndex = {{ count($services ?? []) }};
    $('#add-service-item').click(function() {
        const html = '<div class="card mb-3 service-item">' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-md-4">' +
                    '<div class="form-group">' +
                    '<label>Service Title</label>' +
                    '<input type="text" class="form-control" name="services[' + serviceIndex + '][title]" placeholder="Enter service title">' +
                    '</div></div>' +
                    '<div class="col-md-8">' +
                    '<div class="form-group">' +
                    '<label>Service Description</label>' +
                    '<textarea class="form-control" name="services[' + serviceIndex + '][description]" rows="2" placeholder="Enter service description"></textarea>' +
                    '</div></div></div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-service-item">Remove Service</button>' +
                    '</div></div>';
        $('#services-container').append(html);
        serviceIndex++;
    });
    
    $(document).on('click', '.remove-service-item', function() {
        $(this).closest('.service-item').remove();
    });
</script>
@endpush
@endsection

