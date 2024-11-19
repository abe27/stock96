<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Stock extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'category_id',
        'product_id',
        'unit_id',
        'quantity',
        'price',
        'cost_price',
        'description',
        'min_qty',
        'max_qty',
        'safety_stock',
        'adjust_by_id',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function adjustBy()
    {
        return $this->belongsTo(User::class, 'adjust_by_id', 'id');
    }
}
