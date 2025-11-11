<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneClusterTranslation extends Model
{
    protected $fillable = ['zone_cluster_id', 'locale', 'name', 'description'];
    // Relasi
    public function zoneCluster() {
        return $this->belongsTo(ZoneCluster::class, 'zone_cluster_id');
    }
}
