<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentTranslation;
use App\Models\BasicInformation;
use App\Models\BasicInformationTranslation;
use App\Models\Reason;
use App\Models\ReasonTranslation;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
class FormAppointment extends Controller
{
    public function index()
    {
        return view('layouts.admin.form_appointment.index');
    }
    public function formView()
    {
        $appointment = Appointment::with('translations')->first();
        $basicInfo = BasicInformation::with('translations')->first();
        $reason = Reason::with('translations')->first();
        return view('layouts.admin.form_appointment.form_view', compact('appointment', 'basicInfo', 'reason'));
    }
    public function store(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $validator = Validator::make($request->all(), [
                'title_quick_appointment'   => 'required|array',
                'appointment_description'   => 'required|array',
                'title_quick_appointment.*' => 'required|string|max:255',
                'appointment_description.*' => 'required|string',
            ]);
            $validator->setAttributeNames([
                'title_quick_appointment.id' => 'Title Quick Appointment (ID)',
                'title_quick_appointment.en' => 'Title Quick Appointment (EN)',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $appointment = Appointment::first();
            if (!$appointment) {
                $appointment = Appointment::create([
                    'title' => $request->title_quick_appointment['en']
                ]);
            } else {
                $appointment->update([
                    'title' => $request->title_quick_appointment['en']
                ]);
            }

            foreach ($locales as $locale => $properties) {
                AppointmentTranslation::updateOrCreate(
                    [
                        'appointment_id' => $appointment->id,
                        'locale' => $locale,
                    ],
                    [
                        'title_quick_appointment' => $request->title_quick_appointment[$locale] ?? null,
                        'appointment_description' => $request->appointment_description[$locale] ?? null,
                    ]
                );
            }

            return redirect()->back()->with('success', 'Appointment saved successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    
    public function storeBasicInformation(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $validator = Validator::make($request->all(), [
                // ...validation rules...
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $basicInfo = BasicInformation::first();
            if (!$basicInfo) {
                $basicInfo = BasicInformation::create();
            }

            foreach ($locales as $locale => $properties) {
                BasicInformationTranslation::updateOrCreate(
                    [
                        'basic_information_id' => $basicInfo->id,
                        'locale' => $locale,
                    ],
                    [
                        'title_basic_information' => $request->title_basic_information[$locale],
                        'label_full_name' => $request->label_full_name[$locale],
                        'placeholder_full_name_1' => $request->placeholder_full_name_1[$locale],
                        'placeholder_full_name_2' => $request->placeholder_full_name_2[$locale],
                        'label_phone_number' => $request->label_phone_number[$locale],
                        'placeholder_phone_number' => $request->placeholder_phone_number[$locale],
                        'label_email' => $request->label_email[$locale],
                        'placeholder_email' => $request->placeholder_email[$locale],
                        'label_company_name' => $request->label_company_name[$locale],
                        'placeholder_company_name' => $request->placeholder_company_name[$locale],
                        'label_company_origin_country' => $request->label_company_origin_country[$locale],
                        'placeholder_company_origin_country' => $request->placeholder_company_origin_country[$locale],
                    ]
                );
            }

            return redirect()->back()->with('success', 'Basic Information saved successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    
    public function storeReason(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $validator = Validator::make($request->all(), [
                // ...validation rules...
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $reason = Reason::first();
            if (!$reason) {
                $reason = Reason::create();
            }

            foreach ($locales as $locale => $properties) {
                ReasonTranslation::updateOrCreate(
                    [
                        'reason_id' => $reason->id,
                        'locale' => $locale,
                    ],
                    [
                        'label_reason' => $request->label_reason[$locale],
                        'label_industry' => $request->label_industry[$locale],
                        'label_land_plot' => $request->label_land_plot[$locale],
                        'label_timeline_construction' => $request->label_timeline_construction[$locale],
                        'label_energy_utility' => $request->label_energy_utility[$locale],
                        'placeholder_industry' => $request->placeholder_industry[$locale],
                        'placeholder_land_plot' => $request->placeholder_land_plot[$locale],
                        'placeholder_timeline_construction' => $request->placeholder_timeline_construction[$locale],
                        'placeholder_total_power' => $request->placeholder_total_power[$locale],
                        'placeholder_total_water' => $request->placeholder_total_water[$locale],
                        'placeholder_total_gas' => $request->placeholder_total_gas[$locale],
                        'placeholder_throughput_seaport' => $request->placeholder_throughput_seaport[$locale],
                    ]
                );
            }

            return redirect()->back()->with('success', 'Reason saved successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    // public function store(Request $request)
    // {
    //     try {
    //         // dd( $request->title_quick_appointment['en']);
    //         $locales = config('laravellocalization.supportedLocales');

    //         // Validasi input
    //         $validator = Validator::make($request->all(), [
    //             'title_quick_appointment'   => 'required|array',
    //             'appointment_description'   => 'required|array',
    //             'title_quick_appointment.*' => 'required|string|max:255',
    //             'appointment_description.*' => 'required|string',
    //         ], [
    //             'title_quick_appointment.required' => 'The title is required.',
    //             'appointment_description.required' => 'The description is required.',
    //         ]);

    //         $validator->setAttributeNames([
    //             'title_quick_appointment.id' => 'Title Quick Appointment (ID)',
    //             'title_quick_appointment.en' => 'Title Quick Appointment (EN)',
    //             'title_quick_appointment.zh' => 'Title Quick Appointment (ZH)',
    //             'title_quick_appointment.ja' => 'Title Quick Appointment (JA)',
    //             'title_quick_appointment.ko' => 'Title Quick Appointment (KO)',
    //             'title_quick_appointment.tw' => 'Title Quick Appointment (TW)',
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         // Simpan appointment + translations
    //         $appointment = DB::transaction(function () use ($request, $locales) {
    //             // Buat record utama appointment
    //             $appointment = Appointment::create([
    //                 'title' => $request->title_quick_appointment['en']
    //             ]);

    //             // Simpan translation
    //             foreach ($locales as $locale => $properties) {
    //                 AppointmentTranslation::create([
    //                     'appointment_id'           => $appointment->id,
    //                     'locale'                   => $locale,
    //                     'title_quick_appointment'  => $request->title_quick_appointment[$locale] ?? null,
    //                     'appointment_description'  => $request->appointment_description[$locale] ?? null,
    //                 ]);
    //             }

    //             return $appointment;
    //         });

    //         return FormatResponseJson::success($appointment, 'Appointment created successfully.');
    //     } catch (ValidationException $e) {
    //         return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
    //     } catch (\Throwable $th) {
    //         return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
    //     }
    // }
    // public function update(Request $request, $id)
    // {
    //     try {
    //         $locales = config('laravellocalization.supportedLocales');

    //         // Validasi input
    //         $validator = Validator::make($request->all(), [
    //             'title_quick_appointment'   => 'required|array',
    //             'appointment_description'   => 'required|array',
    //             'title_quick_appointment.*' => 'required|string|max:255',
    //             'appointment_description.*' => 'required|string',
    //         ], [
    //             'title_quick_appointment.required' => 'The title is required.',
    //             'appointment_description.required' => 'The description is required.',
    //         ]);

    //         $validator->setAttributeNames([
    //             'title_quick_appointment.id' => 'Title Quick Appointment (ID)',
    //             'title_quick_appointment.en' => 'Title Quick Appointment (EN)',
    //             // Tambahkan locale lain jika perlu
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         $appointment = Appointment::findOrFail($id);

    //         DB::transaction(function () use ($request, $locales, $appointment) {
    //             // Update record utama appointment jika ada field lain
    //             // $appointment->update([...]);

    //             // Update translation
    //             foreach ($locales as $locale => $properties) {
    //                 AppointmentTranslation::updateOrCreate(
    //                     [
    //                         'appointment_id' => $appointment->id,
    //                         'locale' => $locale,
    //                     ],
    //                     [
    //                         'title_quick_appointment' => $request->title_quick_appointment[$locale] ?? null,
    //                         'appointment_description' => $request->appointment_description[$locale] ?? null,
    //                     ]
    //                 );
    //             }
    //         });

    //         return FormatResponseJson::success($appointment, 'Appointment updated successfully.');
    //     } catch (ValidationException $e) {
    //         return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
    //     } catch (\Throwable $th) {
    //         return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
    //     }
    // }
    // public function storeBasicInformation(Request $request)
    // {
    //     try {
    //         $locales = config('laravellocalization.supportedLocales');

    //         // Validasi input
    //         $validator = Validator::make($request->all(), [
    //             'title_basic_information' => 'required|array',
    //             'label_full_name' => 'required|array',
    //             'placeholder_full_name_1' => 'required|array',
    //             'placeholder_full_name_2' => 'required|array',
    //             'label_phone_number' => 'required|array',
    //             'placeholder_phone_number' => 'required|array',
    //             'label_email' => 'required|array',
    //             'placeholder_email' => 'required|array',
    //             'label_company_name' => 'required|array',
    //             'placeholder_company_name' => 'required|array',
    //             'label_company_origin_country' => 'required|array',
    //             'placeholder_company_origin_country' => 'required|array',
    //             // Validasi per locale
    //             'title_basic_information.*' => 'required|string|max:255',
    //             'label_full_name.*' => 'required|string|max:255',
    //             'placeholder_full_name_1.*' => 'required|string|max:255',
    //             'placeholder_full_name_2.*' => 'required|string|max:255',
    //             'label_phone_number.*' => 'required|string|max:255',
    //             'placeholder_phone_number.*' => 'required|string|max:255',
    //             'label_email.*' => 'required|string|max:255',
    //             'placeholder_email.*' => 'required|string|max:255',
    //             'label_company_name.*' => 'required|string|max:255',
    //             'placeholder_company_name.*' => 'required|string|max:255',
    //             'label_company_origin_country.*' => 'required|string|max:255',
    //             'placeholder_company_origin_country.*' => 'required|string|max:255',
    //         ], [
    //             'title_basic_information.required' => 'The title is required.',
    //             'label_full_name.required' => 'Label Full Name is required.',
    //             // Tambahkan pesan lain jika perlu
    //         ]);

    //         // Set attribute names (opsional, untuk pesan error lebih jelas)
    //         $validator->setAttributeNames([
    //             'title_basic_information.id' => 'Title Basic Information (ID)',
    //             'title_basic_information.en' => 'Title Basic Information (EN)',
    //             // Tambahkan locale lain jika perlu
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         // Simpan basic information + translations
    //         $basicInfo = DB::transaction(function () use ($request, $locales) {
    //             $validated = $request->all();
    //             $basicInfo = BasicInformation::create();

    //             foreach ($locales as $locale => $properties) {
    //                 BasicInformationTranslation::create([
    //                     'basic_information_id' => $basicInfo->id,
    //                     'locale' => $locale,
    //                     'title_basic_information' => $validated['title_basic_information'][$locale],
    //                     'label_full_name' => $validated['label_full_name'][$locale],
    //                     'placeholder_full_name_1' => $validated['placeholder_full_name_1'][$locale],
    //                     'placeholder_full_name_2' => $validated['placeholder_full_name_2'][$locale],
    //                     'label_phone_number' => $validated['label_phone_number'][$locale],
    //                     'placeholder_phone_number' => $validated['placeholder_phone_number'][$locale],
    //                     'label_email' => $validated['label_email'][$locale],
    //                     'placeholder_email' => $validated['placeholder_email'][$locale],
    //                     'label_company_name' => $validated['label_company_name'][$locale],
    //                     'placeholder_company_name' => $validated['placeholder_company_name'][$locale],
    //                     'label_company_origin_country' => $validated['label_company_origin_country'][$locale],
    //                     'placeholder_company_origin_country' => $validated['placeholder_company_origin_country'][$locale],
    //                 ]);
    //             }

    //             return $basicInfo;
    //         });

    //         return FormatResponseJson::success($basicInfo,'Basic Information saved successfully!');
    //     } catch (ValidationException $e) {
    //         return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
    //     } catch (\Throwable $th) {
    //         return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
    //     }
    // }
    // public function updateBasicInformation(Request $request, $id)
    // {
    //     try {
    //         $locales = config('laravellocalization.supportedLocales');

    //         // Validasi input
    //         $validator = Validator::make($request->all(), [
    //             'title_basic_information' => 'required|array',
    //             'label_full_name' => 'required|array',
    //             'placeholder_full_name_1' => 'required|array',
    //             'placeholder_full_name_2' => 'required|array',
    //             'label_phone_number' => 'required|array',
    //             'placeholder_phone_number' => 'required|array',
    //             'label_email' => 'required|array',
    //             'placeholder_email' => 'required|array',
    //             'label_company_name' => 'required|array',
    //             'placeholder_company_name' => 'required|array',
    //             'label_company_origin_country' => 'required|array',
    //             'placeholder_company_origin_country' => 'required|array',
    //             // Validasi per locale
    //             'title_basic_information.*' => 'required|string|max:255',
    //             'label_full_name.*' => 'required|string|max:255',
    //             'placeholder_full_name_1.*' => 'required|string|max:255',
    //             'placeholder_full_name_2.*' => 'required|string|max:255',
    //             'label_phone_number.*' => 'required|string|max:255',
    //             'placeholder_phone_number.*' => 'required|string|max:255',
    //             'label_email.*' => 'required|string|max:255',
    //             'placeholder_email.*' => 'required|string|max:255',
    //             'label_company_name.*' => 'required|string|max:255',
    //             'placeholder_company_name.*' => 'required|string|max:255',
    //             'label_company_origin_country.*' => 'required|string|max:255',
    //             'placeholder_company_origin_country.*' => 'required|string|max:255',
    //         ], [
    //             'title_basic_information.required' => 'The title is required.',
    //             'label_full_name.required' => 'Label Full Name is required.',
    //             // Tambahkan pesan lain jika perlu
    //         ]);

    //         $validator->setAttributeNames([
    //             'title_basic_information.id' => 'Title Basic Information (ID)',
    //             'title_basic_information.en' => 'Title Basic Information (EN)',
    //             // Tambahkan locale lain jika perlu
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         $basicInfo = BasicInformation::findOrFail($id);

    //         DB::transaction(function () use ($request, $locales, $basicInfo) {
    //             // Update record utama basic information jika ada field lain
    //             // $basicInfo->update([...]);

    //             foreach ($locales as $locale => $properties) {
    //                 BasicInformationTranslation::updateOrCreate(
    //                     [
    //                         'basic_information_id' => $basicInfo->id,
    //                         'locale' => $locale,
    //                     ],
    //                     [
    //                         'title_basic_information' => $request->title_basic_information[$locale],
    //                         'label_full_name' => $request->label_full_name[$locale],
    //                         'placeholder_full_name_1' => $request->placeholder_full_name_1[$locale],
    //                         'placeholder_full_name_2' => $request->placeholder_full_name_2[$locale],
    //                         'label_phone_number' => $request->label_phone_number[$locale],
    //                         'placeholder_phone_number' => $request->placeholder_phone_number[$locale],
    //                         'label_email' => $request->label_email[$locale],
    //                         'placeholder_email' => $request->placeholder_email[$locale],
    //                         'label_company_name' => $request->label_company_name[$locale],
    //                         'placeholder_company_name' => $request->placeholder_company_name[$locale],
    //                         'label_company_origin_country' => $request->label_company_origin_country[$locale],
    //                         'placeholder_company_origin_country' => $request->placeholder_company_origin_country[$locale],
    //                     ]
    //                 );
    //             }
    //         });

    //         return FormatResponseJson::success($basicInfo, 'Basic Information updated successfully!');
    //     } catch (ValidationException $e) {
    //         return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
    //     } catch (\Throwable $th) {
    //         return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
    //     }
    // }
    // public function storeReason(Request $request)
    // {
    //     try {
    //         $locales = config('laravellocalization.supportedLocales');

    //         $validator = Validator::make($request->all(), [
    //             'label_reason' => 'required|array',
    //             'label_industry' => 'required|array',
    //             'label_land_plot' => 'required|array',
    //             'label_timeline_construction' => 'required|array',
    //             'label_energy_utility' => 'required|array',
    //             'placeholder_industry' => 'required|array',
    //             'placeholder_land_plot' => 'required|array',
    //             'placeholder_timeline_construction' => 'required|array',
    //             'placeholder_total_power' => 'required|array',
    //             'placeholder_total_water' => 'required|array',
    //             'placeholder_total_gas' => 'required|array',
    //             'placeholder_throughput_seaport' => 'required|array',
    //             // Validasi per locale
    //             'label_reason.*' => 'required|string|max:255',
    //             'label_industry.*' => 'required|string|max:255',
    //             'label_land_plot.*' => 'required|string|max:255',
    //             'label_timeline_construction.*' => 'required|string|max:255',
    //             'label_energy_utility.*' => 'required|string|max:255',
    //             'placeholder_industry.*' => 'required|string|max:255',
    //             'placeholder_land_plot.*' => 'required|string|max:255',
    //             'placeholder_timeline_construction.*' => 'required|string|max:255',
    //             'placeholder_total_power.*' => 'required|string|max:255',
    //             'placeholder_total_water.*' => 'required|string|max:255',
    //             'placeholder_total_gas.*' => 'required|string|max:255',
    //             'placeholder_throughput_seaport.*' => 'required|string|max:255',
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         $reason = DB::transaction(function () use ($request, $locales) {
    //             $reason = Reason::create(); // Model Reason sebagai master

    //             foreach ($locales as $locale => $properties) {
    //                 ReasonTranslation::create([
    //                     'reason_id' => $reason->id,
    //                     'locale' => $locale,
    //                     'label_reason' => $request->label_reason[$locale],
    //                     'label_industry' => $request->label_industry[$locale],
    //                     'label_land_plot' => $request->label_land_plot[$locale],
    //                     'label_timeline_construction' => $request->label_timeline_construction[$locale],
    //                     'label_energy_utility' => $request->label_energy_utility[$locale],
    //                     'placeholder_industry' => $request->placeholder_industry[$locale],
    //                     'placeholder_land_plot' => $request->placeholder_land_plot[$locale],
    //                     'placeholder_timeline_construction' => $request->placeholder_timeline_construction[$locale],
    //                     'placeholder_total_power' => $request->placeholder_total_power[$locale],
    //                     'placeholder_total_water' => $request->placeholder_total_water[$locale],
    //                     'placeholder_total_gas' => $request->placeholder_total_gas[$locale],
    //                     'placeholder_throughput_seaport' => $request->placeholder_throughput_seaport[$locale],
    //                 ]);
    //             }

    //             return $reason;
    //         });

    //         return FormatResponseJson::success($reason, 'Reason saved successfully!');
    //     } catch (ValidationException $e) {
    //         return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
    //     } catch (\Throwable $th) {
    //         return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
    //     }
    // }
    // public function updateReason(Request $request, $id)
    // {
    //     try {
    //         $locales = config('laravellocalization.supportedLocales');

    //         $validator = Validator::make($request->all(), [
    //             'label_reason' => 'required|array',
    //             'label_industry' => 'required|array',
    //             'label_land_plot' => 'required|array',
    //             'label_timeline_construction' => 'required|array',
    //             'label_energy_utility' => 'required|array',
    //             'placeholder_industry' => 'required|array',
    //             'placeholder_land_plot' => 'required|array',
    //             'placeholder_timeline_construction' => 'required|array',
    //             'placeholder_total_power' => 'required|array',
    //             'placeholder_total_water' => 'required|array',
    //             'placeholder_total_gas' => 'required|array',
    //             'placeholder_throughput_seaport' => 'required|array',
    //             // Validasi per locale
    //             'label_reason.*' => 'required|string|max:255',
    //             'label_industry.*' => 'required|string|max:255',
    //             'label_land_plot.*' => 'required|string|max:255',
    //             'label_timeline_construction.*' => 'required|string|max:255',
    //             'label_energy_utility.*' => 'required|string|max:255',
    //             'placeholder_industry.*' => 'required|string|max:255',
    //             'placeholder_land_plot.*' => 'required|string|max:255',
    //             'placeholder_timeline_construction.*' => 'required|string|max:255',
    //             'placeholder_total_power.*' => 'required|string|max:255',
    //             'placeholder_total_water.*' => 'required|string|max:255',
    //             'placeholder_total_gas.*' => 'required|string|max:255',
    //             'placeholder_throughput_seaport.*' => 'required|string|max:255',
    //         ]);

    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }

    //         $reason = Reason::findOrFail($id);

    //         DB::transaction(function () use ($request, $locales, $reason) {
    //             foreach ($locales as $locale => $properties) {
    //                 ReasonTranslation::updateOrCreate(
    //                     [
    //                         'reason_id' => $reason->id,
    //                         'locale' => $locale,
    //                     ],
    //                     [
    //                         'label_reason' => $request->label_reason[$locale],
    //                         'label_industry' => $request->label_industry[$locale],
    //                         'label_land_plot' => $request->label_land_plot[$locale],
    //                         'label_timeline_construction' => $request->label_timeline_construction[$locale],
    //                         'label_energy_utility' => $request->label_energy_utility[$locale],
    //                         'placeholder_industry' => $request->placeholder_industry[$locale],
    //                         'placeholder_land_plot' => $request->placeholder_land_plot[$locale],
    //                         'placeholder_timeline_construction' => $request->placeholder_timeline_construction[$locale],
    //                         'placeholder_total_power' => $request->placeholder_total_power[$locale],
    //                         'placeholder_total_water' => $request->placeholder_total_water[$locale],
    //                         'placeholder_total_gas' => $request->placeholder_total_gas[$locale],
    //                         'placeholder_throughput_seaport' => $request->placeholder_throughput_seaport[$locale],
    //                     ]
    //                 );
    //             }
    //         });

    //         return FormatResponseJson::success($reason, 'Reason updated successfully!');
    //     } catch (ValidationException $e) {
    //         return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
    //     } catch (\Throwable $th) {
    //         return FormatResponseJson::error(null, ['message' => $th->getMessage()], 500);
    //     }
    // }
}
