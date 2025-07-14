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
							<h3 class="mb-0">Unfixed Layout</h3>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-end">
								<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
									<h3 class="card-title">Title</h3>

								</div>
								<div class="card-body">
									<div class="container">
										<h1 class="mb-4">Dashboard de Costos</h1>

										<div class="row mb-4">
											<div class="col-md-3">
												<div class="card text-white bg-primary">
													<div class="card-body">
														<h5>Total Productos</h5>
														<h2>{{ $totalProductos }}</h2>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="card text-white bg-success">
													<div class="card-body">
														<h5>Margen Promedio</h5>
														<h2>{{ number_format($margenPromedio, 2) }}%</h2>
													</div>
												</div>
											</div>
										</div>

										<h3 class="mt-4">Top 5 Productos Más Rentables</h3>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Producto</th>
													<th>Costo Total</th>
													<th>Precio Venta</th>
													<th>Ganancia</th>
													<th>Margen (%)</th>
												</tr>
											</thead>
											<tbody>
												@foreach($productosTop as $producto)
													<tr>
														<td>{{ $producto->nombre }}</td>
														<td>${{ number_format($producto->costo_total, 2) }}</td>
														<td>${{ number_format($producto->precio_venta, 2) }}</td>
														<td>${{ number_format($producto->ganancia, 2) }}</td>
														<td>{{ number_format($producto->margen, 2) }}%</td>
													</tr>
												@endforeach
											</tbody>
										</table>

										<h3 class="mt-4 text-danger">Productos con Bajo Margen (menos del 10%)</h3>
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Producto</th>
													<th>Margen (%)</th>
												</tr>
											</thead>
											<tbody>
												@forelse($productosBajoMargen as $producto)
													<tr>
														<td>{{ $producto->nombre }}</td>
														<td class="text-danger">{{ number_format($producto->margen, 2) }}%</td>
													</tr>
												@empty
													<tr>
														<td colspan="2" class="text-center">Todos los productos tienen buen margen.
														</td>
													</tr>
												@endforelse
											</tbody>
										</table>



										<h3 class="mt-5">Distribución Promedio de Costos</h3>
										<canvas id="graficoCostos" width="400" height="400" style="max-width:400px;max-height:400px;"></canvas>

										<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

										<script>
											const ctx = document.getElementById('graficoCostos').getContext('2d');
											const graficoCostos = new Chart(ctx, {
												type: 'pie',
												data: {
													labels: ['Ingredientes', 'Mano de Obra', 'Material Desechable', 'Gastos Indirectos'],
													datasets: [{
														label: 'Distribución de Costos',
														data: [
															{{ $distribucionCostos['ingredientes'] }},
															{{ $distribucionCostos['mano_obra'] }},
															{{ $distribucionCostos['material_desechable'] }},
															{{ $distribucionCostos['gastos_indirectos'] }}
														],
														backgroundColor: [
															'rgba(255, 99, 132, 0.7)',
															'rgba(54, 162, 235, 0.7)',
															'rgba(255, 206, 86, 0.7)',
															'rgba(75, 192, 192, 0.7)'
														],
														borderWidth: 1
													}]
												},
												options: {
													responsive: true
												}
											});
										</script>
										
										<h3 class="mt-5">Resumen de Costos por Producto</h3>

										<table class="table table-bordered table-striped">
											<thead class="thead-dark">
												<tr>
													<th>Producto</th>
													<th>Ingredientes</th>
													<th>Desechables</th>
													<th>Mano de Obra</th>
													<th>Gastos Indirectos</th>
													<th>Total Costo</th>
													<th>Precio Venta</th>
													<th>Ganancia</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($resumenCostos as $item)
														<tr>
															<td>{{ $item->nombre }}</td>
															<td>${{ number_format($item->ingredientes, 2) }}</td>
															<td>${{ number_format($item->desechables, 2) }}</td>
															<td>${{ number_format($item->mano_obra, 2) }}</td>
															<td>${{ number_format($item->gastos_indirectos, 2) }}</td>
															<td>
																${{ number_format(
														$item->ingredientes + $item->desechables + $item->mano_obra + $item->gastos_indirectos,
														2
													) }}
															</td>
															<td>${{ number_format($item->precio_venta, 2) }}</td>
															<td>${{ number_format($item->ganancia, 2) }}</td>
														</tr>
												@endforeach
											</tbody>
										</table>

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