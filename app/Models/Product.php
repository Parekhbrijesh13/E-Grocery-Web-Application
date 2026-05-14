<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'mrp' => 'decimal:2',
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'tax' => 'decimal:2',
        'unit_value' => 'decimal:2',
        'featured' => 'boolean',
        'cod' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function getStockBadgeAttribute(): array
    {
        if ($this->stock <= 0) {
            return ['label' => 'Out of Stock', 'class' => 'badge-red'];
        }

        if ($this->stock <= $this->low_stock_threshold) {
            return ['label' => 'Low Stock', 'class' => 'badge-orange'];
        }

        return match ($this->status) {
            'draft' => ['label' => 'Draft', 'class' => 'badge-gray'],
            'inactive' => ['label' => 'Inactive', 'class' => 'badge-gray'],
            default => ['label' => 'Active', 'class' => 'badge-green'],
        };
    }
}
