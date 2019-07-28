<?php

namespace App;

use App\Traits\RecordActivity;
use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use ImageUploader, SoftDeletes, RecordActivity;

    protected $fillable = ['title', 'year', 'image'];

    protected $appends = ['img'];

    /**
     * @return string
     */
    public function getImgAttribute()
    {
        return $this->getImageUrl($this->image);
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
