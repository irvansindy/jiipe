<?php

namespace App\Services;

use App\Models\Career;
use App\Models\CareerHeader;
use App\Models\CareerHeaderTranslation;
use App\Models\CareerSection;
use App\Models\CareerSectionTranslation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Exception;

class CareerService
{
    /**
     * Get all careers, optionally with filters
     */
    public function getAllCareers(array $filters = [])
    {
        $query = Career::with([
            'factory',
            'location',
            'education',
            'jobLevel',
        ]);

        // Add simple filters if provided
        if (!empty($filters['factory_id'])) {
            $query->where('factory_id', $filters['company_id']);
        }
        if (!empty($filters['education_id'])) {
            $query->where('education_id', $filters['education_id']);
        }
        if (!empty($filters['job_level_id'])) {
            $query->where('job_level_id', $filters['job_level_id']);
        }
        if (!empty($filters['location_id'])) {
            $query->where('location_id', $filters['location_id']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function getCareerById(int $id): Career
    {
        return Career::findOrFail($id);
    }

    public function createOrUpdateCareer(array $data, ?int $id = null): Career
    {
        DB::beginTransaction();

        try {
            $payload = [
                'position' => $data['career_position'] ?? null,
                'factory_id' => $data['career_factory'] ?? null,
                'location_id' => $data['career_location'] ?? null,
                'job_level_id' => $data['career_job_level'] ?? null,
                // 'range_salary' => $data['career_range_salary'] ?? null,
                'education_id' => $data['career_education'] ?? null,
                'min_experience' => $data['career_experience'] ?? null,
                'description' => $data['career_description'] ?? null,
            ];

            if ($id) {
                $career = Career::findOrFail($id);
                $career->update($payload);
            } else {
                $career = Career::create($payload);
            }

            DB::commit();

            return $career;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteCareer(int $id): bool
    {
        $career = Career::findOrFail($id);
        return $career->delete();
    }

    /**
     * Save or update header (image + translations)
     */
    public function saveHeader(array $data, $file = null): CareerHeader
    {
        \Log::info('=== START saveHeader ===');
        \Log::info('Data received:', $data);
        \Log::info('File received:', ['has_file' => $file !== null, 'file' => $file]);

        DB::beginTransaction();
        try {
            $header = CareerHeader::first();
            \Log::info('Existing header:', ['found' => $header !== null, 'id' => $header?->id]);

            if (!$header) {
                \Log::info('Creating new header...');
                $header = new CareerHeader();

                // Jika ada file, upload dulu
                if ($file) {
                    $filename = $this->uploadFile($file, 'career/header');
                    \Log::info('File uploaded for new header:', ['filename' => $filename]);
                    $header->image = $filename;
                } else {
                    // Jika tidak ada file dan image required, gunakan placeholder
                    $header->image = 'placeholder.jpg'; // Atau buat nullable di migration
                }

                $header->save();
                \Log::info('New header created:', ['id' => $header->id]);
            } else {
                \Log::info('Updating existing header...');

                // Jika ada file baru
                if ($file) {
                    $filename = $this->uploadFile($file, 'career/header');
                    \Log::info('New file uploaded:', ['filename' => $filename]);

                    // Delete old image
                    if ($header->image && $header->image !== 'placeholder.jpg') {
                        $deleted = $this->deleteFile($header->image, 'career/header');
                        \Log::info('Old image deletion:', ['deleted' => $deleted, 'old_image' => $header->image]);
                    }

                    $header->image = $filename;
                    $header->save();
                    \Log::info('Header image updated');
                }
            }

            // Handle translations
            if (!empty($data['title']) && is_array($data['title'])) {
                \Log::info('Processing translations:', ['count' => count($data['title'])]);

                foreach ($data['title'] as $locale => $title) {
                    $translation = CareerHeaderTranslation::updateOrCreate(
                        [
                            'career_header_id' => $header->id,
                            'locale' => $locale
                        ],
                        [
                            'title' => $title
                        ]
                    );
                    \Log::info("Translation saved for locale: {$locale}", ['id' => $translation->id, 'title' => $title]);
                }
            } else {
                \Log::warning('No translations data or invalid format', ['data' => $data]);
            }

            DB::commit();
            \Log::info('Transaction committed successfully');

            $result = $header->fresh(['translations']);
            \Log::info('=== END saveHeader SUCCESS ===', ['header_id' => $result->id]);

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('=== saveHeader FAILED ===', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Save or update section (translations)
     */
    public function saveSection(array $data): CareerSection
    {
        \Log::info('=== START saveSection ===');
        \Log::info('Data received:', $data);

        DB::beginTransaction();
        try {
            $section = CareerSection::first();
            \Log::info('Existing section:', ['found' => $section !== null, 'id' => $section?->id]);

            if (!$section) {
                \Log::info('Creating new section...');
                $section = CareerSection::create([]);
                \Log::info('New section created:', ['id' => $section->id]);
            } else {
                \Log::info('Using existing section:', ['id' => $section->id]);
            }

            // Handle translations
            if (!empty($data['title']) && is_array($data['title'])) {
                \Log::info('Processing translations:', ['count' => count($data['title'])]);

                foreach ($data['title'] as $locale => $title) {
                    $content = $data['content'][$locale] ?? null;

                    $translation = CareerSectionTranslation::updateOrCreate(
                        [
                            'career_section_id' => $section->id,
                            'locale' => $locale
                        ],
                        [
                            'title' => $title,
                            'content' => $content
                        ]
                    );

                    \Log::info("Translation saved for locale: {$locale}", [
                        'id' => $translation->id,
                        'title' => $title,
                        'content_length' => strlen($content ?? '')
                    ]);
                }
            } else {
                \Log::warning('No translations data or invalid format', ['data' => $data]);
            }

            DB::commit();
            \Log::info('Transaction committed successfully');

            $result = $section->fresh(['translations']);
            \Log::info('=== END saveSection SUCCESS ===', ['section_id' => $result->id]);

            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('=== saveSection FAILED ===', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Upload file to public/uploads/{folder} and return filename
     */
    private function uploadFile($file, string $folder): string
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random(20) . '_' . time() . '.' . $extension;
        $destinationPath = public_path("uploads/{$folder}");

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $fileName);
        return $fileName;
    }

    /**
     * Delete file from public/uploads/{folder}
     */
    private function deleteFile(string $filePath, string $folder): bool
    {
        $trimmed = ltrim($filePath, '/');

        if (strpos($trimmed, '/') !== false || strpos($trimmed, 'uploads/') === 0) {
            $fullPath = public_path($trimmed);
        } else {
            $fullPath = public_path("uploads/{$folder}/" . $trimmed);
        }

        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }

        return false;
    }
}
