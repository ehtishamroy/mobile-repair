<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'who_we_are_badge',
        'who_we_are_title',
        'who_we_are_description',
        'who_we_are_stat_number',
        'who_we_are_stat_label',
        'who_we_are_warranty_title',
        'who_we_are_warranty_description',
        'feature_title',
        'feature_items',
        'customer_satisfaction_badge',
        'customer_satisfaction_title',
        'customer_satisfaction_items',
        'quality_repairs_badge',
        'quality_repairs_title',
        'quality_repairs_stats',
        'why_choose_us_badge',
        'why_choose_us_title',
        'why_choose_us_items',
    ];

    protected $casts = [
        'feature_items' => 'array',
        'customer_satisfaction_items' => 'array',
        'quality_repairs_stats' => 'array',
        'why_choose_us_items' => 'array',
    ];

    /**
     * Get the first (and only) about page content record or create one if it doesn't exist.
     */
    public static function getContent()
    {
        return static::first() ?? static::create();
    }
}
