<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'value',
        'minimum_purchase',
        'maximum_discount',
        'usage_limit',
        'usage_limit_per_user',
        'start_date',
        'end_date',
        'applicable_to',
        'category_ids',
        'product_ids',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'minimum_purchase' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'usage_limit' => 'integer',
        'usage_limit_per_user' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'category_ids' => 'array',
        'product_ids' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get all usages for this coupon
     */
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    /**
     * Get usages by a specific user
     */
    public function usagesByUser($userId)
    {
        return $this->usages()->where('user_id', $userId)->count();
    }

    /**
     * Get usages by email (for guest users)
     */
    public function usagesByEmail($email)
    {
        return $this->usages()->where('email', $email)->count();
    }

    /**
     * Get total usage count
     */
    public function getTotalUsageCountAttribute()
    {
        return $this->usages()->count();
    }

    /**
     * Check if coupon is currently valid
     */
    public function isValid()
    {
        $now = Carbon::now();
        
        // Check if active
        if (!$this->is_active) {
            return false;
        }
        
        // Check date range
        if ($now->lt($this->start_date) || $now->gt($this->end_date)) {
            return false;
        }
        
        // Check usage limit
        if ($this->usage_limit !== null && $this->total_usage_count >= $this->usage_limit) {
            return false;
        }
        
        return true;
    }

    /**
     * Check if coupon can be used by user
     */
    public function canBeUsedByUser($userId = null, $email = null)
    {
        if (!$this->isValid()) {
            return false;
        }
        
        // Check per-user limit
        if ($this->usage_limit_per_user !== null) {
            if ($userId) {
                if ($this->usagesByUser($userId) >= $this->usage_limit_per_user) {
                    return false;
                }
            } elseif ($email) {
                if ($this->usagesByEmail($email) >= $this->usage_limit_per_user) {
                    return false;
                }
            }
        }
        
        return true;
    }

    /**
     * Calculate discount amount for a given order total
     */
    public function calculateDiscount($orderTotal)
    {
        if ($orderTotal < $this->minimum_purchase) {
            return 0;
        }
        
        if ($this->type === 'percentage') {
            $discount = ($orderTotal * $this->value) / 100;
            
            // Apply maximum discount if set
            if ($this->maximum_discount !== null && $discount > $this->maximum_discount) {
                $discount = $this->maximum_discount;
            }
            
            return $discount;
        } else {
            // Fixed amount
            return min($this->value, $orderTotal);
        }
    }

    /**
     * Check if coupon is applicable to product
     */
    public function isApplicableToProduct($productId, $categoryId = null)
    {
        if ($this->applicable_to === 'all') {
            return true;
        }
        
        if ($this->applicable_to === 'products') {
            return in_array($productId, $this->product_ids ?? []);
        }
        
        if ($this->applicable_to === 'categories') {
            return in_array($categoryId, $this->category_ids ?? []);
        }
        
        return false;
    }
}
