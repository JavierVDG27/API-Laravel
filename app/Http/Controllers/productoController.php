<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class productoController extends Controller
{
    public function index() {
        
       $producto = Producto::all();

       if ($producto->isEmpty()) {
        $data = [
            'message'=>'No hay productos registrados',
            'status' => 200
    ];
        return response()->json($data,200);

       }
       
         return response()->json($producto, 200);
        
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
        'nombre' => 'required',
        'precio' => 'required',
        'descripcion' => 'required',
        'tipo'=> 'required',
        'imagen'=> 'required',
        'estado' => 'required'


         ]);

         if ($validator->fails()) {
            $data = [
                'message'=>'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
        ];
            return response()->json($data,400);
         }

         $producto = Producto::create([

            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'tipo'=> $request->tipo,
            'imagen'=> $request->imagen,
            'estado' => $request->estado,

         ]);

         if (!$producto) {
            $data = [
                'message'=>'Error al registrar producto',
                'status' => 500
        ];
            return response()->json($data,500);         
        }

        $data = [
            'message'=>'Producto registrado correctamente',
            'producto' => $producto,
            'status' => 201
        ];
        return response()->json($data,201);         


    }

    public function show($id){
        $producto = Producto::find($id);
        if (!$producto) {
            $data = [
                'message'=>'Producto no encontrado',
                'status' => 404
        ];
            return response()->json($data,404);         
        }

        $data = [

            'producto' => $producto,
            'status' => 200
        ];
        return response()->json($data,200); 
        
    }

    public function destroy($id){
        $producto = Producto::find($id);
        if (!$producto) {
            $data = [
                'message'=>'Producto no encontrado',
                'status' => 404
        ];
            return response()->json($data,404);         
        }

        $producto->delete();
        $data = [
            'message'=>'Producto eliminado',
            'status' => 200
    ];
        return response()->json($data,200);   
    }

    public function update(Request $request,$id){
        $producto = Producto::find($id);
        if (!$producto) {
            $data = [
                'message'=>'Producto no encontrado',
                'status' => 404
        ];
            return response()->json($data,404);         
        }

        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
            'tipo'=> 'required',
            'imagen'=> 'required',
            'estado' => 'required'
    
    
             ]);
    
             if ($validator->fails()) {
                $data = [
                    'message'=>'Error en la validacion de datos',
                    'errors' => $validator->errors(),
                    'status' => 400
            ];
                return response()->json($data,400);
             }

             $producto->nombre = $request->nombre;
             $producto->precio = $request->precio;
             $producto->descripcion = $request->descripcion;
             $producto->tipo = $request->tipo;
             $producto->imagen = $request->imagen;
             $producto->estado = $request->estado;

             $producto->save();

             $data = [
                'message'=>'Producto actualizado',
                'producto' => $producto,
                'status' => 200
             ];
             return response()->json($data,200);

    }

    public function updatePartial(Request $request,$id){
        $producto = Producto::find($id);
        if (!$producto) {
            $data = [
                'message'=>'Producto no encontrado',
                'status' => 404
        ];
            return response()->json($data,404);         
        }

        $validator = Validator::make($request->all(),[
            'nombre' => 'max:255',
            'precio' => 'max:255',
            'descripcion' => 'max:255',
            'tipo'=> 'max:255',
            'imagen'=> 'max:255',
            'estado' => 'max:255'
    
    
             ]);
    
             if ($validator->fails()) {
                $data = [
                    'message'=>'Error en la validacion de datos',
                    'errors' => $validator->errors(),
                    'status' => 400
            ];
                return response()->json($data,400);
             }

             if ($request->has('nombre')) {
                $producto->nombre = $request->nombre;
            }

            if ($request->has('precio')) {
                $producto->precio = $request->precio;
            }

            if ($request->has('descripcion')) {
                $producto->descripcion = $request->descripcion;
            }

            if ($request->has('tipo')) {
                $producto->tipo = $request->tipo;
            }

            if ($request->has('imagen')) {
                $producto->imagen = $request->imagen;
            }

            if ($request->has('estado')) {
                $producto->estado = $request->estado;
            }

             $producto->save();

             $data = [
                'message'=>'Producto actualizado',
                'producto' => $producto,
                'status' => 200
             ];
             return response()->json($data,200);

    }

}
