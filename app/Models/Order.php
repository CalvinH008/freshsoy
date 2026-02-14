<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ═══════════════════════════════════════════════════
    // QUERY SCOPES (Reusable Filters)
    // ═══════════════════════════════════════════════════

    // filter order yang pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // filter order yang complete
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // filter order yang cancel
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // Filter by status yang dynamic
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
