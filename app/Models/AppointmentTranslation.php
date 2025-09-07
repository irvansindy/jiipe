<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentTranslation extends Model
{
    protected $fillable = [
        'appointment_id',
        'locale',
        'title_quick_appointment',
        'appointment_description',
    ];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}