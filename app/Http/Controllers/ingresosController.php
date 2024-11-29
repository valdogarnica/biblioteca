<?php

namespace App\Http\Controllers;

use App\Models\ingresos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\ViewName;

class ingresosController extends Controller
{
    function ingresos(){
        $ingresos = $this->in();
        return view("ingresos", compact('ingresos'));
    }
    function in(){
        $ingresos = DB::table('ingresos as i')
        ->join('libros as l', 'i.isbn', '=', 'l.isbn')
        ->select([
            'i.isbn',
            'i.fecha_ingreso',
            'l.nombre_libro',
            DB::raw('SUM(i.cantidad) as cantidad')
        ])
        ->groupBy('i.isbn', 'l.nombre_libro', 'i.fecha_ingreso')
        ->get();
        return $ingresos;
    }
}
