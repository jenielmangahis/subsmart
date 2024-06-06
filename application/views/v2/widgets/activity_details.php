<?php if ($activity_logs) { ?>
    <table class="nsm-table" id="dashboard_activity_logs">
        <thead>
            <tr>
                <td data-name="LogsDetailsProfile" style="width:72%;"></td>
                <td data-name="LogsDetailsDetails"></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activity_logs as $logs) : ?>
            <tr>
                <td>
                    <div class="widget-item">
                        <?php $image = userProfilePicture($logs->user_id); ?>
                        <?php if (is_null($image)) { ?>
                            <div class="nsm-profile" style="margin-top:17px;">
                                <span><?php echo getLoggedNameInitials($logs->user_id); ?></span>
                            </div>
                        <?php } else { ?>
                            <div class="nsm-profile" style="margin-top:17px;background-image: url('<?php echo $image; ?>');"></div>
                        <?php } ?>
                        <div class="content">
                            <div class="details" style="width:98% !important;">
                                <span class="content-title"><?= $logs->first_name . " " . $logs->last_name ?></span>  
                                <span class="content-subtitle d-block"><?= $logs->email; ?></span>      
                                <span class="content-subtitle d-block" style="margin-top:7px;font-weight:bold;line-height:18px;">
                                    <?php 
                                        if( strpos($logs->activity_name, 'Logged in') !== false ){
                                            echo 'Logged In';
                                        }elseif( strpos($logs->activity_name, 'Logged Out') !== false ){
                                            echo 'Logged Out';
                                        }else{
                                            echo $logs->activity_name;
                                        }
                                    ?>
                                </span>
                            </div>                            
                        </div>
                    </div>
                </td>
                <td>
                    <span class="content-subtitle d-block" style="font-size:11px;"><i class='bx bx-calendar' style="position:relative;top:3px;color:#000000;font-size:17px;"></i> <?= date('F d, Y g:i A', strtotime($logs->created_at)) ?></span>
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
    $("#dashboard_activity_logs").nsmPagination({itemsPerPage:5});
    resizeSidebar();
});
</script>