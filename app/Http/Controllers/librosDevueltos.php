<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class librosDevueltos extends Controller
{
    function show(){
        $librosDevueltos = $this->librosDevueltos();
        return view('libros_devueltos', compact('librosDevueltos'));

    }

    public function librosDevueltos(){
        $librosPrestados = DB::table('prestamos as p')
        ->join('users as u', 'p.matricula', '=', 'u.username')
        ->join('relacion_prestamo_libro as rpl', 'p.id_prestamo', '=', 'rpl.id_prestamo')
        ->join('libros as l', 'rpl.id_libro', '=', 'l.id_libro')
        ->select(
            'p.fecha_realiza_prestamo_completa',
            'p.fecha_realiza_prestamo',
            'p.fecha_devolucion',
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
        ->where('p.estado_prestamo', '=', 'Completado')
        ->where('p.recogio_libro', '=', 1)
        ->where('p.devolvio_libro', '=', 1)
        ->get();

        return $librosPrestados;
    }
}
