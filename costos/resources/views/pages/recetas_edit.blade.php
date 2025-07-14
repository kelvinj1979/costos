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
                                <h3 class="card-title">Modificar Recetas</h3>

                            </div>
                            <div class="card-body">
                                <!-- Dentro de tu tabla de recetas -->
                                <div class="container">

                                    <form method="POST" action="{{ route('recetas.update', $receta->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label class="form-label">Nombre de la Receta</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $receta->nombre) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Descripción</label>
                                            <textarea name="descripcion" class="form-control">{{ old('descripcion', $receta->descripcion) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Instrucciones</label>
                                            <textarea name="instrucciones" class="form-control">{{ old('instrucciones', $receta->instrucciones) }}</textarea>
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
                                                @foreach($receta->ingredientes as $i => $detalle)
                                                    <tr>
                                                        <td>
                                                            <select name="ingredientes[{{ $i }}][id]" class="form-select select-ingrediente" required>
                                                                @foreach ($ingredientes as $ingrediente)
                                                                    <option value="{{ $ingrediente->id }}"
                                                                        data-unidad="{{ $ingrediente->unidad_medida }}"
                                                                        @if($ingrediente->id == $detalle->id) selected @endif>
                                                                        {{ $ingrediente->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="ingredientes[{{ $i }}][unidad_medida]" required>
                                                                <option value="">Seleccione una unidad</option>
                                                                <option value="kg" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'kg') ? 'selected' : '' }}>Kilogramo (kg)</option>
                                                                <option value="gr" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'gr') ? 'selected' : '' }}>Gramo (gr)</option>
                                                                <option value="lb" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'lb') ? 'selected' : '' }}>Libra (lb)</option>
                                                                <option value="oz" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'oz') ? 'selected' : '' }}>Onza (oz)</option>
                                                                <option value="lt" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'lt') ? 'selected' : '' }}>Litro (lt)</option>
                                                                <option value="ml" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'ml') ? 'selected' : '' }}>Mililitro (ml)</option>
                                                                <option value="gl" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'gl') ? 'selected' : '' }}>Galon (gl)</option>
                                                                <option value="ud" {{ (old('ingredientes.'.$i.'.unidad_medida', $detalle->unidad_medida ?? $detalle->pivot->unidad_medida ?? $ingredientes->firstWhere('id', $detalle->id)?->unidad_medida) == 'ud') ? 'selected' : '' }}>Unidad (ud)</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="ingredientes[{{ $i }}][cantidad]"
                                                                class="form-control"
                                                                step="0.01"
                                                                value="{{ old('ingredientes.'.$i.'.cantidad', $detalle->pivot->cantidad) }}"
                                                                required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm eliminar-fila">-</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
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