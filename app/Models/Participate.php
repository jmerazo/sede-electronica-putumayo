<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participate extends Model
{
    use HasFactory;

    protected $table = 'participate'; // Define el nombre de la tabla
    protected $fillable = ['title', 'description', 'image']; // Campos asignables masivamente
}
