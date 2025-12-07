<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoTour;
use App\Models\VideoTourTranslation;
use App\Services\VideoTourService;
use App\Http\Requests\Admin\Video360Request;
use Illuminate\Support\Facades\DB;
class Video360Controller extends Controller
{
    protected $service;

    public function __construct(VideoTourService $service)
    {
        $this->service = $service;
    }

    public function fetchVideo360()
    {
        return $this->service->fetchVideo360();
    }

    public function store(Video360Request $request)
    {
        try {
            $video = $this->service->saveFromRequest($request);
            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'success', 'video' => $video]);
            }
            return redirect()->route('home-page')->with('success','success');
        } catch (\Throwable $th) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            }
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
