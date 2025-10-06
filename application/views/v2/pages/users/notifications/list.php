<?php include viewPath('v2/includes/header'); ?>
<style>
#notification-list .nsm-profile{
    max-width:40px;
    margin: 2px;
    margin-right: 10px;
}
#notification-list .content{
    flex: auto;
    padding-left: 5px;
    padding-right: 5px;
    justify-content: center;
    display: flex;
    min-width: 0;
}
#notification-list .widget-item {
    display: flex;
    cursor: default;
    padding: 5px;
    min-height: 50px;
}
.row-date span{
    font-size:14px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page notification-list-container">
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
                
                <?php if ($notifications) { ?>
                    <table class="nsm-table" id="notification-list">
                        <thead>
                            <tr>
                                <td data-name="LogsDetailsProfile" style="width:75%;"></td>
                                <td data-name="LogsStatus" style="width:10%;">Status</td>
                                <td data-name="LogsDate" style="width:15%;">Date</td>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($notifications as $notification) : ?>
                            <tr>
                                <td class="nsm-text-primary">
                                    <div class="widget-item">
                                        <?php $image = userProfilePicture($notification->user_id); ?>
                                        <?php if (is_null($image)) { ?>
                                            <div class="nsm-profile" style="margin-top:17px;">
                                                <span><?php echo getLoggedNameInitials($notification->user_id); ?></span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="nsm-profile" style="margin-top:17px;background-image: url('<?php echo $image; ?>');"></div>
                                        <?php } ?>
                                        <div class="content">
                                            <div class="details" style="width:98% !important;">
                                                <span class="content-title"><?= $notification->FName . " " . $notification->LName ?></span>  
                                                <span class="content-subtitle d-block"><?= $notification->email; ?></span>      
                                                <span class="content-subtitle d-block" style="margin-top:7px;font-weight:bold;line-height:18px;">
                                                    
                                                    <?php 
                                                        if(is_string($notification->title) && strtolower($notification->title) == 'new work order') {
                                                            echo '<a href="'.site_url("workorder").'">' . $notification->title . ' | ' . $notification->content . '</a>';
                                                        } elseif(is_string($notification->title) && (strtolower($notification->title) == 'new estimates' || strtolower($notification->title) == 'new estimate')) {
                                                            echo '<a href="'.site_url("estimate").'">' . $notification->title . ' | ' . $notification->content . '</a>';
                                                        } elseif(is_string($notification->title) && (strtolower($notification->title) == 'clock in' || strtolower($notification->title) == 'clock out')) {
                                                            echo '<a href="'.site_url("timesheet/attendance").'">' . $notification->title . ' | ' . $notification->content . '</a>';
                                                        } elseif(is_string($notification->title) && (strtolower($notification->title) == 'invoice overdue' || strtolower($notification->title) == 'invoice late fee')) {
                                                            echo '<a href="'.site_url("invoice").'">' . $notification->title . ' | ' . $notification->content . '</a>';
                                                        } else {
                                                            echo $notification->title . ' | ' . $notification->content;
                                                        }   
                                                    ?>                                                    
                                                </span>
                                            </div>                            
                                        </div>
                                    </div>
                                </td>
                                <?php 
                                    $status = "";
                                    if($notification->status == 1) {
                                        $status = "Unread";
                                        $badge = "error";
                                    }elseif($notification->status == 0) {
                                        $status = "Read";
                                        $badge = "success";
                                    }
                                ?>
                                <td><span class="nsm-badge <?= $badge ?>"><?php echo $status; ?></span></td>
                                <td class="nsm-text-primary">
                                    <span class="content-subtitle d-block"><?= date('F d, Y g:i A', strtotime($notification->date_created)) ?></span>
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
    $("#notification-list").nsmPagination({itemsPerPage:10});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));
});
</script>
<?php include viewPath('v2/includes/footer'); ?>