<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos extends Model
{
    use HasFactory;
    protected $table = 'ingresos'; // Nombre de la tabla

    public $timestamps = false;
}
