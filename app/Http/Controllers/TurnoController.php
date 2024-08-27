<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;

class TurnoController extends Controller
{
    public function mostrarGeneradorTurnos()
    {
        return view('turnos.generar');
    }

    public function generarTurno(Request $request)
    {
        // Validar que el campo concepto esté presente
        $request->validate([
            'concepto' => 'required|string|max:255',
        ]);

        // Obtener el último turno para generar el código siguiente
        $ultimoTurno = Turno::latest()->first();
        $nuevoCodigo = $ultimoTurno ? 'A' . str_pad($ultimoTurno->id + 1, 3, '0', STR_PAD_LEFT) : 'A001';

        // Crear y guardar el nuevo turno con el concepto ingresado
        $turno = new Turno();
        $turno->codigo_turno = $nuevoCodigo;
        $turno->concepto = $request->input('concepto'); // Usar el concepto del formulario
        $turno->estado = 'pendiente';
        $turno->save();

        // Redirigir a la vista de generación con el nuevo turno en la vista
        return view('turnos.generar', ['success' => 'Nuevo turno generado: ' . $nuevoCodigo, 'turno' => $turno]);
    }

    public function mostrarTurnos()
    {
        $turnos = Turno::whereNotNull('ventanilla')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return view('turnos.actuales', ['turnos' => $turnos]);
    }

    public function longPolling(): \Illuminate\Http\JsonResponse
    {
        $turnos = Turno::whereNotNull('ventanilla')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json($turnos);
    }

    public function mostrarVentanilla($ventanilla)
    {
        return view('turnos.ventanilla', compact('ventanilla'));
    }

    public function siguienteTurno(Request $request)
    {
        $turno = Turno::where('estado', 'pendiente')->orderBy('id', 'asc')->first();

        if ($turno) {
            $turno->ventanilla = $request->input('ventanilla');
            $turno->estado = 'atendiendo';
            $turno->save();

            return redirect('/ventanilla/' . $turno->ventanilla)->with('success', 'Turno ' . $turno->codigo_turno . ' asignado a ventanilla ' . $turno->ventanilla . '. Concepto ' . $turno->concepto);
        } else {
            return redirect('/ventanilla/' . $request->input('ventanilla'))->with('error', 'No hay más turnos disponibles. Por favor, genere nuevos turnos.');
        }
    }

}
