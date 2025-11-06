<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePageContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'what_we_offer_badge',
        'what_we_offer_title',
        'what_we_offer_description',
        'what_we_offer_button_text',
        'services',
    ];

    protected $casts = [
        'services' => 'array',
    ];

    /**
     * Get the first (and only) service page content record or create one if it doesn't exist.
     */
    public static function getContent()
    {
        return static::first() ?? static::create();
    }
}
