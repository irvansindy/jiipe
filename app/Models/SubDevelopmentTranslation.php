<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDevelopmentTranslation extends Model
{
    protected $fillable = ['sub_development_id', 'locale', 'name', 'description'];
    // Relasi
    public function subDevelopment() {
        return $this->belongsTo(SubDevelopment::class, 'sub_development_id');
    }
}
