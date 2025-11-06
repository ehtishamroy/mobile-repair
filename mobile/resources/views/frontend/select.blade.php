@extends('frontend.layouts.app')

@section('title', 'Book Repair')

@section('content')
<div class="container my-5">
      <!-- Stepper -->
      <div
        id="stepper"
        class="stepper d-flex justify-content-between align-items-center position-relative mb-5 overflow-auto"
      >
        <div class="step active">
          <div class="circle">1</div>
          <div class="label">Information</div>
        </div>
        <div class="step">
          <div class="circle">2</div>
          <div class="label">Select Method</div>
        </div>
        <div class="step">
          <div class="circle">3</div>
          <div class="label">Method Details</div>
        </div>
        <div class="step">
          <div class="circle">4</div>
          <div class="label">Confirm Details</div>
        </div>
        <div class="step">
          <div class="circle">5</div>
          <div class="label">Payment</div>
        </div>
      </div>

      <!-- Step Content -->
      <div id="form-steps">
        <div class="step-content active">
          <h1 class="text-center my-4">Let's get started!</h1>
          <div class="row mt-3 gy-5">
            <div class="col-md-6 col-12">
              <div class="">
                <label class="form-label" for="name">Name</label>
                <input
                  id="name"
                  type="text"
                  placeholder="Full name"
                  class="custom-input"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="">
                <label class="form-label" for="email">Your email address</label>
                <input
                  id="email"
                  type="text"
                  placeholder="Email address"
                  class="custom-input"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="">
                <label class="form-label" for="phone">Your phone number</label>
                <input
                  id="phone"
                  type="text"
                  placeholder="Phone number"
                  class="custom-input"
                  placeholder=""
                />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="">
                <label class="form-label" for="device">Model of device</label>
                <select class="custom-select" name="" id="">
                  <option value="1">Device 1</option>
                  <option value="2">Device 2</option>
                  <option value="3">Device 3</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="device-issues mt-4">
                <label class="form-label">Device Issue</label>
                <div class="d-flex flex-wrap gap-3">
                  <div class="form-check custom-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="issue1"
                    />
                    <label class="form-check-label" for="issue1"
                      >Front Screen</label
                    >
                  </div>

                  <div class="form-check custom-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="issue2"
                    />
                    <label class="form-check-label" for="issue2"
                      >Back Cover</label
                    >
                  </div>

                  <div class="form-check custom-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="issue3"
                    />
                    <label class="form-check-label" for="issue3"
                      >Battery & Charging</label
                    >
                  </div>

                  <div class="form-check custom-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="issue4"
                    />
                    <label class="form-check-label" for="issue4"
                      >Camera Issues</label
                    >
                  </div>

                  <div class="form-check custom-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="issue5"
                    />
                    <label class="form-check-label" for="issue5">Others</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="">
                <label class="form-label" for="issue"
                  >Describe your issue</label
                >
                <textarea
                  class="custom-input"
                  name=""
                  id=""
                  cols="30"
                  rows="5"
                  placeholder="Additional comments here...."
                ></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="step-content">
          <h1 class="text-sm-center my-4 mb-5">
            How do you want us to fix your device?
          </h1>
          <div class="">
            <label class="form-label" for="Method">Select Method</label>
            <select class="custom-select" name="" id="">
              <option value="1">Method 1</option>
              <option value="2">Method 2</option>
              <option value="3">Method 3</option>
            </select>
          </div>
        </div>

        <div class="step-content">
          <div class="d-flex flex-column gap-4">
            <h1 class="text-center">Mail-in service</h1>
            <p class="text-center fw-400 fs-18">
              Thank you for selecting our mail-in repair service.â€¨This is our
              most widely accessible service and ideal for customers who do not
              live near our service centre.
            </p>
            <h1 class="text-center">Whatâ€™s the process ?</h1>
            <p class="text-center fw-400 fs-18">
              Place the device inside the pack and drop into your local post
              office. Once we receive your device, we will diagnose the issue,
              complete the repair, and mail your device back to you.
            </p>
            <h1 class="text-center">How long will it take?</h1>
            <p class="text-center fw-400 fs-18">
              Usually, your device will be returned to youÂ within 2-3 business
              days from the point we receive your deviceÂ at our central service
              centre. In certain circumstances, depending on the nature of the
              issue and parts availability, your repair may take longer than
              this. In these circumstances we will contact you so that you
              remain up to date on how your repair is progressing.
            </p>
          </div>
        </div>

        <div class="step-content">
          <h1 class="text-center mb-5 pb-3">Please Confirm Your Details:</h1>

          <div class="row">
            <div class="col-md-6">
              <div class="section-header">Your Details</div>
              <div class="row">
                <div class="col-6 section-details">
                  <label for="">Your name : </label>
                  <p>Furqan Rasool</p>
                </div>
                <div class="col-6 section-details">
                  <label for="">Your phone : </label>
                  <p>1234567890</p>
                </div>
                <div class="col-12 section-details">
                  <label for="">Your email : </label>
                  <p>rasol.furqan@gmail.com</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="section-header">Device Details</div>
              <div class="row">
                <div class="col-6 section-details">
                  <label for="">Device model : </label>
                  <p>iPhone 16</p>
                </div>
                <div class="col-6 section-details">
                  <label for="">Repair Type : </label>
                  <p>Screen Replacement</p>
                </div>
                <div class="col-12 section-details">
                  <label for="">Comments : </label>
                  <p>Lorem ipsum text used for dummy purposes.</p>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="section-header text-center">Total Cost</div>
              <div>
                <div class="flex-between section-details">
                  <label for="">Screen Repairing Cost </label>
                  <p>$150</p>
                </div>
                <div class="flex-between section-details">
                  <label for="">Battery Replacement Cost </label>
                  <p>$150</p>
                </div>
                <hr />
                <div class="flex-between section-details">
                  <label for="">Total Cost</label>
                  <p>$150</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="step-content">
          <h4>Step 5: Payment</h4>
          <p>Complete your payment.</p>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-outline-secondary fs-12" id="prevBtn" disabled>
          Previous
        </button>
        <button class="btn btn-gradient rounded w-md-25" id="nextBtn">
          Confirm
        </button>
      </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const steps = document.querySelectorAll(".step");
        const contents = document.querySelectorAll(".step-content");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");
        let currentStep = 0;

        function updateStepper() {
          steps.forEach((step, index) => {
            step.classList.remove("active", "completed");
            if (index < currentStep) step.classList.add("completed");
            if (index === currentStep) step.classList.add("active");
          });

          contents.forEach((content, index) => {
            content.classList.toggle("active", index === currentStep);
          });

          prevBtn.disabled = currentStep === 0;
          nextBtn.textContent =
            currentStep === steps.length - 1 ? "Finish" : "Confirm";
        }

        nextBtn.addEventListener("click", () => {
          if (currentStep < steps.length - 1) {
            currentStep++;
            updateStepper();
          }
        });

        prevBtn.addEventListener("click", () => {
          if (currentStep > 0) {
            currentStep--;
            updateStepper();
          }
        });

        updateStepper(); // Initialize
      });
    </script>

@endsection
