<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $fillable = ['news_id', 'locale', 'title', 'content', 'quote'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
