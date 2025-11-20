<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairPricing extends Model
{
    protected $fillable = [
        'repair_service_id',
        'repair_device_type_id',
        'repair_issue_id',
        'price',
        'is_inspection_fee',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_inspection_fee' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(RepairService::class);
    }

    public function deviceType()
    {
        return $this->belongsTo(RepairDeviceType::class);
    }

    public function issue()
    {
        return $this->belongsTo(RepairIssue::class);
    }
}
