<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSection extends Model
{
    protected $table = 'career_sections';
    protected $fillable = []; // Bisa dikosongkan atau tambahkan field jika ada
    public $timestamps = true;

    public function translations()
    {
        return $this->hasMany(CareerSectionTranslation::class);
    }
}