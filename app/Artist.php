<?php

namespace App;

use Digitalsigma\Imageable\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use Imageable;

    protected $table = 'artist';

    public $timestamps = false;

    protected $fillable = ['name', 'about', 'image'];

    protected $appends = ['img'];

    /**
     * @return string
     */
    public function getImgAttribute()
    {
        return self::getImageUrl($this->image);
    }
}
