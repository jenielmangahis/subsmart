<link href="https://fonts.googleapis.com/css?family=Roboto:300,100" rel="stylesheet">
<style>
.nsm-calendar {
    background: #DAD1E0;
    border-radius: 20%;
    width: 103px;
    height: 103px;
    margin: auto;
    vertical-align: middle;
    text-align: center;
    font: 300 28.5714285714px Roboto;
}
.nsm-calendar .week {
    color: red;
    padding: 13px;
    padding-bottom: 5px;
    font-size: 20px;
    font-weight: bold;
}
.nsm-calendar .date {
    font: 45px Roboto;
    margin-top: -7px;
    font-weight: bold;
}
.nsm-list-icon{
    float: right;
}
</style>
<table class="nsm-table" id="upcoming_service_tickets_table">
    <thead>
        <tr>
            <td></td>
            <td data-name="Service Ticket Details"></td>
            <td data-name="Status"></td>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($upcomingServiceTickets)) : ?>
            <?php foreach ($upcomingServiceTickets as $ue) : ?>
                <tr class="schedule-jobs" style="cursor: pointer" onclick="location.href='<?php echo base_url('job/new_job1/' . $jb->id); ?>'">
                    <td>
                        <?php 
                            $event_month = date("F", strtotime($ue->start_date));
                            $event_day   = date("d", strtotime($ue->start_date));
                            $event_day_word = date("D", strtotime($ue->start_date));
                        ?>
                        <div class="nsm-calendar" ng-app="myApp">
                            <div class="week">
                                <b><?= $event_day_word; ?></b>
                            </div>
                            <div class="date">
                                <?= $event_day; ?>
                            </div>
                        </div>    
                        <div class="nsm-calendar-info-container" style="text-align:center;">
                            <span class="nsm-badge primary"><?php echo strtoupper($ue->status); ?></span>
                            <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer"><?php echo $ue->start_time; ?>-<?php echo $ue->end_time; ?></label>
                        </div>                    
                    </td>
                    <td style="vertical-align: text-top;padding-top: 28px;">
                        <label class="content-title" style="cursor: pointer;margin-bottom: 11px;font-size: 17px;">                            
                            <?php 
                                $tags = '';
                                if( $ue->event_tag != '' ){
                                    $tags = $ue->event_tag;
                                }
                                echo $ue->event_number . ' : ' . $tags;
                            ?>        
                        </label>                        
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bx-calendar-event'></i> <?= $ue->event_description != '' ? $ue->event_description : '---'; ?>
                        </label>
                        <label class="content-title" style="cursor: pointer">
                            <i class='bx bxs-map-pin'></i> <?= $ue->event_address; ?>
                        </label>                        
                    </td>
                    <td class="text-end">
                            <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                                <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($ue->employee_id); ?>');" data-img="<?php echo userProfileImage($ue->employee_id); ?>"></div>                            
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">
                    <div class="nsm-empty">
                        <span>No upcoming service tickets for now.</span>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>