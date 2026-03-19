<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new message instance.
     */
    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $pdf = PDF::loadView('pdf.appointment', ['appointment' => $this->appointment]);

        return $this->subject('Nueva Cita Médica - HEALTHIFY')
                    ->view('emails.appointment')
                    ->attachData($pdf->output(), 'cita_medica.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
