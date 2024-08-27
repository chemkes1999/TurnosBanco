<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventanilla {{ $ventanilla }}</title>
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
        .turno-info {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Ventanilla {{ $ventanilla }}</h1>

    <!-- Mensajes de éxito y error -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Información del turno -->
    @if (session('turno'))
        @php
            $turno = session('turno');
        @endphp
        <div class="turno-info">
            <h4>Información del Turno</h4>
            <p><strong>Código de Turno:</strong> {{ $turno->codigo_turno }}</p>
            <p><strong>Concepto:</strong> {{ $turno->concepto }}</p>
            <p><strong>Ventanilla:</strong> {{ $turno->ventanilla }}</p>
        </div>
    @endif
    <br>
    <form action="/turnos/siguiente" method="POST">
        @csrf
        <input type="hidden" name="ventanilla" value="{{ $ventanilla }}">
        <button class="btn btn-primary w-100">Llamar Siguiente Turno</button>
    </form>
</div>
</body>
</html>
