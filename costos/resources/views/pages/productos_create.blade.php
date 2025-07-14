@extends('layout')
@section('content')

    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Productos Layout</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Productos</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Crear Productos</h3>

                            </div>
                            <div class="card-body">
                                <div class="container">

                                    <form method="POST" action="{{ route('productos.store') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Nombre del producto</label>
                                            <input type="text" name="nombre" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Porcentaje (%)</label>
                                            <div class="input-group">
                                                <select class="form-select" id="porcentaje-select" name="porcentaje_select">
                                                    <option value="">Seleccione un porcentaje</option>
                                                    @for ($i = 10; $i <= 100; $i += 10)
                                                        <option value="{{ $i }}">{{ $i }}%</option>
                                                    @endfor
                                                </select>
                                                <input type="number" min="1" max="100" step="0.01" class="form-control"
                                                    id="porcentaje-input" name="porcentaje_input" placeholder="Otro valor">
                                            </div>
                                            <small class="form-text text-muted">Seleccione un porcentaje o escriba uno
                                                personalizado.</small>
                                        </div>

                                        <h4>Recetas</h4>
                                        <table class="table table-bordered" id="tabla-ingredientes">
                                            <thead>
                                                <tr>
                                                    <th>Recetas</th>
                                                    <th>Cantidad</th>
                                                    <th><button type="button" class="btn btn-success btn-sm"
                                                            id="agregar-fila">+</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="recetas[0][id]" class="form-select select-recetas"
                                                            required>
                                                            <option value="">Seleccione una receta</option>
                                                            @foreach ($recetas as $receta)
                                                                <option value="{{ $receta->id }}">
                                                                    {{ $receta->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="recetas[0][cantidad]"
                                                            class="form-control" step="0.01" required>
                                                    </td>
                                                    <td><button type="button"
                                                            class="btn btn-danger btn-sm eliminar-fila">-</button></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h4>Desechables</h4>
                                        <table class="table table-bordered" id="tabla-desechables">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th><button type="button" class="btn btn-success btn-sm"
                                                            id="agregar-fila-des">+</button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="materiales[0][id]" class="form-select select-materiales"
                                                            required>
                                                            <option value="">Seleccione un desechable</option>
                                                            @foreach ($materiales as $material)
                                                                <option value="{{ $material->id }}">
                                                                    {{ $material->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="materiales[0][cantidad]"
                                                            class="form-control" step="0.01" required>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm eliminar-fila-des">-</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <h4>Mano de Obra</h4>
                                        <table class="table table-bordered" id="tabla-mano-obra">
                                            <thead>
                                                <tr>
                                                    <th>Minutos</th>
                                                    <th>Costo x Hora</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="number" name="mdobra[0][tiempo_minutos]"
                                                            class="form-control" step="0.01" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="mdobra[0][costo_por_hora]"
                                                            class="form-control" step="0.01" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-primary">Guardar Productos</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">Footer</div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
        <!--end::App Content-->
    </main>
@endsection

<script>
    // Opcional: Si selecciona un valor del select, lo pone en el input
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('porcentaje-select');
        const input = document.getElementById('porcentaje-input');
        select.addEventListener('change', function() {
            if (this.value) {
                input.value = this.value;
            } else {
                input.value = '';
            }
        });
    });
</script>