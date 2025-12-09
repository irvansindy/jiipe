<?php

namespace App\Services\AboutUs;

use App\Models\AboutUsHeader;
use App\Models\AboutUsHeaderTranslation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class HeaderService
{
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $header = AboutUsHeader::first() ?? new AboutUsHeader();

            if ($request->hasFile('cover_image')) {
                $path = $this->processUpload($request->file('cover_image'), $header->image, 'about-us/header');
                $header->image = $path;
            }

            $header->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $props) {
                $title = $request->input("title_{$locale}") ?? $request->input("cover_title_{$locale}") ?? null;
                $description = $request->input("description_{$locale}") ?? $request->input("cover_description_{$locale}") ?? $title;

                $translation = AboutUsHeaderTranslation::firstOrNew([
                    'about_us_header_id' => $header->id,
                    'locale' => $locale,
                ]);
                $translation->title = $title;
                $translation->description = $description;
                $translation->save();
            }

            DB::commit();
            return $header;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function processUpload($file, $existing = null, $subdir = 'about-us/header')
    {
        if (!($file instanceof UploadedFile)) return $existing;
        // delete old file if exists (support filename-only or various path forms)
        if ($existing) {
            if (strpos($existing, '/') !== false) {
                $clean = ltrim($existing, '/');
                // if path contains 'uploads/', strip to path after it
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

        // return only filename (store filename on model)
        return $filename;
    }
}
