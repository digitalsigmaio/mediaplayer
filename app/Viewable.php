<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewable extends Model
{
    protected $fillable = ['user_id', 'user_ip', 'user_agent'];

    public function viewable()
    {
        return $this->morphTo();
    }
}
