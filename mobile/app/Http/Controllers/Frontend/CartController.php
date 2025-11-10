<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
        
        $cart = session()->get('cart', []);
        
        // Check if product already exists in cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'compare_at_price' => $product->compare_at_price,
                'featured_image' => $product->featured_image,
                'quantity' => 1
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
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        
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
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        
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
        
        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            
            $cartItems[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'price' => $item['price'],
                'compare_at_price' => $item['compare_at_price'] ?? null,
                'featured_image' => $item['featured_image'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal
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
}

