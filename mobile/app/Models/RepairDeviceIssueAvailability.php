<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairDeviceIssueAvailability extends Model
{
    protected $table = 'repair_device_issue_availability';

    protected $fillable = [
        'repair_device_type_id',
        'repair_issue_id',
        'is_available',
        'requires_quality_tier',
        'base_price',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'requires_quality_tier' => 'boolean',
        'base_price' => 'decimal:2',
    ];

    public function deviceType()
    {
        return $this->belongsTo(RepairDeviceType::class, 'repair_device_type_id');
    }

    public function issue()
    {
        return $this->belongsTo(RepairIssue::class, 'repair_issue_id');
    }
}
