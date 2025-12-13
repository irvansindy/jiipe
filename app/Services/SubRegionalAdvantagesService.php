<?php

namespace App\Services;

use App\Models\SubRegionalAdvantages;
use App\Models\SubRegionalAdvantagesTranslation;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class SubRegionalAdvantagesService
{
    /**
     * Get all advantages by zone (only for zone_class_id = 1)
     */
    public function getAdvantagesByZone(int $zoneId, string $locale = null)
    {
        $this->validateZoneClass($zoneId);

        $locale = $locale ?? app()->getLocale();

        return SubRegionalAdvantages::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('zone_id', $zoneId)
        ->orderBy('order', 'asc')
        ->get();
    }

    /**
     * Get advantage by ID with all translations
     */
    public function getAdvantageById(int $id)
    {
        $advantage = SubRegionalAdvantages::with(['translations'])->findOrFail($id);

        $this->validateZoneClass($advantage->zone_id);

        $locales = config('laravellocalization.supportedLocales');
        $translations = [];

        foreach ($locales as $locale => $properties) {
            $trans = $advantage->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'name' => $trans ? $trans->name : '',
                'description' => $trans ? $trans->description : '',
            ];
        }

        return [
            'id' => $advantage->id,
            'zone_id' => $advantage->zone_id,
            'image' => $advantage->image,
            'icon' => $advantage->icon,
            'order' => $advantage->order,
            'translations' => $translations,
        ];
    }

    /**
     * Create new advantage
     */
    public function createAdvantage(array $data, $imageFile = null, $iconFile = null)
    {
        $this->validateZoneClass($data['zone_id']);

        DB::beginTransaction();

        try {
            $imagePath = null;
            $iconPath = null;

            if ($imageFile) {
                $imagePath = $this->uploadFile($imageFile, 'uploads/zones/feature');
            }

            if ($iconFile) {
                $iconPath = $this->uploadFile($iconFile, 'advantages/icons');
            }

            $advantage = SubRegionalAdvantages::create([
                'zone_id' => $data['zone_id'],
                'image' => $imagePath,
                'icon' => $iconPath,
                'order' => $data['order'] ?? 0,
            ]);

            $this->saveTranslations($advantage, $data);

            DB::commit();

            return $advantage;
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
     * Update existing advantage
     */
    public function updateAdvantage(int $id, array $data, $imageFile = null, $iconFile = null)
    {
        DB::beginTransaction();

        try {
            $advantage = SubRegionalAdvantages::findOrFail($id);

            $this->validateZoneClass($advantage->zone_id);

            $oldImagePath = $advantage->image;
            $oldIconPath = $advantage->icon;

            if ($imageFile) {
                if ($oldImagePath) {
                    $this->deleteFile($oldImagePath);
                }
                $advantage->image = $this->uploadFile($imageFile, 'uploads/zones/feature');
            }

            if ($iconFile) {
                if ($oldIconPath) {
                    $this->deleteFile($oldIconPath);
                }
                $advantage->icon = $this->uploadFile($iconFile, 'advantages/icons');
            }

            $advantage->zone_id = $data['zone_id'];
            $advantage->order = $data['order'] ?? $advantage->order;
            $advantage->save();

            $this->updateTranslations($advantage, $data);

            DB::commit();

            return $advantage;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete advantage
     */
    public function deleteAdvantage(int $id)
    {
        DB::beginTransaction();

        try {
            $advantage = SubRegionalAdvantages::findOrFail($id);

            $this->validateZoneClass($advantage->zone_id);

            if ($advantage->image) {
                $this->deleteFile($advantage->image);
            }

            if ($advantage->icon) {
                $this->deleteFile($advantage->icon);
            }

            SubRegionalAdvantagesTranslation::where('sub_regional_advantages_id', $id)->delete();
            $advantage->delete();

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
            throw new Exception('Regional advantages are only available for zone_class_id = 1');
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
        $fullPath = public_path('uploads/zones/feature/' . $filePath);

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Save translations for advantage
     */
    private function saveTranslations(SubRegionalAdvantages $advantage, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            SubRegionalAdvantagesTranslation::create([
                'sub_regional_advantages_id' => $advantage->id,
                'locale' => $locale,
                'name' => $data['name'][$locale] ?? '',
                'description' => $data['description'][$locale] ?? '',
            ]);
        }
    }

    /**
     * Update translations for advantage
     */
    private function updateTranslations(SubRegionalAdvantages $advantage, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            SubRegionalAdvantagesTranslation::updateOrCreate(
                [
                    'sub_regional_advantages_id' => $advantage->id,
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