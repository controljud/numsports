google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    idTemporada = $('#idTemporada').val();
    $.ajax({
        url: '../posicoes-dinamicas',
        data: {
            idTemporada: idTemporada
        },
        success: function(response) {
            var data = new google.visualization.DataTable();
            
            data.addColumn('number', '');
            for (i = 0; i < response[0].length; i++) {
                data.addColumn('number', response[0][i].nome);
            }
            
            data.addRows(response[1]);

            var options = {
                width: '100%',
                height: 450,
                axes: {
                    x: {
                        0: {side: 'top'}
                    }
                },
                hAxis: {
                    viewWindow: {
                        min: 0,
                        max: (response[2] + 2)
                    },
                },
                vAxis: {
                    viewWindow: {
                        min: -(response[0].length),
                        max: 0
                    },
                    gridlines: {
                        color: 'transparent'
                    }
                },
                selectionMode: 'multiple',
                legend: {
                    textStyle: {
                        fontSize: 10,
                        marginBottom: 0
                    }
                }
            };
            
            var chart = new google.charts.Line(document.getElementById('line_top_x'));
        
            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    });
}