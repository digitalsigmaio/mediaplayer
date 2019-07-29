<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\Imageable\Traits\Imageable;
use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;

class SocialPage extends Model
{
    use Imageable, RecordActivity;

    public $timestamps = false;

    protected $appends = ['img'];

    public function getImgAttribute()
    {
        return self::getImageUrl($this->icon);
    }
}
