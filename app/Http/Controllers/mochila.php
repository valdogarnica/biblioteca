<?php
 
namespace App\Http\Controllers;

use App\Models\configuracion;
use App\Models\prestamos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mochila extends Controller
{
    public function mochila($usuario){
        //esta funcion es para mostrar los libros que estan en proceso y tienen el tiempo para ir a recogerlos 
        $mochila = $this->librosMochila($usuario);
        //esta funcion obtiene lo libros que hemos recogi fisicamente, pero sabemos que los tienes el usuaurio
        $librosObtenidos = $this->librosObtenidos($usuario);
        //tabla configuracion
        $configuracion = $this->fechaConfiguracion();
        // Iterar sobre los libros obtenidos y agregar la fecha estimada de devolución
        foreach ($librosObtenidos as $libro) {
            $libro->fecha_estimada_entrega = $this->fechaEstimada($usuario, $configuracion, $libro->fecha_realiza_prestamo);
        }
        //$fechaEstimada = $this->fechaEstimada($usuario, $configuracion);
        return view('mochila', compact('mochila', 'librosObtenidos'));
    } 

    public function librosMochila($usuario){
        $prestamos = DB::table('prestamos as p')
        ->join('users as u', 'p.matricula', '=', 'u.username')
        ->join('relacion_prestamo_libro as rpl', 'p.id_prestamo', '=', 'rpl.id_prestamo')
        ->join('libros as l', 'rpl.id_libro', '=', 'l.id_libro')
        ->select(
            'p.fecha_realiza_prestamo_completa',
            'p.recogio_libro',
            'p.id_prestamo',
            'p.estado_prestamo',
            'p.hora_limite_recoger_libro',
            'u.username',
            'u.name',
            'l.nombre_libro',
            'l.imagen',
            'l.isbn'
        )
        ->where('p.matricula', '=', $usuario)
        ->where('p.estado_prestamo', '=', 'En proceso')
        ->get();

        return $prestamos;
    }

    public function cancelarReserva($idPrestamo){
        $prestamo = prestamos::find($idPrestamo);
    
        if ($prestamo) {
            // Actualizar el estado del préstamo a "Cancelado"
            $prestamo->estado_prestamo = 'Cancelado';
            $prestamo->save();

            // Aquí puedes agregar cualquier otra lógica, como mostrar un mensaje o redirigir
            return response()->json(['message' => 'Reserva cancelada exitosamente.']);
        }

        return response()->json(['message' => 'Préstamo no encontrado.'], 404);
    }

    public function librosObtenidos($usuario){
        $librosObtenidos = DB::table('prestamos as p')
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
        ->where('p.matricula', '=', $usuario)
        ->where('p.estado_prestamo', '=', 'Libro Prestado')
        ->where('p.recogio_libro', '=', 1)
        ->get();

        return $librosObtenidos;
    }

    public function fechaConfiguracion(){
        $configuracion = configuracion::select('dias_prestamo_libro', 'hora_devolucion_libro')->first();
        return $configuracion;
    }

    public function fechaEstimada($usuario, $configuracion, $fechaRealizaPrestamo){
        /**$prestamos = DB::table('prestamos as p')
        ->join('users as u', 'p.matricula', '=', 'u.username')
        ->select(
            'p.fecha_realiza_prestamo',
        )
        ->where('p.matricula', '=', $usuario)
        ->where('p.estado_prestamo', '=', 'Libro Prestado')
        ->where('p.recogio_libro', '=', 1)
        ->get();

        $fechaRealizePrestamo = $prestamos->fecha_realiza_prestamo;
        $diasPrestamoLibro = $configuracion->dias_prestamo_libro;

        // Convierte la fecha a un objeto Carbon
        $fecha = Carbon::parse($fechaRealizePrestamo);

        // Suma los días a la fecha
        $fechaEstimadaDevolucion = $fecha->addDays($diasPrestamoLibro);

        return $fechaEstimadaDevolucion;*/ // Ejemplo de salida: 2024-10-20
        // Convertir la fecha a un objeto Carbon
        $fecha = Carbon::parse($fechaRealizaPrestamo);

        // Sumar los días a la fecha
        $fechaEstimadaDevolucion = $fecha->addDays($configuracion->dias_prestamo_libro);
        // Sumar las horas a la fecha
        $fechaEstimadaDevolucion->setTime($configuracion->hora_devolucion_libro, 0, 0);

        return $fechaEstimadaDevolucion->format('d-m-Y H:i:s'); // Devuelve la fecha formateada
    }
}
