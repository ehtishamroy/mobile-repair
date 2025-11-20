@extends('admin.layouts.app')

@section('title', 'Mail-in Process')
@section('page-title', 'Mail-in Process Information')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Mail-in Process</li>
@endsection

@section('content')
<form action="{{ route('admin.mail-in-process.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mail-in Process Information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $content->title ?? '') }}" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $content->description ?? '') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="process_title">Process Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('process_title') is-invalid @enderror" 
                               id="process_title" name="process_title" value="{{ old('process_title', $content->process_title ?? '') }}" required>
                        @error('process_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="process_description">Process Description</label>
                        <textarea class="form-control @error('process_description') is-invalid @enderror" 
                                  id="process_description" name="process_description" rows="4">{{ old('process_description', $content->process_description ?? '') }}</textarea>
                        @error('process_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="timeline_title">Timeline Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('timeline_title') is-invalid @enderror" 
                               id="timeline_title" name="timeline_title" value="{{ old('timeline_title', $content->timeline_title ?? '') }}" required>
                        @error('timeline_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="timeline_description">Timeline Description</label>
                        <textarea class="form-control @error('timeline_description') is-invalid @enderror" 
                                  id="timeline_description" name="timeline_description" rows="4">{{ old('timeline_description', $content->timeline_description ?? '') }}</textarea>
                        @error('timeline_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Mail-in Process Information</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

