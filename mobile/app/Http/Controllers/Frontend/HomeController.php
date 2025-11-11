<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use App\Models\AboutPageContent;
use App\Models\ServicePageContent;
use App\Models\JoinPageContent;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ShippingOption;
use App\Models\GlobalFeature;
use App\Models\Setting;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $content = HomepageContent::getContent();
        return view('frontend.index', compact('content'));
    }

    public function about()
    {
        $content = AboutPageContent::getContent();
        return view('frontend.about', compact('content'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function join()
    {
        $content = JoinPageContent::getContent();
        return view('frontend.join', compact('content'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('frontend.cart')->with('error', 'Your cart is empty.');
        }
        
        $settings = Setting::getSettings();
        $currencySymbol = $settings->currency_symbol ?? '£';
        
        $cartItems = [];
        $subtotal = 0;
        
        foreach ($cart as $key => $item) {
            $itemSubtotal = $item['price'] * $item['quantity'];
            $subtotal += $itemSubtotal;
            
            $cartItems[] = [
                'id' => $item['id'],
                'cart_key' => $key,
                'name' => $item['name'],
                'slug' => $item['slug'],
                'price' => $item['price'],
                'compare_at_price' => $item['compare_at_price'] ?? null,
                'featured_image' => $item['featured_image'],
                'quantity' => $item['quantity'],
                'subtotal' => $itemSubtotal,
                'variants' => $item['variants'] ?? []
            ];
        }
        
        // Get applied coupon from session
        $appliedCoupon = session()->get('applied_coupon', null);
        $discount = 0;
        
        if ($appliedCoupon) {
            $coupon = \App\Models\Coupon::where('code', $appliedCoupon)->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                session()->forget('applied_coupon');
                $appliedCoupon = null;
            }
        }
        
        // Calculate totals
        $shipping = 0; // Free shipping for now
        $tax = 0; // VAT will be calculated if needed
        $total = $subtotal + $shipping + $tax - $discount;
        
        return view('frontend.checkout', compact('cartItems', 'subtotal', 'shipping', 'discount', 'tax', 'total', 'settings', 'currencySymbol', 'appliedCoupon'));
    }

    public function marketplace(Request $request)
    {
        // Get active categories, brands, and tags
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        
        // Get featured products for rotation
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with(['category', 'brand'])
            ->get();
        
        // Get all products for the main grid (with filters)
        $query = Product::where('is_active', true)
            ->with(['category', 'brand', 'tags'])
            ->withAvg(['approvedReviews as approved_rating' => function ($query) {
                $query->where('is_approved', true);
            }], 'rating')
            ->withCount(['approvedReviews as approved_reviews_count' => function ($query) {
                $query->where('is_approved', true);
            }]);
        
        // Apply search filter if provided
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('sku', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply filters if provided
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('brand') && $request->brand) {
            $query->where('brand_id', $request->brand);
        }
        
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }
        
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'popular');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'popular':
            default:
                // Most popular: featured first, then by created_at desc
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('created_at', 'desc');
                break;
        }
        
        $products = $query->paginate(12)->appends($request->except('page'));
        
        // Get total count for display
        $totalResults = $products->total();
        
        // Build active filters array
        $activeFilters = [];
        if ($request->has('category') && $request->category) {
            $category = Category::find($request->category);
            if ($category) {
                $activeFilters[] = [
                    'type' => 'category',
                    'label' => $category->name,
                    'value' => $request->category
                ];
            }
        }
        
        if ($request->has('brand') && $request->brand) {
            $brand = Brand::find($request->brand);
            if ($brand) {
                $activeFilters[] = [
                    'type' => 'brand',
                    'label' => $brand->name,
                    'value' => $request->brand
                ];
            }
        }
        
        if ($request->has('tag') && $request->tag) {
            $tag = Tag::find($request->tag);
            if ($tag) {
                $activeFilters[] = [
                    'type' => 'tag',
                    'label' => $tag->name,
                    'value' => $request->tag
                ];
            }
        }
        
        if ($request->has('min_price') && $request->min_price) {
            $activeFilters[] = [
                'type' => 'min_price',
                'label' => 'Min: ' . (Setting::getSettings()->currency_symbol ?? '$') . number_format($request->min_price, 2),
                'value' => $request->min_price
            ];
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $activeFilters[] = [
                'type' => 'max_price',
                'label' => 'Max: ' . (Setting::getSettings()->currency_symbol ?? '$') . number_format($request->max_price, 2),
                'value' => $request->max_price
            ];
        }
        
        return view('frontend.marketplace', compact('categories', 'brands', 'tags', 'featuredProducts', 'products', 'activeFilters', 'totalResults', 'sortBy'));
    }

    public function marketplaceFilter(Request $request)
    {
        // Get settings for currency symbol
        $settings = Setting::getSettings();
        $currencySymbol = $settings->currency_symbol ?? '$';
        
        // Get all products for the main grid (with filters)
        $query = Product::where('is_active', true)
            ->with(['category', 'brand', 'tags'])
            ->withAvg(['approvedReviews as approved_rating' => function ($query) {
                $query->where('is_approved', true);
            }], 'rating')
            ->withCount(['approvedReviews as approved_reviews_count' => function ($query) {
                $query->where('is_approved', true);
            }]);
        
        // Apply search filter if provided
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('sku', 'like', '%' . $searchTerm . '%');
            });
        }
        
        // Apply filters if provided
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('brand') && $request->brand) {
            $query->where('brand_id', $request->brand);
        }
        
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }
        
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Apply sorting
        $sortBy = $request->get('sort', 'popular');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'popular':
            default:
                // Most popular: featured first, then by created_at desc
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('created_at', 'desc');
                break;
        }
        
        $products = $query->paginate(12)->appends($request->except('page'));
        
        // Get total count for display
        $totalResults = $products->total();
        
        // Build active filters array
        $activeFilters = [];
        if ($request->has('category') && $request->category) {
            $category = Category::find($request->category);
            if ($category) {
                $activeFilters[] = [
                    'type' => 'category',
                    'label' => $category->name,
                    'value' => $request->category
                ];
            }
        }
        
        if ($request->has('brand') && $request->brand) {
            $brand = Brand::find($request->brand);
            if ($brand) {
                $activeFilters[] = [
                    'type' => 'brand',
                    'label' => $brand->name,
                    'value' => $request->brand
                ];
            }
        }
        
        if ($request->has('tag') && $request->tag) {
            $tag = Tag::find($request->tag);
            if ($tag) {
                $activeFilters[] = [
                    'type' => 'tag',
                    'label' => $tag->name,
                    'value' => $request->tag
                ];
            }
        }
        
        if ($request->has('min_price') && $request->min_price) {
            $activeFilters[] = [
                'type' => 'min_price',
                'label' => 'Min: ' . $currencySymbol . number_format($request->min_price, 2),
                'value' => $request->min_price
            ];
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $activeFilters[] = [
                'type' => 'max_price',
                'label' => 'Max: ' . $currencySymbol . number_format($request->max_price, 2),
                'value' => $request->max_price
            ];
        }
        
        // Build product HTML
        $productsHtml = '';
        if ($products->count() > 0) {
            foreach ($products as $product) {
                $productUrl = route('frontend.product-detail', $product->slug);
                $productsHtml .= '<div class="col">';
                $productsHtml .= '<div class="product-card h-100 position-relative">';
                if ($product->is_hot_product) {
                    $productsHtml .= '<span class="product-badge badge-danger">HOT</span>';
                } elseif ($product->is_best_deal) {
                    $productsHtml .= '<span class="product-badge badge-danger">BEST DEALS</span>';
                }
                $ratingValue = round($product->approved_rating ?? 0, 1);
                $reviewsCountValue = $product->approved_reviews_count ?? 0;
                $roundedRatingValue = $reviewsCountValue > 0 ? round($ratingValue * 2) / 2 : 0;
                $fullStarsValue = (int) floor($roundedRatingValue);
                $hasHalfStarValue = ($roundedRatingValue - $fullStarsValue) === 0.5;
                $emptyStarsValue = 5 - $fullStarsValue - ($hasHalfStarValue ? 1 : 0);
                $starsHtml = '';
                for ($i = 0; $i < $fullStarsValue; $i++) {
                    $starsHtml .= '<i class="bi bi-star-fill"></i>';
                }
                if ($hasHalfStarValue) {
                    $starsHtml .= '<i class="bi bi-star-half"></i>';
                }
                for ($i = 0; $i < $emptyStarsValue; $i++) {
                    $starsHtml .= '<i class="bi bi-star"></i>';
                }
                $productsHtml .= '<div class="card-body">';
                $productsHtml .= '<div class="ratio ratio-1x1 thumb">';
                $productsHtml .= '<a href="' . $productUrl . '" class="d-block h-100"><img src="' . ($product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/phone-1.svg')) . '" alt="' . htmlspecialchars($product->name) . '" class="w-100 h-100 p-2 rounded" /></a>';
                $productsHtml .= '<div class="product-actions">';
                $productsHtml .= '<div class="action-btn"><i class="bi bi-heart"></i></div>';
                $productsHtml .= '<div class="action-btn add-to-cart-btn" data-product-id="' . $product->id . '" title="Add to Cart"><i class="bi bi-cart"></i></div>';
                $productsHtml .= '<a href="' . $productUrl . '" class="action-btn" title="View Product"><i class="bi bi-eye"></i></a>';
                $productsHtml .= '</div>';
                $productsHtml .= '</div>';
                $productsHtml .= '<div class="rating mt-3 d-flex align-items-center">';
                $productsHtml .= '<span class="text-primary-custom rating-stars-sm">';
                $productsHtml .= $starsHtml;
                $productsHtml .= '</span>';
                if ($reviewsCountValue > 0) {
                    $productsHtml .= '<span class="rating-count">' . number_format($ratingValue, 1) . ' (' . $reviewsCountValue . ')</span>';
                } else {
                    $productsHtml .= '<span class="rating-count">(0)</span>';
                }
                $productsHtml .= '</div>';
                $productsHtml .= '<a href="' . $productUrl . '" class="text-decoration-none text-dark"><p class="product-title mt-2 mb-0">' . htmlspecialchars(\Illuminate\Support\Str::limit($product->name, 50)) . '</p></a>';
                $productsHtml .= '<div class="product-price text-promo">';
                $productsHtml .= $currencySymbol . number_format($product->price, 2);
                if ($product->compare_at_price) {
                    $productsHtml .= '<small class="text-muted text-decoration-line-through">' . $currencySymbol . number_format($product->compare_at_price, 2) . '</small>';
                }
                $productsHtml .= '</div>';
                $productsHtml .= '</div>';
                $productsHtml .= '</div>';
                $productsHtml .= '</div>';
            }
        } else {
            $productsHtml = '<div class="col-12"><p class="text-center py-5">No products found.</p></div>';
        }
        
        // Build pagination HTML
        $paginationHtml = '';
        if ($products->hasPages()) {
            $paginationHtml = '<nav class="pagination-nav d-flex justify-content-center mt-5" aria-label="Page navigation">' . $products->appends($request->query())->links()->toHtml() . '</nav>';
        }
        
        // Build active filters HTML
        $activeFiltersHtml = '';
        if (count($activeFilters) > 0) {
            foreach ($activeFilters as $filter) {
                $activeFiltersHtml .= '<span class="d-inline-flex align-items-center fs-14 fw-400 badge bg-light text-dark border">';
                $activeFiltersHtml .= htmlspecialchars($filter['label']);
                $activeFiltersHtml .= '<button type="button" class="btn-close ms-2" aria-label="Remove" onclick="removeFilter(\'' . $filter['type'] . '\')"></button>';
                $activeFiltersHtml .= '</span>';
            }
        }
        
        return response()->json([
            'success' => true,
            'products_html' => $productsHtml,
            'pagination_html' => $paginationHtml,
            'active_filters_html' => $activeFiltersHtml,
            'total_results' => $totalResults,
            'has_filters' => count($activeFilters) > 0
        ]);
    }

    public function service()
    {
        $content = ServicePageContent::getContent();
        return view('frontend.service', compact('content'));
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }

    public function trackOrder()
    {
        return view('frontend.track-order');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $settings = Setting::getSettings();
        $currencySymbol = $settings->currency_symbol ?? '$';
        
        $cartItems = [];
        $subtotal = 0;
        
        foreach ($cart as $key => $item) {
            $itemSubtotal = $item['price'] * $item['quantity'];
            $subtotal += $itemSubtotal;
            
            $cartItems[] = [
                'id' => $item['id'],
                'cart_key' => $key,
                'name' => $item['name'],
                'slug' => $item['slug'],
                'price' => $item['price'],
                'compare_at_price' => $item['compare_at_price'] ?? null,
                'featured_image' => $item['featured_image'],
                'quantity' => $item['quantity'],
                'subtotal' => $itemSubtotal,
                'variants' => $item['variants'] ?? [],
                'variant_data' => $item['variant_data'] ?? []
            ];
        }
        
        // Get applied coupon from session
        $appliedCoupon = session()->get('applied_coupon', null);
        $discount = 0;
        
        if ($appliedCoupon) {
            $coupon = \App\Models\Coupon::where('code', $appliedCoupon)->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                session()->forget('applied_coupon');
                $appliedCoupon = null;
            }
        }
        
        // Calculate totals
        $shipping = 0; // Free shipping for now
        $tax = 0; // No tax for now
        $total = $subtotal + $shipping + $tax - $discount;
        
        return view('frontend.cart', compact('cartItems', 'subtotal', 'shipping', 'discount', 'tax', 'total', 'settings', 'currencySymbol', 'appliedCoupon'));
    }

    public function select()
    {
        return view('frontend.select');
    }
    
    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
            'country' => 'required|string|max:2',
            'company_name' => 'nullable|string|max:255',
            'ship_to_different_address' => 'nullable|boolean',
            'shipping_first_name' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_last_name' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_address_line_1' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_address_line_2' => 'nullable|string|max:255',
            'shipping_city' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_county' => 'required_if:ship_to_different_address,1|nullable|string|max:255',
            'shipping_postcode' => 'required_if:ship_to_different_address,1|nullable|string|max:10',
            'shipping_country' => 'required_if:ship_to_different_address,1|nullable|string|max:2',
            'payment_method' => 'required|in:stripe,paypal',
            'stripe_token' => 'required_if:payment_method,stripe|nullable|string',
            'paypal_order_id' => 'required_if:payment_method,paypal|nullable|string',
            'order_notes' => 'nullable|string|max:1000',
        ]);
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('frontend.cart')->with('error', 'Your cart is empty.');
        }
        
        $settings = Setting::getSettings();
        $currencySymbol = $settings->currency_symbol ?? '£';
        
        // Calculate totals
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $appliedCoupon = session()->get('applied_coupon', null);
        $couponId = null;
        $discount = 0;
        
        if ($appliedCoupon) {
            $coupon = Coupon::where('code', $appliedCoupon)->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
                $couponId = $coupon->id;
            }
        }
        
        $shipping = 0;
        $tax = 0;
        $total = $subtotal + $shipping + $tax - $discount;
        
        // Process payment
        $paymentStatus = 'pending';
        if ($validated['payment_method'] === 'stripe') {
            // In a real implementation, you would charge the card using Stripe API
            // For now, we'll mark as paid if token is provided
            $paymentStatus = $validated['stripe_token'] ? 'paid' : 'pending';
        } elseif ($validated['payment_method'] === 'paypal') {
            // Verify PayPal order
            $paymentStatus = $validated['paypal_order_id'] ? 'paid' : 'pending';
        }
        
        DB::beginTransaction();
        try {
            // Build addresses
            $billingAddress = $validated['address_line_1'];
            if (!empty($validated['address_line_2'])) {
                $billingAddress .= ', ' . $validated['address_line_2'];
            }
            
            $shippingAddress = $billingAddress;
            if ($request->has('ship_to_different_address') && $request->ship_to_different_address) {
                $shippingAddress = $validated['shipping_address_line_1'];
                if (!empty($validated['shipping_address_line_2'])) {
                    $shippingAddress .= ', ' . $validated['shipping_address_line_2'];
                }
            }
            
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $validated['first_name'] . ' ' . $validated['last_name'],
                'customer_email' => $validated['email'],
                'customer_phone' => $validated['phone'],
                'billing_address' => $billingAddress,
                'shipping_address' => $shippingAddress,
                'city' => $validated['city'],
                'state' => $validated['county'], // Using state field for county
                'zip_code' => $validated['postcode'],
                'country' => $validated['country'],
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping_cost' => $shipping,
                'discount' => $discount,
                'coupon_id' => $couponId,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => $paymentStatus,
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['order_notes'] ?? null,
            ]);
            
            // Create order items
            foreach ($cart as $key => $item) {
                $product = Product::find($item['id']);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_sku' => $product->sku ?? '',
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                    'variant_data' => $item['variants'] ?? [],
                ]);
            }
            
            // Clear cart and coupon
            session()->forget('cart');
            session()->forget('applied_coupon');
            
            DB::commit();
            
            return redirect()->route('frontend.track-order')
                ->with('success', 'Order placed successfully! Order Number: ' . $order->order_number);
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process order. Please try again.')->withInput();
        }
    }
    
    public function createPayPalOrder(Request $request)
    {
        $validated = $request->validate([
            'total' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
        ]);
        
        // In a real implementation, you would create a PayPal order using PayPal API
        // For now, we'll return a mock order ID
        $orderId = 'PAYPAL-' . strtoupper(\Illuminate\Support\Str::random(16));
        
        // Store PayPal order in session temporarily
        session()->put('paypal_order_' . $orderId, [
            'total' => $validated['total'],
            'currency' => $validated['currency'],
            'created_at' => now(),
        ]);
        
        return response()->json([
            'id' => $orderId,
            'status' => 'CREATED'
        ]);
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'brand', 'tags', 'variants.options', 'features', 'galleryImages', 'variantValues'])
            ->firstOrFail();
        
        $settings = Setting::getSettings();
        
        // Get related products (same category, exclude current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['category', 'brand'])
            ->limit(3)
            ->get();
        
        // Get featured products
        $featuredProducts = Product::where('is_featured', true)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['category', 'brand'])
            ->limit(3)
            ->get();
        
        // Get products from same brand
        $brandProducts = Product::where('brand_id', $product->brand_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['category', 'brand'])
            ->limit(3)
            ->get();

        // Reviews data
        $approvedReviewsQuery = $product->approvedReviews();
        $reviewsCount = (clone $approvedReviewsQuery)->count();
        $averageRating = (float) round((clone $approvedReviewsQuery)->avg('rating') ?? 0, 1);
        $recentReviews = (clone $approvedReviewsQuery)->latest()->take(10)->get();
        
        // Get shipping options
        $shippingOptions = ShippingOption::getActive();
        
        // Get features: product-specific first, then global as fallback
        $productFeatures = $product->features()->orderBy('order')->get();
        $globalFeatures = GlobalFeature::getActive();
        $displayFeatures = $productFeatures->count() > 0 ? $productFeatures : $globalFeatures;
        
        $wishlistIds = session()->get('wishlist', []);
        $isInWishlist = in_array($product->id, $wishlistIds);

        return view('frontend.product-detail', compact(
            'product',
            'settings',
            'relatedProducts',
            'featuredProducts',
            'brandProducts',
            'averageRating',
            'reviewsCount',
            'recentReviews',
            'shippingOptions',
            'displayFeatures',
            'isInWishlist'
        ));
    }

    public function storeReview(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'reviewer_name' => 'required|string|max:120',
            'reviewer_email' => 'nullable|email|max:150',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:150',
            'comment' => 'required|string|max:1500',
        ]);

        ProductReview::create([
            'product_id' => $product->id,
            'reviewer_name' => $validated['reviewer_name'],
            'reviewer_email' => $validated['reviewer_email'] ?? null,
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'comment' => $validated['comment'],
            'is_approved' => true,
        ]);

        return redirect()
            ->route('frontend.product-detail', $product->slug)
            ->with('success', 'Thank you for sharing your experience! Your review has been added.');
    }

    public function addToWishlist($productId)
    {
        $product = Product::where('id', $productId)->where('is_active', true)->firstOrFail();
        $wishlist = session()->get('wishlist', []);

        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            session()->put('wishlist', $wishlist);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist.',
            'wishlist_count' => count($wishlist),
        ]);
    }

    public function removeFromWishlist($productId)
    {
        $wishlist = session()->get('wishlist', []);
        if (($key = array_search($productId, $wishlist)) !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product removed from wishlist.',
            'wishlist_count' => count($wishlist),
        ]);
    }
    
    public function getVariantPrice(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['variantValues'])
            ->firstOrFail();
        
        $settings = Setting::getSettings();
        $currencySymbol = $settings->currency_symbol ?? '$';
        
        // Get selected variant option IDs from request
        $selectedVariants = $request->input('variants', []);
        
        // Build variant combination from selected options
        $variantCombination = [];
        if (!empty($selectedVariants)) {
            // Load variants and options to get the combination
            $product->load(['variants.options']);
            
            foreach ($selectedVariants as $variantId => $optionId) {
                // Convert to integers for comparison
                $variantId = (int)$variantId;
                $optionId = (int)$optionId;
                
                foreach ($product->variants as $variant) {
                    if ($variant->id == $variantId) {
                        $option = $variant->options->firstWhere('id', $optionId);
                        if ($option) {
                            $variantCombination[$variant->name] = $option->value;
                        }
                        break;
                    }
                }
            }
        }
        
        // Find matching variant value
        $variantValue = null;
        if (!empty($variantCombination)) {
            // Sort combination keys for consistent matching
            ksort($variantCombination);
            
            foreach ($product->variantValues as $vv) {
                $vvCombination = is_array($vv->variant_combination) 
                    ? $vv->variant_combination 
                    : json_decode($vv->variant_combination, true);
                
                if (!is_array($vvCombination)) {
                    continue;
                }
                
                ksort($vvCombination);
                
                // Compare combinations
                if (json_encode($vvCombination) === json_encode($variantCombination)) {
                    $variantValue = $vv;
                    break;
                }
            }
        }
        
        // Get price
        $price = $variantValue && $variantValue->price !== null 
            ? $variantValue->price 
            : $product->price;
        
        $compareAtPrice = $variantValue && $variantValue->compare_at_price !== null
            ? $variantValue->compare_at_price
            : $product->compare_at_price;
        
        // Calculate discount
        $discount = null;
        if ($compareAtPrice && $compareAtPrice > $price) {
            $discount = (($compareAtPrice - $price) / $compareAtPrice) * 100;
        }
        
        return response()->json([
            'success' => true,
            'price' => $price,
            'price_formatted' => $currencySymbol . number_format($price, 2),
            'compare_at_price' => $compareAtPrice,
            'compare_at_price_formatted' => $compareAtPrice ? $currencySymbol . number_format($compareAtPrice, 2) : null,
            'discount' => $discount ? number_format($discount, 0) : null,
            'currency_symbol' => $currencySymbol
        ]);
    }

    public function placeOrder()
    {
        return view('frontend.place-order');
    }

    public function mobileRepair()
    {
        return view('frontend.mobile-repair');
    }
}
