<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Service Tickets</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row mb-4 mt-2">
            <div class="col-4">
                <select class="nsm-field form-select" name="filter_date" id="widget-service-ticket-filter-date">   
                    <option value="custom">Custom</option>
                    <option value="this-month">This month</option>
                    <option value="this-quarter">This quarter</option>
                    <option value="this-year" selected="">This year</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" id="widget-service-ticket-filter-from" class="nsm-field form-control widget-service-ticket-datepicker" value="<?= date("01/Y"); ?>" />
            </div>
            <div class="col-4">
                <input type="text" id="widget-service-ticket-filter-to" class="nsm-field form-control widget-service-ticket-datepicker" value="<?= date("12/Y"); ?>" required>
            </div>
        </div>  
        <canvas id="service_tickets_chart" class="nsm-chart" data-chart-type="service_tickets"></canvas>
    </div>
</div>
<script>
$(document).ready(function(){
    initializeServiceTicketChart();
});

function initializeServiceTicketChart(){
    $(".widget-service-ticket-datepicker").datepicker( {
        format: "mm/yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });

    $('#widget-service-ticket-filter-date').on('change', function(){
        switch($(this).val()) {            
            case 'this-month' :
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
            case 'this-quarter' :
                var date = new Date();
                var currQuarter = Math.floor(date.getMonth() / 3 + 1);
                
                switch(currQuarter) {
                    case 1 :
                        var from_date = '01/01/' + date.getFullYear();
                        var to_date = '03/31/'+ date.getFullYear();
                    break;
                    case 2 :
                        var from_date = '04/01/' + date.getFullYear();
                        var to_date = '06/30/'+ date.getFullYear();
                    break;
                    case 3 :
                        var from_date = '07/01/' + date.getFullYear();
                        var to_date = '09/30/'+ date.getFullYear();
                    break;
                    case 4 :
                        var from_date = '10/01/' + date.getFullYear();
                        var to_date = '12/31/'+ date.getFullYear();
                    break;
                }
            break;
            case 'this-year' :
                var date = new Date();

                var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                var to_date = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
            break;
            default :
                var date = new Date();
                var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date.getFullYear();
                to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate()).padStart(2, '0') + '/' + to_date.getFullYear();
            break;
        }

        $('#widget-service-ticket-filter-from').val(moment(from_date).format('MM/YYYY'));
        $('#widget-service-ticket-filter-to').val(moment(to_date).format('MM/YYYY'));

        loadServiceTicketChart();
    });

    $('#widget-service-ticket-filter-from, #widget-service-ticket-filter-to').on('change', function(){
        loadServiceTicketChart();
    });
    loadServiceTicketChart();   
}

function loadServiceTicketChart(){
    var chartInstance = Chart.getChart("service_tickets_chart");  
    if (chartInstance) {
        chartInstance.destroy();
    } 
    
    var serviceTicket = $('#service_tickets_chart');
    var serviceTicketChart = new Chart(serviceTicket, {
        type: 'line',        
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
            aspectRatio: 1,
            scales: {
                A: {
                    type: 'linear',
                    position: 'left',
                    title: {
                        display: true,
                        text: 'No of Service Tickets'
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if (parseInt(value) >= 1000) {
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                    ",");
                            } else {
                                return value;
                            }
                        }
                    }
                },
                B: {
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if (parseInt(value) >= 1000) {
                                return '$' + value.toString().replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ",");
                            } else {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        }
    });

    var filter_date_from = $('#widget-service-ticket-filter-from').val();
    var filter_date_to   = $('#widget-service-ticket-filter-to').val();

    $.ajax({
        url: base_url + 'widgets/_load_service_ticket_chart_data',
        method: 'post',
        data: {filter_date_from:filter_date_from,filter_date_to:filter_date_to},
        dataType: 'json',
        success: function (data) {              
            const ticket_labels = data.chart_labels;
            const tickets_data = {
                labels: ticket_labels,
                datasets: [{
                    label: 'Service Ticket Count',                        
                    data: data.total_tickets_number_data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    stack: 'combined',
                    type: 'bar',
                    yAxisID: "A",
                },
                {
                    label: 'Service Ticket Value',
                    data: data.total_tickets_amount_data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(191, 191, 191, 0.5)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    stack: 'combined',
                    yAxisID: "B",
                }
                ]
            };

            serviceTicketChart.data = tickets_data;
            serviceTicketChart.update();
        }
    });
}
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>