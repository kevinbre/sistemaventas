$(document).ready(function() {
    relleno_automatico();
    $('select').select2({
        placeholder: 'Seleccionar',

    });

    rellenar_usuario()
        // rellenar_productos();
    rellenar_proveedores();



    var prods = [];

    // function rellenar_productos() {
    //     funcion = 'rellenar_productos';
    //     $.post('../controlador/proveedorController.php', { funcion }, (response) => {
    //         console.log(response)
    //         let proveedores = JSON.parse(response);
    //         let template = '';
    //         proveedores.forEach(proveedor => {
    //                 template += `
    //             <option value=""></option>                
    //             `
    //             }

    //         );
    //         $('#producto').html(template);



    //     })
    // }

    function rellenar_usuario() {
        funcion = 'rellenar_usuario';
        $.post('../controlador/proveedorController.php', { funcion }, (response) => {
            console.log(response)
            let usuarios = JSON.parse(response);
            let template = '';
            usuarios.forEach(usuario => {
                    template += `
                <option value="${usuario.id}">${usuario.nombre}</option>                
                `
                }

            );
            $('#usuario').html(template);
        })
    }

    function rellenar_proveedores() {
        funcion = 'rellenar_proveedores';
        $.post('../controlador/proveedorController.php', { funcion }, (response) => {
            console.log(response)
            let proveedores = JSON.parse(response);
            let template = '';
            proveedores.forEach(proveedor => {
                    template += `
                <option value="${proveedor.id}">${proveedor.nombre}</option>                
                `
                }

            );
            $('#proveedor').html(template);
            if (template != null) {
                $('#proveedor').val('1');
                $('#proveedor').trigger("click");
            }
        })
    }


    function relleno_automatico() {
        $('#proveedor').change(function() {
            funcion = "relleno_automatico";
            let valor = $(this).val();
            console.log(valor);
            $.post('../controlador/proveedorController.php', { funcion, valor }, (response) => {
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(producto => {
                    template += `
                
                <option>${producto.nombre}</option>                
                `

                })
                $('#producto').html(template);
                console.log(template)

            });

        });
    }



    $(document).on('click', '.agregar-producto', (e) => {

        let producto_select2 = $('#producto').val();
        console.log(producto_select2)
        let cantidad = $('#cantidad').val();
        let precio_compra = $('#precio_compra').val();
        console.log(producto_select2)
        if (producto_select2 == null) {
            toastr["error"]("Ningun producto seleccionado.", "Elija un producto");

        } else {
            if (cantidad == '') {
                toastr["error"]("La cantidad no puede estar vacia", "Ingrese Cantidad");

            } else {
                if (precio_compra == '') {
                    toastr["error"]("Precio de compra no ingresado", "Ingrese un Precio");

                } else {
                    let producto_array = producto_select2.split(' | ');
                    console.log(producto_array)
                    let producto = {
                        id: producto_array['0'],
                        nombre: producto_select2,
                        cantidad: cantidad,
                        precio_compra: precio_compra,
                    }
                    prods.push(producto);
                    let template = '';

                    template = `
                    <tr prodId="${producto.id}">                       
                        <td>${producto.nombre}</td>
                        <td>${producto.cantidad}</td>
                        <td class="subtotal">${producto.precio_compra}</td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>
            
                    `;

                    $('#registros_compra').append(template);
                    toastr["success"]("La materia prima fue agregada correctamente", "Materia prima agregada");

                    $('#producto').val('').trigger('change');
                    $('#cantidad').val('');
                    $('#precio_compra').val('');
                    var sum = 0;
                    $('.subtotal').each(function() {
                        sum += parseFloat($(this).text());
                    });
                    $('#total').text(sum);


                }
            }
        }
    })





    $(document).on('click', '.borrar-producto', (e) => {

        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let id = $(elemento).attr('prodId');
        let total = $('#total').text();

        prods.forEach(function(prod, index) {

            if (prod.id == id) {
                prods.splice(index, 1);
                let $nuevototal = total - prod.precio_compra;
                $('#total').text($nuevototal);
            }


        })
        elemento.remove();


    })



    $(document).on('click', '.crear-compra', (e) => {


        let fecha_compra = $('#fecha_compra').val();
        let proveedor = $('#proveedor').val();
        let total = $('#total').text();
        let usuario = $('#usuario').val();


        if (fecha_compra == '') {
            toastr["error"]("La fecha de compra no puede estar vacia", "Ingrese Fecha de compra");
        } else {
            if (proveedor == null) {
                toastr["error"]("El proveedor no puede estar vacio", "Proveedor no Seleccionado");
            } else {
                if (prods == '') {
                    toastr["error"]("No hay productos para agregar", "No hay productos agregados");
                } else {
                    let descripcion = {
                        fecha_compra: fecha_compra,
                        proveedor: proveedor,
                        total: total,
                        usuario: usuario
                    }



                    funcion = 'registrar_compra'
                    let productosString = JSON.stringify(prods);
                    let descripcionString = JSON.stringify(descripcion);
                    $.post('../controlador/comprasController.php', { funcion, productosString, descripcionString }, (response) => {
                        console.log(response);
                        if (response = 'add') {
                            swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'La compra se registro correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.href = '../vista/vistaCompras.php'
                            })
                        } else {
                            swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Error en el servidor',
                                showConfirmButton: false,
                                timer: 1500

                            })
                        }
                    })




                    /* swal.fire({
                         position: 'center',
                         icon: 'success',
                         title: 'La compra se registro correctamente',
                         showConfirmButton: false,
                         timer: 1500
                     }).then(function() {
                         location.href = '../vista/gestionCompra.php'
                     })*/
                }
            }
        }
    })
})