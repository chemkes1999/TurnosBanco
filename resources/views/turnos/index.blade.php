<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
