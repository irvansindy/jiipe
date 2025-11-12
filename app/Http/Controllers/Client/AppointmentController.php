<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageAppointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    /**
     * Store the appointment form submission
     */
    public function storeQuickAppointment(Request $request)
    {
        try {
            // Validate the form
            $validator = Validator::make($request->all(), [
                'QuickAppointment.first_name' => 'required|string|max:255',
                'QuickAppointment.last_name' => 'required|string|max:255',
                'QuickAppointment.phone_number' => 'required|string|max:20',
                'QuickAppointment.email' => 'required|email',
                'QuickAppointment.company_name' => 'required|string|max:255',
                'QuickAppointment.country_origin' => 'required|in:Indonesia,Outside of Indonesia',
                'QuickAppointment.reason' => 'required|string',
                'QuickAppointment.classification' => 'required|string',
                'QuickAppointment.land_plot' => 'required|numeric|min:0',
                'QuickAppointment.timeline' => 'required|string',
                'QuickAppointment.power' => 'required|numeric|min:0',
                'QuickAppointment.industrial_water' => 'required|numeric|min:0',
                'QuickAppointment.natural_gas' => 'required|numeric|min:0',
                'QuickAppointment.throughput_via_seaport' => 'required|numeric|min:0',
                'g-recaptcha-response' => 'required|captcha',
            ]);

            $validator->setAttributeNames([
                'QuickAppointment.first_name' => 'First Name',
                'QuickAppointment.last_name' => 'Last Name',
                'QuickAppointment.phone_number' => 'Phone Number',
                'QuickAppointment.email' => 'Email',
                'QuickAppointment.company_name' => 'Company Name',
                'QuickAppointment.country_origin' => 'Country Origin',
                'QuickAppointment.reason' => 'Reason',
                'QuickAppointment.classification' => 'Industry Classification',
                'QuickAppointment.land_plot' => 'Land Plot',
                'QuickAppointment.timeline' => 'Timeline',
                'QuickAppointment.power' => 'Power',
                'QuickAppointment.industrial_water' => 'Industrial Water',
                'QuickAppointment.natural_gas' => 'Natural Gas',
                'QuickAppointment.throughput_via_seaport' => 'Throughput via Seaport',
                'g-recaptcha-response' => 'reCAPTCHA',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // If you have an AppointmentSubmission model, save the data
            // Otherwise, just send an email or log it
            $appointmentData = [
                'first_name' => $request->input('QuickAppointment.first_name'),
                'last_name' => $request->input('QuickAppointment.last_name'),
                'phone_number' => $request->input('QuickAppointment.phone_number'),
                'email' => $request->input('QuickAppointment.email'),
                'company_name' => $request->input('QuickAppointment.company_name'),
                'country_origin' => $request->input('QuickAppointment.country_origin'),
                'reason' => $request->input('QuickAppointment.reason'),
                'reason_other' => $request->input('QuickAppointment.reason_other'),
                'classification' => $request->input('QuickAppointment.classification'),
                'classification_other' => $request->input('QuickAppointment.classification_other'),
                'land_plot' => $request->input('QuickAppointment.land_plot'),
                'timeline' => $request->input('QuickAppointment.timeline'),
                'power' => $request->input('QuickAppointment.power'),
                'industrial_water' => $request->input('QuickAppointment.industrial_water'),
                'natural_gas' => $request->input('QuickAppointment.natural_gas'),
                'throughput_via_seaport' => $request->input('QuickAppointment.throughput_via_seaport'),
            ];

            // TODO: Save to database or send email as per your requirement
            // PageAppointment::create($appointmentData);

            return redirect()->back()->with('success', 'Appointment submitted successfully! We will contact you soon.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
    }
}
