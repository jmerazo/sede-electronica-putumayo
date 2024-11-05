<!-- resources/views/formalities.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Trámites y Servicios</h2>
    <p>Encuentra la información necesaria para realizar tus trámites.</p>

    <!-- Formulario de Búsqueda -->
    <form method="GET" action="{{ route('control_entities') }}" class="mb-3">
        <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control" />
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo de Tramite</th>
                    <th>Tipo</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formalities as $formality)
                    <tr>
                        <td>{{ $formality->name }}</td>
                        <td>
                            <!-- Asistencia -->
                            @php
                                $asistenciaIcon = $formality->tipo['asistencia'] === 'Presencial' ? 'fa-calendar-alt' : 'fa-globe';
                            @endphp
                            <div class="icon-text">
                                <i class="fas {{ $asistenciaIcon }} icon-asistencia"></i> 
                                <span>{{ $formality->tipo['asistencia'] ?? 'N/A' }}</span>
                            </div>

                            <!-- Pago -->
                            @php
                                $pagoIcon = $formality->tipo['pago'] === 'Requiere pago' ? 'fa-dollar-sign' : 'fa-hand-holding-usd';
                            @endphp
                            <div class="icon-text">
                                <i class="fas {{ $pagoIcon }} icon-pago"></i> 
                                <span>{{ $formality->tipo['pago'] ?? 'N/A' }}</span>
                            </div>

                            <!-- Duración -->
                            @php
                                $duracionIcon = 'fa-clock';
                            @endphp
                            <div class="icon-text">
                                <i class="fas {{ $duracionIcon }} icon-duracion"></i> 
                                <span>Duración: {{ $formality->tipo['duracion'] ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td><a href="{{ $formality->link }}" target="_blank">Visitar sitio</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación personalizada -->
    <div class="d-flex justify-content-center mt-3">
        {{ $formalities->appends(request()->input())->links('vendor.pagination.custom') }}
    </div>
</div>

<!-- Estilos en línea específicos de esta vista -->
<style>
    .icon-asistencia {
        color: #0033A0; /* Azul oscuro de Gov.co */
    }
    .icon-pago {
        color: #009640; /* Verde de Gov.co */
    }
    .icon-duracion {
        color: #00AEEF; /* Azul claro de Gov.co */
    }

    /* Estilo para alinear ícono y texto */
    .icon-text {
        display: flex;
        align-items: center;
        gap: 8px; /* Espacio entre el ícono y el texto */
        margin-bottom: 8px; /* Espacio entre cada línea de texto */
    }

    /* Ancho fijo para alinear texto */
    .icon-text i {
        min-width: 24px; /* Ajusta el ancho según el ícono */
        text-align: center; /* Centra el ícono en el espacio asignado */
    }
</style>
@endsection
