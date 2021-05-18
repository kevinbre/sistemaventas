$(document).ready(function() {
    buscar_cliente();

    function buscar_cliente(consulta) {
        funcion = 'cliente_buscar';
        $.post('../controlador/clienteController.php', { consulta, funcion }, (response) => {
            const datosClientes = JSON.parse(response);
            let template = '';
            datosClientes.forEach(datosCliente => {
                template += `       
                                    <div>
                                    <tr clienteId="${datosCliente.id}" clienteNombre="${datosCliente.nombre}" clienteDni="${datosCliente.dni}" clienteTelefono="${datosCliente.telefono}" clienteEmail="${datosCliente.email}" clienteDireccion="${datosCliente.direccion}" >
                                    <td>${datosCliente.nombre}</td>
                                    <td>${datosCliente.dni}</td>
                                    <td>${datosCliente.telefono}</td>
                                    <td class='emailocultar'>${datosCliente.email}</td>
                                    <td class="emailocultar">${datosCliente.direccion}</td>
                                    <td>
                                    </div>
                                    <button class="editar btn btn-info btn-xs" title="Modificar usuario" type="button" data-toggle="modal" data-target="#editar_cliente"><i class="fas fa-user-edit"></i></button>
                                    <button class="borrar btn btn-danger btn-xs" title="Eliminar usuario" data-target="eliminar_cliente"><i class="fas fa-user-minus"></i></button>
                                    </td>
                                    </tr>                
                                    `;
            });
            $('#lista_clientes').html(template);
            $(document).ready(function() {
                $("#tablaClientes").paginationTdA({
                    elemPerPage: 10
                });
            });
        })

    }
    $(document).ready(function() {
        var funcion;
        $('#form-crear-cliente').submit(e => {
            funcion = 'crear_cliente';
            let nombre = $('#nombre_cliente').val();
            let dni = $('#dni_cliente').val();
            let email = $('#email_cliente').val();
            let telefono = $('#telefono_cliente').val();
            let direccion = $('#direccion_cliente').val();


            $.post('../controlador/clienteController.php', { nombre, dni, email, telefono, direccion, funcion }, (response) => {
                if (response == 1) {
                    console.log(response)
                    toastr["success"]("El cliente se agrego correctamente.", "Cliente agregado");
                    buscar_cliente();
                    $('#modal-crear-cliente').modal('hide');
                    $('#form-crear-cliente').trigger('reset');



                } else {
                    toastr["error"]("Cliente duplicado o datos incorrectos.", "Error al agregar");
                }
                buscar_cliente();
            });

            e.preventDefault();

        })
    })

    $(document).on('keyup', '#buscar_clientes', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_cliente(valor);
        } else {
            buscar_cliente();
        }
    });
    $(document).on('click', '.borrar ', (e) => {
        funcion = 'borrar';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('clienteId');
        const nombre = $(elemento).attr('clienteNombre');
        const dni = $(elemento).attr('clienteDni');
        const email = $(elemento).attr('clienteEmail');
        const telefono = $(elemento).attr('clienteTelefono');
        const direccion = $(elemento).attr('clienteDireccion');
        console.log(id + nombre + dni + email + telefono + direccion)

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Eliminar Usuario',
            text: "Está a punto de eliminar a " + nombre + "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/clienteController.php', { id, funcion }, (response) => {
                    console.log(response);
                })
                swalWithBootstrapButtons.fire(
                    'Eliminado',
                    'El cliente ' + nombre + ' se borro correctamente',
                    'success'
                )

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El cliente no se elimino',
                    'error'
                )

            }

            buscar_cliente();

        })
        e.preventDefault();


    });
    $(document).on('click', '.editar', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let nombre = $(elemento).attr('clienteNombre');
        let telefono = $(elemento).attr('clienteTelefono');
        let email = $(elemento).attr('clienteEmail');
        let direccion = $(elemento).attr('clienteDireccion');
        let id = $(elemento).attr('clienteId');
        $('#edit_nombre').val(nombre);
        $('#edit_telefono').val(telefono);
        $('#edit_email').val(email);
        $('#edit_direccion').val(direccion);
        $('#id_edit_cliente').val(id);
        console.log(elemento)
    });

    $('#form-editar').submit(e => {
        let id = $('#id_edit_cliente').val();
        let nombre = $('#edit_nombre').val();
        let telefono = $('#edit_telefono').val();
        let email = $('#edit_email').val();
        let direccion = $('#edit_direccion').val();

        funcion = 'editar_cliente';

        $.post('../controlador/clienteController.php', { id, nombre, email, telefono, direccion, funcion }, (response) => {
            console.log(response)
            if (response == 1) {

                toastr["success"]("El cliente se editó correctamente.", "Cliente editado");
                $('#editar_cliente').modal('hide');

            } else {
                toastr["error"]("Datos incorrectos o faltantes.", "Error al editar");
            }
            buscar_cliente();

        });
        e.preventDefault();


    })
})