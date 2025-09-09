<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneTranslation extends Model
{
    protected $fillable = ['zone_id', 'locale', 'name', 'subtitle', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'note'];
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
    public function translations()
    {
        return $this->hasMany(ZoneTranslation::class);
    }
}
