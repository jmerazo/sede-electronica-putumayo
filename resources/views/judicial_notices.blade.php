@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Notificaciones, Autos y Edictos</h2>
    <p style="text-align: justify;">
        De conformidad con el artículo 197 de la Ley 1473 de 2011, la Gobernación del Putumayo ha creado el buzón de correo electrónico 
        <a href="mailto:notificaciones.judiciales@putumayo.gov.co">notificaciones.judiciales@putumayo.gov.co</a> 
        exclusivamente para recibir notificaciones judiciales. Este correo estará a cargo del Departamento Administrativo Jurídico de la Gobernación.
    </p>
    <p style="text-align: justify;">
        Si la hora de recibido, de acuerdo con el servidor de correo de la Gobernación del Putumayo, corresponde a un horario no hábil, automáticamente quedará recibido con fecha del siguiente día hábil a las 08:00 a.m.
    </p>

    <!-- Formulario de Búsqueda -->
    <form method="GET" action="{{ route('judicial_notices.index') }}" class="mb-3">
        <input type="search" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control" />
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo de Notificación</th>
                    <th>Detalles</th>
                    <th>Fecha de Publicación</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @forelse($judicial_notices as $notice)
                    <tr>
                        <td>{{ $notice->tipo }}</td>
                        <td>{{ Str::limit($notice->details, 100) }}</td>
                        <td>{{ \Carbon\Carbon::parse($notice->publication_date)->format('d/m/Y') }}</td>
                        <td><a href="{{ asset('storage/' . $notice->link) }}" target="_blank">Ver Documento</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron resultados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación personalizada -->
    <div class="d-flex justify-content-center mt-3">
        {{ $judicial_notices->appends(request()->input())->links('vendor.pagination.custom') }}
    </div>
</div>

<!-- Estilos específicos de esta vista -->
<style>
    .table th, .table td {
        vertical-align: middle;
    }

    .table tbody tr td a {
        color: #0033A0;
        text-decoration: underline;
    }

    /* Justificación del texto en el contenedor principal */
    .container p {
        text-align: justify;
    }
</style>
@endsection
