$(document).ready(function() {
    buscar_materiaprima();

    function buscar_materiaprima(consulta) {
        funcion = 'materiaprima_buscar';
        $.post('../controlador/materiaPrimaController.php', { consulta, funcion }, (response) => {
            const datosMateriasprimas = JSON.parse(response);
            let template = '';
            datosMateriasprimas.forEach(datosMateriaprima => {
                template += `       
                                         <div>
                                         <tr materiaprimaId="${datosMateriaprima.id}", materiaprimaNombre="${datosMateriaprima.nombre}" materiaprimaMedicion="${datosMateriaprima.medicion}" materiaprimaExistencia="${datosMateriaprima.existencia}" materiaprimaProveedor="${datosMateriaprima.proveedor}" materiaprimaProveedorId="${datosMateriaprima.proveedorid}"  >
                                         <td>${datosMateriaprima.nombre}</td>
                                         <td>${datosMateriaprima.medicion}</td>
                                         <td>${datosMateriaprima.proveedor}</td>
                                         <td>${datosMateriaprima.existencia}</td>
                                                                     
                                         <td>
                                         </div>
                                         
                                         
                                         <button class="editar btn btn-info btn-xs" title="Modificar usuario" type="button" data-toggle="modal" data-target="#editar_materiaprima"><i class="fas fa-pencil-alt"></i></button>
                                         <button class="borrar btn btn-danger btn-xs" title="Eliminar usuario" data-target="eliminar_materiaprima"><i class="fas fa-trash-alt"></i></button>
                                         </td>
                                         
                                         </tr>                                                       
                                         `;
            });
            $('#lista_materiaprima').html(template);

            $(document).ready(function() {
                $("#tabla-materiaprima").paginationTdA({
                    elemPerPage: 15
                });
            });

        })
    }

    $(document).ready(function() {
        var funcion;
        rellenar_proveedores();

        function rellenar_proveedores() {
            funcion = 'rellenar_proveedores';
            $.post('../controlador/proveedorController.php', { funcion }, (response) => {
                const proveedor = JSON.parse(response);
                let template = '';
                proveedor.forEach(proveedor => {
                    template += `
                        <option value="${proveedor.id}">${proveedor.nombre}</option>
                        `;

                });
                $('#proveedor_add').html(template);


            });

        }

    })

    $(document).ready(function() {
        var funcion;
        rellenar_proveedores();

        function rellenar_proveedores() {
            funcion = 'rellenar_proveedores';
            $.post('../controlador/proveedorController.php', { funcion }, (response) => {
                console.log(response)
                const proveedor = JSON.parse(response);
                let template = '';
                proveedor.forEach(proveedor => {
                    template += `
                        <option value="${proveedor.proveedorid}">${proveedor.nombre}</option>
                        `;

                });
                $('#proveedor_edit').html(template);


            });

        }

    })

    $(document).ready(function() {
        var funcion;
        $("#cancelar").click(function() {
            $('#nombre_materiaprima,  #medicion_materiaprima, #existencia_materiaprima, #proveedor_add').val("");
        });
        $('#form-crear-materiaprima').submit(e => {
            funcion = 'registrar_materiaprima'
            let nombre = $('#nombre_materiaprima').val();
            let medicion = $('#medicion_materiaprima').val();
            let existencia = $('#existencia_materiaprima').val();
            let proveedor = $('#proveedor_add').val();

            $.post('../controlador/materiaPrimaController.php', { nombre, medicion, existencia, proveedor, funcion }, (response) => {
                console.log(response)
                if (response == 'add') {
                    toastr["success"]("La Materia Prima se agrego correctamente.", "Materia Prima agregada");
                    $('#modal-crear-materiaprima').modal('hide');
                    $('#form-crear-materiaprima').trigger('reset');

                } else {
                    toastr["error"]("Datos incorrectos o faltantes.", "Error al editar");
                }

                buscar_materiaprima();

            });
            e.preventDefault();

        })

    })




    $(document).on('keyup', '#buscar_materiaprima', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_materiaprima(valor);
        } else {
            buscar_materiaprima();
        }
    });
    $(document).on('click', '.borrar ', (e) => {
        funcion = 'borrar';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('materiaprimaId');
        const nombre = $(elemento).attr('materiaprimaNombre');
        const medicion = $(elemento).attr('materiaprimaMedicion');
        const existencia = $(elemento).attr('materiaprimaExistencia');
        console.log(id + nombre + medicion + existencia)

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Eliminar Materia Prima',
            text: "Está a punto de eliminar la Materia Prima " + nombre + "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/materiaPrimaController.php', { id, funcion }, (response) => {
                    console.log(response);
                })
                swalWithBootstrapButtons.fire(
                    'Eliminado',
                    'La Materia Prima  ' + nombre + ' se borro correctamente',
                    'success'
                )
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La Materia Prima no se elimino',
                    'error'
                )
            }
            buscar_materiaprima();

        })


    });
    $(document).on('click', '.editar', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let nombre = $(elemento).attr('materiaprimaNombre');
        let medicion = $(elemento).attr('materiaprimaMedicion');
        let existencia = $(elemento).attr('materiaprimaExistencia');
        let proveedor = $(elemento).attr('#proveedor_edit');
        let id = $(elemento).attr('materiaprimaId');

        $('#edit_nombre').val(nombre);
        $('#edit_medicion').val(medicion);
        $('#edit_existencia').val(existencia);
        $('#proveedor_edit').val(proveedor);
        $('#id_edit_materiaprima').val(id);
        console.log(elemento)
    });

    $('#form-editar').submit(e => {
        let id = $('#id_edit_materiaprima').val();
        let nombre = $('#edit_nombre').val();
        let medicion = $('#edit_medicion').val();
        let proveedor = $('#proveedor_edit').val();
        let existencia = $('#edit_existencia').val();

        funcion = 'editar_materiaprima';

        $.post('../controlador/materiaPrimaController.php', { id, nombre, medicion, proveedor, existencia, funcion }, (response) => {
            console.log(response)
            if (response == 1) {

                toastr["success"]("La Materia Prima se editó correctamente.", "Materia Prima editada");
                $('#editar_materiaprima').modal('hide');

            } else {
                toastr["error"]("Datos incorrectos o faltantes.", "Error al editar");
            }
            buscar_materiaprima();

        });

        e.preventDefault();


    })





})



/*$(document).ready(function() {

    let funcion = "producto_buscar_data";
    $.post('../controlador/productoController.php', { funcion }, (response) => {
        console.log(JSON.parse(response));
        $('#tabla-productos').DataTable({
            "ajax": {
                "url": "../controlador/productoController.php",
                "method": "POST",
                "data": { funcion: funcion }
            },
            "columns": [
                { "data": "sku_producto" },
                { "data": "nombre_producto" },
                { "data": "tipo_producto" },
                { "data": "stock_producto" },
                { "data": "precio_producto" },
                { "defaultContent": `<button class="editar btn btn-success btn-xs" title="Modificar usuario" type="button" data-toggle="modal" data-target="#editar_producto"><i class="fas fa-pencil-alt"></i></button>
                    <button class="modificarstock btn btn-primary btn-xs" title="Modificar stock" type="button" data-toggle="modal" data-target="#editar_producto_stock"><i class="fas fa-plus-square"></i></button>
                    <button class="borrar btn btn-danger btn-xs" title="Eliminar usuario" data-target="eliminar_producto"><i class="fas fa-trash-alt"></i></button>` },
            ],
        })
    })
})*/