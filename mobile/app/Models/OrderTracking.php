<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'title',
        'message',
        'location',
        'updated_by',
        'tracking_date',
        'is_customer_notified',
    ];

    protected $casts = [
        'tracking_date' => 'datetime',
        'is_customer_notified' => 'boolean',
    ];

    protected $table = 'order_tracking';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'processing' => 'primary',
            'shipped' => 'success',
            'delivered' => 'success',
            'cancelled' => 'danger',
            'refunded' => 'secondary',
            default => 'secondary',
        };
    }
}
