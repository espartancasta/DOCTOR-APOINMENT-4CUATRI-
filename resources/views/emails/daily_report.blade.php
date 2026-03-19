<p>Hola {{ $user->name }},</p>
<p>Este es el reporte de citas para el día de hoy ({{ now()->format('d/m/Y') }}).</p>

@if($appointments->count() > 0)
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Hora</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->start_time }}</td>
                    <td>{{ $appointment->patient->user->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->reason }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay citas programadas para el día de hoy.</p>
@endif

<p>Atentamente,<br>Equipo HEALTHIFY</p>
