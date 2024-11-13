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
        $autores = $this->autores($id);
        $categorias = $this->categorias($id);
        //dd($autores);
        $prestamo = $this->prestamo($id);
        return view('prestamo_libro', compact('libro', 'autores', 'prestamo', 'categorias'));
    }

    function prestamo($id){
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

    public function categorias($id){
        $categorias = DB::table('relacion_libro_categoria')
        ->join('categorias', 'relacion_libro_categoria.id_categoria', '=', 'categorias.id_categoria')
        ->where('relacion_libro_categoria.id_libro', $id)
        ->select('categorias.nombre_categoria')
        ->get();
        return $categorias;
    }

    public function autores($id){
        $autores = DB::table('relacion_libro_autor')
        ->join('autor', 'relacion_libro_autor.id_autor', '=', 'autor.id_autor')
        ->where('relacion_libro_autor.id_libro', $id)
        ->select('autor.nombre_autor', 'autor.apellido')
        ->get();

        return $autores;
    }
}
