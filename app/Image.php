<?php

namespace App;

use Digitalsigma\ImageUploader\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use ImageUploader;
}
