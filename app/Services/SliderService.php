<?php

namespace App\Services;

use App\Models\HomeSlider;
use App\Models\HomeSliderTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class SliderService
{
    protected $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];
    /**
     * Get all sliders with translations
     */
    public function getAllSliders()
    {
        $locale = $locale ?? app()->getLocale();
        return HomeSlider::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);}])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get slider by ID with translations
     */
    public function getSliderById(int $id)
    {
        $slider = HomeSlider::with('translations')->findOrFail($id);

        // Transform translations to be keyed by locale
        $transformedTranslations = [];
        foreach ($slider->translations as $translation) {
            $transformedTranslations[$translation->locale] = [
                'locale' => $translation->locale,
                'title' => $translation->title,
                'description' => $translation->description,
            ];
        }

        $slider->translations = $transformedTranslations;

        // expose slider-level is_active for frontend
        $slider->is_active = (bool) $slider->is_active;

        return $slider;
    }

    /**
     * Create new slider
     */
    public function createSlider(array $data, $file = null)
    {
        DB::beginTransaction();

        try {
            $filePath = null;

            if ($file) {
                $filePath = $this->uploadFile($file);
            }

            // Store is_active on the slider (not on translations)
            $slider = HomeSlider::create([
                'file' => $filePath,
                'is_active' => $data['is_active'] ?? 1,
            ]);

            $this->saveTranslations($slider, $data);

            DB::commit();

            return $slider;
        } catch (Exception $e) {
            DB::rollBack();

            // Delete uploaded file if transaction fails
            if (isset($filePath) && $filePath) {
                $this->deleteFile($filePath);
            }

            throw $e;
        }
    }

    /**
     * Update existing slider
     */
    public function updateSlider(int $id, array $data, $file = null)
    {
        DB::beginTransaction();

        try {
            $slider = HomeSlider::findOrFail($id);
            $oldFilePath = $slider->file;

            // Handle file upload
            $updateData = [];

            if ($file) {
                // Delete old file
                if ($oldFilePath) {
                    $this->deleteFile($oldFilePath);
                }

                // Upload new file
                $newFilePath = $this->uploadFile($file);
                $updateData['file'] = $newFilePath;
            }

            // Update is_active on the slider
            $updateData['is_active'] = $data['is_active'] ?? 1;

            $slider->update($updateData);

            $this->updateTranslations($slider, $data);

            DB::commit();

            return $slider;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete slider
     */
    public function deleteSlider(int $id)
    {
        DB::beginTransaction();

        try {
            $slider = HomeSlider::findOrFail($id);

            // Delete file if exists
            if ($slider->file) {
                $this->deleteFile($slider->file);
            }

            // Delete translations
            HomeSliderTranslation::where('home_sliders', $id)->delete();

            // Delete slider
            $slider->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Upload file and return filename only
     */
    private function uploadFile($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random(20) . '_' . time() . '.' . $extension;
        $destinationPath = public_path('uploads/home-slider');

        // Create directory if not exists
        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        // Move file
        $file->move($destinationPath, $fileName);

        // Return filename only; store filename in DB instead of full path
        return $fileName;
    }

    /**
     * Delete file from storage
     *
     * Accepts either a full path (e.g. 'uploads/home-slider/xxx.jpg')
     * or a filename only ('xxx.jpg'). If a filename is provided,
     * the file is assumed to live under `public/uploads/home-slider`.
     */
    private function deleteFile(string $filePath): bool
    {
        $trimmed = ltrim($filePath, '/');

        // If it already looks like a path (contains slash or starts with 'uploads/'), use it as-is.
        if (strpos($trimmed, '/') !== false || strpos($trimmed, '\\') !== false || strpos($trimmed, 'uploads/') === 0) {
            $fullPath = public_path($trimmed);
        } else {
            // Otherwise assume it's a filename stored in DB and build the path.
            $fullPath = public_path('uploads/home-slider/' . $trimmed);
        }

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }

    /**
     * Save translations for slider
     */
    private function saveTranslations(HomeSlider $slider, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            HomeSliderTranslation::create([
                'home_sliders' => $slider->id,
                'locale' => $locale,
                'title' => $data['title'][$locale] ?? '',
                'description' => $data['description'][$locale] ?? '',
            ]);
        }
    }

    /**
     * Update translations for slider
     */
    private function updateTranslations(HomeSlider $slider, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            HomeSliderTranslation::updateOrCreate(
                [
                    'home_sliders' => $slider->id,
                    'locale' => $locale,
                ],
                [
                    'title' => $data['title'][$locale] ?? '',
                    'description' => $data['description'][$locale] ?? '',
                ]
            );
        }
    }
}
