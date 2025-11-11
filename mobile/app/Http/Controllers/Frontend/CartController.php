<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantValue;
use App\Models\Coupon;
use App\Models\Setting;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Product is not available.'
            ], 400);
        }
        
        $quantity = $request->input('quantity', 1);
        $quantity = max(1, (int)$quantity);
        $selectedVariants = $request->input('variants', []);
        
        // Get price based on selected variants
        $price = $product->price;
        $compareAtPrice = $product->compare_at_price;
        $variantCombination = [];
        
        if (!empty($selectedVariants)) {
            // Build variant combination
            $product->load(['variants.options', 'variantValues']);
            foreach ($selectedVariants as $variantId => $optionId) {
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
            
            // Find matching variant value for price
            if (!empty($variantCombination)) {
                ksort($variantCombination);
                foreach ($product->variantValues as $vv) {
                    $vvCombination = is_array($vv->variant_combination)
                        ? $vv->variant_combination
                        : json_decode($vv->variant_combination, true);
                    
                    if (!is_array($vvCombination)) {
                        continue;
                    }
                    
                    ksort($vvCombination);
                    
                    if (json_encode($vvCombination) === json_encode($variantCombination)) {
                        if ($vv->price !== null) {
                            $price = $vv->price;
                        }
                        if ($vv->compare_at_price !== null) {
                            $compareAtPrice = $vv->compare_at_price;
                        }
                        break;
                    }
                }
            }
        }
        
        $cart = session()->get('cart', []);
        
        // Create unique cart key based on product ID and variant combination
        $cartKey = $productId;
        if (!empty($variantCombination)) {
            $cartKey .= '_' . md5(json_encode($variantCombination));
        }
        
        $replace = $request->boolean('replace', false);
        
        // Check if product with same variants already exists in cart
        if ($replace) {
            $cart = [];
        }

        if (isset($cart[$cartKey])) {
            if ($replace) {
                $cart[$cartKey]['quantity'] = $quantity;
            } else {
                $cart[$cartKey]['quantity'] += $quantity;
            }
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $price,
                'compare_at_price' => $compareAtPrice,
                'featured_image' => $product->featured_image,
                'quantity' => $quantity,
                'variants' => $variantCombination,
                'variant_data' => $selectedVariants
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }
    
    public function remove(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        
        // Try to find by product ID first (for backward compatibility)
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        } else {
            // Find by cart key pattern
            foreach ($cart as $key => $item) {
                if (strpos($key, $productId . '_') === 0 || $key == $productId) {
                    unset($cart[$key]);
                    break;
                }
            }
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart.',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }
    
    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);
        
        if ($quantity < 1) {
            return $this->remove($request, $productId);
        }
        
        $cart = session()->get('cart', []);
        
        // Try to find by product ID first
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
        } else {
            // Find by cart key pattern
            foreach ($cart as $key => $item) {
                if (strpos($key, $productId . '_') === 0 || $key == $productId) {
                    $cart[$key]['quantity'] = $quantity;
                    break;
                }
            }
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully.',
            'cart_count' => $this->getCartCount(),
            'cart_total' => $this->getCartTotal()
        ]);
    }
    
    public function getCart()
    {
        $cart = session()->get('cart', []);
        $settings = Setting::getSettings();
        $currencySymbol = $settings->currency_symbol ?? '$';
        
        $cartItems = [];
        $total = 0;
        
        foreach ($cart as $key => $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            
            $cartItems[] = [
                'id' => $item['id'],
                'cart_key' => $key,
                'name' => $item['name'],
                'slug' => $item['slug'],
                'price' => $item['price'],
                'compare_at_price' => $item['compare_at_price'] ?? null,
                'featured_image' => $item['featured_image'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
                'variants' => $item['variants'] ?? [],
                'variant_data' => $item['variant_data'] ?? []
            ];
        }
        
        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'cart_count' => $this->getCartCount(),
            'cart_total' => $total,
            'cart_total_formatted' => $currencySymbol . number_format($total, 2),
            'currency_symbol' => $currencySymbol
        ]);
    }
    
    public function clear()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
            'cart_count' => 0,
            'cart_total' => 0
        ]);
    }
    
    private function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }
    
    private function getCartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return $total;
    }
    
    public function validateCoupon(Request $request)
    {
        $code = strtoupper(trim($request->input('code')));
        
        if (empty($code)) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a coupon code.'
            ], 400);
        }
        
        $coupon = Coupon::where('code', $code)->first();
        
        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.'
            ], 400);
        }
        
        if (!$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is not valid or has expired.'
            ], 400);
        }
        
        // Check if coupon is applicable to cart items
        $cart = session()->get('cart', []);
        $cartTotal = 0;
        $applicable = false;
        
        foreach ($cart as $item) {
            $cartTotal += $item['price'] * $item['quantity'];
            
            if ($coupon->applicable_to === 'all') {
                $applicable = true;
            } elseif ($coupon->applicable_to === 'products') {
                if (in_array($item['id'], $coupon->product_ids ?? [])) {
                    $applicable = true;
                }
            } elseif ($coupon->applicable_to === 'categories') {
                $product = Product::find($item['id']);
                if ($product && in_array($product->category_id, $coupon->category_ids ?? [])) {
                    $applicable = true;
                }
            }
        }
        
        if (!$applicable && $coupon->applicable_to !== 'all') {
            return response()->json([
                'success' => false,
                'message' => 'This coupon is not applicable to items in your cart.'
            ], 400);
        }
        
        // Check minimum purchase
        $settings = Setting::getSettings();
        if ($cartTotal < $coupon->minimum_purchase) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum purchase amount for this coupon is ' . ($settings->currency_symbol ?? '$') . number_format($coupon->minimum_purchase, 2) . '.'
            ], 400);
        }
        
        // Store coupon in session
        session()->put('applied_coupon', $code);
        
        $discount = $coupon->calculateDiscount($cartTotal);
        
        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discount' => $discount,
            'discount_formatted' => ($settings->currency_symbol ?? '$') . number_format($discount, 2)
        ]);
    }
    
    public function removeCoupon(Request $request)
    {
        session()->forget('applied_coupon');
        
        return response()->json([
            'success' => true,
            'message' => 'Coupon removed successfully.'
        ]);
    }
}

