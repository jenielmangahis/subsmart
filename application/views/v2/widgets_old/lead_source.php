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

    <?php 
        $bgColors =  ['"rgba(75, 192, 192, 0.2)"',
        '"rgba(153, 102, 255, 0.2)"',
        '"rgba(54, 162, 235, 1)"',
        '"rgba(255, 99, 132, 0.2)"',
        '"rgba(54, 162, 235, 0.2)"',
        '"rgba(255, 206, 86, 0.2)"',
        '"rgb(255, 205, 86, 0.2)"',
        '"rgba(255, 159, 64, 0.2)"',
        '"rgba(65, 159, 64, 0.2)"'];
    
    $sources = [];
    $sourcesCount = [];
    foreach($leadSources as $source): ?>
        <?php 
            $sources[] = "'".$source->ls_name."'";
            $sourcesCount[] = $source->leadSourceCount;
        ?>
    <?php endforeach; ?>
   
    <div class="nsm-card-content ">
    <div style=" float: left; position: relative;">
        <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -20px; line-height:19px; text-align: center; z-index: 999999999999999">
            <?= count($leadSources) ?><Br />
            Sources
        </div>
        <canvas id="lead_source_chart" class="nsm-chart" data-chart-type="expenses"></canvas>
    </div>    
        <br>
        <div class="row">
            <?php $x=0; foreach($leadSources as $source): ?>
            <div class="col-md-12">
                <span class="tagsData" href="javascript:void(0);">
                    <span class=" big badge-circle"><b><?= $source->leadSourceCount ?></b>
                    <span class="nsm-badge  badge-circle stat-bar stats-item" style="background-color: <?= str_replace('"', "", $bgColors[$x]) ?>;"></span>  <?= $source->lead_source ?></span>
                </span>
            </div>
            <?php $x++; endforeach; ?>
        </div>
    </div>
    
</div>

<script type="text/javascript">
    $(document).ready(function(){
        populateLeadSourceChart();
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

    function populateLeadSourceChart(){
        var lead_source = $("#lead_source_chart");
        
        new Chart(lead_source, {
          type: 'doughnut',
          data: {
            labels: <?php echo '[' . implode(',', $sources) . ']'; ?>,
            datasets: [{
              data: <?php echo '[' . implode(',', $sourcesCount) . ']'; ?>,
              backgroundColor: [
                <?php echo  implode(',', $bgColors); ?>,
              ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: false,
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