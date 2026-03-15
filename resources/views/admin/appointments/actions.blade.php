<div class="flex space-x-2">
    <!-- View / Edit Medical History (Redirige a módulo paciente) -->
    <a href="{{ route('admin.patients.edit', $appointment->patient_id) }}" class="text-blue-500 hover:text-blue-700 mx-1" title="Ver / Editar Historia Médica">
        <i class="fa-solid fa-user-injured"></i>
    </a>
    
    <!-- Consultation Action -->
    <a href="{{ route('admin.appointments.consultation', $appointment) }}" class="text-green-500 hover:text-green-700 mx-1" title="Atención Médica">
        <i class="fa-solid fa-stethoscope"></i>
    </a>
</div>
