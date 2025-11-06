<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />
    <!-- Satoshi Variable Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
      rel="stylesheet"
    />
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    />
    <!-- Bootstrap 5 -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="{{ asset('front-assets/css/style.css') }}" />
    @stack('styles')
    <title>@yield('title', 'Mobile Repair')</title>
</head>
<body>
    <!-- Header Section Start -->
    <header class="header-section">
      <!-- Top Row -->
      <div class="header-top d-none d-md-block">
        <div class="container">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <div class="social-icons d-flex align-items-center gap-3">
                @if($settings->facebook_url ?? false)
                  <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/facebook.svg') }}" alt="Facebook" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/facebook.svg') }}" alt="Facebook" style="width: 28px; height: 28px;"></a>
                @endif
                
                @if($settings->instagram_url ?? false)
                  <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/instagram.svg') }}" alt="Instagram" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/instagram.svg') }}" alt="Instagram" style="width: 28px; height: 28px;"></a>
                @endif
                
                @if($settings->tiktok_url ?? false)
                  <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/tiktok.svg') }}" alt="TikTok" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/tiktok.svg') }}" alt="TikTok" style="width: 28px; height: 28px;"></a>
                @endif
                
                @if($settings->youtube_url ?? false)
                  <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/youtube.svg') }}" alt="YouTube" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/youtube.svg') }}" alt="YouTube" style="width: 28px; height: 28px;"></a>
                @endif
              </div>
            </div>
            <div>
              <div class="d-flex align-items-center justify-content-end gap-3">
                <button class="btn-promo">Promo!</button>
                <span class="text-muted-custom fs-12 fw-400 font-satoshi">Special Offer: 20% Off First-Time Repairs at
                  HarrowMobiles</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Divider Line -->
      <hr class="header-divider">

      <!-- Bottom Row -->
      <div class="header-bottom">
        <div class="container">
          <div class="flex-between">
            <div class="flex-center gap-2">
              <!-- Hamburger Button (visible on mobile) -->
              <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
                <i class="bi bi-list fs-4"></i>
              </button>
              @if($settings->website_logo ?? false)
                <a href="{{ route('home') }}" class="d-inline-block">
                  <img src="{{ asset('storage/' . $settings->website_logo) }}" alt="{{ $settings->website_name ?? 'Logo' }}" style="max-height: 40px; max-width: 150px;">
                </a>
              @else
                <h6 class="mb-0">{{ $settings->website_name ?? 'Mobile Repair' }}</h6>
              @endif
            </div>

            <!-- Normal nav for lg and up -->
            <div class="d-none d-lg-block">
              <nav class="main-nav">
                <a href="{{ route('frontend.about') }}" class="nav-link">About Us</a>
                <span class="nav-separator">&gt;</span>
                <a href="{{ route('frontend.service') }}" class="nav-link">Our Services</a>
                <span class="nav-separator">&gt;</span>
                <a href="{{ route('frontend.marketplace') }}" class="nav-link">Marketplace</a>
                <span class="nav-separator">&gt;</span>
                <a href="{{ route('frontend.join') }}" class="nav-link">Join Us</a>
              </nav>
            </div>

            <div class="flex-center gap-3">
              <div class="cart-icon">
                <img src="{{ asset('front-assets/img/cart.svg') }}" alt="">
              </div>
              <a href="{{ route('frontend.contact') }}" class="btn-gradient">Contact Us</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Offcanvas Drawer -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
        <div class="offcanvas-header">
          @if($settings->website_logo ?? false)
            <img src="{{ asset('storage/' . $settings->website_logo) }}" alt="{{ $settings->website_name ?? 'Logo' }}" style="max-height: 30px; max-width: 120px;">
          @else
            <h5 class="offcanvas-title" id="mobileMenuLabel">{{ $settings->website_name ?? 'Mobile Repair' }}</h5>
          @endif
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <nav class="main-nav d-flex flex-column gap-3 h-100">
            <a href="{{ route('frontend.about') }}" class="nav-link">About Us</a>
            <a href="{{ route('frontend.service') }}" class="nav-link">Our Services</a>
            <a href="{{ route('frontend.marketplace') }}" class="nav-link">Marketplace</a>
            <a href="{{ route('frontend.join') }}" class="nav-link">Join Us</a>
            <div class="mt-auto">
              <hr>
              <a href="{{ route('frontend.contact') }}" class="btn-gradient w-100 text-center">Contact Us</a>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- Header Section End -->

    <!-- Main Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer class="footer pt-5 pb-4">
      <div class="container">
        <div class="row g-4">
          <!-- Left: Logo + Socials -->
          <div class="col-lg-3 left-divider">
            <div class="d-flex flex-column align-items-center gap-3">
              @if($settings->website_logo ?? false)
                <a href="{{ route('home') }}" class="d-inline-block">
                  <img src="{{ asset('storage/' . $settings->website_logo) }}" alt="{{ $settings->website_name ?? 'Logo' }}" style="max-height: 60px; max-width: 200px;">
                </a>
              @else
                <div class="logo-box"></div>
              @endif
              <div class="social-icons d-flex align-items-center gap-3">
                @if($settings->facebook_url ?? false)
                  <a href="{{ $settings->facebook_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/facebook.svg') }}" alt="Facebook" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/facebook.svg') }}" alt="Facebook" style="width: 28px; height: 28px;"></a>
                @endif
                
                @if($settings->instagram_url ?? false)
                  <a href="{{ $settings->instagram_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/instagram.svg') }}" alt="Instagram" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/instagram.svg') }}" alt="Instagram" style="width: 28px; height: 28px;"></a>
                @endif
                
                @if($settings->tiktok_url ?? false)
                  <a href="{{ $settings->tiktok_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/tiktok.svg') }}" alt="TikTok" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/tiktok.svg') }}" alt="TikTok" style="width: 28px; height: 28px;"></a>
                @endif
                
                @if($settings->youtube_url ?? false)
                  <a href="{{ $settings->youtube_url }}" target="_blank" rel="noopener noreferrer" class="social-icon"><img src="{{ asset('front-assets/img/youtube.svg') }}" alt="YouTube" style="width: 28px; height: 28px;"></a>
                @else
                  <a href="#" class="social-icon"><img src="{{ asset('front-assets/img/youtube.svg') }}" alt="YouTube" style="width: 28px; height: 28px;"></a>
                @endif
              </div>
            </div>
          </div>

          <!-- Company -->
          <div class="col-6 col-md-4 col-lg-3 ps-5">
            <h5 class="title mb-3">Company</h5>
            <nav class="nav flex-column">
              <a class="nav-link" href="{{ route('home') }}">Home</a>
              <a class="nav-link" href="{{ route('frontend.about') }}">About Us</a>
              <a class="nav-link" href="#">Careers</a>
            </nav>
          </div>

          <!-- Services -->
          <div class="col-6 col-md-4 col-lg-3">
            <h5 class="title mb-3">Our Services</h5>
            <nav class="nav flex-column">
              <a class="nav-link" href="#">Phone Repairs</a>
              <a class="nav-link" href="#">Laptop Repairs</a>
              <a class="nav-link" href="#">Tablet Repairs</a>
              <a class="nav-link" href="#">Console Repairs</a>
              <a class="nav-link" href="#">Camera Fix</a>
              <a class="nav-link" href="#">Software Optimization</a>
            </nav>
          </div>

          <!-- Newsletter -->
          <div class="col-md-8 col-lg-3">
            <h5 class="title mb-3">Newsletter</h5>
            <p class="fs-18 fw-400 mb-3">
              Signup our newsletter to get update information, news, insight or
              promotions.
            </p>

            <div class="row g-2 my-3">
              <div class="col-6">
                <input type="text" class="custom-input" placeholder="Name">
              </div>
              <div class="col-6">
                <input type="email" class="custom-input" placeholder="Email">
              </div>
              <div class="col-12">
                <button class="btn-gradient rounded w-100">
                  Subscribe to Newsletter
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- bottom line -->
        <hr class="mt-5 mb-3">
        <div class="d-flex justify-content-end">
          <small class="text-muted">@2025 Copyright Reserved</small>
        </div>
      </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

