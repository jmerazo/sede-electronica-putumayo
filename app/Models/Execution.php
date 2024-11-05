<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Execution extends Model
{
    use HasFactory;

    protected $table = 'execution';

    protected $fillable = [
        'contract_number', 
        'dependency', 
        'contractor', 
        'nit', 
        'objective', 
        'subscription_date', 
        'total_value', 
        'duration', 
        'time_addition', 
        'start_date', 
        'end_date', 
        'contract_progress_percentage', 
        'cutoff_date'
    ];

    // Método para calcular el avance del contrato
    public function getProgressPercentageAttribute()
    {
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $cutoffDate = $this->cutoff_date ? Carbon::parse($this->cutoff_date) : Carbon::now();

        // Calcula el tiempo total del contrato en días
        $totalDuration = $endDate->diffInDays($startDate);

        // Calcula el tiempo transcurrido desde la fecha de inicio hasta la fecha de corte
        $elapsedDuration = $cutoffDate->diffInDays($startDate);

        // Si el contrato ya debería haber terminado, el avance es 100%
        if ($elapsedDuration >= $totalDuration) {
            return 100;
        }

        // Calcula el porcentaje de avance
        $progressPercentage = ($elapsedDuration / $totalDuration) * 100;

        return round($progressPercentage, 2); // Redondear a 2 decimales
    }
}
