<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

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
    <div class="nsm-card-content">
        <div class="nsm-widget-table techleaderboard-container">
            <div class="nsm-loader">
                <i class='bx bx-loader-alt bx-spin'></i>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        loadTechLeaderboards();
    });

    function loadTechLeaderboards(){
        $.ajax({
            url: '<?php echo base_url(); ?>widgets/loadV2TechLeaderBoard',
            method: 'get',
            data: {},
            success: function (response) {
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