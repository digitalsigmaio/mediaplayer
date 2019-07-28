<?php

namespace App;

use App\Traits\AudioUploader;
use App\Traits\RecordActivity;
use App\Traits\RecordViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    use AudioUploader, SoftDeletes, RecordViews, RecordActivity;

    protected $with = ['album'];

    protected $fillable = ['title', 'album_id', 'url', 'ringtone_url', 'vodafone', 'orange', 'etisalat'];

    protected $appends = ['audio', 'ringtone'];

    public function album()
    {
        return $this->belongsTo(Album::class)->select(['id', 'title', 'year', 'image']);
    }

    public function getAudioAttribute()
    {
        return $this->getAudioUrl($this->url);
    }

    public function getRingtoneAttribute()
    {
        return $this->getAudioUrl($this->ringtone_url);
    }
}
