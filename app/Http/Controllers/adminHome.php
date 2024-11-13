<?php

namespace App\Http\Controllers;

use App\Models\configuracion;
use App\Models\prestamos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class adminHome extends Controller
{
    public function show(){
        $prestamos = $this->prestamos();
        return view('home.admin', compact('prestamos'));
    }
    public function recogerLibro($id){
        $prestamo = prestamos::find($id);

        if ($prestamo) {
            $prestamo->recogio_libro = true; // Cambiar el valor del campo recogio_libro a true
            $prestamo->estado_prestamo = 'Libro Prestado'; // También puedes actualizar el estado si lo deseas
            $prestamo->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Prestamo no encontrado'], 404);
    }

    public function prestamos(){
        $prestamos = DB::table('prestamos')
        ->join('users', 'prestamos.matricula', '=', 'users.username')
        ->join('relacion_prestamo_libro', 'prestamos.id_prestamo', '=', 'relacion_prestamo_libro.id_prestamo')
        ->join('libros', 'relacion_prestamo_libro.id_libro', '=', 'libros.id_libro')
        ->where('prestamos.recogio_libro', 0)
        ->where('prestamos.estado_prestamo', 'En proceso')
        ->select(
            'prestamos.fecha_realiza_prestamo_completa', 
            'prestamos.recogio_libro', 
            'prestamos.id_prestamo', 
            'prestamos.estado_prestamo', 
            'users.username', 
            'users.name',
            'libros.nombre_libro',
            'libros.imagen',
            'libros.isbn'
        )
        ->get();

        return $prestamos;

    }



    


    public function regresarLibro($idPrestamo){
        $prestamo = prestamos::find($idPrestamo);
        $fecha_actual = $this->obtener_fecha_acual();
        if($prestamo){
            $prestamo->devolvio_libro = true;
            $prestamo->estado_prestamo = 'Completado';
            $prestamo->fecha_devolucion = $fecha_actual;
            $prestamo->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Prestamo no encontrado'], 404);
    }

    function obtener_fecha_acual(){
        $fecha_actual = date('Y-m-d H:i:s'); 
        return $fecha_actual;
    }
}
