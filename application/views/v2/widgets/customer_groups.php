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
            <span>Customer Groups</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('customer/group'); ?>">
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
        <canvas id="customer_groups_chart" class="nsm-chart" data-chart-type="customer-groups"></canvas>
    </div>
</div>


<script type="text/javascript">
$(function(){
    loadCustomerGroupChart();
});
function loadCustomerGroupChart(){   
    var chartInstance = Chart.getChart("customer_groups_chart");  
    if (chartInstance) {
        chartInstance.destroy();
    }   
    var customerGroup      = $('#customer_groups_chart');
    var customerGroupChart = new Chart(customerGroup, {
        type: 'doughnut',        
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

    $.ajax({
        url: base_url + 'widgets/_load_customer_group_chart',
        method: 'post',
        dataType: 'json',
        success: function (data) {        
            const chart_labels = data.chart_labels;
            const chart_data = {
                labels: chart_labels,
                datasets: [{
                    data: data.chart_data,
                    backgroundColor: data.chart_colors,
                    borderColor: data.chart_colors,
                    borderWidth: 0.5                            
                },]
            };

            customerGroupChart.data = chart_data;
            customerGroupChart.update();
        }
    });
}
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>