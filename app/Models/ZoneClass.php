<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneClass extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get all translations
     */
    public function translations()
    {
        return $this->hasMany(ZoneClassTranslation::class, 'zone_class_id');
    }

    /**
     * Get all zones
     */
    public function zones()
    {
        return $this->hasMany(Zone::class, 'zone_class_id');
    }

    /**
     * Get translation by locale
     */
    public function translation(string $locale)
    {
        return $this->hasOne(ZoneClassTranslation::class, 'zone_class_id')
                    ->where('locale', $locale);
    }
}