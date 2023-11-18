<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    // Mostrar un usuario específico por su ID
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'email' => 'required|email|unique:usuarios',
            'contrasena' => 'required|min:6',
            'rol' => 'required|in:administrador,vendedor',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $usuario = new Usuario();
        $usuario->nombre = $request->input('nombre');
        $usuario->email = $request->input('email');
        $usuario->contrasena = bcrypt($request->input('contrasena'));
        $usuario->rol = $request->input('rol');
        $usuario->save();

        return response()->json(['message' => 'Usuario creado con éxito'], 201);
    }

    // Actualizar un usuario existente
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
     
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'contrasena' => 'min:6',
            'rol' => 'required|in:administrador,vendedor',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $usuario->nombre = $request->input('nombre');
        $usuario->email = $request->input('email');

        // Actualizar la contrasena si se proporciona en la solicitud
        if ($request->has('contrasena')) {
            $usuario->contrasena = bcrypt($request->input('contrasena'));
        }

        $usuario->rol = $request->input('rol');
        $usuario->save();

        return response()->json(['message' => 'Usuario actualizado con éxito']);
    }

    // Eliminar un usuario existente
    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }
}
