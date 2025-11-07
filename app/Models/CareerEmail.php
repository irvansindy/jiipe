<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerEmail extends Model
{
    protected $table = "career_emails";
    protected $fillable = [
        'position_id',
        'name',
        'email',
        'phone',
        'file_cv',
        'file_complementary_documents',
        'education',
        'body',
        'date',
        'job_level',
        'experience'
    ];
}
