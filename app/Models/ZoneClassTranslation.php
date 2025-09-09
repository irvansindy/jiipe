<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneClassTranslation extends Model
{
    protected $fillable = ['zone_class_id', 'locale', 'name'];
    public function zone()
    {
        return $this->belongsTo(ZoneClass::class, 'zone_class_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
