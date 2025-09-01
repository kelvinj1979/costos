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
							<h3 class="mb-0">Administrador de Ingredientes</h3>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-end">
								<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">ingredientes</li>
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
										<button class="btn btn-primary btn-sm btn-add-ingrediente">Agregar Ingrediente</button>
									</h3>
								</div>
								<div class="card-body">
									<table id="myTable" class="table table-bordered table-striped" width="100%">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nombre</th>
												<th>Unidad de Medida</th>
												<th>Densidad</th>
												<th>Costo Unitario</th>
												<th style="width: 120px;">Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($ingredientes as $element)
												<tr>
													<td>{{ $element->id }}</td>
													<td>{{ $element->nombre }}</td>
													<td>{{ $element->unidadMedida->abreviatura }}</td>
													<td>{{ $element->densidad ?? 'N/A' }}</td\>
													<td>${{ number_format($element->costo_unitario, 4) }}</td>
													<td>														
														<a href="#" class="btn btn-primary btn-sm edit-ingredientes-btn"
															data-id="{{ $element->id }}"
															data-nombre="{{ $element->nombre }}"
															data-unidad_medida_id="{{ $element->unidad_medida_id }}"
															data-costo_unitario="{{ $element->costo_unitario }}"
															data-densidad="{{ $element->densidad }}"
															data-unidad_id="{{ $element->unidad_medida_id }}">
															<i class="bi bi-pencil"></i>
														</a>
														<a href="#" class="btn btn-danger btn-sm delete-ingredientes-btn"
															data-id="{{ $element->id }}">
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
			<div class="modal fade" id="addIngredienteModal" tabindex="-1" aria-labelledby="addIngredienteModalLabel"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="addIngredienteModalLabel">Agregar Ingrediente</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<!-- Formulario para agregar ingrediente -->
							<form action="{{ route('ingredientes.store') }}" method="POST" enctype="multipart/form-data" >
								@csrf
								<div class="mb-3">
									<label for="nombre" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" required>
								</div>
								<div class="mb-3">
									<label for="unidad_medida_id" class="form-label">Unidad de Medida</label>
									<select class="form-control" id="unidad_medida_id" name="unidad_medida_id" required>
										<option value="">Seleccione una unidad</option>
										@foreach($unidadesMedida as $unidad)
											<option value="{{ $unidad->id }}">{{ $unidad->nombre }} ({{ $unidad->abreviatura }})</option>
										@endforeach
									</select>
								</div>
								<div class="mb-3">
									<label for="densidad" class="form-label">Densidad (g/ml)</label>
									<input type="number" class="form-control" id="densidad" name="densidad" step="0.0001" placeholder="Solo si aplica">
								</div>
								<div class="mb-3">
									<label for="costo_unitario" class="form-label">Costo Unitario</label>
									<input type="number" class="form-control" id="costo_unitario" name="costo_unitario"
										step="0.0001" required>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end::Modal Add-->
			<!--begin::Edit Modal-->
			<div class="modal fade" id="editIngredienteModal" tabindex="-1" aria-labelledby="editIngredienteModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editIngredienteModalLabel">Editar Ingrediente</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<!-- Formulario para editar ingrediente -->
							<form id="editIngredienteForm" method="POST" action="">
							@csrf
							@method('PUT')
							<input type="hidden" id="edit_id" name="id">
							<div class="mb-3">
									<label for="edit_nombre" class="form-label">Nombre</label>
									<input type="text" class="form-control" id="edit_nombre" name="nombre" required>
								</div>
								<div class="mb-3">
									<label for="edit_unidad_medida_id" class="form-label">Unidad de Medida</label>
									<select class="form-control" id="edit_unidad_medida_id" name="unidad_medida_id" required>
										<option value="">Seleccione una unidad</option>
										@foreach($unidadesMedida as $unidad)
											<option value="{{ $unidad->id }}">{{ $unidad->nombre }} ({{ $unidad->abreviatura }})</option>
										@endforeach
									</select>
								</div>
								<div class="mb-3">
									<label for="edit_densidad" class="form-label">Densidad (g/ml)</label>
									<input type="number" class="form-control" id="edit_densidad" name="densidad" step="0.0001" placeholder="Solo si aplica">
								</div>									
								<div class="mb-3">
									<label for="edit_costo_unitario" class="form-label">Costo Unitario</label>
									<input type="number" class="form-control" id="edit_costo_unitario" name="costo_unitario"
										step="0.0001" required>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--end::Edit Modal-->
			<!-- Delete Confirmation Modal -->
			<div class="modal fade" id="deleteIngredienteModal" tabindex="-1" aria-labelledby="deleteIngredienteModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="deleteIngredienteModalLabel">Confirmar Eliminación</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<p>¿Estás seguro de que deseas eliminar este ingrediente?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							<button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
						</div>
						<form id="deleteIngredienteForm" method="POST" style="display:none;">
							@csrf
							@method('DELETE')						
						</form>
					</div>
				</div>	
			</div>
			<!--end::Delete Confirmation Modal-->
			 
        </div>

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