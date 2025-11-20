@extends('admin.layouts.app')

@section('title', 'Careers Page Content')
@section('page-title', 'Edit Careers Page Content')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Careers Page Content</li>
@endsection

@section('content')
<form action="{{ route('admin.careers-page-content.update') }}" method="POST">
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
                                  placeholder="Enter hero title">{{ old('hero_title', $content->hero_title ?? 'Careers') }}</textarea>
                        @error('hero_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hero_description">Hero Description</label>
                        <textarea class="form-control @error('hero_description') is-invalid @enderror" 
                                  id="hero_description" name="hero_description" rows="3" 
                                  placeholder="Enter hero description">{{ old('hero_description', $content->hero_description ?? 'Join our team and help us deliver exceptional repair services') }}</textarea>
                        <small class="form-text text-muted">Use &lt;br /&gt; for line breaks</small>
                        @error('hero_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Join Us Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Why Join Us Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="why_join_badge">Badge Text</label>
                        <input type="text" class="form-control @error('why_join_badge') is-invalid @enderror" 
                               id="why_join_badge" name="why_join_badge" 
                               value="{{ old('why_join_badge', $content->why_join_badge ?? 'WHY JOIN US') }}" 
                               placeholder="e.g., WHY JOIN US">
                        @error('why_join_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="why_join_title">Section Title</label>
                        <textarea class="form-control @error('why_join_title') is-invalid @enderror" 
                                  id="why_join_title" name="why_join_title" rows="2" 
                                  placeholder="Enter section title">{{ old('why_join_title', $content->why_join_title ?? 'Build Your Career With Us') }}</textarea>
                        @error('why_join_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="why_join_description">Description</label>
                        <textarea class="form-control @error('why_join_description') is-invalid @enderror" 
                                  id="why_join_description" name="why_join_description" rows="3" 
                                  placeholder="Enter description">{{ old('why_join_description', $content->why_join_description ?? 'We are looking for talented individuals to join our growing team.') }}</textarea>
                        @error('why_join_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Why Join Items</label>
                        <div id="why-join-items-container">
                            @php
                                $whyJoinItems = old('why_join_items', $content->why_join_items ?? ['Competitive Salary', 'Growth Opportunities', 'Great Work Environment']);
                            @endphp
                            @foreach($whyJoinItems as $index => $item)
                                <div class="input-group mb-2 why-join-item">
                                    <input type="text" class="form-control" name="why_join_items[]" value="{{ $item }}" placeholder="Enter item">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-why-join-item">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-why-join-item">Add Item</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Open Positions Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-briefcase mr-2"></i>Open Positions Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="open_positions_badge">Badge Text</label>
                        <input type="text" class="form-control @error('open_positions_badge') is-invalid @enderror" 
                               id="open_positions_badge" name="open_positions_badge" 
                               value="{{ old('open_positions_badge', $content->open_positions_badge ?? 'OPEN POSITIONS') }}" 
                               placeholder="e.g., OPEN POSITIONS">
                        @error('open_positions_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="open_positions_title">Section Title</label>
                        <textarea class="form-control @error('open_positions_title') is-invalid @enderror" 
                                  id="open_positions_title" name="open_positions_title" rows="2" 
                                  placeholder="Enter section title">{{ old('open_positions_title', $content->open_positions_title ?? 'Current Job Openings') }}</textarea>
                        @error('open_positions_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="open_positions_description">Description</label>
                        <textarea class="form-control @error('open_positions_description') is-invalid @enderror" 
                                  id="open_positions_description" name="open_positions_description" rows="3" 
                                  placeholder="Enter description">{{ old('open_positions_description', $content->open_positions_description ?? 'Explore our current job openings and find the perfect role for you.') }}</textarea>
                        @error('open_positions_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Job Positions</label>
                        <div id="job-positions-container">
                            @php
                                $jobPositions = old('job_positions', $content->job_positions ?? [
                                    ['title' => 'Mobile Repair Technician', 'department' => 'Technical', 'location' => 'London', 'type' => 'Full-time', 'description' => 'We are seeking an experienced mobile repair technician.'],
                                    ['title' => 'Customer Service Representative', 'department' => 'Customer Service', 'location' => 'London', 'type' => 'Full-time', 'description' => 'Join our customer service team.'],
                                ]);
                            @endphp
                            @foreach($jobPositions as $index => $position)
                                <div class="card mb-3 job-position-item">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Job Title</label>
                                                    <input type="text" class="form-control" name="job_positions[{{ $index }}][title]" value="{{ $position['title'] ?? '' }}" placeholder="Job Title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <input type="text" class="form-control" name="job_positions[{{ $index }}][department]" value="{{ $position['department'] ?? '' }}" placeholder="Department">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <input type="text" class="form-control" name="job_positions[{{ $index }}][location]" value="{{ $position['location'] ?? '' }}" placeholder="Location">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Job Type</label>
                                                    <input type="text" class="form-control" name="job_positions[{{ $index }}][type]" value="{{ $position['type'] ?? '' }}" placeholder="e.g., Full-time, Part-time">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="job_positions[{{ $index }}][description]" rows="2" placeholder="Job description">{{ $position['description'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-job-position">Remove Position</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-job-position">Add Job Position</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-gift mr-2"></i>Benefits Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="benefits_badge">Badge Text</label>
                        <input type="text" class="form-control @error('benefits_badge') is-invalid @enderror" 
                               id="benefits_badge" name="benefits_badge" 
                               value="{{ old('benefits_badge', $content->benefits_badge ?? 'BENEFITS') }}" 
                               placeholder="e.g., BENEFITS">
                        @error('benefits_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="benefits_title">Section Title</label>
                        <textarea class="form-control @error('benefits_title') is-invalid @enderror" 
                                  id="benefits_title" name="benefits_title" rows="2" 
                                  placeholder="Enter section title">{{ old('benefits_title', $content->benefits_title ?? 'Employee Benefits & Perks') }}</textarea>
                        @error('benefits_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Benefits Items</label>
                        <div id="benefits-items-container">
                            @php
                                $benefitsItems = old('benefits_items', $content->benefits_items ?? [
                                    ['title' => 'Health Insurance', 'description' => 'Comprehensive health coverage'],
                                    ['title' => 'Paid Time Off', 'description' => 'Generous vacation and sick leave'],
                                ]);
                            @endphp
                            @foreach($benefitsItems as $index => $item)
                                <div class="card mb-3 benefit-item">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="benefits_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" placeholder="Benefit title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" class="form-control" name="benefits_items[{{ $index }}][description]" value="{{ $item['description'] ?? '' }}" placeholder="Benefit description">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-benefit-item">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-benefit-item">Add Benefit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- How to Apply Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i>How to Apply Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="how_to_apply_badge">Badge Text</label>
                        <input type="text" class="form-control @error('how_to_apply_badge') is-invalid @enderror" 
                               id="how_to_apply_badge" name="how_to_apply_badge" 
                               value="{{ old('how_to_apply_badge', $content->how_to_apply_badge ?? 'HOW TO APPLY') }}" 
                               placeholder="e.g., HOW TO APPLY">
                        @error('how_to_apply_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="how_to_apply_title">Section Title</label>
                        <textarea class="form-control @error('how_to_apply_title') is-invalid @enderror" 
                                  id="how_to_apply_title" name="how_to_apply_title" rows="2" 
                                  placeholder="Enter section title">{{ old('how_to_apply_title', $content->how_to_apply_title ?? 'Application Process') }}</textarea>
                        @error('how_to_apply_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="how_to_apply_description">Description</label>
                        <textarea class="form-control @error('how_to_apply_description') is-invalid @enderror" 
                                  id="how_to_apply_description" name="how_to_apply_description" rows="3" 
                                  placeholder="Enter description">{{ old('how_to_apply_description', $content->how_to_apply_description ?? 'Follow these simple steps to apply for a position.') }}</textarea>
                        @error('how_to_apply_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Application Steps</label>
                        <div id="application-steps-container">
                            @php
                                $applicationSteps = old('application_steps', $content->application_steps ?? [
                                    ['step' => 'Step 1', 'description' => 'Submit your resume'],
                                    ['step' => 'Step 2', 'description' => 'Initial interview'],
                                    ['step' => 'Step 3', 'description' => 'Final interview'],
                                ]);
                            @endphp
                            @foreach($applicationSteps as $index => $step)
                                <div class="card mb-3 application-step-item">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Step</label>
                                                    <input type="text" class="form-control" name="application_steps[{{ $index }}][step]" value="{{ $step['step'] ?? '' }}" placeholder="e.g., Step 1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <input type="text" class="form-control" name="application_steps[{{ $index }}][description]" value="{{ $step['description'] ?? '' }}" placeholder="Step description">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-application-step">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-application-step">Add Step</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-envelope mr-2"></i>Contact Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="contact_badge">Badge Text</label>
                        <input type="text" class="form-control @error('contact_badge') is-invalid @enderror" 
                               id="contact_badge" name="contact_badge" 
                               value="{{ old('contact_badge', $content->contact_badge ?? 'CONTACT US') }}" 
                               placeholder="e.g., CONTACT US">
                        @error('contact_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_title">Section Title</label>
                        <textarea class="form-control @error('contact_title') is-invalid @enderror" 
                                  id="contact_title" name="contact_title" rows="2" 
                                  placeholder="Enter section title">{{ old('contact_title', $content->contact_title ?? 'Have Questions?') }}</textarea>
                        @error('contact_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact_description">Description</label>
                        <textarea class="form-control @error('contact_description') is-invalid @enderror" 
                                  id="contact_description" name="contact_description" rows="3" 
                                  placeholder="Enter description">{{ old('contact_description', $content->contact_description ?? 'Reach out to us for more information about career opportunities.') }}</textarea>
                        @error('contact_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_email">Contact Email</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                       id="contact_email" name="contact_email" 
                                       value="{{ old('contact_email', $content->contact_email ?? '') }}" 
                                       placeholder="careers@example.com">
                                @error('contact_email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_button_text">Button Text</label>
                                <input type="text" class="form-control @error('contact_button_text') is-invalid @enderror" 
                                       id="contact_button_text" name="contact_button_text" 
                                       value="{{ old('contact_button_text', $content->contact_button_text ?? 'Contact Us') }}" 
                                       placeholder="e.g., Contact Us">
                                @error('contact_button_text')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
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
                        <i class="fas fa-save mr-2"></i>Update Careers Page Content
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let whyJoinIndex = {{ count(old('why_join_items', $content->why_join_items ?? [])) }};
    let jobPositionIndex = {{ count(old('job_positions', $content->job_positions ?? [])) }};
    let benefitIndex = {{ count(old('benefits_items', $content->benefits_items ?? [])) }};
    let applicationStepIndex = {{ count(old('application_steps', $content->application_steps ?? [])) }};

    // Why Join Items
    $('#add-why-join-item').click(function() {
        const html = '<div class="input-group mb-2 why-join-item">' +
                    '<input type="text" class="form-control" name="why_join_items[]" placeholder="Enter item">' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="btn btn-danger remove-why-join-item">Remove</button>' +
                    '</div></div>';
        $('#why-join-items-container').append(html);
    });
    
    $(document).on('click', '.remove-why-join-item', function() {
        $(this).closest('.why-join-item').remove();
    });

    // Job Positions
    $('#add-job-position').click(function() {
        const html = '<div class="card mb-3 job-position-item">' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-md-6"><div class="form-group"><label>Job Title</label>' +
                    '<input type="text" class="form-control" name="job_positions[' + jobPositionIndex + '][title]" placeholder="Job Title"></div></div>' +
                    '<div class="col-md-6"><div class="form-group"><label>Department</label>' +
                    '<input type="text" class="form-control" name="job_positions[' + jobPositionIndex + '][department]" placeholder="Department"></div></div>' +
                    '<div class="col-md-6"><div class="form-group"><label>Location</label>' +
                    '<input type="text" class="form-control" name="job_positions[' + jobPositionIndex + '][location]" placeholder="Location"></div></div>' +
                    '<div class="col-md-6"><div class="form-group"><label>Job Type</label>' +
                    '<input type="text" class="form-control" name="job_positions[' + jobPositionIndex + '][type]" placeholder="e.g., Full-time, Part-time"></div></div>' +
                    '<div class="col-md-12"><div class="form-group"><label>Description</label>' +
                    '<textarea class="form-control" name="job_positions[' + jobPositionIndex + '][description]" rows="2" placeholder="Job description"></textarea></div></div>' +
                    '</div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-job-position">Remove Position</button>' +
                    '</div></div>';
        $('#job-positions-container').append(html);
        jobPositionIndex++;
    });
    
    $(document).on('click', '.remove-job-position', function() {
        $(this).closest('.job-position-item').remove();
    });

    // Benefits Items
    $('#add-benefit-item').click(function() {
        const html = '<div class="card mb-3 benefit-item">' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-md-6"><div class="form-group"><label>Title</label>' +
                    '<input type="text" class="form-control" name="benefits_items[' + benefitIndex + '][title]" placeholder="Benefit title"></div></div>' +
                    '<div class="col-md-6"><div class="form-group"><label>Description</label>' +
                    '<input type="text" class="form-control" name="benefits_items[' + benefitIndex + '][description]" placeholder="Benefit description"></div></div>' +
                    '</div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-benefit-item">Remove</button>' +
                    '</div></div>';
        $('#benefits-items-container').append(html);
        benefitIndex++;
    });
    
    $(document).on('click', '.remove-benefit-item', function() {
        $(this).closest('.benefit-item').remove();
    });

    // Application Steps
    $('#add-application-step').click(function() {
        const html = '<div class="card mb-3 application-step-item">' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-md-6"><div class="form-group"><label>Step</label>' +
                    '<input type="text" class="form-control" name="application_steps[' + applicationStepIndex + '][step]" placeholder="e.g., Step 1"></div></div>' +
                    '<div class="col-md-6"><div class="form-group"><label>Description</label>' +
                    '<input type="text" class="form-control" name="application_steps[' + applicationStepIndex + '][description]" placeholder="Step description"></div></div>' +
                    '</div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-application-step">Remove</button>' +
                    '</div></div>';
        $('#application-steps-container').append(html);
        applicationStepIndex++;
    });
    
    $(document).on('click', '.remove-application-step', function() {
        $(this).closest('.application-step-item').remove();
    });
});
</script>
@endpush

