$(document).ready(function() {

    $('#cat-carrito').show();
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
                                         <td>${datosProducto.tipo}</td>
                                         <td>${datosProducto.stock}</td>
                                         <td>$ ${datosProducto.precio}</td>                                  
                                         <td>
                                         </div>
                                         
                                         
                                         <button class="agregar-carrito btn btn-success btn-xs" title="Agregar al Carrito"><i class="fas fa-shopping-cart"></i> Agregar</button>
                                         </td>
                                         </tr>                                                       
                                         `;
            });
            $('#lista-catalogo').html(template);

            $(document).ready(function() {
                $("#tabla-catalogo").paginationTdA({
                    elemPerPage: 10
                });
            });

        })
    }
    $(document).on('keyup', '#buscar_producto', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_producto(valor);
        } else {
            buscar_producto();
        }
    });
    /*$(document).ready(function() {
        $('#cat-carrito').show();
        var datatable;
        let funcion = "producto_buscar_catalogo";
        $.post('../controlador/catalogoController.php', { funcion }, (response) => {
            console.log(response)

            console.log(JSON.parse(response));
            datatable = $('#tabla-catalogo').DataTable({
                "ajax": {
                    "url": "../controlador/catalogoController.php",
                    "method": "POST",
                    "data": { funcion: funcion }
                },

                "columns": [
                    { "data": "sku_producto" },
                    { "data": "nombre_producto" },
                    { "data": "nombre_categoria" },
                    { "data": "stock_producto" },
                    { "data": "precio_producto" },


                    { "defaultContent": `<button class="agregar-carrito btn btn-success btn-xs" title="Modificar usuario"><i class="fas fa-shopping-cart"></i> Agregar</button>` },
                ],


            })
        })*/

    /*$('#tabla-catalogo tbody').on('click', '.borrar ', function() {

        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_cliente;
        let nombre = datos.nombre_cliente;
        funcion = "borrar";
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Eliminar Producto',
            text: "Está a punto de eliminar a " + nombre + "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/catalogoController.php', { id, funcion }, (response) => {
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
                    'El producto no se elimino',
                    'error'
                )
            }
            var table = $('#tabla-catalogo').DataTable();
            table.ajax.reload(function(json) {
                $('#tabla-catalogo').val(json.lastInput);






            });

        })

})
})*/

})