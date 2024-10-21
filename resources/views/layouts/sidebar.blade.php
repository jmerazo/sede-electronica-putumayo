@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Izquierdo -->
            <div class="col-md-3">
                @yield('sidebar')
            </div>
            <!-- Contenido Principal -->
            <div class="col-md-9">
                @yield('main-content')
            </div>
        </div>
    </div>
@endsection
