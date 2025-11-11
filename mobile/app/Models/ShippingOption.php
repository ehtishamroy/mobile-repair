<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    protected $fillable = [
        'name',
        'description',
        'cost',
        'order',
        'is_active',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get active shipping options ordered by display order
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get();
    }
}

