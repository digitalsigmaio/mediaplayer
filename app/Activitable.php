<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitable extends Model
{
    protected $fillable = ['admin_id', 'type'];

    public function activitable()
    {
        return $this->morphTo();
    }
}
