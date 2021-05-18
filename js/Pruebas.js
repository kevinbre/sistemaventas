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
                $('#form-crear-cliente').trigger('reset');

            } else {
                toastr["error"]("Cliente duplicado o datos incorrectos.", "Error al agregar");
            }
        });
        e.preventDefault();

    })
})


$(document).ready(function() {
    buscar_cliente();

    function buscar_cliente(consulta) {
        funcion = 'cliente_buscar';
        $.post('../controlador/clienteController.php', { consulta, funcion }, (response) => {
            const datosClientes = JSON.parse(response);
            let template = '';
            datosClientes.forEach(datosCliente => {
                template += `
                                    <tr clienteId="${datosCliente.id}" clienteNombre="${datosCliente.nombre}" clienteDni="${datosCliente.dni}" clienteTelefono="${datosCliente.telefono}" clienteEmail="${datosCliente.email}" clienteDireccion="${datosCliente.direccion}" >
                                    <td>${datosCliente.nombre}</td>
                                    <td>${datosCliente.dni}</td>
                                    <td>${datosCliente.telefono}</td>
                                    <td>${datosCliente.email}</td>
                                    <td>${datosCliente.direccion}</td>
                                    <td>
                                    <button class="editar btn btn-success btn-xs" title="Modificar usuario" type="button" data-toggle="modal" data-target="#editar_cliente"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="borrar btn btn-danger btn-xs" title="Eliminar usuario" data-target="eliminar_cliente"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                    </tr>                
                                    `;
            });
            $('#lista_clientes').html(template);
        })

    }
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


    });
    /*$(document).on('click', '.editar', (e) => {



    })*/
});