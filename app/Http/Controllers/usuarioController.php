<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class usuarioController extends Controller
{
    public function indexU() {
        
        $usuario = Usuario::all();
 
        if ($usuario->isEmpty()) {
         $data = [
             'message'=>'No hay usuarios registrados',
             'status' => 200
     ];
         return response()->json($data,200);
 
        }
        
          return response()->json($usuario, 200);
         
     }
 
     public function storeU(Request $request){
         $validator = Validator::make($request->all(),[
         'nombreU' => 'required',
         'apellidoU' => 'required',
         'sobrenombreU' => 'required',
         'correoU'=> 'required|email',
         'contraseñaU'=> 'required|max:8|min:8',
         'direccionU' => 'required'
 
 
          ]);
 
          if ($validator->fails()) {
             $data = [
                 'message'=>'Error en la validacion de datos',
                 'errors' => $validator->errors(),
                 'status' => 400
         ];
             return response()->json($data,400);
          }
 
          $usuario = Usuario::create([
 
             'nombreU' => $request->nombreU,
             'apellidoU' => $request->apellidoU,
             'sobrenombreU' => $request->sobrenombreU,
             'correoU'=> $request->correoU,
             'contraseñaU'=> $request->contraseñaU,
             'direccionU' => $request->direccionU,
 
          ]);
 
          if (!$usuario) {
             $data = [
                 'message'=>'Error al registrar usuario',
                 'status' => 500
         ];
             return response()->json($data,500);         
         }
 
         $data = [
             'message'=>'Usuario registrado correctamente',
             'usuario' => $usuario,
             'status' => 201
         ];
         return response()->json($data,201);         
 
 
     }
 
     public function showU($id){
         $usuario = Usuario::find($id);
         if (!$usuario) {
             $data = [
                 'message'=>'Usuario no encontrado',
                 'status' => 404
         ];
             return response()->json($data,404);         
         }
 
         $data = [
 
             'usuario' => $usuario,
             'status' => 200
         ];
         return response()->json($data,200); 
         
     }
 
     public function destroyU($id){
         $usuario = Usuario::find($id);
         if (!$usuario) {
             $data = [
                 'message'=>'Usuario no encontrado',
                 'status' => 404
         ];
             return response()->json($data,404);         
         }
 
         $usuario->delete();
         $data = [
             'message'=>'Usuario eliminado',
             'status' => 200
     ];
         return response()->json($data,200);   
     }
 
     public function updateU(Request $request,$id){
         $usuario = Usuario::find($id);
         if (!$usuario) {
             $data = [
                 'message'=>'Usuario no encontrado',
                 'status' => 404
         ];
             return response()->json($data,404);         
         }
 
         $validator = Validator::make($request->all(),[
            'nombreU' => 'required',
            'apellidoU' => 'required',
            'sobrenombreU' => 'required',
            'correoU'=> 'required|email',
            'contraseñaU'=> 'required|max:8|min:8',
            'direccionU' => 'required'
     
     
              ]);
     
              if ($validator->fails()) {
                 $data = [
                     'message'=>'Error en la validacion de datos',
                     'errors' => $validator->errors(),
                     'status' => 400
             ];
                 return response()->json($data,400);
              }
 
              $usuario->nombreU = $request->nombreU;
              $usuario->apellidoU = $request->apellidoU;
              $usuario->sobrenombreU = $request->sobrenombreU;
              $usuario->correoU = $request->correoU;
              $usuario->contraseñaU = $request->contraseñaU;
              $usuario->direccionU = $request->direccionU;
 
              $usuario->save();
 
              $data = [
                 'message'=>'Usuario actualizado',
                 'usuario' => $usuario,
                 'status' => 200
              ];
              return response()->json($data,200);
 
     }
 
     public function updatePartialU(Request $request,$id){
         $usuario = Usuario::find($id);
         if (!$usuario) {
             $data = [
                 'message'=>'Usuario no encontrado',
                 'status' => 404
         ];
             return response()->json($data,404);         
         }
 
         $validator = Validator::make($request->all(),[
            'nombreU' => 'max:255',
            'apellidoU' => 'max:255',
            'sobrenombreU' => 'max:255',
            'correoU'=> 'max:255|email',
            'contraseñaU'=> 'max:8|min:8',
            'direccionU' => 'max:255'
     
     
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
                 $usuario->nombre = $request->nombre;
             }
 
             if ($request->has('precio')) {
                 $usuario->precio = $request->precio;
             }
 
             if ($request->has('descripcion')) {
                 $usuario->descripcion = $request->descripcion;
             }
 
             if ($request->has('tipo')) {
                 $usuario->tipo = $request->tipo;
             }
 
             if ($request->has('imagen')) {
                 $usuario->imagen = $request->imagen;
             }
 
             if ($request->has('estado')) {
                 $usuario->estado = $request->estado;
             }
 
              $usuario->save();
 
              $data = [
                 'message'=>'Usuario actualizado',
                 'usuario' => $usuario,
                 'status' => 200
              ];
              return response()->json($data,200);
 
     }
}
