<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsHeaderTranslation extends Model
{
    protected $fillable = ['about_us_header_id', 'locale', 'title', 'description'];
}
