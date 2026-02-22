<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['locale', 'name', 'native', 'regional', 'script', 'flag'];
    // Bahasa default
    public static function defaultLocale()
    {
        return static::where('locale', 'id')->first()->locale ?? 'id';
    }
}
