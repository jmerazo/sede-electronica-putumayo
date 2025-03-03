@extends('layouts.app')

@section('title', $publication->title)

@section('content')
    <div class="container py-5">
        <h1 class="text-center">{{ $publication->title }}</h1>

        <div class="card shadow-lg mb-4">
            @if($publication->image)
                <img src="{{ asset('storage/' . $publication->image) }}" class="card-img-top" alt="{{ $publication->title }}">
            @endif
            <div class="card-body">
                <p class="text-muted">Publicado el {{ \Carbon\Carbon::parse($publication->date)->format('d/m/Y') }}</p>
                <p class="card-text">{{ $publication->description }}</p>
            </div>
        </div>
    </div>
@endsection