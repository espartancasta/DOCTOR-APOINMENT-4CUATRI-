<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use Livewire\Component;

class ConsultationManager extends Component
{
    public Appointment $appointment;
    
    public $diagnosis;
    public $treatment;
    public $notes;
    
    public $medications = [
        ['name' => '', 'dosage' => '']
    ];

    public $showHistoryModal = false;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;
        
        $this->diagnosis = $appointment->diagnosis ?? '';
        $this->treatment = $appointment->treatment ?? '';
        $this->notes = $appointment->notes ?? '';
        
        if ($appointment->prescriptions) {
            $parsed = json_decode($appointment->prescriptions, true);
            if(is_array($parsed) && count($parsed) > 0) {
                $this->medications = $parsed;
            }
        }
    }

    public function addMedication()
    {
        $this->medications[] = ['name' => '', 'dosage' => ''];
    }

    public function removeMedication($index)
    {
        unset($this->medications[$index]);
        $this->medications = array_values($this->medications);
    }

    public function save()
    {
        $this->validate([
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'medications' => 'required|array|min:2',
            'medications.*.name' => 'required|string',
            'medications.*.dosage' => 'required|string',
        ], [
            'medications.min' => 'Debe agregar mínimo dos medicamentos en la receta.',
            'medications.*.name.required' => 'El nombre del medicamento es requerido.',
            'medications.*.dosage.required' => 'La dosis del medicamento es requerida.',
        ]);

        $this->appointment->update([
            'diagnosis' => $this->diagnosis,
            'treatment' => $this->treatment,
            'notes' => $this->notes,
            'prescriptions' => json_encode($this->medications),
            'status' => 2 // 2 = Atendido
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Consulta Registrada!',
            'text' => 'Los datos de la atención médica se han guardado correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        // Obtener historial de consultas (appointments atendidos con diagnosis)
        $previousConsultations = Appointment::where('patient_id', $this->appointment->patient_id)
            ->where('id', '!=', $this->appointment->id)
            ->whereNotNull('diagnosis')
            ->orderBy('date', 'desc')
            ->get();

        return view('livewire.admin.consultation-manager', [
            'previousConsultations' => $previousConsultations
        ]);
    }
}
