<?php
if ($activity_logs) {
    foreach ($activity_logs as $logs) :
?>
        <div class="widget-item">
            <?php
            $image = userProfilePicture($logs->user_id);
            if (is_null($image)) {
            ?>
                <div class="nsm-profile">
                    <span><?php echo getLoggedNameInitials($logs->user_id); ?></span>
                </div>
            <?php
            } else {
            ?>
                <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
            <?php
            }
            ?>
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
                    <span class="content-subtitle d-block mt-1"><?= date('F d, Y g:i A', strtotime($logs->createdAt)) ?></span>
                </div>
            </div>
        </div>
    <?php
    endforeach;
} else {
    ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Job list is empty.</span>
    </div>
<?php
}
?>