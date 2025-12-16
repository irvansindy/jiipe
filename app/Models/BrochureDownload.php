<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrochureDownload extends Model
{
    protected $table = 'brochure_downloads';

    protected $fillable = [
        'brochure_id',
        'ip_address',
        'user_agent',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    /**
     * Relationship to Brochure (if you have Brochure model)
     */
    public function brochure()
    {
        return $this->belongsTo(Brochure::class);
    }

    /**
     * Track a new download
     */
    public static function track(int $brochureId, ?string $ipAddress = null, ?string $userAgent = null): self
    {
        return self::create([
            'brochure_id' => $brochureId,
            'ip_address' => $ipAddress ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
            'downloaded_at' => now(),
        ]);
    }
}