<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RepairQualityTier extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_issue_id',
        'repair_device_type_id',
        'name',
        'price_modifier',
        'description',
        'is_default',
        'order',
        'is_active',
    ];

    protected $casts = [
        'price_modifier' => 'decimal:2',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function issue()
    {
        return $this->belongsTo(RepairIssue::class, 'repair_issue_id');
    }

    public function deviceType()
    {
        return $this->belongsTo(RepairDeviceType::class, 'repair_device_type_id');
    }
}
