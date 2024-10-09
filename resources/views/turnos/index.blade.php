<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos</title>
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
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Turnos Actuales</h1>

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

    <!-- Mostrar el siguiente turno en pasar -->
    @if ($siguienteTurno)
        <div class="alert alert-info">
            <strong>Siguiente turno en pasar:</strong> {{ $siguienteTurno->codigo_turno }}
        </div>
    @else
        <div class="alert alert-info">
            No hay turnos pendientes.
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>Código de Turno</th>
            <th>Ventanilla</th>
            <th>Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($turnos as $turno)
            <tr>
                <td>{{ $turno->codigo_turno }}</td>
                <td>{{ $turno->ventanilla ?? 'Sin asignar' }}</td>
                <td>{{ ucfirst($turno->estado) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form action="/turnos/generar" method="POST" class="mb-3">
        @csrf
        <button class="btn btn-primary">Generar Turno</button>
    </form>
    <form action="/turnos/asignar" method="POST" class="mb-3">
        @csrf
        <div class="mb-2">
            <label for="turno_id">ID de Turno:</label>
            <input type="text" id="turno_id" name="turno_id" class="form-control" required>
        </div>
        <div class="mb-2">
            <label for="ventanilla">Ventanilla:</label>
            <input type="number" id="ventanilla" name="ventanilla" class="form-control" min="1" max="5" required>
        </div>
        <button class="btn btn-success">Asignar Ventanilla</button>
    </form>

</div>
</body>
</html>
