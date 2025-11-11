<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubResourceEnergyTranslation extends Model
{
    protected $fillable = ['sub_resource_energy_id', 'locale', 'name', 'description'];
    // Relasi
    public function subResourceEnergy() {
        return $this->belongsTo(SubResourceEnergy::class, 'sub_resource_energy_id');
    }
}
