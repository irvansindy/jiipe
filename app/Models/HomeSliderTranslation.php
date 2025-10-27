<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSliderTranslation extends Model
{
    protected $fillable = [
        'home_sliders',
        'locale',
        'title',
        'description',
        'is_active',
    ];
    public function slider()
    {
        return $this->belongsTo(HomeSlider::class, 'home_sliders', 'id');
    }
}
