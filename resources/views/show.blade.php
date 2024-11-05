@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{ $participate->title }}</h2>
    <p>{{ $participate->description }}</p>
    
    @if($participate->image)
        <img src="{{ asset($participate->image) }}" alt="{{ $participate->title }}" class="img-fluid mt-3">
    @endif

    <a href="{{ route('participate.index') }}" class="btn btn-secondary mt-4">Volver</a>
</div>
@endsection
