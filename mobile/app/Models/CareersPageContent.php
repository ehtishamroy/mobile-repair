<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareersPageContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'why_join_badge',
        'why_join_title',
        'why_join_description',
        'why_join_items',
        'open_positions_badge',
        'open_positions_title',
        'open_positions_description',
        'job_positions',
        'benefits_badge',
        'benefits_title',
        'benefits_items',
        'how_to_apply_badge',
        'how_to_apply_title',
        'how_to_apply_description',
        'application_steps',
        'contact_badge',
        'contact_title',
        'contact_description',
        'contact_email',
        'contact_button_text',
    ];

    protected $casts = [
        'why_join_items' => 'array',
        'job_positions' => 'array',
        'benefits_items' => 'array',
        'application_steps' => 'array',
    ];

    /**
     * Get the first (and only) careers page content record or create one if it doesn't exist.
     */
    public static function getContent()
    {
        return static::first() ?? static::create();
    }
}
