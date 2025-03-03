@extends('layouts.app')

@section('title', $publication->title)

@section('content')
<div class="container py-5">
    <div class="card shadow-lg">
        <img src="{{ asset('storage/' . $publication->image) }}" class="card-img-top" alt="{{ $publication->title }}">
        <div class="card-body">
            <h2 class="card-title">{{ $publication->title }}</h2>
            <p class="text-muted">Publicado el {{ \Carbon\Carbon::parse($publication->date)->format('d/m/Y') }}</p>
            <p class="card-text">{{ $publication->description }}</p>
            <a href="{{ route('publications.index') }}" class="btn btn-primary mt-3">Volver a publicaciones</a>
        </div>
    </div>

    <a href="{{ route('publications.index') }}" class="btn btn-primary">Volver a noticias</a>
</div>
@endsection
