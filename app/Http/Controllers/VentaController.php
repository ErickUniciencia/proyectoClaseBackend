<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return response()->json($ventas);
    }

    // Mostrar una venta específica por su ID
    public function show($id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }
        return response()->json($venta);
    }

    // Crear una nueva venta
    public function store(Request $request)
    {
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $venta = new Venta();
        $venta->cliente_id = $request->input('cliente_id');
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->save();

        return response()->json(['message' => 'Venta creada con éxito'], 201);
    }

    // Actualizar una venta existente
    public function update(Request $request, $id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }

        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $venta->cliente_id = $request->input('cliente_id');
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->save();

        return response()->json(['message' => 'Venta actualizada con éxito']);
    }

    // Eliminar una venta existente
    public function destroy($id)
    {
        $venta = Venta::find($id);
        if (!$venta) {
            return response()->json(['message' => 'Venta no encontrada'], 404);
        }
        $venta->delete();

        return response()->json(['message' => 'Venta eliminada con éxito']);
    }
}
