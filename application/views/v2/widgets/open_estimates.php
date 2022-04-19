<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

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
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content d-flex justify-content-center align-items-center">
        <?php
            $draft = 0;
            $accepted = 0;
            $invoiced = 0;
            $other = 0;

            foreach ($estimate_draft as $estimate):
                switch ($estimate->status){
                    case 'Draft';
                        $draft++;
                        break;
                    case 'Accepted';
                        $accepted++;
                        break;
                    case 'Invoiced';
                        $invoiced++;
                        break;
                    default;
                        $other++;
                        break;
                }
            endforeach;

            $draft_percent = number_format((float)$draft/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
            $accepted_percent = number_format((float)$accepted/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
            $invoiced_percent = number_format((float)$invoiced/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
            $other_percent = number_format((float)$other/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
        ?>
        <canvas id="estimates_chart" class="nsm-chart" data-chart-type="estimates"></canvas>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        initializeEstimatesChart();
    });

    function initializeEstimatesChart(){
        var estimates = $("#estimates_chart");

        new Chart(estimates, {
          type: 'pie',
          data: {
            labels: ['Draft', 'Accepted', 'Invoiced', 'Other'],
            datasets: [{
              label: 'Estimates',
              data: [
                '<?= $draft_percent; ?>',
                '<?= $accepted_percent; ?>',
                '<?= $invoiced_percent; ?>',
                '<?= $other_percent; ?>'
              ],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
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