<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSectionTranslation extends Model
{
    protected $fillable = [
        'career_section_id',
        'locale',
        'title',
        'content',
    ];
}
