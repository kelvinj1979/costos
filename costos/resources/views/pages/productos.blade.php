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
                                    <h3 class="card-title">
                                        <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm">Crear 
                                            Producto</a>
                                    </h3>

                                </div>
                                <div class="card-body">
                                    <table id="myTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Producto</th>
                                                <th>Costo</th>
                                                <th>Precio Venta</th>
                                                <th>Ganancia</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    <td>{{ $producto->id}}</td>
                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>${{ number_format($producto->costo, 2) }}</td>
                                                    <td>${{ number_format($producto->precio_venta, 2) }}</td>
                                                    <td>${{ number_format($producto->ganancia, 2) }}</td>
                                                    <td>
                                                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary btn-sm edit-receta-btn">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm delete-producto-btn" data-id="{{ $producto->id }}">
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
            <div class="modal fade" id="deleteProductoModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="deleteProductoForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar este producto?</p>
                                <input type="hidden" id="delete_id" name="id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" id="confirmDeleteProductoBtn">Eliminar</button>
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