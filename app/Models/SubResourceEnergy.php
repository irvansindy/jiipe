<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubResourceEnergy extends Model
{
    protected $fillable = ['zone_id'];
    // Relasi
    public function zone() {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function translations() {
        return $this->hasMany(SubResourceEnergyTranslation::class, 'sub_resource_energy_id');
    }
}
