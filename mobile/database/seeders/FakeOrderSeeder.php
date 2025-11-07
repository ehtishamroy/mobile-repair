<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;

class FakeOrderSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'sample-category'],
            [
                'name' => 'Sample Category',
                'description' => 'Auto-generated sample category for fake order seeding.',
                'is_active' => true,
            ]
        );

        $brand = Brand::firstOrCreate(
            ['slug' => 'sample-brand'],
            [
                'name' => 'Sample Brand',
                'description' => 'Auto-generated sample brand for fake order seeding.',
                'is_active' => true,
            ]
        );

        $product = Product::firstOrCreate(
            ['slug' => 'sample-product'],
            [
                'name' => 'Sample Product',
                'sku' => 'SAMPLE-' . Str::upper(Str::random(4)),
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'description' => 'This is a sample product created for demonstrating fake orders.',
                'price' => 249.99,
                'quantity' => 50,
                'availability' => 'in_stock',
                'is_featured' => false,
                'is_best_deal' => false,
                'is_hot_product' => false,
                'has_color_variant' => false,
                'is_active' => true,
            ]
        );

        if (!$product->wasRecentlyCreated) {
            $product->update(['quantity' => 50]);
        }

        $order = Order::create([
            'order_number' => 'HM-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4)),
            'customer_name' => 'John Doe',
            'customer_email' => 'john.doe@example.com',
            'customer_phone' => '+44 20 7946 0958',
            'shipping_address' => '221B Baker Street, London NW1 6XE, United Kingdom',
            'billing_address' => '221B Baker Street, London NW1 6XE, United Kingdom',
            'city' => 'London',
            'state' => 'Greater London',
            'zip_code' => 'NW1 6XE',
            'country' => 'United Kingdom',
            'subtotal' => 249.99,
            'tax' => 12.50,
            'shipping_cost' => 5.00,
            'discount' => 0,
            'total' => 267.49,
            'status' => 'processing',
            'payment_status' => 'paid',
            'payment_method' => 'Credit Card',
            'notes' => 'Please deliver between 9 AM and 5 PM.',
            'admin_notes' => 'Auto-generated fake order for demo purposes.',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'price' => $product->price,
            'quantity' => 1,
            'subtotal' => $product->price,
            'variant_data' => null,
        ]);

        OrderTracking::create([
            'order_id' => $order->id,
            'status' => 'processing',
            'title' => 'Order Processing',
            'message' => 'Your order is currently being prepared for shipment.',
            'location' => 'Harrow Mobiles Fulfilment Centre',
            'updated_by' => null,
            'tracking_date' => now(),
            'is_customer_notified' => true,
        ]);

        OrderTracking::create([
            'order_id' => $order->id,
            'status' => 'confirmed',
            'title' => 'Order Confirmed',
            'message' => 'We have received your order and it has been confirmed.',
            'location' => 'Harrow Mobiles HQ',
            'updated_by' => null,
            'tracking_date' => now()->subHours(2),
            'is_customer_notified' => true,
        ]);
    }
}
