<?php

namespace App\Services;

use App\Models\GalleryBrochure;
use App\Models\GalleryBrochuresTranslations;
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
                'file' => $trans ? $trans->file : '',
            ];
        }

        return [
            'id' => $brochure->id,
            'image' => $brochure->image,
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

            if ($imageFile) {
                $imagePath = $this->uploadFile($imageFile, 'brochures/images');
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

            if (isset($imagePath) && $imagePath) {
                $this->deleteFile($imagePath);
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

            if ($imageFile) {
                if ($oldImagePath && $oldImagePath !== 'default.jpg') {
                    $this->deleteFile($oldImagePath);
                }
                $brochure->image = $this->uploadFile($imageFile, 'brochures/images');
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

            // Delete main image
            if ($brochure->image && $brochure->image !== 'default.jpg') {
                $this->deleteFile($brochure->image);
            }

            // Delete translation files
            $translations = GalleryBrochuresTranslations::where('gallery_brochure_id', $id)->get();
            foreach ($translations as $trans) {
                if ($trans->file) {
                    $this->deleteFile($trans->file);
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
                    $this->deleteFile($oldTrans->file);
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