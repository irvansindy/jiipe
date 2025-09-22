<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategoriesTranslation extends Model
{
    protected $fillable = ['news_category_id', 'locale', 'name'];
}
