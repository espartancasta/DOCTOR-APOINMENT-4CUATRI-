<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Cita Médica</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 24px;
        }
        .content {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .detail-row {
            margin-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .label {
            font-weight: bold;
            color: #475569;
            width: 150px;
            display: inline-block;
        }
        .value {
            color: #1e293b;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1> HEALTHIFY - Comprobante de Cita</h1>
        <p>Sistema de Gestión Médica</p>
    </div>

    <div class="content">
        <div class="detail-row">
            <span class="label">Paciente:</span>
            <span class="value">{{ $appointment->patient->user->name }}</span>
        </div>
        <div class="detail-row">
            <span class="label">Doctor:</span>
            <span class="value">{{ $appointment->doctor->name }}</span>
        </div>
        <div class="detail-row">
            <span class="label">Fecha:</span>
            <span class="value">{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</span>
        </div>
        <div class="detail-row">
            <span class="label">Hora:</span>
            <span class="value">{{ $appointment->start_time }} - {{ $appointment->end_time }}</span>
        </div>
        <div class="detail-row">
            <span class="label">Motivo:</span>
            <span class="value">{{ $appointment->reason }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Este es un documento informativo generado automáticamente por HEALTHIFY.</p>
        <p>Por favor, llegue 15 minutos antes de su cita.</p>
    </div>
</body>
</html>
