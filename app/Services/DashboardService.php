<?php

namespace App\Services;

use App\Models\PageAppointment;
use App\Models\Career;
use App\Models\CareerEmail;
use App\Models\BrochureDownload;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    const CACHE_TTL = 3600; // 1 hour

    // Cache Keys
    const CACHE_KEY_APPOINTMENTS_TOTAL = 'dashboard_appointments_total';
    const CACHE_KEY_APPOINTMENTS_INCREASE = 'dashboard_appointments_increase';
    const CACHE_KEY_BROCHURE_TOTAL = 'dashboard_brochure_total';
    const CACHE_KEY_BROCHURE_INCREASE = 'dashboard_brochure_increase';
    const CACHE_KEY_JOB_VACANCIES_TOTAL = 'dashboard_job_vacancies_total';
    const CACHE_KEY_APPLICANTS_TOTAL = 'dashboard_applicants_total';
    const CACHE_KEY_APPLICANTS_INCREASE = 'dashboard_applicants_increase';
    const CACHE_KEY_VISITORS_WEEKLY = 'dashboard_visitors_weekly';
    const CACHE_KEY_VISITORS_MONTHLY = 'dashboard_visitors_monthly';
    const CACHE_KEY_TOP_PAGES = 'dashboard_top_pages';

    /**
     * Get total appointments count with cache
     */
    public function getTotalAppointments(): int
    {
        return Cache::remember(self::CACHE_KEY_APPOINTMENTS_TOTAL, self::CACHE_TTL, function () {
            return PageAppointment::count();
        });
    }

    /**
     * Get appointments increase (compare last 30 days with previous 30 days)
     */
    public function getAppointmentsIncrease(): int
    {
        return Cache::remember(self::CACHE_KEY_APPOINTMENTS_INCREASE, self::CACHE_TTL, function () {
            $last30Days = PageAppointment::where('created_at', '>=', now()->subDays(30))->count();
            $previous30Days = PageAppointment::whereBetween('created_at', [
                now()->subDays(60),
                now()->subDays(30)
            ])->count();

            return $last30Days - $previous30Days;
        });
    }

    /**
     * Get total brochure downloads count with cache
     */
    public function getTotalBrochureDownloads(): int
    {
        return Cache::remember(self::CACHE_KEY_BROCHURE_TOTAL, self::CACHE_TTL, function () {
            return BrochureDownload::count();
        });
    }

    /**
     * Get brochure downloads increase
     */
    public function getBrochureDownloadsIncrease(): int
    {
        return Cache::remember(self::CACHE_KEY_BROCHURE_INCREASE, self::CACHE_TTL, function () {
            $last30Days = BrochureDownload::where('created_at', '>=', now()->subDays(30))->count();
            $previous30Days = BrochureDownload::whereBetween('created_at', [
                now()->subDays(60),
                now()->subDays(30)
            ])->count();

            return $last30Days - $previous30Days;
        });
    }

    /**
     * Get total job vacancies (published careers only)
     */
    public function getTotalJobVacancies(): int
    {
        return Cache::remember(self::CACHE_KEY_JOB_VACANCIES_TOTAL, self::CACHE_TTL, function () {
            return Career::where('is_active', 1)->count();
        });
    }

    /**
     * Get total applicants
     */
    public function getTotalApplicants(): int
    {
        return Cache::remember(self::CACHE_KEY_APPLICANTS_TOTAL, self::CACHE_TTL, function () {
            return CareerEmail::count();
        });
    }

    /**
     * Get applicants increase
     */
    public function getApplicantsIncrease(): int
    {
        return Cache::remember(self::CACHE_KEY_APPLICANTS_INCREASE, self::CACHE_TTL, function () {
            $last30Days = CareerEmail::where('created_at', '>=', now()->subDays(30))->count();
            $previous30Days = CareerEmail::whereBetween('created_at', [
                now()->subDays(60),
                now()->subDays(30)
            ])->count();

            return $last30Days - $previous30Days;
        });
    }

    /**
     * Get weekly visitor statistics for chart
     */
    public function getWeeklyVisitors(): array
    {
        return Cache::remember(self::CACHE_KEY_VISITORS_WEEKLY, self::CACHE_TTL, function () {
            $weeklyData = Visitor::select(
                DB::raw('DATE(visited_at) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('COUNT(DISTINCT ip_address) as unique_visitors')
            )
            ->where('visited_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

            $labels = [];
            $totals = [];
            $uniques = [];

            // Fill in missing days with zeros
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $dayData = $weeklyData->firstWhere('date', $date);

                $labels[] = now()->subDays($i)->format('D');
                $totals[] = $dayData ? $dayData->total : 0;
                $uniques[] = $dayData ? $dayData->unique_visitors : 0;
            }

            return [
                'labels' => $labels,
                'totals' => $totals,
                'uniques' => $uniques,
            ];
        });
    }

    /**
     * Get monthly visitor statistics for chart
     */
    public function getMonthlyVisitors(): array
    {
        return Cache::remember(self::CACHE_KEY_VISITORS_MONTHLY, self::CACHE_TTL, function () {
            $monthlyData = Visitor::select(
                DB::raw('DATE(visited_at) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('COUNT(DISTINCT ip_address) as unique_visitors')
            )
            ->where('visited_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

            $labels = [];
            $totals = [];
            $uniques = [];

            // Group by week
            for ($i = 3; $i >= 0; $i--) {
                $weekStart = now()->subWeeks($i)->startOfWeek();
                $weekEnd = now()->subWeeks($i)->endOfWeek();

                $weekData = $monthlyData->filter(function($item) use ($weekStart, $weekEnd) {
                    $date = \Carbon\Carbon::parse($item->date);
                    return $date->between($weekStart, $weekEnd);
                });

                $labels[] = 'Week ' . (4 - $i);
                $totals[] = $weekData->sum('total');
                $uniques[] = $weekData->sum('unique_visitors');
            }

            return [
                'labels' => $labels,
                'totals' => $totals,
                'uniques' => $uniques,
            ];
        });
    }

    /**
     * Get top visited pages
     */
    public function getTopPages(int $limit = 5): array
    {
        return Cache::remember(self::CACHE_KEY_TOP_PAGES . '_' . $limit, self::CACHE_TTL, function () use ($limit) {
            return Visitor::select('page_url', DB::raw('COUNT(*) as visits'))
                ->where('visited_at', '>=', now()->subDays(30))
                ->groupBy('page_url')
                ->orderByDesc('visits')
                ->limit($limit)
                ->get()
                ->map(function($item) {
                    return [
                        'url' => $item->page_url,
                        'visits' => $item->visits,
                        'percentage' => 0, // Will be calculated after getting total
                    ];
                })
                ->toArray();
        });
    }

    /**
     * Get all dashboard statistics
     */
    public function getDashboardStats(): array
    {
        return [
            'appointments' => [
                'total' => $this->getTotalAppointments(),
                'increase' => $this->getAppointmentsIncrease(),
                'formatted' => $this->formatIncrease($this->getAppointmentsIncrease()),
            ],
            'brochure' => [
                'total' => $this->getTotalBrochureDownloads(),
                'increase' => $this->getBrochureDownloadsIncrease(),
                'formatted' => $this->formatIncrease($this->getBrochureDownloadsIncrease()),
            ],
            'job_vacancies' => [
                'total' => $this->getTotalJobVacancies(),
            ],
            'applicants' => [
                'total' => $this->getTotalApplicants(),
                'increase' => $this->getApplicantsIncrease(),
                'formatted' => $this->formatIncrease($this->getApplicantsIncrease()),
            ],
            'visitors' => [
                'weekly' => $this->getWeeklyVisitors(),
                'monthly' => $this->getMonthlyVisitors(),
            ],
            'top_pages' => $this->getTopPages(),
        ];
    }

    /**
     * Clear specific cache
     */
    public function clearCache(string $cacheKey = null): void
    {
        if ($cacheKey) {
            Cache::forget($cacheKey);
        } else {
            // Clear all dashboard caches
            $keys = [
                self::CACHE_KEY_APPOINTMENTS_TOTAL,
                self::CACHE_KEY_APPOINTMENTS_INCREASE,
                self::CACHE_KEY_BROCHURE_TOTAL,
                self::CACHE_KEY_BROCHURE_INCREASE,
                self::CACHE_KEY_JOB_VACANCIES_TOTAL,
                self::CACHE_KEY_APPLICANTS_TOTAL,
                self::CACHE_KEY_APPLICANTS_INCREASE,
                self::CACHE_KEY_VISITORS_WEEKLY,
                self::CACHE_KEY_VISITORS_MONTHLY,
                self::CACHE_KEY_TOP_PAGES,
            ];

            foreach ($keys as $key) {
                Cache::forget($key);
            }
        }
    }

    /**
     * Clear appointments cache only
     */
    public function clearAppointmentsCache(): void
    {
        Cache::forget(self::CACHE_KEY_APPOINTMENTS_TOTAL);
        Cache::forget(self::CACHE_KEY_APPOINTMENTS_INCREASE);
    }

    /**
     * Clear visitors cache only
     */
    public function clearVisitorsCache(): void
    {
        Cache::forget(self::CACHE_KEY_VISITORS_WEEKLY);
        Cache::forget(self::CACHE_KEY_VISITORS_MONTHLY);
        Cache::forget(self::CACHE_KEY_TOP_PAGES);
    }

    /**
     * Get percentage change helper
     */
    public function getPercentageChange(int $current, int $previous): float
    {
        if ($previous === 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 2);
    }

    /**
     * Format increase display
     */
    public function formatIncrease(int $increase): array
    {
        if ($increase > 0) {
            return [
                'type' => 'increase',
                'text' => 'Increase',
                'value' => number_format($increase),
                'class' => 'text-primary',
            ];
        } elseif ($increase < 0) {
            return [
                'type' => 'decrease',
                'text' => 'Decrease',
                'value' => number_format(abs($increase)),
                'class' => 'text-danger',
            ];
        } else {
            return [
                'type' => 'no_change',
                'text' => 'No change',
                'value' => '0',
                'class' => 'text-muted',
            ];
        }
    }
}