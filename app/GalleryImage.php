<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryImage extends Model
{
    use ImageUploader, SoftDeletes, RecordActivity;

    protected $appends = ['img'];
    /**
     * @return string
     */
    public function getImgAttribute(): string
    {
        return $this->getImageUrl($this->url);
    }
}
