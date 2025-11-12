<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneCluster extends Model
{
    protected $guarded = [];
    // Relasi
    public function zone() {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
    public function translations() {
        return $this->hasMany(ZoneClusterTranslation::class, 'zone_clusters_id', 'id');
    }
}
