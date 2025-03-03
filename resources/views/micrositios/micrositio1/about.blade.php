@extends('layouts.app')

@section('title', 'Micrositio 1 - Sobre Nosotros')

@section('content')
    <section class="about-hero">
        <div class="about-hero-content text-center">
            <h1>Sobre Nosotros</h1>
            <p class="lead">Conoce más acerca del propósito, misión y valores de nuestro equipo.</p>
        </div>
    </section>

    <section class="mission-section py-5">
        <div class="container">
            <h2>Nuestra Misión</h2>
            <p>En el Micrositio 1, estamos comprometidos con ofrecer un espacio de acceso a información confiable y transparente, enfocado en brindar valor y apoyo a los ciudadanos. Nuestra misión es facilitar el acceso a servicios y recursos de calidad.</p>
        </div>
    </section>

    <section class="vision-section py-5 bg-light">
        <div class="container">
            <h2>Nuestra Visión</h2>
            <p>Aspiramos a ser una plataforma de referencia para la transparencia y el servicio público, innovando constantemente para adaptarnos a las necesidades de la comunidad.</p>
        </div>
    </section>

    <section class="team-section py-5">
        <div class="container">
            <h2>Conoce a Nuestro Equipo</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="team-member text-center p-4">
                        <img src="{{ asset('images/team1.jpg') }}" alt="Miembro del equipo" class="img-fluid rounded-circle mb-3">
                        <h4>Juan Pérez</h4>
                        <p>Director de Proyectos</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member text-center p-4">
                        <img src="{{ asset('images/team2.jpg') }}" alt="Miembro del equipo" class="img-fluid rounded-circle mb-3">
                        <h4>María Gómez</h4>
                        <p>Coordinadora de Comunicación</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member text-center p-4">
                        <img src="{{ asset('images/team3.jpg') }}" alt="Miembro del equipo" class="img-fluid rounded-circle mb-3">
                        <h4>Pedro Ruiz</h4>
                        <p>Analista de Datos</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Estilos específicos para esta vista -->
<style>
    .about-hero {
        background-color: #0056b3;
        color: white;
        padding: 60px 0;
    }
    .about-hero-content h1 {
        font-size: 2.5rem;
    }
    .mission-section, .vision-section, .team-section {
        text-align: center;
    }
    .team-section .team-member {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: box-shadow 0.3s;
    }
    .team-section .team-member:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .team-section .team-member img {
        width: 120px;
        height: 120px;
    }
</style>
