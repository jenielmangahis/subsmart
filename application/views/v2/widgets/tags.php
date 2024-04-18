<style>
.btn-manage-tags{
    float:right;
}
</style>
<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Tags</span>
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
        <a class="nsm-button primary btn-manage-tags" href="<?= base_url('job/job_tags'); ?>">Manage Tags</a>        
        <div class="nsm-badge-group tags-container" style="clear:both;">            
            <div class="nsm-loader">
                <i class='bx bx-loader-alt bx-spin'></i>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let stat_colors = [];
    let stat_tags   = [];
    let stat_tag_count = [];
    let badgeClasses = ["", "success", "error", "primary"];
    $(document).ready(function() {
        loadTodayStats();
    });

    function generateRandomColor() {
      color = "hsl(" + Math.random() * 360 + ", 100%, 75%)";
      return color;
    }

    function loadTodayStats() {
        $.ajax({
            async: false,
            url: '<?php echo base_url(); ?>widgets/getV2JobTags',
            method: 'get',
            data: {},
            success: function(response) {
                $('.tags-container').html(response);

                let _statsItems = $('.stats-item');
                _statsItems.each(function() {
                    //$(this).addClass(badgeClasses[Math.floor(Math.random() * badgeClasses.length)]);
                    var tag_name   = $(this).attr('data-tag');
                    var tag_count   = $(this).attr('data-tagcount');
                    var stat_color = generateRandomColor();
                    stat_colors.push(stat_color);
                    stat_tags.push(tag_name);
                    stat_tag_count.push(tag_count);
                    $(this).css("background-color", stat_color);
                });
            }

        });
    }
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>
