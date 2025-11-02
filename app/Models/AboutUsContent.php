<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContent extends Model
{
    protected $table = "about_us_contents";
    protected $fillable = [
        "image",
        "video_url",
    ];
    public function translations()
    {
        return $this->hasMany(AboutUsContentTranslation::class, 'about_us_content_id', 'id');
    }
}
