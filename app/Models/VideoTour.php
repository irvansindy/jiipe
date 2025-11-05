<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoTour extends Model
{
    protected $table = "video_tours";
    protected $fillable = ['embed_code', 'thumbnail', 'position', 'is_active'];
    public function translations()
    {
        return $this->hasMany(VideoTourTranslation::class, 'video_tour_id');
    }

}
