<link href="https://fonts.googleapis.com/css?family=Roboto:300,100" rel="stylesheet">
<style>
    .nsm-calendar {
        border-radius: 20%;
        width: 103px;
        height: 103px;
        margin: auto;
        vertical-align: middle;
        text-align: center;
        font: 300 28.5714285714px Roboto;
        background: #DAD1E0;
    }

    .nsm-calendar .week {
        color: red;
        padding: 13px;
        padding-bottom: 5px;
        font-size: 20px;
        font-weight: bold;
    }

    .nsm-calendar .date {
        font: 40px Roboto;
        margin-top: -7px;
        font-weight: bold;
    }

    .nsm-calendar .month {
        font-size: 12px;
        font-weight: bold;
    }

    .nsm-list-icon {
        float: right;
    }

    .location-list {
        list-style: none;
        padding: 0px;
        margin: 0px;
    }

    .location-list li {
        margin-right: 0px;
        vertical-align: top;
        display: inline-block;
    }

    #dashboard_upcoming_schedules_table .content-subtitle {
        font-size: 11px;
        font-weight: bold;
    }

    @media screen and (max-width: 600px) {
        .content-title {
            font-size: 13px !important;
            word-break: break-word;
        }

        .nsm-calendar-info-container .content-subtitle {
            font-size: 11px !important;
        }

        .nsm-calendar-info-container {
            margin-top: 10px;
        }
    }

    .event-schedule-number {
        display: block;
    }

    .event-schedule-tags-type {
        padding: 10px;
        display: block;
        width: 100%;
        font-weight: bold;
        color: #fff !important;
        font-size: 12px !important;
        border-radius: 5px;
        text-align: start;
    }

    .event-schedule-tags-type i {
        color: #fff !important;
        font-size: 12px;
    }

    #dashboard_upcoming_schedules_table .profile {
        width: 50px;
        height: 50px;
        min-width: 40px;
        background-color: #6a4a86;
        color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: 2px solid #fff;
        position: relative;
        z-index: 1;
    }

    #dashboard_upcoming_schedules_table .profile-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #dashboard_upcoming_schedules_table .profile-wrapper::before {
        content: "";
        position: absolute;
        top: -2px;
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, #FEA303, #281c2d);
        border-radius: 50%;
        z-index: 0;
    }

    @media screen and (max-width: 1366px) {
        .upcoming-calendar-container {
            height: unset;
        }
    }

    @media screen and (max-width: 1200px) {
        #dashboard_upcoming_schedules_table .assigned-employee {
            display: none;
        }
    }
    @media screen and (max-width: 991px) {
        #dashboard_upcoming_schedules_table .assigned-employee {
            display: unset;
        }
    }

    @media screen and (max-width: 460px) {
        #dashboard_upcoming_schedules_table .assigned-employee {
            display: none;
        }
    }
