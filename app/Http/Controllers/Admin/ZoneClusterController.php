<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ZoneClusterRequest;
use App\Services\ZoneClusterService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use Exception;

class ZoneClusterController extends Controller
{
    protected $clusterService;

    public function __construct(ZoneClusterService $clusterService)
    {
        $this->clusterService = $clusterService;
    }

    /**
     * Fetch clusters by zone
     */
    public function fetchClusters(Request $request, int $zoneId)
    {
        try {
            $locale = $request->get('locale', app()->getLocale());
            $clusters = $this->clusterService->getClustersByZone($zoneId, $locale);

            $message = $clusters->isNotEmpty() ? 'Success fetch zone clusters' : 'No data found';
            return FormatResponseJson::success($clusters, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Get cluster detail
     */
    public function getClusterDetail(int $id)
    {
        try {
            $data = $this->clusterService->getClusterById($id);

            return FormatResponseJson::success($data, 'Cluster detail fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Store new cluster
     */
    public function storeCluster(ZoneClusterRequest $request)
    {
        try {
            $cluster = $this->clusterService->createCluster($request->validated());

            return FormatResponseJson::success($cluster, 'Cluster created successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Update cluster
     */
    public function updateCluster(ZoneClusterRequest $request, int $id)
    {
        try {
            $cluster = $this->clusterService->updateCluster($id, $request->validated());

            return FormatResponseJson::success($cluster, 'Cluster updated successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Delete cluster
     */
    public function deleteCluster(int $id)
    {
        try {
            $this->clusterService->deleteCluster($id);

            return FormatResponseJson::success(null, 'Cluster deleted successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}