<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategories extends Model
{
    protected $fillable = [];
    public function translations()
    {
        return $this->hasMany(NewsCategoriesTranslation::class, "news_category_id","id");
    }
}
