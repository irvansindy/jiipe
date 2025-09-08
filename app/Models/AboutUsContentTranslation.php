<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContentTranslation extends Model
{
    protected $fillable = [
        'about_us_content_id',
        'locale',
        'title',
        'subtitle',
        'content',
    ];
}
