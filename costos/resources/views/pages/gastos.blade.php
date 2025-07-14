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
                        <h3 class="mb-0">Administracion de Gastos Indirectos</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Gastos Indirectos</li>
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
                                {{-- `id`, `descripcion`, `monto`, `periodo_mes`, `periodo_anio`, `unidades_producidas` --}}
                                <h3 class="card-title ">
                                    <button class="btn btn-primary btn-sm btn-add-gastos">Agregar Gastos
                                        Indirectos</button>
                                </h3>

                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>ID</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                            <th>Periodo Mes</th>
                                            <th>Periodo Anio</th>
                                            <th>Unidades Producidas</th>
                                            <th style="width: 120px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($gastos as $gasto)
                                            <tr>
                                                <td>{{ $gasto->id }}</td>
                                                <td>{{ $gasto->descripcion }}</td>
                                                <td>${{ number_format($gasto->monto, 2) }}</td>
                                                <td>{{ $gasto->periodo_mes }}</td>
                                                <td>{{ $gasto->periodo_anio }}</td>
                                                <td>{{ $gasto->unidades_producidas }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm edit-gastos-btn"
                                                        data-id="{{ $gasto->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm delete-gastos-btn"
                                                        data-id="{{ $gasto->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Fin de la tabla -->

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
        
		<!--begin::Modal Add-->
        <div class="modal fade" id="addGastosModal" tabindex="-1" aria-labelledby="addGastoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGastoModalLabel">Agregar Gasto Indirecto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('gastos.store') }}" id="addGastoForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="number" class="form-control" id="monto" name="monto" step="0.01"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="periodo_mes" class="form-label">Periodo Mes</label>
                                <input type="number" class="form-control" id="periodo_mes" name="periodo_mes"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="periodo_anio" class="form-label">Periodo Anio</label>
                                <input type="number" class="form-control" id="periodo_anio" name="periodo_anio"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="unidades_producidas" class="form-label">Unidades Producidas</label>
                                <input type="number" class="form-control" id="unidades_producidas"
                                    name="unidades_producidas" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <!--end::Modal Add-->
		<!--begin::Edit Modal-->
        <div class="modal fade" id="editGastosModal" tabindex="-1" aria-labelledby="editGastoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGastoModalLabel">Editar Gasto Indirecto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editGastosForm" method="POST" action="">
						@csrf
						@method('PUT')
                        <div class="modal-body">
                            <input type="hidden" id="edit_id" name="id">
                            <div class="mb-3">
                                <label for="edit_descripcion" class="form-label">Descripcion</label>
                                <input type="text" class="form-control" id="edit_descripcion" name="descripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_monto" class="form-label">Monto</label>
                                <input type="number" class="form-control" id="edit_monto" name="monto" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_periodo_mes" class="form-label">Periodo Mes</label>
                                <input type="number" class="form-control" id="edit_periodo_mes" name="periodo_mes" required>   
                            </div>
                            <div class="mb-3">
                                <label for="edit_periodo_anio" class="form-label">Periodo Anio</label>
                                <input type="number" class="form-control" id="edit_periodo_anio" name="periodo_anio" required>   
                            </div>
                            <div class="mb-3">
                                <label for="edit_unidades_producidas" class="form-label">Unidades Producidas</label>
                                <input type="number" class="form-control" id="edit_unidades_producidas" name="unidades_producidas" required>    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
        <!--end::Edit Modal-->
		<!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteGastosModal" tabindex="-1" aria-labelledby="deleteGastoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteGastoModalLabel">Eliminar Gasto Indirecto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="deleteGastosForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar este gasto indirecto?</p>
                            <input type="hidden" id="delete_id" name="id">  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" id="confirmDeleteGastosBtn">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>        
        <!--end::Delete Confirmation Modal-->
    </main>
    
@if (Session::has('no-validated'))
    <script>
        notie.alert({
            type: 2,
            text: '{{ session('no-validated') }}',
            time: 6
        });
    </script>

@endif

@if (Session::has('error'))
    <script>
        notie.alert({
            type: 3,
            text: '{{ session('error') }}',
            time: 6
        });
    </script>

@endif

@if (Session::has('success'))
    <script>
        notie.alert({
            type: 1,
            text: '{{ session('success') }}',
            time: 6
        });
    </script>

@endif
@endsection