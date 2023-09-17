<?php


namespace App\Modules\Common\Support;


class Media extends \Spatie\MediaLibrary\Models\Media
{
    public function getUrlAttribute()
    {
        return $this->getFullUrl();
    }
}
