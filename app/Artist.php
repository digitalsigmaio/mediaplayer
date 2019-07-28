<?php

namespace App;

use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use ImageUploader;

    protected $table = 'artist';

    public $timestamps = false;

    protected $fillable = ['name', 'about', 'image'];

    protected $appends = ['img'];

    /**
     * @return string
     */
    public function getImgAttribute()
    {
        return $this->getImageUrl($this->image);
    }
}
