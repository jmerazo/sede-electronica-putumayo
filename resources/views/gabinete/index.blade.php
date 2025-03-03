@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-5">Gabinete Departamental - {{ $cargoTipo }}</h2>

    <style>
        .card-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            background-color: #ffffff;
            border: none;
            width: 100%;
            max-width: 300px;
            margin: 10px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-img-top {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .card-body {
            text-align: center;
            padding: 20px;
        }
        .card-title {
            font-size: 1.25em;
            font-weight: bold;
            color: #333;
        }
        .card-text {
            font-size: 0.95em;
            color: #666;
            margin: 5px 0;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 0.9em;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    @if(isset($mensaje))
        <p class="text-center">{{ $mensaje }}</p>
    @elseif($funcionarios->isEmpty())
        <p class="text-center">No se encontraron funcionarios para el cargo {{ $cargoTipo }}.</p>
    @else
        <div class="card-container">
            @foreach($funcionarios as $funcionario)
                <div class="card mb-4 shadow-sm">
                    @if($funcionario->image)
                        <img src="{{ asset('storage/' . $funcionario->image) }}" class="card-img-top" alt="Imagen de {{ $funcionario->nombres }}">
                    @endif
                    <div class="card-body">
                        <p class="card-text">{{ $funcionario->area->name ?? 'Sin área' }}</p>
                        <h5 class="card-title">{{ $funcionario->nombres }} {{ $funcionario->apellidos }}</h5>
                        <p class="card-text">{{ $funcionario->cargo->name ?? 'Sin cargo' }}</p>
                                                                       
                        <a href="{{ route('gabinete.show', ['cargoTipo' => $cargoTipo, 'id' => $funcionario->id]) }}" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
