<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\GalleryTranslations;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Exception;

class GalleryService
{
    /**
     * Get all galleries with translations
     */
    public function getAllGalleries($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return Gallery::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'images'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(8);
    }

    /**
     * Get gallery by ID with translations and images
     */
    public function getGalleryById(int $id)
    {
        $gallery = Gallery::with(['translations', 'images'])->findOrFail($id);

        // Transform translations to be keyed by locale
        $transformedTranslations = [];
        foreach ($gallery->translations as $translation) {
            $transformedTranslations[$translation->locale] = [
                'title' => $translation->title,
                'sub_title' => $translation->sub_title,
                'sub_title_2' => $translation->sub_title_2,
                'content' => $translation->content,
            ];
        }

        $gallery->translations_by_locale = $transformedTranslations;
        $gallery->is_active = (bool) $gallery->is_active;

        return $gallery;
    }

    /**
     * Create new gallery
     */
    public function createGallery(array $data, $mainImageFile = null, $detailImageFiles = null)
    {
        DB::beginTransaction();

        try {
            $imagePath = null;

            if ($mainImageFile) {
                $imagePath = $this->uploadMainImage($mainImageFile);
            }

            // Create gallery record
            $gallery = Gallery::create([
                'topic_id' => $data['gallery_topic'],
                'image' => $imagePath,
                'is_active' => $data['gallery_status'] ?? 1,
                'url_video' => $data['gallery_video_url'] ?? null,
                'date_input' => now(),
                'date_update' => now(),
                'created_by' => auth()->id() ?? 1,
                'updated_by' => auth()->id() ?? 1,
                'writer' => auth()->id() ?? 1,
            ]);

            // Save translations
            $this->saveTranslations($gallery, $data);

            // Upload detail images
            if ($detailImageFiles && count($detailImageFiles) > 0) {
                $this->uploadDetailImages($gallery, $detailImageFiles);
            }

            DB::commit();
            return $gallery;
        } catch (Exception $e) {
            DB::rollBack();

            // Delete uploaded main image if transaction fails
            if (isset($imagePath) && Storage::disk('uploads')->exists($imagePath)) {
                Storage::disk('uploads')->delete($imagePath);
            }

            throw $e;
        }
    }

    /**
     * Update existing gallery
     */
    public function updateGallery(int $id, array $data, $mainImageFile = null, $detailImageFiles = null)
    {
        DB::beginTransaction();

        try {
            $gallery = Gallery::with('images', 'translations')->findOrFail($id);
            $oldImage = $gallery->image;

            // Update main fields
            $gallery->topic_id = $data['gallery_topic'];
            $gallery->is_active = $data['gallery_status'];
            $gallery->url_video = $data['gallery_video_url'] ?? null;
            $gallery->date_update = now();
            $gallery->updated_by = auth()->id() ?? 1;

            // Handle main image update
            if ($mainImageFile) {
                // Upload new image first
                $imagePath = $this->uploadMainImage($mainImageFile);
                $gallery->image = $imagePath;

                // Delete old image after successful upload
                if ($oldImage && Storage::disk('uploads')->exists($oldImage)) {
                    Storage::disk('uploads')->delete($oldImage);
                }
            }

            $gallery->save();

            // Update translations
            $this->updateTranslations($gallery, $data);

            // Upload new detail images
            if ($detailImageFiles && count($detailImageFiles) > 0) {
                $this->uploadDetailImages($gallery, $detailImageFiles);
            }

            DB::commit();
            return $gallery;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete gallery
     */
    public function deleteGallery(int $id)
    {
        DB::beginTransaction();

        try {
            $gallery = Gallery::with('images', 'translations')->findOrFail($id);

            // Delete main image
            if ($gallery->image && Storage::disk('uploads')->exists($gallery->image)) {
                Storage::disk('uploads')->delete($gallery->image);
            }

            // Delete detail images
            foreach ($gallery->images as $image) {
                if (Storage::disk('uploads')->exists($image->image)) {
                    Storage::disk('uploads')->delete($image->image);
                }
                $image->delete();
            }

            // Delete translations
            $gallery->translations()->delete();

            // Delete gallery
            $gallery->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete single detail image
     */
    public function deleteDetailImage(int $imageId)
    {
        DB::beginTransaction();

        try {
            $image = GalleryImage::findOrFail($imageId);

            // Delete file from storage
            if (Storage::disk('uploads')->exists($image->image)) {
                Storage::disk('uploads')->delete($image->image);
            }

            // Delete record
            $image->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Upload and process main image
     */
    private function uploadMainImage($file): string
    {
        try {
            $filename = uniqid() . '_main.' . $file->getClientOriginalExtension();
            $path = 'gallery/' . $filename;

            $manager = new ImageManager(
                driver: \Intervention\Image\Drivers\Gd\Driver::class
            );

            $image = $manager->read($file)->cover(1024, 618)->encode();

            Storage::disk('uploads')->put($path, (string) $image);

            return $path;
        } catch (Exception $e) {
            throw new Exception('Failed to upload main image: ' . $e->getMessage());
        }
    }

    /**
     * Upload detail images
     */
    private function uploadDetailImages(Gallery $gallery, array $detailFiles): void
    {
        try {
            $manager = new ImageManager(
                driver: \Intervention\Image\Drivers\Gd\Driver::class
            );

            foreach ($detailFiles as $file) {
                $filename = uniqid() . '_detail.' . $file->getClientOriginalExtension();
                $path = 'gallery/detail/' . $filename;

                // Resize to 450x450
                $image = $manager->read($file)->cover(450, 450)->encode();
                Storage::disk('uploads')->put($path, (string) $image);

                $gallery->images()->create(['image' => $path]);
            }
        } catch (Exception $e) {
            throw new Exception('Failed to upload detail images: ' . $e->getMessage());
        }
    }

    /**
     * Save translations for gallery
     */
    private function saveTranslations(Gallery $gallery, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            $title = $data['news_title'][$locale] ?? null;

            if ($title) {
                GalleryTranslations::create([
                    'gallery_id' => $gallery->id,
                    'locale' => $locale,
                    'title' => $title,
                    'sub_title' => $title,
                    'sub_title_2' => $title,
                    'content' => $title,
                ]);
            }
        }
    }

    /**
     * Update translations for gallery
     */
    private function updateTranslations(Gallery $gallery, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach (array_keys($locales) as $locale) {
            $title = $data['news_title'][$locale] ?? null;

            if ($title) {
                $gallery->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'title' => $title,
                        'sub_title' => $title,
                        'sub_title_2' => $title,
                        'content' => $title,
                    ]
                );
            }
        }
    }
}