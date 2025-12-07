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
    ];

    protected $casts = [
        'home_sliders' => 'integer',
    ];

    /**
     * Get the slider that owns the translation
     */
    public function slider()
    {
        return $this->belongsTo(HomeSlider::class, 'home_sliders', 'id');
    }

    /**
     * Scope for active translations only
     */
    /**
     * Scope for specific locale
     */
    public function scopeForLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }
}
