@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Directorio Institucional</h1>

    <!-- Formulario de Búsqueda -->
    <form method="GET" action="{{ route('directorio') }}" class="mb-3">
        <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control" />
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <!-- Tabla de Resultados -->
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($directorio as $dependency)
                <tr>
                    <td>{{ $dependency->name }}</td>
                    <td>{{ $dependency->description }}</td>
                    <td>{{ $dependency->cellphone }}</td>
                    <td>{{ $dependency->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div>
        {{ $directorio->appends(request()->input())->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Fondo claro para el encabezado de la tabla */
    .thead-light th {
        background-color: #f0f8ff;
        font-weight: bold;
    }

    /* Bordes de la tabla */
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }

    /* Alineación vertical de celdas */
    .table tbody tr td {
        vertical-align: middle;
    }

    /* Estilos para la paginación */
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
        width: 30px; /* Ajusta el tamaño del botón de paginación */
        height: 30px;
        padding: 0;
    }

    .pagination .page-item .page-link svg {
        width: 12px; /* Cambia el tamaño según sea necesario */
        height: 12px;
    }

    /* Limita el tamaño del campo de búsqueda */
    input.form-control {
        max-width: 300px;
    }
</style>
@endpush
