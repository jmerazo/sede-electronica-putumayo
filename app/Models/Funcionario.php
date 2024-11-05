<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';  // Nombre de la tabla en base de datos

    protected $fillable = [
        'tipo_documento', 'identificacion', 'nombres', 'apellidos', 'cargo', 'dependencias', 'area', 'correo', 'celular',
    ];
}
