<?php

namespace App\Services;

use App\Models\CareerEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class CareerEmailService
{
    public function getAllEnquires(array $filters = [])
    {
        $query = CareerEmail::query();

        if (!empty($filters['position_id'])) {
            $query->where('position_id', $filters['position_id']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function getEnquireById(int $id): CareerEmail
    {
        return CareerEmail::findOrFail($id);
    }

    public function createOrUpdateEnquire(array $data, $files = []): CareerEmail
    {
        DB::beginTransaction();
        try {
            if (!empty($files['file_cv'])) {
                $data['file_cv'] = $this->uploadFile($files['file_cv'], 'career-email');
            }
            if (!empty($files['file_complementary_documents'])) {
                $data['file_complementary_documents'] = $this->uploadFile($files['file_complementary_documents'], 'career-email');
            }

            if (!empty($data['id'])) {
                $enquire = CareerEmail::findOrFail($data['id']);

                // delete old files if new ones are provided
                if (!empty($data['file_cv']) && $enquire->file_cv) {
                    $this->deleteFile($enquire->file_cv, 'career-email');
                }
                if (!empty($data['file_complementary_documents']) && $enquire->file_complementary_documents) {
                    $this->deleteFile($enquire->file_complementary_documents, 'career-email');
                }

                $enquire->update($data);
            } else {
                $enquire = CareerEmail::create($data);
            }

            DB::commit();
            return $enquire;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteEnquire(int $id): bool
    {
        $enquire = CareerEmail::findOrFail($id);

        // delete files if any
        if ($enquire->file_cv) {
            $this->deleteFile($enquire->file_cv, 'career-email');
        }
        if ($enquire->file_complementary_documents) {
            $this->deleteFile($enquire->file_complementary_documents, 'career-email');
        }

        return $enquire->delete();
    }

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
