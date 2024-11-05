@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Publicación de la Información Contractual</h1>

    <!-- Formulario de Búsqueda -->
    <form method="GET" action="{{ route('contractual') }}" class="mb-3">
        <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control" />
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>


    <!-- Tabla de Resultados -->
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Fecha de Publicación</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Objeto</th>
                <th>Enlace a SECOP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts as $contract)
                <tr>
                    <td>{{ $contract->expedition_date }}</td>
                    <td>{{ $contract->name }}</td>
                    <td>{{ $contract->tipo }}</td>
                    <td>{{ $contract->object }}</td>
                    

                    <td>
                        @if($contract->link)
                            <a href="{{ asset($contract->link) }}" target="_blank">Ver Enlace</a> <!-- Enlace al archivo -->
                        @else
                            No disponible
                        @endif
                    </td>
                    
                    

                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div>
        {{ $contracts->appends(request()->input())->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection

@push('styles')
<style>
    .thead-light th {
        background-color: #f0f8ff;
        font-weight: bold;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table tbody tr td {
        vertical-align: middle;
    }

    .pagination .page-link {
        font-size: 14px;
        padding: 0.5rem 0.75rem;
        color: #007bff;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        padding: 0;
    }

    input.form-control {
        max-width: 300px;
    }
</style>
@endpush
