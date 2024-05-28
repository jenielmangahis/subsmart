<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Sales</span>            
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url('accounting/allsales') ?>">
                See More
            </a>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content d-flex justify-content-center flex-column align-items-center">
        <div class="row mb-4 mt-2">
            <div class="col-4">
                <select class="nsm-field form-select" name="filter_date" id="widget-sales-filter-date">   
                    <option value="custom">Custom</option>
                    <option value="this-month">This month</option>
                    <option value="this-quarter">This quarter</option>
                    <option value="this-year" selected="">This year</option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" id="widget-sales-filter-from" class="nsm-field form-control widget-sales-datepicker" value="<?= date("01/Y"); ?>" />
            </div>
            <div class="col-4">
                <input type="text" id="widget-sales-filter-to" class="nsm-field form-control widget-sales-datepicker" value="<?= date("12/Y"); ?>" required>
            </div>
        </div>  

        <canvas id="sales_chart" class="nsm-chart" data-chart-type="sales"></canvas>
    </div>
    
</div>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>
<script>
$(function(){
    var sales      = $('#sales_chart');
    var salesChart = new Chart(sales, {
        type: 'line',        
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',                    
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 10
                },
            },
            aspectRatio: 1.5,
        },
    });

    $(".widget-sales-datepicker").datepicker( {
        format: "mm/yyyy",
        viewMode: "months", 
        minViewMode: "months"
    });

    $('#widget-sales-filter-date').on('change', function(){
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

        $('#widget-sales-filter-from').val(moment(from_date).format('MM/YYYY'));
        $('#widget-sales-filter-to').val(moment(to_date).format('MM/YYYY'));

        loadSalesChart();
    });

    $('#widget-sales-filter-from, #widget-sales-filter-to').on('change', function(){
        loadSalesChart();
    });

    loadSalesChart();
    function loadSalesChart(){    

        var filter_date_from = $('#widget-sales-filter-from').val();
        var filter_date_to   = $('#widget-sales-filter-to').val();

        $.ajax({
            url: base_url + 'widgets/_load_sales_chart',
            method: 'post',
            data: {filter_date_from:filter_date_from,filter_date_to:filter_date_to},
            dataType: 'json',
            success: function (data) {                
                const sales_labels = data.chart_labels;
                const sales_data = {
                    labels: sales_labels,
                    datasets: [{
                            label: 'Sales',
                            backgroundColor: 'rgb(106, 74, 134)',
                            borderColor: 'rgb(106, 74, 134)',
                            data: data.chart_data_sales,
                        },
                        {
                            label: 'Jobs',
                            backgroundColor: 'rgb(51, 153, 255)',
                            borderColor: 'rgb(51, 153, 255)',
                            data: data.chart_data_jobs,
                        },
                        {
                            label: 'Services',
                            backgroundColor: 'rgb(255, 102, 0)',
                            borderColor: 'rgb(255, 102, 0)',
                            data: data.chart_data_services,
                        }
                    ]
                };

                salesChart.data = sales_data;
                salesChart.update();
            }
        });
    }
});
</script>