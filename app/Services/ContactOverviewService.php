<?php

namespace App\Services;

use App\Models\ContactOverview;
use App\Models\ContactOverviewTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class ContactOverviewService
{
    /**
     * Get contact overview with all translations
     */
    public function getContactOverview()
    {
        $contact = ContactOverview::with(['translations'])->first();

        if (!$contact) {
            return null;
        }

        $locales = config('laravellocalization.supportedLocales');
        $translations = [];

        foreach ($locales as $locale => $properties) {
            $trans = $contact->translations->where('locale', $locale)->first();
            $translations[$locale] = [
                'title' => $trans ? $trans->title : '',
                'subtitle' => $trans ? $trans->subtitle : '',
                'description' => $trans ? $trans->description : '',
                'office_name' => $trans ? $trans->office_name : '',
                'phone' => $trans ? $trans->phone : '',
                'address' => $trans ? $trans->address : '',
                'map_link' => $trans ? $trans->map_link : '',
            ];
        }

        return [
            'id' => $contact->id,
            'image' => $contact->image ? 'contact/overview/' . $contact->image : null,
            'translations' => $translations,
        ];
    }

    /**
     * Create or update contact overview
     */
    public function saveContactOverview(array $data, $imageFile = null)
    {
        DB::beginTransaction();

        try {
            // Get existing contact or create new
            $contact = ContactOverview::first();

            if (!$contact) {
                $contact = new ContactOverview();
            }

            $oldImagePath = $contact->image;

            // Handle image upload
            if ($imageFile) {
                if ($oldImagePath) {
                    $this->deleteFile($oldImagePath, 'contact/overview');
                }
                $contact->image = $this->uploadFile($imageFile, 'contact/overview');
            }

            $contact->save();

            $this->saveTranslations($contact, $data);

            DB::commit();

            return $contact;
        } catch (Exception $e) {
            DB::rollBack();

            // Cleanup uploaded file if save failed
            if (isset($contact->image) && $contact->image !== $oldImagePath) {
                $this->deleteFile($contact->image, 'contact/overview');
            }

            throw $e;
        }
    }

    /**
     * Upload file and return filename only (without path)
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
     * Save translations for contact overview
     */
    private function saveTranslations(ContactOverview $contact, array $data): void
    {
        $locales = config('laravellocalization.supportedLocales');

        foreach ($locales as $locale => $properties) {
            ContactOverviewTranslation::updateOrCreate(
                [
                    'contact_overviews_id' => $contact->id,
                    'locale' => $locale,
                ],
                [
                    'title' => $data['title'][$locale] ?? '',
                    'subtitle' => $data['subtitle'][$locale] ?? '',
                    'description' => $data['description'][$locale] ?? '',
                    'office_name' => $data['office_name'][$locale] ?? '',
                    'phone' => $data['phone'][$locale] ?? '',
                    'address' => $data['address'][$locale] ?? '',
                    'map_link' => $data['map_link'][$locale] ?? '',
                ]
            );
        }
    }
}