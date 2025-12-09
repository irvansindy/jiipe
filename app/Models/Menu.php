<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Check apakah user bisa akses menu ini
     */
    public function canAccess($user = null)
    {
        $user = $user ?? Auth::user();

        // Jika tidak ada user yang login
        if (!$user) {
            return false;
        }

        // Jika menu tidak punya permission requirement (kosong atau null)
        // Artinya menu ini bisa diakses semua user yang login
        if (empty($this->permission)) {
            return true;
        }

        // Check apakah user punya permission ini
        return $user->can($this->permission);
    }

    /**
     * Scope untuk filter menu berdasarkan permission user
     * Bisa dipake langsung di query
     */
    public function scopeAccessibleBy($query, $user = null)
    {
        $user = $user ?? Auth::user();

        if (!$user) {
            return $query->whereRaw('1 = 0'); // Return empty
        }

        return $query->where(function ($q) use ($user) {
            // Menu tanpa permission requirement
            $q->whereNull('permission')
              ->orWhere('permission', '');

            // Atau menu yang user punya permissionnya
            $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
            if (!empty($userPermissions)) {
                $q->orWhereIn('permission', $userPermissions);
            }
        });
    }
}