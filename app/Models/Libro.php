<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;
    protected $table = 'libros'; // Nombre de la tabla
    protected $primaryKey = 'id_libro';
    public $timestamps = false;
    
    public function autores(){
        //return $this->belongsToMany(Autor::class, 'relacion_libro_autor', 'id_autor', 'id_libro');
        return $this->belongsToMany(Autor::class, 'relacion_libro_autor', 'id_libro', 'id_autor');
    }

    public function prestamos(){
        return $this->belongsToMany(prestamos::class, 'relacion_prestamo_libro', 'id_libro', 'id_prestamo');
    }

    public function categoria(){
        //return $this->belongsToMany(Autor::class, 'relacion_libro_autor', 'id_autor', 'id_libro');
        return $this->belongsToMany(Autor::class, 'relacion_libro_categoria', 'id_libro', 'id_categoria');
    }

} 
