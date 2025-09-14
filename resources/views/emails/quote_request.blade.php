<!DOCTYPE html>
<html>
<head>
    <title>Nueva Solicitud de Cotización</title>
</head>
<body style="font-family: sans-serif; color: #333;">
    <h1 style="color: #10B981;">Nueva Solicitud de Cotización de VerdeAI</h1>
    <p>Has recibido una nueva solicitud de cotización con los siguientes detalles:</p>
    <ul>
        <li><strong>Nombre:</strong> {{ $data['name'] }}</li>
        <li><strong>Email de Contacto:</strong> {{ $data['email'] }}</li>
    </ul>
    <hr>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $data['message'] ?? 'No se proporcionó ningún mensaje adicional.' }}</p>
</body>
</html>