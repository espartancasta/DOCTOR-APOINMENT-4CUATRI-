<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\User;
use App\Mail\DailyReportMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailyAppointmentsReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un reporte diario de citas a administradores y doctores.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $appointments = Appointment::where('date', $today)
            ->with(['patient.user', 'doctor'])
            ->get();

        // 1. Reporte para Administradores (Toda la lista)
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new DailyReportMail($appointments, $admin));
        }

        // 2. Reporte para cada Doctor (Solo sus citas)
        $appointmentsByDoctor = $appointments->groupBy('doctor_id');

        foreach ($appointmentsByDoctor as $doctorId => $doctorAppointments) {
            $doctor = User::find($doctorId);
            if ($doctor) {
                Mail::to($doctor->email)->send(new DailyReportMail($doctorAppointments, $doctor));
            }
        }

        $this->info('Reportes diarios enviados correctamente.');
    }
}
