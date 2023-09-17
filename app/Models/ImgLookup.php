<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImgLookup extends Model
{
    protected $table='imglookups';
    protected $fillable = [
        'name'
    ];
}
