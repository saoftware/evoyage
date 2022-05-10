<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convoi extends Model
{
    use HasFactory;

    protected $fillable = [
        'villeDepart_id',
        'villeArrivee_id',
        'car_id',
        'horaire_id',
        'user_id'
    ];
    
}