<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaShowCaseTranslation extends Model
{
    protected $fillable = [
        "area_show_case_id",
        "locale",
        "title",
        "description",
    ];
}
