<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Status extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = [
        'name',
        'description',
        'color',
        'is_active',
    ];
}
