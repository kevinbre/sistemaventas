$(document).ready(function() {
    listar_compras();


    function listar_compras() {
        funcion = 'listar_compras';
        $.post('../controlador/comprasController.php', { funcion }, (response) => {
            console.log(response);
            let datos = JSON.parse(response);
            let datatable = $('#tabla_compras').DataTable({
                data: datos,
                "columns": [
                    { "data": "numeracion" },
                    { "data": "fecha_compra" },
                    { "data": "usuario" },
                    { "data": "proveedor" },
                    { "data": "total" },
                    { "defaultContent": `
                                         <button class="ver btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#vista-compra"><i class="fas fa-search"></i> </button>
                                         <button class="borrar btn btn-danger btn-sm"><i class="fas fa-window-close "></i> </button>
                                         ` }
                ],
                "language": espanol
            });
        })

    }
    // $('#tabla_compras tbody').on('click', '.imprimir', function() {
    //     datatable = $('#tabla_compras').DataTable();
    //     let datos = datatable.row($(this).parents()).data();
    //     let id = datos.id_compra;
    //     funcion = 'imprimir';
    //     $.post('../controlador/comprasController.php', { id, funcion }, (response) => {
    //         console.log(response);
    //         window.open('../pdf_compra/pdf-compra-' + id + '.pdf', '_blank');

    //     })
    // })

    $('#tabla_compras tbody').on('click', '.borrar', function() {
        let datatable = $('#tabla_compras').DataTable();
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_compra;
        funcion = "borrar_compra";
        Swal.fire({
            title: 'Esta seguro de eliminar esta compra?',
            text: "Una vez borrado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar'
        }).then((result) => {
            $.post('../controlador/eliminarCompraController.php', { funcion, id }, (response) => {
                console.log(response);
            })
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminada!',
                    'La compra fue eliminada',
                    'success'
                ).then(function() {
                    location.href = '../vista/vistaCompras.php'
                })
            }
        })


    })
    $('#tabla_compras tbody').on('click', '.ver', function() {
        let datatable = $('#tabla_compras').DataTable()
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_compra;

        funcion = "obtenerDatos";

        $('#codigo_compra').html(datos.id_compra);
        $('#fecha_compra').html(datos.fecha_compra);
        $('#nombre_proveedor').html(datos.proveedor);
        $('#direccion_proveedor').html(datos.direccionprov);
        $('#telefono_proveedor').html(datos.telefonoprov);

        $.post('../controlador/comprasProductoController.php', { funcion, id }, (response) => {
            console.log(response)
            let registros = JSON.parse(response);
            let template = "";
            registros.forEach(registro => {
                template += `
                <tr>                   
                    <td>${registro.nombre_materiaprima}</td>
                    <td>${registro.medicion_materiaprima}</td>
                    <td>${registro.cantidad_mp}</td>
                    <td>$${registro.precio_mp}</td>                
                </tr>                
                `;
                $('#registros_compras').html(template);

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