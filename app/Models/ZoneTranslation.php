<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneTranslation extends Model
{
    protected $fillable = [
        'zone_id',
        'locale',
        'name',
        'subtitle',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'note'
    ];

    protected $casts = [
        'zone_id' => 'integer',
    ];

    /**
     * Get the zone that owns the translation
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    /**
     * Scope for specific locale
     */
    public function scopeForLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }
}