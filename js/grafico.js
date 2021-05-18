$(document).ready(function() {
    let funcion;
    venta_mes();
    async function venta_mes() {
        funcion = 'venta_mes';
        let lista = ['', '', '', '', '', '', '', '', '', '', '', ''];
        const response = await fetch('../controlador/ventaController.php', {
                method: 'POST',
                headers: { 'Content-type': 'application/x-www-form-urlencoded' },
                body: 'funcion=' + funcion
            }).then(function(response) {
                return response.json();
            }).then(function(meses) {
                meses.forEach(mes => {
                    if (mes.mes == 1) {
                        lista[0] = mes;
                    }
                    if (mes.mes == 2) {
                        lista[1] = mes;
                    }
                    if (mes.mes == 3) {
                        lista[2] = mes;
                    }
                    if (mes.mes == 4) {
                        lista[3] = mes;
                    }
                    if (mes.mes == 5) {
                        lista[4] = mes;
                    }
                    if (mes.mes == 6) {
                        lista[5] = mes;
                    }
                    if (mes.mes == 7) {
                        lista[6] = mes;
                    }
                    if (mes.mes == 8) {
                        lista[7] = mes;
                    }
                    if (mes.mes == 9) {
                        lista[8] = mes;
                    }
                    if (mes.mes == 10) {
                        lista[9] = mes;
                    }
                    if (mes.mes == 11) {
                        lista[10] = mes;
                    }
                    if (mes.mes == 12) {
                        lista[11] = mes;
                    }
                });
            })
            // console.log(lista)

        let Canvas = $("#Grafico1").get(0).getContext('2d');
        let datos = {
            labels: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre',

            ],
            datasets: [{
                label: 'Recaudado',
                backgroundColor: 'rgba(60,141,188,0.1)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                pointColor: '#3b8bba',
                pointRadius: 6,
                pointStrokeColor: 'rgba(60,141,188,5)',
                pointHighlightFill: '#3b8bba',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [
                    lista[0].cantidad,
                    lista[1].cantidad,
                    lista[2].cantidad,
                    lista[3].cantidad,
                    lista[4].cantidad,
                    lista[5].cantidad,
                    lista[6].cantidad,
                    lista[7].cantidad,
                    lista[8].cantidad,
                    lista[9].cantidad,
                    lista[10].cantidad,
                    lista[11].cantidad,
                ]
            }]
        }

        var opciones = {
            maintainAspectRatio: false,
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            legend: {
                display: false,
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Detalle de ventas mensual'
                }
            },
        }

        new Chart(Canvas, {
            type: 'line',
            data: datos,
            options: opciones

        })

    }

})