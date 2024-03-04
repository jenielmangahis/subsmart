<?php if ($activity_logs) { ?>
    <table class="nsm-table" id="dashboard-activity-logs">
    <thead>
        <tr><td data-name="Activity"></td></tr>
    </thead>
    <tbody>
        <?php foreach ($activity_logs as $logs) : ?>
        <tr>
            <td>
                <div class="widget-item">
                    <?php $image = userProfilePicture($logs->user_id); ?>
                    <?php if (is_null($image)) { ?>
                        <div class="nsm-profile">
                            <span><?php echo getLoggedNameInitials($logs->user_id); ?></span>
                        </div>
                    <?php } else { ?>
                        <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
                    <?php } ?>
                    <div class="content">
                        <div class="details">
                            <span class="content-title"><?= $logs->first_name . " " . $logs->last_name ?></span>
                            <span class="content-subtitle d-block"><?= $logs->email ?></span>
                        </div>
                        <div class="controls">
                            <?php
                            if ($logs->activityName == "User Login") :
                            ?>
                                <span class="nsm-badge success"><?= $logs->activityName; ?></span>
                            <?php
                            else :
                            ?>
                                <span class="nsm-badge error"><?= $logs->activityName; ?></span>
                            <?php
                            endif;
                            ?>
                            <span class="content-subtitle d-block mt-3"><?= date('F d, Y g:i A', strtotime($logs->createdAt)) ?></span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php } else { ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Activity logs is empty.</span>
    </div>
<?php } ?>
<script>
$(function(){
    $("#dashboard-activity-logs").nsmPagination({itemsPerPage:5});
});
</script>