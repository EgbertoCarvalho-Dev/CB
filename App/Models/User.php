<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'name', 'email', 'pass', 'level', 'created_at', 'updated_at'
    ];
}
