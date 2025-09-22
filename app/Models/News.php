<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['category_id', 'thumbnail', 'is_published'];

    public function translations()
    {
        return $this->hasMany(NewsTranslation::class);
    }

    public function category()
    {
        return $this->belongsTo(NewsCategories::class, 'category_id');
    }
    public function getThumbnailUrlAttribute()
    {
        return asset('storage/' . $this->thumbnail);
    }
}