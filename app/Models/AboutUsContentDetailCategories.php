<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContentDetailCategories extends Model
{
    protected $fillable = [];
    public function translations()
    {
        return $this->hasMany(AboutUsContentDetailCategoriesTranslation::class, 'about_us_content_detail_category_id', 'id');
    }
}
