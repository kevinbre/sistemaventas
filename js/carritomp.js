$(document).ready(function() {
    $('.select2').select2();
    Contar_materiaprima();
    RecuperarLS_carrito_mp();
    RecuperarLS_carrito_compra();
    $(document).on('click', '.agregar-carrito-mp', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        let nombre = $(elemento).attr('materiaprimaNombre');
        let id = $(elemento).attr('materiaprimaId');
        let existencia = $(elemento).attr('materiaprimaExistencia');
        const materiaprima = {
            id: id,
            nombre: nombre,
            existencia: existencia,
            cantidad: 1

        }
        let id_materiaprima;
        let materiasprimas;

        materiasprimas = RecuperarLSMP();
        materiasprimas.forEach(mp => {
            if (mp.id === materiaprima.id) {
                id_materiaprima = mp.id;
            }


        });
        if (id_materiaprima === materiaprima.id) {
            toastr["error"]("La Materia Prima ya está agregada", "Error al agregar");

        } else {
            toastr["success"]("Materia Prima agregada al carrito", "Materia Prima agregada");
            template = `
        <tr materiaprimaId="${materiaprima.id}">        
            <td>${materiaprima.nombre}</td>      
            <td><button class="borrar-producto-carrito btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
            </tr>
            `;
            $('#lista-carrito-mp').append(template);
            AgregarLSMP(materiaprima);
        }
        Contar_materiaprima();


    })

    $(document).on('click', '.borrar-producto-carrito-mp', (e) => {
        let elemento = $(this)[0].activeElement.parentElement.parentElement;
        console.log(elemento)
        const id = $(elemento).attr('materiaprimaId');
        elemento.remove();
        Eliminar_Materiaprima_LS(id);
        Contar_materiaprima();

    })
    $(document).on('click', '#vaciar-carrito-mp', (e) => {
        $('#lista-carrito-mp').empty();
        EliminarLSMP();
        Contar_materiaprima();

    })
    $(document).on('click', '#procesar-pedido-mp', (e) => {
        Procesar_pedido_mp();

    })
    $(document).on('click', '#procesar-compra-mp', (e) => {
        Procesar_compra();

    })

    function RecuperarLSMP() {
        let materiasprimas;
        if (localStorage.getItem('materiasprimas') === null) {
            materiasprimas = [];
        } else {
            materiasprimas = JSON.parse(localStorage.getItem('materiasprimas'))
        }
        return materiasprimas
    }

    function AgregarLSMP(materiaprima) {
        let materiasprimas;
        materiasprimas = RecuperarLSMP();
        materiasprimas.push(materiaprima);
        localStorage.setItem('materiasprimas', JSON.stringify(materiasprimas))
    }


    function RecuperarLS_carrito_mp() {
        let materiasprimas, id_materiaprima;
        materiasprimas = RecuperarLSMP();
        funcion = "buscar_id"
        materiasprimas.forEach(materiaprima => {
            id_materiaprima = materiaprima.id;
            $.post('../controlador/materiaPrimaController.php', { funcion, id_materiaprima }, (response) => {

                let template_carrito_mp = '';
                let json = JSON.parse(response);
                template_carrito_mp = `
                                    <tr materiaprimaId="${json.id}">                                        
                                        <td>${json.nombre}</td>                                      
                                        <td><button class="borrar-producto-carrito-mp btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                                    </tr>
                `;
                $('#lista-carrito-mp').append(template_carrito_mp);

            })
            calcularTotal()
        });
    }

    function Eliminar_Materiaprima_LS(id) {
        let materiasprimas;
        materiasprimas = RecuperarLSMP();
        materiasprimas.forEach(function(materiaprima, indice) {
            if (materiaprima.id === id) {
                materiasprimas.splice(indice, 1);
            }
        });
        localStorage.setItem('materiaprimas', JSON.stringify(materiasprimas))
        calcularTotal()

    }

    function EliminarLSMP() {
        localStorage.clear('materiasprimas');
        calcularTotal()
    }


    function Contar_materiaprima() {
        let materiasprimas;
        let contador = 0;
        materiasprimas = RecuperarLSMP();
        materiasprimas.forEach(materiaprima => {
            contador++;
        });
        $('#contadormp').html(contador);
    }

    function Procesar_pedido_mp() {
        let materiasprimas;
        materiasprimas = RecuperarLSMP();
        if (materiasprimas.length === 0) {
            toastr["error"]("El carrito se encuentra vacio", "Error al procesar");
        } else {
            location.href = '../vista/procesarVenta.php'
        }

    }
    /*
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
        }*/

    async function RecuperarLS_carrito_compra() {
        let materiasprimas;
        materiasprimas = RecuperarLSMP();
        funcion = "traer_materiasprimas";
        const response = await fetch('../controlador/materiaPrimaController.php', {
            method: 'POST',
            headers: { 'Content-type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion + '&&materiasprimas=' + JSON.stringify(materiasprimas)

        });
        let resultado = await response.text();
        $('#lista-compra-mp').append(resultado);
    }

    /*   $('#cp').keyup((e) => {
        let id, cantidad, materiaprima, produmateriasprimas, montos, precio;
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
        localStorage.setItem('materiasprimas', JSON.stringify(materiasprimas));
        calcularTotal()

    });

    function calcularTotal() {
        let materiasprimas, descuento;
        let total = 0;
        materiasprimas = RecuperarLSMP();
        materiasprimas.forEach(materiaprima => {
            let materiaprima = Number(materiaprima.precio * materiaprimacantidad.cantidad);
            total = total + subtotal_producto;

        });


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

                        EliminarLSMP();
                        location.href = '../vista/listaMateriasPrimas.php';
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
        })
    } */
})