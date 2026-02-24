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
use App\Models\PageAppointment;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
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
    public function fetchAppointment(Request $request)
    {
        try {
            $query = PageAppointment::query();

            // apply filters if provided
            if ($request->filled('reason')) {
                $query->where('reason', $request->input('reason'));
            }
            if ($request->filled('classification')) {
                $query->where('classification', $request->input('classification'));
            }
            if ($request->filled('land_plot')) {
                $query->where('land_plot', $request->input('land_plot'));
            }
            if ($request->filled('timeline')) {
                $query->where('timeline', $request->input('timeline'));
            }
            if ($request->filled('power')) {
                $query->where('power', $request->input('power'));
            }
            if ($request->filled('industrial_water')) {
                $query->where('industrial_water', $request->input('industrial_water'));
            }
            if ($request->filled('natural_gas')) {
                $query->where('natural_gas', $request->input('natural_gas'));
            }
            if ($request->filled('throughput_via_seaport')) {
                $query->where('throughput_via_seaport', $request->input('throughput_via_seaport'));
            }

            $appointments = $query->get(['first_name', 'last_name', 'phone', 'email', 'company_name', 'country_origin', 'reason', 'classification', 'industrial_water', 'land_plot', 'timeline', 'power', 'natural_gas', 'throughput_via_seaport', 'created_at']);

            return FormatResponseJson::success($appointments, 'Data fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
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
}
