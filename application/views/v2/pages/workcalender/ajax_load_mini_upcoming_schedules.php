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
.location-list{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.location-list li{
    margin-right: 0px;
    vertical-align: top;
    display: inline-block;
}
#mini_upcoming_schedules_table td .bx{
    position: relative;
    top: 1px;
}
.gray-block{
    display: block;
    padding: 5px;
    background-color: #d9d9d9;
}
.purple-block{
    display: block;
    padding: 5px;
    background-color: #6A4A86;
    color: #ffffff;
    margin-bottom: 0px !important;
}
.nsm-calendar .month {
    font-size: 12px;
    font-weight: bold;
}
</style>
<div style="">
<table class="nsm-table" id="mini_upcoming_schedules_table">    
    <thead>
        <tr>
            <td></td>
            <td data-name="Job Details"></td>
            <td data-name="Status"></td>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($upcomingSchedules)) { ?>
            <?php foreach ($upcomingSchedules as $schedules) { ?>
                <?php foreach($schedules as $schedule){ ?>
                    <?php 
                        $is_valid = 0;
                        $is_appointment_event = 0; 
                        if( $schedule['type'] == 'job' ){
                            $schedule_view_url = base_url('job/new_job1/' . $schedule['data']->id);
                            $schedule_date = $schedule['data']->start_date;
                            $schedule_start_time = $schedule['data']->start_time;
                            $schedule_end_time = $schedule['data']->end_time;
                            $schedule_status = $schedule['data']->status;
                            $schedule_type   = $schedule['data']->job_type;
                            $schedule_tags   = $schedule['data']->tags;
                            $schedule_number = $schedule['data']->job_number;
                            $schedule_customer_name = $schedule['data']->first_name . ' ' . $schedule['data']->last_name;
                            $schedule_customer_phone = $schedule['data']->cust_phone != '' ? $schedule['data']->cust_phone : '---';
                            //$schedule_location = $schedule['data']->job_location != '' ? $schedule['data']->job_location : '---';
                            $schedule_location = $schedule['data']->mail_add;
                            $schedule_location_b = $schedule['data']->cust_city . ', ' . $schedule['data']->cust_state . ' ' . $schedule['data']->cust_zip_code;
                            $schedule_expiry_date = '';
                            $schedule_description = '';
                            $schedule_event_name  = '';

                            $assigned_employees = array();
                            $assigned_employees[] = $schedule['data']->e_employee_id;
                            if( $schedule['data']->employee2_employee_id > 0 ){
                                $assigned_employees[] = $schedule['data']->employee2_employee_id;
                            }
                            if( $schedule['data']->employee3_employee_id > 0 ){
                                $assigned_employees[] = $schedule['data']->employee3_employee_id;
                            }
                            if( $schedule['data']->employee4_employee_id > 0 ){
                                $assigned_employees[] = $schedule['data']->employee4_employee_id;
                            }

                            $schedule_invoice_amount = $schedule['data']->invoice_amount;

                            $is_valid = 1;

                        }elseif( $schedule['type'] == 'event' ){
                            $schedule_view_url = base_url('events/event_preview/' . $schedule['data']->id);
                            $schedule_date = $schedule['data']->start_date;
                            $schedule_start_time = $schedule['data']->start_time;
                            $schedule_end_time = $schedule['data']->end_time;
                            $schedule_status = $schedule['data']->status;
                            $schedule_tags   = $schedule['data']->event_tag;
                            $schedule_number = $schedule['data']->event_number;
                            $schedule_type   = $schedule['data']->event_type;
                            $schedule_customer_name = '';
                            $schedule_customer_phone = '';
                            $schedule_location = $schedule['data']->event_address;
                            $schedule_location_b = '';
                            $schedule_expiry_date = '';
                            $schedule_description = $schedule['data']->event_description != '' ? $schedule['data']->event_description : '---';;
                            $schedule_event_name = '';

                            $assigned_employees = array();
                            $attendees = json_decode($schedule['data']->employee_id);
                            foreach($attendees as $uid){
                                $assigned_employees[] = $uid;    
                            }                            

                            $schedule_invoice_amount = 0;

                            $is_valid = 1;
                        }elseif( $schedule['type'] == 'estimate' ){
                            $schedule_view_url = base_url('estimate/view/' . $schedule['data']->id);
                            $schedule_date = $schedule['data']->estimate_date;
                            $schedule_start_time = '';
                            $schedule_end_time = '-';
                            $schedule_status = $schedule['data']->status;
                            $schedule_tags   = $schedule['data']->tags;
                            $schedule_number = $schedule['data']->estimate_number;
                            $schedule_type   = $schedule['data']->estimate_type;
                            $schedule_customer_name  = $schedule['data']->first_name . ' ' . $schedule['data']->last_name;
                            $schedule_customer_phone = $schedule['data']->phone_m != '' ? $schedule['data']->phone_m : '---';
                            $schedule_location = $schedule['data']->job_location;
                            $schedule_location_b = '';
                            $schedule_expiry_date = $schedule['data']->expiry_date;
                            $schedule_description = '';

                            $assigned_employees = array();
                            $assigned_employees[] = $schedule['data']->user_id;
                            $schedule_event_name = '';

                            $schedule_invoice_amount = 0;

                            $is_valid = 1;
                        }elseif( $schedule['type'] == 'ticket' ){
                            $schedule_view_url = base_url('tickets/viewDetails/' . $schedule['data']->id);
                            $schedule_date = date("Y-m-d", strtotime($schedule['data']->ticket_date));
                            $schedule_start_time = date("g:i A", strtotime($schedule['data']->scheduled_time));
                            $schedule_end_time = '';
                            $schedule_status = $schedule['data']->ticket_status;
                            $schedule_tags   = $schedule['data']->job_tag;
                            $schedule_number = $schedule['data']->ticket_no;
                            $schedule_type   = $schedule['data']->service_type;
                            $schedule_customer_name  = $schedule['data']->first_name . ' ' . $schedule['data']->last_name;
                            $schedule_customer_phone = $schedule['data']->phone_m != '' ? $schedule['data']->phone_m : '---';
                            $schedule_location = $schedule['data']->service_location;
                            $schedule_location_b = $schedule['data']->acs_city . ', ' . $schedule['data']->acs_state . ' ' . $schedule['data']->acs_zip;
                            $schedule_expiry_date = '';
                            //$schedule_description = $schedule['data']->service_description;
                            $schedule_description = '';

                            $assigned_employees = array();
                            $assigned_employees[] = $schedule['data']->sales_rep;
                            $schedule_event_name = '';

                            $schedule_invoice_amount = 0;

                            $is_valid = 1;
                        }elseif( $schedule['type'] == 'appointment' ){
                            $schedule_view_url = base_url('tickets/viewDetails/' . $schedule['data']->id);
                            $schedule_date = date("Y-m-d", strtotime($schedule['data']->appointment_date));
                            $schedule_start_time = date("g:i A", strtotime($schedule['data']->appointment_time_from));
                            $schedule_end_time   = date("g:i A", strtotime($schedule['data']->appointment_time_to));
                            $schedule_status = '';
                            $schedule_tags   = $schedule['data']->appt_tags;

                            //$schedule_number = strtoupper(str_replace("APPT", $schedule['data']->appointment_type, $schedule['data']->appointment_number));

                            if( $schedule['data']->appointment_type_id == 4 ){
                                $is_appointment_event = 1;
                                $schedule_customer_name  = '';
                                $schedule_customer_phone = '';
                                $schedule_event_name = $schedule['data']->event_name;
                                $schedule_location   = $schedule['data']->event_location;
                                $schedule_location_b = '';
                            }else{
                                $schedule_customer_name  = $schedule['data']->customer_name;
                                $schedule_customer_phone = $schedule['data']->cust_phone != '' ? $schedule['data']->cust_phone : '---';   
                                $schedule_event_name     = ''; 
                                $schedule_location   = $schedule['data']->mail_add;
                                $schedule_location_b = $schedule['data']->cust_city . ', ' . $schedule['data']->cust_state . ' ' . $schedule['data']->cust_zip_code;
                            }

                            $schedule_number = $schedule['data']->appointment_number;
                            $schedule_type   = $schedule['data']->appointment_type;                            
                            $schedule_expiry_date = '';
                            //$schedule_description = $schedule['data']->service_description;
                            $schedule_description = '';
                            if( $schedule['data']->notes != '' ){
                                $schedule_description = $schedule['data']->notes;
                            } 

                            $assigned_employees = array();
                            $emp_ids = json_decode($schedule['data']->assigned_employee_ids);
                            foreach($emp_ids as $eid){
                                $assigned_employees[] = $eid;    
                            }

                            $schedule_invoice_amount = 0;

                            $is_valid = 1;
                        }
                    ?>
                    <?php if( $is_valid == 1 ){ ?>
                        <tr class="schedule-jobs" style="cursor: pointer" onclick="location.href='<?= $schedule_view_url; ?>'">
                            <td>
                                <?php 
                                    $event_month = date("F", strtotime($schedule_date));
                                    $event_day   = date("d", strtotime($schedule_date));
                                    $event_day_word = date("D", strtotime($schedule_date));
                                ?>
                                <div class="nsm-calendar" ng-app="myApp">
                                    <div class="week">
                                        <b><?= $event_day_word; ?></b>
                                    </div>
                                    <div class="date">
                                        <?= $event_day; ?>
                                    </div>
                                    <div class="month">
                                        <?= $event_month; ?>
                                    </div>
                                </div>    
                                <div class="nsm-calendar-info-container" style="text-align:center;">
                                    <!-- <?php if( $schedule_status != '' ){ ?>
                                    <span class="nsm-badge primary"><?php echo strtoupper($schedule_status); ?></span>
                                    <?php } ?> -->
                                    <?php if( $schedule_start_time != '' && $schedule_end_time != '' ){ ?>
                                    <label class="content-subtitle mt-2 d-block text-uppercase" style="cursor: pointer; font-size: 11px;"><?= $schedule_start_time . ' - ' . $schedule_end_time; ?></label>
                                    <?php }elseif( $schedule_start_time != '' ){  ?>
                                        <label class="content-subtitle mt-1 d-block text-uppercase" style="cursor: pointer"><?= $schedule_start_time; ?></label>
                                    <?php } ?>                                
                                </div>                    
                            </td>
                            <td style="vertical-align: text-top;padding-top: 16px;">
                                <label class="content-title purple-block" style="cursor: pointer;margin-bottom: 11px;font-size: 16px;">
                                    <?= $schedule_number . ' : ' . trim($schedule_type) . ', ' . trim($schedule_tags); ?> 
                                </label>
                                <?php if( $is_appointment_event == 0 ){ ?>
                                    <?php if( $schedule_customer_name != '' ){ ?>
                                    <label class="content-title gray-block" style="cursor: pointer;margin-bottom: 4px;">
                                        <i class='bx bxs-user-rectangle'></i> <?= $schedule_customer_name; ?>
                                        <?php if( $schedule_customer_phone != '' ){ ?>
                                            / <i class='bx bxs-phone' style="margin-left:10px'"></i> <?= $schedule_customer_phone; ?>
                                        <?php } ?>
                                    </label>
                                    <?php } ?>                                

                                    <label class="content-title gray-block" style="cursor: pointer">
                                        <ul class="location-list">
                                            <li><i class='bx bxs-map-pin'></i></li>
                                            <li><?= $schedule_location; ?><?= $schedule_location_b != '' ? "<br />" . $schedule_location_b : ''; ?></li>
                                        </ul>                                    
                                    </label>
                                <?php }else{ ?>
                                    <label class="content-title gray-block" style="cursor: pointer;margin-bottom: 4px;">
                                        <i class='bx bxs-calendar-event'></i> <?= $schedule_event_name; ?>
                                    </label>
                                    <?php if( $schedule_location != '' ){ ?>
                                        <label class="content-title gray-block" style="cursor: pointer">
                                            <ul class="location-list">
                                                <li><i class='bx bxs-map-pin'></i></li>
                                                <li><?= $schedule_location; ?></li>
                                            </ul>                                    
                                        </label>
                                    <?php } ?>
                                <?php } ?>    
                                <?php if( $schedule_invoice_amount > 0 ){ ?>                             
                                    <label class="content-title gray-block" style="cursor: pointer;margin-bottom: 4px;">
                                        <i class='bx bxs-receipt' ></i> Invoice Amount :  $<?= $schedule_invoice_amount; ?>
                                    </label>
                                <?php } ?>                            
                                
                                <?php if( $schedule_description != '' ){ ?>
                                    <label class="content-title gray-block" style="cursor: pointer;margin-bottom: 4px;">
                                        <i class='bx bx-calendar-event'></i> <?= $schedule_description; ?>
                                    </label>
                                <?php } ?>
                                <?php if( $schedule_expiry_date != '' ){ ?>
                                    <label class="content-title gray-block" style="cursor: pointer; color:#ff4d4d;">
                                        <i class='bx bxs-calendar-x'></i> Expiry Date : <?= date("m/d/Y", strtotime($schedule_expiry_date)); ?>
                                    </label>
                                <?php } ?>
                            </td>
                            <td class="text-end" style="width:25% !important;">
                                <?php foreach($assigned_employees as $eid){ ?>
                                    <div class="nsm-list-icon primary" style="background-color:#ffffff; justify-content:right;">
                                        <div class="nsm-profile" style="background-image: url('<?= userProfileImage($eid); ?>');" data-img="<?= userProfileImage($eid); ?>"></div>                            
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>                
            <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="4">
                    <div class="nsm-empty">
                        <span>No upcoming schedules for now.</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>    
</table>
</div>
<script>
$(function(){
    <?php if (!empty($upcomingSchedules)) { ?>
    $("#mini_upcoming_schedules_table").nsmPagination({itemsPerPage:5});
    <?php } ?>
});
</script>