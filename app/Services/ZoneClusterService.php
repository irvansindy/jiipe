<?php

namespace App\Services;

use App\Models\ZoneCluster;
use App\Models\ZoneClusterTranslation;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Exception;

class ZoneClusterService
{
    /**
     * Get all clusters by zone (only for zone_class_id = 1)
     */
    public function getClustersByZone(int $zoneId, string $locale = null)
    {
        $this->validateZoneClass($zoneId);

        $locale = $locale ?? app()->getLocale();

        return ZoneCluster::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->where('zone_id', $zoneId)
        ->orderBy('created_at', 'desc')
        ->get();
    }

    /**
     * Get cluster by ID with all translations
     */
    public function getClusterById(int $id)
    {
        $cluster = ZoneCluster::with(['translations'])->findOrFail($id);

        $this->validateZoneClass($cluster->zone_id);

        $locales = config('laravellocalization.supportedLocales');
        $translations = [];

        foreach ($locales as $locale => $properties) {
            $trans = $cluster->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'name' => $trans ? $trans->name : '',
                'description' => $trans ? $trans->description : '',
            ];
        }

        return [
            'id' => $cluster->id,
            'zone_id' => $cluster->zone_id,
            'translations' => $translations,
        ];
    }

    /**
     * Create new cluster
     */
    public function createCluster(array $data)
    {
        $this->validateZoneClass($data['zone_id']);

        DB::beginTransaction();

        try {
            $cluster = ZoneCluster::create([
                'zone_id' => $data['zone_id'],
            ]);

            $this->saveTranslations($cluster, $data);

            DB::commit();

            return $cluster;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update existing cluster
     */
    public function updateCluster(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $cluster = ZoneCluster::findOrFail($id);

            $this->validateZoneClass($cluster->zone_id);

            $cluster->zone_id = $data['zone_id'];
            $cluster->save();

            $this->updateTranslations($cluster, $data);

            DB::commit();

            return $cluster;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete cluster
     */
    public function deleteCluster(int $id)
    {
        DB::beginTransaction();

        try {
            $cluster = ZoneCluster::findOrFail($id);

            $this->validateZoneClass($cluster->zone_id);

            ZoneClusterTranslation::where('zone_cluster_id', $id)->delete();
            $cluster->delete();

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
            throw new Exception('Zone clusters are only available for zone_class_id = 1');
        }
    }

    /**
     * Save translations for cluster
     */
    private function saveTranslations(ZoneCluster $cluster, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            ZoneClusterTranslation::create([
                'zone_cluster_id' => $cluster->id,
                'locale' => $locale,
                'name' => $data['name'][$locale] ?? '',
                'description' => $data['description'][$locale] ?? '',
            ]);
        }
    }

    /**
     * Update translations for cluster
     */
    private function updateTranslations(ZoneCluster $cluster, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            ZoneClusterTranslation::updateOrCreate(
                [
                    'zone_clusters_id' => $cluster->id,
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