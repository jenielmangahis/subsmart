<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .lead-source-content {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        /* box-shadow: 0px 3px 12px #38747859; */
        padding: 10px;
        height: unset;
    }
</style>
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
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="nsm-card-content ">
        <div class="banner mb-4">
            <img src="./assets/img/paid-invoices-banner2.svg" alt="">

        </div>
        <div class="lead-source-content">
            <canvas id="lead-source" class="nsm-chart" data-chart-type="lead-source" ></canvas>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initializeLeadSourceChart();
    });

    function initializeLeadSourceChart() {
        $.post('<?php echo base_url('widgets/getLeadSource'); ?>', function(data) {
            var response = jQuery.parseJSON(data);
            var LEAD_SOURCE = "[";
            var LEAD_SOURCE_COUNT = "[";
            for (var i = 0; i < response.length; i++) {
                if (response[i].lead_source != 'Door Knocking') {
                    if (response[i].lead_source == 'Door') {
                        response[i].lead_source = 'Self Generated';
                    }

                    LEAD_SOURCE += "'" + response[i].lead_source + " (" + response[i].leadSourceCount + ")',";
                    LEAD_SOURCE_COUNT += "" + response[i].leadSourceCount + ",";
                }
            }
            LEAD_SOURCE += "]";
            LEAD_SOURCE_COUNT += "]";
            var ctx = document.getElementById("lead-source");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: eval(LEAD_SOURCE),
                    datasets: eval(LEAD_SOURCE_COUNT),
                    datasets: [{
                        data: eval(LEAD_SOURCE_COUNT),
                        backgroundColor: [
                            "#33757b",
                            '#FEA303',
                            '#d9a1a0',
                            '#BEAFC2',
                            '#EFB6C8',
                            '#FFD2A0',
                            '#F29F58',
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
                    },
                    aspectRatio: 1,
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
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
