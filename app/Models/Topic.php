<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function translations()
    {
        return $this->hasMany(TopicTranslation::class);
    }
}
