<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventarioInicial extends Model
{
    use HasFactory;
    protected $table = 'inventario_inicial'; // Nombre de la tabla

    public $timestamps = false;
}
