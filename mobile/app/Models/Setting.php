<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'website_name',
        'website_title',
        'website_description',
        'website_logo',
        'favicon',
        'promo_title',
        'currency',
        'currency_symbol',
        'facebook_url',
        'instagram_url',
        'tiktok_url',
        'youtube_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    /**
     * Get the first (and only) settings record or create one if it doesn't exist.
     */
    public static function getSettings()
    {
        return static::first() ?? static::create();
    }

    /**
     * Get currency symbol based on currency code
     */
    public function getCurrencySymbolAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        // Default based on currency code
        return match($this->currency ?? 'USD') {
            'GBP' => '£',
            'USD' => '$',
            default => '$',
        };
    }
}
