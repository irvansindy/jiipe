<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubRegionalAdvantagesTranslation extends Model
{
    protected $fillable = ['sub_regional_advantages_id', 'locale', 'name', 'description'];
    // Relasi
    public function subRegionalAdvantages() {
        return $this->belongsTo(SubRegionalAdvantages::class, 'sub_regional_advantages_id');
    }
}
