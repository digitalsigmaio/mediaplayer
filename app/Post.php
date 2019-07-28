<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use ImageUploader, SoftDeletes, RecordActivity;

    protected $appends = ['img'];

    public function getImgAttribute()
    {
        return $this->getImageUrl($this->image);
    }
}
