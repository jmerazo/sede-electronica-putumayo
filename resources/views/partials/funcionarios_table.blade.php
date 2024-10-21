<div class="search-container mb-3">
    <label for="show">Mostrar</label>
    <select id="show" class="form-select form-select-sm" style="width: auto;">
        <option>10</option>
        <option>20</option>
        <option>50</option>
    </select>
    <div class="input-group">
        <input type="text" class="form-control form-control-sm" placeholder="Buscar..." aria-label="Buscar">
        <button class="btn btn-primary btn-sm" type="button">
            <i class="fas fa-search"></i>
        </button>
    </div>
</div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cargo</th>
            <th>Dependencias</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->nombres }}</td>
                <td>{{ $item->apellidos }}</td>
                <td>{{ $item->cargo }}</td>
                <td>{{ $item->dependencias }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
@if ($data->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $data->appends(request()->input())->links('vendor.pagination.custom') }}
</div>
@endif
