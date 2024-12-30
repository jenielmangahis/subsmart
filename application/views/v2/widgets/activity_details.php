<?php if ($activity_logs) { ?>
<table class="nsm-table" id="dashboard_activity_logs">
    <thead>
        <tr>
            <td data-name="LogsDetailsProfile" style="width:70%;"></td>
            <td data-name="LogsDetailsDetails"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8'];
        foreach ($activity_logs as $logs) : ?>
        <?php 
          $colorSelected = $colors[array_rand($colors)];
        ?>
        <tr>
            <td>
                <div class="widget-item position-relative">
                    <?php $image = userProfilePicture($logs->user_id); ?>
                    <div class="profile-wrapper">
                        <?php 
                        if (is_null($image)) { ?>
                        <div class="profile">
                            <span><?php echo getLoggedNameInitials($logs->user_id); ?></span>
                        </div>
                        <?php } else { ?>
                        <div class="profile" style="background-image: url('<?php echo $image; ?>');">
                        </div>
                        <?php } ?>
                    </div>
                    <div class="content">
                        <div class="details" style="width:98% !important;">
                            <span class="content-title"><?= $logs->first_name . ' ' . $logs->last_name ?></span>
                            <span class="content-subtitle d-block"><?= $logs->email ?></span>
                            <span class="content-subtitle badge-item"  style="background: <?= $colorSelected ?>;">
                                <?php
                                if (strpos($logs->activity_name, 'Logged in') !== false) {
                                    echo 'Logged In';
                                } elseif (strpos($logs->activity_name, 'Logged Out') !== false) {
                                    echo 'Logged Out';
                                } else {
                                    echo $logs->activity_name;
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="content-subtitle d-flex align-items-center justify-content-center date-item"  style="background: <?= $colorSelected ?>;">
                    <i class='bx bx-calendar'></i>
                    <p><?= date('F d, Y g:i A', strtotime($logs->created_at)) ?></p>
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
    $(function() {
        $("#dashboard_activity_logs").nsmPagination({
            itemsPerPage: 5
        });
        resizeSidebar();
    });
</script>
