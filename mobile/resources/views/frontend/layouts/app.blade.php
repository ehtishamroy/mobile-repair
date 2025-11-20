<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        // Get site title from settings
        $siteTitle = $settings->meta_title ?? $settings->website_title ?? $settings->website_name ?? 'Harrow Mobiles';
        
        // Default meta description from settings
        $defaultMetaDescription = $settings->meta_description ?? $settings->website_description ?? '';
        
        // Default meta keywords from settings
        $defaultMetaKeywords = $settings->meta_keywords ?? '';
        
        // Default OG image from settings
        $defaultOgImage = null;
        if (!empty($settings->og_image)) {
            $defaultOgImage = asset('storage/' . $settings->og_image);
        } elseif (!empty($settings->website_logo)) {
            $defaultOgImage = asset('storage/' . $settings->website_logo);
        }
    @endphp
    
    @php
        // Build title - check if page has title section
        $pageTitle = '';
        $hasPageTitle = false;
    @endphp
    
    @if(View::hasSection('title'))
        @php
            $pageTitle = trim(View::yieldContent('title'));
            $hasPageTitle = true;
        @endphp
    @endif
    
    @php
        // Build full title - if page title is "Ecommerce" or empty, use site title only
        if ($hasPageTitle && $pageTitle !== 'Ecommerce' && !empty($pageTitle)) {
            $fullTitle = $pageTitle . ' - ' . $siteTitle;
        } else {
            $fullTitle = $siteTitle;
        }
        
        // Get meta description - use page section if exists, otherwise use default
        $metaDescription = $defaultMetaDescription;
        if (View::hasSection('meta_description')) {
            $metaDescription = trim(View::yieldContent('meta_description'));
            if (empty($metaDescription)) {
                $metaDescription = $defaultMetaDescription;
            }
        }
        
        // Get meta keywords - use page section if exists, otherwise use default
        $metaKeywords = $defaultMetaKeywords;
        if (View::hasSection('meta_keywords')) {
            $metaKeywords = trim(View::yieldContent('meta_keywords'));
            if (empty($metaKeywords)) {
                $metaKeywords = $defaultMetaKeywords;
            }
        }
        
        // Get OG image - use page section if exists, otherwise use default
        $ogImage = $defaultOgImage;
        if (View::hasSection('og_image')) {
            $ogImage = trim(View::yieldContent('og_image'));
            if (empty($ogImage)) {
                $ogImage = $defaultOgImage;
            }
        }
    @endphp
    
    <!-- Primary Meta Tags -->
    <title>{{ $fullTitle }}</title>
    @if(!empty($metaDescription))
    <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if(!empty($metaKeywords))
    <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    @if(!empty($metaDescription))
    <meta property="og:description" content="{{ $metaDescription }}">
    @endif
    @if(!empty($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta property="og:site_name" content="{{ $settings->website_name ?? 'Harrow Mobiles' }}">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $fullTitle }}">
    @if(!empty($metaDescription))
    <meta property="twitter:description" content="{{ $metaDescription }}">
    @endif
    @if(!empty($ogImage))
    <meta property="twitter:image" content="{{ $ogImage }}">
    @endif
    <!-- Favicon -->
    @if($settings->favicon ?? false)
    @php
        $faviconPath = asset('storage/' . $settings->favicon);
        $faviconExt = strtolower(pathinfo($settings->favicon, PATHINFO_EXTENSION));
        $faviconType = match($faviconExt) {
            'ico' => 'image/x-icon',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            default => 'image/x-icon',
        };
    @endphp
    <link rel="icon" type="{{ $faviconType }}" href="{{ $faviconPath }}">
    <link rel="shortcut icon" type="{{ $faviconType }}" href="{{ $faviconPath }}">
    <link rel="apple-touch-icon" href="{{ $faviconPath }}">
    @endif
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
    <style>
    /* Cart Bar Styles */
    .cart-bar {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: #fff;
      border-top: 2px solid #5B265D;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1050;
      padding: 1rem 0;
      animation: slideUp 0.3s ease-out;
    }

    @keyframes slideUp {
      from {
        transform: translateY(100%);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .cart-bar-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1.5rem;
      flex-wrap: wrap;
      position: relative;
    }

    .cart-bar-info {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex: 1;
      min-width: 200px;
    }

    .cart-icon-wrapper {
      position: relative;
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #5B265D 0%, #7a3a7d 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 1.5rem;
    }

    .cart-count-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background: #ff4444;
      color: #fff;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 600;
      border: 2px solid #fff;
    }

    .cart-summary {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .cart-items-text {
      font-size: 0.875rem;
      color: #5F6C72;
      font-weight: 400;
    }

    .cart-total-text {
      font-size: 1.25rem;
      color: #5B265D;
      font-weight: 600;
    }

    .cart-bar-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .cart-bar-controls {
      display: flex;
      gap: 0.5rem;
      align-items: center;
    }

    .btn-cart-close,
    .btn-cart-minimize {
      background: transparent;
      border: none;
      color: #5B265D;
      font-size: 1.25rem;
      cursor: pointer;
      padding: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      border-radius: 50%;
      width: 36px;
      height: 36px;
    }

    .btn-cart-close:hover,
    .btn-cart-minimize:hover {
      background: #f0f0f0;
      color: #7a3a7d;
    }

    .btn-view-cart {
      background: #fff;
      color: #5B265D;
      border: 2px solid #5B265D;
      padding: 0.75rem 1.5rem;
      border-radius: 5px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-view-cart:hover {
      background: #5B265D;
      color: #fff;
    }

    .btn-checkout {
      background: linear-gradient(135deg, #5B265D 0%, #7a3a7d 100%);
      color: #fff;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 5px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-checkout:hover {
      background: linear-gradient(135deg, #7a3a7d 0%, #5B265D 100%);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(91, 38, 93, 0.3);
    }

    /* Minimized Cart Bar */
    .cart-bar-minimized {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1050;
      animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.8);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .btn-cart-expand {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #5B265D 0%, #7a3a7d 100%);
      border: none;
      border-radius: 50%;
      color: #fff;
      font-size: 1.5rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      box-shadow: 0 4px 12px rgba(91, 38, 93, 0.3);
      transition: all 0.3s ease;
    }

    .btn-cart-expand:hover {
      transform: scale(1.1);
      box-shadow: 0 6px 16px rgba(91, 38, 93, 0.4);
    }

    .cart-count-badge-mini {
      position: absolute;
      top: -5px;
      right: -5px;
      background: #ff4444;
      color: #fff;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 600;
      border: 2px solid #fff;
    }

    @media (max-width: 768px) {
      .cart-bar {
        padding: 0.75rem 0;
      }
      
      .cart-bar-content {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
      }
      
      .cart-bar-info {
        justify-content: center;
      }
      
      .cart-bar-actions {
        flex-direction: column;
        width: 100%;
      }
      
      .btn-view-cart,
      .btn-checkout {
        width: 100%;
        text-align: center;
      }
      
      .cart-summary {
        text-align: center;
      }
      
      .cart-bar-controls {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
      }
      
      .cart-bar-minimized {
        bottom: 15px;
        right: 15px;
      }
      
      .btn-cart-expand {
        width: 55px;
        height: 55px;
        font-size: 1.25rem;
      }
    }

    @media (max-width: 576px) {
      .cart-icon-wrapper {
        width: 45px;
        height: 45px;
        font-size: 1.25rem;
      }
      
      .cart-total-text {
        font-size: 1.1rem;
      }
      
      .cart-items-text {
        font-size: 0.8rem;
      }
    }
    </style>
    @stack('styles')
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
              @if($settings->promo_title ?? false)
              <div class="d-flex align-items-center justify-content-end gap-3">
                <button class="btn-promo">{{ __('Promo!') }}</button>
                <span class="text-muted-custom fs-12 fw-400 font-satoshi">
                  {{ $settings->promo_title }}
                </span>
              </div>
              @endif
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
                <h6 class="mb-0">{{ $settings->website_name ?? 'Harrow Mobiles' }}</h6>
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
                <a href="{{ route('frontend.track-order') }}" class="nav-link">Track Order</a>
                @if($wishlistCount > 0)
                <span class="nav-separator">&gt;</span>
                <a href="{{ route('frontend.wishlist') }}" class="nav-link">Wishlist</a>
                @endif
                <span class="nav-separator">&gt;</span>
                <a href="{{ route('frontend.join') }}" class="nav-link">Join Us</a>
              </nav>
            </div>

            <div class="flex-center gap-3">
              <a href="{{ route('frontend.cart') }}" class="cart-icon" aria-label="View cart">
                <img src="{{ asset('front-assets/img/cart.svg') }}" alt="">
              </a>
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
            <h5 class="offcanvas-title" id="mobileMenuLabel">{{ $settings->website_name ?? 'Harrow Mobiles' }}</h5>
          @endif
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <nav class="main-nav d-flex flex-column gap-3 h-100">
            <a href="{{ route('frontend.about') }}" class="nav-link">About Us</a>
            <a href="{{ route('frontend.service') }}" class="nav-link">Our Services</a>
            <a href="{{ route('frontend.marketplace') }}" class="nav-link">Marketplace</a>
            <a href="{{ route('frontend.track-order') }}" class="nav-link">Track Order</a>
            @if($wishlistCount > 0)
            <a href="{{ route('frontend.wishlist') }}" class="nav-link">Wishlist</a>
            @endif
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

    <!-- Cart Bar -->
    <div id="cartBar" class="cart-bar" style="display: none;">
      <div class="container">
        <div class="cart-bar-content">
          <div class="cart-bar-info">
            <div class="cart-icon-wrapper">
              <i class="bi bi-cart-fill"></i>
              <span class="cart-count-badge" id="cartCountBadge">0</span>
            </div>
            <div class="cart-summary">
              <span class="cart-items-text" id="cartItemsText">0 items</span>
              <span class="cart-total-text" id="cartTotalText">£0.00</span>
            </div>
          </div>
          <div class="cart-bar-actions">
            <a href="{{ route('frontend.cart') }}" class="btn btn-view-cart">View Cart</a>
            <a href="{{ route('frontend.checkout') }}" class="btn btn-checkout">Checkout</a>
          </div>
          <div class="cart-bar-controls">
            <button class="btn-cart-minimize" id="cartMinimizeBtn" title="Minimize">
              <i class="bi bi-chevron-down"></i>
            </button>
            <button class="btn-cart-close" id="cartCloseBtn" title="Close">
              <i class="bi bi-x"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Cart Bar Minimized (floating button) -->
    <div id="cartBarMinimized" class="cart-bar-minimized" style="display: none;">
      <button class="btn-cart-expand" id="cartExpandBtn" title="Show Cart">
        <i class="bi bi-cart-fill"></i>
        <span class="cart-count-badge-mini" id="cartCountBadgeMini">0</span>
      </button>
    </div>

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
              <a class="nav-link" href="{{ route('frontend.careers') }}">Careers</a>
            </nav>
          </div>

          <!-- Services -->
          <div class="col-6 col-md-4 col-lg-3">
            <h5 class="title mb-3">Our Services</h5>
            <nav class="nav flex-column">
              <a class="nav-link" href="{{ route('frontend.book-repair') }}">Phone Repairs</a>
              <a class="nav-link" href="{{ route('frontend.book-repair') }}">Laptop Repairs</a>
              <a class="nav-link" href="{{ route('frontend.book-repair') }}">Tablet Repairs</a>
              <a class="nav-link" href="{{ route('frontend.book-repair') }}">Console Repairs</a>
              <a class="nav-link" href="{{ route('frontend.book-repair') }}">Camera Fix</a>
              <a class="nav-link" href="{{ route('frontend.book-repair') }}">Software Optimization</a>
            </nav>
          </div>

          <!-- Newsletter -->
          <div class="col-md-8 col-lg-3">
            <h5 class="title mb-3">Newsletter</h5>
            <p class="fs-18 fw-400 mb-3">
              Signup our newsletter to get update information, news, insight or
              promotions.
            </p>

            <form id="newsletter-form" class="row g-2 my-3">
              @csrf
              <div class="col-6">
                <input type="text" name="name" id="newsletter-name" class="custom-input" placeholder="Name">
              </div>
              <div class="col-6">
                <input type="email" name="email" id="newsletter-email" class="custom-input" placeholder="Email" required>
              </div>
              <div class="col-12">
                <div id="newsletter-message" class="mb-2" style="display: none;"></div>
                <button type="submit" class="btn-gradient rounded w-100" id="newsletter-submit-btn">
                  Subscribe to Newsletter
                </button>
              </div>
            </form>
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
    
    <!-- Global Cart Bar Script -->
    <script>
    // Global cart bar functionality
    (function() {
      // Check localStorage for cart bar state
      const cartBarState = localStorage.getItem('cartBarState');
      const isMinimized = localStorage.getItem('cartBarMinimized') === 'true';
      
      // Initialize cart bar on page load
      document.addEventListener('DOMContentLoaded', function() {
        updateCartBar();
        
        // Restore minimized state if it was minimized
        if (isMinimized && document.getElementById('cartBarMinimized')) {
          const cartBar = document.getElementById('cartBar');
          const cartBarMinimized = document.getElementById('cartBarMinimized');
          if (cartBar && cartBarMinimized) {
            cartBar.style.display = 'none';
            cartBarMinimized.style.display = 'block';
          }
        }
        
        // Close button handler
        const closeBtn = document.getElementById('cartCloseBtn');
        if (closeBtn) {
          closeBtn.addEventListener('click', function() {
            const cartBar = document.getElementById('cartBar');
            const cartBarMinimized = document.getElementById('cartBarMinimized');
            if (cartBar) {
              cartBar.style.display = 'none';
              localStorage.setItem('cartBarState', 'closed');
            }
            if (cartBarMinimized) {
              cartBarMinimized.style.display = 'none';
              localStorage.setItem('cartBarMinimized', 'false');
            }
            document.body.style.paddingBottom = '0';
          });
        }
        
        // Minimize button handler
        const minimizeBtn = document.getElementById('cartMinimizeBtn');
        if (minimizeBtn) {
          minimizeBtn.addEventListener('click', function() {
            const cartBar = document.getElementById('cartBar');
            const cartBarMinimized = document.getElementById('cartBarMinimized');
            if (cartBar && cartBarMinimized) {
              cartBar.style.display = 'none';
              cartBarMinimized.style.display = 'block';
              localStorage.setItem('cartBarMinimized', 'true');
              document.body.style.paddingBottom = '0';
            }
          });
        }
        
        // Expand button handler
        const expandBtn = document.getElementById('cartExpandBtn');
        if (expandBtn) {
          expandBtn.addEventListener('click', function() {
            const cartBar = document.getElementById('cartBar');
            const cartBarMinimized = document.getElementById('cartBarMinimized');
            if (cartBar && cartBarMinimized) {
              cartBar.style.display = 'block';
              cartBarMinimized.style.display = 'none';
              localStorage.setItem('cartBarMinimized', 'false');
              updateBodyPadding();
            }
          });
        }
      });
      
      // Global updateCartBar function
      window.updateCartBar = function() {
        fetch('{{ route("frontend.cart.get") }}', {
          method: 'GET',
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const cartBar = document.getElementById('cartBar');
            const cartBarMinimized = document.getElementById('cartBarMinimized');
            const cartCountBadge = document.getElementById('cartCountBadge');
            const cartCountBadgeMini = document.getElementById('cartCountBadgeMini');
            const cartItemsText = document.getElementById('cartItemsText');
            const cartTotalText = document.getElementById('cartTotalText');
            
            if (data.cart_count > 0) {
              // Update badges
              if (cartCountBadge) cartCountBadge.textContent = data.cart_count;
              if (cartCountBadgeMini) cartCountBadgeMini.textContent = data.cart_count;
              if (cartItemsText) cartItemsText.textContent = data.cart_count === 1 ? '1 item' : `${data.cart_count} items`;
              if (cartTotalText) cartTotalText.textContent = data.cart_total_formatted;
              
              // Show cart bar or minimized version based on state
              const isMinimized = localStorage.getItem('cartBarMinimized') === 'true';
              if (isMinimized && cartBarMinimized) {
                cartBarMinimized.style.display = 'block';
                if (cartBar) cartBar.style.display = 'none';
              } else if (cartBar) {
                cartBar.style.display = 'block';
                if (cartBarMinimized) cartBarMinimized.style.display = 'none';
                updateBodyPadding();
              }
              
              localStorage.setItem('cartBarState', 'open');
            } else {
              if (cartBar) cartBar.style.display = 'none';
              if (cartBarMinimized) cartBarMinimized.style.display = 'none';
              document.body.style.paddingBottom = '0';
              localStorage.setItem('cartBarState', 'closed');
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
      };
      
      function updateBodyPadding() {
        const cartBar = document.getElementById('cartBar');
        if (cartBar && cartBar.style.display === 'block') {
          document.body.style.paddingBottom = window.innerWidth <= 768 ? '140px' : '100px';
        }
      }
    })();
    </script>

    <!-- Newsletter Subscription Script -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletter-form');
        const newsletterMessage = document.getElementById('newsletter-message');
        const newsletterSubmitBtn = document.getElementById('newsletter-submit-btn');

        if (newsletterForm) {
          newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(newsletterForm);
            const submitBtnText = newsletterSubmitBtn.textContent;
            
            // Disable submit button
            newsletterSubmitBtn.disabled = true;
            newsletterSubmitBtn.textContent = 'Subscribing...';

            // Hide previous messages
            newsletterMessage.style.display = 'none';
            newsletterMessage.className = 'mb-2';

            fetch('{{ route("frontend.newsletter.subscribe") }}', {
              method: 'POST',
              body: formData,
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                newsletterMessage.textContent = data.message;
                newsletterMessage.className = 'mb-2 text-success';
                newsletterMessage.style.display = 'block';
                newsletterForm.reset();
              } else {
                newsletterMessage.textContent = data.message;
                newsletterMessage.className = 'mb-2 text-danger';
                newsletterMessage.style.display = 'block';
              }
            })
            .catch(error => {
              console.error('Error:', error);
              newsletterMessage.textContent = 'Sorry, there was an error. Please try again later.';
              newsletterMessage.className = 'mb-2 text-danger';
              newsletterMessage.style.display = 'block';
            })
            .finally(() => {
              newsletterSubmitBtn.disabled = false;
              newsletterSubmitBtn.textContent = submitBtnText;
            });
          });
        }
      });
    </script>
    
    @stack('scripts')
</body>
</html>

