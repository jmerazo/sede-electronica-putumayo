@extends('layouts.app')

@section('title', 'Micrositio 1 - Inicio')

@section('head')
    <style>
        /* Enhanced color palette */
        :root {
            --primary-color: #1a5f7a;
            --secondary-color: #2c8eb3;
            --text-color: #333;
            --background-light: #f4f7f9;
            --background-dark: #e9f1f6;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: var(--background-light);
        }

        /* News Section */
        .news-section {
            background-color: var(--background-light);
            padding: 40px 0;
        }

        .news-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .news-content {
            padding: 15px;
        }

        .news-title {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .news-date {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }

        .news-read-more {
            font-weight: bold;
            color: var(--secondary-color);
            text-decoration: none;
        }

        .news-read-more:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')

    <!-- Sección de Carrusel -->
    <section class="hero">
        <div id="heroCarousel" class="carousel slide mx-auto" data-bs-ride="carousel" style="max-width: 1300px;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/web/image/micrositios/banner1.jpg') }}" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/web/image/micrositios/banner2.jpg') }}" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('storage/web/image/micrositios/banner3.jpg') }}" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    <section id="about" class="about-section py-5">
        <div class="container">
            <h2>Sobre Nosotros la Secretaria de Hacienda</h2>
            <p>Somos un equipo comprometido con brindar información y servicios de calidad. Este micrositio está diseñado para mejorar la transparencia y el acceso a la información.</p>
        </div>
    </section>
   
    <!-- Sección de Banners -->
    <section class="banner-section">
        <div class="container">
            <div class="row banner-container">
                <div class="col-md-6">
                    <a href="https://softwareenlanube.net/siver-v-putumayo/redirect/" target="_blank">
                        <img src="{{ asset('img/hacienda/bannerH1.png') }}" class="img-fluid" alt="Pago Impuestos Vehículos">
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="https://softwareenlanube.net/siver-r-putumayo/pagoweb/consulta_boleta_contri.php" target="_blank">
                        <img src="{{ asset('img/hacienda/impuestoH1.jpg') }}" class="img-fluid" alt="Pago Impuesto de Registro">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section py-5 bg-light">
        <div class="container">
            <h2>Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <i class="fas fa-info-circle fa-3x mb-3"></i>
                        <h4>
                            <a href="/micrositio1/fiscalizacion" class="text-decoration-none service-link">
                                Fiscalización Vehículos
                            </a>
                        </h4>
                        <p>Consulta y accede a información actualizada sobre procesos de fiscalización vehicular, sanciones, obligaciones y trámites relacionados.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <i class="fas fa-user-friends fa-3x mb-3"></i>
                        <h4>
                            <a href="/micrositio1/asesoria" class="text-decoration-none service-link">
                                Asesoría Personalizada
                            </a>
                        </h4>
                        <p>Contamos con personal capacitado para responder tus dudas y ofrecer orientación.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-box text-center p-4">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <h4>
                            <a href="/micrositio1/recursos" class="text-decoration-none service-link">
                                Recursos Educativos
                            </a>
                        </h4>
                        <p>Encuentra recursos y documentos útiles para tu desarrollo y aprendizaje.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Noticias -->
    <section class="news-section">
        <div class="container">
            <h2 class="text-center mb-4">Últimas Noticias de Hacienda</h2>
            <div class="row">
                @if(isset($noticias) && $noticias->count() > 0)
                    @foreach($noticias as $noticia)
                        <div class="col-md-4 mb-4">
                            <div class="news-card">
                                <img src="{{ asset('storage/web/image/noticias/' . $noticia->imagen) }}" class="news-image" alt="{{ $noticia->contenido }}">
                                <div class="news-content">
                                    <h4 class="news-title">{{ $noticia->contenido }}</h4>
                                    <p class="news-date">{{ \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y') }}</p>
                                    <p>{{ Str::limit($noticia->contenido, 120) }}</p>
                                    <a href="{{ route('hacienda.noticias') }}" class="news-read-more">Leer más</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No hay noticias disponibles en este momento.</p>
                @endif
            </div>
        </div>
    </section>

    <section class="contact-section py-5">
        <div class="container">
            <h2>Contacto</h2>
            <p>Para más información o ayuda, no dudes en ponerte en contacto con nosotros a través del formulario de contacto.</p>
            <a href="/micrositio1/contact" class="btn btn-secondary mt-3">Ir a Contacto</a>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
