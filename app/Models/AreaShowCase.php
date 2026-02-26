<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaShowCase extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_mobile',
        'is_active',
        'position',
    ];
    public function translations()
    {
        return $this->hasMany(AreaShowCaseTranslation::class);
    }
}
