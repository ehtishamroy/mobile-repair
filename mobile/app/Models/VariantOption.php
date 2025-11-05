<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{
    protected $fillable = [
        'product_variant_id',
        'value',
        'color_code',
        'image',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
