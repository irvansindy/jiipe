<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequentlyAskedQuestions extends Model
{
    protected $fillable = [
        'is_active',
        'position'
    ];

    public function translations()
    {
        return $this->hasMany(FrequentlyAskedQuestionsTranslation::class, 'faq_id');
    }
}
