<div id="slider-container">
    <div class="slider">
        <div class="slides">
            @foreach ($images as $image)
                <div class="slide">
                    <img src="{{ $image['url'] }}" alt="Slider Image">
                    <div class="slide-info">{{ $image['info'] }}</div>
                </div>
            @endforeach
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
        <button class="play-pause selected" onclick="toggleAutoSlide()">
            <img id="playPauseIcon" src="/icons/pause.svg" alt="Pause">
            <span class='btn__PlayPause' id="playPauseText">Pausar</span>
        </button>
    </div>
    <div class="indicator-container">
        @foreach ($images as $index => $image)
            <span class="indicator" onclick="selectSlide({{ $index }})"></span>
        @endforeach
    </div>
</div>

<script>
    let currentSlide = 0;
    let autoSlideInterval;
    let isPlaying = true;

    function showSlide(index) {
        const slides = document.querySelector('.slides');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = document.querySelectorAll('.slide').length;

        if (index >= totalSlides) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = totalSlides - 1;
        } else {
            currentSlide = index;
        }

        slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        indicators.forEach((indicator, idx) => {
            indicator.classList.toggle('active', idx === currentSlide);
        });
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function selectSlide(index) {
        showSlide(index);
        resetAutoSlide();
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            nextSlide();
        }, 5000); // Cambia cada 5 segundos
    }

    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }

    function toggleAutoSlide() {
        const playPauseIcon = document.getElementById('playPauseIcon');
        const playPauseText = document.getElementById('playPauseText');
        const playPauseButton = document.querySelector('.play-pause');

        if (isPlaying) {
            stopAutoSlide();
            playPauseIcon.src = '/icons/play.svg';
            playPauseIcon.alt = 'Play';
            playPauseText.textContent = 'Reproducir';
            playPauseButton.classList.add('selected'); // Agrega el borde cuando está en pausa
        } else {
            startAutoSlide();
            playPauseIcon.src = '/icons/pause.svg';
            playPauseIcon.alt = 'Pause';
            playPauseText.textContent = 'Pausar';
            playPauseButton.classList.remove('selected'); // Quita el borde cuando está en reproducción
        }

        isPlaying = !isPlaying;
    }

    function resetAutoSlide() {
        stopAutoSlide();
        startAutoSlide();
    }

    // Iniciar el slider automáticamente al cargar
    window.addEventListener('load', () => {
        startAutoSlide();
        showSlide(currentSlide);
    });
</script>

<style>
#slider-container {
    width: calc(100% + 12rem); /* Asegura que cubra el ancho de la pantalla más los márgenes globales */
    margin-left: -6rem; /* Anula los márgenes globales aplicados en los lados */
    margin-right: -6rem; /* Anula los márgenes globales aplicados en los lados */
    height: 500px;
    position: relative;
    overflow: hidden; /* Asegura que no haya desbordamiento */
}

.slider {
    display: flex;
    width: 100%;
}

.slides {
    display: flex;
    transition: transform 0.5s ease;
}

.slide {
    min-width: 100%;
    box-sizing: border-box;
    position: relative;
}

.slide img {
    width: 100%;
    display: block;
}

.slide-info {
    position: absolute;
    top: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    padding: 10px 20px;
    color: #000;
    font-size: 16px;
    font-weight: bold;
    max-width: 50%;
    clip-path: polygon(0 0, 100% 0, 100% 100%, 20px 100%, 0 0);/* Ajuste para un recorte diagonal pequeño */
}

.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    font-size: 24px;
    padding: 10px;
    cursor: pointer;
    z-index: 10;
}

.prev { left: 10px; }
.next { right: 10px; }

.play-pause {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: var(--govco-primary-color);
    border: 2px solid transparent;
    color: var(--govco-white-color);
    padding: 10px 15px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.play-pause img {
    width: 16px;
    height: 16px;
    filter: brightness(0) invert(1); /* Icono blanco */
}

.play-pause:hover {
    background-color: var(--govco-secondary-color);
}

.play-pause.selected {
    border-color: var(--govco-success-color); /* Borde verde cuando está seleccionado */
}

.btn__PlayPause{
    color: var(--govco-white-color);
    font-weight: bold;
}

.indicator-container {
    text-align: center;
    position: absolute;
    bottom: 20px;
    width: 100%;
    z-index: 10;
}

.indicator {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin: 0 5px;
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border: 2px solid transparent;
}

.indicator.active {
    background-color: rgba(255, 255, 255, 1);
    border-color: var(--govco-success-color); /* Borde verde para el indicador activo */
}
</style>