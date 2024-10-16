<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\editorial;

class agregarLibro extends Controller
{
    function agregar_libro(Request $request) {
        if($request->isMethod('POST')){
            try{
                $libro = new Libro();
                $libro->nombre_libro = $request->titulo;
                $libro->isbn = $request->isbn;
                $libro->numero_pagina = $request->paginas;
                $libro->descripcion = $request->descripcion;
                $libro->existencia = $request->existencia;

                // Manejar la subida de la imagen
                if ($request->hasFile('imagen')) {
                    $imagenPath = $request->file('imagen')->store('imagenes_libros', 'public');
                    $libro->imagen = $imagenPath; // Guardar la ruta en la BD
                }

                // Manejar la subida del PDF
                if ($request->hasFile('pdf')) {
                    $pdfPath = $request->file('pdf')->store('pdf_libros', 'public');
                    $libro->libro_digital = $pdfPath; // Guardar la ruta en la BD
                }
                $libro->id_editorial = $request->editorial;
                $libro->save();

                //$libro->autores()->attach($validatedData['autores']);
                // Guardar relaciones en la tabla pivot
                $libro->autores()->sync($request->input('autores'));
                //MANDA LA RESPUESTA AL BACKEND
                return response()->json(['success' => true, 'message' => 'El libro se ha subido correctamente'], 200);

            }catch(\Exception $e){
                return response()->json(['error' => 'Error al guardar el libro: ' . $e->getMessage()], 500);
            }
        }
        $editorials = editorial::all();
        $autores = Autor::all();
        return view('agregar_libro', compact('editorials', 'autores'));
    }

    function agregar_editorial(Request $request){
        $editorial = new editorial();
        $editorial->nombre_editorial = $request->autor;
        $editorial->save();
        return response()->json(['success' => true, 'message' => 'Editorial Guardada Exitosamente!'], 200);
    }
}

 