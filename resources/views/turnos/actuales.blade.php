<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Actuales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            padding-top: 20px;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin: 0 auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            font-size: x-large;
            background-color: #007bff;
            color: #ffffff;
        }

        td {
            text-align: center;
            background-color: #ffffff;
        }

        .highlight {
            background-color: #d4edda !important;
            color: #155724;
            font-weight: bold;
        }

        .alert {
            margin-bottom: 20px;
        }

        .advertisement, .video-section {
            margin: 20px 0;
        }

        .advertisement {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .video-section {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .ratio {
            margin-bottom: 0;
        }

        .ratio-16x9 {
            padding-top: 56.25%;
            position: relative;
        }

        .ratio-16x9 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        body {
            background-color: #343a40; /* Fondo oscuro */
            color: #fff; /* Texto claro */
        }
        .container {
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
    <h1 class="mb-4 text-center">Turnos Actuales en Ventanillas</h1>

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

    <!-- Sección de publicidad -->
    <div class="advertisement card">
        <h4 class="card-header">Publicidad</h4>
        <div class="card-body">
            <p>Aquí puedes colocar anuncios o cualquier otro contenido publicitario.</p>
            <a href="#" class="btn btn-primary">Ver más</a>
        </div>
    </div>

    <!-- Sección de turnos -->
    <div class="table-container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Listado de Turnos Actuales</h5>
            </div>
            <div class="card-body">
                <!-- Agregamos id="turnos-table" aquí -->
                <table class="table table-striped table-bordered" id="turnos-table">
                    <thead>
                    <tr>
                        <th>Ventanilla</th>
                        <th>Código de Turno</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- El contenido dinámico se llenará aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Función para obtener los turnos
    function fetchTurnos() {
        axios.get('/turnos/fetch')
            .then(response => {
                const turnos = response.data;

                // Asegúrate de que `turnos` es un array
                if (Array.isArray(turnos)) {
                    const tableBody = document.querySelector('#turnos-table tbody');

                    if (tableBody) {
                        // Limpia el contenido previo
                        tableBody.innerHTML = '';

                        // Añadir filas a la tabla
                        turnos.forEach(turno => {
                            const row = document.createElement('tr');
                            row.id = `turno-${turno.id}`;
                            row.className = turno.estado === 'atendiendo' ? 'highlight' : '';
                            row.innerHTML = `
                                <td>${turno.ventanilla}</td>
                                <td>${turno.codigo_turno}</td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        console.error('Error: No se pudo encontrar el tbody de la tabla.');
                    }
                } else {
                    console.error('Error: La respuesta no es un array.');
                }
            })
            .catch(error => {
                console.error('Error fetching turnos:', error);
            });
    }

    // Llama a la función `fetchTurnos` al cargar la página
    fetchTurnos();

    setInterval(fetchTurnos, 5000); // Actualiza cada 5 segundos
</script>
</body>
</html>
