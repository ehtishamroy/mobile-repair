@extends('frontend.layouts.app')

@section('title', 'Track Order')

@section('content')
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
            <li class="breadcrumb-item"><a href="{{ route('frontend.marketplace') }}">Marketplace</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Track Order
            </li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <!-- track Order  -->
    <section class="container my-5">
      <div class="row">
        <div class="col-10">
          <h2>Track Order</h2>
          <p class="fw-400 fs-16 text-muted-custom">
            To track your order please enter your order ID in the input field
            below and press the â€œTrack Orderâ€ button. this was given to you on
            your receipt and in the confirmation email you should have received.
          </p>
          <form class="track-order-form">
            <div class="row gy-4 mt-4">
              <div class="col-md-6">
                <div>
                  <label for="" class="fw-400 fs-14 text-heading mb-2"
                    >Order ID</label
                  >
                  <input type="text" placeholder="ID..." id="" />
                </div>
              </div>
              <div class="col-md-6">
                <div>
                  <label for="" class="fw-400 fs-14 text-heading mb-2"
                    >Billing Email</label
                  >
                  <input
                    type="text"
                    name=""
                    placeholder="Email address"
                    id=""
                  />
                </div>
              </div>
              <div class="col-md-6">
                <small class="mb-4 flex-center gap-3 fw-400 text-muted-custom">
                  <i class="bi bi-info-circle"></i>
                  Order ID that we sended to your in your email address.
                </small>
                <button class="btn-gradient">Track Order</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Track Record  -->
    <section class="track-record-section container mb-5">
      <div class="row">
        <div class="col-lg-11 mx-auto">
          <div class="track-record">
            <div class="row">
              <div class="col-12">
                <div class="order-summary-card">
                  <div
                    class="d-flex align-items-start justify-content-between flex-wrap gap-3"
                  >
                    <div>
                      <div class="mb-1">
                        <h5 class="mb-0 tracking-number">#96459761</h5>
                        <small class="text-heading">4 Products</small>
                        <small class="text-heading">Â·</small>
                        <small class="text-heading"
                          >Order Placed in 17 Jan, 2021 at 7:32 PM</small
                        >
                      </div>
                    </div>
                    <div class="order-amount">$1199.00</div>
                  </div>
                </div>

                <div class="order-steps mt-4">
                  <div class="order-arrival-date mb-4 fs-14 fw-500">
                    Order expected arrival
                    <span class="fw-600 text-heading">23 Jan, 2021</span>
                  </div>

                  <!-- Stepper -->
                  <div class="order-tracker">
                    <div
                      class="progress-track"
                      style="--steps: 4; --completed: 2"
                    >
                      <div class="progress-line"></div>

                      <!-- Step 1 -->
                      <div class="order-step completed">
                        <div class="order-circle">
                          <svg viewBox="0 0 24 24" class="check-icon">
                            <path
                              fill="white"
                              d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"
                            />
                          </svg>
                        </div>
                        <div class="icon">
                          <svg
                            width="32"
                            height="32"
                            viewBox="0 0 32 32"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              opacity="0.2"
                              d="M10 27H6C5.73478 27 5.48043 26.8946 5.29289 26.7071C5.10536 26.5196 5 26.2652 5 26V6C5 5.73478 5.10536 5.48043 5.29289 5.29289C5.48043 5.10536 5.73478 5 6 5H10V27Z"
                              fill="#2DB324"
                            />
                            <path
                              d="M14 14H22"
                              stroke="#2DB324"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M14 18H22"
                              stroke="#2DB324"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M26 5H6C5.44772 5 5 5.44772 5 6V26C5 26.5523 5.44772 27 6 27H26C26.5523 27 27 26.5523 27 26V6C27 5.44772 26.5523 5 26 5Z"
                              stroke="#2DB324"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M10 5V27"
                              stroke="#2DB324"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </div>
                        <p>Order Placed</p>
                      </div>

                      <!-- Step 2 -->
                      <div class="order-step completed">
                        <div class="order-circle">
                          <svg viewBox="0 0 24 24" class="check-icon">
                            <path
                              fill="white"
                              d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"
                            />
                          </svg>
                        </div>
                        <div class="icon">
                          <svg
                            width="32"
                            height="32"
                            viewBox="0 0 32 32"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              opacity="0.2"
                              d="M4.1375 9.3252C4.04693 9.48077 3.99946 9.65768 4 9.8377V22.1627C4.00096 22.3407 4.04884 22.5154 4.13882 22.669C4.2288 22.8226 4.35769 22.9498 4.5125 23.0377L15.5125 29.2252C15.6608 29.3099 15.8292 29.3531 16 29.3502L16.1125 16.0002L4.1375 9.3252Z"
                              fill="#5B265D"
                            />
                            <path
                              d="M28 22.1627V9.83766C27.999 9.65963 27.9512 9.485 27.8612 9.33137C27.7712 9.17775 27.6423 9.05057 27.4875 8.96266L16.4875 2.77516C16.3393 2.68958 16.1711 2.64453 16 2.64453C15.8289 2.64453 15.6607 2.68958 15.5125 2.77516L4.5125 8.96266C4.35769 9.05057 4.22879 9.17775 4.13882 9.33137C4.04884 9.485 4.00096 9.65963 4 9.83766V22.1627C4.00096 22.3407 4.04884 22.5153 4.13882 22.6689C4.22879 22.8226 4.35769 22.9497 4.5125 23.0377L15.5125 29.2252C15.6607 29.3107 15.8289 29.3558 16 29.3558C16.1711 29.3558 16.3393 29.3107 16.4875 29.2252L27.4875 23.0377C27.6423 22.9497 27.7712 22.8226 27.8612 22.6689C27.9512 22.5153 27.999 22.3407 28 22.1627V22.1627Z"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M22.125 19.0625V12.5625L10 5.875"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M27.8627 9.3252L16.1127 16.0002L4.1377 9.3252"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M16.1125 16L16 29.35"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </div>
                        <p>Packaging</p>
                      </div>

                      <!-- Step 3 -->
                      <div class="order-step">
                        <div class="order-circle">
                          <svg viewBox="0 0 24 24" class="check-icon">
                            <path
                              fill="white"
                              d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"
                            />
                          </svg>
                        </div>
                        <div class="icon">
                          <svg
                            width="32"
                            height="32"
                            viewBox="0 0 32 32"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              opacity="0.2"
                              d="M22 18H2V23C2 23.2652 2.10536 23.5196 2.29289 23.7071C2.48043 23.8946 2.73478 24 3 24H5.5C5.5 23.2044 5.81607 22.4413 6.37868 21.8787C6.94129 21.3161 7.70435 21 8.5 21C9.29565 21 10.0587 21.3161 10.6213 21.8787C11.1839 22.4413 11.5 23.2044 11.5 24H20.5C20.4997 23.4731 20.6381 22.9553 20.9014 22.4989C21.1648 22.0425 21.5437 21.6635 22 21.4V18Z"
                              fill="#5B265D"
                            />
                            <path
                              opacity="0.2"
                              d="M26.5 24C26.5003 23.4732 26.362 22.9557 26.0988 22.4993C25.8356 22.043 25.4569 21.664 25.0008 21.4005C24.5447 21.1369 24.0273 20.9982 23.5005 20.9981C22.9737 20.998 22.4562 21.1366 22 21.4V15H30V23C30 23.2652 29.8946 23.5196 29.7071 23.7071C29.5196 23.8946 29.2652 24 29 24H26.5Z"
                              fill="#5B265D"
                            />
                            <path
                              d="M22 10H27.325C27.5242 9.99872 27.7192 10.0577 27.8843 10.1693C28.0494 10.2808 28.1769 10.4397 28.25 10.625L30 15"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M2 18H22"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M23.5 27C25.1569 27 26.5 25.6569 26.5 24C26.5 22.3431 25.1569 21 23.5 21C21.8431 21 20.5 22.3431 20.5 24C20.5 25.6569 21.8431 27 23.5 27Z"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-miterlimit="10"
                            />
                            <path
                              d="M8.5 27C10.1569 27 11.5 25.6569 11.5 24C11.5 22.3431 10.1569 21 8.5 21C6.84315 21 5.5 22.3431 5.5 24C5.5 25.6569 6.84315 27 8.5 27Z"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-miterlimit="10"
                            />
                            <path
                              d="M20.5 24H11.5"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M5.5 24H3C2.73478 24 2.48043 23.8946 2.29289 23.7071C2.10536 23.5196 2 23.2652 2 23V9C2 8.73478 2.10536 8.48043 2.29289 8.29289C2.48043 8.10536 2.73478 8 3 8H22V21.4"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M22 15H30V23C30 23.2652 29.8946 23.5196 29.7071 23.7071C29.5196 23.8946 29.2652 24 29 24H26.5"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </div>
                        <p>On The Road</p>
                      </div>

                      <!-- Step 4 -->
                      <div class="order-step">
                        <div class="order-circle">
                          <svg viewBox="0 0 24 24" class="check-icon">
                            <path
                              fill="white"
                              d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"
                            />
                          </svg>
                        </div>
                        <div class="icon">
                          <svg
                            width="32"
                            height="32"
                            viewBox="0 0 32 32"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              opacity="0.2"
                              d="M25 19.1128L20.4 23.7128C20.2746 23.83 20.1227 23.9151 19.9573 23.9608C19.7918 24.0066 19.6178 24.0115 19.45 23.9753L12.2 22.1628C12.0676 22.1259 11.9442 22.062 11.8375 21.9753L5 16.6378L9.075 8.97527L15.4875 7.10027C15.7154 7.03493 15.959 7.05265 16.175 7.15027L20.5 9.11277H17.9125C17.7826 9.11231 17.654 9.13747 17.5339 9.18681C17.4138 9.23614 17.3045 9.30868 17.2125 9.40027L12.3125 14.2878C12.2125 14.3905 12.1354 14.5133 12.0863 14.648C12.0373 14.7827 12.0174 14.9264 12.0281 15.0694C12.0387 15.2123 12.0796 15.3514 12.148 15.4775C12.2164 15.6035 12.3109 15.7135 12.425 15.8003L13.1 16.3128C13.7932 16.8301 14.635 17.1097 15.5 17.1097C16.365 17.1097 17.2068 16.8301 17.9 16.3128L19.5 15.1128L25 19.1128Z"
                              fill="#5B265D"
                            />
                            <path
                              d="M30.0875 15.2251L27 16.7626L23 9.11259L26.125 7.55009C26.3572 7.43171 26.6269 7.40996 26.8751 7.48957C27.1233 7.56919 27.33 7.74371 27.45 7.97509L30.525 13.8626C30.5874 13.9804 30.6255 14.1096 30.6372 14.2424C30.6489 14.3752 30.634 14.509 30.5932 14.636C30.5525 14.7629 30.4867 14.8805 30.3999 14.9816C30.313 15.0828 30.2068 15.1656 30.0875 15.2251V15.2251Z"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M4.99979 16.6375L1.91229 15.0875C1.79341 15.0292 1.68746 14.9477 1.60073 14.8476C1.51401 14.7476 1.44829 14.6311 1.40747 14.5052C1.36666 14.3793 1.35159 14.2464 1.36315 14.1145C1.37471 13.9826 1.41268 13.8544 1.47479 13.7375L4.54979 7.84999C4.67008 7.61878 4.87588 7.44367 5.12337 7.36195C5.37086 7.28023 5.64047 7.29837 5.87479 7.41249L8.99979 8.97499L4.99979 16.6375Z"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M27 16.7627L25 19.1127L20.4 23.7127C20.2746 23.8299 20.1227 23.915 19.9573 23.9608C19.7918 24.0065 19.6178 24.0114 19.45 23.9752L12.2 22.1627C12.0676 22.1258 11.9442 22.062 11.8375 21.9752L5 16.6377"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M25.0001 19.1123L19.5001 15.1123L17.9001 16.3123C17.2069 16.8297 16.3651 17.1092 15.5001 17.1092C14.6351 17.1092 13.7933 16.8297 13.1001 16.3123L12.4251 15.7998C12.311 15.713 12.2166 15.603 12.1481 15.477C12.0797 15.351 12.0388 15.2119 12.0282 15.0689C12.0175 14.9259 12.0374 14.7823 12.0864 14.6476C12.1355 14.5128 12.2126 14.39 12.3126 14.2873L17.2126 9.39981C17.3047 9.30822 17.4139 9.23568 17.534 9.18635C17.6541 9.13701 17.7828 9.11186 17.9126 9.11231H23.0001"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M9.0752 8.97527L15.4877 7.10027C15.7155 7.03493 15.9592 7.05265 16.1752 7.15027L20.5002 9.11277"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                            <path
                              d="M14 26.6125L10.2375 25.6625C10.0842 25.6279 9.94221 25.5547 9.825 25.45L7 23"
                              stroke="#5B265D"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </div>
                        <p>Delivered</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <!-- Activity -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="order-activity radius-4">
                  <div class="px-4 py-3">
                    <h6 class="mb-0 fw-500 fs-18 text-heading">
                      Order Activity
                    </h6>
                  </div>

                  <div class="p-4">
                    <div class="activity-item">
                      <div class="icon-badge bg-success-100">
                        <img src="{{ asset('front-assets/img/double-check.svg') }}" alt="" />
                      </div>
                      <div class="flex-1">
                        <div class="activity-head">
                          Your order has been delivered. Thank you for shopping
                          at Clicon!
                        </div>
                        <div class="activity-date mt-1">
                          23 Oct, 2025 at 7:32 PM
                        </div>
                      </div>
                    </div>

                    <div class="activity-item">
                      <div class="icon-badge bg-primary-100">
                        <img src="{{ asset('front-assets/img/user.svg') }}" alt="" />
                      </div>
                      <div class="flex-1">
                        <div class="activity-head">
                          Our delivery man (John Wick) Has picked-up your order
                          for delivery.
                        </div>
                        <div class="activity-date mt-1">
                          23 Oct, 2025 at 2:00 PM
                        </div>
                      </div>
                    </div>

                    <div class="activity-item">
                      <div class="icon-badge bg-primary-100">
                        <img src="{{ asset('front-assets/img/MapPinLine.svg') }}" alt="" />
                      </div>
                      <div class="flex-1">
                        <div class="activity-head">
                          Your order has reached at last mile hub.
                        </div>
                        <div class="activity-date mt-1">
                          23 Oct, 2025 at 8:00 AM
                        </div>
                      </div>
                    </div>

                    <div class="activity-item">
                      <div class="icon-badge bg-primary-100">
                        <img src="{{ asset('front-assets/img/MapTrifold.svg') }}" alt="" />
                      </div>
                      <div class="flex-1">
                        <div class="activity-head">
                          Your order on the way to (last mile) hub.
                        </div>
                        <div class="activity-date mt-1">
                          23 Oct, 2025 at 5:32 AM
                        </div>
                      </div>
                    </div>
                    <div class="activity-item">
                      <div class="icon-badge bg-success-100">
                        <img src="{{ asset('front-assets/img/CheckCircle.svg') }}" alt="" />
                      </div>
                      <div class="flex-1">
                        <div class="activity-head">
                          Your order is successfully verified.
                        </div>
                        <div class="activity-date mt-1">
                          23 Oct, 2025 at 7:32 PM
                        </div>
                      </div>
                    </div>

                    <div class="activity-item">
                      <div class="icon-badge bg-primary-100">
                        <img
                          src="{{ asset('front-assets/img/Notepad.svg') }}"
                          alt=""
                        />
                      </div>
                      <div class="flex-1">
                        <div class="activity-head">
                          Your order has been confirmed.
                        </div>
                        <div class="activity-date mt-1">
                          23 Oct, 2025 at 2:61 PM
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      // Existing tracker setup
      document
        .querySelectorAll(".order-tracker .progress-track")
        .forEach((track) => {
          const steps = track.querySelectorAll(".order-step").length;
          const completed = track.querySelectorAll(
            ".order-step.completed"
          ).length;
          track.style.setProperty("--steps", steps);
          track.style.setProperty(
            "--completed",
            Math.max(1, Math.min(completed, steps))
          );
        });

      // Show track record when button is clicked
      document
        .querySelector(".track-order-form")
        .addEventListener("submit", function (e) {
          e.preventDefault(); // prevent form submission / page reload

          const trackRecordSection = document.querySelector(
            ".track-record-section"
          );

          // Optional: add smooth reveal animation
          trackRecordSection.style.display = "block";
          trackRecordSection.scrollIntoView({ behavior: "smooth" });
        });
    </script>

    


@endsection
