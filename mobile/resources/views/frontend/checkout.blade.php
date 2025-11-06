@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('content')
<!-- Begin:: marketplace-header  -->

    <div class="marketplace-header py-3">
      <div class="container flex-center flex-wrap gap-3">
        <div class="dropdown">
          <button
            class="btn dropdown-toggle category-btn"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            All Category
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Mobiles</a></li>
            <li><a class="dropdown-item" href="#">Laptops</a></li>
            <li><a class="dropdown-item" href="#">Accessories</a></li>
          </ul>
        </div>

        <div class="d-flex align-items-center gap-4 text-muted">
          <a href="#" class="top-link d-flex align-items-center gap-2">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M5.25 21.75H18.75"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M19.5 9.75C19.5 16.5 12 21.75 12 21.75C12 21.75 4.5 16.5 4.5 9.75C4.5 7.76088 5.29018 5.85322 6.6967 4.4467C8.10322 3.04018 10.0109 2.25 12 2.25C13.9891 2.25 15.8968 3.04018 17.3033 4.4467C18.7098 5.85322 19.5 7.76088 19.5 9.75V9.75Z"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M12 12.75C13.6569 12.75 15 11.4069 15 9.75C15 8.09315 13.6569 6.75 12 6.75C10.3431 6.75 9 8.09315 9 9.75C9 11.4069 10.3431 12.75 12 12.75Z"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            Track Order
          </a>
          <a href="#" class="top-link d-flex align-items-center gap-2">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M21.1406 12.7503H18.1406C17.7428 12.7503 17.3613 12.9083 17.08 13.1897C16.7987 13.471 16.6406 13.8525 16.6406 14.2503V18.0003C16.6406 18.3981 16.7987 18.7797 17.08 19.061C17.3613 19.3423 17.7428 19.5003 18.1406 19.5003H19.6406C20.0384 19.5003 20.42 19.3423 20.7013 19.061C20.9826 18.7797 21.1406 18.3981 21.1406 18.0003V12.7503ZM21.1406 12.7503C21.1407 11.5621 20.9054 10.3856 20.4484 9.28875C19.9915 8.1919 19.3218 7.1964 18.4781 6.35969C17.6344 5.52297 16.6334 4.86161 15.5328 4.41375C14.4322 3.96589 13.2538 3.74041 12.0656 3.75031C10.8782 3.74165 9.70083 3.96805 8.60132 4.41647C7.5018 4.86488 6.50189 5.52645 5.6592 6.36304C4.81651 7.19963 4.1477 8.19471 3.69131 9.29094C3.23492 10.3872 2.99997 11.5629 3 12.7503V18.0003C3 18.3981 3.15804 18.7797 3.43934 19.061C3.72064 19.3423 4.10218 19.5003 4.5 19.5003H6C6.39782 19.5003 6.77936 19.3423 7.06066 19.061C7.34196 18.7797 7.5 18.3981 7.5 18.0003V14.2503C7.5 13.8525 7.34196 13.471 7.06066 13.1897C6.77936 12.9083 6.39782 12.7503 6 12.7503H3"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            Customer Support
          </a>
          <a href="#" class="top-link d-flex align-items-center gap-2">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11.25 11.25H12V16.5H12.75"
                stroke="#5F6C72"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M11.8125 7.5C12.0196 7.5 12.1875 7.66789 12.1875 7.875C12.1875 8.08211 12.0196 8.25 11.8125 8.25C11.6054 8.25 11.4375 8.08211 11.4375 7.875C11.4375 7.66789 11.6054 7.5 11.8125 7.5Z"
                fill="#191C1F"
                stroke="#5F6C72"
                stroke-width="1.5"
              />
            </svg>
            Need Help
          </a>
        </div>
      </div>
    </div>
    <!-- End:: marketplace-header  -->

    <!-- Begin:: marketplace-navigation  -->
    <section class="marketplace-navigation">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center gap-3 mb-0">
            <li class="breadcrumb-item">
              <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M11.875 16.2498V12.4998C11.875 12.334 11.8092 12.1751 11.6919 12.0579C11.5747 11.9406 11.4158 11.8748 11.25 11.8748H8.75C8.58424 11.8748 8.42527 11.9406 8.30806 12.0579C8.19085 12.1751 8.125 12.334 8.125 12.4998V16.2498C8.125 16.4156 8.05915 16.5745 7.94194 16.6917C7.82473 16.809 7.66576 16.8748 7.5 16.8748H3.75C3.58424 16.8748 3.42527 16.809 3.30806 16.6917C3.19085 16.5745 3.125 16.4156 3.125 16.2498V9.02324C3.1264 8.93674 3.14509 8.8514 3.17998 8.77224C3.21486 8.69308 3.26523 8.6217 3.32812 8.5623L9.57812 2.88261C9.69334 2.77721 9.84384 2.71875 10 2.71875C10.1562 2.71875 10.3067 2.77721 10.4219 2.88261L16.6719 8.5623C16.7348 8.6217 16.7851 8.69308 16.82 8.77224C16.8549 8.8514 16.8736 8.93674 16.875 9.02324V16.2498C16.875 16.4156 16.8092 16.5745 16.6919 16.6917C16.5747 16.809 16.4158 16.8748 16.25 16.8748H12.5C12.3342 16.8748 12.1753 16.809 12.0581 16.6917C11.9408 16.5745 11.875 16.4156 11.875 16.2498Z"
                  stroke="#5F6C72"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>

              <a href="{{ route('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <section class="container my-5">
      <div class="row">
        <div class="col-lg-8">
          <section class="checkout-main">
            <h3 class="fw-500 fs-18">Billing Information</h3>
            <form action="" class="billing-form">
              <div class="row">
                <div class="col-6 col-md-4 mb-3">
                  <label for="" class="form-label">User name</label>
                  <input
                    type="text"
                    class="form-input"
                    placeholder="First name"
                    name=""
                    id=""
                  />
                </div>
                <div class="col-6 col-md-4 mb-3">
                  <label for="" class="form-label">Last name</label>
                  <input
                    type="text"
                    class="form-input"
                    placeholder="Last name"
                    name=""
                    id=""
                  />
                </div>
                <div class="col-6 col-md-4 mb-3">
                  <label for="" class="form-label"
                    >Company Name <span>(Optional)</span></label
                  >
                  <input
                    type="text"
                    class="form-input"
                    placeholder="Last name"
                    name=""
                    id=""
                  />
                </div>
                <div class="col-12 mb-3">
                  <label for="" class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-input"
                    placeholder=""
                    name=""
                    id=""
                  />
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <label for="" class="form-label">Country</label>
                  <select name="" id="" class="form-input">
                    <option value="">Select...</option>
                    <option value="">Select 1</option>
                    <option value="">Select 2</option>
                  </select>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <label for="" class="form-label">Region/State</label>
                  <select name="" id="" class="form-input">
                    <option value="">Select...</option>
                    <option value="">Select 1</option>
                    <option value="">Select 2</option>
                  </select>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <label for="" class="form-label">City</label>
                  <select name="" id="" class="form-input">
                    <option value="">Select...</option>
                    <option value="">Select 1</option>
                    <option value="">Select 2</option>
                  </select>
                </div>
                <div class="col-6 col-md-3 mb-3">
                  <label for="" class="form-label">Zip Code</label>
                  <input
                    type="text"
                    class="form-input"
                    placeholder=""
                    name=""
                    id=""
                  />
                </div>
                <div class="col-6 mb-3">
                  <label for="" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-input"
                    placeholder=""
                    name=""
                    id=""
                  />
                </div>
                <div class="col-6 mb-3">
                  <label for="" class="form-label">Phone Number</label>
                  <input
                    type="text"
                    class="form-input"
                    placeholder=""
                    name=""
                    id=""
                  />
                </div>
                <div class="col-12 mb-3">
                  <div class="flex-center gap-2">
                    <input
                      type="checkbox"
                      class="form-checkbox"
                      placeholder=""
                      name=""
                      id=""
                    />
                    <label for="" class="form-label mb-0"
                      >Ship into different address</label
                    >
                  </div>
                </div>
              </div>

              <div class="payment-option mb-4">
                <h3 class="fw-500 fs-18 p-3">Payment Option</h3>
                <hr class="mt-0" />
                <div class="p-3">
                  <div class="row text-center border-bottom mb-3">
                    <div class="col">
                      <div
                        class="py-3 flex-center flex-column gap-2 border-end"
                      >
                        <img
                          src="{{ asset('front-assets/img/CurrencyDollar.svg') }}"
                          alt="Cash on Delivery"
                        />
                        <label class="form-label fw-500 w-100"
                          >Cash on Delivery</label
                        >
                        <input
                          type="radio"
                          name="payment"
                          class="custom-radio"
                        />
                      </div>
                    </div>
                    <div class="col">
                      <div
                        class="py-3 flex-center flex-column gap-2 border-end"
                      >
                        <img src="{{ asset('front-assets/img/venmo.svg') }}" alt="Venmo" />
                        <label class="form-label fw-500 w-100">Venmo</label>
                        <input
                          type="radio"
                          name="payment"
                          class="custom-radio"
                        />
                      </div>
                    </div>
                    <div class="col">
                      <div
                        class="py-3 flex-center flex-column gap-2 border-end"
                      >
                        <img src="{{ asset('front-assets/img/paypal.svg') }}" alt="Paypal" />
                        <label class="form-label fw-500 w-100">Paypal</label>
                        <input
                          type="radio"
                          name="payment"
                          class="custom-radio"
                        />
                      </div>
                    </div>
                    <div class="col">
                      <div
                        class="py-3 flex-center flex-column gap-2 border-end"
                      >
                        <img src="{{ asset('front-assets/img/amazon.svg') }}" alt="Amazon Pay" />
                        <label class="form-label fw-500 w-100"
                          >Amazon Pay</label
                        >
                        <input
                          type="radio"
                          name="payment"
                          class="custom-radio"
                        />
                      </div>
                    </div>
                    <div class="col">
                      <div class="flex-center flex-column gap-2 py-3">
                        <img
                          src="{{ asset('front-assets/img/CreditCard.svg') }}"
                          alt="Debit/Credit Card"
                        />
                        <label class="form-label fw-500 w-100"
                          >Debit/Credit Card</label
                        >
                        <input
                          type="radio"
                          name="payment"
                          class="custom-radio"
                          checked
                        />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Card Details -->
                <div class="p-3">
                  <div class="mb-3">
                    <label class="form-label">Name on Card</label>
                    <input
                      type="text"
                      class="form-input"
                      placeholder="Enter name on card"
                    />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Card Number</label>
                    <input
                      type="text"
                      class="form-input"
                      placeholder="0000 0000 0000 0000"
                    />
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Expire Date</label>
                      <input
                        type="text"
                        class="form-input"
                        placeholder="DD/YY"
                      />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">CVC</label>
                      <input type="text" class="form-input" placeholder="123" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="additional-information">
                <h3 class="fw-500 fs-18 p-3">Additional Information</h3>
                <label for="" class="form-label"
                  >Order Notes <span>(Optional)</span></label
                >
                <textarea
                  name=""
                  rows="5"
                  class="w-100 form-input"
                  placeholder="Notes about your order, e.g. special notes for delivery"
                  id=""
                ></textarea>
              </div>
            </form>
          </section>
        </div>
        <div class="col-lg-4">
          <div class="card-summary">
            <div class="card-total">
              <h5 class="fw-500 fs-18 mb-3">Order Summery</h5>

              <div class="order-items">
                <!-- Item 1 -->
                <div class="d-flex align-items-center mb-4">
                  <img
                    src="{{ asset('front-assets/img/phone-1.svg') }}"
                    alt="Canon EOS 1500D DSLR Camera"
                    width="70"
                    class="me-3 rounded"
                  />
                  <div class="flex-grow-1">
                    <small class="fw-400 fs-14 mb-1 text-truncate text-wrap">
                      Canon EOS 1500D DSLR Camera Body+ 18-55mm Lens
                    </small>
                    <div class="d-flex align-items-center">
                      <span class="fs-14 fw-400 text-muted-custom me-1"
                        >1 x</span
                      >
                      <span class="text-promo fw-500 fs-14">$70</span>
                    </div>
                  </div>
                </div>

                <!-- Item 2 -->
                <div class="d-flex align-items-center mb-4">
                  <img
                    src="{{ asset('front-assets/img/phone-2.svg') }}"
                    alt="Wired Over-Ear Gaming Headphones"
                    width="70"
                    class="me-3 rounded"
                  />
                  <div class="flex-grow-1">
                    <small class="fw-400 fs-14 mb-1 text-truncate text-wrap">
                      Wired Over-Ear Gaming Headphones with USB Surround Sound
                    </small>
                    <div class="d-flex align-items-center">
                      <span class="fs-14 fw-400 text-muted-custom me-1"
                        >3 x</span
                      >
                      <span class="text-promo fw-500 fs-14">$250</span>
                    </div>
                  </div>
                </div>
              </div>

              <ul class="totals-list list-unstyled mb-3">
                <li class="d-flex justify-content-between mb-2">
                  <span>Sub-total</span>
                  <span class="text-heading fw-500">$320</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <span>Shipping</span>
                  <span class="text-heading fw-500">Free</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <span>Discount</span>
                  <span class="text-heading fw-500">$24</span>
                </li>
                <li class="d-flex justify-content-between mb-2">
                  <span>Tax</span>
                  <span class="text-heading fw-500">$61.99</span>
                </li>
              </ul>

              <hr class="my-3" />

              <div
                class="d-flex justify-content-between align-items-center mb-4"
              >
                <span class="text-heading">Total</span>
                <span class="fw-600 text-heading fs-16">$357.99 USD</span>
              </div>

              <button class="btn btn-gradient radius-3 w-100">
                Place order <i class="bi bi-arrow-right ms-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    





@endsection
