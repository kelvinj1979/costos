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
                        <h3 class="mb-0">Administrador Materiales Desechables</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Materiales Desechables</li>
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
                                <h3 class="card-title ">
                                    <button class="btn btn-primary btn-sm btn-add-materiales">Agregar Materiales</button>
                                </h3>
                            </div>
                            <div class="card-body">
                               {{--  id, nombre, costo_unitario --}}
                               <table id="myTable" class="table table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Costo Unitario</th>
											<th style="width: 120px;">Actions</th>
										</tr>
									</thead>
                                    <tbody>
                                        @foreach ($materiales as $material)
                                            <tr>
                                                <td>{{ $material->id }}</td>
                                                <td>{{ $material->nombre }}</td>
                                                <td>${{ number_format($material->costo_unitario, 2) }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm edit-materiales-btn"
                                                        data-id="{{ $material->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm delete-materiales-btn"
                                                        data-id="{{ $material->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        <div class="modal fade" id="addMaterialesModal" tabindex="-1" aria-labelledby="addMaterialesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMaterialesModalLabel">Agregar Material Desechable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('materiales.store') }}" method="POST" id="addMaterialesForm" enctype="multipart/form-data" >
						@csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="costo_unitario" class="form-label">Costo Unitario</label>
                                <input type="number" class="form-control" id="costo_unitario" name="costo_unitario" step="0.01" required>
                            </div>   
                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                    
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal Add-->
        <!--begin::Edit Modal-->
        <div class="modal fade" id="editMaterialesModal" tabindex="-1" aria-labelledby="editMaterialesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMaterialesModalLabel">Editar Material Desechable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body  ">
                        <form id="editMaterialesForm" method="POST" action="">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="edit_material_id">
                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_costo_unitario" class="form-label">Costo Unitario</label>
                                <input type="number" class="form-control" id="edit_costo_unitario" name="costo_unitario" step="0.01" required>
                            </div>   
                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                    
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <!--end::Edit Modal-->
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteMaterialesModal" tabindex="-1" aria-labelledby="deleteMaterialesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteMaterialesModalLabel">Eliminar Material Desechable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar este material desechable?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteMaterialesBtn">Eliminar</button>
                        <form id="deleteMaterialesForm" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
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