<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configuracion extends Model
{
    use HasFactory;
    protected $table = 'configuracion'; // Nombre de la tabla
    //protected $primaryKey = 'id_prestamo';
    public $timestamps = false;
}
