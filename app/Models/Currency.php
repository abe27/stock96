<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Currency extends Model
{
    use HasFactory, Notifiable, Uuid;

    protected $fillable = ['name', 'description', 'rate', 'symbol', 'flag', 'is_active'];
}
