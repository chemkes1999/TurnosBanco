<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de turnos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #343a40; /* Fondo oscuro */
            color: #fff; /* Texto claro */
        }
        .container {
            max-width: 600px;
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
<div class="container">
    <h1 class="mb-4">Bienvenido al Sistema de Turnos</h1>
    <form id="ventanillaForm" action="/ventanilla/" method="GET">
        @csrf
        <input type="number" class="w-100 form-input" id="ventanillaInput" name="ventanilla" min="1" required placeholder="Número de ventanilla">
        <button type="submit" class="btn btn-primary w-100">Ingresar al siguiente turno</button>
    </form>
</div>
</body>
<script>
    document.getElementById('ventanillaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Obtener el valor del input ventanilla
        const ventanilla = document.getElementById('ventanillaInput').value;

        // Verificar que el valor no esté vacío
        if (ventanilla) {
            // Cambiar la URL del action para incluir el número de ventanilla
            this.action = '/ventanilla/' + ventanilla;

            // Enviar el formulario
            this.submit();
        } else {
            alert('Por favor, ingrese un número de ventanilla válido.');
        }
    });
</script>
</html>
