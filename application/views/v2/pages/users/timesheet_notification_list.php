<?php include viewPath('v2/includes/header'); ?>
<style>
#activity-logs .nsm-profile{
    max-width:40px;
    margin: 2px;
    margin-right: 10px;
}
#activity-logs .content{
    flex: auto;
    padding-left: 5px;
    padding-right: 5px;
    justify-content: center;
    display: flex;
    min-width: 0;
}
#activity-logs .widget-item {
    display: flex;
    cursor: default;
    padding: 5px;
    min-height: 50px;
}
.row-date span{
    font-size:14px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('email_campaigns/add_email_blast') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page activity-logs-container">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            User Notifications
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search List">
                        </div>
                    </div>  
                </div>       
                
                <?php if ($activityLogs) { ?>
                    <table class="nsm-table" id="activity-logs">
                        <thead>
                            <tr>
                                <td data-name="LogsDetailsProfile" style="width:90%;"></td>
                                <td data-name="LogsDetailsDetails">Date</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activityLogs as $logs) : ?>
                            <tr>
                                <td class="nsm-text-primary">
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
                                <td class="nsm-text-primary">
                                    <span class="content-subtitle d-block"><?= date('F d, Y g:i A', strtotime($logs->created_at)) ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="nsm-empty">
                        <i class='bx bx-meh-blank'></i>
                        <span>Notification logs is empty.</span>
                    </div>
                <?php } ?>
                
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){    
    $("#activity-logs").nsmPagination({itemsPerPage:5});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));
});
</script>
<?php include viewPath('v2/includes/footer'); ?>