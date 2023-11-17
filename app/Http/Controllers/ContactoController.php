<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function index()
    {
        $contactos = Contacto::all();
        return response()->json($contactos);
    }

    // Mostrar un contacto específico por su ID
    public function show($id)
    {
        $contacto = Contacto::find($id);
        if (!$contacto) {
            return response()->json(['message' => 'Contacto no encontrado'], 404);
        }
        return response()->json($contacto);
    }

    // Crear un nuevo contacto
    public function store(Request $request)
    {
        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'telefono' => 'required|max:20',
        ]);

        $contacto = new Contacto();
        $contacto->cliente_id = $request->input('cliente_id');
        $contacto->nombre = $request->input('nombre');
        $contacto->email = $request->input('email');
        $contacto->telefono = $request->input('telefono');
        $contacto->save();

        return response()->json(['message' => 'Contacto creado con éxito'], 201);
    }

    // Actualizar un contacto existente
    public function update(Request $request, $id)
    {
        $contacto = Contacto::find($id);
        if (!$contacto) {
            return response()->json(['message' => 'Contacto no encontrado'], 404);
        }

        $this->validate($request, [
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|max:100',
            'email' => 'required|email',
            'telefono' => 'required|max:20',
        ]);

        $contacto->cliente_id = $request->input('cliente_id');
        $contacto->nombre = $request->input('nombre');
        $contacto->email = $request->input('email');
        $contacto->telefono = $request->input('telefono');
        $contacto->save();

        return response()->json(['message' => 'Contacto actualizado con éxito']);
    }

    // Eliminar un contacto existente
    public function destroy($id)
    {
        $contacto = Contacto::find($id);
        if (!$contacto) {
            return response()->json(['message' => 'Contacto no encontrado'], 404);
        }
        $contacto->delete();

        return response()->json(['message' => 'Contacto eliminado con éxito']);
    }
}
