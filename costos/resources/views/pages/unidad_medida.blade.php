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
                        <h3 class="mb-0">Administrador Unidades de Medidas</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Unidades de Medidas</li>
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
                                    <button class="btn btn-primary btn-sm btn-add-unidades">Agregar Unidad</button>
                                </h3>
                            </div>
                            <div class="card-body">
                               {{--  id, nombre, abreviatura, tipo, es_base --}}
                               <table id="myTable" class="table table-bordered table-striped" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Abreviatura</th>
                                            <th>Tipo</th>
                                            <th>Es Base</th>
											<th style="width: 120px;">Actions</th>
										</tr>
									</thead>
                                    <tbody>
                                        @foreach ($unidades as $element)
                                            <tr>
                                                <td>{{ $element->id }}</td>
                                                <td>{{ $element->nombre }}</td>
                                                <td>{{ $element->abreviatura }}</td>
                                                <td>{{ $element->tipo }}</td>
                                                <td>{{ $element->es_base ? 'Sí' : 'No' }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-sm edit-unidades-btn"
                                                        data-id="{{ $element->id }}"
                                                        data-nombre="{{ $element->nombre }}"
                                                        data-abreviatura="{{ $element->abreviatura }}"
                                                        data-tipo="{{ strtolower($element->tipo) }}"
                                                        data-es_base="{{ $element->es_base ? 1 : 0 }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <a href="#" class="btn btn-danger btn-sm delete-unidades-btn"
                                                        data-id="{{ $element->id }}">
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
        <div class="modal fade" id="addUnidadesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Unidad de Medida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>                    
                    <div class="modal-body">
                        <form action="{{ route('unidad_medida.store') }}" method="POST" id="addUnidadForm" enctype="multipart/form-data" >						
                        @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="abreviatura" class="form-label">Abreviatura</label>
                                <input type="text" class="form-control" id="abreviatura" name="abreviatura" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="masa">Masa</option>
                                    <option value="volumen">Volumen</option>
                                    <option value="unidad">Unidad</option>
                                    <option value="peso">Peso</option>
                                </select>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="hidden" name="es_base" value="0">
                                <input type="checkbox" class="form-check-input" id="es_base" name="es_base" value="1">
                                <label class="form-check-label" for="es_base">Es Base</label>
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
        <div class="modal fade" id="editUnidadesModal" tabindex="-1" aria-labelledby="editUnidadesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUnidadesModalLabel">Editar Unidad de Medida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUnidadesForm" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- campo oculto -->
                            <input type="hidden" id="edit_unidad_id" name="id">

                            <div class="mb-3">
                                <label for="edit_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_abreviatura" class="form-label">Abreviatura</label>
                                <input type="text" class="form-control" id="edit_abreviatura" name="abreviatura" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_tipo" class="form-label">Tipo</label>
                                <select class="form-select" id="edit_tipo" name="tipo" required>
                                    <option value="masa">Masa</option>
                                    <option value="volumen">Volumen</option>
                                    <option value="unidad">Unidad</option>
                                    <option value="peso">Peso</option>
                                </select>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="hidden" name="es_base" value="0">
                                <input type="checkbox" class="form-check-input" id="edit_es_base" name="es_base" value="1">
                                <label class="form-check-label" for="edit_es_base">Es Base</label>
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
        <div class="modal fade" id="deleteUnidadesModal" tabindex="-1" aria-labelledby="deleteUnidadesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUnidadesModalLabel">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <!-- 👇 Aquí ponemos el form completo -->
                    <form id="deleteUnidadesForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar esta unidad de medida?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
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