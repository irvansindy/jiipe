<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Zone extends Model
{
    protected $fillable = [
        'zone_class_id',
        'image'
    ];

    protected $casts = [
        'zone_class_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get zone class
     */
    public function zoneClass()
    {
        return $this->belongsTo(ZoneClass::class, 'zone_class_id');
    }

    /**
     * Get all translations
     */
    public function translations()
    {
        return $this->hasMany(ZoneTranslation::class, 'zone_id');
    }

    /**
     * Get clusters
     */
    public function clusters()
    {
        return $this->hasMany(ZoneCluster::class, 'zone_id');
    }

    /**
     * Get developments
     */
    public function developments()
    {
        return $this->hasMany(SubDevelopment::class, 'zone_id');
    }

    /**
     * Get advantages
     */
    public function advantages()
    {
        return $this->hasMany(SubRegionalAdvantages::class, 'zone_id');
    }

    /**
     * Get energies
     */
    public function energies()
    {
        return $this->hasMany(SubResourceEnergy::class, 'zone_id');
    }

    /**
     * Get translation by locale
     */
    public function translation(string $locale)
    {
        return $this->hasOne(ZoneTranslation::class, 'zone_id')
                    ->where('locale', $locale);
    }

    /**
     * Get translated name attribute
     */
    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale();
        $defaultLocale = config('app.fallback_locale', 'en');

        $translation = $this->translations()->where('locale', $locale)->first();
        if ($translation && $translation->name) {
            return $translation->name;
        }

        $translation = $this->translations()->where('locale', $defaultLocale)->first();
        if ($translation && $translation->name) {
            return $translation->name;
        }

        return '';
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // Menggunakan Str::startsWith() dari Laravel
        return Str::startsWith($this->image, ['http://', 'https://'])
            ? $this->image
            : url('uploads/zones/' . $this->image);
    }

    /**
     * Scope for specific zone class
     */
    public function scopeByClass($query, int $zoneClassId)
    {
        return $query->where('zone_class_id', $zoneClassId);
    }

    /**
     * Scope for ordering by latest
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}