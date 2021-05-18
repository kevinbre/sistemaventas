$(document).ready(function() {
    $('.select2').select2();
    rellenar_clientes()
    Contar_productos();
    RecuperarLS_carrito();
    RecuperarLS_carrito_venta();
    calcularTotal();
    $(document).on('click', '.agregar-carrito', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let nombre = $(elemento).attr('productoNombre');
        let sku = $(elemento).attr('productoSku');
        let precio = $(elemento).attr('productoPrecio');
        let categoria = $(elemento).attr('productoTipo');
        let tipo_id = $(elemento).attr('productoTipoId');
        let id = $(elemento).attr('productoId');
        let stock = $(elemento).attr('productoStock');
        const producto = {
            id: id,
            nombre: nombre,
            sku: sku,
            tipo: categoria,
            precio: precio,
            categoria_id: tipo_id,
            stock: stock,
            cantidad: 1



        }
        let id_producto;
        let productos;

        productos = RecuperarLS();
        productos.forEach(prod => {
            if (prod.id === producto.id) {
                id_producto = prod.id;
            }


        });
        if (id_producto === producto.id) {
            toastr["error"]("El producto ya está agregado", "Error al agregar");

        } else {
            toastr["success"]("Producto agregado al carrito", "Producto agregado");
            template = `
        <tr productoId="${producto.id}">          
            <td>${producto.sku}</td>
            <td>${producto.nombre}</td>
            <td>${producto.tipo}</td>           
            <td>${producto.precio}</td>
            <td><button class="borrar-producto-carrito btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
            </tr>
            `;

            $('#lista-carrito').append(template);
            AgregarLS(producto);
        }
        Contar_productos();


    })

    $(document).on('click', '.borrar-producto-carrito', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('productoId');
        elemento.remove();
        Eliminar_producto_LS(id);
        Contar_productos();

    })
    $(document).on('click', '#vaciar-carrito', (e) => {
        $('#lista-carrito').empty();
        EliminarLS();
        Contar_productos();

    })


    $(document).on('click', '#procesar-pedido', (e) => {
        Procesar_pedido();

    })
    $(document).on('click', '#procesar-compra', (e) => {
        Procesar_compra();

    })

    function RecuperarLS() {
        let productos;
        if (localStorage.getItem('productos') === null) {
            productos = [];
        } else {
            productos = JSON.parse(localStorage.getItem('productos'))
        }
        return productos
    }

    function AgregarLS(producto) {
        let productos;
        productos = RecuperarLS();
        productos.push(producto);
        localStorage.setItem('productos', JSON.stringify(productos))
    }


    function RecuperarLS_carrito() {
        let productos, id_producto;
        productos = RecuperarLS();
        funcion = "buscar_id"
        productos.forEach(producto => {
            id_producto = producto.id;
            $.post('../controlador/productoController.php', { funcion, id_producto }, (response) => {

                let template_carrito = '';
                let json = JSON.parse(response);
                template_carrito = `
                                    <tr productoId="${json.id}">
                                        <td>${json.sku}</td>
                                        <td>${json.nombre}</td>
                                        <td>${json.tipo}</td>                                    
                                        <td>${json.precio}</td>
                                        <td><button class="borrar-producto-carrito btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                                    </tr>
                `;
                $('#lista-carrito').append(template_carrito);

            })
            calcularTotal()
        });
    }

    function Eliminar_producto_LS(id) {
        let productos;
        productos = RecuperarLS();
        productos.forEach(function(producto, indice) {
            if (producto.id === id) {
                productos.splice(indice, 1);
            }
        });
        localStorage.setItem('productos', JSON.stringify(productos))
        calcularTotal()

    }

    function EliminarLS() {
        localStorage.clear();
        calcularTotal()
    }


    function Contar_productos() {
        let productos;
        let contador = 0;
        productos = RecuperarLS();
        productos.forEach(producto => {
            contador++;
        });
        $('#contador').html(contador);
    }

    function Procesar_pedido() {
        let productos;
        productos = RecuperarLS();
        if (productos.length === 0) {
            toastr["error"]("El carrito se encuentra vacio", "Error al procesar");
        } else {
            location.href = '../vista/procesarVenta.php'
        }

    }

    function RecuperarLS_carrito_venta1() {
        let productos, id_producto;
        productos = RecuperarLS();
        funcion = "buscar_id"
        productos.forEach(producto => {
            id_producto = producto.id;
            $.post('../controlador/productoController.php', { funcion, id_producto }, (response) => {
                let template_compra = '';
                let json = JSON.parse(response);
                template_compra = `
                                    <tr productoId="${producto.id}">
                                        <td>${json.sku}</td>
                                        <td>${json.nombre}</td>
                                        <td>${json.tipo}</td>                                        
                                        <td>${json.precio}</td>
                                        <td>
                                        <input type="number" min="1" class="form-control cantidad_producto" value="${producto.cantidad}">
                                        </td>
                                        <td class="subtotales">
                                        <h5>${json.precio*producto.cantidad}</h5>
                                        </td>
                                        <td><button class="borrar-producto-carrito btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                                    </tr>
                `;
                $('#lista-compra').append(template_compra);
            })

        });
    }

    async function RecuperarLS_carrito_venta() {
        let productos;
        productos = RecuperarLS();
        funcion = "traer_productos";
        const response = await fetch('../controlador/productoController.php', {
            method: 'POST',
            headers: { 'Content-type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion + '&&productos=' + JSON.stringify(productos)

        });
        let resultado = await response.text();
        $('#lista-compra').append(resultado);
    }

    $('#cp').keyup((e) => {
        let id, cantidad, producto, productos, montos, precio;
        producto = $(this)[0].activeElement.parentElement.parentElement;

        id = $(producto).attr('productoId');
        precio = $(producto).attr('productoPrecio');

        cantidad = producto.querySelector('input').value;
        montos = document.querySelectorAll('.subtotales');
        productos = RecuperarLS();
        productos.forEach(function(prod, indice) {

            if (prod.id === id) {
                console.log(prod)
                prod.cantidad = cantidad;
                prod.precio = precio;
                montos[indice].innerHTML = ` <h5>${cantidad*precio}</h5>`;
            }

        });
        localStorage.setItem('productos', JSON.stringify(productos));
        calcularTotal()

    });

    function calcularTotal() {
        let productos, descuento;
        let total = 0;
        productos = RecuperarLS();
        productos.forEach(producto => {
            let subtotal_producto = Number(producto.precio * producto.cantidad);
            total = total + subtotal_producto;

        });
        descuento = $('#descuento').val();

        total_condescuento = total - descuento;
        $('#subtotal').html(total.toFixed(2));
        $('#total_compra').html(total_condescuento.toFixed(2));


    }

    function Procesar_compra() {
        let cliente = $('#cliente').val();
        if (RecuperarLS().length == 0) {

            toastr["error"]("No hay productos cargados", "Error al procesar");
        } else if (cliente == '') {
            toastr["warning"]("No hay cliente seleccionado", "Error al procesar");
        } else {
            verificar_stock().then(error => {
                if (error == 0) {
                    Registrar_compra(cliente);
                    swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'La venta se realizó correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {

                        EliminarLS();
                        location.href = '../vista/vistaVentas.php';
                    })

                } else {
                    toastr["error"]("Revisar Stock de productos", "Error en el Stock");
                }
            })


        }

    }

    async function verificar_stock() {
        let productos;
        funcion = 'stock_verificar';
        productos = RecuperarLS();
        const response = await fetch('../controlador/productoController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion + '&&productos=' + JSON.stringify(productos)
        })
        let error = await response.text();

        return error;
    }

    function Registrar_compra(cliente) {
        funcion = 'registrar_compra';
        let total = $('#total_compra').get(0).textContent;
        let productos = RecuperarLS();
        let json = JSON.stringify(productos);
        $.post('../controlador/compraController.php', { funcion, total, cliente, json }, (response) => {
            console.log(response);

        })
    }

    function rellenar_clientes() {
        funcion = 'rellenar_clientes';
        $.post('../controlador/clienteController.php', { funcion }, (response) => {
            let clientes = JSON.parse(response);
            let template = '';
            clientes.forEach(cliente => {
                    template += `
                <option value="${cliente.id}">${cliente.nombre}</option>                
                `
                }

            );
            $('#cliente').html(template);
            $('.select2').select2();
        })
    }
})