<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::all();
        return response()->json($pagos);
    }

    // Mostrar un pago específico por su ID
    public function show($id)
    {
        $pago = Pago::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago no encontrado'], 404);
        }
        return response()->json($pago);
    }

    // Crear un nuevo pago
    public function store(Request $request)
    {
        $this->validate($request, [
            'venta_id' => 'required|exists:ventas,id',
            'metodo_pago' => 'required|string|max:50',
            'monto' => 'required|numeric',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $pago = new Pago();
        $pago->venta_id = $request->input('venta_id');
        $pago->metodo_pago = $request->input('metodo_pago');
        $pago->monto = $request->input('monto');
        $pago->fecha_hora = $request->input('fecha_hora');
        $pago->save();

        return response()->json(['message' => 'Pago creado con éxito'], 201);
    }

    // Actualizar un pago existente
    public function update(Request $request, $id)
    {
        $pago = Pago::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago no encontrado'], 404);
        }

        $this->validate($request, [
            'venta_id' => 'required|exists:ventas,id',
            'metodo_pago' => 'required|string|max:50',
            'monto' => 'required|numeric',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $pago->venta_id = $request->input('venta_id');
        $pago->metodo_pago = $request->input('metodo_pago');
        $pago->monto = $request->input('monto');
        $pago->fecha_hora = $request->input('fecha_hora');
        $pago->save();

        return response()->json(['message' => 'Pago actualizado con éxito']);
    }

    // Eliminar un pago existente
    public function destroy($id)
    {
        $pago = Pago::find($id);
        if (!$pago) {
            return response()->json(['message' => 'Pago no encontrado'], 404);
        }
        $pago->delete();

        return response()->json(['message' => 'Pago eliminado con éxito']);
    }
}
