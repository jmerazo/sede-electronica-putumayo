<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paa extends Model
{
    use HasFactory;

    protected $table = 'paa';

    // Asegúrate de que los campos aquí coincidan con los de tu tabla
    protected $fillable = ['period', 'name', 'archive'];
}
