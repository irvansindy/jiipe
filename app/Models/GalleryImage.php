<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table = 'gallery_images';

    protected $fillable = [
        'gallery_id',
        'image',
    ];

    protected $casts = [
        'gallery_id' => 'integer',
    ];

    /**
     * Get the gallery that owns the image
     */
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('uploads/' . $this->image) : null;
    }
}