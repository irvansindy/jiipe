<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\GalleryBrochure;
use App\Models\BrochureDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrochureDownloadController extends Controller
{
    /**
     * Download brochure dengan tracking
     * Route: /brochure/download/{id}
     */
    public function download(Request $request, $id)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());

            // Get brochure with translation
            $brochure = GalleryBrochure::with([
                'translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])
            ->where('id', $id)
            ->where('is_active', 1)
            ->firstOrFail();

            $translation = $brochure->translations->first();

            if (!$translation || !$translation->file) {
                return back()->with('error', 'Brochure file not found.');
            }

            // Track the download
            BrochureDownload::track(
                $brochure->id,
                $request->ip(),
                $request->userAgent()
            );

            // Get file path
            $filePath = public_path('uploads/brochures/files/' . $translation->file);

            if (!file_exists($filePath)) {
                \Log::error('Brochure file not found: ' . $filePath);
                return back()->with('error', 'File not found on server.');
            }

            // Return file for download
            return response()->download($filePath, basename($translation->file));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Brochure not found.');
        } catch (\Exception $e) {
            \Log::error('Brochure download error: ' . $e->getMessage());
            return back()->with('error', 'Failed to download brochure. Please try again later.');
        }
    }

    /**
     * Alternative: Direct file serve dengan tracking via JavaScript
     * Untuk yang tetap mau pakai direct link
     */
    public function trackAndRedirect(Request $request, $id)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());

            $brochure = GalleryBrochure::with([
                'translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])
            ->where('id', $id)
            ->where('is_active', 1)
            ->firstOrFail();

            $translation = $brochure->translations->first();

            if (!$translation || !$translation->file) {
                return back()->with('error', 'Brochure file not found.');
            }

            // Track the download
            BrochureDownload::track(
                $brochure->id,
                $request->ip(),
                $request->userAgent()
            );

            // Redirect to direct file URL
            $fileUrl = url('uploads/brochures/files/' . $translation->file);
            return redirect($fileUrl);

        } catch (\Exception $e) {
            \Log::error('Brochure tracking error: ' . $e->getMessage());
            return back()->with('error', 'Failed to access brochure.');
        }
    }
}