<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['image','zone_class_id'];
    public function translations()
    {
        return $this->hasMany(ZoneTranslation::class);
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

        // Tidak ada fallback ke field 'name' di zones
        return '';
    }
}
