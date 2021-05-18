$(document).ready(function() {
    buscar_producto();

    function buscar_producto(consulta) {
        funcion = 'producto_buscar';
        $.post('../controlador/productoController.php', { consulta, funcion }, (response) => {

            const datosProductos = JSON.parse(response);
            let template = '';
            datosProductos.forEach(datosProducto => {
                template += `       
                                         <div>
                                         <tr productoId="${datosProducto.id}" productoSku="${datosProducto.sku}" productoNombre="${datosProducto.nombre}" productoTipo="${datosProducto.tipo}" productoTipoId="${datosProducto.tipo_id}"  productoStock="${datosProducto.stock}" productoPrecio="${datosProducto.precio}" >
                                         <td class="emailocultar">${datosProducto.sku}</td>
                                         <td>${datosProducto.nombre}</td>
                                         <td class="emailocultar">${datosProducto.tipo}</td>
                                         <td>${datosProducto.stock}</td>
                                         <td>$${datosProducto.precio}</td>                                  
                                         <td>
                                         </div>
                                         
                                         
                                         <button class="editar btn btn-info btn-xs" title="Modificar usuario" type="button" data-toggle="modal" data-target="#editar_producto"><i class="fas fa-pencil-alt"></i></button>
                                         <button class="modificarstock btn btn-success btn-xs" title="Modificar stock" type="button" data-toggle="modal" data-target="#editar_producto_stock"><i class="fas fa-plus-square"></i></button>
                                         <button class="borrar btn btn-danger btn-xs" title="Eliminar usuario" data-target="eliminar_producto"><i class="fas fa-trash-alt"></i></button>
                                         </td>
                                         </tr>                                                       
                                         `;
            });
            $('#lista_productos').html(template);

            $(document).ready(function() {
                $("#tabla-productos").paginationTdA({
                    elemPerPage: 10
                });
            });

        })
    }
    $(document).ready(function() {
        var funcion;
        rellenar_categorias();

        function rellenar_categorias() {
            funcion = 'rellenar_categorias';
            $.post('../controlador/categoriasController.php', { funcion }, (response) => {
                const categoria = JSON.parse(response);
                let template = '';
                categoria.forEach(categoria => {
                    template += `
                        <option value="${categoria.id}">${categoria.nombre}</option>
                        `;

                });
                $('#tipo_producto').html(template);


            });

        }

    })
    $(document).ready(function() {


        rellenar_categorias();

        function rellenar_categorias() {
            funcion = 'rellenar_categorias';
            $.post('../controlador/categoriasController.php', { funcion }, (response) => {
                const categoria = JSON.parse(response);
                let template = '';
                categoria.forEach(categoria => {
                    template += `
                        <option value="${categoria.id}">${categoria.nombre}</option>
                        `;
                });
                $('#edit_tipo_producto').html(template);
            });
        }
        buscar_producto();
    })



    $(document).ready(function() {
        var funcion;
        $("#cancelar").click(function() {
            $('#sku_producto, #nombre_producto, #tipo_producto, #precio_producto').val("");
        });
        $('#form-crear-producto').submit(e => {
            funcion = 'crear_producto';
            let sku = $('#sku_producto').val();
            let nombre = $('#nombre_producto').val();
            let tipo = $('#tipo_producto').val();
            let precio = $('#precio_producto').val();

            $.post('../controlador/productoController.php', { sku, nombre, tipo, precio, funcion }, (response) => {
                console.log(response)
                if (response == 'add') {
                    toastr["success"]("El producto se agrego correctamente.", "Porducto agregado");
                    $('#modal-crear-producto').modal('hide');
                    $('#form-crear-producto').trigger('reset');

                } else {
                    toastr["error"]("Datos incorrectos o faltantes.", "Error al editar");
                }
                buscar_producto();

            });
            e.preventDefault();


        })

    })




    $(document).on('keyup', '#buscar_producto', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_producto(valor);
        } else {
            buscar_producto();
        }
    });
    $(document).on('click', '.borrar ', (e) => {
        funcion = 'borrar';
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('productoId');
        const sku = $(elemento).attr('productoSku');
        const nombre = $(elemento).attr('productoNombre');
        const tipo = $(elemento).attr('productoTipo');
        const precio = $(elemento).attr('productoPrecio');
        console.log(id + sku + nombre + tipo + precio)

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Eliminar Producto',
            text: "Está a punto de eliminar el producto " + nombre + "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/productoController.php', { id, funcion }, (response) => {
                    console.log(response);
                })
                swalWithBootstrapButtons.fire(
                    'Eliminado',
                    'El producto ' + nombre + ' se borro correctamente',
                    'success'
                )
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El producto no se elimino',
                    'error'
                )
            }
            buscar_producto();

        })


    });
    $(document).on('click', '.editar', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let nombre = $(elemento).attr('productoNombre');
        let precio = $(elemento).attr('productoPrecio');
        let tipo_id = $(elemento).attr('productoTipoId');
        let id = $(elemento).attr('productoId');

        $('#edit_modelo').val(nombre);
        $('#edit_precio').val(precio);
        $('#edit_tipo_producto').val(tipo_id);
        $('#id_edit_producto').val(id);
        console.log(elemento)
    });

    $('#form-editar').submit(e => {
        let id = $('#id_edit_producto').val();
        let nombre = $('#edit_modelo').val();
        let precio = $('#edit_precio').val();
        let tipo_id = $('#edit_tipo_producto').val();

        funcion = 'editar_producto';

        $.post('../controlador/productoController.php', { id, nombre, precio, tipo_id, funcion }, (response) => {
            console.log(response)
            if (response == 1) {

                toastr["success"]("El producto se editó correctamente.", "Producto editado");
                $('#editar_producto').modal('hide');

            } else {
                toastr["error"]("Datos incorrectos o faltantes.", "Error al editar");
            }
            buscar_producto();

        });

        e.preventDefault();


    })
    $(document).on('click', '.modificarstock', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('productoId');
        const sku = $(elemento).attr('productoSku');
        const nombre = $(elemento).attr('productoNombre');
        const categoria = $(elemento).attr('productoTipo');
        const stock = $(elemento).attr('productoStock');

        $('#id_edit_stock').val(id);
        $('#sku_stock').val(sku);
        $('#modelo_stock').val(nombre);
        $('#categoria_stock').val(categoria);
        $('#editar_stock').val(stock);


    });
    $('#form-editar-stock').submit(e => {
        funcion = "modificar_stock"
        let prod_id = $('#id_edit_stock').val();
        let prod_stock = $('#editar_stock').val();

        funcion = 'modificar_stock'

        $.post('../controlador/productoController.php', { prod_stock, prod_id, funcion }, (response) => {

            if (response == 1) {

                toastr["success"]("El stock se actualizó correctamente.", "Stock actualizado");
                $('#editar_producto_stock').modal('hide');

                console.log(response);
            }
            buscar_producto();
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