@extends('layouts.app')

@push('scripts')
<script>
function closeDetails() {
    document.getElementById('details-panel').classList.add('d-none');
}

document.querySelectorAll('.show-details-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const po = JSON.parse(this.dataset.po);
        const panel = document.getElementById('details-panel');
        panel.classList.remove('d-none');
        document.getElementById('detail-name').innerText = po.fullname;
        document.getElementById('detail-charge').innerText = po.charge ?? 'N/A';
        document.getElementById('detail-dependency').innerText = po.dependency ?? 'N/A';
        document.getElementById('detail-subdependencie').innerText = po.subdependencie ?? 'N/A';
        document.getElementById('detail-email').innerText = po.email ?? 'N/A';
        document.getElementById('detail-cellphone').innerText = po.cellphone ?? 'N/A';
        document.getElementById('detail-eps').innerText = po.eps ?? 'N/A';
        document.getElementById('detail-birthdate').innerText = po.birthdate ?? 'N/A';
        document.getElementById('detail-init_date').innerText = po.init_date ?? 'N/A';
        document.getElementById('detail-total_value').innerText = po.total_value ?? '0';
    });
});
</script>
@endpush

@section('content')
<div class="container">
    <h2 class="text-center mb-5">Gabinete Departamental - {{ $typeCharge }}</h2>
    @if(isset($message))
        <p class="text-center">{{ $message }}</p>
    @elseif($governor->isEmpty())
        <p class="text-center">No se encontraron funcionarios para el cargo {{ $typeCharge }}.</p>
    @else
        <div class="d-flex gap-4 flex-wrap flex-lg-nowrap justify-content-center align-items-start">
            <div class="flex-grow-1 card-column" id="card-column">
                @foreach($governor as $po)
                <div class="card mb-4 shadow-sm">
                    @if($po->image)
                        <img src="{{ asset('storage/' . $po->image) }}" class="card-img-top" alt="Imagen de {{ $po->fullname }}">
                    @endif
                    <div class="card-body text-center">
                        <p class="card-text">{{ $po->subdependencie ?? 'Sin área' }}</p>
                        <h5 class="card-title">{{ $po->fullname }}</h5>
                        <p class="card-text">{{ $po->charge ?? 'Cargo no asignado' }}</p>
                        <button
                            class="btn btn-outline-primary mt-2 show-details-btn"
                            data-po='@json($po)'>
                            Ver detalles
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="details-panel d-none position-relative" id="details-panel">
                <button class="btn-close position-absolute top-0 end-0 m-3" onclick="closeDetails()" aria-label="Cerrar"></button>
                <h4 id="detail-name" class="mb-3"></h4>
                <p><strong>Cargo:</strong> <span id="detail-charge"></span></p>
                <p><strong>Dependencia:</strong> <span id="detail-dependency"></span></p>
                <p><strong>Subdependencia:</strong> <span id="detail-subdependencie"></span></p>
                <p><strong>Correo:</strong> <span id="detail-email"></span></p>
                <p><strong>Teléfono:</strong> <span id="detail-cellphone"></span></p>
                <p><strong>EPS:</strong> <span id="detail-eps"></span></p>
                <p><strong>Fecha de nacimiento:</strong> <span id="detail-birthdate"></span></p>
                <p><strong>Fecha de ingreso:</strong> <span id="detail-init_date"></span></p>
                <p><strong>Valor total:</strong> $<span id="detail-total_value"></span></p>
            </div>
        </div>
    @endif
</div>
@endsection

<style>
.card {
    padding: 0 !important;
    margin: 0 !important;
    border: 1px solid #dee2e6;
    border-radius: 15px;
    overflow: hidden;
}

.card-img-top {
    display: block;
    width: 100%;
    height: 280px;
    object-fit: cover;
    margin: 0 !important;
    padding: 0 !important;
    border-radius: 0 !important;
}

.card-body {
    padding: 20px !important;
}

.card-column {
    max-width: 400px;
    transition: all 0.4s ease;
}

.details-panel {
    flex: 1;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
    min-width: 320px;
    max-width: 600px;
}

.btn-close {
    background: none;
    border: none;
    font-size: 1.2rem;
}
</style>