<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Turno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Generar Nuevo Turno</h1>

    <!-- Mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($turno))
        <div class="alert alert-info">
            <strong>Turno Generado:</strong><br>
            Código de Turno: {{ $turno->codigo_turno }}<br>
            Concepto: {{ $turno->concepto }}<br>
            Estado: {{ ucfirst($turno->estado) }}
        </div>
    @endif

    <form action="/turnos/generar" method="POST">
        @csrf
        <div class="mb-3">
            <label for="concepto" class="form-label">Concepto</label>
            <input type="text" class="form-control" id="concepto" name="concepto" required>
        </div>
        <button class="btn btn-primary w-100">Generar Turno</button>
    </form>
</div>
</body>
</html>
