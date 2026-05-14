<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'restock' => 'Restock',
            'return' => 'Customer Return',
            'reduce' => 'Stock Out',
            'damage' => 'Damaged',
            'expired' => 'Expired',
            'set' => 'Stock Correction',
            default => ucfirst($this->type),
        };
    }

    public function getBadgeClassAttribute(): string
    {
        if ($this->quantity_delta > 0) {
            return 'badge-green';
        }

        if ($this->quantity_delta < 0) {
            return 'badge-red';
        }

        return 'badge-gray';
    }
}
