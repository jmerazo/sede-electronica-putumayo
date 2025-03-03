<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    protected $fillable = [
        'tipo_documento', 'identificacion', 'nombres', 'apellidos', 'cargo_id', 'dependencia_id', 'area_id', 'correo', 'celular',
    ];

    // Relación con el modelo Dependencia
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class, 'dependencia_id', 'id'); // Ajuste aquí
    }

    // Relación con el modelo Cargo
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id'); // Ajuste aquí
    }

    // Relación con el modelo Area
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id'); // Ajuste aquí
    }
}