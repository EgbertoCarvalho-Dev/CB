<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $fillable = [
        'name', 'placa', 'created_at', 'updated_at'
    ];
}
