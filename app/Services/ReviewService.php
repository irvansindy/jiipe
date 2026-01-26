<?php

namespace App\Services;

use App\Models\Review;
use App\Helpers\ImageHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Exception;

class ReviewService
{
    protected $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];

    public function fetch(string $locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return Review::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }])->get();
    }

    public function find(int $id)
    {
        return Review::with('translations')->findOrFail($id);
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $photoFileName = null;
            if (!empty($data['_file_photo']) && $data['_file_photo']->isValid()) {
                $photoFileName = $this->uploadFile($data['_file_photo']);
            }

            $review = Review::create([
                'name' => Arr::get($data, 'name'),
                'position' => Arr::get($data, 'position'),
                'is_active' => Arr::get($data, 'is_active', 0), // Default 0 jika tidak ada
                'photo' => $photoFileName,
            ]);

            foreach ($this->locales as $locale) {
                $field = 'description_' . $locale;
                if (isset($data[$field]) && $data[$field] !== null) {
                    $review->translations()->create([
                        'locale' => $locale,
                        'description' => $data[$field],
                    ]);
                }
            }

            DB::commit();
            return $review->load('translations');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $review = Review::findOrFail($id);

            $review->name = Arr::get($data, 'name', $review->name);
            $review->position = Arr::get($data, 'position', $review->position);

            // PENTING: Pastikan is_active diupdate dengan benar
            if (array_key_exists('is_active', $data)) {
                $review->is_active = $data['is_active'];
            }

            if (!empty($data['_file_photo']) && $data['_file_photo']->isValid()) {
                // delete old photo
                if ($review->photo) {
                    $this->deleteFile($review->photo);
                }
                $fileName = $this->uploadFile($data['_file_photo']);
                $review->photo = $fileName;
            }

            $review->save();

            foreach ($this->locales as $locale) {
                $field = 'description_' . $locale;
                if (array_key_exists($field, $data)) {
                    $value = $data[$field];
                    if ($value !== null) {
                        $review->translations()->updateOrCreate(
                            ['locale' => $locale],
                            ['description' => $value]
                        );
                    }
                }
            }

            DB::commit();
            return $review->load('translations');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $review = Review::findOrFail($id);
            if ($review->photo) {
                $this->deleteFile($review->photo);
            }
            $review->translations()->delete();
            $review->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Upload file to `public/uploads/review` and optimize to WebP
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     * @throws Exception
     */
    private function uploadFile($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = 'review_' . Str::random(20) . '_' . time() . '.' . $extension;
        $destinationPath = public_path('uploads/review');

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $moved = $file->move($destinationPath, $fileName);
        if (!$moved) {
            throw new Exception('Failed to move uploaded file');
        }

        // Path relatif dari public
        $relativePath = 'uploads/review/' . $fileName;

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
            \Log::warning("Failed to optimize review photo: " . $e->getMessage());
            return $fileName;
        }
    }

    /**
     * Delete uploaded file from `public/uploads/review` by filename
     * Also delete original JPG/PNG if WebP exists
     *
     * @param string $fileName
     * @return bool
     */
    private function deleteFile(string $fileName): bool
    {
        $trimmed = ltrim($fileName, '/');
        $fullPath = public_path('uploads/review/' . $trimmed);
        $deleted = false;

        // Delete WebP file
        if (File::exists($fullPath)) {
            File::delete($fullPath);
            $deleted = true;
        }

        // ✅ Delete original JPG if exists
        $originalPath = preg_replace('/\.webp$/i', '.jpg', $fullPath);
        if (File::exists($originalPath)) {
            File::delete($originalPath);
        }

        // Delete original PNG if exists
        $originalPath = preg_replace('/\.webp$/i', '.png', $fullPath);
        if (File::exists($originalPath)) {
            File::delete($originalPath);
        }

        return $deleted;
    }

    public function toggleStatus(int $id)
    {
        $review = Review::findOrFail($id);
        $review->is_active = !$review->is_active;
        $review->save();
        return $review;
    }
}
