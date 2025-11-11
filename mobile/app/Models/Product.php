<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',
        'brand_id',
        'description',
        'additional_information',
        'specifications',
        'featured_image',
        'price',
        'compare_at_price',
        'quantity',
        'availability',
        'is_featured',
        'is_best_deal',
        'is_hot_product',
        'has_color_variant',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'quantity' => 'integer',
        'is_featured' => 'boolean',
        'is_best_deal' => 'boolean',
        'is_hot_product' => 'boolean',
        'has_color_variant' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function approvedReviews()
    {
        return $this->reviews()->where('is_approved', true);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('order');
    }

    public function variantValues()
    {
        return $this->hasMany(ProductVariantValue::class);
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class)->orderBy('order');
    }

    public function galleryImages()
    {
        return $this->hasMany(ProductGalleryImage::class)->orderBy('order');
    }
}
