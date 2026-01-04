@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="service-hero-section flex-stack mb-custom">
      <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
          Contact Us
        </h1>

        <p class="text-white text-center fw-400 fs-18 mb-4">
          Reliable Phone Repair Services, Guaranteed to <br />
          Meet Expectations
        </p>
      </div>
    </section>

    <section class="contact-section py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-md-2 g-4 align-items-stretch">
          <!-- Contact Form -->
          <div class="col">
            <form method="POST" action="{{ route('frontend.contact.submit') }}" class="h-100 d-flex flex-column">
              @csrf
              <h3 class="mb-3">Please fill the contact form</h3>
              
              @if(session('success'))
              <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
              </div>
              @endif
              
              @if(session('error'))
              <div class="alert alert-danger mb-3">
                <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
              </div>
              @endif
              
              @if($errors->any())
              <div class="alert alert-danger mb-3">
                <ul class="mb-0">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              
              <!-- Name -->
              <div class="mb-3">
                <label class="form-label text-heading mb-1" for="name"
                  >Name <span class="text-danger">*</span></label
                >
                <input
                  id="name"
                  name="name"
                  type="text"
                  class="custom-input @error('name') is-invalid @enderror"
                  placeholder="Enter your name"
                  value="{{ old('name') }}"
                  required
                />
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Email + Phone -->
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label text-heading mb-1" for="email"
                    >Email <span class="text-danger">*</span></label
                  >
                  <input
                    id="email"
                    name="email"
                    type="email"
                    class="custom-input @error('email') is-invalid @enderror"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required
                  />
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-heading mb-1" for="phone"
                    >Phone</label
                  >
                  <input
                    id="phone"
                    name="phone"
                    type="tel"
                    class="custom-input @error('phone') is-invalid @enderror"
                    placeholder="Enter your phone number"
                    value="{{ old('phone') }}"
                  />
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <!-- Message -->
              <div class="mb-3">
                <label class="form-label text-heading mb-1" for="message"
                  >Message <span class="text-danger">*</span></label
                >
                <textarea
                  id="message"
                  name="message"
                  class="custom-input @error('message') is-invalid @enderror"
                  placeholder="Please tell us a bit about what you're looking for"
                  rows="5"
                  required
                >{{ old('message') }}</textarea>
                @error('message')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Submit -->
              <button type="submit" class="btn-gradient rounded mt-auto">
                Submit Now
              </button>
            </form>
          </div>

          <!-- Google Map -->
          <div class="col">
            <div class="map-container h-100">
              <iframe
                title="Google Map"
                src="https://www.google.com/maps?q=Suzuki%20Islamabad%20Motors&output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
