<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RepairService extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
        });
    }

    public function deviceTypes()
    {
        return $this->hasMany(RepairDeviceType::class)->orderBy('order');
    }

    public function issues()
    {
        return $this->hasMany(RepairIssue::class)->orderBy('order');
    }

    public function pricings()
    {
        return $this->hasMany(RepairPricing::class);
    }
}
