<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons'; // Nombre de la tabla
    protected $fillable = ['no_contract', 'name', 'email', 'work_experiencie', 'date_start', 'date_end', 'cantract_value', 'monthly_value', 'dependencia']; // Ajusta los campos según tu tabla
}
