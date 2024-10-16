<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class editorial extends Model
{
    use HasFactory;
    protected $table = 'editorial'; // Nombre de la tabla

    public $timestamps = false;
}
