<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $fillable = [
        'file', // migration uses 'file' to store image/video path
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function translations()
    {
        return $this->hasMany(HomeSliderTranslation::class, 'home_sliders', 'id');
    }

    public function translation($locale)
    {
        return $this->hasOne(HomeSliderTranslation::class, 'home_sliders', 'id')
                    ->where('locale', $locale);
    }
}
