<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Family extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table='family';
    protected $fillable = [
        'name','gender'
    ];
}
