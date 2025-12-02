<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RepairOrder extends Model
{
    protected $fillable = [
        'order_number',
        'repair_service_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'repair_device_type_id',
        'device_model',
        'selected_issues',
        'issue_description',
        'delivery_method',
        'payment_method',
        'payment_intent_id',
        'paypal_order_id',
        'status',
        'subtotal',
        'inspection_fee',
        'total',
        'address',
        'repair_quality_tier_id',
    ];

    protected $casts = [
        'selected_issues' => 'array',
        'subtotal' => 'decimal:2',
        'inspection_fee' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'REP-' . strtoupper(Str::random(8)) . '-' . date('Ymd');
            }
        });
    }

    public function service()
    {
        return $this->belongsTo(RepairService::class, 'repair_service_id');
    }

    public function deviceType()
    {
        return $this->belongsTo(RepairDeviceType::class, 'repair_device_type_id');
    }

    public function qualityTier()
    {
        return $this->belongsTo(RepairQualityTier::class, 'repair_quality_tier_id');
    }
}
