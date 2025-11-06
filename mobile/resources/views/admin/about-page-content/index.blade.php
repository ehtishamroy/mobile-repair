@extends('admin.layouts.app')

@section('title', 'About Page Content')
@section('page-title', 'Edit About Page Content')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">About Page Content</li>
@endsection

@section('content')
<form action="{{ route('admin.about-page-content.update') }}" method="POST">
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
                                  placeholder="Enter hero title">{{ old('hero_title', $content->hero_title ?? 'About us') }}</textarea>
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

        <!-- Who We Are Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Who We Are Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="who_we_are_badge">Badge Text</label>
                        <input type="text" class="form-control @error('who_we_are_badge') is-invalid @enderror" 
                               id="who_we_are_badge" name="who_we_are_badge" 
                               value="{{ old('who_we_are_badge', $content->who_we_are_badge ?? 'WHO WE ARE') }}" 
                               placeholder="e.g., WHO WE ARE">
                        @error('who_we_are_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="who_we_are_title">Section Title</label>
                        <textarea class="form-control @error('who_we_are_title') is-invalid @enderror" 
                                  id="who_we_are_title" name="who_we_are_title" rows="2" 
                                  placeholder="Enter section title">{{ old('who_we_are_title', $content->who_we_are_title ?? 'Driven By Quality, Focused On Customer Satisfaction') }}</textarea>
                        @error('who_we_are_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="who_we_are_description">Description</label>
                        <textarea class="form-control @error('who_we_are_description') is-invalid @enderror" 
                                  id="who_we_are_description" name="who_we_are_description" rows="3" 
                                  placeholder="Enter description">{{ old('who_we_are_description', $content->who_we_are_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.') }}</textarea>
                        @error('who_we_are_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="who_we_are_stat_number">Stat Number</label>
                                <input type="text" class="form-control @error('who_we_are_stat_number') is-invalid @enderror" 
                                       id="who_we_are_stat_number" name="who_we_are_stat_number" 
                                       value="{{ old('who_we_are_stat_number', $content->who_we_are_stat_number ?? '25+') }}" 
                                       placeholder="e.g., 25+">
                                @error('who_we_are_stat_number')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="who_we_are_stat_label">Stat Label</label>
                                <input type="text" class="form-control @error('who_we_are_stat_label') is-invalid @enderror" 
                                       id="who_we_are_stat_label" name="who_we_are_stat_label" 
                                       value="{{ old('who_we_are_stat_label', $content->who_we_are_stat_label ?? 'YEARS EXPERIENCE') }}" 
                                       placeholder="e.g., YEARS EXPERIENCE">
                                @error('who_we_are_stat_label')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="who_we_are_warranty_title">Warranty Title</label>
                                <input type="text" class="form-control @error('who_we_are_warranty_title') is-invalid @enderror" 
                                       id="who_we_are_warranty_title" name="who_we_are_warranty_title" 
                                       value="{{ old('who_we_are_warranty_title', $content->who_we_are_warranty_title ?? 'Comprehensive Warranty') }}" 
                                       placeholder="e.g., Comprehensive Warranty">
                                @error('who_we_are_warranty_title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="who_we_are_warranty_description">Warranty Description</label>
                                <textarea class="form-control @error('who_we_are_warranty_description') is-invalid @enderror" 
                                          id="who_we_are_warranty_description" name="who_we_are_warranty_description" rows="3" 
                                          placeholder="Enter warranty description">{{ old('who_we_are_warranty_description', $content->who_we_are_warranty_description ?? 'dummy text Lorem Ipsum is simply dummy text') }}</textarea>
                                @error('who_we_are_warranty_description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Card Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list mr-2"></i>Feature Card Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="feature_title">Feature Title</label>
                        <textarea class="form-control @error('feature_title') is-invalid @enderror" 
                                  id="feature_title" name="feature_title" rows="2" 
                                  placeholder="Enter feature title">{{ old('feature_title', $content->feature_title ?? 'Fast, Reliable Solutions For All Device Problem') }}</textarea>
                        <small class="form-text text-muted">Use &lt;br /&gt; for line breaks</small>
                        @error('feature_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Feature Items</label>
                        <div id="feature-items-container">
                            @php
                                $featureItems = old('feature_items', $content->feature_items ?? ['Affordable Pricing', 'Expert Technicians', 'High-Quality Parts', 'Free Diagnostics', 'Convenient Service']);
                            @endphp
                            @foreach($featureItems as $index => $item)
                                <div class="input-group mb-2 feature-item">
                                    <input type="text" class="form-control" name="feature_items[]" value="{{ $item }}" placeholder="Enter feature item">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-feature-item">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-feature-item">Add Feature Item</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Satisfaction Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-heart mr-2"></i>Customer Satisfaction Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="customer_satisfaction_badge">Badge Text</label>
                        <input type="text" class="form-control @error('customer_satisfaction_badge') is-invalid @enderror" 
                               id="customer_satisfaction_badge" name="customer_satisfaction_badge" 
                               value="{{ old('customer_satisfaction_badge', $content->customer_satisfaction_badge ?? 'OUR VALUE') }}" 
                               placeholder="e.g., OUR VALUE">
                        @error('customer_satisfaction_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_satisfaction_title">Section Title</label>
                        <textarea class="form-control @error('customer_satisfaction_title') is-invalid @enderror" 
                                  id="customer_satisfaction_title" name="customer_satisfaction_title" rows="2" 
                                  placeholder="Enter section title">{{ old('customer_satisfaction_title', $content->customer_satisfaction_title ?? 'Driven By Quality, Focused On Customer Satisfaction') }}</textarea>
                        <small class="form-text text-muted">Use &lt;br /&gt; for line breaks</small>
                        @error('customer_satisfaction_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Customer Satisfaction Items</label>
                        <div id="customer-satisfaction-container">
                            @php
                                $customerItems = old('customer_satisfaction_items', $content->customer_satisfaction_items ?? [
                                    ['title' => 'Our experienced technicians are ready to repair your device right now', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
                                    ['title' => 'Our technicians can fix any issue you\'re facing with your smartphone or computer', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'],
                                ]);
                            @endphp
                            @foreach($customerItems as $index => $item)
                                <div class="card mb-3 customer-item">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Item Title</label>
                                            <textarea class="form-control" name="customer_satisfaction_items[{{ $index }}][title]" rows="2" placeholder="Enter item title">{{ $item['title'] ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Item Description</label>
                                            <textarea class="form-control" name="customer_satisfaction_items[{{ $index }}][description]" rows="2" placeholder="Enter item description">{{ $item['description'] ?? '' }}</textarea>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-customer-item">Remove Item</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-customer-item">Add Item</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quality Repairs Section -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-tools mr-2"></i>Quality Repairs Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="quality_repairs_badge">Badge Text</label>
                        <input type="text" class="form-control @error('quality_repairs_badge') is-invalid @enderror" 
                               id="quality_repairs_badge" name="quality_repairs_badge" 
                               value="{{ old('quality_repairs_badge', $content->quality_repairs_badge ?? 'Harrow Mobile & Laptop at Glance') }}" 
                               placeholder="e.g., Harrow Mobile & Laptop at Glance">
                        @error('quality_repairs_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quality_repairs_title">Section Title</label>
                        <textarea class="form-control @error('quality_repairs_title') is-invalid @enderror" 
                                  id="quality_repairs_title" name="quality_repairs_title" rows="2" 
                                  placeholder="Enter section title">{{ old('quality_repairs_title', $content->quality_repairs_title ?? 'Top-Quality Repairs, Ensuring Your Phone\'s Perfect Performance') }}</textarea>
                        <small class="form-text text-muted">Use &lt;br /&gt; for line breaks</small>
                        @error('quality_repairs_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Statistics</label>
                        <div id="quality-stats-container">
                            @php
                                $stats = old('quality_repairs_stats', $content->quality_repairs_stats ?? [
                                    ['number' => '1K+', 'label' => 'HAPPY CLIENTS'],
                                    ['number' => '1000+', 'label' => 'PROJECTS DONE'],
                                    ['number' => '4.9', 'label' => 'CLIENTS RATING'],
                                ]);
                            @endphp
                            @foreach($stats as $index => $stat)
                                <div class="row mb-2 quality-stat-item">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="quality_repairs_stats[{{ $index }}][number]" value="{{ $stat['number'] ?? '' }}" placeholder="Number">
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="quality_repairs_stats[{{ $index }}][label]" value="{{ $stat['label'] ?? '' }}" placeholder="Label">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-sm btn-danger remove-quality-stat">×</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-quality-stat">Add Stat</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-star mr-2"></i>Why Choose Us Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="why_choose_us_badge">Badge Text</label>
                        <input type="text" class="form-control @error('why_choose_us_badge') is-invalid @enderror" 
                               id="why_choose_us_badge" name="why_choose_us_badge" 
                               value="{{ old('why_choose_us_badge', $content->why_choose_us_badge ?? 'WHY CHOOSE US') }}" 
                               placeholder="e.g., WHY CHOOSE US">
                        @error('why_choose_us_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="why_choose_us_title">Section Title</label>
                        <input type="text" class="form-control @error('why_choose_us_title') is-invalid @enderror" 
                               id="why_choose_us_title" name="why_choose_us_title" 
                               value="{{ old('why_choose_us_title', $content->why_choose_us_title ?? 'Fast Repairs, No Hassle') }}" 
                               placeholder="e.g., Fast Repairs, No Hassle">
                        @error('why_choose_us_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Feature Items</label>
                        <div id="why-choose-items-container">
                            @php
                                $whyChooseItems = old('why_choose_us_items', $content->why_choose_us_items ?? ['Fast Turnaround Time', 'Comprehensive Warranty', 'Multi-Device Expertise', 'Customer-Centric Support']);
                            @endphp
                            @foreach($whyChooseItems as $index => $item)
                                <div class="input-group mb-2 why-choose-item">
                                    <input type="text" class="form-control" name="why_choose_us_items[]" value="{{ $item }}" placeholder="Enter feature item">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-why-choose-item">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-why-choose-item">Add Item</button>
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
                        <i class="fas fa-save mr-2"></i>Update About Page Content
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
    // Feature Items
    $('#add-feature-item').click(function() {
        const html = '<div class="input-group mb-2 feature-item">' +
                    '<input type="text" class="form-control" name="feature_items[]" placeholder="Enter feature item">' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="btn btn-danger remove-feature-item">Remove</button>' +
                    '</div></div>';
        $('#feature-items-container').append(html);
    });
    
    $(document).on('click', '.remove-feature-item', function() {
        $(this).closest('.feature-item').remove();
    });

    // Customer Satisfaction Items
    let customerItemIndex = {{ count($customerItems ?? []) }};
    $('#add-customer-item').click(function() {
        const html = '<div class="card mb-3 customer-item">' +
                    '<div class="card-body">' +
                    '<div class="form-group">' +
                    '<label>Item Title</label>' +
                    '<textarea class="form-control" name="customer_satisfaction_items[' + customerItemIndex + '][title]" rows="2" placeholder="Enter item title"></textarea>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Item Description</label>' +
                    '<textarea class="form-control" name="customer_satisfaction_items[' + customerItemIndex + '][description]" rows="2" placeholder="Enter item description"></textarea>' +
                    '</div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-customer-item">Remove Item</button>' +
                    '</div></div>';
        $('#customer-satisfaction-container').append(html);
        customerItemIndex++;
    });
    
    $(document).on('click', '.remove-customer-item', function() {
        $(this).closest('.customer-item').remove();
    });

    // Quality Stats
    let qualityStatIndex = {{ count($stats ?? []) }};
    $('#add-quality-stat').click(function() {
        const html = '<div class="row mb-2 quality-stat-item">' +
                    '<div class="col-md-4">' +
                    '<input type="text" class="form-control" name="quality_repairs_stats[' + qualityStatIndex + '][number]" placeholder="Number">' +
                    '</div>' +
                    '<div class="col-md-7">' +
                    '<input type="text" class="form-control" name="quality_repairs_stats[' + qualityStatIndex + '][label]" placeholder="Label">' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<button type="button" class="btn btn-sm btn-danger remove-quality-stat">×</button>' +
                    '</div></div>';
        $('#quality-stats-container').append(html);
        qualityStatIndex++;
    });
    
    $(document).on('click', '.remove-quality-stat', function() {
        $(this).closest('.quality-stat-item').remove();
    });

    // Why Choose Us Items
    $('#add-why-choose-item').click(function() {
        const html = '<div class="input-group mb-2 why-choose-item">' +
                    '<input type="text" class="form-control" name="why_choose_us_items[]" placeholder="Enter feature item">' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="btn btn-danger remove-why-choose-item">Remove</button>' +
                    '</div></div>';
        $('#why-choose-items-container').append(html);
    });
    
    $(document).on('click', '.remove-why-choose-item', function() {
        $(this).closest('.why-choose-item').remove();
    });
</script>
@endpush
@endsection

