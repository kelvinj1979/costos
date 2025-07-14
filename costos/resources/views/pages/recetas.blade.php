@extends('layout')
@section('content')

	<main class="app-main">
		<!--begin::App Content Header-->
		<div class="app-content-header">
		  <!--begin::Container-->
		  <div class="container-fluid">
			<!--begin::Row-->
			<div class="row">
			  <div class="col-sm-6"><h3 class="mb-0">Recetas Layout</h3></div>
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
					<h3 class="card-title">
						 <a href="{{ route('recetas.create') }}" class="btn btn-primary btn-sm">Agregar Receta</a>
					</h3>

				  </div>
				  <div class="card-body">
					<table id="myTable" class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre Receta</th>                               
								<th>Descripción</th>
								<th>Detalle</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($recetas as $receta)
							<tr>
								<td>{{ $receta->id }}</td>
								<td>{{ $receta->nombre }}</td>
								<td>{{ $receta->descripcion }}</td>
							    <td>
									<button type="button" class="btn btn-link btn-toggle-detalle" title="Ver ingredientes">
										<i class="bi bi-plus-circle"></i>
									</button>
									<div class="detalle-ingredientes" style="display:none; margin-top:5px;">
										<ol class="list-group list-group-numbered">
											@foreach($receta->ingredientes as $ing)
												<li class="list-group-item">
													{{ $ing->nombre }} ({{ $ing->pivot->cantidad }} {{ !empty($ing->pivot->unidad_medida) ? $ing->pivot->unidad_medida : $ing->unidad_medida }})
												</li>
											@endforeach
										</ol>
									</div>
								</td> 
								<td>
									<a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-primary btn-sm edit-receta-btn">
										<i class="bi bi-pencil"></i>
									</a>
									<a href="#" class="btn btn-danger btn-sm delete-receta-btn" data-id="{{ $receta->id }}">
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
		<!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteRecetaModal" tabindex="-1" aria-labelledby="deleteRecetaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRecetaModalLabel">Eliminar Receta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="deleteRecetaForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>¿Estás seguro de que deseas eliminar este Receta?</p>
                            <input type="hidden" id="delete_id" name="id">  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" id="confirmDeleteRecetaBtn">Eliminar</button>
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