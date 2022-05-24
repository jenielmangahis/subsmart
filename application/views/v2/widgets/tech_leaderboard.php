<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>
<style>
    .nsm-widget-table .widget-item .content .details {
        width: 40% !important;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Tech Leaderboard</span>
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
            <?php foreach($techLeaderboards as $tech): ?>
            <div class="widget-item">
                <div class="nsm-profile">
                    <span><?= strtoupper($tech->FName[0].''.$tech->LName[0]) ?></span>
                </div>
                <div class="content">
                    <div class="details">
                        <span class="content-title"><?= $tech->FName .' '. $tech->LName ?></span>
                        <span class="content-subtitle d-block">Technician</span>
                    </div>
                    <div style="padding-top: 5px;">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$<?=  number_format(floatval(get_tech_revenue($tech->id)[0]->techRev), 2, '.', ','); ?></span>
                        <span class="content-subtitle d-block">revenue</span>
                        </div>
                    <div class="controls">
                        <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;"><?= $tech->customerCount; ?></span>
                        <span class="content-subtitle d-block">customers</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        //loadTechLeaderboards();
    });

    function loadTechLeaderboards(){
        $.ajax({
            url: '<?php echo base_url(); ?>widgets/loadV2TechLeaderBoard',
            method: 'get',
            data: {},
            success: function (response) {
                console.log(response);
                $('.techleaderboard-container').html(response);
            }
        });
    }
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>