<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    // Mostrar un cliente específico por su ID
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($cliente);
    }

    // Crear un nuevo cliente
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'telefono' => 'required|max:20',
            'direccion' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cliente = new Cliente();
        $cliente->nombre = $request->input('nombre');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->save();

        return response()->json(['message' => 'Cliente creado con éxito'], 201);
    }

    // Actualizar un cliente existente
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'telefono' => 'required|max:20',
            'direccion' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cliente->nombre = $request->input('nombre');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->save();

        return response()->json(['message' => 'Cliente actualizado con éxito']);
    }

    // Eliminar un cliente existente
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $cliente->delete();

        return response()->json(['message' => 'Cliente eliminado con éxito']);
    }
}
