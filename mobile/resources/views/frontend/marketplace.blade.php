@extends('frontend.layouts.app')

@section('title', 'Marketplace')

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
            <li class="breadcrumb-item"><a href="{{ route('frontend.marketplace') }}">Marketplace</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              Electronics Devices
            </li>
          </ol>
        </nav>
      </div>
    </section>
    <!-- End:: marketplace-navigation  -->

    <!-- ðŸ”¹ Market Place Main Layout -->
    <section class="marketplace-main-layout">
      <div class="container py-3">
        <!-- Toolbar Row (Search, Sort, etc.) -->
        <div
          class="d-flex flex-wrap align-items-center justify-content-between mb-3"
        >
          <div>
            <button
              class="btn btn-light d-lg-none"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasFilters"
            >
              <i class="bi bi-sliders"></i> Filters
            </button>
          </div>
          <div class="sort-section flex-center gap-3 d-sm-none">
            <div class="dropdown">
              <button
                class="btn dropdown-toggle sortby-btn"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Most Popular
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Mobiles</a></li>
                <li><a class="dropdown-item" href="#">Laptops</a></li>
                <li><a class="dropdown-item" href="#">Accessories</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- ðŸ”¹ Content Layout -->
        <div class="row g-3">
          <!-- Sidebar (lg+) -->
          <aside class="col-lg-3 d-none d-lg-block">
            <h3 class="sidebar-heading">Category</h3>
            <form class="filter-options mt-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat1"
                />
                <label class="form-check-label" for="cat1"
                  >Computer &amp; Laptop</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat2"
                />
                <label class="form-check-label" for="cat2"
                  >Computer Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat3"
                />
                <label class="form-check-label" for="cat3">SmartPhone</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat4"
                />
                <label class="form-check-label" for="cat4">Headphone</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat5"
                />
                <label class="form-check-label" for="cat5"
                  >Mobile Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat6"
                />
                <label class="form-check-label" for="cat6"
                  >Gaming Console</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat7"
                />
                <label class="form-check-label" for="cat7"
                  >Camera &amp; Photo</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat8"
                />
                <label class="form-check-label" for="cat8"
                  >TV &amp; Homes Appliances</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat9"
                />
                <label class="form-check-label" for="cat9"
                  >Watches &amp; Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat10"
                />
                <label class="form-check-label" for="cat10"
                  >GPS &amp; Navigation</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat11"
                />
                <label class="form-check-label" for="cat11"
                  >Wearable Technology</label
                >
              </div>
            </form>
            <hr />
            <h3 class="sidebar-heading">Price Range</h3>
            <!-- Slider -->

            <div class="double_range_slider">
              <span class="range_track" id="range_track"></span>

              <input
                type="range"
                class="min_range"
                min="0"
                max="10000"
                value="3000"
                step="1"
              />
              <input
                type="range"
                class="max_range"
                min="0"
                max="10000"
                value="7000"
                step="1"
              />
            </div>

            <div class="flex-center gap-3">
              <input
                type="text"
                id="minInput"
                placeholder="Min price"
                class="custom-range-input"
              />
              <input
                type="text"
                id="maxInput"
                placeholder="Max price"
                class="custom-range-input"
              />
            </div>

            <form class="filter-options mt-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price1"
                />
                <label class="form-check-label" for="price1"> All Price </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price2"
                />
                <label class="form-check-label" for="price2"> Under $20 </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price3"
                />
                <label class="form-check-label" for="price3">
                  $25 to $100
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price4"
                />
                <label class="form-check-label" for="price4">
                  $100 to $300
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price5"
                />
                <label class="form-check-label" for="price5">
                  $300 to $500
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price6"
                />
                <label class="form-check-label" for="price6">
                  $500 to $1,000
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price7"
                />
                <label class="form-check-label" for="price7">
                  $1,000 to $10,000
                </label>
              </div>
            </form>
            <hr />
            <div class="brand-filter">
              <h3 class="sidebar-heading">popular Brands</h3>
              <div class="row g-2 mt-3">
                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="apple"
                      checked
                    />
                    <label class="form-check-label" for="apple">Apple</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="microsoft"
                      checked
                    />
                    <label class="form-check-label" for="microsoft"
                      >Microsoft</label
                    >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dell" />
                    <label class="form-check-label" for="dell">Dell</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="symphony"
                    />
                    <label class="form-check-label" for="symphony"
                      >Symphony</label
                    >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sony" />
                    <label class="form-check-label" for="sony">Sony</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="lg"
                      checked
                    />
                    <label class="form-check-label" for="lg">LG</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="oneplus"
                    />
                    <label class="form-check-label" for="oneplus"
                      >One Plus</label
                    >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="google"
                      checked
                    />
                    <label class="form-check-label" for="google">Google</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="samsung"
                    />
                    <label class="form-check-label" for="samsung"
                      >Samsung</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="hp"
                      checked
                    />
                    <label class="form-check-label" for="hp">HP</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="xiaomi"
                    />
                    <label class="form-check-label" for="xiaomi">Xiaomi</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="panasonic"
                      checked
                    />
                    <label class="form-check-label" for="panasonic"
                      >Panasonic</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="intel"
                    />
                    <label class="form-check-label" for="intel">Intel</label>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="popular-tags mt-4">
              <h6 class="fw-bold mb-3">POPULAR TAG</h6>
              <div class="d-flex flex-wrap gap-2">
                <button class="tag-btn">Game</button>
                <button class="tag-btn">iPhone</button>
                <button class="tag-btn">TV</button>
                <button class="tag-btn">Asus Laptops</button>
                <button class="tag-btn">Macbook</button>
                <button class="tag-btn">SSD</button>
                <button class="tag-btn active">Graphics Card</button>
                <button class="tag-btn">Power Bank</button>
                <button class="tag-btn">Smart TV</button>
                <button class="tag-btn">Speaker</button>
                <button class="tag-btn">Tablet</button>
                <button class="tag-btn">Microwave</button>
                <button class="tag-btn">Samsung</button>
              </div>
            </div>
            <div class="side-product-card text-center p-4 mt-3">
              <img
                src="{{ asset('front-assets/img/watch-collection.svg') }}"
                alt="Apple Watch"
                class="img-fluid mb-3"
              />

              <img
                src="{{ asset('front-assets/img/apple-watch-7.svg') }}"
                alt="Apple Logo"
                class="apple-logo"
              />

              <h6 class="product-subtitle mb-3">
                Heavy on Features. <br />
                Light on Price.
              </h6>

              <p class="price-text mb-4">
                Only for: <span class="price-tag">$299 USD</span>
              </p>

              <div class="d-grid gap-2">
                <button class="add-cart-btn">
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M3.125 10H16.875"
                      stroke="#5B265D"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M11.25 4.375L16.875 10L11.25 15.625"
                      stroke="#5B265D"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  ADD TO CART
                </button>

                <button class="view-details-btn">
                  VIEW DETAILS <i class="bi bi-arrow-right"></i>
                </button>
              </div>
            </div>
          </aside>

          <!-- Main Content -->
          <main class="col-lg-9">
            <div class="h-100">
              <header class="flex-between">
                <div class="search w-100 w-sm-50">
                  <input type="text" placeholder="Search for anything..." />
                  <i class="bi bi-search"></i>
                </div>
                <div class="sort-section flex-center gap-3 d-none d-sm-flex">
                  <label for="">Sort by:</label>
                  <div class="dropdown">
                    <button
                      class="btn dropdown-toggle sortby-btn"
                      type="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      Most Popular
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Mobiles</a></li>
                      <li><a class="dropdown-item" href="#">Laptops</a></li>
                      <li><a class="dropdown-item" href="#">Accessories</a></li>
                    </ul>
                  </div>
                </div>
              </header>
              <!-- Begin::filter section  -->
              <section class="filter-section my-3">
                <div
                  class="d-flex align-items-center justify-content-between py-2"
                >
                  <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="text-secondary me-1 fs-14 fw-400"
                      >Active Filters:</span
                    >

                    <span class="d-inline-flex align-items-center fs-14 fw-400">
                      Electronics Devices
                      <button
                        type="button"
                        class="btn-close ms-2"
                        aria-label="Remove"
                      ></button>
                    </span>

                    <span class="d-inline-flex align-items-center fs-14 fw-400">
                      5 Star Rating
                      <button
                        type="button"
                        class="btn-close ms-2"
                        aria-label="Remove"
                      ></button>
                    </span>
                  </div>

                  <div class="text-heading fs-14 fw-400">
                    <span class="fw-600 text-dark">65,867</span> Results found.
                  </div>
                </div>
              </section>
              <!-- End::filter section  -->

              <div
                class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1 g-3"
                id="productGrid"
              >
                <!-- Static Product Cards -->
                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <span class="product-badge badge-danger">HOT</span>
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-1.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(738)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">TOZO T6 True Wireless Earbuds Bluetooth Headphones</p>
                      <div class="product-price text-promo">$70</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-2.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(512)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">Noise Cancelling Bluetooth Headphones</p>
                      <div class="product-price text-promo">$55</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <span class="product-badge badge-danger">BEST DEALS</span>
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-3.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(738)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">TOZO T6 True Wireless Earbuds Bluetooth Headphones</p>
                      <div class="product-price text-promo">$70</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-4.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </span>
                        <span class="rating-count">(432)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">High Bass Bluetooth Earphones</p>
                      <div class="product-price text-promo">$65</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <span class="product-badge badge-danger">HOT</span>
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-1.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(738)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">TOZO T6 True Wireless Earbuds Bluetooth Headphones</p>
                      <div class="product-price text-promo">$70</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-2.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(512)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">Noise Cancelling Bluetooth Headphones</p>
                      <div class="product-price text-promo">$55</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <span class="product-badge badge-danger">BEST DEALS</span>
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-3.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(738)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">TOZO T6 True Wireless Earbuds Bluetooth Headphones</p>
                      <div class="product-price text-promo">$70</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-4.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </span>
                        <span class="rating-count">(432)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">High Bass Bluetooth Earphones</p>
                      <div class="product-price text-promo">$65</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <span class="product-badge badge-danger">HOT</span>
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-1.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(738)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">TOZO T6 True Wireless Earbuds Bluetooth Headphones</p>
                      <div class="product-price text-promo">$70</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-2.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(512)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">Noise Cancelling Bluetooth Headphones</p>
                      <div class="product-price text-promo">$55</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <span class="product-badge badge-danger">BEST DEALS</span>
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-3.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </span>
                        <span class="rating-count">(738)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">TOZO T6 True Wireless Earbuds Bluetooth Headphones</p>
                      <div class="product-price text-promo">$70</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="product-card h-100 position-relative">
                    <div class="card-body">
                      <div class="ratio ratio-1x1 thumb">
                        <img src="{{ asset('front-assets/img/phone-4.svg') }}" alt="img" class="w-100 h-100 p-2 rounded" />
                        <div class="product-actions">
                          <div class="action-btn"><i class="bi bi-heart"></i></div>
                          <div class="action-btn"><i class="bi bi-cart"></i></div>
                          <div class="action-btn"><i class="bi bi-eye"></i></div>
                        </div>
                      </div>
                      <div class="rating mt-3 d-flex align-items-center">
                        <span class="text-primary-custom">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </span>
                        <span class="rating-count">(432)</span>
                      </div>
                      <p class="product-title mt-2 mb-0">High Bass Bluetooth Earphones</p>
                      <div class="product-price text-promo">$65</div>
                    </div>
                  </div>
                </div>
              </div>
              <nav
                class="pagination-nav d-flex justify-content-center mt-5"
                aria-label="Page navigation"
              >
                <ul class="pagination custom-pagination">
                  <li class="page-item">
                    <a
                      class="page-link previous-button"
                      href="#"
                      aria-label="Previous"
                    >
                      <i class="bi bi-arrow-left"></i>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">01</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">02</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">03</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">04</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">05</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">06</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link next-button" href="#" aria-label="Next">
                      <i class="bi bi-arrow-right"></i>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </main>
        </div>
      </div>

      <!-- ðŸ”¹ Offcanvas Sidebar (md and below) -->
      <div
        class="offcanvas offcanvas-start"
        tabindex="-1"
        id="offcanvasFilters"
      >
        <div class="offcanvas-header">
          <h5 class="mb-0">Filters</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="offcanvas"
          ></button>
        </div>
        <div class="offcanvas-body">
          <aside class="">
            <h3 class="sidebar-heading">Category</h3>
            <form class="filter-options mt-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat1"
                />
                <label class="form-check-label" for="cat1"
                  >Computer &amp; Laptop</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat2"
                />
                <label class="form-check-label" for="cat2"
                  >Computer Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat3"
                />
                <label class="form-check-label" for="cat3">SmartPhone</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat4"
                />
                <label class="form-check-label" for="cat4">Headphone</label>
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat5"
                />
                <label class="form-check-label" for="cat5"
                  >Mobile Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat6"
                />
                <label class="form-check-label" for="cat6"
                  >Gaming Console</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat7"
                />
                <label class="form-check-label" for="cat7"
                  >Camera &amp; Photo</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat8"
                />
                <label class="form-check-label" for="cat8"
                  >TV &amp; Homes Appliances</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat9"
                />
                <label class="form-check-label" for="cat9"
                  >Watches &amp; Accessories</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat10"
                />
                <label class="form-check-label" for="cat10"
                  >GPS &amp; Navigation</label
                >
              </div>
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="category"
                  id="cat11"
                />
                <label class="form-check-label" for="cat11"
                  >Wearable Technology</label
                >
              </div>
            </form>
            <hr />
            <h3 class="sidebar-heading">Price Range</h3>
            <!-- Slider -->

            <div class="double_range_slider">
              <span class="range_track" id="range_track"></span>

              <input
                type="range"
                class="min_range"
                min="0"
                max="10000"
                value="3000"
                step="1"
              />
              <input
                type="range"
                class="max_range"
                min="0"
                max="10000"
                value="7000"
                step="1"
              />
            </div>

            <div class="flex-center gap-3">
              <input
                type="text"
                id="minInput"
                placeholder="Min price"
                class="custom-range-input"
              />
              <input
                type="text"
                id="maxInput"
                placeholder="Max price"
                class="custom-range-input"
              />
            </div>

            <form class="filter-options mt-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price1"
                />
                <label class="form-check-label" for="price1"> All Price </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price2"
                />
                <label class="form-check-label" for="price2"> Under $20 </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price3"
                />
                <label class="form-check-label" for="price3">
                  $25 to $100
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price4"
                />
                <label class="form-check-label" for="price4">
                  $100 to $300
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price5"
                />
                <label class="form-check-label" for="price5">
                  $300 to $500
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price6"
                />
                <label class="form-check-label" for="price6">
                  $500 to $1,000
                </label>
              </div>

              <div class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  name="price"
                  id="price7"
                />
                <label class="form-check-label" for="price7">
                  $1,000 to $10,000
                </label>
              </div>
            </form>
            <hr />
            <div class="brand-filter">
              <h3 class="sidebar-heading">popular Brands</h3>
              <div class="row g-2 mt-3">
                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="apple"
                      checked
                    />
                    <label class="form-check-label" for="apple">Apple</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="microsoft"
                      checked
                    />
                    <label class="form-check-label" for="microsoft"
                      >Microsoft</label
                    >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dell" />
                    <label class="form-check-label" for="dell">Dell</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="symphony"
                    />
                    <label class="form-check-label" for="symphony"
                      >Symphony</label
                    >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sony" />
                    <label class="form-check-label" for="sony">Sony</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="lg"
                      checked
                    />
                    <label class="form-check-label" for="lg">LG</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="oneplus"
                    />
                    <label class="form-check-label" for="oneplus"
                      >One Plus</label
                    >
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="google"
                      checked
                    />
                    <label class="form-check-label" for="google">Google</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="samsung"
                    />
                    <label class="form-check-label" for="samsung"
                      >Samsung</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="hp"
                      checked
                    />
                    <label class="form-check-label" for="hp">HP</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="xiaomi"
                    />
                    <label class="form-check-label" for="xiaomi">Xiaomi</label>
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="panasonic"
                      checked
                    />
                    <label class="form-check-label" for="panasonic"
                      >Panasonic</label
                    >
                  </div>
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      id="intel"
                    />
                    <label class="form-check-label" for="intel">Intel</label>
                  </div>
                </div>
              </div>
            </div>
            <hr />
            <div class="popular-tags mt-4">
              <h6 class="fw-bold mb-3">POPULAR TAG</h6>
              <div class="d-flex flex-wrap gap-2">
                <button class="tag-btn">Game</button>
                <button class="tag-btn">iPhone</button>
                <button class="tag-btn">TV</button>
                <button class="tag-btn">Asus Laptops</button>
                <button class="tag-btn">Macbook</button>
                <button class="tag-btn">SSD</button>
                <button class="tag-btn active">Graphics Card</button>
                <button class="tag-btn">Power Bank</button>
                <button class="tag-btn">Smart TV</button>
                <button class="tag-btn">Speaker</button>
                <button class="tag-btn">Tablet</button>
                <button class="tag-btn">Microwave</button>
                <button class="tag-btn">Samsung</button>
              </div>
            </div>
            <div class="side-product-card text-center p-4 mt-3">
              <img
                src="{{ asset('front-assets/img/watch-collection.svg') }}"
                alt="Apple Watch"
                class="img-fluid mb-3"
              />

              <img
                src="{{ asset('front-assets/img/apple-watch-7.svg') }}"
                alt="Apple Logo"
                class="apple-logo"
              />

              <h6 class="product-subtitle mb-3">
                Heavy on Features. <br />
                Light on Price.
              </h6>

              <p class="price-text mb-4">
                Only for: <span class="price-tag">$299 USD</span>
              </p>

              <div class="d-grid gap-2">
                <button class="add-cart-btn">
                  <svg
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M3.125 10H16.875"
                      stroke="#5B265D"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M11.25 4.375L16.875 10L11.25 15.625"
                      stroke="#5B265D"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                  ADD TO CART
                </button>

                <button class="view-details-btn">
                  VIEW DETAILS <i class="bi bi-arrow-right"></i>
                </button>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    


@endsection

