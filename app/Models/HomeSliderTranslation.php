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

    protected $casts = [
        'is_active' => 'boolean',
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
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific locale
     */
    public function scopeForLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }
}