<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = "careers";
    protected $fillable = [
        'position',
        'factory_id',
    ];
    public function factory()
    {
        return $this->belongsTo(Factory::class, 'factory_id', 'id');
    }
    public function location()
    {
        return $this->belongsTo(MasterCompanyLocation::class, 'location_id', 'id');
    }
    public function education()
    {
        return $this->belongsTo(MasterEducation::class, 'education_id', 'id');
    }
    public function jobLevel()
    {
        return $this->belongsTo(MasterJobLevel::class, 'job_level_id', 'id');
    }
}
