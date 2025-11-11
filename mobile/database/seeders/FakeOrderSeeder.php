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
use App\Models\ProductReview;
use App\Models\ProductVariant;
use App\Models\VariantOption;
use App\Models\ProductVariantValue;

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
                'price' => 259.99,
                'quantity' => 50,
                'availability' => 'in_stock',
                'is_featured' => false,
                'is_best_deal' => false,
                'is_hot_product' => false,
                'has_color_variant' => true,
                'is_active' => true,
            ]
        );

        if (!$product->wasRecentlyCreated) {
            $product->update([
                'quantity' => 50,
                'has_color_variant' => true,
            ]);
        }

        // Reset existing variants/options for the sample product
        $product->variants()->each(function ($variant) {
            $variant->options()->delete();
            $variant->delete();
        });
        $product->variantValues()->delete();

        // Create product variants
        $colorVariant = ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Color',
            'type' => 'color',
            'order' => 0,
        ]);

        $storageVariant = ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Storage',
            'type' => 'select',
            'order' => 1,
        ]);

        // Variant options
        $midnightBlack = VariantOption::create([
            'product_variant_id' => $colorVariant->id,
            'value' => 'Midnight Black',
            'color_code' => '#0A0A0A',
            'order' => 0,
        ]);

        $starlightWhite = VariantOption::create([
            'product_variant_id' => $colorVariant->id,
            'value' => 'Starlight White',
            'color_code' => '#F7F7F7',
            'order' => 1,
        ]);

        $storage128 = VariantOption::create([
            'product_variant_id' => $storageVariant->id,
            'value' => '128GB',
            'order' => 0,
        ]);

        $storage256 = VariantOption::create([
            'product_variant_id' => $storageVariant->id,
            'value' => '256GB',
            'order' => 1,
        ]);

        // Variant value combinations
        $primaryCombination = [
            'Color' => $midnightBlack->value,
            'Storage' => $storage128->value,
        ];

        ProductVariantValue::create([
            'product_id' => $product->id,
            'variant_combination' => $primaryCombination,
            'price' => 259.99,
            'compare_at_price' => 279.99,
            'quantity' => 20,
            'sku' => 'SAMPLE-BLK-128',
        ]);

        ProductVariantValue::create([
            'product_id' => $product->id,
            'variant_combination' => [
                'Color' => $starlightWhite->value,
                'Storage' => $storage256->value,
            ],
            'price' => 299.99,
            'compare_at_price' => 329.99,
            'quantity' => 15,
            'sku' => 'SAMPLE-WHT-256',
        ]);

        if ($product->reviews()->count() === 0) {
            $sampleReviews = [
                [
                    'reviewer_name' => 'Ava Johnson',
                    'reviewer_email' => 'ava@example.com',
                    'rating' => 5,
                    'title' => 'Excellent quality!',
                    'comment' => 'The product exceeded my expectations. Great build quality and sleek design.',
                ],
                [
                    'reviewer_name' => 'Noah Williams',
                    'reviewer_email' => 'noah@example.com',
                    'rating' => 4,
                    'title' => 'Works as expected',
                    'comment' => 'Overall a solid purchase. Delivery was quick and the product matches the description.',
                ],
                [
                    'reviewer_name' => 'Mia Brown',
                    'reviewer_email' => 'mia@example.com',
                    'rating' => 5,
                    'title' => 'Value for money',
                    'comment' => 'Fantastic value! The performance is impressive considering the price point.',
                ],
            ];

            foreach ($sampleReviews as $review) {
                ProductReview::create(array_merge($review, [
                    'product_id' => $product->id,
                    'is_approved' => true,
                ]));
            }
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
            'subtotal' => 259.99,
            'tax' => 12.50,
            'shipping_cost' => 5.00,
            'discount' => 0,
            'total' => 277.49,
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
            'product_sku' => 'SAMPLE-BLK-128',
            'price' => 259.99,
            'quantity' => 1,
            'subtotal' => 259.99,
            'variant_data' => $primaryCombination,
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
