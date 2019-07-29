<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\Imageable\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use Imageable, SoftDeletes, RecordActivity;

    protected $appends = ['img'];
    /**
     * @return string
     */
    public function getImgAttribute(): string
    {
        return self::getImageUrl($this->url);
    }
}
