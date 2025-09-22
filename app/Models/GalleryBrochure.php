<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryBrochure extends Model
{
    protected $fillable = [
        'image',
        'is_active',
        'date_input',
        'date_update',
        'created_by',
        'updated_by',
        'writer',
    ];
    public function translations()
    {
        return $this->hasMany(GalleryBrochuresTranslations::class, 'gallery_brochure_id', 'id');
    }
}
