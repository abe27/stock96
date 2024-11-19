<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'no',
        'customer_id',
        'order_on',
        'qty',
        'price',
        'cost_price',
        'status_id',
        'order_by_id',
        'is_active',
    ];
}
