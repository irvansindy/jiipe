<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsVisionMisionTranslation extends Model
{
    protected $table = "about_us_vision_mision_translations";
    protected $fillable = [
        'about_us_vision_mision_id',
        'locale',
        'title',
        'vision',
        'mission',
    ];
}
