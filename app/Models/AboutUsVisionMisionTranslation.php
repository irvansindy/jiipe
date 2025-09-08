<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsVisionMisionTranslation extends Model
{
    protected $fillable = [
        'about_us_vision_mision_id',
        'locale',
        'title',
        'vision',
        'mision',
    ];
}
