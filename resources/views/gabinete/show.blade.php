@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            background-color: #ffffff;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .rounded-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .rounded-circle:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: background-color 0.2s;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .card h2 {
            font-size: 1.8em;
            color: #333;
            font-weight: bold;
        }
        .card p {
            font-size: 1em;
            color: #555;
            margin: 5px 0;
        }
    </style>

    <div class="card text-center">
        <h2>{{ $funcionario->nombres }} {{ $funcionario->apellidos }}</h2>
        
        @if($funcionario->image)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $funcionario->image) }}" alt="Imagen de {{ $funcionario->nombres }}" class="rounded-circle">
            </div>
        @endif

        <p><strong>Cargo:</strong> {{ $funcionario->cargo->name ?? 'Sin cargo' }}</p>
        <p><strong>Dependencia:</strong> {{ $funcionario->dependencia->name ?? 'Sin dependencia' }}</p>
        <p><strong>Área:</strong> {{ $funcionario->area->name ?? 'Sin área' }}</p>
        <p><strong>Correo:</strong> {{ $funcionario->correo }}</p>
        <p><strong>Celular:</strong> {{ $funcionario->celular ?? 'N/A' }}</p>

        <a href="{{ route('gabinete.index', ['cargoTipo' => $cargoTipo]) }}" class="btn btn-secondary mt-3">Volver al listado</a>
    </div>
</div>
@endsection
