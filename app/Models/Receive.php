<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Receive extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'no',
        'tax_no',
        'supplier_id',
        'received_on',
        'qty',
        'cost_price',
        'receive_by_id',
        'is_active',
    ];
}
