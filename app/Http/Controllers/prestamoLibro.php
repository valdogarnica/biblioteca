<?php

namespace App\Http\Controllers;

use App\Models\prestamos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
 
class prestamoLibro extends Controller
{
    //ESTE NO SIRVE, SI PERO DE FORMA STATICA, VETE A INDEX CONTROLER
    function prestamo_libro($id_libro, Request $request){
        //$id_libro = $request->id_libro;
        $fechaLibro = $this->obtener_fecha_libro($id_libro);
        $fecha_hoy = $this->obtener_fecha_realiza_prestamo();
        $fecha_actual = Carbon::parse($fecha_hoy)->format('Ymd');

        //dd($fecha_actual, $fechaLibro);
        //return view('prestamo_libro');
        if($fecha_actual > $fechaLibro){
            try{
                $prestamos = new prestamos();
                $prestamos->fecha_realiza_prestamo = $fecha_hoy;
                $prestamos->hora_limite_recoger_libro = $request->hora;
                $prestamos->matricula = $request->user;
                $prestamos->save();
                $prestamos->libros()->sync([$id_libro]);
                return response()->json(['success' => true, 'message' => 'El libro reservado correctamente'], 200);

            }catch(\Exception $e){
                return response()->json(['success' => false, 'message' => 'error al reservar el libro'], 200);
            }
        }
        return response()->json(['success' => false, 'message' => 'Error, el Libro No se puede Prestar por la fecha de reserva es menor'], 200);
        
    } 

    function obtener_fecha_libro($id_libro){
        $fecha = DB::table('libros')
        ->where('id_libro', $id_libro)
        ->value('fecha');  // 'value' obtiene un solo valor de la columna especificada
    
        $fechaFormateada = Carbon::parse($fecha)->format('Ymd');
        return $fechaFormateada;
    }

    function obtener_fecha_realiza_prestamo(){
        $fecha_actual = date('Y-m-d');
        return $fecha_actual;
    }


    function cancelar(Request $request){
        $prestamo = prestamos::find($request->id_prestamo);
        dd($prestamo);
    }
}

