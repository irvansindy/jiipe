<?php

namespace App\Services;

use App\Models\SubResourceEnergy;
use App\Models\SubResourceEnergyTranslation;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class SubResourceEnergyService
{
    /**
     * Get all energies by zone (only for zone_class_id = 1)
     */
    public function getEnergiesByZone(int $zoneId, string $locale = null)
    {
        $this->validateZoneClass($zoneId);

        $locale = $locale ?? app()->getLocale();

        return SubResourceEnergy::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('zone_id', $zoneId)
        ->orderBy('order', 'asc')
        ->get();
    }

    /**
     * Get energy by ID with all translations
     */
    public function getEnergyById(int $id)
    {
        $energy = SubResourceEnergy::with(['translations'])->findOrFail($id);

        $this->validateZoneClass($energy->zone_id);

        $locales = config('laravellocalization.supportedLocales');
        $translations = [];

        foreach ($locales as $locale => $properties) {
            $trans = $energy->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'name' => $trans ? $trans->name : '',
                'description' => $trans ? $trans->description : '',
            ];
        }

        return [
            'id' => $energy->id,
            'zone_id' => $energy->zone_id,
            'image' => $energy->image,
            'icon' => $energy->icon,
            'order' => $energy->order,
            'translations' => $translations,
        ];
    }

    /**
     * Create new energy
     */
    public function createEnergy(array $data, $imageFile = null, $iconFile = null)
    {
        $this->validateZoneClass($data['zone_id']);

        DB::beginTransaction();

        try {
            $imagePath = null;
            $iconPath = null;

            if ($imageFile) {
                $imagePath = $this->uploadFile($imageFile, 'zones/facilities');
            }

            if ($iconFile) {
                $iconPath = $this->uploadFile($iconFile, 'zones/facilities');
            }

            $energy = SubResourceEnergy::create([
                'zone_id' => $data['zone_id'],
                'image' => $imagePath,
                'icon' => $iconPath,
                'order' => $data['order'] ?? 0,
            ]);

            $this->saveTranslations($energy, $data);

            DB::commit();

            return $energy;
        } catch (Exception $e) {
            DB::rollBack();

            if (isset($imagePath) && $imagePath) {
                $this->deleteFile($imagePath);
            }
            if (isset($iconPath) && $iconPath) {
                $this->deleteFile($iconPath);
            }

            throw $e;
        }
    }

    /**
     * Update existing energy
     */
    public function updateEnergy(int $id, array $data, $imageFile = null, $iconFile = null)
    {
        DB::beginTransaction();

        try {
            $energy = SubResourceEnergy::findOrFail($id);

            $this->validateZoneClass($energy->zone_id);

            $oldImagePath = $energy->image;
            $oldIconPath = $energy->icon;

            if ($imageFile) {
                if ($oldImagePath) {
                    $this->deleteFile($oldImagePath);
                }
                $energy->image = $this->uploadFile($imageFile, 'zones/facilities');
            }

            if ($iconFile) {
                if ($oldIconPath) {
                    $this->deleteFile($oldIconPath);
                }
                $energy->icon = $this->uploadFile($iconFile, 'zones/facilities');
            }

            $energy->zone_id = $data['zone_id'];
            $energy->order = $data['order'] ?? $energy->order;
            $energy->save();

            $this->updateTranslations($energy, $data);

            DB::commit();

            return $energy;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete energy
     */
    public function deleteEnergy(int $id)
    {
        DB::beginTransaction();

        try {
            $energy = SubResourceEnergy::findOrFail($id);

            $this->validateZoneClass($energy->zone_id);

            if ($energy->image) {
                $this->deleteFile($energy->image);
            }

            if ($energy->icon) {
                $this->deleteFile($energy->icon);
            }

            SubResourceEnergyTranslation::where('sub_resource_energy_id', $id)->delete();
            $energy->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Validate zone class (must be zone_class_id = 1)
     */
    private function validateZoneClass(int $zoneId): void
    {
        $zone = Zone::findOrFail($zoneId);

        if ($zone->zone_class_id !== 1) {
            throw new Exception('Resource energies are only available for zone_class_id = 1');
        }
    }

    /**
     * Upload file and return path
     */
    private function uploadFile($file, string $folder): string
    {
        return $file->store($folder, 'uploads');
    }

    /**
     * Delete file from storage
     */
    private function deleteFile(string $filePath): bool
    {
        $fullPath = public_path('uploads/' . $filePath);

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Save translations for energy
     */
    private function saveTranslations(SubResourceEnergy $energy, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            SubResourceEnergyTranslation::create([
                'sub_resource_energy_id' => $energy->id,
                'locale' => $locale,
                'name' => $data['name'][$locale] ?? '',
                'description' => $data['description'][$locale] ?? '',
            ]);
        }
    }

    /**
     * Update translations for energy
     */
    private function updateTranslations(SubResourceEnergy $energy, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            SubResourceEnergyTranslation::updateOrCreate(
                [
                    'sub_resource_energy_id' => $energy->id,
                    'locale' => $locale,
                ],
                [
                    'name' => $data['name'][$locale] ?? '',
                    'description' => $data['description'][$locale] ?? '',
                ]
            );
        }
    }
}