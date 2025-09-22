<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\GalleryTranslations;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class GalleryController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();
        $galleries = Gallery::with([
            'translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            },
        ])->paginate(8);
        return view('layouts.admin.gallery.index', compact('galleries'));
    }
    public function fetchById(Request $request)
    {
        try {
            $gallery = Gallery::with(['translations', 'images'])->firstOrFail();
            return FormatResponseJson::success($gallery, 'Gallery fetched successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), null);
            //throw $th;
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gallery_topic'          => 'required|exists:topics,id',
            'gallery_main_image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_status'         => 'required|in:0,1',
            'gallery_video_url'      => 'nullable|url|max:255',
            'news_title'             => 'required|array',
            'news_title.*'           => 'nullable|string',
            'gallery_image_detail'   => 'array',
            'gallery_image_detail.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        DB::beginTransaction();
        try {
            $file     = $request->file('gallery_main_image');
            $filename = uniqid().'_main.'.$file->getClientOriginalExtension();
            $path     = 'gallery/main/'.$filename;

            $manager = new ImageManager(
                driver: \Intervention\Image\Drivers\Gd\Driver::class
                // atau Imagick jika Anda ingin
            );

            $image = $manager->read($file)->cover(1024, 618)->encode();

            $gallery = Gallery::create([
                'topic_id'   => $request->gallery_topic,
                'image'      => $path,
                'is_active'  => $request->gallery_status,
                'date_input' => now(),
                'date_update'=> now(),
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
                'writer'     => auth()->id(),
                'url_video'  => $request->gallery_video_url,
            ]);

            if ($gallery) {
                Storage::disk('public')->put($path, (string) $image);
            }

            foreach ($request->news_title as $locale => $title) {
                // dd($locale);
                GalleryTranslations::create([
                    'gallery_id' => $gallery->id,
                    'locale'     => $locale,
                    'title'      => $title,
                    'sub_title'  => $title,
                    'sub_title_2'=> $title,
                    'content'    => $title,
                ]);
            }

            if ($request->hasFile('gallery_image_detail')) {
                foreach ($request->file('gallery_image_detail') as $img) {
                    $detailPath = $img->store('gallery/detail', 'public');
                    $gallery->images()->create(['image' => $detailPath]);
                }
            }

            DB::commit();
            return FormatResponseJson::success(true, 'Success create Gallery');
        } catch (\Throwable $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function update(Request $request)
    {
        dd($request->all());
        // Validasi sama seperti store, tapi main_image boleh nullable
        $validator = Validator::make($request->all(), [
            'gallery_topic'          => 'required|exists:topics,id',
            'gallery_main_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery_status'         => 'required|in:0,1',
            'gallery_video_url'      => 'nullable|url|max:255',
            'news_title'             => 'required|array',
            'news_title.*'           => 'nullable|string',
            'gallery_image_detail'   => 'array',
            'gallery_image_detail.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        DB::beginTransaction();
        try {
            $gallery = Gallery::with('images', 'translations')->findOrFail($request->id);

            // Update field utama
            $gallery->topic_id   = $request->gallery_topic;
            $gallery->is_active  = $request->gallery_status;
            $gallery->url_video  = $request->gallery_video_url;
            $gallery->date_update = now();
            $gallery->updated_by  = auth()->id();

            // Jika ada main image baru → resize & replace
            if ($request->hasFile('gallery_main_image')) {
                // hapus file lama dari storage
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }

                $file     = $request->file('gallery_main_image');
                $filename = uniqid().'_main.'.$file->getClientOriginalExtension();
                $path     = 'gallery/main/'.$filename;

                $manager = new ImageManager(
                    driver: \Intervention\Image\Drivers\Gd\Driver::class
                );

                $image = $manager->read($file)->cover(1024, 618)->encode();

                Storage::disk('public')->put($path, (string) $image);
                $gallery->image = $path;
            }

            $gallery->save();

            // === Update translations ===
            foreach ($request->news_title as $locale => $title) {
                $gallery->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'title'       => $title,
                        'sub_title'   => $title,
                        'sub_title_2' => $title,
                        'content'     => $title,
                    ]
                );
            }

            // === Tambah gambar detail baru jika diupload ===
            if ($request->hasFile('gallery_image_detail')) {
                foreach ($request->file('gallery_image_detail') as $img) {
                    $detailPath = $img->store('gallery/detail', 'public');
                    $gallery->images()->create(['image' => $detailPath]);
                }
            }

            DB::commit();
            return FormatResponseJson::success(true, 'Success update Gallery');
        } catch (\Throwable $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

}
