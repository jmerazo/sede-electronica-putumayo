@extends('layouts.app')
<style>   
.accordion-govco .accordion-header {
  line-height: 0;
  margin: 0;
}

.accordion-govco .button-accordion-govco {
  width: 100%;
  text-align: left;
  background-color: #ffffff;
  border: 0;
  min-height: 4.375rem;
  padding: 0 1.5rem;
  border-bottom: 0.125rem solid #E6EFFD;
  display: flex;
  align-items: center;
}

.accordion-govco .button-accordion-govco:focus {
  background-color: #ffffff;
}

.accordion-govco .text-button-accordion-govco {
  font-family: 'Montserrat-SemiBold';
  color: #4B4B4B;
  font-size: 18px;
  line-height: 1rem;
}

.accordion-govco .button-accordion-govco::after {
  font-family: "govco-font";
  font-size: 26px;
  color: #004884;
  margin-left: auto;
  content: "\e813";
}

.accordion-govco .button-accordion-govco.collapsed::after {
  content: "\e814";
}

.accordion-govco .item-accordion-govco {
  background-color: #ffffff;
}

.accordion-govco .body-accordion-govco {
  padding: 1.875rem 1.5rem;
  background-color: #F6F8F9;
}

.accordion-govco .title-one-accordion-govco {
  color: #4B4B4B;
  font-size: 18px;
  font-family: 'Montserrat-SemiBold';
  display: block;
}

.accordion-govco .title-two-accordion-govco {
  color: #000000;
  font-size: 16px;
  font-family: 'Montserrat-Bold';
  margin-left: 0.875rem;
  margin-top: 1.875rem;
  display: block;
}

.accordion-govco .text-one-accordion-govco {
  color: #4B4B4B;
  font-size: 16px;
  font-family: 'WorkSans-Regular';
  margin-left: 0.875rem;
  margin-top: 0.938rem;
  margin-bottom: 0;
  display: block;
  line-height: 1.5rem;
}

.accordion-govco .icon-button-accordion-govco {
  font-family: 'Montserrat-Bold';
  font-size: 20px;
  color: #FFFFFF;
  background-color: #004884;
  border-radius: 3.125rem;
  min-width: 2rem;
  height: 2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 0.625rem;
}


</style>

<div class="container my-5">
    <h1 class="text-primary">Transparencia y acceso a información pública</h1>
    <p>De acuerdo a la Ley 1712 de 2014, y resolución 3564 de 2015 de MinTIC se pone a disposición de la ciudadanía la sección de Transparencia y Acceso a la Información Pública Nacional, donde podrán conocer de primera mano toda la información.</p>
    
    <div class="my-4">
        <label for="search-input" class="form-label">Buscar</label>
        <div class="input-group">
            <input type="text" class="form-control" id="search-input" placeholder="Escribe lo que buscas" aria-label="Buscar">
            <button class="btn btn-outline-secondary" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="accordion-govco" id="accordionExampleTwo">
        @if ($secciones->isNotEmpty())
            @foreach ($secciones as $seccion)
                <div class="item-accordion-govco">
                    <h2 class="accordion-header" id="heading{{ $seccion->id }}">
                        <button class="button-accordion-govco collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $seccion->id }}" aria-expanded="false" aria-controls="collapse{{ $seccion->id }}">
                            <span class="icon-button-accordion-govco">{{ explode('.', $seccion->orden)[0] }}</span>
                            <span class="text-button-accordion-govco">{{ $seccion->titulo }}</span>
                        </button>
                    </h2>
                    <div id="collapse{{ $seccion->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $seccion->id }}" data-bs-parent="#accordionExampleTwo">
                        <div class="body-accordion-govco">
                            @if (!empty($seccion->descripcion))
                                <p class="descripcion">{{ nl2br(e($seccion->descripcion)) }}</p>
                            @endif

                            @php
                                $subElementos = DB::table('transparencia')->where('tipo', 'subelemento')->where('id_padre', $seccion->id)->orderBy('orden')->get();
                            @endphp

                            @if ($subElementos->isNotEmpty())
                                <ol>
                                    @foreach ($subElementos as $subElemento)
                                        <li><a href="{{ $subElemento->enlace }}" target="_blank" class="text-primary">{{ $subElemento->titulo }}</a></li>
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
</div>