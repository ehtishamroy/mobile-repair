<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tag;
use App\Models\ProductVariant;
use App\Models\VariantOption;
use App\Models\ProductVariantValue;
use App\Models\ProductFeature;
use App\Models\ProductGalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        $tags = Tag::all();
        return view('admin.products.create', compact('categories', 'brands', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'sku' => 'required|string|max:255|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'additional_information' => 'nullable|string',
            'specifications' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'availability' => 'required|in:in_stock,out_of_stock,pre_order',
            'is_featured' => 'boolean',
            'is_best_deal' => 'boolean',
            'is_hot_product' => 'boolean',
            'has_color_variant' => 'boolean',
            'is_active' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        DB::beginTransaction();
        try {
            // Handle featured image
            if ($request->hasFile('featured_image')) {
                $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
            }

            // Handle tags
            $tags = $validated['tags'] ?? [];
            unset($validated['tags']);

            // Create product
            $product = Product::create($validated);

            // Attach tags
            if (!empty($tags)) {
                $product->tags()->attach($tags);
            }

            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $image) {
                    ProductGalleryImage::create([
                        'product_id' => $product->id,
                        'image' => $image->store('products/gallery', 'public'),
                        'order' => $index,
                    ]);
                }
            }

            // Handle variants
            $this->handleVariants($product, $request);

            // Handle features
            $this->handleFeatures($product, $request);

            DB::commit();
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Product created successfully.']);
            }
            
            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['message' => 'Error creating product: ' . $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => 'Error creating product: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(string $id)
    {
        $product = Product::with(['tags', 'variants.options', 'variantValues', 'features', 'galleryImages'])->findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();
        $tags = Tag::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'tags'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'additional_information' => 'nullable|string',
            'specifications' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'availability' => 'required|in:in_stock,out_of_stock,pre_order',
            'is_featured' => 'boolean',
            'is_best_deal' => 'boolean',
            'is_hot_product' => 'boolean',
            'has_color_variant' => 'boolean',
            'is_active' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        DB::beginTransaction();
        try {
            // Handle featured image
            if ($request->hasFile('featured_image')) {
                if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                    Storage::disk('public')->delete($product->featured_image);
                }
                $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
            } else {
                unset($validated['featured_image']);
            }

            // Handle tags
            $tags = $validated['tags'] ?? [];
            unset($validated['tags']);

            // Update product
            $product->update($validated);

            // Sync tags
            $product->tags()->sync($tags);

            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                $maxOrder = $product->galleryImages()->max('order') ?? -1;
                foreach ($request->file('gallery_images') as $index => $image) {
                    ProductGalleryImage::create([
                        'product_id' => $product->id,
                        'image' => $image->store('products/gallery', 'public'),
                        'order' => $maxOrder + $index + 1,
                    ]);
                }
            }

            // Handle variants
            $this->handleVariants($product, $request, true);

            // Handle features
            $this->handleFeatures($product, $request, true);

            DB::commit();
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Product updated successfully.']);
            }
            
            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['message' => 'Error updating product: ' . $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => 'Error updating product: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        DB::beginTransaction();
        try {
            // Delete featured image
            if ($product->featured_image && Storage::disk('public')->exists($product->featured_image)) {
                Storage::disk('public')->delete($product->featured_image);
            }

            // Delete gallery images
            foreach ($product->galleryImages as $galleryImage) {
                if (Storage::disk('public')->exists($galleryImage->image)) {
                    Storage::disk('public')->delete($galleryImage->image);
                }
            }

            $product->delete();
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error deleting product: ' . $e->getMessage()]);
        }
    }

    public function deleteGalleryImage(string $id)
    {
        $image = ProductGalleryImage::findOrFail($id);
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();
        return response()->json(['success' => true]);
    }

    private function handleVariants($product, $request, $isUpdate = false)
    {
        if ($isUpdate) {
            // Delete existing variants if requested
            if ($request->has('delete_variants')) {
                $variantIds = $request->input('delete_variants', []);
                ProductVariant::whereIn('id', $variantIds)->delete();
            }
        }

        // Handle new/updated variants
        if ($request->has('variants')) {
            $variants = $request->input('variants', []);
            
            foreach ($variants as $variantData) {
                if (isset($variantData['id'])) {
                    // Update existing variant
                    $variant = ProductVariant::find($variantData['id']);
                    if ($variant && $variant->product_id == $product->id) {
                        $variant->update([
                            'name' => $variantData['name'],
                            'type' => $variantData['type'] ?? 'select',
                            'order' => $variantData['order'] ?? 0,
                        ]);

                        // Handle variant options
                        if (isset($variantData['options'])) {
                            $this->handleVariantOptions($variant, $variantData['options']);
                        }
                    }
                } else {
                    // Create new variant
                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'name' => $variantData['name'],
                        'type' => $variantData['type'] ?? 'select',
                        'order' => $variantData['order'] ?? 0,
                    ]);

                    // Handle variant options
                    if (isset($variantData['options'])) {
                        $this->handleVariantOptions($variant, $variantData['options']);
                    }
                }
            }
        }

        // Handle variant values (combinations with pricing)
        if ($request->has('variant_values')) {
            $variantValues = $request->input('variant_values', []);
            
            if ($isUpdate) {
                $product->variantValues()->delete();
            }

            foreach ($variantValues as $valueData) {
                // Skip if combination is missing or empty
                if (empty($valueData['combination'])) {
                    continue;
                }
                
                // Parse combination if it's a JSON string
                $combination = null;
                if (is_string($valueData['combination'])) {
                    $decoded = json_decode($valueData['combination'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $combination = $decoded;
                    } else {
                        // Try to decode with HTML entities
                        $decoded = json_decode(html_entity_decode($valueData['combination']), true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $combination = $decoded;
                        } else {
                            continue; // Skip invalid combination
                        }
                    }
                } elseif (is_array($valueData['combination'])) {
                    $combination = $valueData['combination'];
                } else {
                    continue; // Skip invalid combination
                }
                
                // Parse values - convert empty strings to null for price fields
                $price = null;
                if (isset($valueData['price']) && $valueData['price'] !== '' && $valueData['price'] !== null) {
                    $price = (float) $valueData['price'];
                }
                
                $compareAtPrice = null;
                if (isset($valueData['compare_at_price']) && $valueData['compare_at_price'] !== '' && $valueData['compare_at_price'] !== null) {
                    $compareAtPrice = (float) $valueData['compare_at_price'];
                }
                
                $quantity = isset($valueData['quantity']) && $valueData['quantity'] !== '' 
                    ? (int) $valueData['quantity'] 
                    : 0;
                
                $sku = !empty($valueData['sku']) ? $valueData['sku'] : null;
                
                ProductVariantValue::create([
                    'product_id' => $product->id,
                    'variant_combination' => $combination,
                    'price' => $price,
                    'compare_at_price' => $compareAtPrice,
                    'quantity' => $quantity,
                    'sku' => $sku,
                ]);
            }
        }
    }

    private function handleVariantOptions($variant, $options)
    {
        // Delete existing options if updating
        if ($variant->exists) {
            VariantOption::where('product_variant_id', $variant->id)->delete();
        }

        foreach ($options as $optionData) {
            VariantOption::create([
                'product_variant_id' => $variant->id,
                'value' => $optionData['value'],
                'color_code' => $optionData['color_code'] ?? null,
                'image' => isset($optionData['image']) && is_file($optionData['image']) 
                    ? $optionData['image']->store('variants', 'public') 
                    : null,
                'order' => $optionData['order'] ?? 0,
            ]);
        }
    }

    private function handleFeatures($product, $request, $isUpdate = false)
    {
        if ($isUpdate && $request->has('delete_features')) {
            $featureIds = $request->input('delete_features', []);
            ProductFeature::whereIn('id', $featureIds)->delete();
        }

        if ($request->has('features')) {
            $features = $request->input('features', []);
            
            foreach ($features as $index => $featureData) {
                // Handle icon image upload
                $iconPath = null;
                if ($request->hasFile("features.{$index}.icon")) {
                    $iconPath = $request->file("features.{$index}.icon")->store('features', 'public');
                } elseif (isset($featureData['icon']) && is_string($featureData['icon']) && !empty($featureData['icon'])) {
                    // Keep existing icon if it's a string path
                    $iconPath = $featureData['icon'];
                }
                
                if (isset($featureData['id'])) {
                    // Update existing feature
                    $feature = ProductFeature::find($featureData['id']);
                    if ($feature && $feature->product_id == $product->id) {
                        $updateData = [
                            'title' => $featureData['title'],
                            'description' => $featureData['description'] ?? null,
                            'order' => $featureData['order'] ?? 0,
                        ];
                        
                        if ($iconPath !== null) {
                            // Delete old icon if new one is uploaded
                            if ($feature->icon && Storage::disk('public')->exists($feature->icon)) {
                                Storage::disk('public')->delete($feature->icon);
                            }
                            $updateData['icon'] = $iconPath;
                        }
                        
                        $feature->update($updateData);
                    }
                } else {
                    // Create new feature
                    ProductFeature::create([
                        'product_id' => $product->id,
                        'icon' => $iconPath,
                        'title' => $featureData['title'],
                        'description' => $featureData['description'] ?? null,
                        'order' => $featureData['order'] ?? 0,
                    ]);
                }
            }
        }
    }
}
