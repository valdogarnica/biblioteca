<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamos extends Model
{
    use HasFactory;
    protected $table = 'prestamos'; // Nombre de la tabla
    protected $primaryKey = 'id_prestamo';
    public $timestamps = false;

    public function libros(){
        return $this->belongsToMany(Libro::class, 'relacion_prestamo_libro', 'id_prestamo', 'id_libro');
    }
}
