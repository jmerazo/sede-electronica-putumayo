@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <x-navbar />
    <x-test-component />

    <h1>Bienvenido a Mi Aplicación</h1>
    <p>Contenido de la página de inicio.</p>
@endsection