<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractual extends Model
{
    use HasFactory;

    protected $table = 'contractual';

    // Asegúrate de que los campos aquí coincidan con los de tu tabla
    protected $fillable = ['expedition_date', 'name', 'tipo', 'object', 'link'];
}
