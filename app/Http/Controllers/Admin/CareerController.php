<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterCompanyLocation;
use App\Models\MasterEducation;
use App\Models\MasterJobLevel;
use App\Models\MasterCompany;
use Illuminate\Http\Request;
use App\Models\CareerHeader;
use App\Models\CareerHeaderTranslation;
use App\Models\CareerSection;
use App\Models\CareerSectionTranslation;
use App\Models\Career;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FormatResponseJson;
class CareerController extends Controller
{
    public function index()
    {
        return view('layouts.admin.career.index');
    }
    public function fetchCareer(Request $request)
    {
        try {
            $query = Career::with(['factory', 'location', 'education', 'jobLevel']);

            // Apply filters jika ada
            if ($request->filled('location_id')) {
                $query->where('location_id', $request->location_id);
            }

            if ($request->filled('education_id')) {
                $query->where('education_id', $request->education_id);
            }

            if ($request->filled('job_level_id')) {
                $query->where('job_level_id', $request->job_level_id);
            }

            if ($request->filled('company_id')) {
                $query->where('company_id', $request->company_id);
                // atau jika company dari relasi factory:
                // $query->whereHas('factory', function($q) use ($request) {
                //     $q->where('id', $request->company_id);
                // });
            }

            $careers = $query->get();
            $message = count($careers) > 0 ? count($careers) . ' careers fetched successfully.' : 'No careers found.';

            return FormatResponseJson::success($careers, $message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function fetchCareerLocation()
    {
        $location = MasterCompanyLocation::all();
        return FormatResponseJson::success($location,'Location fetched successfully');
    }
    public function fetchCareerEducation()
    {
        $education = MasterEducation::all();
        return FormatResponseJson::success($education,'Education fetched successfully');
    }
    public function fetchCareerJobLevel()
    {
        $jobLevels = MasterJobLevel::all();
        return FormatResponseJson::success($jobLevels,'Job Levels fetched successfully');
    }
    public function fetchCareerCompany()
    {
        $companies = MasterCompany::all();
        return FormatResponseJson::success($companies,'Companies fetched successfully');
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
    public function storeOrUpdateCareer(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $rules = [
                'career_position' => 'required|string|max:255',
                'career_factory' => 'required',
                'career_location' => 'required',
                'career_job_level' => 'required',
                'career_range_salary' => 'nullable|string|max:255',
                'career_education'  => 'required',
                'career_experience' => 'required|string|max:255',
                'career_description' => 'required|string',
            ];

            $messages = [
                'career_position.required'  => 'Position wajib diisi.',
                'career_factory.required' => 'Factory wajib dipilih.',
                'career_location.required' => 'Location wajib dipilih.',
                'career_job_level.required' => 'Job level wajib dipilih.',
                'career_education.required' => 'Minimum education wajib dipilih.',
                'career_experience.required' => 'Minimum experience wajib diisi.',
                'career_description.required' => 'Job description wajib diisi.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                DB::rollBack();
                return FormatResponseJson::error(null, ['errors' => $validator->errors()], 422);
            }
            $validated = $validator->validated();

            // Create or update Career
            $career = Career::updateOrCreate(
                ['id' => $request->input('career_id')],
                [
                    'position'      => $validated['career_position'],
                    'factory_id'    => $validated['career_factory'],
                    'location_id'   => $validated['career_location'],
                    'education_id'  => $validated['career_education'],
                    'job_level_id'  => $validated['career_job_level'],
                    'range_salary'  => $validated['career_range_salary'],
                    'minimum_experience'    => $validated['career_experience'],
                    'description'   => $validated['career_description'],
                ]
            );

            DB::commit();
            $msg = $request->filled('id') ? 'Career updated successfully.' : 'Career created successfully.';
            return FormatResponseJson::success($career, $msg);

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function detailCareer(Request $request)
    {
        try {
            DB::beginTransaction();

            $career = Career::with(['factory', 'location', 'education', 'jobLevel'])
                ->where('id', $request->career_id)
                ->first();

            DB::commit();
            return FormatResponseJson::success($career, 'Career details fetched successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}