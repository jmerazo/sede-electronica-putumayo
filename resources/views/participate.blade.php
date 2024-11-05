@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Participa</h2>
    <p>Menú Participa es una categoría que hace parte del menú principal...</p>

    <div class="row">
        @foreach ($participates as $participate)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($participate->image)
                        <img src="{{ asset($participate->image) }}" class="card-img-top" alt="{{ $participate->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $participate->title }}</h5>
                        <p class="card-text">{{ Str::limit($participate->description, 100) }}</p>
                        <a href="{{ route('participate.show', $participate->id) }}" class="btn btn-primary">Leer más...</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
