<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    protected $table='championships';
    protected $fillable = [
        'name'
    ];
}
