<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHeaderTranslation extends Model
{
    protected $table = 'career_header_translations'; // Tambahkan table name
    protected $fillable = [
        'career_header_id',
        'locale',
        'title'
    ];
    public $timestamps = true; // Pastikan ini ada
}