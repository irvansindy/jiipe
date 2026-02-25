<?php

namespace App\Services;

use App\Models\AreaShowCase;
use App\Models\AreaShowCaseTranslation;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class AreaShowCaseService
{
    private const UPLOAD_DIR = 'uploads/showcase';

    public function getAllAreaShowCases()
    {
        $locale = app()->getLocale();

        return AreaShowCase::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->orderBy('position', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAreaShowCaseById(int $id): array
    {
        $item = AreaShowCase::with('translations')->findOrFail($id);

        $keyed = [];
        foreach ($item->translations as $translation) {
            $keyed[$translation->locale] = [
                'locale'      => $translation->locale,
                'title'       => $translation->title,
                'description' => $translation->description,
            ];
        }

        return array_merge($item->toArray(), [
            'translations' => $keyed,
            'is_active'    => (bool) $item->is_active,
        ]);
    }

    public function createAreaShowCase(array $data, $file = null, $fileMobile = null): AreaShowCase
    {
        DB::beginTransaction();

        try {
            $imagePath       = $file       ? $this->uploadFile($file)       : null;
            $imageMobilePath = $fileMobile ? $this->uploadFile($fileMobile) : null;

            $item = AreaShowCase::create([
                'image'        => $imagePath,
                'image_mobile' => $imageMobilePath,
                'position'     => $data['position'] ?? 0,
                'is_active'    => $data['is_active'] ?? 1,
            ]);

            $this->saveTranslations($item, $data);

            DB::commit();

            return $item;
        } catch (Exception $e) {
            DB::rollBack();

            if (isset($imagePath) && $imagePath) {
                $this->deleteFile($imagePath);
            }
            if (isset($imageMobilePath) && $imageMobilePath) {
                $this->deleteFile($imageMobilePath);
            }

            throw $e;
        }
    }

    public function updateAreaShowCase(int $id, array $data, $file = null, $fileMobile = null): AreaShowCase
    {
        DB::beginTransaction();

        try {
            $item = AreaShowCase::findOrFail($id);

            $updateData = [
                'position'  => $data['position'] ?? $item->position,
                'is_active' => $data['is_active'] ?? 1,
            ];

            if ($file) {
                if ($item->image) {
                    $this->deleteFile($item->image);
                }
                $updateData['image'] = $this->uploadFile($file);
            }

            if ($fileMobile) {
                if ($item->image_mobile) {
                    $this->deleteFile($item->image_mobile);
                }
                $updateData['image_mobile'] = $this->uploadFile($fileMobile);
            }

            $item->update($updateData);

            $this->updateTranslations($item, $data);

            DB::commit();

            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteAreaShowCase(int $id): bool
    {
        DB::beginTransaction();

        try {
            $item = AreaShowCase::findOrFail($id);

            if ($item->image) {
                $this->deleteFile($item->image);
            }
            if ($item->image_mobile) {
                $this->deleteFile($item->image_mobile);
            }

            AreaShowCaseTranslation::where('area_show_case_id', $id)->delete();

            $item->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Upload image, convert ke WebP via ImageHelper, simpan filename WebP ke DB.
     *
     * Alur:
     * 1. Pindahkan file original ke UPLOAD_DIR
     * 2. ImageHelper::optimizeImage() konversi ke WebP, return relative path WebP
     * 3. Hapus file original (jpg/png/etc) karena sudah ada versi WebP
     * 4. Return hanya filename WebP (bukan full path) untuk disimpan di DB
     */
    private function uploadFile($file): string
    {
        $extension       = $file->getClientOriginalExtension();
        $originalName    = Str::random(20) . '_' . time() . '.' . $extension;
        $destinationPath = public_path(self::UPLOAD_DIR);

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Pindahkan file original ke direktori upload
        $file->move($destinationPath, $originalName);

        // Relative path dari public/ (format yang dipakai ImageHelper)
        $relativePath = self::UPLOAD_DIR . '/' . $originalName;

        // Konversi ke WebP — return relative path ke file WebP hasil konversi
        $webpRelativePath = ImageHelper::optimizeImage($relativePath);

        // Hapus file original jika WebP berhasil dibuat dan berbeda dari original
        if ($webpRelativePath !== $relativePath && File::exists(public_path($relativePath))) {
            File::delete(public_path($relativePath));
        }

        // Simpan hanya filename (konsisten dengan SliderService yang simpan filename saja)
        return basename($webpRelativePath);
    }

    /**
     * Delete file dari storage.
     * Terima filename saja (dari DB) atau relative path.
     */
    private function deleteFile(string $filePath): bool
    {
        $trimmed = ltrim($filePath, '/');

        $fullPath = (strpos($trimmed, '/') !== false || strpos($trimmed, '\\') !== false)
            ? public_path($trimmed)
            : public_path(self::UPLOAD_DIR . '/' . $trimmed);

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    private function saveTranslations(AreaShowCase $item, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            AreaShowCaseTranslation::create([
                'area_show_case_id' => $item->id,
                'locale'            => $locale,
                'title'             => $data['title'][$locale] ?? '',
                'description'       => $data['description'][$locale] ?? '',
            ]);
        }
    }

    private function updateTranslations(AreaShowCase $item, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            AreaShowCaseTranslation::updateOrCreate(
                [
                    'area_show_case_id' => $item->id,
                    'locale'            => $locale,
                ],
                [
                    'title'       => $data['title'][$locale] ?? '',
                    'description' => $data['description'][$locale] ?? '',
                ]
            );
        }
    }
}