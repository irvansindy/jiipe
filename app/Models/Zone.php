<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['zone_class_id', 'image'];

    // Relasi
    public function zoneClass() {
        return $this->belongsTo(ZoneClass::class, 'zone_class_id');
    }
    public function translations() {
        return $this->hasMany(ZoneTranslation::class, 'zone_id');
    }
    public function clusters() {
        return $this->hasMany(ZoneCluster::class, 'zone_id');
    }
    public function developments() {
        return $this->hasMany(SubDevelopment::class, 'zone_id');
    }
    public function advantages() {
        return $this->hasMany(SubRegionalAdvantages::class, 'zone_id');
    }
    public function energies() {
        return $this->hasMany(SubResourceEnergy::class, 'zone_id');
    }
    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale();
        $defaultLocale = Language::defaultLocale();

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

    // Helper untuk mendapatkan translation berdasarkan locale
    public function translate($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }
}