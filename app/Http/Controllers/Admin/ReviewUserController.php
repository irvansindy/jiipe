<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\FormatResponseJson;
use App\Http\Requests\ReviewRequest;
use App\Services\ReviewService;
use Illuminate\Support\Facades\DB;

class ReviewUserController extends Controller
{
    protected $service;

    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('layouts.admin.home.index');
    }

    public function fetch(Request $request)
    {
        try {
            $reviews = $this->service->fetch(app()->getLocale());
            $message = $reviews->isEmpty() ? 'No data found' : 'Success fetch data reviews';
            return FormatResponseJson::success($reviews, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function store(ReviewRequest $request)
    {
        try {
            $data = $request->validated();
            // transport file under a special key to service
            if ($request->hasFile('photo')) {
                $data['_file_photo'] = $request->file('photo');
            }

            $review = $this->service->create($data);
            return FormatResponseJson::success($review, 'Success create review');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $id = $request->input('id');
            $review = $this->service->find($id);
            return FormatResponseJson::success($review, 'Success fetch review data');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }

    public function edit($id)
    {
        try {
            $review = $this->service->find($id);
            return response()->json($review);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(ReviewRequest $request, $id)
    {
        try {
            $data = $request->validated();
            if ($request->hasFile('photo')) {
                $data['_file_photo'] = $request->file('photo');
            }

            $this->service->update($id, $data);

            return response()->json([
                'success' => true,
                'message' => 'Review updated successfully!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Review deleted successfully!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $review = $this->service->toggleStatus($id);
            return response()->json([
                'success' => true,
                'is_active' => $review->is_active,
                'message' => 'Status updated successfully!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
