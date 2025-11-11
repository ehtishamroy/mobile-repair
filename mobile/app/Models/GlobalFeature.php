<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalFeature extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'order',
        'is_active',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get active global features ordered by display order
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get();
    }
}

