<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'product_code',
        'price',
        'cost_price',
        'pics',
        'unit_id',
        'is_active',
    ];
}
