<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $table = 'associations'; // Asegúrate de que este sea el nombre correcto de tu tabla

    // Define los campos que se pueden asignar masivamente
    protected $fillable = ['name', 'classification', 'activity', 'phone', 'link']; // Ajusta según las columnas de la tabla
}
