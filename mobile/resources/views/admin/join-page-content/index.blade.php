@extends('admin.layouts.app')

@section('title', 'Join Page Content')
@section('page-title', 'Edit Join Page Content')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Join Page Content</li>
@endsection

@section('content')
<form action="{{ route('admin.join-page-content.update') }}" method="POST">
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
                                  placeholder="Enter hero title">{{ old('hero_title', $content->hero_title ?? 'Join Us') }}</textarea>
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

        <!-- Our Team Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i>Our Team Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="our_team_badge">Badge Text</label>
                        <input type="text" class="form-control @error('our_team_badge') is-invalid @enderror" 
                               id="our_team_badge" name="our_team_badge" 
                               value="{{ old('our_team_badge', $content->our_team_badge ?? 'Our Team') }}" 
                               placeholder="e.g., Our Team">
                        @error('our_team_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="our_team_title">Section Title</label>
                        <textarea class="form-control @error('our_team_title') is-invalid @enderror" 
                                  id="our_team_title" name="our_team_title" rows="2" 
                                  placeholder="Enter section title">{{ old('our_team_title', $content->our_team_title ?? 'If you want to lift yourself up, lift up someone else.') }}</textarea>
                        @error('our_team_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="our_team_description">Description</label>
                        <textarea class="form-control @error('our_team_description') is-invalid @enderror" 
                                  id="our_team_description" name="our_team_description" rows="3" 
                                  placeholder="Enter description">{{ old('our_team_description', $content->our_team_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.') }}</textarea>
                        @error('our_team_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Features</label>
                        <div id="our-team-features-container">
                            @php
                                $features = old('our_team_features', $content->our_team_features ?? ['Fast Turnaround Time', 'Comprehensive Warranty']);
                            @endphp
                            @foreach($features as $index => $feature)
                                <div class="input-group mb-2 feature-item">
                                    <input type="text" class="form-control" name="our_team_features[]" value="{{ $feature }}" placeholder="Enter feature">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger remove-feature-item">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-feature-item">Add Feature</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meet Our Team Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-friends mr-2"></i>Meet Our Team Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="meet_team_badge">Badge Text</label>
                        <input type="text" class="form-control @error('meet_team_badge') is-invalid @enderror" 
                               id="meet_team_badge" name="meet_team_badge" 
                               value="{{ old('meet_team_badge', $content->meet_team_badge ?? 'Meet Our Team') }}" 
                               placeholder="e.g., Meet Our Team">
                        @error('meet_team_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meet_team_title">Section Title</label>
                        <textarea class="form-control @error('meet_team_title') is-invalid @enderror" 
                                  id="meet_team_title" name="meet_team_title" rows="2" 
                                  placeholder="Enter section title">{{ old('meet_team_title', $content->meet_team_title ?? 'The Faces Behind MobiCare\'s Reliable Service') }}</textarea>
                        <small class="form-text text-muted">Use &lt;br /&gt; for line breaks</small>
                        @error('meet_team_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Team Members</label>
                        <div id="team-members-container">
                            @php
                                $teamMembers = old('team_members', $content->team_members ?? [
                                    ['name' => 'Team Name', 'designation' => 'Designation'],
                                    ['name' => 'Team Name', 'designation' => 'Designation'],
                                    ['name' => 'Team Name', 'designation' => 'Designation'],
                                    ['name' => 'Team Name', 'designation' => 'Designation'],
                                ]);
                            @endphp
                            @foreach($teamMembers as $index => $member)
                                <div class="card mb-3 team-member-item">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="team_members[{{ $index }}][name]" value="{{ $member['name'] ?? '' }}" placeholder="Enter team member name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" class="form-control" name="team_members[{{ $index }}][designation]" value="{{ $member['designation'] ?? '' }}" placeholder="Enter designation">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-team-member">Remove Member</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" id="add-team-member">Add Team Member</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Join Us Section -->
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-handshake mr-2"></i>Join Us Section</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="join_us_badge">Badge Text</label>
                        <input type="text" class="form-control @error('join_us_badge') is-invalid @enderror" 
                               id="join_us_badge" name="join_us_badge" 
                               value="{{ old('join_us_badge', $content->join_us_badge ?? 'Join Us') }}" 
                               placeholder="e.g., Join Us">
                        @error('join_us_badge')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="join_us_title">Section Title</label>
                        <textarea class="form-control @error('join_us_title') is-invalid @enderror" 
                                  id="join_us_title" name="join_us_title" rows="2" 
                                  placeholder="Enter section title">{{ old('join_us_title', $content->join_us_title ?? 'Passionate About Phone Repair? Join MobiCare Now!') }}</textarea>
                        @error('join_us_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="join_us_description">Description</label>
                        <textarea class="form-control @error('join_us_description') is-invalid @enderror" 
                                  id="join_us_description" name="join_us_description" rows="3" 
                                  placeholder="Enter description">{{ old('join_us_description', $content->join_us_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.') }}</textarea>
                        @error('join_us_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="join_us_button_text">Button Text</label>
                        <input type="text" class="form-control @error('join_us_button_text') is-invalid @enderror" 
                               id="join_us_button_text" name="join_us_button_text" 
                               value="{{ old('join_us_button_text', $content->join_us_button_text ?? 'Contact Us') }}" 
                               placeholder="e.g., Contact Us">
                        @error('join_us_button_text')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
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
                        <i class="fas fa-save mr-2"></i>Update Join Page Content
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
    // Our Team Features
    $('#add-feature-item').click(function() {
        const html = '<div class="input-group mb-2 feature-item">' +
                    '<input type="text" class="form-control" name="our_team_features[]" placeholder="Enter feature">' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="btn btn-danger remove-feature-item">Remove</button>' +
                    '</div></div>';
        $('#our-team-features-container').append(html);
    });
    
    $(document).on('click', '.remove-feature-item', function() {
        $(this).closest('.feature-item').remove();
    });

    // Team Members
    let teamMemberIndex = {{ count($teamMembers ?? []) }};
    $('#add-team-member').click(function() {
        const html = '<div class="card mb-3 team-member-item">' +
                    '<div class="card-body">' +
                    '<div class="row">' +
                    '<div class="col-md-6">' +
                    '<div class="form-group">' +
                    '<label>Name</label>' +
                    '<input type="text" class="form-control" name="team_members[' + teamMemberIndex + '][name]" placeholder="Enter team member name">' +
                    '</div></div>' +
                    '<div class="col-md-6">' +
                    '<div class="form-group">' +
                    '<label>Designation</label>' +
                    '<input type="text" class="form-control" name="team_members[' + teamMemberIndex + '][designation]" placeholder="Enter designation">' +
                    '</div></div></div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-team-member">Remove Member</button>' +
                    '</div></div>';
        $('#team-members-container').append(html);
        teamMemberIndex++;
    });
    
    $(document).on('click', '.remove-team-member', function() {
        $(this).closest('.team-member-item').remove();
    });
</script>
@endpush
@endsection

