@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

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
            <li class="breadcrumb-item active" aria-current="page">
              Shopping Card
            </li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <section class="container my-5">
      <div class="row">
        <div class="col-lg-8">
          <div class="product-table">
            <div class="bg-white px-4 pb-2">
              <h5 class="mb-3 fw-500 fs-18">Shopping Card</h5>
            </div>

            <div class="table-responsive">
              <table class="table align-middle mb-0 text-center">
                <thead>
                  <tr>
                    <th scope="col" class="text-start ps-4">PRODUCTS</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub-Total</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Product Row -->
                  <tr>
                    <td>
                      <div class="flex-center gap-1">
                        <button class="btn btn-link text-muted p-0">
                          <i class="bi bi-x-circle fs-5"></i>
                        </button>
                        <img
                          src="{{ asset('front-assets/img/wishlist-table-1.svg') }}"
                          alt=""
                          class="product-img"
                        />
                        <p class="text-start mb-0">
                          4K UHD LED Smart TV with Chromecast Built-in
                        </p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <span class="text-decoration-line-through text-muted"
                          >$1299</span
                        >
                        <span class="original-price">$999</span>
                      </div>
                    </td>
                    <td>
                      <div class="product-quantity">
                        <button class="btn-minus">-</button>
                        <span class="quantity-value">01</span>
                        <button class="btn-plus">+</button>
                      </div>
                    </td>

                    <td>$70</td>
                  </tr>
                  <tr>
                    <td>
                      <div class="flex-center gap-1">
                        <button class="btn btn-link text-muted p-0">
                          <i class="bi bi-x-circle fs-5"></i>
                        </button>
                        <img
                          src="{{ asset('front-assets/img/wishlist-table-2.svg') }}"
                          alt=""
                          class="product-img"
                        />
                        <p class="text-start mb-0">
                          4K UHD LED Smart TV with Chromecast Built-in
                        </p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <span class="text-decoration-line-through text-muted"
                          >$1299</span
                        >
                        <span class="original-price">$999</span>
                      </div>
                    </td>
                    <td>
                      <div class="product-quantity">
                        <button class="btn-minus">-</button>
                        <span class="quantity-value">01</span>
                        <button class="btn-plus">+</button>
                      </div>
                    </td>
                    <td>$70</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr />
            <div class="flex-between px-3">
              <a href="{{ route('frontend.marketplace') }}" class="btn-gradient-outline text-promo border-promo py-3 fw-600 text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i> Return to Shop
              </a>
              <button
                class="btn-gradient-outline text-promo border-promo py-3 fw-600"
              >
                Update cart
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card-summary">
            <div class="card-total">
              <h5 class="fw-500 fs-18 mb-3">Card Totals</h5>

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

              <a href="{{ route('frontend.checkout') }}" class="btn btn-gradient w-100 text-decoration-none">
                PROCEED TO CHECKOUT <i class="bi bi-arrow-right ms-2"></i>
              </a>
            </div>

            <div class="coupon-box mt-4">
              <h5 class="text-heading fw-500 fs-18 mb-3">Coupon Code</h5>
              <div class="coupon-form">
                <input
                  type="email"
                  class="form-control mb-3"
                  placeholder="Email address"
                />
                <button class="btn btn-danger w-100">APPLY COUPON</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      document.querySelectorAll(".product-quantity").forEach((qty) => {
        const valueEl = qty.querySelector(".quantity-value");
        const plusBtn = qty.querySelector(".btn-plus");
        const minusBtn = qty.querySelector(".btn-minus");

        plusBtn.addEventListener("click", () => {
          let value = parseInt(valueEl.textContent);
          if (value < 99)
            valueEl.textContent = (value + 1).toString().padStart(2, "0");
        });

        minusBtn.addEventListener("click", () => {
          let value = parseInt(valueEl.textContent);
          if (value > 1)
            valueEl.textContent = (value - 1).toString().padStart(2, "0");
        });
      });
    </script>

    


@endsection
