<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleMovimientoProducto;
use Illuminate\Support\Facades\Validator;
class DetalleMovimientoProductoController extends Controller
{
    public function index()
    {
        $detalles = DetalleMovimientoProducto::all();
        return response()->json($detalles);
    }

    // Mostrar un detalle de movimiento de producto específico por su ID
    public function show($id)
    {
        $detalle = DetalleMovimientoProducto::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle de movimiento de producto no encontrado'], 404);
        }
        return response()->json($detalle);
    }

    // Crear un nuevo detalle de movimiento de producto
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'producto_id' => 'required|exists:productos,id',
            'tipo_movimiento' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $detalle = new DetalleMovimientoProducto();
        $detalle->producto_id = $request->input('producto_id');
        $detalle->tipo_movimiento = $request->input('tipo_movimiento');
        $detalle->cantidad = $request->input('cantidad');
        $detalle->fecha_hora = $request->input('fecha_hora');
        $detalle->save();

        return response()->json(['message' => 'Detalle de movimiento de producto creado con éxito'], 201);
    }

    // Actualizar un detalle de movimiento de producto existente
    public function update(Request $request, $id)
    {
        $detalle = DetalleMovimientoProducto::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle de movimiento de producto no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'producto_id' => 'required|exists:productos,id',
            'tipo_movimiento' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $detalle->producto_id = $request->input('producto_id');
        $detalle->tipo_movimiento = $request->input('tipo_movimiento');
        $detalle->cantidad = $request->input('cantidad');
        $detalle->fecha_hora = $request->input('fecha_hora');
        $detalle->save();

        return response()->json(['message' => 'Detalle de movimiento de producto actualizado con éxito']);
    }

    // Eliminar un detalle de movimiento de producto existente
    public function destroy($id)
    {
        $detalle = DetalleMovimientoProducto::find($id);
        if (!$detalle) {
            return response()->json(['message' => 'Detalle de movimiento de producto no encontrado'], 404);
        }
        $detalle->delete();

        return response()->json(['message' => 'Detalle de movimiento de producto eliminado con éxito']);
    }
}
