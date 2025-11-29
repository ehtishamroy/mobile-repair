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
        // Create categories
        $mobileCategory = Category::firstOrCreate(
            ['slug' => 'smartphones'],
            [
                'name' => 'Smartphones',
                'description' => 'Latest smartphones and mobile devices.',
                'is_active' => true,
            ]
        );

        $laptopCategory = Category::firstOrCreate(
            ['slug' => 'laptops'],
            [
                'name' => 'Laptops',
                'description' => 'Portable computers and laptops.',
                'is_active' => true,
            ]
        );

        $accessoriesCategory = Category::firstOrCreate(
            ['slug' => 'accessories'],
            [
                'name' => 'Accessories',
                'description' => 'Phones and computer accessories.',
                'is_active' => true,
            ]
        );

        // Create brands
        $brands = [
            'apple' => Brand::firstOrCreate(
                ['slug' => 'apple'],
                ['name' => 'Apple', 'description' => 'Premium technology brand', 'is_active' => true]
            ),
            'samsung' => Brand::firstOrCreate(
                ['slug' => 'samsung'],
                ['name' => 'Samsung', 'description' => 'Electronics manufacturer', 'is_active' => true]
            ),
            'dell' => Brand::firstOrCreate(
                ['slug' => 'dell'],
                ['name' => 'Dell', 'description' => 'Computer hardware manufacturer', 'is_active' => true]
            ),
            'hp' => Brand::firstOrCreate(
                ['slug' => 'hp'],
                ['name' => 'HP', 'description' => 'Technology company', 'is_active' => true]
            ),
            'lenovo' => Brand::firstOrCreate(
                ['slug' => 'lenovo'],
                ['name' => 'Lenovo', 'description' => 'PC and laptop manufacturer', 'is_active' => true]
            ),
            'sony' => Brand::firstOrCreate(
                ['slug' => 'sony'],
                ['name' => 'Sony', 'description' => 'Electronics and entertainment', 'is_active' => true]
            ),
        ];

        // Define products
        $productsData = [
            [
                'name' => 'iPhone 15 Pro Max',
                'slug' => 'iphone-15-pro-max',
                'sku' => 'IPHONE15PM',
                'category' => $mobileCategory,
                'brand' => $brands['apple'],
                'description' => 'Latest flagship iPhone with advanced camera and display.',
                'price' => 1199.99,
                'quantity' => 30,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'slug' => 'samsung-galaxy-s24-ultra',
                'sku' => 'SGS24ULTRA',
                'category' => $mobileCategory,
                'brand' => $brands['samsung'],
                'description' => 'Powerful Android flagship with 200MP camera.',
                'price' => 1299.99,
                'quantity' => 25,
            ],
            [
                'name' => 'Samsung Galaxy A54',
                'slug' => 'samsung-galaxy-a54',
                'sku' => 'SGS24A54',
                'category' => $mobileCategory,
                'brand' => $brands['samsung'],
                'description' => 'Mid-range Android smartphone with excellent battery life.',
                'price' => 449.99,
                'quantity' => 40,
            ],
            [
                'name' => 'Apple MacBook Pro 16"',
                'slug' => 'macbook-pro-16',
                'sku' => 'MBP16M3',
                'category' => $laptopCategory,
                'brand' => $brands['apple'],
                'description' => 'Powerful laptop with Apple M3 Max chip for professionals.',
                'price' => 2499.99,
                'quantity' => 15,
            ],
            [
                'name' => 'Dell XPS 15',
                'slug' => 'dell-xps-15',
                'sku' => 'DELLXPS15',
                'category' => $laptopCategory,
                'brand' => $brands['dell'],
                'description' => 'Premium Windows laptop with stunning OLED display.',
                'price' => 1899.99,
                'quantity' => 20,
            ],
            [
                'name' => 'HP Pavilion 15',
                'slug' => 'hp-pavilion-15',
                'sku' => 'HPPAV15',
                'category' => $laptopCategory,
                'brand' => $brands['hp'],
                'description' => 'Affordable everyday laptop for home and office use.',
                'price' => 599.99,
                'quantity' => 35,
            ],
            [
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'slug' => 'lenovo-thinkpad-x1-carbon',
                'sku' => 'LPTP-X1C',
                'category' => $laptopCategory,
                'brand' => $brands['lenovo'],
                'description' => 'Business ultrabook with exceptional durability and performance.',
                'price' => 1599.99,
                'quantity' => 18,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'slug' => 'sony-wh-1000xm5',
                'sku' => 'SONYWH1000',
                'category' => $accessoriesCategory,
                'brand' => $brands['sony'],
                'description' => 'Premium noise-cancelling wireless headphones.',
                'price' => 399.99,
                'quantity' => 50,
            ],
            [
                'name' => 'Apple AirPods Pro Max',
                'slug' => 'airpods-pro-max',
                'sku' => 'AIRPODS-PM',
                'category' => $accessoriesCategory,
                'brand' => $brands['apple'],
                'description' => 'Premium over-ear spatial audio headphones.',
                'price' => 549.99,
                'quantity' => 22,
            ],
            [
                'name' => 'Samsung 65" QLED TV',
                'slug' => 'samsung-qled-65',
                'sku' => 'SGQLED65',
                'category' => $accessoriesCategory,
                'brand' => $brands['samsung'],
                'description' => '4K QLED television with quantum dot technology.',
                'price' => 1699.99,
                'quantity' => 12,
            ],
        ];

        // Create all products
        $products = [];
        foreach ($productsData as $productData) {
            $product = Product::firstOrCreate(
                ['slug' => $productData['slug']],
                [
                    'name' => $productData['name'],
                    'sku' => $productData['sku'],
                    'category_id' => $productData['category']->id,
                    'brand_id' => $productData['brand']->id,
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'quantity' => $productData['quantity'],
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
                    'quantity' => $productData['quantity'],
                    'has_color_variant' => true,
                ]);
            }

            $products[] = $product;
        }

        // Use the first product for the rest of the seeding
        $product = $products[0];

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
