<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";
    protected $fillable = [
        'photo',
        'name',
        'position',
        'is_active',
    ];

    public function translations()
    {
        return $this->hasMany(ReviewTranslation::class);
    }

    public function translation($locale)
    {
        return $this->hasOne(ReviewTranslation::class)
                    ->where('locale', $locale);
    }
}