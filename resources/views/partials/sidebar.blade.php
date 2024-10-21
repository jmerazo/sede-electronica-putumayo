<div class="accordion-govco" id="accordionSidebar">
    @if ($secciones->isNotEmpty())
        @foreach ($secciones as $seccion)
            <div class="item-accordion-govco">
                <!-- Header del acordeón -->
                <h2 class="accordion-header" id="heading{{ $seccion->id }}">
                    <button class="button-accordion-govco collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $seccion->id }}" aria-expanded="false" aria-controls="collapse{{ $seccion->id }}">
                        <span class="text-button-accordion-govco">{{ $seccion->titulo }}</span>
                    </button>
                </h2>

                <!-- Contenido del acordeón -->
                <div id="collapse{{ $seccion->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $seccion->id }}" data-bs-parent="#accordionSidebar">
                    <div class="body-accordion-govco">
                        @php
                            // Obtener los subelementos de la sección actual
                            $subElementos = DB::table('transparencia')->where('tipo', 'subelemento')->where('id_padre', $seccion->id)->orderBy('orden')->get();
                        @endphp

                        @if ($subElementos->isNotEmpty())
                            <ol class="list-group-numbered">
                                @foreach ($subElementos as $subElemento)
                                    <li>
                                        <a href="{{ $subElemento->enlace }}" class="text-primary sub-element">{{ $subElemento->titulo }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p>No hay subelementos disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No hay datos disponibles.</p>
    @endif
</div>

<style scoped>
.body-accordion-govco{
    margin: 1rem;
}
/* Estilos del botón de acordeón con la flecha */
.accordion-govco .button-accordion-govco {
    width: 100%;
    text-align: left;
    background-color: var(--govco-white-color);
    border: 0;
    padding: 1rem;
    border-bottom: 1px solid #ddd;
    display: flex;
    align-items: center;
    position: relative;
    transition: background-color 0.3s ease;
}

/* Flecha hacia arriba por defecto */
.accordion-govco .button-accordion-govco::after {
    content: '';
    display: inline-block;
    width: 24px;
    height: 24px;
    background: url('/icons/angle-up.svg') no-repeat center;
    background-size: contain;
    margin-left: auto;
    transition: transform 0.3s ease;
}

/* Flecha hacia abajo cuando está colapsado */
.accordion-govco .button-accordion-govco.collapsed::after {
    transform: rotate(180deg); /* Girar flecha hacia abajo */
}

/* Resaltar la sección seleccionada */
.accordion-govco .button-accordion-govco.active, .accordion-govco .button-accordion-govco:focus {
    background-color: #e7f3ff;
    border-left: 4px solid #004884; /* Borde azul cuando se selecciona */
    outline: none;
}

/* Sub-elementos de la lista */
.list-group-numbered {
    padding-left: 1rem; /* Ajusta el espacio entre los números y el texto */
    margin-top: 10px;
    margin-bottom: 0;
    color: #000 !important; /* Color del texto estándar */
}

.list-group-numbered li {
    margin-bottom: 8px;
    font-size: 16px; /* Tamaño de fuente para los enlaces */
}

/* Estilo para los enlaces de los subelementos */
.list-group-numbered li {
    color: var(--gov-black-color) !important; /* Color del enlace en estado normal */
    text-decoration: none; /* Sin subrayado */
    font-weight: normal;
}

.list-group-numbered li:hover {
    color: var(--govco-secondary-color) !important; /* Cambiar el color al hacer hover (como en la primera imagen) */
    text-decoration: underline; /* Subrayado solo en hover */
    font-weight: 500;
}

/* Estilo para los enlaces de los subelementos */
.list-group-numbered li a {
    color: var(--gov-black-color) !important; /* Color del enlace en estado normal */
    text-decoration: none; /* Sin subrayado */
    font-weight: normal;
    letter-spacing: normal;
}

.list-group-numbered li a:hover {
    color: var(--govco-secondary-color) !important; /* Cambiar el color al hacer hover (como en la primera imagen) */
    text-decoration: underline; /* Subrayado solo en hover */
    font-weight: 500;
}

.list-group-numbered li a.active {
    font-weight: bold;
    text-decoration: underline;
    color: #b03535; /* Color para el enlace activo */
}
</style>