<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LanguageService;
use App\Helpers\FormatResponseJson;
use App\Helpers\FlagImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class LanguageController extends Controller
{
    protected $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Display language management page
     */
    public function index()
    {
        return view('layouts.admin.language.index');
    }

    /**
     * Fetch all languages
     */
    public function fetch()
    {
        try {
            $languages = $this->languageService->getAllLanguages();

            return FormatResponseJson::success($languages, 'Fetched languages successfully');
        } catch (Exception $e) {
            Log::error('Error fetching languages: ' . $e->getMessage());
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch single language by ID
     */
    public function fetchById(Request $request)
    {
        try {
            $language = $this->languageService->getLanguageById($request->id);

            return FormatResponseJson::success($language, 'Fetched language successfully');
        } catch (Exception $e) {
            Log::error('Error fetching language by ID: ' . $e->getMessage());
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        }
    }

    /**
     * Store new language
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'locale' => 'required|string|max:10|unique:languages,locale',
                'name' => 'required|string|max:255',
                'native' => 'required|string|max:255',
                'regional' => 'nullable|string|max:10',
                'script' => 'nullable|string|max:10',
                'flag' => 'nullable|image|mimes:jpeg,png,gif,webp|max:2048',
            ], [
                'locale.required' => 'Locale code is required',
                'locale.unique' => 'This locale code already exists',
                'name.required' => 'English name is required',
                'native.required' => 'Native name is required',
                'flag.image' => 'Flag must be a valid image file',
                'flag.mimes' => 'Flag must be JPG, PNG, GIF, or WebP format',
                'flag.max' => 'Flag file size cannot exceed 2MB',
            ]);

            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(), 'Validation error', 422);
            }

            $data = $request->all();

            // Handle flag upload
            if ($request->hasFile('flag')) {
                try {
                    $flagPath = FlagImageHelper::storeFlagImage($request->file('flag'), $request->locale);
                    $data['flag'] = $flagPath;
                } catch (Exception $e) {
                    return FormatResponseJson::error(null, 'Error processing flag: ' . $e->getMessage(), 422);
                }
            }

            $language = $this->languageService->createLanguage($data);

            return FormatResponseJson::success(['id' => $language->id], 'Language created successfully');
        } catch (Exception $e) {
            Log::error('Error creating language: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update existing language
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:languages,id',
                'locale' => 'required|string|max:10|unique:languages,locale,' . $request->id,
                'name' => 'required|string|max:255',
                'native' => 'required|string|max:255',
                'regional' => 'nullable|string|max:10',
                'script' => 'nullable|string|max:10',
                'flag' => 'nullable|image|mimes:jpeg,png,gif,webp|max:2048',
                'remove_flag' => 'nullable|boolean',
            ], [
                'locale.required' => 'Locale code is required',
                'locale.unique' => 'This locale code already exists',
                'name.required' => 'English name is required',
                'native.required' => 'Native name is required',
                'flag.image' => 'Flag must be a valid image file',
                'flag.mimes' => 'Flag must be JPG, PNG, GIF, or WebP format',
                'flag.max' => 'Flag file size cannot exceed 2MB',
            ]);

            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(), 'Validation error', 422);
            }

            $data = $request->all();

            // Handle flag upload
            if ($request->hasFile('flag')) {
                try {
                    // Delete old flag if exists
                    $oldLanguage = $this->languageService->getLanguageById($request->id);
                    if ($oldLanguage->flag) {
                        FlagImageHelper::deleteFlagImage($oldLanguage->flag);
                    }

                    $flagPath = FlagImageHelper::storeFlagImage($request->file('flag'), $request->locale);
                    $data['flag'] = $flagPath;
                } catch (Exception $e) {
                    return FormatResponseJson::error(null, 'Error processing flag: ' . $e->getMessage(), 422);
                }
            } elseif ($request->has('remove_flag') && $request->remove_flag) {
                // Remove flag if requested
                $oldLanguage = $this->languageService->getLanguageById($request->id);
                if ($oldLanguage->flag) {
                    FlagImageHelper::deleteFlagImage($oldLanguage->flag);
                }
                $data['flag'] = null;
            } else {
                // Keep existing flag
                unset($data['flag']);
            }

            $language = $this->languageService->updateLanguage($request->id, $data);

            return FormatResponseJson::success(['id' => $language->id], 'Language updated successfully');
        } catch (Exception $e) {
            Log::error('Error updating language: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete language
     */
    public function destroy(int $id)
    {
        try {
            // Get language before deletion to clean up flag
            $language = $this->languageService->getLanguageById($id);

            if ($language->flag) {
                FlagImageHelper::deleteFlagImage($language->flag);
            }

            $this->languageService->deleteLanguage($id);

            return FormatResponseJson::success(null, 'Language deleted successfully');
        } catch (Exception $e) {
            Log::error('Error deleting language: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Sync languages from config file
     */
    public function syncFromConfig()
    {
        try {
            $this->languageService->syncFromConfig();

            return FormatResponseJson::success(null, 'Languages synced from config successfully');
        } catch (Exception $e) {
            Log::error('Error syncing from config: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
