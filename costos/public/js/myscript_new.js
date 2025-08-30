// Script JavaScript para la gestión de modales, formularios y eventos.
// Utiliza jQuery, Bootstrap y DataTables.

// -----------------------------------------------------------------------------
// Función para mostrar una ventana modal de mensaje
// En lugar de usar 'alert()', que interrumpe la experiencia del usuario,
// se muestra un modal personalizado.
// Se asume que el HTML para este modal existe en la página.
// Ejemplo: <div id="custom-message-modal" class="modal fade">...</div>
function showMessageModal(message, title = 'Atención') {
  $('#custom-message-modal-title').text(title);
  $('#custom-message-modal-body').text(message);
  const modal = new bootstrap.Modal(document.getElementById('custom-message-modal'));
  modal.show();
}

// -----------------------------------------------------------------------------
// Función de validación de contraseñas
// Se ejecuta al enviar un formulario de usuario.
// Llama a showMessageModal() si las contraseñas no coinciden.
function validatePasswords(form) {
  const pass = form.find('#password').val();
  const confirm = form.find('#password_confirmation').val();
  if (pass !== confirm) {
    showMessageModal('Las contraseñas no coinciden');
    return false;
  }
  return true;
}

// -----------------------------------------------------------------------------
// Lógica principal: Se ejecuta cuando el DOM está completamente cargado.
$(document).ready(function() {
  // Inicialización de Summernote, Bootstrap Dropdowns y DataTables.
  $(".mySummernote").summernote();
  $('.dropdown-toggle').dropdown();
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

// -----------------------------------------------------------------------------
// Unificación de la lógica de eventos usando delegación.
// Esto mejora el rendimiento y la consistencia del código.
$(document).on('submit', '#editUser form, #addUserModal form', function(e) {
  if (!validatePasswords($(this))) {
    e.preventDefault();
  }
});

// Evento para mostrar la vista previa de la imagen seleccionada en un formulario.
$(document).on('change', '#editUser input[type="file"][name="photo"], #editUserModal input[type="file"][name="photo"]', function() {
  const file = this.files[0];
  const previewSelector = $(this).closest('.modal-content').find('#edit_photo_preview');
  const textSelector = $(this).closest('.modal-content').find('#no_photo_text');

  if (file && file.type.match(/^image\/(jpeg|png|jpg)$/)) {
    const reader = new FileReader();
    reader.onload = function(e) {
      previewSelector.attr('src', e.target.result).show();
      textSelector.hide();
    };
    reader.readAsDataURL(file);
  } else {
    previewSelector.hide();
    textSelector.show();
  }
});

// -----------------------------------------------------------------------------
// Manejo de clicks en botones que abren modales.
// Utiliza una función genérica para evitar la repetición de código.
function showModal(modalId) {
  const modal = new bootstrap.Modal(document.getElementById(modalId));
  modal.show();
}

$(document).on('click', '.btn-add-ingrediente, .btn-add-user, .btn-add-materiales, .btn-add-gastos', function(e) {
  e.preventDefault();
  const modalMap = {
    'btn-add-ingrediente': 'addIngredienteModal',
    'btn-add-user': 'addUserModal',
    'btn-add-materiales': 'addMaterialesModal',
    'btn-add-gastos': 'addGastosModal'
  };
  const btnClass = $(this).attr('class').split(' ').find(cls => modalMap[cls]);
  if (btnClass) {
    showModal(modalMap[btnClass]);
  }
});

// -----------------------------------------------------------------------------
// Manejo de clicks para editar elementos (ingredientes, materiales, gastos, usuarios).
// Se extrae la lógica común para evitar repetición.
$(document).on('click', '.edit-ingredientes-btn, .edit-materiales-btn, .edit-gastos-btn', function(e) {
  e.preventDefault();
  const btn = $(this);
  const id = btn.data('id');
  const row = btn.closest('tr');
  const actionMap = {
    'edit-ingredientes-btn': { formId: 'editIngredienteForm', actionUrl: '/ingredientes/' },
    'edit-materiales-btn': { formId: 'editMaterialesForm', actionUrl: '/materiales/' },
    'edit-gastos-btn': { formId: 'editGastosForm', actionUrl: '/gastos/' }
  };
  const btnClass = btn.attr('class').split(' ').find(cls => actionMap[cls]);

  if (btnClass) {
    const config = actionMap[btnClass];
    $(`#${config.formId}`).attr('action', window.baseUrl + config.actionUrl + id);
    console.log(`Intento de edición: botón '${btnClass}' con ID '${id}'`);

    // Lógica para editar ingredientes
    if (btnClass === 'edit-ingredientes-btn') {
      // Hacemos una llamada AJAX para obtener los datos del ingrediente
      $.get(`${window.baseUrl}/ingredientes/${id}/json`, function(data) {
        console.log("Datos de ingrediente obtenidos:", data);
        // Rellenar los campos del modal con los datos obtenidos
        $('#edit_id').val(data.id);
        $('#edit_nombre').val(data.nombre);
        $('#edit_densidad').val(data.densidad);
        $('#edit_costo_unitario').val(data.costo_unitario);
        
        // Seleccionar la unidad de medida correcta
        $('#edit_unidad_medida_id').val(data.unidad_medida_id);
        
        // Muestra el modal aquí, una vez que los datos están cargados
        showModal('editIngredienteModal');
        console.log("Modal de ingrediente mostrado.");
      }).fail(function() {
        showMessageModal('Error al obtener los datos del ingrediente. Por favor, intente de nuevo.');
        console.error("Error en la llamada AJAX para el ingrediente.");
      });
    } 
    // Lógica para editar materiales
    else if (btnClass === 'edit-materiales-btn') {
      // Usamos el mismo enfoque: llamada AJAX para obtener datos
      $.get(`${window.baseUrl}/materiales/${id}/json`, function(data) {
        $('#edit_material_id').val(data.id);
        $('#edit_nombre').val(data.nombre);
        $('#edit_costo_unitario').val(data.costo_unitario);
        showModal('editMaterialesModal');
      }).fail(function() {
        showMessageModal('Error al obtener los datos del material. Por favor, intente de nuevo.');
      });
    }
    // Lógica para editar gastos
    else if (btnClass === 'edit-gastos-btn') {
      // Usamos el mismo enfoque: llamada AJAX para obtener datos
      $.get(`${window.baseUrl}/gastos/${id}/json`, function(data) {
        $('#edit_id').val(data.id);
        $('#edit_descripcion').val(data.descripcion);
        $('#edit_monto').val(data.monto);
        $('#edit_periodo_mes').val(data.periodo_mes);
        $('#edit_periodo_anio').val(data.periodo_anio);
        $('#edit_unidades_producidas').val(data.unidades_producidas);
        showModal('editGastosModal');
      }).fail(function() {
        showMessageModal('Error al obtener los datos del gasto. Por favor, intente de nuevo.');
      });
    }
  }
});

$(document).on('click', '.edit-users-btn', function(e) {
  e.preventDefault();
  const userId = $(this).data('id');
  $.get(`${window.baseUrl}/usuarios/${userId}/json`, function(data) {
    $('#editUsuarioForm').attr('action', `${window.baseUrl}/usuarios/${userId}`);
    $('#edit_user_id').val(data.id);
    $('#edit_name').val(data.name);
    $('#edit_email').val(data.email);
    $('#edit_role').val(data.role);

    if (data.photo) {
      $('#edit_photo_preview').attr('src', `${window.baseUrl}/${data.photo}`).show();
      $('#no_photo_text').hide();
      $('#actual_photo').val(data.photo);
    } else {
      $('#edit_photo_preview').hide();
      $('#no_photo_text').show();
      $('#actual_photo').val('');
    }
    showModal('editUserModal');
  });
});

// -----------------------------------------------------------------------------
// Manejo de clicks para eliminar elementos (con modal de confirmación).
// Se usa una función genérica para manejar el submit del formulario de eliminación.
function setupDeleteModal(btn, confirmBtnId, formId) {
  btn.on('click', function(e) {
    e.preventDefault();
    $(`#${confirmBtnId}`).attr('data-id', $(this).data('id'));
    const modalId = `${formId.replace('Form', 'Modal')}`;
    
    // Verificación adicional para el modal de eliminación. Si el cuerpo está vacío,
    // es probable que falten elementos en el HTML.
    if ($(`#${modalId} .modal-body`).length === 0) {
      console.log(`Error: El cuerpo del modal de eliminación '${modalId}' no se encuentra en el HTML. Verifica que el modal HTML esté completo y no le falte la clase .modal-body.`);
      return;
    }
    
    showModal(modalId);
  });
}

function handleConfirmDelete(confirmBtnId, formId, urlSegment) {
  $(document).on('click', `#${confirmBtnId}`, function() {
    const id = $(this).attr('data-id');
    const form = $(`#${formId}`);
    form.attr('action', `${window.baseUrl}/${urlSegment}/${id}`);
    form.submit();
  });
}

// Configuración de los eventos de eliminación
setupDeleteModal($('.delete-ingredientes-btn'), 'confirmDeleteBtn', 'deleteIngredienteForm');
setupDeleteModal($('.delete-materiales-btn'), 'confirmDeleteMaterialesBtn', 'deleteMaterialesForm');
setupDeleteModal($('.delete-gastos-btn'), 'confirmDeleteGastosBtn', 'deleteGastosForm');
setupDeleteModal($('.delete-receta-btn'), 'confirmDeleteRecetaBtn', 'deleteRecetaForm');
setupDeleteModal($('.delete-users-btn'), 'confirmDeleteUserBtn', 'deleteUserForm');
setupDeleteModal($('.delete-producto-btn'), 'confirmDeleteProductoBtn', 'deleteProductoForm');

// Manejadores de los clics en los botones de confirmación
handleConfirmDelete('confirmDeleteBtn', 'deleteIngredienteForm', 'ingredientes');
handleConfirmDelete('confirmDeleteMaterialesBtn', 'deleteMaterialesForm', 'materiales');
handleConfirmDelete('confirmDeleteGastosBtn', 'deleteGastosForm', 'gastos');
handleConfirmDelete('confirmDeleteRecetaBtn', 'deleteRecetaForm', 'recetas');
handleConfirmDelete('confirmDeleteUserBtn', 'deleteUserForm', 'usuarios');
handleConfirmDelete('confirmDeleteProductoBtn', 'deleteProductoForm', 'productos');

// -----------------------------------------------------------------------------
// Proceso para agregar/eliminar filas de tablas (recetas).
function setupTableRows(wrapperId, addBtnId, deleteBtnClass, selectClass, unitInputClass, urlSegment) {
  const tablaWrapper = document.getElementById(wrapperId);
  const agregarBtn = document.getElementById(addBtnId);

  if (!tablaWrapper || !agregarBtn) {
    return;
  }

  const tabla = tablaWrapper.getElementsByTagName('tbody')[0];
  if (!tabla.rows[0]) {
    // Si la tabla está vacía, no se puede clonar la fila. Se necesita una fila base.
    return;
  }

  agregarBtn.addEventListener('click', function() {
    const rowCount = tabla.rows.length;
    const nuevaFila = tabla.rows[0].cloneNode(true);
    
    // Limpia y renombra los elementos de la nueva fila.
    nuevaFila.querySelectorAll('select, input').forEach(el => {
      if (el.name) {
        el.name = el.name.replace(/\[\d+\]/, '[' + rowCount + ']');
      }
      el.value = '';
    });
    
    // Configura los eventos para la nueva fila.
    const selectEl = nuevaFila.querySelector(`.${selectClass}`);
    if (selectEl) {
      selectEl.addEventListener('change', () => actualizarUnidad(selectEl, unitInputClass));
      actualizarUnidad(selectEl, unitInputClass);
    }
    
    const deleteBtn = nuevaFila.querySelector(`.${deleteBtnClass}`);
    if (deleteBtn) {
      deleteBtn.addEventListener('click', function() {
        this.closest('tr').remove();
      });
    }
    
    tabla.appendChild(nuevaFila);
  });
  
  // Configura los eventos de las filas existentes.
  tabla.querySelectorAll(`.${selectClass}`).forEach(select => {
    actualizarUnidad(select, unitInputClass);
    select.addEventListener('change', () => actualizarUnidad(select, unitInputClass));
  });

  // Configura el botón de eliminar de la primera fila.
  const firstDeleteBtn = tabla.querySelector(`.${deleteBtnClass}`);
  if (firstDeleteBtn) {
    firstDeleteBtn.addEventListener('click', function() {
      this.closest('tr').remove();
    });
  }
}

// Función para actualizar la unidad de medida basada en el select.
function actualizarUnidad(select, unitInputClass) {
  const selected = select.options[select.selectedIndex];
  const unidad = selected ? selected.getAttribute('data-unidad') : '';
  const inputUnidad = select.closest('tr').querySelector(`.${unitInputClass}`);
  if (inputUnidad) inputUnidad.value = unidad || '';
}

// Inicializa las tablas de ingredientes y desechables.
document.addEventListener('DOMContentLoaded', () => {
  setupTableRows('tabla-ingredientes', 'agregar-fila', 'eliminar-fila', 'select-ingrediente', 'unidad-medida');
  setupTableRows('tabla-desechables', 'agregar-fila-des', 'eliminar-fila-des', 'select-desechable', 'unidad-medida-des');
});


// -----------------------------------------------------------------------------
// Mostrar/ocultar detalles de ingredientes.
$(document).on('click', '.btn-toggle-detalle', function() {
  const btn = $(this);
  const detalle = btn.closest('td').find('.detalle-ingredientes');
  const icon = btn.find('i');

  if (detalle.is(':visible')) {
    detalle.hide();
    icon.removeClass('bi-dash-circle').addClass('bi-plus-circle');
  } else {
    detalle.show();
    icon.removeClass('bi-plus-circle').addClass('bi-dash-circle');
  }
});
