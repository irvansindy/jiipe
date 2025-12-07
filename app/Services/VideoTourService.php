<?php

namespace App\Services;

use App\Models\VideoTour;
use App\Models\VideoTourTranslation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VideoTourService
{
    public function fetchVideo360()
    {
        return VideoTour::with('translations')->first();
    }

    public function saveFromRequest($request)
    {
        DB::beginTransaction();
        try {
            $video = $request->id ? VideoTour::find($request->id) : null;

            $thumbnailPath = $this->processThumbnail($request, $video);

            $dataVideo = [
                'embed_code' => $request->embed_code,
                'thumbnail' => $thumbnailPath,
            ];

            if ($video) {
                $video->update($dataVideo);
            } else {
                $video = VideoTour::create($dataVideo);
            }

            if ($request->has('video_title') && is_array($request->video_title)) {
                foreach ($request->video_title as $locale => $title) {
                    VideoTourTranslation::updateOrCreate(
                        [
                            'video_tour_id' => $video->id,
                            'locale' => $locale,
                        ],
                        [
                            'title' => $title,
                            'description' => $request->description[$locale] ?? null,
                        ]
                    );
                }
            }

            DB::commit();
            return $video;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    protected function processThumbnail($request, $video = null)
    {
        // If new file uploaded, store and return path; otherwise keep existing
        if ($request->hasFile('video_thumbnail') && $request->file('video_thumbnail') instanceof UploadedFile) {
            if ($video && $video->thumbnail) {
                $old = public_path(ltrim('asset/storage/thumbnail/'.$video->thumbnail, '/'));
                if (file_exists($old)) @unlink($old);
            }

            $video_thumbnail = $request->file('video_thumbnail');
            $video_thumbnailName = Str::random(12) . '_' . time() . '.' . $video_thumbnail->getClientOriginalExtension();
            $dest = public_path('asset/storage/thumbnail');
            if (!is_dir($dest)) mkdir($dest, 0755, true);
            $video_thumbnail->move($dest, $video_thumbnailName);
            return '/asset/storage/thumbnail/' . $video_thumbnailName;
        }

        return $video ? $video->thumbnail : null;
    }
}
