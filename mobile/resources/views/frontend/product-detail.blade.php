@extends('frontend.layouts.app')

@section('title', 'Product Detail')

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
              Electronics Devices
            </li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <!-- Begin:: Product Detail -->
    <section class="py-5 product-detail">
      <div class="container">
        <div class="row align-items-start">
          <!-- Gallery -->
          <div class="col-12 col-lg-6">
            <div class="pd-gallery">
              <div class="pd-main ratio ratio-16x9 bg-light rounded">
                <img
                  id="pdMainImg"
                  src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=1600&auto=format&fit=crop"
                  alt="Product"
                  class="img-fluid rounded"
                />
              </div>
              <div class="pd-thumbs mt-3 position-relative">
                <button
                  class="btn rounded-circle p-0 pd-nav pd-nav-prev"
                  data-dir="prev"
                  aria-label="Previous"
                  style="width: 40px; height: 40px"
                >
                  <i class="bi bi-arrow-left"></i>
                </button>
                <div
                  class="d-flex gap-2 px-3 flex-nowrap pd-thumbs-track overflow-auto"
                >
                  <img
                    class="pd-thumb active"
                    src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=800&auto=format&fit=crop"
                    alt="thumb-1"
                  />
                  <img
                    class="pd-thumb"
                    src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=800&auto=format&fit=crop"
                    alt="thumb-2"
                  />
                  <img
                    class="pd-thumb"
                    src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?q=80&w=800&auto=format&fit=crop"
                    alt="thumb-2"
                  />
                  <img
                    class="pd-thumb"
                    src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=900&auto=format&fit=crop"
                    alt="thumb-3"
                  />
                  <img
                    class="pd-thumb"
                    src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=900&auto=format&fit=crop"
                    alt="thumb-4"
                  />
                  <img
                    class="pd-thumb"
                    src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?q=80&w=700&auto=format&fit=crop"
                    alt="thumb-5"
                  />
                </div>
                <button
                  class="btn rounded-circle p-0 pd-nav pd-nav-next"
                  data-dir="next"
                  aria-label="Next"
                  style="width: 40px; height: 40px"
                >
                  <i class="bi bi-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Details -->
          <div class="col-12 col-lg-6">
            <div class="pd-info">
              <div class="d-flex align-items-center gap-2 mb-2">
                <div class="text-primary-custom">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                </div>
                <small class="text-heading fw-600"
                  >4.7 Star Rating
                  <span class="pd-feedback">(21,671 User feedback)</span></small
                >
              </div>

              <h3 class="title-head my-3">
                2025 Apple MacBook Pro with Apple M1 Chip (13â€‘inch, 8GB RAM,
                256GB SSD) â€“ Space Gray
              </h3>
              <div class="row gy-2 mb-3 row-cols-2">
                <div class="col">
                  <small class="text-gray-600"
                    >SKU:
                    <span class="fw-600 text-heading">A264671</span></small
                  >
                </div>
                <div class="col">
                  <small class="text-gray-600"
                    >Availability:
                    <span class="fw-600 text-stock">In Stock</span></small
                  >
                </div>
                <div class="col">
                  <small class="text-gray-600"
                    >Brand:
                    <span class="fw-600 text-heading">Apple</span></small
                  >
                </div>
                <div class="col">
                  <small class="text-gray-600"
                    >Category:
                    <span class="fw-600 text-heading"
                      >Electronics Devices</span
                    ></small
                  >
                </div>
              </div>

              <div class="d-flex align-items-center gap-3 mb-3">
                <div class="pd-price mb-0">$1699</div>
                <del class="text-gray-600 fw-400 fs-18">$1999.00</del>
                <span class="off-badge">21% OFF</span>
              </div>

              <hr />

              <!-- Options -->
              <div class="row g-3 mb-3">
                <!-- Color -->
                <div class="col-12 col-lg-6">
                  <div>
                    <label class="label-text">Color</label>
                    <div class="d-flex align-items-center gap-2">
                      <!-- <div class="pd-color"> -->
                      <input
                        class="btn-check"
                        type="radio"
                        name="pdColor"
                        id="pdColor1"
                        checked
                      />
                      <label for="pdColor1" class="pd-color"> </label>
                      <!-- </div> -->
                      <input
                        class="btn-check"
                        type="radio"
                        name="pdColor"
                        id="pdColor2"
                      />
                      <label for="pdColor2" class="pd-color"></label>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="label-text">Size</label>
                  <select class="custom-form-select">
                    <option selected>14â€‘inch Liquid Retina XDR display</option>
                    <option>16â€‘inch Liquid Retina XDR display</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="label-text">Memory</label>
                  <select class="custom-form-select">
                    <option selected>16GB unified memory</option>
                    <option>32GB unified memory</option>
                  </select>
                </div>
                <div class="col-12 col-lg-6">
                  <label class="label-text">Storage</label>
                  <select class="custom-form-select">
                    <option selected>1TB SSD Storage</option>
                    <option>2TB SSD Storage</option>
                  </select>
                </div>
              </div>

              <!-- Qty + Actions -->
              <div class="d-flex flex-lg-nowrap gap-1 gap-sm-3 my-4">
                <div class="pd-qty">
                  <button class="qty-btn" type="button" id="qtyMinus">
                    <i class="bi bi-dash"></i>
                  </button>
                  <input
                    id="qtyInput"
                    type="text"
                    class="text-center"
                    value="1"
                    aria-label="Quantity"
                  />
                  <button class="qty-btn" type="button" id="qtyPlus">
                    <i class="bi bi-plus"></i>
                  </button>
                </div>

                <button
                  class="flex-1 btn-gradient d-flex align-items-center justify-content-center text-center gap-2 px-4"
                >
                  ADD TO CART
                  <i class="bi bi-cart"></i>
                </button>

                <button class="btn-gradient-outline px-4">BUY NOW</button>
              </div>

              <div class="flex-between my-4">
                <a href="#" class="add-wishlist">
                  <i class="bi bi-heart"></i> Add to Wishlist
                </a>

                <div class="flex-center gap-3">
                  <label class="share-product">Share product:</label>
                  <div class="flex-between gap-2">
                    <img src="{{ asset('front-assets/img/Copy.svg') }}" alt="" />
                    <img src="{{ asset('front-assets/img/facebook.svg') }}" alt="" />
                    <img src="{{ asset('front-assets/img/Twitter.svg') }}" alt="" />
                    <img src="{{ asset('front-assets/img/Pinterest.svg') }}" alt="" />
                  </div>
                </div>
              </div>

              <div class="safe-checkout-card mt-3">
                <p class="mb-2">100% Guarantee Safe Checkout</p>
                <div class="d-flex gap-2 flex-wrap">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg"
                    alt="Visa"
                    height="28"
                  />
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/b/b7/Mastercard_2019_logo.svg"
                    alt="Mastercard"
                    height="28"
                  />
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Paypal_2014_logo.png"
                    alt="PayPal"
                    height="28"
                  />
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Apple_Pay_logo.svg"
                    alt="Apple Pay"
                    height="28"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End:: Product Detail -->

    <!-- Begin:: shipping_information -->
    <section class="shipping_information container my-5">
      <ul
        class="flex-stack nav nav-tabs border-0 mb-4 pt-3"
        id="descTab"
        role="tablist"
      >
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="desc-tab"
            data-bs-toggle="tab"
            data-bs-target="#descPane"
            type="button"
            role="tab"
            aria-controls="descPane"
            aria-selected="true"
          >
            DESCRIPTION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="info-tab"
            data-bs-toggle="tab"
            data-bs-target="#infoPane"
            type="button"
            role="tab"
            aria-controls="infoPane"
            aria-selected="false"
          >
            ADDITIONAL INFORMATION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="spec-tab"
            data-bs-toggle="tab"
            data-bs-target="#specPane"
            type="button"
            role="tab"
            aria-controls="specPane"
            aria-selected="false"
          >
            SPECIFICATION
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="review-tab"
            data-bs-toggle="tab"
            data-bs-target="#reviewPane"
            type="button"
            role="tab"
            aria-controls="reviewPane"
            aria-selected="false"
          >
            REVIEW
          </button>
        </li>
      </ul>
      <div class="tab-content bg-white p-4 rounded-3">
        <div
          class="tab-pane fade show active"
          id="descPane"
          role="tabpanel"
          aria-labelledby="desc-tab"
        >
          <div class="row g-4 align-items-start">
            <div class="col-md-6 col-lg-5">
              <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                Description
              </h6>
              <p class="mb-3 fw-400 fs-14 text-muted-custom">
                The most powerful MacBook Pro ever is here. With the
                blazing-fast M1 Pro or M1 Max chipâ€”the first Apple silicon
                designed for prosâ€”you get groundbreaking performance and amazing
                battery life. Add stunning Liquid Retina XDR display, best
                camera and audio ever in a Mac, and all the ports you need. The
                first notebook of its kind, this MacBook Pro is a beast. M1 Pro
                takes the exceptional performance of the M1 architecture to a
                whole new level for pro users.
              </p>
              <p class="mb-2 fw-400 fs-14 text-muted-custom">
                Even the most ambitious projects are easily handled with up to
                10 CPU cores, up to 16 GPU cores, a 16-core Neural Engine, and
                dedicated encode and decode media engines that support H.264,
                HEVC, and ProRes codecs.
              </p>
            </div>
            <div class="col-md-3 col-lg-4 border-start">
              <div class="ps-md-4">
                <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                  Feature
                </h6>
                <ul class="list-unstyled mb-0">
                  <li
                    class="mb-2 d-flex align-items-center gap-2 text-heading fs-14 fw-400"
                  >
                    <i class="bi bi-award fs-5 text-primary-custom"></i>Free 1
                    Year Warranty
                  </li>
                  <li
                    class="mb-2 d-flex align-items-center gap-2 text-heading fs-14 fw-400"
                  >
                    <i class="bi bi-truck fs-5 text-primary-custom"></i>Free
                    Shipping &amp; Fasted Delivery
                  </li>
                  <li
                    class="mb-2 d-flex align-items-center gap-2 text-heading fs-14 fw-400"
                  >
                    <i class="bi bi-shield-check fs-5 text-primary-custom"></i
                    >100% Money-back guarantee
                  </li>
                  <li
                    class="mb-2 d-flex align-items-center gap-2 text-heading fs-14 fw-400"
                  >
                    <i class="bi bi-headset fs-5 text-primary-custom"></i>24/7
                    Customer support
                  </li>
                  <li
                    class="d-flex align-items-center gap-2 text-heading fs-14 fw-400"
                  >
                    <i class="bi bi-lock fs-5 text-primary-custom"></i>Secure
                    payment method
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 border-start">
              <div class="ps-md-4">
                <h6 class="font-sans fw-600 text-heading fs-16 mb-3">
                  Shipping Information
                </h6>
                <ul class="list-unstyled mb-0 text-muted small">
                  <li class="text-muted-custom fs-14 fw-400 mb-3">
                    <span class="fw-500 text-heading fs-14">Courier:</span> 2-4
                    days, free shipping
                  </li>
                  <li class="text-muted-custom fs-14 fw-400 mb-3">
                    <span class="fw-500 text-heading fs-14"
                      >Local Shipping:</span
                    >
                    up to one week, $19.00
                  </li>
                  <li class="text-muted-custom fs-14 fw-400 mb-3">
                    <span class="fw-500 text-heading fs-14"
                      >UPS Ground Shipping:</span
                    >
                    4-6 days, $29.00
                  </li>
                  <li class="text-muted-custom fs-14 fw-400">
                    <span class="fw-500 text-heading fs-14"
                      >Unishop Global Export:</span
                    >
                    3-4 days, $39.00
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="infoPane"
          role="tabpanel"
          aria-labelledby="info-tab"
        >
          <!-- Placeholder -->
        </div>
        <div
          class="tab-pane fade"
          id="specPane"
          role="tabpanel"
          aria-labelledby="spec-tab"
        >
          <!-- Placeholder -->
        </div>
        <div
          class="tab-pane fade"
          id="reviewPane"
          role="tabpanel"
          aria-labelledby="review-tab"
        >
          <!-- Placeholder -->
        </div>
      </div>
    </section>
    <!-- End:: shipping_information -->

    <section class="container">
      <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1 g-3">
        <div class="col">
          <h2 class="font-sans fw-600 fs-16 text-heading my-3">
            RELATED PRODUCT
          </h2>
          <div class="row row-cols-1">
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h2 class="font-sans fw-600 fs-16 text-heading my-3">
            APPLE PRODUCT
          </h2>
          <div class="row row-cols-1">
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <h2 class="font-sans fw-600 fs-16 text-heading my-3">
            FEATURED PRODUCTS
          </h2>
          <div class="row row-cols-1">
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col mb-3">
              <div>
                <div class="product-card-s1">
                  <div class="d-flex align-items-start gap-3">
                    <img
                      class="product-img"
                      src="{{ asset('front-assets/img/phone-1.svg') }}"
                      alt="Product image"
                    />

                    <div class="flex-grow-1">
                      <h6 class="product-title-s1">
                        Bose Sport Earbuds - Wireless Earphones - Bluetooth In
                        Ear Headphones for Workouts and Running
                      </h6>

                      <div class="prdoduct-price-s1">$1,500</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap Bundle -->
    <script>
      (function () {
        const mainImg = document.getElementById("pdMainImg");
        const thumbs = Array.from(document.querySelectorAll(".pd-thumb"));
        const prevBtn = document.querySelector('.pd-nav[data-dir="prev"]');
        const nextBtn = document.querySelector('.pd-nav[data-dir="next"]');

        function getActiveIndex() {
          return Math.max(
            0,
            thumbs.findIndex((el) => el.classList.contains("active"))
          );
        }

        function setActive(index) {
          const boundedIndex = (index + thumbs.length) % thumbs.length;
          thumbs.forEach((x) => x.classList.remove("active"));
          const target = thumbs[boundedIndex];
          target.classList.add("active");
          mainImg.src = target.src;
          target.scrollIntoView({
            behavior: "smooth",
            inline: "center",
            block: "nearest",
          });
        }

        thumbs.forEach((t, i) => {
          t.addEventListener("click", () => setActive(i));
        });

        if (prevBtn)
          prevBtn.addEventListener("click", () =>
            setActive(getActiveIndex() - 1)
          );
        if (nextBtn)
          nextBtn.addEventListener("click", () =>
            setActive(getActiveIndex() + 1)
          );

        const qtyInput = document.getElementById("qtyInput");
        document.getElementById("qtyMinus").addEventListener("click", () => {
          const v = Math.max(1, parseInt(qtyInput.value || "1", 10) - 1);
          qtyInput.value = v;
        });
        document.getElementById("qtyPlus").addEventListener("click", () => {
          const v = Math.min(99, parseInt(qtyInput.value || "1", 10) + 1);
          qtyInput.value = v;
        });
      })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


@endsection
