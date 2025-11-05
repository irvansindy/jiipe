<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewTranslation extends Model
{
    protected $table = "review_translations";
    protected $fillable = [
        'review_id',
        'locale',
        'description',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}