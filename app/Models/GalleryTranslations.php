<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryTranslations extends Model
{
    protected $table = "gallery_translations";
    protected $fillable = [
        'gallery_id',
        'locale',
        'title',
        'sub_title',
        'sub_title_2',
        'content'
    ];
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
