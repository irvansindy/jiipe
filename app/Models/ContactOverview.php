<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactOverview extends Model
{
    protected $table = "contact_overviews";
    protected $fillable = [
        'image',
    ];
    public function translations()
    {
        return $this->hasMany(ContactOverviewTranslation::class, 'contact_overviews_id', 'id');
    }
}
