<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsHeader;
use App\Models\AboutUsContent;
use App\Models\AboutUsVisionMision;
use Illuminate\Support\Facades\Log;
use App\Helpers\FormatResponseJson;
use App\Services\AboutUs\HeaderService;
use App\Services\AboutUs\ContentService;
use App\Services\AboutUs\VisionMissionService;
use App\Services\AboutUs\ContentDetailService;
use App\Http\Requests\Admin\StoreAboutUsHeaderRequest;
use App\Http\Requests\Admin\StoreAboutUsContentRequest;
use App\Http\Requests\Admin\StoreAboutUsVisionMissionRequest;
use App\Http\Requests\Admin\StoreAboutUsContentDetailRequest;

class AboutUsController extends Controller
{
    protected $headerService;
    protected $contentService;
    protected $visionMissionService;
    protected $contentDetailService;

    public function __construct(
        HeaderService $headerService,
        ContentService $contentService,
        VisionMissionService $visionMissionService,
        ContentDetailService $contentDetailService
    ) {
        $this->headerService = $headerService;
        $this->contentService = $contentService;
        $this->visionMissionService = $visionMissionService;
        $this->contentDetailService = $contentDetailService;
    }

    public function index()
    {
        $aboutUsHeader = AboutUsHeader::with('translations')->first();
        $aboutUsContent = AboutUsContent::with('translations')->first();
        $aboutUsVisionMission = AboutUsVisionMision::with('translations')->first();

        return view('layouts.admin.about_us.index', compact(
            'aboutUsHeader',
            'aboutUsContent',
            'aboutUsVisionMission'
        ));
    }

    public function storeHeader(StoreAboutUsHeaderRequest $request)
    {
        try {
            $header = $this->headerService->save($request);
            $header->load('translations');

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cover berhasil disimpan.',
                    'data' => [
                        'id' => $header->id,
                        'image' => $header->image,
                        'image_url' => $header->image
                            ? asset('uploads/about-us/header/' . $header->image)
                            : null,
                        'translations' => $header->translations
                    ],
                ]);
            }

            return redirect()->back()->with('success', 'Cover berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving about us header: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cover gagal disimpan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Cover gagal disimpan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function storeContent(StoreAboutUsContentRequest $request)
    {
        try {
            $content = $this->contentService->save($request);
            $content->load('translations');

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Content berhasil disimpan.',
                    'data' => [
                        'id' => $content->id,
                        'image' => $content->image,
                        'image_url' => $content->image
                            ? asset('uploads/about-us/content/' . $content->image)
                            : null,
                        'video_url' => $content->video_url,
                        'translations' => $content->translations
                    ],
                ]);
            }

            return redirect()->back()->with('success', 'Content berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving about us content: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Content gagal disimpan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Content gagal disimpan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function storeVisionMission(StoreAboutUsVisionMissionRequest $request)
    {
        try {
            $visionMission = $this->visionMissionService->save($request);
            $visionMission->load('translations');

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Visi Misi berhasil disimpan.',
                    'data' => [
                        'id' => $visionMission->id,
                        'translations' => $visionMission->translations
                    ],
                ]);
            }

            return redirect()->back()->with('success', 'Visi Misi berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Error saving vision mission: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Visi Misi gagal disimpan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Visi Misi gagal disimpan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function fetchContentDetail()
    {
        try {
            $contentDetail = $this->contentDetailService->fetchAll(app()->getLocale());
            $message = $contentDetail->isEmpty()
                ? 'No data found'
                : 'Success fetch data content detail';

            return FormatResponseJson::success($contentDetail, $message);
        } catch (\Exception $e) {
            Log::error('Error fetching content detail: ' . $e->getMessage());
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    public function storeContentDetail(StoreAboutUsContentDetailRequest $request)
    {
        try {
            $detail = $this->contentDetailService->save($request);
            $detail->load('translations');

            $message = $request->id
                ? 'Content Detail updated successfully'
                : 'Content Detail created successfully';

            return FormatResponseJson::success([
                'id' => $detail->id,
                'icon' => $detail->icon,
                'icon_url' => $detail->icon
                    ? asset('uploads/about-us/content_detail/' . $detail->icon)
                    : null,
                'category_id' => $detail->category_id,
                'translations' => $detail->translations
            ], $message);
        } catch (\Exception $e) {
            Log::error('Error storing content detail: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function deleteContentDetail(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return FormatResponseJson::error(null, 'ID is required', 400);
            }

            $deleted = $this->contentDetailService->delete($id);

            if (!$deleted) {
                return FormatResponseJson::error(null, 'Content Detail not found', 404);
            }

            return FormatResponseJson::success(null, 'Content Detail deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting content detail: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}