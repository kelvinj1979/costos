// This function is triggered when the form in the edit modal is submitted.
// It checks if the password and confirmation password match.
function validatePasswords(form) {
    var pass = form.find('#password').val();
    var confirm = form.find('#password_confirmation').val();
    if (pass !== confirm) {
        alert('Passwords do not match');
        return false;
    }
    return true;
}

$('#editUser form, #addUserModal form').on('submit', function(e) {
    if (!validatePasswords($(this))) {
        e.preventDefault();
    }
});

// This is a JavaScript file that initializes Summernote and Bootstrap dropdowns
// when the document is ready.
$(document).ready(function() {
        $(".mySummernote").summernote();
        $('.dropdown-toggle').dropdown();
        // Inicializa DataTable
        $('#myTable').DataTable({
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            }
        });
    });

// Mostrar preview de imagen seleccionada en el modal de editar usuario
$(document).on('change', '#editUser input[type="file"][name="photo"]', function() {
    var file = this.files[0];
    if (file && file.type.match(/^image\/(jpeg|png|jpg)$/)) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#edit_photo_preview').attr('src', e.target.result).show();
            $('#no_photo_text').hide();
        };
        reader.readAsDataURL(file);
    } else {
        $('#edit_photo_preview').hide();
        $('#no_photo_text').show();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Mostrar modal de agregar ingrediente
    document.querySelectorAll('.btn-add-ingrediente').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('addIngredienteModal'));
            modal.show();
        });
    });

    // Mostrar modal de agregar usuario
    document.querySelectorAll('.btn-add-user').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('addUserModal'));
            modal.show();
        });
    });

     // Mostrar modal de agregar materiales
    document.querySelectorAll('.btn-add-materiales').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('addMaterialesModal'));
            modal.show();
        });
    });

    //Mostrar modal de agregar Gastos
    document.querySelectorAll('.btn-add-gastos').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('addGastosModal'));
            modal.show();
        });
    });

    // Mostrar modal de editar ingredientes
    document.querySelectorAll('.edit-ingredientes-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const id = btn.dataset.id;
        const unidadId = btn.dataset.unidad_id;

        document.getElementById('editIngredienteForm').action = baseUrl + '/ingredientes/' + id;
        document.getElementById('edit_id').value = id;

        const row = btn.closest('tr');
        document.getElementById('edit_nombre').value = row.children[1].textContent.trim();
       // document.getElementById('edit_unidad_medida_id').value = unidadId; // 👈 aquí seleccionamos el option correcto
        // 👇 aquí seleccionamos la opción correcta del select
        const selectUnidad = document.getElementById('edit_unidad_medida_id');
        if (selectUnidad) {
            selectUnidad.value = unidadId;
        }
        document.getElementById('edit_densidad').value = row.children[3].textContent.trim();
        document.getElementById('edit_costo_unitario').value = row.children[4].textContent.replace('$', '').trim();
        

        const modal = new bootstrap.Modal(document.getElementById('editIngredienteModal'));
        modal.show();
    });
});


    // Mostrar modal de editar Materiales
    document.querySelectorAll('.edit-materiales-btn').forEach(btn => { 
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const id = btn.dataset.id;
            // Usa la ruta base correcta
            document.getElementById('editMaterialesForm').action = baseUrl + '/materiales/' + id;
            const row = btn.closest('tr');
            document.getElementById('edit_material_id').value = btn.dataset.id;
            document.getElementById('edit_nombre').value = row.children[1].textContent.trim();
            document.getElementById('edit_costo_unitario').value = row.children[2].textContent.replace('$', '').trim();

            document.getElementById('editMaterialesForm').action = window.baseUrl + '/materiales/' + id;
            const modal = new bootstrap.Modal(document.getElementById('editMaterialesModal'));  
            modal.show();
        });
    });

    // Mostrar modal de editar Gastos
    document.querySelectorAll('.edit-gastos-btn').forEach(btn => {  
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const id = btn.dataset.id;
            // Usa la ruta base correcta
            document.getElementById('editGastosForm').action = baseUrl + '/gastos/' + id;
            const row = btn.closest('tr');
            document.getElementById('edit_id').value = btn.dataset.id;
            document.getElementById('edit_descripcion').value = row.children[1].textContent.trim();
            document.getElementById('edit_monto').value = row.children[2].textContent.replace('$', '').trim();
            document.getElementById('edit_periodo_mes').value = row.children[3].textContent.trim();
            document.getElementById('edit_periodo_anio').value = row.children[4].textContent.trim();
            document.getElementById('edit_unidades_producidas').value = row.children[5].textContent.trim();

            document.getElementById('editGastosForm').action = window.baseUrl + '/gastos/' + id;
            const modal = new bootstrap.Modal(document.getElementById('editGastosModal'));  
            modal.show();
        });
    });



    // Mostrar modal de eliminar ingrediente
    document.querySelectorAll('.delete-ingredientes-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('confirmDeleteBtn').setAttribute('data-id', btn.dataset.id);
            const modal = new bootstrap.Modal(document.getElementById('deleteIngredienteModal'));
            modal.show();
        });
    });

    // Mostrar modal de eliminar materiales
    document.querySelectorAll('.delete-materiales-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('confirmDeleteMaterialesBtn').setAttribute('data-id', btn.dataset.id);
            const modal = new bootstrap.Modal(document.getElementById('deleteMaterialesModal'));
            modal.show();
        });
    });

    // Mostrar modal de eliminar gastos
    document.querySelectorAll('.delete-gastos-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('confirmDeleteGastosBtn').setAttribute('data-id', btn.dataset.id);
            const modal = new bootstrap.Modal(document.getElementById('deleteGastosModal'));
            modal.show();
        });
    });

    // Mostrar modal de eliminar receta
    document.querySelectorAll('.delete-receta-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('confirmDeleteRecetaBtn').setAttribute('data-id', btn.dataset.id);
            const modal = new bootstrap.Modal(document.getElementById('deleteRecetaModal'));
            modal.show();
        });
    });

    // Mostrar modal de eliminar producto
    document.querySelectorAll('.delete-producto-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const id = btn.dataset.id;
            const form = document.getElementById('deleteProductoForm');
            form.action = window.baseUrl + '/productos/' + id;
            document.getElementById('delete_id').value = id;
            const modal = new bootstrap.Modal(document.getElementById('deleteProductoModal'));
            modal.show();
        });
    });

    // Acción al confirmar eliminación (puedes hacer submit de un formulario o AJAX)
    document.getElementById('confirmDeleteBtn')?.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.getElementById('deleteIngredienteForm');
        form.action = window.baseUrl + '/ingredientes/' + id;
        form.submit();
    });    

    // Acción al confirmar eliminación de materiales
    document.getElementById('confirmDeleteMaterialesBtn')?.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.getElementById('deleteMaterialesForm');
        form.action = window.baseUrl + '/materiales/' + id;
        form.submit();
    });

    // Acción al confirmar eliminación de gastos
    document.getElementById('confirmDeleteGastosBtn')?.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.getElementById('deleteGastosForm');
        form.action = window.baseUrl + '/gastos/' + id;
        form.submit();
    });

    //Acción al confirmar eliminación de receta
    document.getElementById('confirmDeleteRecetaBtn')?.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.getElementById('deleteRecetaForm');
        form.action = window.baseUrl + '/recetas/' + id;
        form.submit();
    });

    // Acción al confirmar eliminación de producto
    document.getElementById('confirmDeleteProductoBtn')?.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const form = document.getElementById('deleteProductoForm');
        form.action = window.baseUrl + '/productos/' + id;
        form.submit();
    });

    // Mostrar modal de editar usuario con datos por AJAX
    $(document).on('click', '.edit-users-btn', function(e) {
        e.preventDefault();
        var userId = $(this).data('id');
        // Cambia la URL según tu ruta para obtener el usuario en JSON
        $.get(window.baseUrl + '/usuarios/' + userId + '/json', function(data) {
            // Rellena los campos del modal
            $('#editUsuarioForm').attr('action', window.baseUrl + '/usuarios/' + userId);
            $('#edit_user_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_email').val(data.email);
            $('#edit_role').val(data.role);

            if (data.photo) {
                $('#edit_photo_preview').attr('src', window.baseUrl + '/' + data.photo).show();
                $('#no_photo_text').hide();
                $('#actual_photo').val(data.photo);
            } else {
                $('#edit_photo_preview').hide();
                $('#no_photo_text').show();
                $('#actual_photo').val('');
            }

            // Muestra el modal
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();
        });
    });

    // Mostrar preview de imagen seleccionada en el modal de editar usuario
    $(document).on('change', '#editUserModal input[type="file"][name="photo"]', function() {
        var file = this.files[0];
        if (file && file.type.match(/^image\/(jpeg|png|jpg)$/)) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#edit_photo_preview').attr('src', e.target.result).show();
                $('#no_photo_text').hide();
            };
            reader.readAsDataURL(file);
        } else {
            $('#edit_photo_preview').hide();
            $('#no_photo_text').show();
        }
    });

    let selectedUserId = null;    

    // Mostrar modal de eliminar usuario    
    $(document).on('click', '.delete-users-btn', function(e) {
        e.preventDefault();
        selectedUserId = $(this).data('id');

        // Actualiza el action del formulario de eliminación
        const deleteForm = $('#deleteUserForm');
        deleteForm.attr('action', window.baseUrl + '/usuarios/' + selectedUserId);

        // Actualiza el token CSRF en el formulario
        deleteForm.find('input[name="_token"]').val(
            $('meta[name="csrf-token"]').attr('content')
        );

        // Muestra el modal de confirmación
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    });


    // Proceso para agregar detalle de recetas
    // Verifica si la tabla de ingredientes y el botón de agregar fila existen
    const tablaWrapper = document.getElementById('tabla-ingredientes');
    const agregarBtn = document.getElementById('agregar-fila');

    if (tablaWrapper && agregarBtn) {
        const tabla = tablaWrapper.getElementsByTagName('tbody')[0];

        agregarBtn.addEventListener('click', function () {
            const rowCount = tabla.rows.length;
            const nuevaFila = tabla.rows[0].cloneNode(true);

            nuevaFila.querySelectorAll('select, input').forEach(function (el) {
                if (el.name) {
                    el.name = el.name.replace(/\[\d+\]/, '[' + rowCount + ']');
                }
                el.value = '';
            });

            // Evento para el select de ingrediente en la nueva fila
            const selectIng = nuevaFila.querySelector('.select-ingrediente');
            if (selectIng) {
                selectIng.addEventListener('change', function() {
                    actualizarUnidad(this);
                });
                actualizarUnidad(selectIng);
            }

            // Evento eliminar fila
            const eliminarBtn = nuevaFila.querySelector('.eliminar-fila');
            if (eliminarBtn) {
                eliminarBtn.addEventListener('click', function () {
                    this.closest('tr').remove();
                });
            }

            tabla.appendChild(nuevaFila);
        });

        // Evento eliminar para la primera fila
        const eliminarBtn = tabla.querySelector('.eliminar-fila');
        if (eliminarBtn) {
            eliminarBtn.addEventListener('click', function () {
                this.closest('tr').remove();
            });
        }

        // Inicializa unidad de medida en selects existentes
        tabla.querySelectorAll('.select-ingrediente').forEach(function(select) {
            actualizarUnidad(select);
            select.addEventListener('change', function() {
                actualizarUnidad(this);
            });
        });
    }

     // Verifica si la tabla de Desechable y el botón de agregar fila existen
    const tablaDesWrapper = document.getElementById('tabla-desechables');
    const agregarBtnDes = document.getElementById('agregar-fila-des');

    if (tablaDesWrapper && agregarBtnDes) {
        const tabla = tablaDesWrapper.getElementsByTagName('tbody')[0];

        agregarBtnDes.addEventListener('click', function () {
            const rowCountDes = tabla.rows.length;
            const nuevaFilaDes = tabla.rows[0].cloneNode(true);

            nuevaFilaDes.querySelectorAll('select, input').forEach(function (el) {
                if (el.name) {
                    el.name = el.name.replace(/\[\d+\]/, '[' + rowCountDes + ']');
                }
                el.value = '';
            });

            // Evento para el select de desechable en la nueva fila
            const selectIngDes = nuevaFilaDes.querySelector('.select-desechable');
            if (selectIngDes) {
                selectIngDes.addEventListener('change', function() {
                    actualizarUnidad(this);
                });
                actualizarUnidad(selectIngDes);
            }

            // Evento eliminar fila
            const eliminarBtnDes = nuevaFilaDes.querySelector('.eliminar-fila-des');
            if (eliminarBtnDes) {
                eliminarBtnDes.addEventListener('click', function () {
                    this.closest('tr').remove();
                });
            }

            tabla.appendChild(nuevaFilaDes);
        });

        // Evento eliminar para la primera fila
        const eliminarBtnDes = tabla.querySelector('.eliminar-fila-des');
        if (eliminarBtnDes) {
            eliminarBtnDes.addEventListener('click', function () {
                this.closest('tr').remove();
            });
        }

        // Inicializa unidad de medida en selects existentes
        tabla.querySelectorAll('.select-desechable').forEach(function(select) {
            actualizarUnidad(select);
            select.addEventListener('change', function() {
                actualizarUnidad(this);
            });
        });
    }


    // Función para actualizar unidad de medida
    function actualizarUnidad(select) {
        const selected = select.options[select.selectedIndex];
        const unidad = selected ? selected.getAttribute('data-unidad') : '';
        const inputUnidad = select.closest('tr').querySelector('.unidad-medida');
        if (inputUnidad) inputUnidad.value = unidad || '';
    }

    // Mostrar/ocultar detalle de ingredientes
    
    document.querySelectorAll('.btn-toggle-detalle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const detalle = this.closest('td').querySelector('.detalle-ingredientes');
            if (detalle.style.display === 'none') {
                detalle.style.display = 'block';
                this.querySelector('i').classList.remove('bi-plus-circle');
                this.querySelector('i').classList.add('bi-dash-circle');
            } else {
                detalle.style.display = 'none';
                this.querySelector('i').classList.remove('bi-dash-circle');
                this.querySelector('i').classList.add('bi-plus-circle');
            }
        });
    });
    
});





