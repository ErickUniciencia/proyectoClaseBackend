<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    public function index()
    {
        $notas = Nota::all();
        return response()->json($notas);
    }

    // Mostrar una nota específica por su ID
    public function show($id)
    {
        $nota = Nota::find($id);
        if (!$nota) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }
        return response()->json($nota);
    }

    // Crear una nueva nota
    public function store(Request $request)
    {
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'oportunidad_id' => 'required|exists:oportunidades,id',
            'contenido' => 'required',
            'usuario_id' => 'required|exists:usuarios,id',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $nota = new Nota();
        $nota->cliente_id = $request->input('cliente_id');
        $nota->oportunidad_id = $request->input('oportunidad_id');
        $nota->contenido = $request->input('contenido');
        $nota->usuario_id = $request->input('usuario_id');
        $nota->fecha_hora = $request->input('fecha_hora');
        $nota->save();

        return response()->json(['message' => 'Nota creada con éxito'], 201);
    }

    // Actualizar una nota existente
    public function update(Request $request, $id)
    {
        $nota = Nota::find($id);
        if (!$nota) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }

        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'oportunidad_id' => 'required|exists:oportunidades,id',
            'contenido' => 'required',
            'usuario_id' => 'required|exists:usuarios,id',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $nota->cliente_id = $request->input('cliente_id');
        $nota->oportunidad_id = $request->input('oportunidad_id');
        $nota->contenido = $request->input('contenido');
        $nota->usuario_id = $request->input('usuario_id');
        $nota->fecha_hora = $request->input('fecha_hora');
        $nota->save();

        return response()->json(['message' => 'Nota actualizada con éxito']);
    }

    // Eliminar una nota existente
    public function destroy($id)
    {
        $nota = Nota::find($id);
        if (!$nota) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        }
        $nota->delete();

        return response()->json(['message' => 'Nota eliminada con éxito']);
    }
}
