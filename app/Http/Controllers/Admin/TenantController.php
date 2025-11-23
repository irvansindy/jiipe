<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    // public function index()
    // {
    //     return view('admin.tenants.index');
    // }

    public function fetchTenant()
    {
        try {
            $locale = app()->getLocale();
            $tenants = Tenant::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])->get();

            $message = $tenants->isNotEmpty() ? 'Success fetch data tenant' : 'No data found';
            return FormatResponseJson::success($tenants, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, 'Failed fetch data tenant: ' . $th->getMessage(), 500);
        }
    }

    public function fetchTenantById($id)
    {
        try {
            $locale = app()->getLocale();
            $tenant = Tenant::with(['translations'])->findOrFail($id);

            return FormatResponseJson::success($tenant, 'Success fetch tenant data');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, 'Failed fetch tenant data: ' . $th->getMessage(), 500);
        }
    }

    public function storeTenant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name.*' => 'required|string|max:255',
            // 'locale' => 'required|string|max:10',
            'description.*' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,web|max:2048',
        ]);

        if ($validator->fails()) {
            return FormatResponseJson::error(null, $validator->errors()->first(), 422);
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('tenants-logo', 'uploads');
            }

            $tenant = Tenant::create([
                'is_active' => $data['is_active'] ?? true,
                'logo' => $logoPath,
            ]);

            foreach ($request->name as $locale => $name) {
                $tenant->translations()->create([
                    'locale' => $locale,
                    'name' => $name,
                    // 'description' => $data['description'][$locale] ?? null,
                ]);
            }
            DB::commit();

            // Load translations for response
            $tenant->load('translations');

            return FormatResponseJson::success($tenant, 'Tenant created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, 'Failed to create tenant: ' . $th->getMessage(), 500);
        }
    }

    public function updateTenant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
            'name.*' => 'required|string|max:255',
            // 'locale' => 'required|string|max:10',
            // 'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return FormatResponseJson::error(null, $validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();

            $tenant = Tenant::findOrFail($request->tenant_id);

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($tenant->logo && \Storage::disk('uploads')->exists($tenant->logo)) {
                    \Storage::disk('uploads')->delete($tenant->logo);
                }
                $logoPath = $request->file('logo')->store('tenants-logo', 'uploads');
                $tenant->logo = $logoPath;
            }

            $tenant->is_active = $data['is_active'] ?? $tenant->is_active;
            $tenant->save();

            foreach ($request->name as $locale => $name) {
                $tenant->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'name' => $name,
                        // 'description' => $data['description'][$locale] ?? null,
                    ]
                );
            }

            DB::commit();

            // Load translations for response
            $tenant->load('translations');

            return FormatResponseJson::success($tenant, 'Tenant updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, 'Failed to update tenant: ' . $th->getMessage(), 500);
        }
    }

    public function deleteTenant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
        ]);

        if ($validator->fails()) {
            return FormatResponseJson::error(null, $validator->errors()->first(), 422);
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();

            $tenant = Tenant::findOrFail($data['tenant_id']);

            // Delete logo if exists
            if ($tenant->logo && \Storage::disk('uploads')->exists($tenant->logo)) {
                \Storage::disk('uploads')->delete($tenant->logo);
            }

            $tenant->translations()->delete();
            $tenant->delete();

            DB::commit();
            return FormatResponseJson::success(null, 'Tenant deleted successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, 'Failed to delete tenant: ' . $th->getMessage(), 500);
        }
    }
}