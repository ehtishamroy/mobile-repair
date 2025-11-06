<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model
{
    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_description',
        'hero_button_text',
        'who_we_are_badge',
        'who_we_are_title',
        'who_we_are_description',
        'who_we_are_stat_number',
        'who_we_are_stat_label',
        'who_we_are_warranty_title',
        'who_we_are_warranty_description',
        'feature_title',
        'feature_items',
        'what_we_offer_badge',
        'what_we_offer_title',
        'what_we_offer_description',
        'what_we_offer_button_text',
        'services',
        'hot_selling_badge',
        'hot_selling_title',
        'quality_repairs_badge',
        'quality_repairs_title',
        'quality_repairs_stats',
        'why_choose_us_badge',
        'why_choose_us_title',
        'why_choose_us_items',
        'accessories_badge',
        'accessories_title',
    ];

    protected $casts = [
        'feature_items' => 'array',
        'services' => 'array',
        'quality_repairs_stats' => 'array',
        'why_choose_us_items' => 'array',
    ];

    /**
     * Get the first (and only) homepage content record or create one if it doesn't exist.
     */
    public static function getContent()
    {
        return static::first() ?? static::create();
    }
}
