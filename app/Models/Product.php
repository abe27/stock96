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
        'color',
        'is_active',
    ];

    public function getProfitAttribute()
    {
        return $this->price - $this->cost_price;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
