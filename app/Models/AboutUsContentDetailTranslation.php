<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContentDetailTranslation extends Model
{
    protected $fillable = [
        'about_us_content_detail_id',
        'locale',
        'title',
        'description',
    ];
}
