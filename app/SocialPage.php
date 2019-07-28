<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;

class SocialPage extends Model
{
    use ImageUploader, RecordActivity;

    public $timestamps = false;

    protected $appends = ['img'];

    public function getImgAttribute()
    {
        return $this->getImageUrl($this->icon);
    }
}
