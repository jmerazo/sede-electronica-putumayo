@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    @php
        $images = [
            ['url' => '/img/slider/slider_1.jpg', 'info' => 'Impuesto vehícular'],
            ['url' => '/img/slider/slider_2.jpg', 'info' => '#SoyPutumayense Historia'],
            ['url' => '/img/slider/slider_3.jpg', 'info' => 'Somos territorio de una inmensa riqueza natural'],
            ['url' => '/img/slider/slider_4.jpg', 'info' => 'ICETEX']
        ];
    @endphp

    <x-slider :images="$images" />
    <x-news :publications="$publications" />
    <x-interest-links />
@endsection