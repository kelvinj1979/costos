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
                        <h3 class="mb-0">Administracion de Usuarios</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
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
                            <div class="card-header text-end">
                                <h3 class="card-title">
                                    <button class="btn btn-primary btn-sm btn-add-user">Agregar Usuarios</button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table id="myTable" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Foto</th>
                                            <th style="width: 120px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)
                                            <tr>
                                                <td>{{ $usuario->id }}</td>
                                                <td>{{ $usuario->name }}</td>
                                                <td>{{ $usuario->email }}</td>
                                                <td>
                                                    @if ($usuario->role == 'admin')
                                                        <span class="badge bg-primary">Admin</span>
                                                    @elseif ($usuario->role == 'editor')
                                                        <span class="badge bg-warning">Editor</span>
                                                    @else
                                                        <span class="badge bg-secondary">User</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($usuario->photo)
                                                        <img src="{{ url($usuario->photo) }}"
                                                            class="img-fluid rounded-circle mx-auto d-block" alt="User Photo"
                                                            width="50">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Aquí puedes agregar botones para editar o eliminar -->
                                                    <a href="#" class="btn btn-primary btn-sm edit-users-btn"
                                                        data-id="{{ $usuario->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm delete-users-btn"
                                                        data-id="{{ $usuario->id }}">
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

        <!--begin::Modal-->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Formulario para agregar usuario -->
                        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" autocomplete="new-password"
                                    placeholder="Confirm password" id="password_confirmation" name="password_confirmation"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rol</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="photo" class="form-label">Foto de Perfil</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->

        <!--begin::Edit Modal-->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editUsuarioForm" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="id" id="edit_user_id">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter Password min 8 characters" autocomplete="off" id="password"
                                    name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                                @enderror

                            </div>
                            <input type="hidden" name="actual_password" id="actual_password"
                                value="{{ $usuario->password }}">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm password"
                                    id="password_confirmation" name="password_confirmation">
                            </div>
                            <div class="mb-3">
                                <label for="edit_role" class="form-label">Rol</label>
                                <select class="form-select" id="edit_role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="mb-3 text-center">
                                <label for="photo" class="form-label">Foto</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                <br>
                                <img id="edit_photo_preview" src="" alt="Preview" style="max-width:100px; display:none;">
                                <span id="no_photo_text" style="display:none;">No Photo</span>
                                <input type="hidden" name="actual_photo" id="actual_photo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Edit Modal-->

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteConfirmLabel">Confirmar eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que quieres eliminar a este usuario? Esta acción no se puede deshacer.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="deleteUserForm" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Si, Eliminar</button>
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