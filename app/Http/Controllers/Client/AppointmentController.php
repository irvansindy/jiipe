<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Services\AppointmentService;
use App\Services\EmailService;
use Exception;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    protected $appointmentService;
    protected $emailService;

    public function __construct(
        AppointmentService $appointmentService,
        EmailService $emailService
    ) {
        $this->appointmentService = $appointmentService;
        $this->emailService = $emailService;
    }

    /**
     * Store the appointment form submission
     */
    public function storeQuickAppointment(AppointmentRequest $request)
    {
        try {
            // Log incoming request untuk debugging
            Log::info('Appointment submission started', [
                'email' => $request->input('QuickAppointment.email'),
                'company' => $request->input('QuickAppointment.company_name')
            ]);

            // Prepare appointment data
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

            // Save to database
            $appointment = $this->appointmentService->createAppointment($appointmentData);

            Log::info('Appointment saved to database', ['id' => $appointment->id]);

            // Send emails
            $emailSent = $this->emailService->sendAppointmentEmails($appointmentData);

            if ($emailSent) {
                Log::info('Appointment emails sent successfully');
            } else {
                Log::warning('Appointment emails failed to send');
            }

            // Success message
            $message = 'Appointment submitted successfully! We will contact you soon.';
            if (!$emailSent) {
                $message .= ' Note: Confirmation email could not be sent, but your appointment has been recorded.';
            }

            // return redirect()->back()->with('success', $message);
            return redirect()->route('appointment');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors
            Log::error('Appointment validation error', ['errors' => $e->errors()]);
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            // General errors
            Log::error('Appointment submission error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while submitting your appointment. Please try again.')
                ->withInput();
        }
    }
    public function pageSuccess()
    {
        return view('client.appointment-success');
    }
}