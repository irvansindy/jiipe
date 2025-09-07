<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'title',
    ];
    public function translations()
    {
        return $this->hasMany(AppointmentTranslation::class);
    }
}
