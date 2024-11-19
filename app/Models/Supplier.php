<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supplier extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'mobile_bo',
        'avatar',
        'vat',
        'is_active',
    ];
}
