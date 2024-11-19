<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CheckStock extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'no',
        'check_date',
        'quantity',
        'price',
        'cost_price',
        'description',
        'check_by_id',
        'is_active',
    ];
}
