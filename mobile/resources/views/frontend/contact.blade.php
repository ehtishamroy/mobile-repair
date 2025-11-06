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
            <form novalidate class="h-100 d-flex flex-column">
              <h3 class="mb-3">Please fill the contact form</h3>
              <!-- Name -->
              <div class="mb-3">
                <label class="form-label text-heading mb-1" for="name"
                  >Name</label
                >
                <input
                  id="name"
                  type="text"
                  class="custom-input"
                  placeholder=""
                />
              </div>

              <!-- Email + Phone -->
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label text-heading mb-1" for="email"
                    >Email</label
                  >
                  <input
                    id="email"
                    type="email"
                    class="custom-input"
                    placeholder=""
                  />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label text-heading mb-1" for="phone"
                    >Phone</label
                  >
                  <input
                    id="phone"
                    type="tel"
                    class="custom-input"
                    placeholder=""
                  />
                </div>
              </div>

              <!-- Message -->
              <div class="mb-3">
                <label class="form-label text-heading mb-1" for="message"
                  >Message</label
                >
                <textarea
                  id="message"
                  class="custom-input"
                  placeholder="Please tell us a bit about what you're looking for"
                ></textarea>
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
