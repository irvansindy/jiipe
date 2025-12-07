<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantTranslation extends Model
{
    protected $table = "tenant_translations";

    protected $fillable = [
        'tenant_id',
        'locale',
        'name'
    ];

    // Disable timestamps if not using created_at/updated_at
    public $timestamps = true;

    // Relasi
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}