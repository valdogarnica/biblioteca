<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function index() 
    {
        $libros = Libro::all();
        return view('home.index', compact('libros'));
    }

    function show($id){
        //$autores = LibroAutor::where('id_libro', $id)->firstOrFail();
        $libro = Libro::where('id_libro', $id)->firstOrFail();
        //$autores = $libro->autores; 
        $autores = DB::table('relacion_libro_autor')
        ->join('autor', 'relacion_libro_autor.id_autor', '=', 'autor.id_autor')
        ->where('relacion_libro_autor.id_libro', $id)
        ->select('autor.nombre_autor', 'autor.apellido')
        ->get();
        //dd($autores);
        $prestamo = $this->obtener_hora_por_idlibro($id);
        return view('prestamo_libro', compact('libro', 'autores', 'prestamo'));
    }

    function obtener_hora_por_idlibro($id){
        /*$horaLimite = DB::table('prestamos')
        ->join('relacion_prestamo_libro', 'prestamos.id_prestamo', '=', 'relacion_prestamo_libro.id_prestamo')
        ->where('relacion_prestamo_libro.id_libro', $id)
        ->pluck('prestamos.hora_limite_recoger_libro'); // o ->first() si solo quieres uno

        return $horaLimite;*/
        $prestamo = DB::table('prestamos')
        ->join('relacion_prestamo_libro', 'prestamos.id_prestamo', '=', 'relacion_prestamo_libro.id_prestamo')
        ->where('relacion_prestamo_libro.id_libro', $id)
        ->select('prestamos.*', 'relacion_prestamo_libro.*')  // Todos los campos de ambas tablas
        ->first();

        return $prestamo;
    }
}
