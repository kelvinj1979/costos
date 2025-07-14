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
                        <h3 class="mb-0">Recetas Layout</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Recetas</li>
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
                                <h3 class="card-title">Crear Recetas</h3>

                            </div>
                            <div class="card-body">
                                <!-- Dentro de tu tabla de recetas -->
                                <div class="container">

                                    <form method="POST" action="{{ route('recetas.store') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">Nombre de la Receta</label>
                                            <input type="text" name="nombre" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Descripción</label>
                                            <textarea name="descripcion" class="form-control"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Instrucciones</label>
                                            <textarea name="instrucciones" class="form-control"></textarea>
                                        </div>

                                        <h4>Ingredientes</h4>
                                        <table class="table table-bordered" id="tabla-ingredientes">
                                            <thead>
                                                <tr>
                                                    <th>Ingrediente</th>
                                                    <th>Unidad de Medida</th>
                                                    <th>Cantidad</th>
                                                    <th><button type="button" class="btn btn-success btn-sm"
                                                            id="agregar-fila">+</button></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="ingredientes[0][id]" class="form-select select-ingrediente"
                                                            required>
                                                            @foreach ($ingredientes as $ingrediente)
                                                                <option value="{{ $ingrediente->id }}"
                                                                    data-unidad="{{ $ingrediente->unidad_medida }}">
                                                                    {{ $ingrediente->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="ingredientes[0][unidad_medida]" class="form-control" required>
                                                            <option value="">Seleccione una unidad</option>
                                                            <option value="kg">Kilogramo (kg)</option>
                                                            <option value="gr">Gramo (gr)</option>
                                                            <option value="lb">Libra (lb)</option>
                                                            <option value="oz">Onza (oz)</option>
                                                            <option value="lt">Litro (lt)</option>
                                                            <option value="ml">Mililitro (ml)</option>
                                                            <option value="gl">Galon (gl)</option>
                                                            <option value="ud">Unidad (ud)</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="ingredientes[0][cantidad]"
                                                            class="form-control" step="0.01" required>
                                                    </td>
                                                    <td><button type="button"
                                                            class="btn btn-danger btn-sm eliminar-fila">-</button></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-primary">Guardar Receta</button>
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