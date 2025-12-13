<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryBrochureRequest;
use App\Services\GalleryBrochureService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class BrochureController extends Controller
{
    protected $brochureService;

    public function __construct(GalleryBrochureService $brochureService)
    {
        $this->brochureService = $brochureService;
    }

    /**
     * Display brochure index page
     */
    public function index()
    {
        try {
            $brochures = $this->brochureService->getAllBrochures();
            return view('layouts.admin.brochure.index', compact('brochures'));
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Fetch all brochures (AJAX)
     */
    public function fetch(Request $request)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $brochures = $this->brochureService->getAllBrochures($locale);

            $message = $brochures->isNotEmpty() ? 'Brochures fetched successfully' : 'No data found';
            return FormatResponseJson::success($brochures, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch brochure by ID (AJAX)
     */
    public function fetchById(Request $request)
    {
        try {
            $data = $this->brochureService->getBrochureById($request->id);
            return FormatResponseJson::success($data, 'Brochure detail fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Store new brochure
     */
    public function store(GalleryBrochureRequest $request)
    {
        try {
            $imageFile = $request->hasFile('image') ? $request->file('image') : null;

            // Collect PDF files per locale
            $files = [];
            $locales = array_keys(config('laravellocalization.supportedLocales'));
            foreach ($locales as $locale) {
                if ($request->hasFile("file.{$locale}")) {
                    $files[$locale] = $request->file("file.{$locale}");
                }
            }

            $brochure = $this->brochureService->createBrochure(
                $request->validated(),
                $imageFile,
                $files
            );

            return FormatResponseJson::success($brochure, 'Brochure created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update brochure
     */
    public function update(GalleryBrochureRequest $request, int $id)
    {
        try {
            $imageFile = $request->hasFile('image') ? $request->file('image') : null;

            // Collect PDF files per locale
            $files = [];
            $locales = array_keys(config('laravellocalization.supportedLocales'));
            foreach ($locales as $locale) {
                if ($request->hasFile("file.{$locale}")) {
                    $files[$locale] = $request->file("file.{$locale}");
                }
            }

            $brochure = $this->brochureService->updateBrochure(
                $id,
                $request->validated(),
                $imageFile,
                $files
            );

            return FormatResponseJson::success($brochure, 'Brochure updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete brochure
     */
    public function delete(int $id)
    {
        try {
            $this->brochureService->deleteBrochure($id);
            return FormatResponseJson::success(null, 'Brochure deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}