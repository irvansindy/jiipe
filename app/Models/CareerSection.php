<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSection extends Model
{
    public function translations()
    {
        return $this->hasMany(CareerSectionTranslation::class);
    }
}
