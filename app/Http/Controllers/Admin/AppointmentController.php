<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.appointments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::with('user')->get();
        // Filtrar doctores: Usuarios con el rol de 'doctor'
        $doctors = User::whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        
        return view('admin.appointments.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'reason' => 'required|string',
        ]);

        Appointment::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Cita Registrada!',
            'text' => 'La cita médica ha sido creada correctamente.',
        ]);

        return redirect()->route('admin.appointments.index')
                         ->with('success', 'Cita creada correctamente');
    }

    /**
     * Vista de consulta médica.
     */
    public function consultation(Appointment $appointment)
    {
        return view('admin.appointments.consultation', compact('appointment'));
    }
}
