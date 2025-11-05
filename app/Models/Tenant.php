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
    public function translations()
    {
        return $this->hasMany(TenantTranslation::class, 'tenant_id', 'id');
    }
}
