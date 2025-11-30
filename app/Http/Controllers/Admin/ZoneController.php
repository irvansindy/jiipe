<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZoneRequest;
use App\Services\ZoneService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class ZoneController extends Controller
{
    protected $zoneService;

    public function __construct(ZoneService $zoneService)
    {
        $this->zoneService = $zoneService;
    }

    /**
     * Display zone index page
     */
    public function index()
    {
        return view('layouts.admin.zone.index');
    }

    /**
     * Fetch zones (zone_class_id = 1)
     */
    public function fetchZone(Request $request)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $zones = $this->zoneService->getZonesByClass(1, $locale);

            $message = $zones->isNotEmpty() ? 'Success fetch data zone' : 'No data found';
            return FormatResponseJson::success($zones, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch special zones (zone_class_id = 2)
     */
    public function fetchSpecialZone(Request $request)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $zones = $this->zoneService->getZonesByClass(2, $locale);

            $message = $zones->isNotEmpty() ? 'Success fetch data zone' : 'No data found';
            return FormatResponseJson::success($zones, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch zone classes
     */
    public function fetchZoneClass(Request $request)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $zoneClasses = $this->zoneService->getAllZoneClasses($locale);

            $message = $zoneClasses->isNotEmpty() ? 'Success fetch data zone class' : 'No data found';
            return FormatResponseJson::success($zoneClasses, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Store new zone
     */
    public function storeZone(ZoneRequest $request)
    {
        try {
            $imageFile = $request->hasFile('zone_image') ? $request->file('zone_image') : null;
            $zone = $this->zoneService->createZone($request->validated(), $imageFile);

            return FormatResponseJson::success($zone, 'Zone created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Get zone detail
     */
    public function getZoneDetail(int $id)
    {
        try {
            $data = $this->zoneService->getZoneById($id);

            return FormatResponseJson::success($data, 'Zone detail fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update zone
     */
    public function updateZone(ZoneRequest $request, int $id)
    {
        try {
            $imageFile = $request->hasFile('zone_image') ? $request->file('zone_image') : null;
            $zone = $this->zoneService->updateZone($id, $request->validated(), $imageFile);

            return FormatResponseJson::success($zone, 'Zone updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete zone
     */
    public function deleteZone(int $id)
    {
        try {
            $this->zoneService->deleteZone($id);

            return FormatResponseJson::success(null, 'Zone deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}