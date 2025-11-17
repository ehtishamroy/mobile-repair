@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Website Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- General Settings -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-globe mr-2"></i>General Settings</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="website_name">Website Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('website_name') is-invalid @enderror" 
                               id="website_name" name="website_name" 
                               value="{{ old('website_name', $settings->website_name) }}" 
                               placeholder="Enter website name">
                        @error('website_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="website_title">Website Title</label>
                        <input type="text" class="form-control @error('website_title') is-invalid @enderror" 
                               id="website_title" name="website_title" 
                               value="{{ old('website_title', $settings->website_title) }}" 
                               placeholder="Enter website title">
                        @error('website_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="website_description">Website Description</label>
                        <textarea class="form-control @error('website_description') is-invalid @enderror" 
                                  id="website_description" name="website_description" rows="3" 
                                  placeholder="Enter website description">{{ old('website_description', $settings->website_description) }}</textarea>
                        @error('website_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="promo_title">Promo Title</label>
                        <input type="text" class="form-control @error('promo_title') is-invalid @enderror" 
                               id="promo_title" name="promo_title" 
                               value="{{ old('promo_title', $settings->promo_title) }}" 
                               placeholder="Enter promo title">
                        @error('promo_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_email">Contact Form Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" name="contact_email" 
                               value="{{ old('contact_email', $settings->contact_email) }}" 
                               placeholder="Enter email address for contact form submissions">
                        <small class="form-text text-muted">Contact form submissions will be sent to this email address</small>
                        @error('contact_email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="currency">Default Currency <span class="text-danger">*</span></label>
                        <select class="form-control @error('currency') is-invalid @enderror" 
                                id="currency" name="currency" required>
                            <option value="USD" {{ old('currency', $settings->currency ?? 'USD') == 'USD' ? 'selected' : '' }}>
                                USD ($)
                            </option>
                            <option value="GBP" {{ old('currency', $settings->currency ?? 'USD') == 'GBP' ? 'selected' : '' }}>
                                GBP (£)
                            </option>
                        </select>
                        <small class="form-text text-muted">This currency will be used throughout the store</small>
                        @error('currency')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo & Favicon -->
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-image mr-2"></i>Logo & Favicon</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="website_logo">Website Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('website_logo') is-invalid @enderror" 
                                       id="website_logo" name="website_logo" accept="image/*">
                                <label class="custom-file-label" for="website_logo">Choose file</label>
                            </div>
                        </div>
                        @if($settings->website_logo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $settings->website_logo) }}" alt="Current Logo" style="max-height: 100px;">
                                <p class="text-muted small mt-1">Current logo</p>
                            </div>
                        @endif
                        <small class="form-text text-muted">Recommended size: 200x50px. Max size: 2MB</small>
                        @error('website_logo')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="favicon">Favicon</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('favicon') is-invalid @enderror" 
                                       id="favicon" name="favicon" accept="image/*,.ico">
                                <label class="custom-file-label" for="favicon">Choose file</label>
                            </div>
                        </div>
                        @if($settings->favicon)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Current Favicon" style="max-height: 32px;">
                                <p class="text-muted small mt-1">Current favicon</p>
                            </div>
                        @endif
                        <small class="form-text text-muted">Recommended size: 32x32px or 16x16px. Max size: 512KB</small>
                        @error('favicon')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Media Links -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-share-alt mr-2"></i>Social Media Links</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook_url">
                                    <i class="fab fa-facebook text-primary mr-1"></i> Facebook URL
                                </label>
                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                       id="facebook_url" name="facebook_url" 
                                       value="{{ old('facebook_url', $settings->facebook_url) }}" 
                                       placeholder="https://facebook.com/yourpage">
                                @error('facebook_url')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram_url">
                                    <i class="fab fa-instagram text-danger mr-1"></i> Instagram URL
                                </label>
                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" 
                                       id="instagram_url" name="instagram_url" 
                                       value="{{ old('instagram_url', $settings->instagram_url) }}" 
                                       placeholder="https://instagram.com/yourprofile">
                                @error('instagram_url')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tiktok_url">
                                    <i class="fab fa-tiktok mr-1"></i> TikTok URL
                                </label>
                                <input type="url" class="form-control @error('tiktok_url') is-invalid @enderror" 
                                       id="tiktok_url" name="tiktok_url" 
                                       value="{{ old('tiktok_url', $settings->tiktok_url) }}" 
                                       placeholder="https://tiktok.com/@yourusername">
                                @error('tiktok_url')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="youtube_url">
                                    <i class="fab fa-youtube text-danger mr-1"></i> YouTube URL
                                </label>
                                <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                                       id="youtube_url" name="youtube_url" 
                                       value="{{ old('youtube_url', $settings->youtube_url) }}" 
                                       placeholder="https://youtube.com/channel/yourchannel">
                                @error('youtube_url')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEO Settings -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-search mr-2"></i>SEO Settings</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                               id="meta_title" name="meta_title" 
                               value="{{ old('meta_title', $settings->meta_title) }}" 
                               placeholder="Enter meta title for SEO"
                               maxlength="255">
                        <small class="form-text text-muted">Recommended: 50-60 characters</small>
                        @error('meta_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" name="meta_description" rows="3" 
                                  placeholder="Enter meta description for SEO"
                                  maxlength="500">{{ old('meta_description', $settings->meta_description) }}</textarea>
                        <small class="form-text text-muted">Recommended: 150-160 characters</small>
                        @error('meta_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                               id="meta_keywords" name="meta_keywords" 
                               value="{{ old('meta_keywords', $settings->meta_keywords) }}" 
                               placeholder="keyword1, keyword2, keyword3"
                               maxlength="500">
                        <small class="form-text text-muted">Separate keywords with commas</small>
                        @error('meta_keywords')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="og_image">Open Graph Image (OG Image)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('og_image') is-invalid @enderror" 
                                       id="og_image" name="og_image" accept="image/*">
                                <label class="custom-file-label" for="og_image">Choose file</label>
                            </div>
                        </div>
                        @if($settings->og_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $settings->og_image) }}" alt="Current OG Image" style="max-height: 200px;">
                                <p class="text-muted small mt-1">Current OG image</p>
                            </div>
                        @endif
                        <small class="form-text text-muted">Recommended size: 1200x630px. Max size: 2MB</small>
                        @error('og_image')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Save Settings
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    // Update file input labels
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('.custom-file-input');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'Choose file';
                const label = e.target.nextElementSibling;
                label.textContent = fileName;
            });
        });
    });
</script>
@endpush
@endsection

