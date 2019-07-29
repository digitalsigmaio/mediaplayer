<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\Imageable\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Imageable, SoftDeletes, RecordActivity;

    protected $appends = ['img'];

    public function getImgAttribute()
    {
        return self::getImageUrl($this->image);
    }
}
