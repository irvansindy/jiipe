<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];
    public function translations()
    {
        return $this->hasMany(GalleryTranslations::class);
    }
    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
