<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autor'; // Nombre de la tabla

    public $timestamps = false;
    public function libros()
    {
        //return $this->belongsToMany(Libro::class, 'relacion_libro_autor', 'id_autor', 'id_libro');
        return $this->belongsToMany(Libro::class, 'relacion_libro_autor', 'id_autor', 'id_libro');
    }
}
