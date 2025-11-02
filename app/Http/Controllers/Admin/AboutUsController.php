<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsHeader;
use App\Models\AboutUsHeaderTranslation;
use App\Models\AboutUsContent;
use App\Models\AboutUsContentTranslation;
use App\Models\AboutUsContentDetail;
use App\Models\AboutUsContentDetailTranslation;
use App\Models\AboutUsVisionMision;
use App\Models\AboutUsVisionMisionTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FormatResponseJson;
class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUsHeader = AboutUsHeader::with(['translations'])->first();
        $aboutUsContent = AboutUsContent::with(['translations'])->first();
        $aboutUsVisionMission = AboutUsVisionMision::with(['translations'])->first(); // Tambahkan ini
        return view('layouts.admin.about_us.index', compact('aboutUsHeader','aboutUsContent', 'aboutUsVisionMission'));
    }
    public function storeHeader(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $rules['cover_title_' . $locale] = 'required|string|max:255';
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $header = AboutUsHeader::first();
            if (!$header) {
                // dd($header);
                $header = new AboutUsHeader();
            }
            if ($request->hasFile('cover_image')) {
                if ($header->cover_image) {
                    Storage::disk('public')->delete($header->cover_image);
                }
                $header->image = $request->file('cover_image')->store('about_us/cover', 'public');
            }
            $header->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $translation = AboutUsHeaderTranslation::firstOrNew([
                    'about_us_header_id' => $header->id,
                    'locale' => $locale,
                ]);
                $translation->title = $request->input('cover_title_' . $locale);
                $translation->description = $request->input('cover_title_' . $locale);
                $translation->save();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Cover berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Cover gagal disimpan: ' . $e->getMessage());
        }
    }
    public function storeContent(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();

            // Build validation rules
            $rules = [];
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $rules['content_title_' . $locale] = 'required|string|max:255';
                $rules['content_subtitle_' . $locale] = 'required|string';
                $rules['content_body_' . $locale] = 'required|string';
            }

            // Image is required only on create (when id is not present)
            if (!$request->id) {
                $rules['content_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
            } else {
                $rules['content_image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
            }

            $rules['content_video_url'] = 'nullable|string|max:255';

            $validator = Validator::make($request->all(), $rules);
            // dd($validator->errors());
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Get or create content
            if ($request->id) {
                $content = AboutUsContent::findOrFail($request->id);
            } else {
                $content = new AboutUsContent();
            }

            // Handle image upload (stored in main table, not translation)
            if ($request->hasFile('content_image')) {
                // Delete old image if exists
                if ($content->image && Storage::disk('public')->exists($content->image)) {
                    Storage::disk('public')->delete($content->image);
                }
                $content->image = $request->file('content_image')->store('about_us/content', 'public');
            }

            // Handle video URL (stored in main table, not translation)
            $content->video_url = $request->input('content_video_url');
            // dd($content);
            // Save content first to get ID
            $content->save();

            // Save translations
            if ($content) {
                # code...
                foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                    $translation = AboutUsContentTranslation::updateOrCreate(
                        [
                            'about_us_content_id' => $content->id,
                            'locale' => $locale,
                        ],
                        [
                            'title' => $request->input('content_title_' . $locale),
                            'subtitle' => $request->input('content_subtitle_' . $locale),
                            'content' => $request->input('content_body_' . $locale),
                        ]
                    );
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Content berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Content gagal disimpan: ' . $e->getMessage());
        }
    }

    public function storeVisionMission(Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = [];
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $rules['title.' . $locale] = 'required|string|max:255';
                $rules['vision.' . $locale] = 'required|string';
                $rules['mission.' . $locale] = 'required|string';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Get or create vision mission
            if ($request->id) {
                $visionMission = AboutUsVisionMision::findOrFail($request->id);
            } else {
                $visionMission = new AboutUsVisionMision();
            }

            $visionMission->save();

            // Save translations
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                AboutUsVisionMisionTranslation::updateOrCreate(
                    [
                        'about_us_vision_mision_id' => $visionMission->id,
                        'locale' => $locale,
                    ],
                    [
                        'title' => $request->input('title')[$locale] ?? null,
                        'vision' => $request->input('vision')[$locale] ?? null,
                        'mission' => $request->input('mission')[$locale] ?? null, // Ubah dari 'mision' ke 'mission'
                    ]
                );
            }

            DB::commit();
            return redirect()->back()->with('success', 'Visi Misi berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Visi Misi gagal disimpan: ' . $e->getMessage());
        }
    }
    public function fetchContentDetail()
    {
        try {
            $locale = app()->getLocale();
            $contentDetail = AboutUsContentDetail::with(['translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }])->get();
            $message = $contentDetail->isEmpty() ? 'No data found' : 'Success fetch data content detail';
            return FormatResponseJson::success($contentDetail, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeContentDetail(Request $request)
    {
        try {
            $rules = [
                'content_detail_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:512',
            ];

            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $rules['content_detail_title.*']= 'required|string|max:255';
                $rules['content_detail_sub_content.*']= 'required|string|max:255';
            }

            $customMessages = [
                'content_detail_image.required' => 'Please upload an image',
                'content_detail_image.image' => 'File must be an image',
                'content_detail_image.mimes' => 'Image must be jpeg, png, jpg, or webp format',
                'content_detail_image.max' => 'Image size must not exceed 512KB',

                'content_detail_title.*.required' => 'Title is required for all languages',
                'content_detail_title.*.string' => 'Title must be text',
                'content_detail_title.*.max' => 'Title must not exceed 255 characters',

                'content_detail_sub_content.*.required' => 'Content is required for all languages',
                'content_detail_sub_content.*.string' => 'Content must be text',
                'content_detail_sub_content.*.max' => 'Content must not exceed 255 characters',
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            $validator->setAttributeNames([
                'content_detail_title.id' => 'Title (ID)',
                'content_detail_title.en' => 'Title (EN)',
                'content_detail_title.zh' => 'Title (ZH)',
                'content_detail_title.ja' => 'Title (JA)',
                'content_detail_title.ko' => 'Title (KO)',
                'content_detail_title.tw' => 'Title (TW)',

                'content_detail_sub_content.id' => 'Content (ID)',
                'content_detail_sub_content.en' => 'Content (EN)',
                'content_detail_sub_content.zh' => 'Content (ZH)',
                'content_detail_sub_content.ja' => 'Content (JA)',
                'content_detail_sub_content.ko' => 'Content (KO)',
                'content_detail_sub_content.tw' => 'Content (TW)',
            ]);
            if ($validator->fails()) {
                return FormatResponseJson::error('null', $validator->errors(), 422);
            }

            DB::beginTransaction();

            // Find existing or create new
            $contentDetail = $request->id ?
                AboutUsContentDetail::findOrFail($request->id) :
                new AboutUsContentDetail();

            // Handle image upload
            if ($request->hasFile('content_detail_image')) {
                // Delete old image if exists
                if ($contentDetail->icon) {
                    Storage::disk('public')->delete($contentDetail->content_detail_image);
                }
                $contentDetail->icon = $request->file('content_detail_image')
                    ->store('about_us/content_detail', 'public');
            }

            $contentDetail->category_id = '0';
            $contentDetail->save();

            // Handle translations
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                AboutUsContentDetailTranslation::updateOrCreate(
                    [
                        'about_us_content_detail_id' => $contentDetail->id,
                        'locale' => $locale
                    ],
                    [
                        'title' => $request->input("content_detail_title.{$locale}"),
                        'description' => $request->input("content_detail_sub_content.{$locale}")
                    ]
                );
            }

            DB::commit();

            $message = $request->id ? 'Content Detail updated successfully' : 'Content Detail created successfully';
            return FormatResponseJson::success($contentDetail, $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return FormatResponseJson::error('null', $e->getMessage(), 500);
        }
    }
}
