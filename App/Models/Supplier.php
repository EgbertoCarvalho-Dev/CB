<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $fillable = [
        'name', 'cpfcnpj', 'address', 'uf', 'city', 'tel', 'observation', 'created_at', 'updated_at'
    ];
}
