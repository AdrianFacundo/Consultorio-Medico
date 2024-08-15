<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $productos = Producto::all();
            return view('secretaria.productos', compact('productos'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $productos = Producto::all();
            return view('doctor.productos', compact('productos'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'precio' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $defaultImage = 'images/Noimg.png';
        $imagePath = $defaultImage;

        if ($request->hasFile('imagen')) {
            $filename = $request->file('imagen')->getClientOriginalName();
            
            // Define la ruta completa donde se guardará la imagen en la carpeta public/images
            $destinationPath = public_path('images');
            $request->file('imagen')->move($destinationPath, $filename);
            
            // Genera la ruta de la imagen para usarla en tu aplicación
            $imagePath = 'images/' . $filename;
        
            // Comprueba si el archivo realmente se subió y existe en el sistema de archivos
            if (!file_exists(public_path($imagePath))) {
                $imagePath = $defaultImage;
            }
        }
        

        Producto::create([
            'producto' => $request->producto,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
            'muestra' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Producto agregado con éxito.');
    }



    public function destroy($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
            return redirect()->route('productos.create')->with('success', 'Producto eliminado exitosamente.');
        }
        return redirect()->route('productos.create')->with('error', 'Producto no encontrado.');
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->producto = $request->producto;
        $producto->cantidad = $request->cantidad;
        $producto->precio = $request->precio;

        if ($request->hasFile('imagen')) {
            $filename = $request->file('imagen')->getClientOriginalName();
            
            // Define la ruta completa donde se guardará la imagen en la carpeta public/images
            $destinationPath = public_path('images');
            $request->file('imagen')->move($destinationPath, $filename);
            
            // Genera la ruta de la imagen para usarla en tu aplicación
            $imagePath = 'images/' . $filename;
            
            // Actualiza la propiedad muestra del objeto producto con la ruta de la imagen
            $producto->muestra = $imagePath;
        }
        

        $producto->save();

        return redirect()->back()->with('success', 'Producto actualizado correctamente.');
    }

}
