<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequentlyAskedQuestionsTranslation extends Model
{
    protected $fillable = [
        'faq_id',
        'locale',
        'question',
        'answer'
    ];

    public function faq()
    {
        return $this->belongsTo(FrequentlyAskedQuestions::class, 'faq_id');
    }
}
