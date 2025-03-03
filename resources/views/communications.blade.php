@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Comunicados Oficiales, Convocatorias de la entidad </h2>
    <p>Inicialmente es preciso mencionar que el acuerdo 060 de 2001 es el que establece las pautas para la
administración de las comunicaciones oficiales en las entidades públicas y las privadas que cumplen
funciones públicas y allí se define que las Comunicaciones Oficiales son todas aquellas recibidas o
producidas en desarrollo de las funciones asignadas legalmente a una entidad, independientemente del
medio utilizado.
</p>
    <div class="list-group">
        @foreach($communications as $communication)
            <a href="{{ route('communications.show', $communication->id) }}" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $communication->title }}</h5>
                <p class="mb-1">{{ \Illuminate\Support\Str::limit($communication->content, 100) }}</p>
                <small>{{ $communication->created_at->format('d/m/Y') }}</small>
            </a>
        @endforeach
    </div>
</div>
@endsection



<style>
    .text-justify {
        text-align: justify;
    }

    .communication-item h3 {
        font-size: 1.5rem;
        color: #003366;
    }

    .btn-primary {
        background-color: #003366;
        border-color: #003366;
    }
</style>
