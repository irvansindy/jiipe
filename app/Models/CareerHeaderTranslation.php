<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHeaderTranslation extends Model
{
    protected $fillable = [
        'career_header_id',
        'locale',
        'title'
    ];
}
