<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageAppointment extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_name',
        'country_origin',
        'reason',
        'reason_other',
        'classification',
        'classification_other',
        'land_plot',
        'timeline',
        'power',
        'industrial_water',
        'natural_gas',
        'throughput_via_seaport',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'land_plot' => 'decimal:2',
        'power' => 'decimal:2',
        'industrial_water' => 'decimal:2',
        'natural_gas' => 'decimal:2',
        'throughput_via_seaport' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->status === 1 ? 'Processed' : 'Pending';
    }

    /**
     * Scope for pending appointments
     */
    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Scope for processed appointments
     */
    public function scopeProcessed($query)
    {
        return $query->where('status', 1);
    }
}