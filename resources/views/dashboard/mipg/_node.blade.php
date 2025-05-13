<li data-id="{{ $file->id }}" data-path="{{ $file->path }}">
    @if ($file->type === 'directory')
        <div onclick="toggleFolder(this)" class="directory" ondblclick="enableRename(this, {{ $file->id }})">
            📁 <span class="filename">{{ $file->name }}</span>
        </div>
        @if(isset($file->children) && $file->children->count())
            <ul class="file-tree d-none">
                @foreach ($file->children as $child)
                    @include('dashboard.mipg._node', ['file' => $child])
                @endforeach
            </ul>
        @endif
    @else
        @php
        $extension = strtolower($file->extension ?? '');
            switch ($extension) {
                case 'pdf':
                    $icon = asset('icon/pdf.png');
                    break;
                case 'doc':
                case 'docx':
                    $icon = asset('icon/word.png');
                    break;
                case 'xls':
                case 'xlsx':
                    $icon = asset('icon/excel.png');
                    break;
                case 'pptx':
                    $icon = asset('icon/powerpoint.png');
                    break;
                default:
                    $icon = asset('icon/default.png');
                    break;
            }
        @endphp

        <div class="file" ondblclick="enableRename(this, {{ $file->id }})">
            <img src="{{ $icon }}" alt="{{ $extension }}" style="width: 18px; margin-right: 5px;">
            <a href="{{ asset('storage/' . $file->file) }}" target="_blank">
                <span class="filename">{{ $file->name }}</span>
            </a>
        </div>
    @endif
</li>

<script>
function enableRename(el, id) {
    const existingInput = el.querySelector('.rename-input');
    if (existingInput) {
        existingInput.focus();
        return;
    }

    const nameSpan = el.querySelector('.filename');
    if (!nameSpan) {
        console.error('No se encontró el span del nombre en:', el);
        return;
    }

    const oldName = nameSpan.innerText;
    const input = document.createElement('input');
    input.type = 'text';
    input.value = oldName;
    input.className = 'rename-input';

    const parentAnchor = nameSpan.closest('a');
    let originalHref = null;
    if (parentAnchor) {
        originalHref = parentAnchor.href;
        parentAnchor.removeAttribute('href'); 
    }

    input.onblur = () => {
        const newName = input.value.trim();
        if (newName !== '' && newName !== oldName) {
            renameFile(id, newName, nameSpan, input, oldName);
        } else {
            nameSpan.innerText = oldName;
            input.replaceWith(nameSpan);
        }
        if (parentAnchor && originalHref) {
            parentAnchor.href = originalHref;
        }
    };
    input.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            input.blur();
        } else if (e.key === 'Escape') {
            nameSpan.innerText = oldName;
            input.replaceWith(nameSpan);
            if (parentAnchor && originalHref) {
                parentAnchor.href = originalHref;
            }
        }
    });
    nameSpan.replaceWith(input);
    input.focus();
    input.select();
}

function renameFile(id, newName, span, input, oldName) {
    fetch(`/dashboard/mipg/rename/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: newName })
    })
    .then(response => {
        if (!response.ok) {
            return response.json()
                .then(errorData => {
                    const error = new Error(errorData.message || `Error del servidor: ${response.status}`);
                    error.response = response;
                    error.data = errorData;
                    throw error; 
                })
                .catch(() => {
                    const error = new Error(`Falló la solicitud de renombrar. Status: ${response.status} ${response.statusText}`);
                    error.response = response;
                    throw error;
                });
        }
        return response.json();
    })
    .then(data => {
        if (data && data.file && data.file.name) {
            span.innerText = data.file.name; 
        } else {
            span.innerText = newName;
        }
        input.replaceWith(span);
    })
    .catch(error => {
        console.error('Error al renombrar (detallado):', error);
        
        let alertMessage = 'Error al renombrar el elemento.';
        if (error.message && !error.message.startsWith('Failed to fetch')) {
            alertMessage = error.message;
        }
        if (error.data && error.data.message && error.data.message !== alertMessage) {
             alertMessage += `\nDetalles: ${error.data.message}`;
        }
        if (error.data && error.data.errors) {
            let validationMessages = Object.values(error.data.errors).flat().join('\n- ');
            if (validationMessages) {
                alertMessage += `\nErrores de validación:\n- ${validationMessages}`;
            }
        } else if (error.response && error.response.status) {
            if (!alertMessage.includes(`Status: ${error.response.status}`)) {
                 alertMessage += ` (Status: ${error.response.status})`;
            }
        }

        span.innerText = oldName;
        input.replaceWith(span);
        alert(alertMessage);
    });
}

document.addEventListener('contextmenu', function (e) {
    const targetLi = e.target.closest('li');
    if (targetLi && (e.target.closest('.file') || e.target.closest('.directory'))) {
        e.preventDefault();
        showContextMenu(e, targetLi.dataset.id, 'directory', targetLi.dataset.path || '/');
    }
});

document.querySelectorAll('.directory').forEach(dir => {
    dir.addEventListener('dragover', e => e.preventDefault());
    dir.addEventListener('drop', e => {
        e.preventDefault();
        const folderId = dir.dataset.id;
        const file = e.dataTransfer.files[0];
        const formData = new FormData();
        formData.append('file', file);
        formData.append('padre_id', folderId);
        fetch('/mipg/upload', {
            method: 'POST',
            body: formData
        }).then(() => location.reload());
    });
});
</script>

<style>
.file input {
    border: 1px solid #ccc;
    padding: 3px;
    width: 80%;
}

.rename-input {
    padding: 2px 5px;
    font-size: 0.95rem;
    width: 70%;
}
</style>