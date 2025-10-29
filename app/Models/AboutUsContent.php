<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContent extends Model
{
    protected $table = "about_us_contents";
    protected $fillable = [
        "about_us_header_id",
        "image",
        "video_url",
    ];
    public function translations()
    {
        return $this->hasMany(AboutUsContentTranslation::class, 'about_us_content_id', 'id');
    }
}
