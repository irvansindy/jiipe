<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerHeader;
use App\Models\CareerHeaderTranslation;
use App\Models\CareerSection;
use App\Models\CareerSectionTranslation;
use App\Models\Career;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class CareerController extends Controller
{
    public function index()
    {
        return view('layouts.admin.career.index');
    }
    public function static()
    {
        $locales = config('laravellocalization.supportedLocales');
        $career_header = CareerHeader::with('translations')->first();
        $career_section = CareerSection::with('translations')->first();
        return view('layouts.admin.career.static', compact('locales', 'career_header', 'career_section'));
    }
    public function enquire()
    {
        return view('layouts.admin.career.enquire');
    }
    public function storeHeader(Request $request)
    {
        // Ambil header pertama (bisa untuk update)
        $header = CareerHeader::first();

        // ===== VALIDASI =====
        $rules = [
            'cover_image' => $header
                ? 'nullable|image|mimes:jpeg,png,jpg|max:2048'
                : 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
            $rules["cover_title.$locale"] = 'required|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            if (!$header) {
                $header = new CareerHeader();
            }

            // Simpan file gambar
            if ($request->hasFile('cover_image')) {
                if ($header->image) {
                    Storage::disk('public')->delete($header->image);
                }
                $header->image = $request->file('cover_image')->store('career/cover', 'public');
            }
            $header->save();

            // Simpan translasi
            foreach ($request->cover_title as $locale => $title) {
                $translation = CareerHeaderTranslation::firstOrNew([
                    'career_header_id' => $header->id,
                    'locale' => $locale,
                    'title' => $title
                ]);
                $translation->title = $title;
                $translation->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Cover berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Cover gagal disimpan: ' . $e->getMessage());
        }
    }

    public function storeSection1(Request $request)
    {
        // ====== RULES & VALIDASI ======
        $rules = [];
        foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
            $rules["section1_title.$locale"]   = 'required|string|max:255';
            $rules["section1_content.$locale"] = 'required|string'; // summernote html -> string
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // ====== MASTER SECTION 1 ======
            // hanya 1 row, jadi update/insert
            $section1 = CareerSection::first();
            if (!$section1) {
                $section1 = new CareerSection();
            }
            $section1->save();

            // ====== TRANSLATIONS ======
            foreach ($request->section1_title as $locale => $title) {
                $translation = CareerSectionTranslation::firstOrNew([
                    'career_section_id' => $section1->id,
                    'locale'             => $locale,
                    'title' => $request->section1_title[$locale],
                    'content' => $request->section1_content[$locale],
                ]);

                // $translation->title   = $title;
                // $translation->content = $request->section1_content[$locale] ?? '';
                $translation->save();
            }

            DB::commit();
            return redirect()
                ->back()
                ->with('success', 'Section 1 berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Gagal menyimpan Section 1: ' . $e->getMessage());
        }
    }

}
