<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryBrochure;
use App\Models\GalleryBrochuresTranslations;
use Illuminate\Support\Facades\DB;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
class BrochureController extends Controller
{
    public function index()
    {
        return view('layouts.admin.brochure.index');
    }
    public function fetch()
    {
        try {
            $locale = app()->getLocale();
            $brochure = GalleryBrochure::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])->get();
            $message = count($brochure) > 0?'Brochure fetched successfully':'No data';
            return FormatResponseJson::success($brochure,$message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function fetchById(Request $request)
    {
        try {
            $brochure = GalleryBrochure::with(['translations' ])->where('id', $request->id)->first();
            $message = $brochure != null ? 'Brochure fetched successfully':'No data';
            return FormatResponseJson::success($brochure,$message);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $locales = config('laravellocalization.supportedLocales');

            $rules = [
                'brochure_is_active' => 'required|in:0,1',
                'brochure_title.*'   => 'required|string|max:255',
                'brochure_file.*'    => 'nullable|file|mimes:pdf|max:5120',
            ];

            $messages = [
                'brochure_is_active.in'       => 'Status publikasi tidak valid.',
                'brochure_title.*.required'   => 'Judul brosur untuk setiap bahasa wajib diisi.',
                'brochure_title.*.string'     => 'Judul brosur harus berupa teks.',
                'brochure_title.*.max'        => 'Judul brosur maksimal 255 karakter.',
                'brochure_file.*.file'        => 'File brosur harus berupa file.',
                'brochure_file.*.mimes'       => 'File brosur harus dalam format PDF.',
                'brochure_file.*.max'         => 'Ukuran file maksimal 5 MB.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $validated = $validator->validated();

            // ===== MASTER BROCHURE =====
            $brochure = GalleryBrochure::updateOrCreate(
                ['id' => $request->input('id')],
                [
                    'image'       => 'image',
                    'is_active'   => $validated['brochure_is_active'],
                    'date_update' => now(),
                    'updated_by'  => auth()->id(),
                    'date_input'  => now(),
                    'created_by'  => auth()->id(),
                    'writer'      => auth()->id(),
                ]
            );

            // ===== TRANSLASI PER LOCALE =====
            foreach ($locales as $locale => $prop) {
                $dataTrans = [
                    'title' => $validated['brochure_title'][$locale] ?? null,
                ];

                // Jika ada file baru yang diupload untuk locale ini
                if ($request->hasFile("brochure_file.$locale")) {
                    // 🔹 Ambil record lama (kalau ada)
                    $oldTrans = GalleryBrochuresTranslations::where([
                        'gallery_brochure_id' => $brochure->id,
                        'locale'              => $locale,
                    ])->first();

                    // 🔹 Hapus file lama jika masih tersimpan
                    if ($oldTrans && $oldTrans->file && Storage::disk('uploads')->exists($oldTrans->file)) {
                        Storage::disk('uploads')->delete($oldTrans->file);
                    }

                    // 🔹 Simpan file baru
                    $path = $request->file("brochure_file.$locale")->store('brochures', 'uploads');
                    $dataTrans['file'] = $path;
                }

                GalleryBrochuresTranslations::updateOrCreate(
                    [
                        'gallery_brochure_id' => $brochure->id,
                        'locale'              => $locale,
                    ],
                    $dataTrans
                );
            }

            DB::commit();
            return FormatResponseJson::success(true, 'Brochure berhasil disimpan atau diperbarui');

        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }
}