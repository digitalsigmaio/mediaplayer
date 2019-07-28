<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return 'https://www.youtube.com/embed/' . $this->id;
    }
}