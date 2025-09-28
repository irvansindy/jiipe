<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'url',
        'permission',
        'icon',
        'type',
        'parent_id',
        'order',
        'is_active',
    ];
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->where('is_active', 1)
            ->orderBy('order')
            ->with('translations'); // biar translated_name nggak N+1
    }
    public function scopeRoots($q)
    {
        return $q->whereNull('parent_id');
    }
    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }
    public function translations()
    {
        return $this->hasMany(MenuTranslation::class, 'menu_id', 'id');
    }
    public function permissions()
    {
        return $this->hasOne(\Spatie\Permission\Models\Permission::class, 'name', 'permission');
    }
    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale(); // bahasa aktif
        $defaultLocale = Language::defaultLocale(); // bahasa default dari DB

        // Ambil translasi sesuai locale aktif
        $translation = $this->translations()->where('locale', $locale)->first();
        if ($translation && $translation->name) {
            return $translation->name;
        }

        // Fallback ke bahasa default
        $translation = $this->translations()->where('locale', $defaultLocale)->first();
        if ($translation && $translation->name) {
            return $translation->name;
        }

        // Fallback terakhir ke field asli
        return $this->attributes['name'] ?? '';
    }
}
