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
}
