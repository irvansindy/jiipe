<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerHeader;
use App\Models\CareerEmail;
use App\Models\CareerHeaderTranslation;
use App\Models\CareerSection;
use App\Models\CareerSectionTranslation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $locale = App::getLocale();
        $sort = $request->get('sort', 'date');

        // Cache key berdasarkan locale dan sort
        $cacheKey = "careers_{$locale}_{$sort}";

        // Cache header data selama 1 jam
        $careerHeader = Cache::remember("career_header_{$locale}", 3600, function () use ($locale) {
            return CareerHeader::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->first();
        });

        // Cache section data selama 1 jam
        $careerSection = Cache::remember("career_section_{$locale}", 3600, function () use ($locale) {
            return CareerSection::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])->first();
        });

        // Query careers dengan eager loading
        $careersQuery = Career::with([
            'factory',
            'location',
            'education',
            'jobLevel'
        ])->where('is_active', true);

        // Sorting
        switch ($sort) {
            case 'education':
                $careersQuery->orderBy('education_id', 'asc');
                break;
            case 'experience':
                $careersQuery->orderBy('min_experience', 'desc');
                break;
            default: // date
                $careersQuery->orderBy('created_at', 'desc');
                break;
        }

        // Cache careers dengan pagination selama 30 menit
        $careers = Cache::remember($cacheKey, 1800, function () use ($careersQuery) {
            return $careersQuery->paginate(10);
        });

        // Get translations
        $headerTranslation = $careerHeader?->translations->first();
        $sectionTranslation = $careerSection?->translations->first();

        return view('layouts.client.career.index', compact(
            'careers',
            'careerHeader',
            'careerSection',
            'headerTranslation',
            'sectionTranslation',
            'sort'
        ));
    }

    public function detail($id)
    {
        $locale = App::getLocale();

        // Cache career detail selama 1 jam
        $career = Cache::remember("career_detail_{$id}_{$locale}", 3600, function () use ($id) {
            return Career::with([
                'factory',
                'location',
                'education',
                'jobLevel'
            ])->findOrFail($id);
        });

        return view('layouts.client.career.detail', compact('career'));
    }
    public function apply(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:20',
            'experience' => 'required|string',
            'cv_file' => 'required|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'support_file' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:2048',
            'message' => 'nullable|string|max:1000',
            // 'g-recaptcha-response' => 'required|recaptcha'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'phone.required' => 'Phone number is required',
            'experience.required' => 'Experience is required',
            'cv_file.required' => 'CV file is required',
            'cv_file.mimes' => 'CV file must be PDF, JPEG, JPG, or PNG',
            'cv_file.max' => 'CV file size must not exceed 2MB',
            'support_file.mimes' => 'Support file must be PDF, JPEG, JPG, or PNG',
            'support_file.max' => 'Support file size must not exceed 2MB',
            // 'g-recaptcha-response.required' => 'Please verify that you are not a robot',
            // 'g-recaptcha-response.recaptcha' => 'reCAPTCHA verification failed'
        ]);

        $career = Career::findOrFail($id);

        // Handle file uploads
        $cvPath = null;
        $supportPath = null;

        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('career/cv', 'uploads');
        }

        if ($request->hasFile('support_file')) {
            $supportPath = $request->file('support_file')->store('career/support', 'uploads');
        }

        // Save to database (create CareerApplication model and migration)
        CareerEmail::create([
            'position_id' => $career->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'file_cv' => $cvPath,
            'file_complementary_documents' => $supportPath,
            'education' => $career->education_id,
            'body' => $request->message,
            'date' => now(),
            'job_level' => $request->job_level,
            'experience' => $request->experience,
        ]);

        // Send email notification (optional)
        // Mail::to('recruitment@bkms.jiipe.co.id')->send(new CareerApplicationMail($data));

        return redirect()->back()->with('success', 'Your application has been submitted successfully. We will contact you soon.');
    }
}