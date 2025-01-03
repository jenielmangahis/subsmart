<style>
    .btn-manage-tags {
        float: right;
    }

    .tags-content {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        height: unset;
    }

    .tags-content .tags-graph-legend .col-md-6 {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tags-container canvas{
        padding: 30px;
    }

    @media screen and (max-width: 1366px) {
        .tags-content .tags-graph-legend .col-md-6 {
            width: 100%;
            justify-content: start;
        }
    }

    @media screen and (max-width: 991px) {
        .tags-content .tags-graph-legend .col-md-6 {
            width: 50%;
            justify-content: center;
        }
    }

    @media screen and (max-width: 567px) {
        .tags-content .tags-graph-legend .col-md-6 {
            width: 100%;
            justify-content: center;
        }

        .tags-content {
            margin: unset;
        }
    }
</style>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
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
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="banner mb-4">
            <img src="./assets/img/overdue-invoices-banner2.svg" alt="">
        </div>
        <div class="tags-content">
            <a class="nsm-button primary btn-manage-tags" href="<?= base_url('job/job_tags') ?>">Manage Tags</a>
            <div class="nsm-badge-group tags-container" style="clear:both;">
                <div class="nsm-loader">
                    <i class='bx bx-loader-alt bx-spin'></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const colors = ['#FEA303', '#d9a1a0', '#A888B5', '#F29F58', '#AB4459', '#A1D6CB', '#219B9D', '#E493B3', '#B784B7'];
    let stat_colors = [];
    let stat_tags = [];
    let stat_tag_count = [];
    let badgeClasses = ["", "success", "error", "primary"];
    $(document).ready(function() {
        loadTagsStats();
    });

    function getRandomColor() {
        const randomIndex = Math.floor(Math.random() * colors.length);
        return colors[randomIndex];
    }

    function loadTagsStats() {
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
                    var tag_name = $(this).attr('data-tag');
                    var tag_count = $(this).attr('data-tagcount');
                    var stat_color = getRandomColor();
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
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
