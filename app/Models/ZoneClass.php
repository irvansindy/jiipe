<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneClass extends Model
{
    public function translations()
    {
        return $this->hasMany(ZoneClassTranslation::class, 'zone_class_id');
    }
}
