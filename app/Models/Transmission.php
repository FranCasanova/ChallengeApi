<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'satellite_name',
        'distance',
        'message'
    ];

    public function setMessageAttribute($value)
    {
        $this->attributes['message'] = json_encode($value);
    }

    public function getMessageAttribute($message)
    {
        return json_decode($message, true);
    }
}
