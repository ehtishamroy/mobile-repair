<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairDeviceType extends Model
{
    protected $fillable = [
        'repair_service_id',
        'repair_brand_id',
        'name',
        'brand', // Keep for backward compatibility
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function service()
    {
        return $this->belongsTo(RepairService::class, 'repair_service_id');
    }

    public function repairBrand()
    {
        return $this->belongsTo(RepairBrand::class, 'repair_brand_id');
    }

    // Alias for backward compatibility
    public function getBrandRelationAttribute()
    {
        return $this->repairBrand;
    }

    public function pricings()
    {
        return $this->hasMany(RepairPricing::class);
    }

    public function issueAvailability()
    {
        return $this->hasMany(RepairDeviceIssueAvailability::class, 'repair_device_type_id');
    }

    /**
     * Get available issues for this device
     */
    public function availableIssues()
    {
        return $this->service->issues()
            ->where('is_active', true)
            ->whereHas('deviceAvailability', function ($query) {
                $query->where('repair_device_type_id', $this->id)
                    ->where('is_available', true);
            });
    }
}
