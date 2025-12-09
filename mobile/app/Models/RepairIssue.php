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
        return $this->belongsTo(RepairService::class, 'repair_service_id');
    }

    public function pricings()
    {
        return $this->hasMany(RepairPricing::class);
    }

    public function deviceAvailability()
    {
        return $this->hasMany(RepairDeviceIssueAvailability::class, 'repair_issue_id');
    }

    /**
     * Check if this issue is available for a specific device
     */
    public function availableForDevice($deviceTypeId)
    {
        $availability = $this->deviceAvailability()
            ->where('repair_device_type_id', $deviceTypeId)
            ->first();

        // If no record exists, assume available (backward compatibility)
        if (!$availability) {
            return true;
        }

        return $availability->is_available;
    }
}
