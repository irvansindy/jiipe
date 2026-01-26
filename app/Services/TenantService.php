<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\TenantTranslation;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class TenantService
{
    /**
     * Get all tenants with translations (current locale)
     */
    public function getAllTenants()
    {
        $locale = app()->getLocale();

        return Tenant::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get tenant by ID and transform translations keyed by locale
     */
    public function getTenantById(int $id)
    {
        $tenant = Tenant::with('translations')->findOrFail($id);

        $transformed = [];
        foreach ($tenant->translations as $translation) {
            $transformed[$translation->locale] = [
                'locale' => $translation->locale,
                'name' => $translation->name,
                'description' => $translation->description ?? '',
            ];
        }

        // $tenant->translations = $transformed;
        $tenant->setRelation('translations', $transformed);

        $tenant->is_active = (bool) $tenant->is_active;

        return $tenant;
    }

    /**
     * Create a new tenant with translations and optional logo
     */
    public function createTenant(array $data, $file = null)
    {
        DB::beginTransaction();

        try {
            $logoPath = null;

            if ($file) {
                $logoPath = $this->uploadFile($file);
            }

            $tenant = Tenant::create([
                'logo' => $logoPath,
                'is_active' => isset($data['is_active']) ? (int)$data['is_active'] : 1,
            ]);

            $this->saveTranslations($tenant, $data);

            DB::commit();

            return $tenant;
        } catch (Exception $e) {
            DB::rollBack();
            if (!empty($logoPath)) {
                $this->deleteFile($logoPath);
            }
            throw $e;
        }
    }

    /**
     * Update existing tenant
     */
    public function updateTenant(int $id, array $data, $file = null)
    {
        DB::beginTransaction();

        try {
            $tenant = Tenant::findOrFail($id);
            $oldLogo = $tenant->logo;

            if ($file) {
                if ($oldLogo) {
                    $this->deleteFile($oldLogo);
                }

                $tenant->logo = $this->uploadFile($file);
            }

            $tenant->is_active = isset($data['is_active']) ? (int)$data['is_active'] : 1;
            $tenant->save();

            $this->updateTranslations($tenant, $data);

            DB::commit();

            return $tenant;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete tenant, its logo and translations
     */
    public function deleteTenant(int $id)
    {
        DB::beginTransaction();

        try {
            $tenant = Tenant::findOrFail($id);

            if ($tenant->logo) {
                $this->deleteFile($tenant->logo);
            }

            TenantTranslation::where('tenant_id', $id)->delete();
            $tenant->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Upload logo and optimize to WebP format
     */
    private function uploadFile($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = 'tenant_' . Str::random(20) . '_' . time() . '.' . $extension;
        $destinationPath = public_path('uploads/tenant-logo');

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $fileName);

        // Path relatif dari public
        $relativePath = 'uploads/tenant-logo/' . $fileName;

        // ✅ Optimize dan convert ke WebP
        try {
            $webpPath = ImageHelper::optimizeImage(
                $relativePath,  // Path relatif
                1200,          // Max width 1200px
                85             // Quality 85%
            );

            // Extract filename dari path
            $webpFilename = basename($webpPath);

            // Return hanya filename
            return $webpFilename;

        } catch (Exception $e) {
            // Jika gagal optimize, tetap return filename original
            \Log::warning("Failed to optimize tenant logo: " . $e->getMessage());
            return $fileName;
        }
    }

    /**
     * Delete file by full path or filename
     */
    private function deleteFile(string $filePath): bool
    {
        $trimmed = ltrim($filePath, '/');

        if (strpos($trimmed, '/') !== false || strpos($trimmed, '\\') !== false || strpos($trimmed, 'uploads/') === 0) {
            $fullPath = public_path($trimmed);
        } else {
            $fullPath = public_path('uploads/tenant-logo/' . $trimmed);
        }

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    private function saveTranslations(Tenant $tenant, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            TenantTranslation::create([
                'tenant_id' => $tenant->id,
                'locale' => $locale,
                'name' => $data['name'][$locale] ?? '',
                'description' => $data['description'][$locale] ?? '',
            ]);
        }
    }

    private function updateTranslations(Tenant $tenant, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            TenantTranslation::updateOrCreate(
                [
                    'tenant_id' => $tenant->id,
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
