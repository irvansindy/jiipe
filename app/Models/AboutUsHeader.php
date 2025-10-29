<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsHeader extends Model
{
    protected $fillable = ['image'];
    public function translations()
    {
        return $this->hasMany(AboutUsHeaderTranslation::class, 'about_us_header_id', 'id');
    }
}
