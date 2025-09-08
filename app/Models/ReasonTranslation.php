<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonTranslation extends Model
{
    protected $fillable = [
        'reason_id',
        'locale',
        'label_reason',
        'label_industry',
        'label_land_plot',
        'label_timeline_construction',
        'label_energy_utility',
        'placeholder_industry',
        'placeholder_land_plot',
        'placeholder_timeline_construction',
        'placeholder_total_power',
        'placeholder_total_water',
        'placeholder_total_gas',
        'placeholder_throughput_seaport',
    ];

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}
