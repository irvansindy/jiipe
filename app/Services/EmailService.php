<?php

namespace App\Services;

use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentNotification;
use Illuminate\Support\Facades\Mail;
use Exception;

class EmailService
{
    /**
     * Send appointment confirmation emails
     */
    public function sendAppointmentEmails(array $appointmentData): bool
    {
        try {
            // Email ke customer (yang submit form)
            Mail::to($appointmentData['email'])
                ->send(new AppointmentConfirmation($appointmentData));

            // Email ke admin
            Mail::to('rizkiadha@creativeline.id')
                ->send(new AppointmentNotification($appointmentData));

            return true;
        } catch (Exception $e) {
            // Log error but don't throw exception
            // Appointment sudah tersimpan, email failure shouldn't block the process
            \Log::error('Failed to send appointment emails: ' . $e->getMessage());
            return false;
        }
    }
}
