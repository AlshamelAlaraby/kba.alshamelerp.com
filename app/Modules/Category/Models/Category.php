<?php

namespace App\Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Category extends Model implements HasMedia
{
    use HasMediaTrait;

    public $fillable = ['name'];

    public function cover()
    {
        return $this->morphOne(config('medialibrary.media_model'), 'model');
    }
}
