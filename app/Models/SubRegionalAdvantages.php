<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubRegionalAdvantages extends Model
{
    protected $fillable = ['zone_id', 'image', 'icon', 'order'];
    // Relasi
    public function zone() {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function translations() {
        return $this->hasMany(SubRegionalAdvantagesTranslation::class, 'sub_regional_advantages_id');
    }
}
