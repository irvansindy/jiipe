<?php

namespace App\Services;

use App\Models\Zone;
use App\Models\ZoneTranslation;
use App\Models\ZoneClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class ZoneService
{
    /**
     * Get zones by zone class
     */
    public function getZonesByClass(int $zoneClassId, string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return Zone::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('zone_class_id', $zoneClassId)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    /**
     * Get all zone classes with translations
     */
    public function getAllZoneClasses(string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return ZoneClass::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])->get();
    }

    /**
     * Get zone by ID with all translations
     */
    public function getZoneById(int $id)
    {
        $locales = config('laravellocalization.supportedLocales');
        $zone = Zone::with(['translations'])->findOrFail($id);

        $translations = [];
        foreach ($locales as $locale => $properties) {
            $trans = $zone->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'name' => $trans ? $trans->name : '',
                'subtitle' => $trans ? $trans->subtitle : '',
                'description' => $trans ? $trans->description : '',
                'note' => $trans ? $trans->note : '',
            ];
        }

        return [
            'id' => $zone->id,
            'zone_class_id' => $zone->zone_class_id,
            'image' => $zone->image,
            'translations' => $translations,
        ];
    }

    /**
     * Create new zone
     */
    public function createZone(array $data, $imageFile = null)
    {
        DB::beginTransaction();

        try {
            $imagePath = null;

            if ($imageFile) {
                $imagePath = $this->uploadImage($imageFile);
            }

            $zone = Zone::create([
                'zone_class_id' => $data['zone_class'],
                'image' => $imagePath,
            ]);

            $this->saveTranslations($zone, $data);

            DB::commit();

            return $zone;
        } catch (Exception $e) {
            DB::rollBack();

            // Delete uploaded image if transaction fails
            if (isset($imagePath) && $imagePath) {
                $this->deleteImage($imagePath);
            }

            throw $e;
        }
    }

    /**
     * Update existing zone
     */
    public function updateZone(int $id, array $data, $imageFile = null)
    {
        DB::beginTransaction();

        try {
            $zone = Zone::findOrFail($id);
            $oldImagePath = $zone->image;

            // Handle image upload
            if ($imageFile) {
                // Delete old image
                if ($oldImagePath) {
                    $this->deleteImage($oldImagePath);
                }

                // Upload new image
                $newImagePath = $this->uploadImage($imageFile);
                $zone->image = $newImagePath;
            }

            $zone->zone_class_id = $data['zone_class'];
            $zone->save();

            $this->updateTranslations($zone, $data);

            DB::commit();

            return $zone;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete zone
     */
    public function deleteZone(int $id)
    {
        DB::beginTransaction();

        try {
            $zone = Zone::findOrFail($id);

            // Delete image if exists
            if ($zone->image) {
                $this->deleteImage($zone->image);
            }

            // Delete translations
            ZoneTranslation::where('zone_id', $id)->delete();

            // Delete zone
            $zone->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Upload image and return path
     */
    private function uploadImage($file): string
    {
        return $file->store('zones', 'uploads');
    }

    /**
     * Delete image from storage
     */
    private function deleteImage(string $imagePath): bool
    {
        $fullPath = public_path('uploads/' . $imagePath);

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Save translations for zone
     */
    private function saveTranslations(Zone $zone, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            ZoneTranslation::create([
                'zone_id' => $zone->id,
                'locale' => $locale,
                'name' => $data['zone_name'][$locale] ?? '',
                'subtitle' => $data['zone_subtitle'][$locale] ?? '',
                'description' => $data['zone_description'][$locale] ?? '',
                'meta_title' => $data['zone_name'][$locale] ?? '',
                'meta_description' => $data['zone_description'][$locale] ?? '',
                'note' => $data['zone_note'][$locale] ?? '',
            ]);
        }
    }

    /**
     * Update translations for zone
     */
    private function updateTranslations(Zone $zone, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            ZoneTranslation::updateOrCreate(
                [
                    'zone_id' => $zone->id,
                    'locale' => $locale,
                ],
                [
                    'name' => $data['zone_name'][$locale] ?? '',
                    'subtitle' => $data['zone_subtitle'][$locale] ?? '',
                    'description' => $data['zone_description'][$locale] ?? '',
                    'meta_title' => $data['zone_name'][$locale] ?? '',
                    'meta_description' => $data['zone_description'][$locale] ?? '',
                    'note' => $data['zone_note'][$locale] ?? '',
                ]
            );
        }
    }
}