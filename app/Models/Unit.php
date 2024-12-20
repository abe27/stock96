<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Unit extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = ['name', 'description', 'conversion_rate', 'color', 'is_active'];
}
