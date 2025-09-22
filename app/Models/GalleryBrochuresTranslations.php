<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryBrochuresTranslations extends Model
{
    protected $fillable = [
        'gallery_brochure_id',
        'locale',
        'title',
        'sub_title',
        'file'
    ];
}
