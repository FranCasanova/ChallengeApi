<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satellite extends Model
{
    use HasFactory;
    
    protected $cast = [
        'position_x' => 'float', 
        'position_y' => 'float', 
    ];

    protected $fillable = [
        'name',
        'position_x', 
        'position_y', 
    ];
}
