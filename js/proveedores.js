$(document).ready(function() {
    buscar_proveedor();

    function buscar_proveedor(consulta) {
        funcion = 'proveedor_buscar';
        $.post('../controlador/proveedorController.php', { consulta, funcion }, (response) => {
            const datosProveedores = JSON.parse(response);
            let template = '';
            datosProveedores.forEach(datosProveedor => {
                template += `       
                                    <div>
                                    <tr proveedorId="${datosProveedor.id}" proveedorNombre="${datosProveedor.nombre}" proveedorTelefono="${datosProveedor.telefono}" proveedorDireccion="${datosProveedor.direccion}" >
                                    <td>${datosProveedor.nombre}</td>
                                    <td>${datosProveedor.telefono}</td>
                                    <td>${datosProveedor.direccion}</td>
                                    <td> 
                                    </div>                                    
                                    <button class="editar btn btn-info btn-xs" title="Modificar proveedor" type="button" data-toggle="modal" data-target="#editar_proveedor"><i class="fas fa-user-edit"></i></button>
                                    <button class="borrar btn btn-danger btn-xs" title="Eliminar proveedor" data-target="#eliminar_proveedor"><i class="fas fa-user-minus"></i></button>
                                    </td>
                                    </tr>                
                                    `;
            });
            $('#lista_proveedores').html(template);
            $(document).ready(function() {
                $("#tabla_proveedores").paginationTdA({
                    elemPerPage: 10
                });
            });
        })

    }
    $(document).ready(function() {
        var funcion;
        $('#form-crear-proveedor').submit(e => {
            funcion = 'crear_proveedor';
            let nombre = $('#nombre_proveedor').val();
            let telefono = $('#telefono_proveedor').val();
            let direccion = $('#direccion_proveedor').val();



            $.post('../controlador/proveedorController.php', { nombre, telefono, direccion, funcion }, (response) => {
                if (response == 1) {
                    console.log(response)
                    toastr["success"]("El proveedor se agrego correctamente.", "Proveedor agregado");
                    $('#modal-crear-proveedor').modal('hide');
                    $('#form-crear-proveedor').trigger('reset');



                } else {
                    toastr["error"]("Datos incorrectos.", "Error al agregar");
                }
                buscar_proveedor();
            });
            e.preventDefault();

        })
    })

    $(document).on('keyup', '#buscar_proveedor', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_proveedor(valor);
        } else {
            buscar_proveedor();
        }
    });
    $(document).on('click', '.borrar ', (e) => {
        funcion = 'borrar';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('proveedorId');
        const nombre = $(elemento).attr('proveedorNombre');
        const telefono = $(elemento).attr('proveedorTelefono');
        const direccion = $(elemento).attr('proveedorDireccion');
        console.log(id + nombre + telefono + direccion)

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Eliminar Proveedor',
            text: "Está a punto de eliminar al Proveedor " + nombre + "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/proveedorController.php', { id, funcion }, (response) => {
                    console.log(response);
                })
                swalWithBootstrapButtons.fire(
                    'Eliminado',
                    'El proveedor ' + nombre + ' se borro correctamente',
                    'success'
                )
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El proveedor no se elimino',
                    'error'
                )
            }
            buscar_proveedor();

        })


    });
    $(document).on('click', '.editar', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let nombre = $(elemento).attr('proveedorNombre');
        let telefono = $(elemento).attr('proveedorTelefono');
        let direccion = $(elemento).attr('proveedorDireccion');
        let id = $(elemento).attr('proveedorId');
        $('#edit_nombre').val(nombre);
        $('#edit_telefono').val(telefono);
        $('#edit_direccion').val(direccion);
        $('#id_edit_proveedor').val(id);
        console.log(elemento)
    });

    $('#form-editar').submit(e => {
        let id = $('#id_edit_proveedor').val();
        let nombre = $('#edit_nombre').val();
        let telefono = $('#edit_telefono').val();
        let direccion = $('#edit_direccion').val();

        funcion = 'editar_proveedor';

        $.post('../controlador/proveedorController.php', { id, nombre, telefono, direccion, funcion }, (response) => {
            console.log(response)
            if (response == 1) {

                toastr["success"]("El proveedor se editó correctamente.", "Proveedor editado");
                $('#editar_proveedor').modal('hide');

            } else {
                toastr["error"]("Datos incorrectos o faltantes.", "Error al editar");
            }
            buscar_proveedor();

        });
        e.preventDefault();


    })
})