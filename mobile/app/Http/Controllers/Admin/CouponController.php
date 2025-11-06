<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::withCount('usages')->latest()->paginate(15);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        return view('admin.coupons.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code|regex:/^[A-Z0-9]+$/',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'minimum_purchase' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'applicable_to' => 'required|in:all,categories,products',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
            'is_active' => 'boolean',
        ]);

        // Validate percentage discount
        if ($validated['type'] === 'percentage' && $validated['value'] > 100) {
            return back()->withErrors(['value' => 'Percentage discount cannot exceed 100%'])->withInput();
        }

        // Validate applicable_to requirements
        if ($validated['applicable_to'] === 'categories' && empty($validated['category_ids'])) {
            return back()->withErrors(['category_ids' => 'Please select at least one category'])->withInput();
        }

        if ($validated['applicable_to'] === 'products' && empty($validated['product_ids'])) {
            return back()->withErrors(['product_ids' => 'Please select at least one product'])->withInput();
        }

        // Set default values
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['code'] = strtoupper($validated['code']);

        Coupon::create($validated);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        $products = Product::where('is_active', true)->get();
        return view('admin.coupons.edit', compact('coupon', 'categories', 'products'));
    }

    public function update(Request $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $id . '|regex:/^[A-Z0-9]+$/',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'minimum_purchase' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'applicable_to' => 'required|in:all,categories,products',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
            'is_active' => 'boolean',
        ]);

        // Validate percentage discount
        if ($validated['type'] === 'percentage' && $validated['value'] > 100) {
            return back()->withErrors(['value' => 'Percentage discount cannot exceed 100%'])->withInput();
        }

        // Validate applicable_to requirements
        if ($validated['applicable_to'] === 'categories' && empty($validated['category_ids'])) {
            return back()->withErrors(['category_ids' => 'Please select at least one category'])->withInput();
        }

        if ($validated['applicable_to'] === 'products' && empty($validated['product_ids'])) {
            return back()->withErrors(['product_ids' => 'Please select at least one product'])->withInput();
        }

        // Set default values
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['code'] = strtoupper($validated['code']);

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
