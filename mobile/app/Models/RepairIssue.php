<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairIssue extends Model
{
    protected $fillable = [
        'repair_service_id',
        'name',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(RepairService::class);
    }

    public function pricings()
    {
        return $this->hasMany(RepairPricing::class);
    }
}
