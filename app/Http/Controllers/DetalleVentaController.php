<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $detallesVentas = DetalleVenta::all();
        return response()->json($detallesVentas);
    }

    // Mostrar un detalle de venta específico por su ID
    public function show($id)
    {
        $detalleVenta = DetalleVenta::find($id);
        if (!$detalleVenta) {
            return response()->json(['message' => 'Detalle de venta no encontrado'], 404);
        }
        return response()->json($detalleVenta);
    }

    // Crear un nuevo detalle de venta
    public function store(Request $request)
    {
        $this->validate($request, [
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer',
            'precio_unitario' => 'required|numeric',
        ]);

        $detalleVenta = new DetalleVenta();
        $detalleVenta->venta_id = $request->input('venta_id');
        $detalleVenta->producto_id = $request->input('producto_id');
        $detalleVenta->cantidad = $request->input('cantidad');
        $detalleVenta->precio_unitario = $request->input('precio_unitario');
        $detalleVenta->save();

        return response()->json(['message' => 'Detalle de venta creado con éxito'], 201);
    }

    // Actualizar un detalle de venta existente
    public function update(Request $request, $id)
    {
        $detalleVenta = DetalleVenta::find($id);
        if (!$detalleVenta) {
            return response()->json(['message' => 'Detalle de venta no encontrado'], 404);
        }

        $this->validate($request, [
            'venta_id' => 'required|exists:ventas,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer',
            'precio_unitario' => 'required|numeric',
        ]);

        $detalleVenta->venta_id = $request->input('venta_id');
        $detalleVenta->producto_id = $request->input('producto_id');
        $detalleVenta->cantidad = $request->input('cantidad');
        $detalleVenta->precio_unitario = $request->input('precio_unitario');
        $detalleVenta->save();

        return response()->json(['message' => 'Detalle de venta actualizado con éxito']);
    }

    // Eliminar un detalle de venta existente
    public function destroy($id)
    {
        $detalleVenta = DetalleVenta::find($id);
        if (!$detalleVenta) {
            return response()->json(['message' => 'Detalle de venta no encontrado'], 404);
        }
        $detalleVenta->delete();

        return response()->json(['message' => 'Detalle de venta eliminado con éxito']);
    }
}
