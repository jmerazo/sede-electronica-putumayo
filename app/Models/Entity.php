<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $table = 'entities'; // Asegúrate de que este sea el nombre correcto de tu tabla

    // Define los campos que se pueden asignar masivamente
    protected $fillable = ['name', 'description', 'contact_email', 'phone']; // Ajusta según las columnas de la tabla
}
