<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\categoria;
use App\Models\editorial;
use App\Models\ingresos;
use App\Models\inventarioInicial;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class inventario extends Controller
{
    public function libros_todos(){
        //$libros_todos = $this->libros_totales();
        //$libros_todos = $this->convinada();
        //$libros_todos = $this->super_consulta();
        $ingresos = $this->ingresos();
        //$libros_todos = $this->super_perfect_consulta();
        $libros_todos = $this->super_perfect_mega_consulta_convinada_tripe();
        $inventarioInicial = inventarioInicial::all();
        $autores = Autor::all();
        $categorias = categoria::all();
        $editorials = editorial::all();
        return view('inventario', compact('libros_todos', 'autores', 'categorias', 'editorials', 'inventarioInicial', 'ingresos'));
    }

    public function editar_libro(Request $request ,$id){
        $libro = Libro::find($id);
        // Actualizar solo los campos que se envían en la solicitud
        if ($request->has('nombreLibro')) {
            $libro->nombre_libro = $request->input('nombreLibro');
        }
        if ($request->has('isbn')) {
            $libro->isbn = $request->input('isbn');
        }
        if ($request->has('descripcion')) {
            $libro->descripcion = $request->input('descripcion');
        }
        if ($request->has('editorial')) {
            $libro->id_editorial = $request->input('editorial');
        }

        // Actualizar autores (relaciones muchos a muchos)
        if ($request->has('autores')) {
            $autores = $request->input('autores');
            if (is_array($autores)) {
                $libro->autores()->sync($autores);
            }
        }

        // Actualizar categorías (relaciones muchos a muchos)
        if ($request->has('categorias')) {
            $categorias = $request->input('categorias');
            if (is_array($categorias)) {
                $libro->categorias()->sync($categorias);
            }
        }

        // Guardar los cambios
        $libro->save();

        return response()->json([
            'success' => true,
            'message' => 'Libro actualizado correctamente'
        ]);
    }


    public function get_libro($id_libro){
        $libro = Libro::find($id_libro);
        
        // Verificar si el libro fue encontrado
        if (!$libro) {
            return response()->json(['error' => 'Libro no encontrado'], 404);
        }

        // Debug: Detener y mostrar el libro
        //dd($libro);

        // Si llegas aquí, el libro se ha encontrado
        return response()->json($libro);
    }
    /*
    public function libros_totales(){
        $libros = DB::table('libros')
        ->join('editorial', 'libros.id_editorial', '=', 'editorial.id_editorial')
        ->join('relacion_libro_autor', 'libros.id_libro', '=', 'relacion_libro_autor.id_libro')
        ->join('autor', 'relacion_libro_autor.id_autor', '=', 'autor.id_autor')
        ->select(
            'libros.id_libro',
            'libros.nombre_libro',
            'libros.isbn',
            'libros.descripcion',
            'libros.fecha',
            'libros.imagen',
            'libros.existencia',
            'editorial.nombre_editorial',
            DB::raw("GROUP_CONCAT(CONCAT(autor.nombre_autor, ' ', autor.apellido) SEPARATOR ', ') AS autores")
        )
        ->groupBy('libros.id_libro', 'libros.nombre_libro', 'libros.isbn', 'libros.descripcion', 'libros.fecha', 'editorial.nombre_editorial')
        ->get();

        return $libros;

    }

    public function libros_prestados(){
        $librosPrestados = DB::table('relacion_prestamo_libro as rpl')
        ->join('libros as l', 'rpl.id_libro', '=', 'l.id_libro')
        ->select('l.nombre_libro', 'l.existencia', DB::raw('COUNT(rpl.id_prestamo) AS libros_prestados'))
        ->groupBy('l.nombre_libro', 'l.existencia')
        ->get();
        
        return $librosPrestados;
    }


    public function convinada(){
        $libros = DB::table('libros')
        ->join('editorial', 'libros.id_editorial', '=', 'editorial.id_editorial')
        ->join('relacion_libro_autor', 'libros.id_libro', '=', 'relacion_libro_autor.id_libro')
        ->join('autor', 'relacion_libro_autor.id_autor', '=', 'autor.id_autor')
        ->leftJoin('relacion_prestamo_libro as rpl', 'libros.id_libro', '=', 'rpl.id_libro')
        ->select(
            'libros.id_libro',
            'libros.nombre_libro',
            'libros.isbn',
            'libros.descripcion',
            'libros.fecha',
            'libros.imagen',
            'libros.existencia',
            'editorial.nombre_editorial',
            DB::raw("GROUP_CONCAT(DISTINCT CONCAT(autor.nombre_autor, ' ', autor.apellido) SEPARATOR ', ') AS autores"),
            DB::raw('COUNT(DISTINCT rpl.id_prestamo) AS libros_prestados')
        )
        ->groupBy(
            'libros.id_libro',
            'libros.nombre_libro',
            'libros.isbn',
            'libros.descripcion',
            'libros.fecha',
            'libros.imagen',
            'libros.existencia',
            'editorial.nombre_editorial'
        )
        ->get();

        return $libros;
    }
    


    public function super_consulta(){
        $libros = DB::table('libros as l')
        ->leftJoin('relacion_prestamo_libro as rpl', 'l.id_libro', '=', 'rpl.id_libro')
        ->leftJoin('prestamos as p', function($join) {
            $join->on('rpl.id_prestamo', '=', 'p.id_prestamo')
                ->where('p.estado_prestamo', '=', 'Libro Prestado');
        })
        ->leftJoin('inventario_inicial as ii', 'l.isbn', '=', 'ii.isbn')
        ->join('editorial as e', 'l.id_editorial', '=', 'e.id_editorial')
        ->join('relacion_libro_autor as rla', 'l.id_libro', '=', 'rla.id_libro')
        ->join('autor as a', 'rla.id_autor', '=', 'a.id_autor')
        ->select(
            'l.id_libro',
            'l.nombre_libro',
            'l.imagen',
            'l.isbn',
            'ii.isbn as isbn_inventario',
            'l.existencia as Libros_Agregados',
            'ii.cantidad_fisica as cantidad_inventario',
            DB::raw('COALESCE(ii.cantidad_fisica + l.existencia, l.existencia) as suma_Total_libros'),
            DB::raw('COUNT(DISTINCT p.id_prestamo) as cantidad_prestada'),
            DB::raw('(COALESCE(ii.cantidad_fisica + l.existencia, l.existencia) - COUNT(p.id_prestamo)) as disponible_para_prestamo'),
            'e.nombre_editorial',
            DB::raw("GROUP_CONCAT(DISTINCT CONCAT(a.nombre_autor, ' ', a.apellido) SEPARATOR ', ') as autores")
        )
        ->groupBy('l.id_libro', 'l.nombre_libro', 'l.existencia', 'cantidad_inventario')
        ->having('disponible_para_prestamo', '>', 0)
        ->get();
        
        return $libros;
    }
    */

    public function ingresos(){
        $datos = ingresos::select('ingresos.isbn', 'libros.nombre_libro', 'ingresos.fecha_ingreso', DB::raw('SUM(ingresos.cantidad) as cantidad'))
        ->join('libros', 'ingresos.isbn', '=', 'libros.isbn')
        ->groupBy('ingresos.isbn', 'libros.nombre_libro', 'ingresos.fecha_ingreso')
        ->get();

        return $datos;
    }
    /*
    public function super_perfect_consulta(){
        // Subconsulta para las categorías de cada libro y practicamente me hace todo 
        $libros = Libro::select([
            'libros.id_libro',
            'libros.nombre_libro',
            'libros.imagen',
            'libros.isbn',
            'ii.isbn as isbn_inventario',
            'libros.existencia as Libros_Agregados',
            'ii.cantidad_fisica as cantidad_inventario',
            DB::raw('COALESCE(ii.cantidad_fisica + libros.existencia, libros.existencia) as suma_Total_libros'),
            DB::raw('COUNT(DISTINCT prestamos.id_prestamo) as cantidad_prestada'),
            DB::raw('(COALESCE(ii.cantidad_fisica + libros.existencia, libros.existencia) - COUNT(DISTINCT prestamos.id_prestamo)) as disponible_para_prestamo'),
            'editorial.nombre_editorial',
            DB::raw("GROUP_CONCAT(DISTINCT CONCAT(autor.nombre_autor, ' ', autor.apellido) SEPARATOR ', ') AS autores"),
            DB::raw('MAX(libros_categorias.categorias) AS categorias')
        ])
        ->leftJoin('relacion_prestamo_libro as rpl', 'libros.id_libro', '=', 'rpl.id_libro')
        ->leftJoin('prestamos', function($join) {
            $join->on('rpl.id_prestamo', '=', 'prestamos.id_prestamo')
                 ->where('prestamos.estado_prestamo', 'Libro Prestado');
        })
        ->leftJoin('inventario_inicial as ii', 'libros.isbn', '=', 'ii.isbn')
        ->leftJoin('editorial', 'libros.id_editorial', '=', 'editorial.id_editorial')
        ->leftJoin('relacion_libro_autor as rla', 'libros.id_libro', '=', 'rla.id_libro')
        ->leftJoin('autor', 'rla.id_autor', '=', 'autor.id_autor')
        ->leftJoin(DB::raw('(
                SELECT rlc.id_libro, GROUP_CONCAT(categorias.nombre_categoria SEPARATOR ", ") AS categorias
                FROM relacion_libro_categoria AS rlc
                JOIN categorias ON rlc.id_categoria = categorias.id_categoria
                GROUP BY rlc.id_libro
            ) AS libros_categorias'), 'libros.id_libro', '=', 'libros_categorias.id_libro')
        ->groupBy(
            'libros.id_libro',
            'libros.imagen', 
            'libros.nombre_libro', 
            'libros.isbn', 
            'ii.isbn', 
            'libros.existencia', 
            'ii.cantidad_fisica', 
            'editorial.nombre_editorial'
        )
        ->having('disponible_para_prestamo', '>', 0)
        ->get();

        return $libros;
    }
    */

    public function super_perfect_mega_consulta_convinada_tripe(){
        $libros = DB::table('vista_libros_disponibles as vls')
        ->leftJoin('ingresos_suma as i', 'vls.isbn_libros', '=', 'i.isbn')
        ->select([
            'vls.id_libro',
            'vls.nombre_libro',
            'vls.isbn_libros',
            'vls.imagen',
            DB::raw('COALESCE(i.cantidad, 0) AS cantidad'),
            DB::raw('COALESCE(vls.cantidad_inventario, 0) AS cantidad_inventario_inicial'),
            DB::raw('COALESCE(vls.cantidad_inventario + COALESCE(i.cantidad, 0), COALESCE(vls.cantidad_inventario, COALESCE(i.cantidad, 0))) AS Suma_Total'),
            'vls.cantidad_prestada',
            DB::raw('COALESCE(vls.cantidad_inventario + COALESCE(i.cantidad, 0), COALESCE(vls.cantidad_inventario, COALESCE(i.cantidad, 0))) - (vls.cantidad_prestada) AS Ejemplares_Disponibles'),
            'vls.nombre_editorial',
            'vls.autores',
            'vls.categorias',
        ])
        ->get();
        return $libros;
    }
    
}
