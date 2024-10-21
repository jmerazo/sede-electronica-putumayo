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
    list-style-type: decimal;
    padding-left: 1rem;
    margin-top: 10px;
}

.list-group-numbered li {
    margin-bottom: 10px;
}

/* Resaltar el subelemento seleccionado */
.list-group-numbered li a.active, .list-group-numbered li a:hover {
    background-color: #f0f8ff;
    border-left: 3px solid #004884; /* Borde azul al seleccionar o hacer hover */
    padding-left: 10px;
    color: #004884; /* Cambiar el color del texto */
    text-decoration: none;
}

/* Cambiar el color del texto al hacer hover */
.list-group-numbered li a:hover {
    color: #004884;
    background-color: #e7f3ff;
}
</style>