@extends('layouts.sidebar')

@section('title', 'Misión')

@section('sidebar')
    <!-- Sidebar para pasar los subelementos -->
    @include('partials.sidebar', ['secciones' => $secciones])
@endsection
<style>
/* Estilos globales */
body {
    font-family: 'Arial', sans-serif;
    text-align: justify !important; /* Forzar la justificación del texto */
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
}

/* Clase personalizada para los títulos */
.titulo-personalizado {
    font-weight: bold;
    color: #004884; /* Cambia este color al que prefieras */
    margin-bottom: 20px;
}

.container-ms {
    border: 1px solid #ddd; /* Borde del contenedor */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para un efecto de elevación */
    border-radius: 10px; /* Bordes redondeados */
    padding: 20px; /* Espaciado interno */
    margin: 0 auto; /* Para centrar el contenedor horizontalmente */
    
}

/* Espaciado */
.my-5 {
    margin-top: 50px !important;
    margin-bottom: 50px !important;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 768px) {
    h1 {
        font-size: 1.8rem;
    }

    .container p {
        font-size: 1rem;
    }

    .container {
        padding: 20px;
    }
}
</style>

@section('main-content')
<div class="container-ms">
    <div class="container my-5">
        <h1 class="titulo-personalizado">Misión</h1>
        <p>Promover un auténtico desarrollo económico sostenible, a través de la armonización de las estrategias del Departamento, con las estrategias locales, nacionales e internacionales, bajo los principios de transparencia, equidad, justicia social, conservación y aprovechamiento de la riqueza natural del departamento del Putumayo. Acompañar a las entidades territoriales y pueblos étnicos del Departamento, en la promoción del desarrollo y bienestar social, partiendo de las visiones propias y bajo los principios de coordinación, complementariedad, concurrencia y subsidiariedad.</p>
    </div>

    <div class="container my-5">
        <h1 class="titulo-personalizado">Visión</h1>
        <p>En el año 2026 el departamento del Putumayo, en el propósito de ser un territorio de paz y apoyado en la educación y la salud como motores de transformación, cuenta con las bases para ser el centro de desarrollo económico sostenible del sur del país; con las capacidades suficientes para que los 13 municipios del Departamento, en forma autónoma y articulada, puedan conservar sus ecosistemas, generar riqueza para todos, bajo los principios de igualdad y equidad, así como aprovechar y conservar la condición Andino Amazónica, alcanzando el buen vivir de sus habitantes.</p>
    </div>

    <div class="container my-5">
        <h1 class="titulo-personalizado">Objetivo</h1>
        <p>En su artículo 298 de la Constitución Política de Colombia de 1991 el Departamento de Putumayo tiene autonomía para la administración de los asuntos seccionales y la planificación y promoción del desarrollo económico y social dentro de su territorio en los términos establecidos por la Constitución.</p>
    </div>

    <div class="container my-5">
        <h1 class="titulo-personalizado">Funciones</h1>
        <p>El Departamento ejerce funciones administrativas, de coordinación, de complementariedad de la acción municipal, de intermediación entre la Nación y los Municipios y de prestación de los servicios que determinen la Constitución y las leyes. La ley reglamentará lo relacionado con el ejercicio de las atribuciones que la Constitución les otorga.</p>
    </div>
</div>
@endsection