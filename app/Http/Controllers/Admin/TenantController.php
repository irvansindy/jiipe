<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\FormatResponseJson;
use App\Http\Requests\TenantRequest;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Exception;

class TenantController extends Controller
{
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * Fetch all tenants
     */
    public function fetch()
    {
        try {
            $tenants = $this->tenantService->getAllTenants();

            $message = $tenants->isNotEmpty() ? 'Successfully fetched tenants' : 'No tenants found';
            return FormatResponseJson::success($tenants, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Fetch single tenant by ID
     */
    public function fetchById(Request $request)
    {
        try {
            $tenant = $this->tenantService->getTenantById($request->id);

            return FormatResponseJson::success($tenant, 'Tenant fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 404);
        }
    }

    /**
     * Store new tenant
     */
    public function store(TenantRequest $request)
    {
        try {
            $file = $request->hasFile('logo') ? $request->file('logo') : null;
            $tenant = $this->tenantService->createTenant($request->validated(), $file);

            return FormatResponseJson::success(['id' => $tenant->id], 'Tenant created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update existing tenant
     */
    public function update(TenantRequest $request)
    {
        try {
            $file = $request->hasFile('logo') ? $request->file('logo') : null;
            $tenant = $this->tenantService->updateTenant((int)$request->input('tenant_id'), $request->validated(), $file);

            return FormatResponseJson::success(['id' => $tenant->id], 'Tenant updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete tenant
     */
    public function destroy(int $id)
    {
        try {
            $this->tenantService->deleteTenant($id);

            return FormatResponseJson::success(null, 'Tenant deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
