<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubRegionalAdvantagesRequest;
use App\Services\SubRegionalAdvantagesService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class SubRegionalAdvantagesController extends Controller
{
    protected $advantageService;

    public function __construct(SubRegionalAdvantagesService $advantageService)
    {
        $this->advantageService = $advantageService;
    }

    public function fetchAdvantages(Request $request, int $zoneId)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $advantages = $this->advantageService->getAdvantagesByZone($zoneId, $locale);

            $message = $advantages->isNotEmpty() ? 'Success fetch regional advantages' : 'No data found';
            return FormatResponseJson::success($advantages, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function getAdvantageDetail(int $id)
    {
        try {
            $data = $this->advantageService->getAdvantageById($id);
            return FormatResponseJson::success($data, 'Advantage detail fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function storeAdvantage(SubRegionalAdvantagesRequest $request)
    {
        try {
            $imageFile = $request->hasFile('image') ? $request->file('image') : null;
            $iconFile = $request->hasFile('icon') ? $request->file('icon') : null;

            $advantage = $this->advantageService->createAdvantage(
                $request->validated(),
                $imageFile,
                $iconFile
            );

            return FormatResponseJson::success($advantage, 'Advantage created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function updateAdvantage(SubRegionalAdvantagesRequest $request, int $id)
    {
        try {
            $imageFile = $request->hasFile('image') ? $request->file('image') : null;
            $iconFile = $request->hasFile('icon') ? $request->file('icon') : null;

            $advantage = $this->advantageService->updateAdvantage(
                $id,
                $request->validated(),
                $imageFile,
                $iconFile
            );

            return FormatResponseJson::success($advantage, 'Advantage updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function deleteAdvantage(int $id)
    {
        try {
            $this->advantageService->deleteAdvantage($id);
            return FormatResponseJson::success(null, 'Advantage deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}