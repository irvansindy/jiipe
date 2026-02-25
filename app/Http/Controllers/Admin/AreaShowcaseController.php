<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaShowCaseRequest;
use App\Services\AreaShowCaseService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class AreaShowCaseController extends Controller
{
    protected $areaShowCaseService;

    public function __construct(AreaShowCaseService $areaShowCaseService)
    {
        $this->areaShowCaseService = $areaShowCaseService;
    }

    /**
     * Fetch all area showcases (AJAX)
     */
    public function fetch()
    {
        try {
            $items = $this->areaShowCaseService->getAllAreaShowCases();

            return FormatResponseJson::success($items, 'Fetched Area ShowCases Successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch single area showcase by ID (AJAX, used for edit form)
     */
    public function fetchById(Request $request)
    {
        try {
            $item = $this->areaShowCaseService->getAreaShowCaseById($request->id);

            return FormatResponseJson::success($item, 'Fetched Area ShowCase Successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        }
    }

    /**
     * Store a new area showcase
     */
    public function store(AreaShowCaseRequest $request)
    {
        try {
            $file       = $request->hasFile('image')        ? $request->file('image')        : null;
            $fileMobile = $request->hasFile('image_mobile') ? $request->file('image_mobile') : null;
            $item = $this->areaShowCaseService->createAreaShowCase($request->validated(), $file, $fileMobile);

            return FormatResponseJson::success(['id' => $item->id], 'Area ShowCase created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update an existing area showcase
     */
    public function update(AreaShowCaseRequest $request)
    {
        try {
            $file       = $request->hasFile('image')        ? $request->file('image')        : null;
            $fileMobile = $request->hasFile('image_mobile') ? $request->file('image_mobile') : null;
            $item = $this->areaShowCaseService->updateAreaShowCase($request->id, $request->validated(), $file, $fileMobile);

            return FormatResponseJson::success(['id' => $item->id], 'Area ShowCase updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete an area showcase
     */
    public function destroy(int $id)
    {
        try {
            $this->areaShowCaseService->deleteAreaShowCase($id);

            return FormatResponseJson::success(null, 'Area ShowCase deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}