$(document).ready(function() {
    mostrar_consultas();

    function mostrar_consultas() {
        let funcion = 'mostrar_consultas';
        $.post('../controlador/clienteController.php', { funcion }, (response) => {
            const vistas = JSON.parse(response);
            $('#clientes-box').html(vistas.totalclientes);
            $('#productos-box').html(vistas.totalproductos);
            $('#ventas-box').html(vistas.totalventas);
            $('#compras-box').html(vistas.totalcompras);
        })
    }



    let funcion = "listar";
    $.post('../controlador/ventaController.php', { funcion }, (response) => {
        // console.log(JSON.parse(response));
    })
    let datatable = $('#tabla_venta').DataTable({
        "order": [0, 'desc'],
        "ajax": {
            "url": "../controlador/ventaController.php",
            "method": "POST",
            "data": { funcion: funcion },

        },
        "columns": [

            { "data": "fecha_venta" },
            { "data": "nombre_cliente" },
            { "data": "dni_cliente" },
            // { "data": "direccion_cliente" },
            { "data": "total_venta" },
            {
                "defaultContent": `<button class="imprimir btn btn-secondary btn-sm"><i class="fas fa-print "></i> </button>
                                   <button class="borrar btn btn-danger btn-sm"><i class="fas fa-window-close "></i></button>`
            }
        ],

        "language": espanol,
    });


    $('#tabla_venta tbody').on('click', '.imprimir', function() {
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        $.post('../controlador/pdfController.php', { id }, (response) => {
            console.log(response);
            window.open('../pdf/pdf-' + id + '.pdf', '_blank');

        })
    })


    $('#tabla_venta tbody').on('click', '.borrar', function() {
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion = "borrar_venta";
        Swal.fire({
            title: 'Esta seguro de eliminar esta venta?',
            text: "Una vez borrado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar'
        }).then((result) => {
            $.post('../controlador/eliminarVentaController.php', { funcion, id }, (response) => {
                console.log(response);
            })
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminada!',
                    'La venta fue eliminada',
                    'success'
                ).then(function() {
                    location.href = '../vista/vistaVentas.php'
                })
            }
        })


    })

    $('#tabla_venta tbody').on('click', '.ver', function() {
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion = "ver";
        $('#codigo_venta').html(datos.id_venta);
        $('#fecha_venta').html(datos.fecha_venta);
        $('#cliente_venta').html(datos.nombre_cliente);
        $('#dni_venta').html(datos.dni_cliente);
        $('#email_venta').html(datos.email_cliente);
        $('#direccion_venta').html(datos.direccion_cliente);
        $('#telefono_venta').html(datos.telefono_cliente);
        $('#total_venta').html(datos.total_venta);
        $.post('../controlador/ventaProductoController.php', { funcion, id }, (response) => {
            let registros = JSON.parse(response);
            let template = "";
            registros.forEach(registro => {
                template += `
                <tr>
                    <td>${registro.nombre_producto}</td>
                    <td>${registro.nombre_categoria}</td>
                    <td>${registro.cantidad_producto}</td>
                    <td>$${registro.precio_producto_venta}</td>                
                </tr>                
                `;
                $('#registros').html(template);

            })

        })

    })

})



let espanol =

    {
        "processing": "Procesando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"

    };