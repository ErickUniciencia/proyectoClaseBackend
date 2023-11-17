<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oportunidad;

class OportunidadController extends Controller
{
    public function index()
    {
        $oportunidades = Oportunidad::all();
        return response()->json($oportunidades);
    }

    // Mostrar una oportunidad específica por su ID
    public function show($id)
    {
        $oportunidad = Oportunidad::find($id);
        if (!$oportunidad) {
            return response()->json(['message' => 'Oportunidad no encontrada'], 404);
        }
        return response()->json($oportunidad);
    }

    // Crear una nueva oportunidad
    public function store(Request $request)
    {
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|max:100',
            'estado' => 'required|in:abierto,cerrado,perdido',
            'monto' => 'required|numeric',
            'fecha_creacion' => 'required|date',
        ]);

        $oportunidad = new Oportunidad();
        $oportunidad->cliente_id = $request->input('cliente_id');
        $oportunidad->nombre = $request->input('nombre');
        $oportunidad->estado = $request->input('estado');
        $oportunidad->monto = $request->input('monto');
        $oportunidad->fecha_creacion = $request->input('fecha_creacion');
        $oportunidad->save();

        return response()->json(['message' => 'Oportunidad creada con éxito'], 201);
    }

    // Actualizar una oportunidad existente
    public function update(Request $request, $id)
    {
        $oportunidad = Oportunidad::find($id);
        if (!$oportunidad) {
            return response()->json(['message' => 'Oportunidad no encontrada'], 404);
        }

        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|max:100',
            'estado' => 'required|in:abierto,cerrado,perdido',
            'monto' => 'required|numeric',
            'fecha_creacion' => 'required|date',
        ]);

        $oportunidad->cliente_id = $request->input('cliente_id');
        $oportunidad->nombre = $request->input('nombre');
        $oportunidad->estado = $request->input('estado');
        $oportunidad->monto = $request->input('monto');
        $oportunidad->fecha_creacion = $request->input('fecha_creacion');
        $oportunidad->save();

        return response()->json(['message' => 'Oportunidad actualizada con éxito']);
    }

    // Eliminar una oportunidad existente
    public function destroy($id)
    {
        $oportunidad = Oportunidad::find($id);
        if (!$oportunidad) {
            return response()->json(['message' => 'Oportunidad no encontrada'], 404);
        }
        $oportunidad->delete();

        return response()->json(['message' => 'Oportunidad eliminada con éxito']);
    }
}
