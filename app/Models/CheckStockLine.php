<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CheckStockLine extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'check_stock_id',
        'quantity',
        'price',
        'cost_price',
        'description',
        'is_active',
    ];
}
