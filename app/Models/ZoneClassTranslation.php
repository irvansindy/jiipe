<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneClassTranslation extends Model
{
    protected $fillable = ['zone_class_id', 'locale', 'name'];
    // Relasi
    public function zoneClass() {
        return $this->belongsTo(ZoneClass::class, 'zone_class_id');
    }
}
