<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
 
    protected $fillable = [
        'symbol',
        'description',
        'price',
        'prediction_date',
    ];
}
