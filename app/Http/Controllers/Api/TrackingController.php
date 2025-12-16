<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrochureDownload;
class TrackingController extends Controller
{
    /**
     * Track brochure download
     * Route: POST /api/track-brochure-download
     */
    public function trackBrochureDownload(Request $request)
    {
        try {
            $brochureId = $request->input('brochure_id');

            if (!$brochureId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Brochure ID is required'
                ], 400);
            }

            // Track the download
            BrochureDownload::track(
                $brochureId,
                $request->ip(),
                $request->userAgent()
            );

            return response()->json([
                'success' => true,
                'message' => 'Download tracked successfully'
            ], 200);

        } catch (\Exception $e) {
            \Log::error('API Brochure tracking error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Tracking failed'
            ], 500);
        }
    }
}
