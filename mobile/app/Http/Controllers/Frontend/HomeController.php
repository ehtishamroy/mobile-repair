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
use App\Models\Setting;
use Illuminate\Http\Request;

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
        return view('frontend.checkout');
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
        $query = Product::where('is_active', true)->with(['category', 'brand', 'tags']);
        
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
        $query = Product::where('is_active', true)->with(['category', 'brand', 'tags']);
        
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
                $productsHtml .= '<div class="card-body">';
                $productsHtml .= '<div class="ratio ratio-1x1 thumb">';
                $productsHtml .= '<a href="' . $productUrl . '"><img src="' . ($product->featured_image ? asset('storage/' . $product->featured_image) : asset('front-assets/img/phone-1.svg')) . '" alt="' . htmlspecialchars($product->name) . '" class="w-100 h-100 p-2 rounded" /></a>';
                $productsHtml .= '<div class="product-actions">';
                $productsHtml .= '<div class="action-btn"><i class="bi bi-heart"></i></div>';
                $productsHtml .= '<div class="action-btn add-to-cart-btn" data-product-id="' . $product->id . '" title="Add to Cart"><i class="bi bi-cart"></i></div>';
                $productsHtml .= '<div class="action-btn"><i class="bi bi-eye"></i></div>';
                $productsHtml .= '</div>';
                $productsHtml .= '</div>';
                $productsHtml .= '<div class="rating mt-3 d-flex align-items-center">';
                $productsHtml .= '<span class="text-primary-custom">';
                $productsHtml .= '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>';
                $productsHtml .= '</span>';
                $productsHtml .= '<span class="rating-count">(0)</span>';
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
        return view('frontend.cart');
    }

    public function select()
    {
        return view('frontend.select');
    }

    public function productDetail()
    {
        return view('frontend.product-detail');
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
