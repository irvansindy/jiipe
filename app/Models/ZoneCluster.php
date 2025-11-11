<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneCluster extends Model
{
    protected $fillable = ['zone_id'];
    // Relasi
    public function zone() {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function translations() {
        return $this->hasMany(ZoneClusterTranslation::class, 'zone_cluster_id');
    }
}
