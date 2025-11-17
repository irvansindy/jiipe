<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = "tenants";

    protected $fillable = [
        'is_active',
        'logo'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(TenantTranslation::class, 'tenant_id', 'id');
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->hasOne(TenantTranslation::class, 'tenant_id', 'id')
                    ->where('locale', $locale);
    }
}