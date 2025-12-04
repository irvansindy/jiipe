<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $appointmentData;

    /**
     * Create a new message instance.
     */
    public function __construct($appointmentData)
    {
        $this->appointmentData = $appointmentData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Appointment Confirmation - JIIPE')
                    ->view('emails.appointment-confirmation')
                    ->with('data', $this->appointmentData);
    }
}