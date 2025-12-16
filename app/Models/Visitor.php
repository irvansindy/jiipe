<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'referer',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Track a new visitor
     */
    public static function track(
        ?string $pageUrl = null,
        ?string $ipAddress = null,
        ?string $userAgent = null,
        ?string $referer = null
    ): self {
        return self::create([
            'ip_address' => $ipAddress ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
            'page_url' => $pageUrl ?? request()->fullUrl(),
            'referer' => $referer ?? request()->header('referer'),
            'visited_at' => now(),
        ]);
    }

    /**
     * Get unique visitors count for a period
     */
    public static function getUniqueVisitors(\DateTime $startDate, \DateTime $endDate): int
    {
        return self::whereBetween('visited_at', [$startDate, $endDate])
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get total page views for a period
     */
    public static function getTotalPageViews(\DateTime $startDate, \DateTime $endDate): int
    {
        return self::whereBetween('visited_at', [$startDate, $endDate])->count();
    }
}