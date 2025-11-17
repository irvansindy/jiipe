<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoTour;
use App\Models\VideoTourTranslation;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class Video360Controller extends Controller
{
    public function fetchVideo360()
    {
        $video = VideoTour::with('translations')->first();
        return $video;
    }
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $locales = config('laravellocalization.supportedLocales');
            $rules = [
                'embed_code' => 'required|string',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return FormatResponseJson::error($validator->errors(),'Validation failed', 422);
            }
            DB::beginTransaction();
            $video = $request->id ? VideoTour::find($request->id) : null;
            $thumbnailPath = null;

            if($request->hasFile('video_thumbnail')) {
                if ($video && $video->thumbnail) {
                    # code...
                    $old = public_path(ltrim('asset/storage/thumbnail/'.$video->thumbnail, '/'));
                    if (file_exists($old)) @unlink($old);
                }
                $video_thumbnail = $request->file('video_thumbnail');
                $video_thumbnailName = Str::random(12) . '_' . time() . '.' . $video_thumbnail->getClientOriginalExtension();
                $dest = public_path('asset/storage/thumbnail');
                if (!is_dir($dest)) mkdir($dest, 0755, true);
                $video_thumbnail->move($dest, $video_thumbnailName);
                $thumbnailPath = '/asset/storage/thumbnail/' . $video_thumbnailName;
            } else {
                $thumbnailPath = $video ? $video->thumbnail : null;
            }

            $dataVideo = [
                'embed_code' => $request->embed_code,
                'thumbnail' => $thumbnailPath,
            ];

            if ($video) {
                // update existing using updateOrCreate (match by id)
                $video = VideoTour::updateOrCreate(['id' => $request->id], $dataVideo + $video->toArray());
                $video->fill($dataVideo);
                $video->save();
            } else {
                // create new
                $video = VideoTour::create($mainData);
            }

            foreach ($request->video_title as $locale => $props) {
                // dd($request->video_title[$locale]);
                VideoTourTranslation::updateOrCreate([
                    'video_tour_id'=> $request->id,
                    'locale' => $locale,
                ],
            [
                'title' => $request->video_title[$locale],
                'description' => $request->description[$locale] ?? null,
            ]);
            }
            DB::commit();
            // dd($video);
            return redirect()->route('home-page')->with('success','success');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
