<?php

namespace App\Http\Controllers;

use App\Models\configuracion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class adminPrestamos extends Controller
{
    function showPrestamos(){
        $librosPrestados = $this->librosPrestados();
        $configuracion = $this->fechaConfiguracion();
        foreach ($librosPrestados as $libro) {
            $libro->fecha_estimada_entrega = $this->fechaEstimada($configuracion, $libro->fecha_realiza_prestamo);
            // Calcular adeudo y días de retraso
            $retrasoData = $this->calcularAdeudo($libro, $configuracion);
            $libro->dias_retraso = $retrasoData['diasRetraso'];
            $libro->adeudo = $retrasoData['adeudo'];
        } 
        return view('adminPrestamos', compact('librosPrestados'));
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

    public function calcularAdeudo($libro, $configuracion){
        $fechaEstimadaEntrega = Carbon::parse($libro->fecha_estimada_entrega);
        $fechaActual = Carbon::now();

        if ($fechaActual->greaterThan($fechaEstimadaEntrega)) {
            // Calcular los días de retraso
            $diasRetraso = $fechaActual->diffInDays($fechaEstimadaEntrega);

            // Calcular el adeudo
            $cantidadPorDiaAtraso = configuracion::value('cantidad_por_dia_atradaso');

            $adeudo = $diasRetraso * $cantidadPorDiaAtraso;
           
            return [
                'diasRetraso' => $diasRetraso,
                'adeudo' => $adeudo
            ];
        }

        return [
            'diasRetraso' => 0,
            'adeudo' => 0
        ];
    }



}
