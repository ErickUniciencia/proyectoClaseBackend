<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    // Mostrar un producto específico por su ID
    public function show($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'existencias' => 'required|integer',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->existencias = $request->input('existencias');
        $producto->save();

        return response()->json(['message' => 'Producto creado con éxito'], 201);
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $this->validate($request, [
            'nombre' => 'required|max:100',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'existencias' => 'required|integer',
        ]);

        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->existencias = $request->input('existencias');
        $producto->save();

        return response()->json(['message' => 'Producto actualizado con éxito']);
    }

    // Eliminar un producto existente
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $producto->delete();

        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
