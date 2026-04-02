<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests
        if ($request->isMethod('get')) {
            // Exclude admin routes and API routes
            $excludedPaths = [
                'admin/home',
                'admin',
                'api',
                'fetch-',
                'get-',
                'store-',
                'update-',
                'delete-',
            ];

            $shouldTrack = true;
            foreach ($excludedPaths as $path) {
                if (str_contains($request->path(), $path)) {
                    $shouldTrack = false;
                    break;
                }
            }

            if ($shouldTrack) {
                try {
                    Visitor::track(
                        $request->fullUrl(),
                        $request->ip(),
                        $request->userAgent(),
                        $request->header('referer')
                    );
                } catch (\Exception $e) {
                    // Silent fail - don't break the request if tracking fails
                    \Log::error('Visitor tracking failed: ' . $e->getMessage());
                }
            }
        }

        return $next($request);
    }
}