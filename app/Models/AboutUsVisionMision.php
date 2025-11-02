<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsVisionMision extends Model
{
    protected $table = "about_us_vision_misions";
    protected $fillable = [];

    public function translations()
    {
        return $this->hasMany(AboutUsVisionMisionTranslation::class, 'about_us_vision_mision_id', 'id');
    }
}
