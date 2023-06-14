<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    protected $fillable = [
        'car', 'supplier', 'startpost', 'endpost', 'item', 'total', 'manager', 'responsible', 'observation', 'type', 'attribute', 'created_at', 'updated_at'
    ];
}
