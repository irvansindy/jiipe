<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HomeSlider;
use App\Models\HomeSliderTranslation;
use Illuminate\Support\Str;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Fetch all sliders with translations
     */
    public function fetch()
    {
        try {
            $sliders = HomeSlider::with('translations')
                ->orderBy('created_at', 'desc')
                ->get();

            return FormatResponseJson::success($sliders, 'Fetched Sliders Successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    /**
     * Fetch single slider by ID
     */
    public function fetchById(Request $request)
    {
        try {
            $slider = HomeSlider::with('translations')
            ->findOrFail($request->id);

            // Transform translations to be keyed by locale for easier frontend handling
            $transformedTranslations = [];
            foreach ($slider->translations as $translation) {
                $transformedTranslations[$translation->locale] = [
                    'locale' => $translation->locale,
                    'title' => $translation->title,
                    'description' => $translation->description,
                    'is_active' => $translation->is_active,
                ];
            }

            $slider->translations = $transformedTranslations;

            return FormatResponseJson::success($slider, 'Fetched Slider Successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }

    /**
     * Store new slider
     */
    public function store(Request $request)
    {
        return $this->save($request);
    }

    /**
     * Update existing slider
     */
    public function update(Request $request)
    {
        return $this->save($request, $request->id);
    }

    /**
     * Save (create or update) slider
     */
    private function save(Request $request, $id = null)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');

            // Validation rules
            // $rules = [
            //     'id' => 'nullable|exists:home_sliders,id',
            //     'slider_file' => $id ? 'nullable' : 'required',
            //     'slider_file' => 'mimetypes:image/jpeg,image/png,image/jpg,image/webp,video/mp4,video/ogg,video/webm|max:20480', // 20MB
            //     'title' => 'required|array',
            //     'description' => 'required|array',
            //     'is_active' => 'nullable|boolean',
            // ];
            $rules = [
                'id' => 'nullable|exists:home_sliders,id',

                'slider_file' => [
                    $id ? 'nullable' : 'required',
                    'file',
                    'mimetypes:image/jpeg,image/png,image/jpg,image/webp,video/mp4,video/ogg,video/webm',
                    'max:20480', // 20MB
                ],

                'title' => 'required|array',
                'description' => 'required|array',
                'is_active' => 'nullable|boolean',
            ];


            // Add per-locale validation
            foreach (array_keys($locales) as $locale) {
                $rules["title.{$locale}"] = 'required|string|max:255';
                $rules["description.{$locale}"] = 'required|string';
            }

            $validator = Validator::make($request->all(), $rules, [
                'slider_file.required' => 'File (image or video) is required',
                'slider_file.mimetypes' => 'File must be an image (jpg, png, webp) or video (mp4, ogg, webm)',
                'slider_file.max' => 'File size must not exceed 20MB',
                'title.*.required' => 'Title is required for all languages',
                'description.*.required' => 'Description is required for all languages',
            ]);

            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(), 'Validation failed', 422);
            }

            DB::beginTransaction();

            // Find existing slider if updating
            $slider = $id ? HomeSlider::find($id) : null;

            // Handle file upload
            $filePath = $slider ? $slider->file : null; // Keep existing file by default

            if ($request->hasFile('slider_file')) {
                // Delete old file if exists
                if ($slider && $slider->file) {
                    $oldFilePath = public_path(ltrim($slider->file, '/'));
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                // Upload new file
                $file = $request->file('slider_file');
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::random(20) . '_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/home-slider');

                // Create directory if not exists
                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Move file
                $file->move($destinationPath, $fileName);
                $filePath = 'uploads/home-slider/' . $fileName;
            }

            // Create or update main slider record
            if ($slider) {
                $slider->update(['file' => $filePath]);
            } else {
                $slider = HomeSlider::create(['file' => $filePath]);
            }

            // Handle translations for each locale
            foreach ($locales as $locale => $properties) {
                $translationData = [
                    'title' => $request->input("title.{$locale}"),
                    'description' => $request->input("description.{$locale}"),
                    'is_active' => $request->input('is_active', 1) ? 1 : 0, // Global is_active
                ];

                HomeSliderTranslation::updateOrCreate(
                    [
                        'home_sliders' => $slider->id,
                        'locale' => $locale,
                    ],
                    $translationData
                );
            }

            DB::commit();

            $message = $id ? 'Slider updated successfully' : 'Slider created successfully';
            return FormatResponseJson::success(['id' => $slider->id], $message);

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    /**
     * Delete slider
     */
    public function destroy($id)
    {
        try {
            $slider = HomeSlider::findOrFail($id);

            // Delete file if exists
            if ($slider->file) {
                $filePath = public_path(ltrim($slider->file, '/'));
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            // Delete translations (cascade should handle this, but explicit is better)
            HomeSliderTranslation::where('home_sliders', $id)->delete();

            // Delete slider
            $slider->delete();

            return FormatResponseJson::success(null, 'Slider deleted successfully');

        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}