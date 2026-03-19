<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointments;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Collection $appointments, $user)
    {
        $this->appointments = $appointments;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Reporte Diario de Citas - HEALTHIFY')
                    ->view('emails.daily_report');
    }
}
