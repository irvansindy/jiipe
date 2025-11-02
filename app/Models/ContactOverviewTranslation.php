<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactOverviewTranslation extends Model
{
    protected $table = "contact_overview_translations";
    // protected $fillable = [
    //     'contact_overviews_id',
    //     'locale',
    //     'title',
    //     'subtitle',
    //     'description',
    //     'office_name',
    //     'phone',
    //     'address',
    //     'map_link'
    // ];
    protected $guarded = [];
}
