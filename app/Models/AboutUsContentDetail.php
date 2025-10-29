<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContentDetail extends Model
{
    protected $fillable = [
        'icon',
        'category_id',
    ];

    public function translations()
    {
        return $this->hasMany(AboutUsContentDetailTranslation::class, 'about_us_content_detail_id','id');
    }
}
