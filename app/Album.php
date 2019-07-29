<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\Imageable\Traits\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use Imageable, SoftDeletes, RecordActivity;

    protected $fillable = ['title', 'year', 'image'];

    protected $appends = ['img'];

    /**
     * @return string
     */
    public function getImgAttribute()
    {
        return self::getImageUrl($this->image);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function editPath()
    {
        return route('albums.edit', $this);
    }
}
