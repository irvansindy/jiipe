<?php

namespace App\Services\AboutUs;

use App\Models\AboutUsVisionMision;
use App\Models\AboutUsVisionMisionTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisionMissionService
{
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $vm = $request->id ? AboutUsVisionMision::findOrFail($request->id) : new AboutUsVisionMision();
            $vm->save();

            foreach (config('laravellocalization.supportedLocales') as $locale => $props) {
                // support both `title_{locale}` style and `title` array style used in some forms
                $title = $request->input("title_{$locale}") ?? ($request->input('title')[$locale] ?? null);
                $vision = $request->input("vision_{$locale}") ?? ($request->input('vision')[$locale] ?? null);
                $mission = $request->input("mission_{$locale}") ?? ($request->input('mission')[$locale] ?? null);

                $translation = AboutUsVisionMisionTranslation::firstOrNew([
                    'about_us_vision_mision_id' => $vm->id,
                    'locale' => $locale,
                ]);
                $translation->title = $title;
                if (property_exists($translation, 'vision')) {
                    $translation->vision = $vision;
                }
                if (property_exists($translation, 'mission')) {
                    $translation->mission = $mission;
                }
                $translation->save();
            }

            DB::commit();
            return $vm;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
