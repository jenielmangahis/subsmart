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
    <div class="nsm-card-content jobs_stat">
    <div class="nsm-widget-table">
            <div class="stat_content">
                <div class="row row-pad">
                    <div class="col">
                        <div class="row">
                            <div class="col-9">
                                <h6>Source</h6>
                            </div>
                            <div class="col-3" style="text-align: center;">
                                <h6>Count</h6>
                            </div>
                        </div>
                    </div>
                    <?php foreach($leadSources as $source): ?>
                    <div class="row js-row-dash">
                        <div class="col">
                            <div class="row">
                                <div class="col-9 marg-top">
                                    <div class="jname"> <?= $source->ls_name; ?></div>
                                </div>
                                <div class="col-3 col-center">
                                    <div class="row">
                                        <div class="col" style="padding-top: 5px;"> <?= $source->leadSourceCount; ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //initializeLeadSourceChart();
    });

    function initializeLeadSourceChart(){
        $.ajax({
            url: '<?= base_url('widgets/getLeadSource') ?>',
            method: 'get',
            data: {},
            dataType:'json',
            success: function (response) {
                populateLeadSourceChart(response.leadSource, response.leadNames);
            }
        });
    }

    function populateLeadSourceChart(leadSource, leadNames){
        var lead_source = $("#lead_source_chart");

        new Chart(lead_source, {
          type: 'doughnut',
          data: {
            labels: leadNames,
            datasets: [{
              data: leadSource,
              backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: 'bottom',
              },
            },
            aspectRatio: 1.5,
          }
        });
    }
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>