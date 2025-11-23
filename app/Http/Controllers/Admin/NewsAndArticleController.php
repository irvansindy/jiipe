<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\NewsTranslation;
use App\Models\NewsCategories;
use App\Models\NewsCategoriesTranslation;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
class NewsAndArticleController extends Controller
{
    public function index()
    {
        return view('layouts.admin.news_blog.index');
    }
    public function fetch(Request $request)
    {
        try {
            $locale = app()->getLocale();
            $news = News::with([
                'translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                },
                'category.translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])->get();
            $message = $news->isEmpty() ? 'No data found' : 'Success fetch data news';
            return FormatResponseJson::success($news, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function fetchCategories(Request $request)
    {
        try {
            $locale = app()->getLocale();
            $newsCategories = NewsCategories::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])->get();
            $message = $newsCategories->isEmpty() ? 'No data found' : 'Success fetch data news categories';
            return FormatResponseJson::success($newsCategories, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeNews(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'news_category'   => 'required|exists:news_categories,id',
                'news_published' => 'required',
                'news_title.*'    => 'required|string',
                'news_content.*'  => 'required|string',
                'news_quote.*'  => 'nullable|string',
                'news_thumbnail'=> 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ] , [
                'news_category.required' => 'Kategori wajib diisi',
                'news_title.*.required' => 'Title wajib diisi',
                'news_content.*.required' => 'Content wajib diisi',
                'news_thumbnail.required' => 'Thumbnail wajib diisi',
                'news_thumbnail.mimes' => 'Thumbnail hanya mengizinkan jenis file: jpg, jpeg, png, webp',
                'news_thumbnail.max' => 'Thumbnail maksimal 2MB',
                'news_thumbnail.image' => 'Thumbnail harus berformat gambar',
            ]);

            $validator->setAttributeNames([
                'news_title.id' => 'Title (ID)',
                'news_title.en' => 'Title (EN)',
                'news_title.zh' => 'Title (ZH)',
                'news_title.ja' => 'Title (JA)',
                'news_title.ko' => 'Title (KO)',
                'news_title.tw' => 'Title (TW)',

                'news_content.id' => 'Content (ID)',
                'news_content.en' => 'Content (EN)',
                'news_content.zh' => 'Content (ZH)',
                'news_content.ja' => 'Content (JA)',
                'news_content.ko' => 'Content (KO)',
                'news_content.tw' => 'Content (TW)',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            // Upload thumbnail
            $thumbnailPath = null;
            if ($request->hasFile('news_thumbnail')) {
                $thumbnailPath = $request->file('news_thumbnail')->store('news/thumbnails', 'uploads');
            }

            $news = News::create([
                'category_id'   => $request->news_category,
                'is_published'        => $request->news_published,
                'thumbnail'     => $thumbnailPath,
            ]);

            foreach ($request->news_title as $locale => $title) {
                $news->translations()->create([
                    'locale'  => $locale,
                    'title'   => $title,
                    'content' => $request->zone_content[$locale] ?? '',
                    'quote'   => $request->zone_quote[$locale] ?? null,
                ]);
            }

            DB::commit();

            return FormatResponseJson::success($news, 'Success create news');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->errors(), 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeCategories(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'news_category_name.*' => 'required|string',
            ], [
                'news_category_name.*.required' => 'Kategori wajib diisi',
                'news_category_name.*.max'=> 'Maksimal 100 karakter',
            ]);
            $validator->setAttributeNames([
                'news_category_name.id' => 'Category (ID)',
                'news_category_name.en' => 'Category (EN)',
                'news_category_name.zh' => 'Category (ZH)',
                'news_category_name.ja' => 'Category (JA)',
                'news_category_name.ko' => 'Category (KO)',
                'news_category_name.tw' => 'Category (TW)',
            ]);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            DB::beginTransaction();
            $newsCategory = NewsCategories::create();
            foreach ($request->translations as $translation) {
                $newsCategory->translations()->create($translation);
            }
            DB::commit();
            return FormatResponseJson::success($newsCategory, 'Success create news category');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->errors(), 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function showNews(Request $request)
    {
        try {
            //code...
            $id = $request->input('id');
            $news = News::with(['translations', 'category'])->findOrFail($id);
            $locale = app()->getLocale();
            $newsCategories = NewsCategories::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])->get();
            $data = [
                'news' => $news,
                'categories' => $newsCategories,
            ];
            return FormatResponseJson::success($data,'success');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(),500);
        }
    }
    public function showNewsCategories(Request $request)
    {
        try {
            $id = $request->input('id');
            $categories = NewsCategories::with(['translations'])->findOrFail($id);
            $formattedTranslations = [];
            foreach ($categories->translations as $t) {
                $formattedTranslations[$t->locale] = [
                    'id' => $categories->id,
                    'locale' => $t->locale,
                    'name' => $t->name,
                ];
            }
            return FormatResponseJson::success($formattedTranslations,'success');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(),500);
        }
    }
    public function updateNews(Request $request)
    {
        try {
            // dd($request->all());
            $id = $request->input('id');
            $news = News::findOrFail($id);

            // update data utama
            $news->category_id = $request->news_category;
            $news->is_published = $request->news_published;

            if ($request->hasFile('news_thumbnail')) {
                // Hapus file lama kalau ada
                if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
                    unlink(public_path($news->thumbnail));
                }

                // Upload file baru
                $file = $request->file('news_thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('news/thumbnails'), $filename);

                // Simpan path ke DB
                $news->thumbnail = 'news/thumbnails/' . $filename;
            }


            $news->save();

            // update translation
            foreach ($request->news_title as $locale => $title) {
                $news->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'title'   => $title,
                        'content' => $request->news_content[$locale],
                        'quote'   => $request->news_quote[$locale],
                    ]
                );
            }

            return response()->json([
                'status' => true,
                'message' => 'News updated successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'meta' => [
                    'message' => [
                        'error' => $e->getMessage()
                    ]
                ]
            ], 422);
        }
    }
    public function updateCategories(Request $request)
    {
        try {
            $id = $request->id;
            $validator = Validator::make($request->all(), [
                'news_category_name.*' => 'required|string|max:100',
            ], [
                'news_category_name.*.required' => 'Kategori wajib diisi',
                'news_category_name.*.max'=> 'Maksimal 100 karakter',
            ]);

            $validator->setAttributeNames([
                'news_category_name.id' => 'Category (ID)',
                'news_category_name.en' => 'Category (EN)',
                'news_category_name.zh' => 'Category (ZH)',
                'news_category_name.ja' => 'Category (JA)',
                'news_category_name.ko' => 'Category (KO)',
                'news_category_name.tw' => 'Category (TW)',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            $newsCategory = NewsCategories::findOrFail($id);

            foreach ($request->news_category_name as $locale => $name) {
                $newsCategory->translations()->updateOrCreate(
                    ['locale' => $locale],
                    ['name' => $name]
                );
            }

            DB::commit();
            return FormatResponseJson::success($newsCategory->load('translations'), 'Success update news category');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->errors(), 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
