<?php

namespace App\Services;

use App\Models\SubDevelopment;
use App\Models\SubDevelopmentTranslation;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Exception;

class SubDevelopmentService
{
    /**
     * Get all developments by zone (only for zone_class_id = 1)
     */
    public function getDevelopmentsByZone(int $zoneId, string $locale = null)
    {
        $this->validateZoneClass($zoneId);

        $locale = $locale ?? app()->getLocale();

        return SubDevelopment::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('zone_id', $zoneId)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    /**
     * Get development by ID with all translations
     */
    public function getDevelopmentById(int $id)
    {
        $development = SubDevelopment::with(['translations'])->findOrFail($id);

        $this->validateZoneClass($development->zone_id);

        $locales = config('laravellocalization.supportedLocales');
        $translations = [];

        foreach ($locales as $locale => $properties) {
            $trans = $development->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'name' => $trans ? $trans->name : '',
                'description' => $trans ? $trans->description : '',
            ];
        }

        return [
            'id' => $development->id,
            'zone_id' => $development->zone_id,
            'translations' => $translations,
        ];
    }

    /**
     * Create new development
     */
    public function createDevelopment(array $data)
    {
        $this->validateZoneClass($data['zone_id']);

        DB::beginTransaction();

        try {
            $development = SubDevelopment::create([
                'zone_id' => $data['zone_id'],
            ]);

            $this->saveTranslations($development, $data);

            DB::commit();

            return $development;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update existing development
     */
    public function updateDevelopment(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $development = SubDevelopment::findOrFail($id);

            $this->validateZoneClass($development->zone_id);

            $development->zone_id = $data['zone_id'];
            $development->save();

            $this->updateTranslations($development, $data);

            DB::commit();

            return $development;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete development
     */
    public function deleteDevelopment(int $id)
    {
        DB::beginTransaction();

        try {
            $development = SubDevelopment::findOrFail($id);

            $this->validateZoneClass($development->zone_id);

            SubDevelopmentTranslation::where('sub_development_id', $id)->delete();
            $development->delete();

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
            throw new Exception('Sub developments are only available for zone_class_id = 1');
        }
    }

    /**
     * Save translations for development
     */
    private function saveTranslations(SubDevelopment $development, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            SubDevelopmentTranslation::create([
                'sub_development_id' => $development->id,
                'locale' => $locale,
                'name' => $data['name'][$locale] ?? '',
                'description' => $data['description'][$locale] ?? '',
            ]);
        }
    }

    /**
     * Update translations for development
     */
    private function updateTranslations(SubDevelopment $development, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            SubDevelopmentTranslation::updateOrCreate(
                [
                    'sub_development_id' => $development->id,
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