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
            <th>Numero Contrato</th>
            <th>Nombres Apellidos</th>
            <th>Email</th>
            <th>Experiencia Laboral</th>
            
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Valor Contrato</th>
            <th>valor Mensual</th>
            <th>Dependencia</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->no_contract }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->work_experiencie }}</td>
                
                <td>{{ $item->date_start }}</td>
                <td>{{ $item->date_end }}</td>
                <td>{{ $item->cantract_value }}</td>
                <td>{{ $item->monthly_value }}</td>
                <td>{{ $item->dependencia }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginación -->
<div class="mt-4 d-flex justify-content-center">
    {{ $data->appends(request()->input())->links('vendor.pagination.custom') }}
</div>

