<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formality extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla asociada
    protected $table = 'formalities';

    // Especificar los campos que se pueden asignar en masa
    protected $fillable = [
        'name',
        'tipo',
        'link',
    ];
}
