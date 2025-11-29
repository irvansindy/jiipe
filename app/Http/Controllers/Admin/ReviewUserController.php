<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewTranslation;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ReviewUserController extends Controller
{
    public function index()
    {
        return view('layouts.admin.home.index');
    }

    public function fetch(Request $request)
    {
        try {
            $locale = app()->getLocale();
            $reviews = Review::with([
                'translations' => function($query) use ($locale) {
                    $query->where('locale', $locale);
                }
            ])->get();

            $message = $reviews->isEmpty() ? 'No data found' : 'Success fetch data reviews';
            return FormatResponseJson::success($reviews, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'is_active' => 'required|boolean',
                'description_id' => 'required|string',
                'description_en' => 'required|string',
                'description_zh' => 'nullable|string',
                'description_ja' => 'nullable|string',
                'description_ko' => 'nullable|string',
                'description_tw' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'name.required' => 'Nama wajib diisi',
                'position.required' => 'Posisi wajib diisi',
                'description_id.required' => 'Deskripsi (ID) wajib diisi',
                'description_en.required' => 'Deskripsi (EN) wajib diisi',
                'photo.image' => 'File harus berupa gambar',
                'photo.mimes' => 'Photo hanya mengizinkan jenis file: jpg, jpeg, png, webp',
                'photo.max' => 'Photo maksimal 2MB',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            // Upload photo
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('reviews/photos', 'uploads');
            }

            $review = Review::create([
                'name' => $request->name,
                'position' => $request->position,
                'is_active' => $request->is_active,
                'photo' => $photoPath,
            ]);

            // Create translations for all locales
            $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];
            foreach ($locales as $locale) {
                $fieldName = 'description_' . $locale;
                if ($request->filled($fieldName)) {
                    $review->translations()->create([
                        'locale' => $locale,
                        'description' => $request->$fieldName,
                    ]);
                }
            }

            DB::commit();

            return FormatResponseJson::success($review->load('translations'), 'Success create review');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, $e->errors(), 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $id = $request->input('id');
            $review = Review::with(['translations'])->findOrFail($id);

            return FormatResponseJson::success($review, 'Success fetch review data');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        try {
            $review = Review::with(['translations'])->findOrFail($id);

            return response()->json($review);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $review = Review::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'is_active' => 'required|boolean',
                'description_id' => 'required|string',
                'description_en' => 'required|string',
                'description_zh' => 'nullable|string',
                'description_ja' => 'nullable|string',
                'description_ko' => 'nullable|string',
                'description_tw' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            // Update basic data
            $review->name = $request->name;
            $review->position = $request->position;
            $review->is_active = $request->is_active;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo
                if ($review->photo && file_exists(public_path('uploads/' . $review->photo))) {
                    unlink(public_path('uploads/' . $review->photo));
                }
                $review->photo = $request->file('photo')->store('reviews/photos', 'uploads');
            }

            $review->save();

            // Update translations
            $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];
            foreach ($locales as $locale) {
                $fieldName = 'description_' . $locale;
                if ($request->filled($fieldName)) {
                    $review->translations()->updateOrCreate(
                        ['locale' => $locale],
                        ['description' => $request->$fieldName]
                    );
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Review updated successfully!'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $review = Review::findOrFail($id);

            // Delete photo if exists
            if ($review->photo && file_exists(public_path('uploads/' . $review->photo))) {
                unlink(public_path('uploads/' . $review->photo));
            }

            // Delete translations
            $review->translations()->delete();

            // Delete review
            $review->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Review deleted successfully!'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $review = Review::findOrFail($id);
            $review->is_active = !$review->is_active;
            $review->save();

            return response()->json([
                'success' => true,
                'is_active' => $review->is_active,
                'message' => 'Status updated successfully!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}