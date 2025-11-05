<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantValue extends Model
{
    protected $fillable = [
        'product_id',
        'variant_combination',
        'price',
        'compare_at_price',
        'quantity',
        'sku',
    ];

    protected $casts = [
        'variant_combination' => 'array',
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
