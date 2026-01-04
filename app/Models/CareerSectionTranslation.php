<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSectionTranslation extends Model
{
    protected $table = 'career_section_translations';
    protected $fillable = [
        'career_section_id',
        'locale',
        'title',
        'content',
    ];
    public $timestamps = true;
}