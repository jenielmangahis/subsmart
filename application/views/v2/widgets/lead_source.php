<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Lead Source</span>
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

    
    <div class="nsm-card-content ">
    <!-- <div style=" float: left; position: relative;">
        <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">Sources</div>
        <canvas id="lead_source_chart" class="nsm-chart" data-chart-type="expenses"></canvas>
    </div>    --> 
        <br>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                 <center>    
                    <canvas id="lead-source" class="nsm-chart" data-chart-type="lead-source" width="335" height="335"></canvas>
                </center>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    initializeLeadSourceChart();
});
function initializeLeadSourceChart(){
    $.post('<?php echo base_url("widgets/getLeadSource") ?>', function(data) {
        var response = jQuery.parseJSON(data); 
        var LEAD_SOURCE = "["; var LEAD_SOURCE_COUNT = "[";
        for (var i = 0; i < response.length; i++) {
            LEAD_SOURCE += "'"+response[i].lead_source+" ("+response[i].leadSourceCount+")',";
            LEAD_SOURCE_COUNT += ""+response[i].leadSourceCount+",";
        }
        LEAD_SOURCE += "]"; LEAD_SOURCE_COUNT += "]";
        var ctx = document.getElementById("lead-source");
        var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: eval(LEAD_SOURCE),
            datasets: eval(LEAD_SOURCE_COUNT),
            datasets: [{
            data: eval(LEAD_SOURCE_COUNT),
            backgroundColor: [
                '#FFA630',
                '#D7E8BA',
                '#4DA1A9',
                '#2E5077',
                '#611C35',
                '#B5FED9',
            ],
            borderColor: [
                '#FFA630',
                '#D7E8BA',
                '#4DA1A9',
                '#2E5077',
                '#611C35',
                '#B5FED9',
            ],
            borderWidth: 0.5

            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: "bottom",
                }
            }
        }
        });
    });
}
 //    function initializeLeadSourceChart(){
 //        $.ajax({
 //            url: '<?= base_url('widgets/getLeadSource') ?>',
 //            method: 'get',
 //            data: {},
 //            dataType:'json',
 //            success: function (response) {
 //                populateLeadSourceChart(response.leadSource, response.leadNames);
 //            }
 //        });

 //        fetch('<?= base_url('widgets/getLeadSource') ?>',{

 //        }).then(response => response.json()).then(response =>{
 //            var {leadSource, leadNames} = response;
 //            populateLeadSourceChart(leadSource, leadNames);
 //            console.log(response);
 //        })
 //    //}

 //    function populateLeadSourceChart(){
 //        var lead_source = $("#lead_source_chart");
        
 //        new Chart(lead_source, {
 //          type: 'doughnut',
 //          data: {
 //            labels: "sa",
 //            datasets: [{
 //              data: "hh",
 //              backgroundColor: [
 //                "dd",
 //              ],
 //              borderWidth: 1
 //            }]
 //          },
 //          options: {
 //            responsive: true,
 //            plugins: {
 //              legend: false,
 //            },
 //            aspectRatio: 1.5,
            
 //          }
 //        });
 //    }

 // $(document).ready(function(){
 //        populateLeadSourceChart();
 //    });
    
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>