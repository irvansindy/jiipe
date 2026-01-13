<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Services\GalleryService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    /**
     * Display gallery listing with pagination
     */
    public function index()
    {
        try {
            $galleries = $this->galleryService->getAllGalleries();
            return view('layouts.admin.gallery.index', compact('galleries'));
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Fetch gallery by ID with all relationships
     */
    public function fetchById(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:galleries,id'
            ]);

            $gallery = $this->galleryService->getGalleryById($request->id);
            return FormatResponseJson::success($gallery, 'Gallery fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        }
    }

    /**
     * Store new gallery
     */
    public function store(GalleryRequest $request)
    {
        try {
            $mainImageFile = $request->hasFile('gallery_main_image') ? $request->file('gallery_main_image') : null;
            $detailImageFiles = $request->hasFile('gallery_image_detail') ? $request->file('gallery_image_detail') : null;

            $gallery = $this->galleryService->createGallery(
                $request->validated(),
                $mainImageFile,
                $detailImageFiles
            );

            return FormatResponseJson::success(
                ['id' => $gallery->id],
                'Gallery created successfully'
            );
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update existing gallery
     */
    public function update(GalleryRequest $request)
    {
        try {
            $mainImageFile = $request->hasFile('gallery_main_image') ? $request->file('gallery_main_image') : null;
            $detailImageFiles = $request->hasFile('gallery_image_detail') ? $request->file('gallery_image_detail') : null;

            $gallery = $this->galleryService->updateGallery(
                $request->id,
                $request->validated(),
                $mainImageFile,
                $detailImageFiles
            );

            return FormatResponseJson::success(
                ['id' => $gallery->id],
                'Gallery updated successfully'
            );
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete gallery
     */
    public function destroy(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:galleries,id'
            ]);

            $this->galleryService->deleteGallery($request->id);

            return FormatResponseJson::success(null, 'Gallery deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete single detail image
     */
    public function deleteDetailImage(Request $request)
    {
        try {
            $request->validate([
                'image_id' => 'required|exists:gallery_images,id'
            ]);

            $this->galleryService->deleteDetailImage($request->image_id);

            return FormatResponseJson::success(null, 'Image deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}