<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContentDetailCategoriesTranslation extends Model
{
    protected $fillable = [
        'about_us_content_detail_category_id',
        'locale',
        'name',
    ];
}