<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinPageContent extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_description',
        'our_team_badge',
        'our_team_title',
        'our_team_description',
        'our_team_features',
        'meet_team_badge',
        'meet_team_title',
        'team_members',
        'join_us_badge',
        'join_us_title',
        'join_us_description',
        'join_us_button_text',
    ];

    protected $casts = [
        'our_team_features' => 'array',
        'team_members' => 'array',
    ];

    /**
     * Get the first (and only) join page content record or create one if it doesn't exist.
     */
    public static function getContent()
    {
        return static::first() ?? static::create();
    }
}
