<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias'; // Nombre de la tabla
    public function libros()
    {
        //return $this->belongsToMany(Libro::class, 'relacion_libro_autor', 'id_autor', 'id_libro');
        return $this->belongsToMany(Libro::class, 'relacion_libro_categoria', 'id_categoria', 'id_libro');
    }
}
