<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubResourceEnergyRequest;
use App\Services\SubResourceEnergyService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class SubResourceEnergyController extends Controller
{
    protected $energyService;

    public function __construct(SubResourceEnergyService $energyService)
    {
        $this->energyService = $energyService;
    }

    /**
     * Fetch energies by zone
     */
    public function fetchEnergies(Request $request, int $zoneId)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $energies = $this->energyService->getEnergiesByZone($zoneId, $locale);

            $message = $energies->isNotEmpty() ? 'Success fetch resource energies' : 'No data found';
            return FormatResponseJson::success($energies, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Get energy detail
     */
    public function getEnergyDetail(int $id)
    {
        try {
            $data = $this->energyService->getEnergyById($id);

            return FormatResponseJson::success($data, 'Energy detail fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Store new energy
     */
    public function storeEnergy(SubResourceEnergyRequest $request)
    {
        try {
            $imageFile = $request->hasFile('image') ? $request->file('image') : null;
            $iconFile = $request->hasFile('icon') ? $request->file('icon') : null;

            $energy = $this->energyService->createEnergy(
                $request->validated(),
                $imageFile,
                $iconFile
            );

            return FormatResponseJson::success($energy, 'Energy created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update energy
     */
    public function updateEnergy(SubResourceEnergyRequest $request, int $id)
    {
        try {
            $imageFile = $request->hasFile('image') ? $request->file('image') : null;
            $iconFile = $request->hasFile('icon') ? $request->file('icon') : null;

            $energy = $this->energyService->updateEnergy(
                $id,
                $request->validated(),
                $imageFile,
                $iconFile
            );

            return FormatResponseJson::success($energy, 'Energy updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete energy
     */
    public function deleteEnergy(int $id)
    {
        try {
            $this->energyService->deleteEnergy($id);

            return FormatResponseJson::success(null, 'Energy deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}