<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StoreName extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'currency_id',
        'name',
        'description',
        'address_1',
        'address_2',
        'phone_number',
        'email',
        'website',
        'logo',
        'is_active',
    ];
}
