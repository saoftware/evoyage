<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    use HasFactory;

    protected $fillable = [
        'prix',
        'forfait_aller_retour',
        'user_id',
        'convoi_id'
    ];
    
}