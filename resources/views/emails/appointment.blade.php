<p>Hola,</p>
<p>Se ha registrado una nueva cita médica en HEALTHIFY.</p>
<p><strong>Detalles:</strong></p>
<ul>
    <li><strong>Paciente:</strong> {{ $appointment->patient->user->name }}</li>
    <li><strong>Doctor:</strong> {{ $appointment->doctor->name }}</li>
    <li><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</li>
    <li><strong>Hora:</strong> {{ $appointment->start_time }}</li>
</ul>
<p>Se adjunta el comprobante en formato PDF.</p>
<p>Gracias por confiar en HEALTHIFY.</p>