</style>
<?php if (!empty($upcomingSchedules)) { ?>
<table class="nsm-table" id="dashboard_upcoming_schedules_table">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Job Details"></td>
            <td data-name="Tech Assigned"></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($upcomingSchedules as $schedules) { ?>
        <?php
             $colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8']; 
                foreach($schedules as $schedule){ ?>
        <?php
        $is_valid = 0;
        $is_appointment_event = 0;
        if ($schedule['type'] == 'job') {
            if ($schedule['data']->cust_phone != '') {
                $cust_phone = $schedule['data']->cust_phone;
            } else {
                if ($schedule['data']->cust_phone_home != '') {
                    $cust_phone = $schedule['data']->cust_phone_home;
                } else {
                    $cust_phone = '';
                }
            }
            $schedule_view_url = base_url('job/new_job1/' . $schedule['data']->id);
            $schedule_date = $schedule['data']->start_date;
            $schedule_start_time = $schedule['data']->start_time;
            $schedule_end_time = $schedule['data']->end_time;
            $schedule_status = $schedule['data']->status;
            $schedule_type = $schedule['data']->job_type;
            $schedule_tags = $schedule['data']->tags;
            $schedule_number = $schedule['data']->job_number;
            $schedule_customer_name = $schedule['data']->first_name . ' ' . $schedule['data']->last_name;
            $schedule_customer_phone = $cust_phone;
            //$schedule_location = $schedule['data']->job_location != '' ? $schedule['data']->job_location : '---';
            $schedule_location = $schedule['data']->mail_add;
            $schedule_location_b = $schedule['data']->cust_city . ', ' . $schedule['data']->cust_state . ' ' . $schedule['data']->cust_zip_code;
            $schedule_expiry_date = '';
            $schedule_description = '';
            $schedule_invoice_amount = $schedule['data']->invoice_amount;
        
            $assigned_employees = [];
            //$assigned_employees[] = $schedule['data']->e_employee_id;
            if ($schedule['data']->employee2_employee_id > 0) {
                $assigned_employees[] = $schedule['data']->employee2_employee_id;
            }
            if ($schedule['data']->employee3_employee_id > 0) {
                $assigned_employees[] = $schedule['data']->employee3_employee_id;
            }
            if ($schedule['data']->employee4_employee_id > 0) {
                $assigned_employees[] = $schedule['data']->employee4_employee_id;
            }
            if ($schedule['data']->employee5_employee_id > 0) {
                $assigned_employees[] = $schedule['data']->employee5_employee_id;
            }
            if ($schedule['data']->employee6_employee_id > 0) {
                $assigned_employees[] = $schedule['data']->employee6_employee_id;
            }
        
            $is_valid = 1;
        } elseif ($schedule['type'] == 'event') {
            $schedule_view_url = base_url('events/event_preview/' . $schedule['data']->id);
            $schedule_date = $schedule['data']->start_date;
            $schedule_start_time = $schedule['data']->start_time;
            $schedule_end_time = $schedule['data']->end_time;
            $schedule_status = $schedule['data']->status;
            $schedule_tags = $schedule['data']->event_tag;
            $schedule_number = $schedule['data']->event_number;
            $schedule_type = $schedule['data']->event_type;
            $schedule_customer_name = '';
            $schedule_customer_phone = '';
            $schedule_location = $schedule['data']->event_address;
            $schedule_location_b = '';
            $schedule_expiry_date = '';
            $schedule_description = $schedule['data']->event_description != '' ? $schedule['data']->event_description : '---';
        
            $assigned_employees = [];
            $attendees = json_decode($schedule['data']->employee_id);
            foreach ($attendees as $uid) {
                $assigned_employees[] = $uid;
            }
        
            $schedule_invoice_amount = 0;
        
            $is_valid = 1;
        } elseif ($schedule['type'] == 'estimate') {
            $schedule_view_url = base_url('estimate/view/' . $schedule['data']->id);
            $schedule_date = $schedule['data']->estimate_date;
            $schedule_start_time = '';
            $schedule_end_time = '-';
            $schedule_status = $schedule['data']->status;
            $schedule_tags = $schedule['data']->tags;
            $schedule_number = $schedule['data']->estimate_number;
            $schedule_type = $schedule['data']->estimate_type;
            $schedule_customer_name = $schedule['data']->first_name . ' ' . $schedule['data']->last_name;
            $schedule_customer_phone = $schedule['data']->phone_m != '' ? $schedule['data']->phone_m : '---';
            $schedule_location = $schedule['data']->job_location;
            $schedule_location_b = '';
            $schedule_expiry_date = $schedule['data']->expiry_date;
            $schedule_description = '';
        
            $assigned_employees = [];
            $assigned_employees[] = $schedule['data']->user_id;
        
            $schedule_invoice_amount = $schedule['data']->invoice_amount;
        
            $is_valid = 1;
        } elseif ($schedule['type'] == 'ticket') {
            if ($schedule['data']->customer_phone != '') {
                $cust_phone = $schedule['data']->customer_phone;
            } else {
                if ($schedule['data']->phone_h != '') {
                    $cust_phone = $schedule['data']->phone_h;
                } elseif ($schedule['data']->phone_m != '') {
                    $cust_phone = $schedule['data']->phone_m;
                } else {
                    $cust_phone = '';
                }
            }
        
            $schedule_view_url = base_url('tickets/viewDetails/' . $schedule['data']->id);
            $schedule_date = date('Y-m-d', strtotime($schedule['data']->ticket_date));
            $schedule_start_time = date('g:i A', strtotime($schedule['data']->scheduled_time));
            $schedule_end_time = '';
            $schedule_status = $schedule['data']->ticket_status;
            $schedule_tags = $schedule['data']->job_tag;
            $schedule_number = $schedule['data']->ticket_no;
            $schedule_type = $schedule['data']->service_type;
            $schedule_customer_name = $schedule['data']->first_name . ' ' . $schedule['data']->last_name;
            $schedule_customer_phone = $cust_phone;
            $schedule_location = $schedule['data']->service_location;
            //$schedule_location_b = $schedule['data']->acs_city . ', ' . $schedule['data']->acs_state . ' ' . $schedule['data']->acs_zip;
            $schedule_location_b = '';
            $schedule_expiry_date = '';
            //$schedule_description = $schedule['data']->service_description;
            $schedule_description = '';
        
            $assigned_employees = [];
            $emp_ids = unserialize($schedule['data']->technicians);
            if (is_array($emp_ids)) {
                foreach ($emp_ids as $eid) {
                    $assigned_employees[] = $eid;
                }
            }
        
            /*if( !empty($assigned_employees) ){
                            if( !in_array($schedule['data']->sales_rep, $assigned_employees) ){
                                $assigned_employees[] = $schedule['data']->sales_rep;        
                            }
                        }else{
                            $assigned_employees[] = $schedule['data']->sales_rep;
                        }*/
        
            $schedule_invoice_amount = number_format($schedule['data']->grandtotal, 2);
        
            $is_valid = 1;
        } elseif ($schedule['type'] == 'appointment') {
            $schedule_view_url = base_url('workcalender');
            $schedule_date = date('Y-m-d', strtotime($schedule['data']->appointment_date));
            $schedule_start_time = date('g:i A', strtotime($schedule['data']->appointment_time_from));
            $schedule_end_time = date('g:i A', strtotime($schedule['data']->appointment_time_to));
            $schedule_status = '';
            $schedule_tags = $schedule['data']->appt_tags;
        
            //$schedule_number = strtoupper(str_replace("APPT", $schedule['data']->appointment_type, $schedule['data']->appointment_number));
        
            $schedule_number = $schedule['data']->appointment_number;
            $schedule_type = $schedule['data']->appointment_type;
        
            if ($schedule['data']->appointment_type_id == 4) {
                $is_appointment_event = 1;
                $schedule_customer_name = '';
                $schedule_customer_phone = '';
                $schedule_event_name = $schedule['data']->event_name;
                $schedule_location = $schedule['data']->event_location;
                $schedule_location_b = '';
            } else {
                $schedule_customer_name = $schedule['data']->customer_name;
                $schedule_customer_phone = $schedule['data']->cust_phone != '' ? $schedule['data']->cust_phone : '---';
                $schedule_event_name = '';
                $schedule_location = $schedule['data']->mail_add;
                $schedule_location_b = $schedule['data']->cust_city . ', ' . $schedule['data']->cust_state . ' ' . $schedule['data']->cust_zip_code;
            }
        
            $schedule_expiry_date = '';
            //$schedule_description = $schedule['data']->service_description;
            $schedule_description = '';
        
            $assigned_employees = [];
            $emp_ids = json_decode($schedule['data']->assigned_employee_ids);
            foreach ($emp_ids as $eid) {
                $assigned_employees[] = $eid;
            }
        
            $schedule_invoice_amount = 0;
        
            $is_valid = 1;
        }
        ?>
        <?php if( $is_valid == 1 ){ ?>
        <tr class="schedule-job quick-view-upcoming-schedule" data-id="<?= $schedule['data']->id ?>"
            data-type="<?= $schedule['type'] ?>" style="cursor: pointer; text-decoration: none;color:inherit;">
            <td style="vertical-align:top;">
                <?php
                $event_month = date('F', strtotime($schedule_date));
                $event_day = date('d', strtotime($schedule_date));
                $event_day_word = date('D', strtotime($schedule_date));
                ?>
                <div class="nsm-calendar" ng-app="myApp">
                    <div class="week">
                        <b><?= $event_day_word ?></b>
                    </div>
                    <div class="date">
                        <?= $event_day ?>
                    </div>
                    <div class="month">
                        <?= $event_month ?>
                    </div>
                </div>
                <div class="nsm-calendar-info-container" style="text-align:center;">
                    <!-- <?php if( $schedule_status != '' ){ ?>
                                <span class="nsm-badge primary"><?php echo strtoupper($schedule_status); ?></span>
                                <?php } ?> -->
                    <?php if( $schedule_start_time != '' && $schedule_end_time != '' ){ ?>
                    <label class="content-subtitle mt-2 d-block text-uppercase"
                        style="cursor: pointer"><?= $schedule_start_time . ' - ' . $schedule_end_time ?></label>
                    <?php }elseif( $schedule_start_time != '' ){  ?>
                    <label class="content-subtitle mt-2 d-block text-uppercase"
                        style="cursor: pointer"><?= $schedule_start_time ?></label>
                    <?php } ?>
                </div>
            </td>
            <td style="vertical-align: text-top;padding-top: 16px;width: 50%;">
                <label class="content-title" style="cursor: pointer;margin-bottom: 15px;font-size: 17px;">
                    <?php if( trim($schedule_tags) != '' ){ ?>
                    <?php  if( trim($schedule_type != '')  ){ ?>
                    <span class="event-schedule-number"><?= $schedule_number ?></span>
                    <div class="event-schedule-tags-type" style="background: <?= $colors[array_rand($colors)] ?>">
                        <span><i class='bx bxs-purchase-tag'></i>
                            <?= trim($schedule_type) . ', ' . trim($schedule_tags) ?></span>
                    </div>
                    <?php }else{ ?>
                    <span class="event-schedule-number"><?= $schedule_number ?></span>
                    <div class="event-schedule-tags-type" style="background: <?= $colors[array_rand($colors)] ?>">
                        <span><i class='bx bxs-purchase-tag'></i> <?= trim($schedule_tags) ?></span>
                    </div>
                    <?php } ?>
                    <?php }else{ ?>
                    <?php  if( trim($schedule_type != '')  ){ ?>
                    <span class="event-schedule-number"><?= $schedule_number ?></span>
                    <div class="event-schedule-tags-type" style="background: <?= $colors[array_rand($colors)] ?>">
                        <span><i class='bx bxs-purchase-tag'></i> <?= trim($schedule_type) ?></span>
                    </div>
                    <?php }else{ ?>
                    <span class="event-schedule-number"><?= $schedule_number ?></span>
                    <?php } ?>
                    <?php } ?>
                </label>
                <?php if( $is_appointment_event == 0 ){ ?>
                <?php if( $schedule_customer_name != '' ){ ?>
                <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                    <i class='bx bxs-user-rectangle'></i> <?= $schedule_customer_name ?>
                </label>
                <?php } ?>
                <?php if( $schedule_customer_phone != '' ){ ?>
                <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                    <i class='bx bxs-phone'></i> <?= $schedule_customer_phone ?>
                </label>
                <?php } ?>
                <label class="content-title" style="cursor: pointer">
                    <ul class="location-list">
                        <li><i class='bx bxs-map-pin'></i></li>
                        <li style="max-width:90%;">
                            <?=
                        $schedule_location;
                        $schedule_location_b != '' ? '<br />' . $schedule_location_b : '';
                        ?></li>
                    </ul>
                </label>
                <?php }else{ ?>
                <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                    <i class='bx bxs-calendar-event'></i> <?= $schedule_event_name ?>
                </label>
                <?php if( $schedule_location != '' ){ ?>
                <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                    <i class='bx bxs-map-pin'></i> <?= $schedule_location ?>
                </label>
                <?php } ?>
                <?php } ?>

                <?php if( $schedule_description != '' ){ ?>
                <label class="content-title" style="cursor: pointer;margin-bottom: 4px;">
                    <i class='bx bx-calendar-event'></i> <?= $schedule_description ?>
                </label>
                <?php } ?>
                <?php if( $schedule_invoice_amount > 0 ){ ?>
                <label class="content-title" style="cursor: pointer;margin-bottom: 4px; margin-top: 10px;">
                    <i class='bx bxs-receipt'></i> Invoice Amount : $<?= number_format($schedule_invoice_amount, 2) ?>
                </label>
                <?php } ?>
                <?php if( $schedule_expiry_date != '' ){ ?>
                <label class="content-title" style="cursor: pointer; color:#ff4d4d;">
                    <i class='bx bxs-calendar-x'></i> Expiry Date :
                    <?= date('m/d/Y', strtotime($schedule_expiry_date)) ?>
                </label>
                <?php } ?>
            </td>
            <td class="assigned-employee" style="width:170px;">
                <?php foreach($assigned_employees as $eid){ ?>
                <div class="position-relative">
                    <div class="profile-wrapper">
                        <div class="profile" style="background-image: url('<?= userProfileImage($eid) ?>');"
                            data-img="<?= userProfileImage($eid) ?>"></div>
                    </div>
                </div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
        <?php } ?>
        <?php } ?>
    </tbody>
</table>
<?php }else{ ?>
<div class="nsm-empty">
    <i class="bx bx-meh-blank"></i>
    <span>There is currently no upcoming events for now.</span>
</div>
<?php } ?>
<script>
    $(function() {
        $("#dashboard_upcoming_schedules_table").nsmPagination({
            itemsPerPage: 3
        });

        $('.quick-view-upcoming-schedule').on('click', function() {
            var appointment_type = $(this).attr('data-type');
            var appointment_id = $(this).attr('data-id');

            $('#upcoming-schedule-view-more-details').attr('data-type', appointment_type);
            $('#upcoming-schedule-view-more-details').attr('data-id', appointment_id);

            $('#edit-upcoming-schedule').attr('data-type', appointment_type);
            $('#edit-upcoming-schedule').attr('data-id', appointment_id);

            if (appointment_type == 'job') {
                var url = base_url + "job/_quick_view_details";
            } else if (appointment_type == 'ticket') {
                var url = base_url + "ticket/_quick_view_details";
            } else if (appointment_type == 'event') {
                var url = base_url + "event/_quick_view_event";
            } else {
                var url = base_url + "calendar/_view_appointment";
            }

            calendar_modal_source = 'upcoming-list';
            $('#modal-quick-view-upcoming-schedule').modal('show');
            showLoader($(".view-schedule-container"));

            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        appointment_id: appointment_id
                    },
                    success: function(o) {
                        $(".view-schedule-container").html(o);
                    }
                });
            }, 500);
        });
    });
</script>
