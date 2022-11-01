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
            <?php foreach ($upcomingServiceTickets as $st) : ?>
                <tr class="schedule-jobs" style="cursor: pointer" onclick="location.href='<?php echo base_url('tickets/viewDetails/' . $st->id); ?>'">
                    <td>
                        <?php 
                            $event_month = date("F", strtotime($st->ticket_date));
                            $event_day   = date("d", strtotime($st->ticket_date));
                            $event_day_word = date("D", strtotime($st->ticket_date));
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
                            <span class="nsm-badge primary"><?php echo strtoupper($st->ticket_status); ?></span>                            
                        </div>                    
                    </td>
                    <td style="vertical-align: text-top;padding-top: 17px;">
                        <label class="content-title" style="cursor: pointer;margin-bottom: 11px;font-size: 17px;">                            
                            <?php 
                                $tags = '';
                                if( $st->job_tag != '' ){
                                    $tags = $st->job_tag;
                                }
                                echo $st->ticket_no . ' : ' . $tags;
                            ?>        
                        </label>                        
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bxs-user-rectangle'></i> <?= $st->first_name . ' ' . $st->last_name; ?>
                        </label>
                        <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                            <i class='bx bxs-phone'></i> <?= $st->phone_m != '' ? $st->phone_m : '---'; ?>
                        </label>
                        <!-- <label class="content-title" style="cursor: pointer">
                            <i class='bx bxs-map-pin'></i> <?= $st->service_location; ?>
                        </label> -->
                        <label class="content-title" style="cursor: pointer;">
                            <i class='bx bxs-calendar-x'></i> Sheduled Time : <?php echo $st->scheduled_time; ?>
                        </label>                        
                    </td>
                    <!-- <td class="text-end">
                            <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                                <div class="nsm-profile" style="background-image: url('<?php echo userProfileImage($ue->employee_id); ?>');" data-img="<?php echo userProfileImage($ue->employee_id); ?>"></div>                            
                            </div>
                    </td> -->
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