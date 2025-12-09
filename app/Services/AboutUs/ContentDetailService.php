<?php

namespace App\Services\AboutUs;

use App\Models\AboutUsContentDetail;
use App\Models\AboutUsContentDetailTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ContentDetailService
{
    public function fetchAll($locale = null)
    {
        $locale = $locale ?: app()->getLocale();

        return AboutUsContentDetail::with([
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            },
            'category.translations'
        ])->get();
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $detail = $request->id
                ? AboutUsContentDetail::findOrFail($request->id)
                : new AboutUsContentDetail();

            // Handle image upload
            if ($request->hasFile('content_detail_image')) {
                $detail->icon = $this->processUpload(
                    $request->file('content_detail_image'),
                    $detail->icon,
                    'about-us/content_detail'
                );
            }

            $detail->category_id = $request->input('category_id', 0);
            $detail->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $props) {
                // Support both array and string input format
                $title = $request->input("content_detail_title.{$locale}")
                    ?? $request->input("title_{$locale}");

                $description = $request->input("content_detail_sub_content.{$locale}")
                    ?? $request->input("description_{$locale}");

                $translation = AboutUsContentDetailTranslation::firstOrNew([
                    'about_us_content_detail_id' => $detail->id,
                    'locale' => $locale,
                ]);

                $translation->title = $title;
                $translation->description = $description;
                $translation->save();
            }

            DB::commit();
            return $detail->fresh('translations');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $detail = AboutUsContentDetail::find($id);

            if (!$detail) {
                return false;
            }

            // Delete icon file if exists
            if ($detail->icon) {
                $iconPath = public_path('uploads/about-us/content_detail/' . $detail->icon);
                if (file_exists($iconPath)) {
                    @unlink($iconPath);
                }
            }

            // Delete translations first (cascade should handle this, but just to be safe)
            AboutUsContentDetailTranslation::where('about_us_content_detail_id', $id)->delete();

            // Delete the detail record
            $detail->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function processUpload($file, $existing = null, $subdir = 'about-us/content_detail')
    {
        if (!($file instanceof UploadedFile)) {
            return $existing;
        }

        // Delete old file if exists
        if ($existing) {
            $oldFilename = basename($existing);
            $publicPath = public_path('uploads/' . $subdir . '/' . $oldFilename);
            if (file_exists($publicPath)) {
                @unlink($publicPath);
            }
        }

        $filename = Str::random(12) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $dest = public_path('uploads/' . $subdir);

        if (!is_dir($dest)) {
            mkdir($dest, 0755, true);
        }

        $file->move($dest, $filename);
        return $filename;
    }
}