<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequentlyAskedQuestions extends Model
{
    protected $fillable = [
        'is_active',
        'position'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position' => 'integer',
    ];

    /**
     * Get all translations
     */
    public function translations()
    {
        return $this->hasMany(FrequentlyAskedQuestionsTranslation::class, 'faq_id');
    }

    /**
     * Get translation by locale
     */
    public function translation(string $locale)
    {
        return $this->hasOne(FrequentlyAskedQuestionsTranslation::class, 'faq_id')
                    ->where('locale', $locale);
    }

    /**
     * Scope for active FAQs only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering by position
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('position', 'asc');
    }
}