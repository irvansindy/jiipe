<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubDevelopmentRequest;
use App\Services\SubDevelopmentService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class SubDevelopmentController extends Controller
{
    protected $developmentService;

    public function __construct(SubDevelopmentService $developmentService)
    {
        $this->developmentService = $developmentService;
    }

    public function fetchDevelopments(Request $request, int $zoneId)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $developments = $this->developmentService->getDevelopmentsByZone($zoneId, $locale);

            $message = $developments->isNotEmpty() ? 'Success fetch zone developments' : 'No data found';
            return FormatResponseJson::success($developments, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function getDevelopmentDetail(int $id)
    {
        try {
            $data = $this->developmentService->getDevelopmentById($id);
            return FormatResponseJson::success($data, 'Development detail fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function storeDevelopment(SubDevelopmentRequest $request)
    {
        try {
            $development = $this->developmentService->createDevelopment($request->validated());
            return FormatResponseJson::success($development, 'Development created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function updateDevelopment(SubDevelopmentRequest $request, int $id)
    {
        try {
            $development = $this->developmentService->updateDevelopment($id, $request->validated());
            return FormatResponseJson::success($development, 'Development updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function deleteDevelopment(int $id)
    {
        try {
            $this->developmentService->deleteDevelopment($id);
            return FormatResponseJson::success(null, 'Development deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}