@extends('dashboard') 
<script>
let dragSrcEl = null;

document.querySelectorAll('.slider-item').forEach(item => {
    item.setAttribute('draggable', true);

    item.addEventListener('dragstart', function (e) {
        dragSrcEl = this;
        e.dataTransfer.effectAllowed = 'move';
    });

    item.addEventListener('dragover', function (e) {
        e.preventDefault();
        return false;
    });

    item.addEventListener('drop', function (e) {
        e.preventDefault();
        if (dragSrcEl !== this) {
            const parent = this.parentNode;
            parent.insertBefore(dragSrcEl, this);
            updateOrder();
        }
    });
});

function editSlider(id) {
    // Lógica para abrir modal de edición
    // Puedes cargar vía AJAX la información
    alert("Editar imagen " + id);
}

function deleteSlider(id) {
    if (confirm("¿Seguro que deseas eliminar esta imagen?")) {
        fetch(`/dashboard/slider/images/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            location.reload();
        });
    }
}

function toggleStatus(id) {
    fetch(`/dashboard/slider/images/${id}/toggle-status`, {
        method: 'PATCH',
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.json())
    .then(data => {
        const button = document.getElementById(`status-btn-${id}`);
        const label = document.getElementById(`status-label-${id}`);

        if (button && label) {
            button.textContent = data.status ? 'Desactivar' : 'Activar';
            button.classList.toggle('btn-active', data.status);
            button.classList.toggle('btn-inactive', !data.status);

            label.textContent = data.status ? 'Activo' : 'Inactivo';
            label.classList.toggle('text-success', data.status);
            label.classList.toggle('text-danger', !data.status);

            alert(data.message);
        } else {
            console.warn("No se encontró el botón o la etiqueta para actualizar visualmente.");
        }
    })
    .catch(err => {
        console.error("Error al cambiar estado:", err);
        alert("No se pudo actualizar el estado.");
    });
}

function openModalSlider() {
    document.getElementById('modalCreateSlider').style.display = 'flex';
}

document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll('.slider-item');
    let draggedItem = null;

    items.forEach(item => {
        item.setAttribute('draggable', true);

        item.addEventListener('dragstart', function () {
            draggedItem = this;
            this.classList.add('dragging');
        });

        item.addEventListener('dragend', function () {
            this.classList.remove('dragging');
        });

        item.addEventListener('dragover', function (e) {
            e.preventDefault();
        });

        item.addEventListener('drop', function (e) {
            e.preventDefault();
            if (draggedItem !== this) {
                const parent = this.parentNode;
                parent.insertBefore(draggedItem, this);
                updateOrder();
            }
        });
    });

    // Actualizar orden en backend
    function updateOrder() {
        const items = document.querySelectorAll('.slider-item');
        items.forEach((item, index) => {
            const id = item.dataset.id;
            fetch(`/dashboard/slider/images/${id}/order`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ order: index + 1 })
            })
            .then(res => res.json())
            .then(data => {
                item.querySelector('.order-number').textContent = index + 1;
            })
            .catch(err => console.error("Error actualizando orden:", err));
        });
    }
});

function openModalEditSlider(id) {
    fetch(`/dashboard/slider/images/${id}/edit`)
        .then(res => res.json())
        .then(data => {
            // Validación HTML segura
            document.getElementById("edit_id").value = data.id;
            document.getElementById("edit_title").value = data.title || '';
            document.getElementById("edit_link").value = data.link || '';

            const previewImg = document.getElementById("preview_image");
            if (previewImg && data.route) {
                previewImg.src = `/img/sliders/${data.route}`;
                previewImg.style.display = 'block';
            }

            document.getElementById("modalEditSlider").style.display = "flex";
        })
        .catch(err => {
            console.error("Error al cargar datos del slider:", err);
            alert("No se pudo cargar la información del slider.");
        });
}
</script>

@section('content')
<div class="container">
    <h2>Gestión de Imágenes del Slider</h2>

    <div id="slider-list" class="slider-list mt-4">
        @foreach ($slider as $image)
            <div class="slider-item" data-id="{{ $image->id }}">
                <img src="{{ asset('img/sliders/' . $image->route) }}" alt="{{ $image->title }}" class="slider-thumb">
                <div class="slider-info">
                    <p><strong>{{ $image->title }}</strong></p>
                    <p>Orden: <span class="order-number">{{ $image->order }}</span></p>
                    <p>Estado: 
                        <span 
                            id="status-label-{{ $image->id }}" 
                            class="status-label {{ $image->status ? 'text-success' : 'text-danger' }}"
                        >
                            {{ $image->status ? 'Activo' : 'Inactivo' }}
                        </span>
                    </p>
                    <div class="slider-actions">
                        <button onclick="openModalEditSlider({{ $image->id }})">Editar</button>
                        <button onclick="deleteSlider({{ $image->id }})">Eliminar</button>
                        <button 
                            id="status-btn-{{ $image->id }}" 
                            onclick="toggleStatus({{ $image->id }})"
                            class="{{ $image->status ? 'btn-active' : 'btn-inactive' }}"
                        >
                            {{ $image->status ? 'Desactivar' : 'Activar' }}
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<a href="#" class="btn-floating" onclick="openModalSlider()">+</a>
@endsection
@include('components.administration.slider-image.modal-create-slider-image')
@include('components.administration.slider-image.modal-update-slider-image')
<!-- Estilos -->
<style>
.slider-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.slider-item {
    width: 200px;
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    cursor: grab;
    cursor: move; /* Cambia cursor a "mover" */
    user-select: none;
    opacity: 1;
    transition: transform 0.2s, opacity 0.2s;
}
.slider-item.dragging {
    opacity: 0.5;
    transform: scale(1.02);
}
.slider-thumb {
    width: 100%;
    height: 120px;
    object-fit: cover;
}
.slider-info {
    padding: 10px;
}
.slider-actions {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-top: 10px;
}
.slider-actions button {
    padding: 5px;
    border: none;
    border-radius: 4px;
    background-color: #0056b3;
    color: white;
    cursor: pointer;
}
.slider-actions button:hover {
    background-color: #003d80;
}

.btn-active {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
    cursor: pointer;
}

.btn-inactive {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
    cursor: pointer;
}

#slider-list {
    border: 2px dashed #ccc;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
}
</style>