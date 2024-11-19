<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderLine extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'order_id',
        'product_id',
        'unit_id',
        'qty',
        'price',
        'cost_price',
        'is_active',
    ];
}
