<?php

namespace App;

use App\Traits\AudioUploader;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use AudioUploader;
}
