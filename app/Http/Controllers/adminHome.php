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
        $librosPrestados = $this->librosPrestados();
        $configuracion = $this->fechaConfiguracion();
        foreach ($librosPrestados as $libro) {
            $libro->fecha_estimada_entrega = $this->fechaEstimada($configuracion, $libro->fecha_realiza_prestamo);
        }
        return view('home.admin', compact('prestamos', 'librosPrestados'));
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

    public function librosPrestados(){
        $librosPrestados = DB::table('prestamos as p')
        ->join('users as u', 'p.matricula', '=', 'u.username')
        ->join('relacion_prestamo_libro as rpl', 'p.id_prestamo', '=', 'rpl.id_prestamo')
        ->join('libros as l', 'rpl.id_libro', '=', 'l.id_libro')
        ->select(
            'p.fecha_realiza_prestamo_completa',
            'p.fecha_realiza_prestamo',
            'p.recogio_libro',
            'p.id_prestamo',
            'p.estado_prestamo',
            'p.hora_limite_recoger_libro',
            'u.username',
            'u.name',
            'l.nombre_libro',
            'l.descripcion',
            'l.imagen',
            'l.isbn'
        )
        ->where('p.estado_prestamo', '=', 'Libro Prestado')
        ->where('p.recogio_libro', '=', 1)
        ->where('p.devolvio_libro', '=', 0)
        ->get();

        return $librosPrestados;
    }

    public function fechaConfiguracion(){
        $configuracion = configuracion::select('dias_prestamo_libro', 'hora_devolucion_libro')->first();
        return $configuracion;
    }

    public function fechaEstimada($configuracion, $fechaRealizaPrestamo){
        // Convertir la fecha a un objeto Carbon
        $fecha = Carbon::parse($fechaRealizaPrestamo);

        // Sumar los días a la fecha
        $fechaEstimadaDevolucion = $fecha->addDays($configuracion->dias_prestamo_libro);
        // Sumar las horas a la fecha
        $fechaEstimadaDevolucion->setTime($configuracion->hora_devolucion_libro, 0, 0);

        return $fechaEstimadaDevolucion->format('d-m-Y H:i:s'); // Devuelve la fecha formateada
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
