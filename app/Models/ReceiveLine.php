<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReceiveLine extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'receive_id',
        'product_id',
        'unit_id',
        'qty',
        'cost_price',
        'is_active',
    ];
}
