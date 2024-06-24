<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>
<style>
.widget-legend-header{
    margin-top: 48px;
    margin-bottom: 49px;
    background-color: #6a4a86;
    color: #ffffff;
    padding: 10px;
}
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Estimates</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>estimate">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">                    
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row mb-4 mt-2">
            <div class="col-4">
                <select class="nsm-field form-select" name="filter_date" id="widget-open-estimates-filter-date">   
                    <option value="custom">Custom</option>
                    <option value="this-month">This month</option>
                    <option value="this-quarter">This quarter</option>
                    <option value="this-year" selected="">This year</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" id="widget-open-estimates-filter-from" class="nsm-field form-control widget-open-estimates-datepicker" value="<?= date("01/Y"); ?>" />
            </div>
            <div class="col-4">
                <input type="text" id="widget-open-estimates-filter-to" class="nsm-field form-control widget-open-estimates-datepicker" value="<?= date("12/Y"); ?>" required>
            </div>
        </div>  
        <h4 class="widget-legend-header">Total Estimates : <span id="estimate-chart-total-estimates">0</span></h4>
        <canvas id="estimates_chart" class="nsm-chart" data-chart-type="estimates"></canvas>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    initializeOpenEstimatesChart();
});

function initializeOpenEstimatesChart(){
    $(".widget-open-estimates-datepicker").datepicker( {
        format: "mm/yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });

    $('#widget-open-estimates-filter-date').on('change', function(){
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

        $('#widget-open-estimates-filter-from').val(moment(from_date).format('MM/YYYY'));
        $('#widget-open-estimates-filter-to').val(moment(to_date).format('MM/YYYY'));
        
        loadOpenEstimatesChart();
    });

    $('#widget-open-estimates-filter-from, #widget-open-estimates-filter-to').on('change', function(){
        loadOpenEstimatesChart();
    });
    loadOpenEstimatesChart();
}

function loadOpenEstimatesChart(){  
    var chartInstance = Chart.getChart("estimates_chart");  
    if (chartInstance) {
        chartInstance.destroy();
    }   
    
    var filter_date_from = $('#widget-open-estimates-filter-from').val();
    var filter_date_to   = $('#widget-open-estimates-filter-to').val();

    $.ajax({
        url: base_url + 'widgets/_load_open_estimates_chart',
        method: 'post',
        data: {filter_date_from:filter_date_from,filter_date_to:filter_date_to},
        dataType: 'json',
        success: function (data) {              
            $('#estimate-chart-total-estimates').html(data.total_estimates); 
            var openEstimate      = $('#estimates_chart');
            var openEstimateChart = new Chart(openEstimate, {
                type: 'pie',        
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                    },
                    aspectRatio: 1.5,
                },
            }); 

            var estimate_labels = data.chart_labels;
            var estimate_data = {
                labels: estimate_labels,
                datasets: [{
                    backgroundColor: [
                        '#bfbfbf',
                        '#4da6ff',
                        '#2eb82e',
                        '#70db70',
                        '#cc66ff'                                
                    ],
                    borderColor: [
                        '#8c8c8c',
                        '#0073e6',
                        '#2eb82e',
                        '#29a329',
                        '#8800cc'                                
                    ],
                    data: data.chart_data,
                },]
            };

            openEstimateChart.data = estimate_data;
            openEstimateChart.update();
        }
    });
}
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>