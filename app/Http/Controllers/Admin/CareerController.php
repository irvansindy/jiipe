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
use App\Models\CareerEmail;
use App\Services\CareerService;
use App\Services\CareerEmailService;
use App\Http\Requests\CareerRequest;
use App\Http\Requests\CareerEmailRequest;
use App\Http\Requests\CareerHeaderRequest;
use App\Http\Requests\CareerSectionRequest;

class CareerController extends Controller
{
    protected $careerService;
    protected $careerEmailService;

    public function __construct(CareerService $careerService, CareerEmailService $careerEmailService)
    {
        $this->careerService = $careerService;
        $this->careerEmailService = $careerEmailService;
    }

    public function index()
    {
        return view('layouts.admin.career.index');
    }

    public function fetchCareer(Request $request)
    {
        try {
            $filters = $request->only(['location_id', 'education_id', 'job_level_id', 'company_id', 'factory_id']);
            $careers = $this->careerService->getAllCareers($filters);
            $message = count($careers) > 0 ? count($careers) . ' careers fetched successfully.' : 'No careers found.';

            return FormatResponseJson::success($careers, $message);
        } catch (\Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function fetchCareerLocation()
    {
        $location = MasterCompanyLocation::all();
        return FormatResponseJson::success($location, 'Location fetched successfully');
    }

    public function fetchCareerEducation()
    {
        $education = MasterEducation::all();
        return FormatResponseJson::success($education, 'Education fetched successfully');
    }

    public function fetchCareerJobLevel()
    {
        $jobLevels = MasterJobLevel::all();
        return FormatResponseJson::success($jobLevels, 'Job Levels fetched successfully');
    }

    public function fetchCareerCompany()
    {
        $companies = MasterCompany::all();
        return FormatResponseJson::success($companies, 'Companies fetched successfully');
    }

    public function static()
    {
        $locales = config('laravellocalization.supportedLocales');
        $career_header = CareerHeader::with('translations')->first();
        $career_section = CareerSection::with('translations')->first();
        // dd($career_header, $career_section);
        return view('layouts.admin.career.static', compact('locales', 'career_header', 'career_section'));
    }

    public function enquire()
    {
        return view('layouts.admin.career.enquire');
    }

    // ----- CareerEmail (Enquire) CRUD -----
    public function fetchCareerEnquire(Request $request)
    {
        try {
            $filters = $request->only(['position_id', 'email']);
            $enquires = $this->careerEmailService->getAllEnquires($filters);
            $message = count($enquires) ? count($enquires) . ' enquiries fetched successfully.' : 'No enquiries found.';

            return FormatResponseJson::success($enquires, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function storeOrUpdateCareerEmail(CareerEmailRequest $request)
    {
        try {
            $data = $request->validated();

            $files = [
                'file_cv' => $request->file('file_cv'),
                'file_complementary_documents' => $request->file('file_complementary_documents'),
            ];

            $careerEmail = $this->careerEmailService->createOrUpdateEnquire($data + ['id' => $request->input('id')], $files);

            $msg = $request->filled('id') ? 'Enquire updated successfully.' : 'Enquire created successfully.';
            return FormatResponseJson::success($careerEmail, $msg);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function detailCareerEnquire(Request $request)
    {
        try {
            $id = $request->input('career_email_id') ?? $request->input('id');
            $enquire = $this->careerEmailService->getEnquireById($id);
            return FormatResponseJson::success($enquire, 'Enquire details fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function deleteCareerEnquire($id)
    {
        try {
            $this->careerEmailService->deleteEnquire($id);
            return FormatResponseJson::success(null, 'Enquire deleted successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function storeHeader(CareerHeaderRequest $request)
{
    try {
        \Log::info('=== storeHeader Controller START ===');
        \Log::info('Request data:', $request->all());
        \Log::info('Has file:', ['has_cover_image' => $request->hasFile('cover_image')]);

        $payload = [
            'title' => $request->input('cover_title'),
        ];

        \Log::info('Payload prepared:', $payload);

        $file = $request->file('cover_image');

        if ($file) {
            \Log::info('File details:', [
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'valid' => $file->isValid()
            ]);
        }

        $header = $this->careerService->saveHeader($payload, $file);

        \Log::info('=== storeHeader Controller SUCCESS ===', ['header_id' => $header->id]);

        // PERBAIKAN: Gunakan session key yang spesifik untuk cover
        return redirect()->back()->with('cover_success', 'Cover berhasil disimpan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation error:', ['errors' => $e->errors()]);
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput()
            ->with('cover_error', 'Validation failed: ' . json_encode($e->errors()));
    } catch (\Exception $e) {
        \Log::error('=== storeHeader Controller FAILED ===', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()
            ->withInput()
            ->with('cover_error', 'Cover gagal disimpan: ' . $e->getMessage());
    }
}

public function storeSection1(CareerSectionRequest $request)
{
    try {
        \Log::info('=== storeSection1 Controller START ===');
        \Log::info('Request data:', $request->all());

        $payload = [
            'title' => $request->input('section1_title'),
            'content' => $request->input('section1_content'),
        ];

        \Log::info('Payload prepared:', $payload);

        $section = $this->careerService->saveSection($payload);

        \Log::info('=== storeSection1 Controller SUCCESS ===', ['section_id' => $section->id]);

        // PERBAIKAN: Gunakan session key yang spesifik untuk section1
        return redirect()->back()->with('section1_success', 'Section 1 berhasil disimpan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation error:', ['errors' => $e->errors()]);
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput()
            ->with('section1_error', 'Validation failed: ' . json_encode($e->errors()));
    } catch (\Exception $e) {
        \Log::error('=== storeSection1 Controller FAILED ===', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()
            ->withInput()
            ->with('section1_error', 'Gagal menyimpan Section 1: ' . $e->getMessage());
    }
}

    public function storeOrUpdateCareer(CareerRequest $request)
    {
        try {
            $career = $this->careerService->createOrUpdateCareer($request->all(), $request->input('career_id'));
            $msg = $request->filled('career_id') ? 'Career updated successfully.' : 'Career created successfully.';
            return FormatResponseJson::success($career, $msg);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function detailCareer(Request $request)
    {
        try {
            $career = $this->careerService->getCareerById($request->career_id);
            return FormatResponseJson::success($career, 'Career details fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}
