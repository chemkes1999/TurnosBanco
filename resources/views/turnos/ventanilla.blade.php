<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventanilla {{ $ventanilla }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #343a40; /* Fondo oscuro */
            color: #fff; /* Texto claro */
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            background-color: #495057; /* Fondo gris oscuro para el contenedor */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        }
        h1 {
            color: #ffcd39; /* Un color amarillo brillante */
            text-align: center;
        }
        .form-input {
            background-color: #f8f9fa; /* Fondo claro */
            color: #343a40; /* Texto oscuro */
            border-radius: 5px;
            border: none;
            padding: 10px;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .form-input:focus {
            box-shadow: 0 0 8px rgba(255, 205, 57, 0.7); /* Resplandor amarillo */
            border-color: #ffcd39;
        }
        button {
            background-color: #ffcd39; /* Fondo amarillo */
            border: none;
            color: #343a40; /* Texto oscuro */
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #ffc107; /* Amarillo más intenso al pasar el ratón */
        }
        .turno-info {
            background-color: #6c757d; /* Fondo gris más claro para la información */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 1.5rem;
            color: #4a5568;
        }
    </style>
    <style>
        body {
            /*background-color: #f8f9fa;*/
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
