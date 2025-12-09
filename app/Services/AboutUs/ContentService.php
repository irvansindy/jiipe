<?php

namespace App\Services\AboutUs;

use App\Models\AboutUsContent;
use App\Models\AboutUsContentTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContentService
{
    protected function firstAvailable($request, array $keys)
    {
        foreach ($keys as $k) {
            if ($request->has($k)) return $request->input($k);
        }
        return null;
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->id) {
                $content = AboutUsContent::findOrFail($request->id);
            } else {
                $content = new AboutUsContent();
            }

            if ($request->hasFile('content_image')) {
                $path = $this->processUpload($request->file('content_image'), $content->image, 'about-us/content');
                $content->image = $path;
            }

            $content->video_url = $request->input('content_video_url');
            $content->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $props) {
                $title = $this->firstAvailable($request, ["title_{$locale}", "content_title_{$locale}"]);
                $subtitle = $this->firstAvailable($request, ["subtitle_{$locale}", "content_subtitle_{$locale}"]);
                $description = $this->firstAvailable($request, ["description_{$locale}", "content_description_{$locale}", "content_body_{$locale}"]);

                $translation = AboutUsContentTranslation::firstOrNew([
                    'about_us_content_id' => $content->id,
                    'locale' => $locale,
                ]);
                $translation->title = $title;
                if (property_exists($translation, 'subtitle')) {
                    $translation->subtitle = $subtitle;
                }
                // some translations use 'content' or 'description'
                if (property_exists($translation, 'content')) {
                    $translation->content = $description;
                } else {
                    $translation->content = $description;
                }
                $translation->save();
            }

            DB::commit();
            return $content;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

        protected function processUpload($file, $existing = null, $subdir = 'about-us/content')
        {
            if (!($file instanceof UploadedFile)) return $existing;

            if ($existing) {
                if (strpos($existing, '/') !== false) {
                    $clean = ltrim($existing, '/');
                    if (($pos = strpos($clean, 'uploads/')) !== false) {
                        $cand = substr($clean, $pos + strlen('uploads/'));
                    } else {
                        $cand = $clean;
                    }
                } else {
                    $cand = $subdir . '/' . $existing;
                }
                $publicPath = public_path('uploads/' . $cand);
                if (file_exists($publicPath)) {
@unlink($publicPath);
                }
            }

            $filename = Str::random(12) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $dest = public_path('uploads/' . $subdir);
            if (!is_dir($dest)) mkdir($dest, 0755, true);
            $file->move($dest, $filename);
            return $filename;
        }
}
