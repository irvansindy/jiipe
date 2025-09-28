<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHeader extends Model
{
    protected $fillable = ['image'];
    public function translations()
    {
        return $this->hasMany(CareerHeaderTranslation::class);
    }
}
