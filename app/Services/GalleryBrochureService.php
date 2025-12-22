<?php

namespace App\Services;

use App\Models\GalleryBrochure;
use App\Models\GalleryBrochuresTranslations;
use App\Helpers\ImageHelper; // ✅ Import ImageHelper
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class GalleryBrochureService
{
    /**
     * Get all brochures with translations
     */
    public function getAllBrochures(string $locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        return GalleryBrochure::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }
        ])
        ->orderBy('created_at', 'desc')
        ->get();
    }

    /**
     * Get brochure by ID with all translations
     */
    public function getBrochureById(int $id)
    {
        $brochure = GalleryBrochure::with(['translations'])->findOrFail($id);

        $locales = config('laravellocalization.supportedLocales');
        $translations = [];

        foreach ($locales as $locale => $properties) {
            $trans = $brochure->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'title' => $trans ? $trans->title : '',
                'subtitle' => $trans ? $trans->sub_title : '',
                'file' => $trans && $trans->file ? 'brochures/files/' . $trans->file : '',
            ];
        }

        return [
            'id' => $brochure->id,
            'image' => $brochure->image && $brochure->image !== 'default.jpg'
                ? 'brochures/images/' . $brochure->image
                : $brochure->image,
            'is_active' => $brochure->is_active,
            'translations' => $translations,
        ];
    }

    /**
     * Create new brochure
     */
    public function createBrochure(array $data, $imageFile = null, array $files = [])
    {
        DB::beginTransaction();

        try {
            $imagePath = null;

            // ✅ Upload dan optimize image ke WebP
            if ($imageFile) {
                $imagePath = $this->uploadAndOptimizeImage($imageFile, 'brochures/images');
            }

            $brochure = GalleryBrochure::create([
                'image' => $imagePath ?? 'default.jpg',
                'is_active' => $data['is_active'],
                'date_input' => now(),
                'date_update' => now(),
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'writer' => auth()->id(),
            ]);

            $this->saveTranslations($brochure, $data, $files);

            DB::commit();

            return $brochure;
        } catch (Exception $e) {
            DB::rollBack();

            // Cleanup jika error
            if (isset($imagePath) && $imagePath) {
                $this->deleteFile($imagePath, 'brochures/images');
            }

            throw $e;
        }
    }

    /**
     * Update existing brochure
     */
    public function updateBrochure(int $id, array $data, $imageFile = null, array $files = [])
    {
        DB::beginTransaction();

        try {
            $brochure = GalleryBrochure::findOrFail($id);

            $oldImagePath = $brochure->image;

            // ✅ Upload dan optimize image baru
            if ($imageFile) {
                // Delete old image
                if ($oldImagePath && $oldImagePath !== 'default.jpg') {
                    $this->deleteFile($oldImagePath, 'brochures/images');
                }

                // Upload dan optimize ke WebP
                $brochure->image = $this->uploadAndOptimizeImage($imageFile, 'brochures/images');
            }

            $brochure->is_active = $data['is_active'];
            $brochure->date_update = now();
            $brochure->updated_by = auth()->id();
            $brochure->save();

            $this->updateTranslations($brochure, $data, $files);

            DB::commit();

            return $brochure;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete brochure
     */
    public function deleteBrochure(int $id)
    {
        DB::beginTransaction();

        try {
            $brochure = GalleryBrochure::findOrFail($id);

            // Delete main image (termasuk WebP)
            if ($brochure->image && $brochure->image !== 'default.jpg') {
                $this->deleteFile($brochure->image, 'brochures/images');

                // ✅ Delete file JPG original jika ada
                $originalPath = preg_replace('/\.webp$/i', '.jpg', $brochure->image);
                $this->deleteFile($originalPath, 'brochures/images');

                $originalPath = preg_replace('/\.webp$/i', '.png', $brochure->image);
                $this->deleteFile($originalPath, 'brochures/images');
            }

            // Delete translation files (PDFs)
            $translations = GalleryBrochuresTranslations::where('gallery_brochure_id', $id)->get();
            foreach ($translations as $trans) {
                if ($trans->file) {
                    $this->deleteFile($trans->file, 'brochures/files');
                }
            }

            GalleryBrochuresTranslations::where('gallery_brochure_id', $id)->delete();
            $brochure->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * ✅ NEW: Upload dan optimize image ke WebP
     */
    private function uploadAndOptimizeImage($file, string $folder): string
    {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Full path untuk upload
        $uploadPath = public_path('uploads/' . $folder);

        // Buat direktori jika belum ada
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // Move file ke folder tujuan
        $file->move($uploadPath, $filename);

        // Path relatif dari public
        $relativePath = 'uploads/' . $folder . '/' . $filename;

        // ✅ Optimize dan convert ke WebP
        try {
            $webpPath = ImageHelper::optimizeImage(
                $relativePath,  // Path relatif
                1200,          // Max width 1200px
                85             // Quality 85%
            );

            // Extract filename dari path
            $webpFilename = basename($webpPath);

            // Return hanya filename (konsisten dengan method lama)
            return $webpFilename;

        } catch (Exception $e) {
            // Jika gagal optimize, tetap return filename original
            \Log::warning("Failed to optimize image: " . $e->getMessage());
            return $filename;
        }
    }

    /**
     * Upload file (untuk PDF) - tidak perlu optimize
     */
    private function uploadFile($file, string $folder): string
    {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Store file in the specified folder
        $file->storeAs($folder, $filename, 'uploads');

        // Return only filename (without path)
        return $filename;
    }

    /**
     * Delete file from storage
     */
    private function deleteFile(string $filename, string $folder): bool
    {
        $fullPath = public_path('uploads/' . $folder . '/' . $filename);

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Save translations for brochure
     */
    private function saveTranslations(GalleryBrochure $brochure, array $data, array $files): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            $filePath = null;

            if (isset($files[$locale]) && $files[$locale]) {
                $filePath = $this->uploadFile($files[$locale], 'brochures/files');
            }

            GalleryBrochuresTranslations::create([
                'gallery_brochure_id' => $brochure->id,
                'locale' => $locale,
                'title' => $data['title'][$locale] ?? '',
                'sub_title' => $data['subtitle'][$locale] ?? '',
                'file' => $filePath,
            ]);
        }
    }

    /**
     * Update translations for brochure
     */
    private function updateTranslations(GalleryBrochure $brochure, array $data, array $files): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            $transData = [
                'title' => $data['title'][$locale] ?? '',
                'sub_title' => $data['subtitle'][$locale] ?? '',
            ];

            // Handle file upload for this locale
            if (isset($files[$locale]) && $files[$locale]) {
                $oldTrans = GalleryBrochuresTranslations::where([
                    'gallery_brochure_id' => $brochure->id,
                    'locale' => $locale,
                ])->first();

                // Delete old file if exists
                if ($oldTrans && $oldTrans->file) {
                    $this->deleteFile($oldTrans->file, 'brochures/files');
                }

                $transData['file'] = $this->uploadFile($files[$locale], 'brochures/files');
            }

            GalleryBrochuresTranslations::updateOrCreate(
                [
                    'gallery_brochure_id' => $brochure->id,
                    'locale' => $locale,
                ],
                $transData
            );
        }
    }
}