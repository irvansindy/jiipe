<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHeader extends Model
{
    protected $table = 'career_headers';
    protected $fillable = ['image'];
    public $timestamps = true; // Pastikan ini ada

    public function translations()
    {
        return $this->hasMany(CareerHeaderTranslation::class);
    }
}