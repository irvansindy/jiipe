<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\TenantTranslation;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    /**
     * Fetch all tenants with translations
     */
    public function fetchTenant()
    {
        try {
            $tenants = Tenant::with('translations')
                ->orderBy('created_at', 'desc')
                ->get();

            $message = $tenants->isNotEmpty() ? 'Successfully fetched tenants' : 'No tenants found';
            return FormatResponseJson::success($tenants, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    /**
     * Fetch single tenant by ID
     */
    public function fetchTenantById($id)
    {
        try {
            $tenant = Tenant::with('translations')->findOrFail($id);

            // Transform translations to be keyed by locale
            $locales = config('laravellocalization.supportedLocales');
            $translations = [];

            foreach ($locales as $locale => $properties) {
                $trans = $tenant->translations->where('locale', $locale)->first();
                $translations[$locale] = [
                    'name' => $trans?->name ?? '',
                ];
            }

            $data = [
                'id' => $tenant->id,
                'logo' => $tenant->logo,
                'is_active' => $tenant->is_active,
                'translations' => $translations,
            ];

            return FormatResponseJson::success($data, 'Tenant fetched successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }

    /**
     * Store new tenant
     */
    public function storeTenant(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');

            // Validation rules
            $rules = [
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB max
                'is_active' => 'nullable|boolean',
            ];

            $messages = [
                'logo.image' => 'File must be an image',
                'logo.mimes' => 'Logo must be jpeg, png, jpg, gif, or webp',
                'logo.max' => 'Logo size must not exceed 2MB',
            ];

            foreach ($locales as $locale => $properties) {
                $rules["name.$locale"] = 'required|string|max:255';
                $messages["name.$locale.required"] = "Tenant name ({$properties['native']}) is required";
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(), 'Validation failed', 422);
            }

            DB::beginTransaction();

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'tenant_' . Str::random(20) . '_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/tenants');

                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $logoPath = 'uploads/tenants/' . $fileName;
            }

            // Create tenant
            $tenant = Tenant::create([
                'logo' => $logoPath,
                'is_active' => $request->input('is_active', 1) ? 1 : 0,
            ]);

            // Create translations
            foreach ($locales as $locale => $properties) {
                TenantTranslation::create([
                    'tenant_id' => $tenant->id,
                    'locale' => $locale,
                    'name' => $request->input("name.$locale"),
                ]);
            }

            DB::commit();

            return FormatResponseJson::success(['id' => $tenant->id], 'Tenant created successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    /**
     * Update existing tenant
     */
    public function updateTenant(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');

            // Validation rules
            $rules = [
                'tenant_id' => 'required|exists:tenants,id',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'is_active' => 'nullable|boolean',
            ];

            $messages = [
                'tenant_id.required' => 'Tenant ID is required',
                'tenant_id.exists' => 'Tenant not found',
                'logo.image' => 'File must be an image',
                'logo.mimes' => 'Logo must be jpeg, png, jpg, gif, or webp',
                'logo.max' => 'Logo size must not exceed 2MB',
            ];

            foreach ($locales as $locale => $properties) {
                $rules["name.$locale"] = 'required|string|max:255';
                $messages["name.$locale.required"] = "Tenant name ({$properties['native']}) is required";
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(), 'Validation failed', 422);
            }

            DB::beginTransaction();

            $tenant = Tenant::findOrFail($request->tenant_id);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($tenant->logo) {
                    $oldLogoPath = public_path($tenant->logo);
                    if (File::exists($oldLogoPath)) {
                        File::delete($oldLogoPath);
                    }
                }

                // Upload new logo
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $fileName = 'tenant_' . Str::random(20) . '_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/tenants');

                if (!File::isDirectory($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $fileName);
                $tenant->logo = 'uploads/tenants/' . $fileName;
            }

            // Update tenant
            $tenant->is_active = $request->input('is_active', 1) ? 1 : 0;
            $tenant->save();

            // Update translations
            foreach ($locales as $locale => $properties) {
                TenantTranslation::updateOrCreate(
                    [
                        'tenant_id' => $tenant->id,
                        'locale' => $locale,
                    ],
                    [
                        'name' => $request->input("name.$locale"),
                    ]
                );
            }

            DB::commit();

            return FormatResponseJson::success(['id' => $tenant->id], 'Tenant updated successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    /**
     * Delete tenant
     */
    public function deleteTenant($id)
    {
        try {
            $tenant = Tenant::findOrFail($id);

            DB::beginTransaction();

            // Delete logo file
            if ($tenant->logo) {
                $logoPath = public_path($tenant->logo);
                if (File::exists($logoPath)) {
                    File::delete($logoPath);
                }
            }

            // Delete translations
            TenantTranslation::where('tenant_id', $id)->delete();

            // Delete tenant
            $tenant->delete();

            DB::commit();

            return FormatResponseJson::success(null, 'Tenant deleted successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
}