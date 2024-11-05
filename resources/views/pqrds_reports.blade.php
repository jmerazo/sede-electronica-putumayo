@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Informe Consolidado de Peticiones, Quejas, Reclamos, Denuncias y Sugerencias (PQRDS) Radicadas por Periodo y Vigencia</h2>

    <!-- Filtros de Año y Trimestre -->
    <form method="GET" action="{{ route('pqrds_reports.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <label for="year">Año</label>
                <input type="number" name="year" value="{{ $year }}" class="form-control" min="2000" max="{{ date('Y') }}">
            </div>
            <div class="col-md-6">
                <label for="trimester">Trimestre</label>
                <select name="trimester" class="form-control">
                    <option value="Q1" {{ $trimester == 'Q1' ? 'selected' : '' }}>Primer Trimestre</option>
                    <option value="Q2" {{ $trimester == 'Q2' ? 'selected' : '' }}>Segundo Trimestre</option>
                    <option value="Q3" {{ $trimester == 'Q3' ? 'selected' : '' }}>Tercer Trimestre</option>
                    <option value="Q4" {{ $trimester == 'Q4' ? 'selected' : '' }}>Cuarto Trimestre</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
    </form>

    <!-- Gráficas -->
    <div class="row mt-5">
        <div class="col-md-6">
            <canvas id="chartRadicadas"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="chartMediosRecepcion"></canvas>
        </div>
    </div>

    <!-- Tabla de Datos -->
    <div class="table-responsive mt-5">
        <table class="table table-bordered compact-table">
            <thead>
                <tr>
                    <th>Departamento Responsable</th>
                    <th>Tipo de Documento</th>
                    <th>Radicadas</th>
                    <th>Tramitadas</th>
                    <th>Correo Electrónico</th>
                    <th>Correo Certificado</th>
                    <th>Ventanilla</th>
                    <th>PQRD WEB</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pqrds_reports as $report)
                    <tr>
                        <td>{{ $report->responsible_department }}</td>
                        <td>{{ $report->document_type }}</td>
                        <td>{{ $report->radicadas }}</td>
                        <td>{{ $report->tramited }}</td>
                        <td>{{ $report->medio_correo_electronico }}</td>
                        <td>{{ $report->medio_correo_certificado }}</td>
                        <td>{{ $report->medio_ventanilla }}</td>
                        <td>{{ $report->medio_pqr_web }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Estilos personalizados para hacer la tabla más compacta -->
<style>
    .compact-table {
        font-size: 13px;
        border-collapse: collapse;
    }

    .compact-table th {
        background-color: #0033A0;
        color: #ffffff;
        text-align: center;
        padding: 8px;
    }

    .compact-table td {
        padding: 6px;
        text-align: center;
    }

    .compact-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .compact-table tbody tr:hover {
        background-color: #e6e6e6;
    }

    .compact-table th, .compact-table td {
        border: 1px solid #ddd;
    }
</style>

<!-- Scripts para Gráficos con Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxRadicadas = document.getElementById('chartRadicadas').getContext('2d');
    const chartRadicadas = new Chart(ctxRadicadas, {
        type: 'bar',
        data: {
            labels: {!! json_encode($pqrds_reports->pluck('document_type')) !!},
            datasets: [{
                label: 'Radicadas',
                data: {!! json_encode($pqrds_reports->pluck('radicadas')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }, {
                label: 'Tramitadas',
                data: {!! json_encode($pqrds_reports->pluck('tramited')) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
            }]
        }
    });

    const ctxMedios = document.getElementById('chartMediosRecepcion').getContext('2d');
    const chartMedios = new Chart(ctxMedios, {
        type: 'bar',
        data: {
            labels: ['Correo Electrónico', 'Correo Certificado', 'Ventanilla', 'PQRD WEB'],
            datasets: [{
                label: 'Medios de Recepción',
                data: [
                    {{ $pqrds_reports->sum('medio_correo_electronico') }},
                    {{ $pqrds_reports->sum('medio_correo_certificado') }},
                    {{ $pqrds_reports->sum('medio_ventanilla') }},
                    {{ $pqrds_reports->sum('medio_pqr_web') }},
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
            }]
        }
    });
</script>
@endsection
