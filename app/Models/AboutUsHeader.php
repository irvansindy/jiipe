<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsHeader extends Model
{
    protected $table = "about_us_headers";
    protected $fillable = ['image'];
    public function translations()
    {
        return $this->hasMany(AboutUsHeaderTranslation::class, 'about_us_header_id', 'id');
    }

    // Return full public URL for the stored image filename
    public function getImageUrlAttribute()
    {
        if (! $this->image) return null;
        return asset('uploads/about-us/header/' . $this->image);
    }
}
