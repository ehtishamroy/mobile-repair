@extends('frontend.layouts.app')

@section('title', 'Wishlist')

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
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <section class="container my-5">
      <div class="product-table">
        <div class="bg-white px-4 pb-2">
          <h5 class="mb-0 fw-semibold">Wishlist</h5>
        </div>

        <div class="table-responsive">
          <table class="table align-middle mb-0 text-center">
            <thead class="header">
              <tr>
                <th scope="col" class="text-start ps-4">PRODUCTS</th>
                <th scope="col">PRICE</th>
                <th scope="col">STOCK STATUS</th>
                <th scope="col">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <!-- Product Row -->
              <tr>
                <td>
                  <div class="flex-center gap-1">
                    <img
                      src="{{ asset('front-assets/img/wishlist-table-1.svg') }}"
                      alt=""
                      class="product-img"
                    />
                    <p class="text-start mb-0">
                      Bose Sport Earbuds - Wireless Earphones - Bluetooth In Ear
                      Headphones for Workouts and Running, Triple Black
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
                <td><span class="in-stock">IN STOCK</span></td>
                <td>
                  <div
                    class="d-flex justify-content-center align-items-center gap-3"
                  >
                    <button class="btn-gradient text-nowrap">
                      ADD TO CARD <i class="bi bi-cart ms-2"></i>
                    </button>
                    <button class="btn btn-link text-muted p-0">
                      <i class="bi bi-x-circle fs-5"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-center gap-1">
                    <img
                      src="{{ asset('front-assets/img/wishlist-table-2.svg') }}"
                      alt=""
                      class="product-img"
                    />
                    <p class="text-start mb-0">
                      Simple Mobile 5G LTE Galexy 12 Mini 512GB Gaming Phone
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
                <td><span class="in-stock">IN STOCK</span></td>
                <td>
                  <div
                    class="d-flex justify-content-center align-items-center gap-3"
                  >
                    <button class="btn-gradient text-nowrap">
                      ADD TO CARD <i class="bi bi-cart ms-2"></i>
                    </button>
                    <button class="btn btn-link text-muted p-0">
                      <i class="bi bi-x-circle fs-5"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-center gap-1">
                    <img
                      src="{{ asset('front-assets/img/wishlist-table-3.svg') }}"
                      alt=""
                      class="product-img"
                    />
                    <p class="text-start mb-0">
                      Portable Wshing Machine, 11lbs capacity Model 18NMFIAM
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
                <td><span class="in-stock">IN STOCK</span></td>
                <td>
                  <div
                    class="d-flex justify-content-center align-items-center gap-3"
                  >
                    <button class="btn-gradient text-nowrap">
                      ADD TO CARD <i class="bi bi-cart ms-2"></i>
                    </button>
                    <button class="btn btn-link text-muted p-0">
                      <i class="bi bi-x-circle fs-5"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-center gap-1">
                    <img
                      src="{{ asset('front-assets/img/wishlist-table-4.svg') }}"
                      alt=""
                      class="product-img"
                    />
                    <p class="text-start mb-0">
                      TOZO T6 True Wireless Earbuds Bluetooth Headphones Touch
                      Control with Wireless Charging Case IPX8 Waterproof Stereo
                      Earphones in-Ear
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
                <td><span class="in-stock">IN STOCK</span></td>
                <td>
                  <div
                    class="d-flex justify-content-center align-items-center gap-3"
                  >
                    <button class="btn-gradient text-nowrap">
                      ADD TO CARD <i class="bi bi-cart ms-2"></i>
                    </button>
                    <button class="btn btn-link text-muted p-0">
                      <i class="bi bi-x-circle fs-5"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="flex-center gap-1">
                    <img
                      src="{{ asset('front-assets/img/wishlist-table-5.svg') }}"
                      alt=""
                      class="product-img"
                    />
                    <p class="text-start mb-0">
                      Wyze Cam Pan v2 1080p Pan/Tilt/Zoom Wi-Fi Indoor Smart
                      Home Camera with Color Night Vision, 2-Way Audio
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
                <td><span class="in-stock">IN STOCK</span></td>
                <td>
                  <div
                    class="d-flex justify-content-center align-items-center gap-3"
                  >
                    <button class="btn-gradient text-nowrap">
                      ADD TO CARD <i class="bi bi-cart ms-2"></i>
                    </button>
                    <button class="btn btn-link text-muted p-0">
                      <i class="bi bi-x-circle fs-5"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    


@endsection
