<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\ZoneTranslation;
use App\Models\ZoneClass;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
class ZoneController extends Controller
{
    public function index()
    {
        return view('layouts.admin.zone.index');
    }
    public function fetchZone(Request $request)
    {
        try {
            $locale = app()->getLocale();
            $zones = Zone::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])
            ->where('zone_class_id', 1)
            ->get();
            $message = $zones->isNotEmpty() ? 'Success fetch data zone' : 'No data found';
            return FormatResponseJson::success($zones, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,'Failed fetch data zone', 500);
        }
    }
    public function fetchSpecialZone(Request $request)
    {
        try {
            $locale = app()->getLocale();
            $zones = Zone::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])
            ->where('zone_class_id', 2)
            ->get();
            $message = $zones->isNotEmpty() ? 'Success fetch data zone' : 'No data found';
            return FormatResponseJson::success($zones, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,'Failed fetch data zone', 500);
        }
    }
    public function fetchZoneClass()
    {
        try {
            $locale = app()->getLocale();
            $zoneClasses = ZoneClass::with(['translations' => function($query) use ($locale) {
                $query->where('locale', $locale);
            }])->get();
            $message = $zoneClasses->isNotEmpty() ? 'Success fetch data zone class' : 'No data found';
            return FormatResponseJson::success($zoneClasses, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,'Failed fetch data zone class', 500);
        }
    }
    public function storeZone(Request $request)
    {
        try {
            // dd($request->all());
            $locales = config('laravellocalization.supportedLocales');
            $rules = [
                'zone_class' => 'required|exists:zone_classes,id',
                'zone_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048' // Maksimal ukuran file 2MB
            ];

            foreach ($locales as $locale => $properties) {
                $rules["zone_name.$locale"] = 'nullable|string|max:255';
                $rules["zone_subtitle.$locale"] = 'nullable|string|max:255';
                $rules["zone_description.$locale"] = 'nullable|string';
                $rules["zone_note.$locale"] = 'nullable|string|max:255';
            }
            $validator = Validator::make($request->all(), $rules, [
                'zone_class.required' => 'Zone class is required',
                'zone_class.exists' => 'Zone class is invalid',
                'zone_name.*.required' => 'Zone name is required',
                'zone_name.*.string' => 'Zone name must be a string',
                'zone_name.*.max' => 'Zone name must not exceed 255 characters',
                'zone_subtitle.*.required' => 'Zone subtitle is required',
                'zone_subtitle.*.string' => 'Zone subtitle must be a string',
                'zone_subtitle.*.max' => 'Zone subtitle must not exceed 255 characters',
                'zone_description.*.required' => 'Zone description is required',
                'zone_description.*.string' => 'Zone description must be a string',
                'zone_note.*.nullable' => 'Zone note is optional',
                'zone_note.*.string' => 'Zone note must be a string',
                'zone_note.*.max' => 'Zone note must not exceed 255 characters',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('zone_image')) {
                $imagePath = $request->file('zone_image')->store('zones', 'uploads');
            }

            $zone = Zone::create([
                'zone_class_id' => $request->zone_class,
                'image' => $imagePath,
            ]);

            foreach ($locales as $locale => $properties) {
                ZoneTranslation::create([
                    'zone_id' => $zone->id,
                    'locale' => $locale,
                    'name' => $request->input("zone_name.$locale"),
                    'subtitle' => $request->input("zone_subtitle.$locale"),
                    'description' => $request->input("zone_description.$locale"),
                    'meta_title' => $request->input("zone_name.$locale"),
                    'meta_description' => $request->input("zone_description.$locale"),
                    'note' => $request->input("zone_note.$locale"),
                ]);
            }

            DB::commit();
            return FormatResponseJson::success($zone, 'Zone created successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
        }
    }
    public function getZoneDetail($id)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $zone = Zone::with(['translations'])->findOrFail($id);
            $translations = [];
            foreach ($locales as $locale => $properties) {
                $trans = $zone->translations->where('locale', $locale)->first();
                $translations[$locale] = [
                    'name' => $trans ? $trans->name : '',
                    'subtitle' => $trans ? $trans->subtitle : '',
                    'description' => $trans ? $trans->description : '',
                    'note' => $trans ? $trans->note : '',
                ];
            }
            $data = [
                'id' => $zone->id,
                'zone_class_id' => $zone->zone_class_id,
                'image' => $zone->image,
                'translations' => $translations,
            ];
            return FormatResponseJson::success($data, 'Zone detail fetched');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, 'Failed to fetch zone detail', 500);
        }
    }
    public function updateZone(Request $request, $id)
    {
        $locales = config('laravellocalization.supportedLocales');
        $rules = [
            'zone_class' => 'required|exists:zone_classes,id',
            'zone_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ];
        foreach ($locales as $locale => $properties) {
            $rules["zone_name.$locale"] = 'required|string|max:255';
            $rules["zone_subtitle.$locale"] = 'required|string|max:255';
            $rules["zone_description.$locale"] = 'required|string';
            $rules["zone_note.$locale"] = 'nullable|string|max:255';
        }
        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            DB::beginTransaction();

            $zone = Zone::findOrFail($id);

            // Handle image update
            if ($request->hasFile('zone_image')) {
                $imagePath = $request->file('zone_image')->store('zones', 'uploads');
                $zone->image = $imagePath;
            }
            $zone->zone_class_id = $request->zone_class;
            $zone->save();

            foreach ($locales as $locale => $properties) {
                $translation = ZoneTranslation::where('zone_id', $zone->id)->where('locale', $locale)->first();
                if ($translation) {
                    $translation->update([
                        'name' => $request->input("zone_name.$locale"),
                        'subtitle' => $request->input("zone_subtitle.$locale"),
                        'description' => $request->input("zone_description.$locale"),
                        'meta_title' => $request->input("zone_name.$locale"),
                        'meta_description' => $request->input("zone_description.$locale"),
                        'note' => $request->input("zone_note.$locale"),
                    ]);
                } else {
                    ZoneTranslation::create([
                        'zone_id' => $zone->id,
                        'locale' => $locale,
                        'name' => $request->input("zone_name.$locale"),
                        'subtitle' => $request->input("zone_subtitle.$locale"),
                        'description' => $request->input("zone_description.$locale"),
                        'meta_title' => $request->input("zone_name.$locale"),
                        'meta_description' => $request->input("zone_description.$locale"),
                        'note' => $request->input("zone_note.$locale"),
                    ]);
                }
            }

            DB::commit();
            return FormatResponseJson::success($zone, 'Zone updated successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
        }
    }
}
