<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use Illuminate\Support\Facades\Validator;
class ActividadController extends Controller
{
    public function index()
    {
        $actividades = Actividad::all();
        return response()->json($actividades);
    }

    // Mostrar una actividad específica por su ID
    public function show($id)
    {
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }
        return response()->json($actividad);
    }

    // Crear una nueva actividad
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|in:llamada,reunión,correo,otro',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
            'descripcion' => 'required',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $actividad = new Actividad();
        $actividad->cliente_id = $request->input('cliente_id');
        $actividad->tipo = $request->input('tipo');
        $actividad->fecha_hora = $request->input('fecha_hora');
        $actividad->descripcion = $request->input('descripcion');
        $actividad->usuario_id = $request->input('usuario_id');
        $actividad->save();

        return response()->json(['message' => 'Actividad creada con éxito'], 201);
    }

    // Actualizar una actividad existente
    public function update(Request $request, $id)
    {
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|in:llamada,reunión,correo,otro',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
            'descripcion' => 'required',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $actividad->cliente_id = $request->input('cliente_id');
        $actividad->tipo = $request->input('tipo');
        $actividad->fecha_hora = $request->input('fecha_hora');
        $actividad->descripcion = $request->input('descripcion');
        $actividad->usuario_id = $request->input('usuario_id');
        $actividad->save();

        return response()->json(['message' => 'Actividad actualizada con éxito']);
    }

    // Eliminar una actividad existente
    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        if (!$actividad) {
            return response()->json(['message' => 'Actividad no encontrada'], 404);
        }
        $actividad->delete();

        return response()->json(['message' => 'Actividad eliminada con éxito']);
    }
}
