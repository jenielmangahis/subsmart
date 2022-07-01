<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/more/online_booking_modals'); ?>

<style> 
    
.ui-timepicker-pm, .ui-timepicker-am{
    background-color: #ffffff;
    color: #212529;
    padding: 10px;
}
.ui-timepicker-selected{
    background-color: #dad1e0 !important;
}
.ui-timepicker-list{
    max-height: 300px;
    overflow: auto;
    width: 178px;
    border: 1px solid #d3d3d3;
    list-style: none;
    padding: unset;
    border-radius: 0px 0px 5px 5px;
}
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/upgrades_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Set the time intervals customers can book.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" id="btn_add_timeslot">
                                <i class="bx bx-fw bx-plus-circle"></i> Add Time Slot
                            </button>
                        </div>
                    </div>
                </div>

                <?php echo form_open_multipart('booking/_save_time_slot', ['id' => 'frm-time-slots', 'class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Time Start - End">Time Start - End</td>
                            <td data-name="Monday">Monday</td>
                            <td data-name="Tuesday">Tuesday</td>
                            <td data-name="Wednesday">Wednesday</td>
                            <td data-name="Thursday">Thursday</td>
                            <td data-name="Friday">Friday</td>
                            <td data-name="Saturday">Saturday</td>
                            <td data-name="Sunday">Sunday</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($bookingTimeSlots)) :
                        ?>
                            <?php
                            $row = 0;
                            foreach ($bookingTimeSlots as $t) :
                                $availability = $t->availability;
                                $days = unserialize($t->days);
                            ?>

                                <?php if (is_array($days)) : ?>
                                    <tr class="tr-<?php echo $row; ?>">
                                        <td class="fw-bold nsm-text-primary">
                                            <input type="text" placeholder="Name" name="time[<?php echo $row; ?>][time_start]" value="<?php echo $t->time_start; ?>" class="nsm-field form-control d-inline-block w-auto time-field" autocomplete="off" />
                                            -
                                            <input type="text" placeholder="Name" name="time[<?php echo $row; ?>][time_end]" value="<?php echo $t->time_end; ?>" class="nsm-field form-control d-inline-block w-auto time-field" autocomplete="off" />
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][mon]" id="mon_0" value="Mon" <?php echo (in_array("Mon", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="mon_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][tue]" id="tue_0" value="Tue" <?php echo (in_array("Tue", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="tue_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][wed]" id="wed_0" value="Wed" <?php echo (in_array("Wed", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="wed_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][thu]" id="thu_0" value="Thu" <?php echo (in_array("Thu", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="thu_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][fri]" id="fri_0" value="Fri" <?php echo (in_array("Fri", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="fri_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][sat]" id="sat_0" value="Sat" <?php echo (in_array("Sat", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="sat_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[<?php echo $row; ?>][days][sun]" id="sun_0" value="Sun" <?php echo (in_array("Sun", $days) ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-label" for="sun_<?php echo $row; ?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $t->id; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else : ?>
                                    <tr class="tr-0">
                                        <td class="fw-bold nsm-text-primary">
                                            <input type="text" placeholder="Name" name="time[0][time_start]" value="8:00 AM" class="nsm-field form-control d-inline-block w-auto time-field" autocomplete="off" />
                                            -
                                            <input type="text" placeholder="Name" name="time[0][time_end]" value="10:00 AM" class="nsm-field form-control d-inline-block w-auto time-field" autocomplete="off" />
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][mon]" id="mon_0" value="Mon">
                                                <label class="form-check-label" for="mon_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][tue]" id="tue_0" value="Tue">
                                                <label class="form-check-label" for="tue_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][wed]" id="wed_0" value="Wed">
                                                <label class="form-check-label" for="wed_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][thu]" id="thu_0" value="Thu">
                                                <label class="form-check-label" for="thu_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][fri]" id="fri_0" value="Fri">
                                                <label class="form-check-label" for="fri_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][sat]" id="sat_0" value="Sat">
                                                <label class="form-check-label" for="sat_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="time[0][days][sun]" id="sun_0" value="Sun">
                                                <label class="form-check-label" for="sun_0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="0">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="9">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>

                <div class="row mt-5">
                    <div class="col-12">
                        <label class="content-title">Soonest Availability</label>
                        <label>Select how many days should be excluded from the booking calendar starting from current day.</label>
                        <select class="nsm-field form-control w-auto mt-3" id="soonest_availability" name="soonest_availability" required>
                            <option value="" disabled selected>Select Availability</option>
                            <option value="1" <?php echo ($availability == 1 ? 'selected="selected"' : ''); ?>>Same Day</option>
                            <option value="2" <?php echo ($availability == 2 ? 'selected="selected"' : ''); ?>>Next Day</option>
                            <option value="3" <?php echo ($availability == 3 ? 'selected="selected"' : ''); ?>>2 days out</option>
                            <option value="4" <?php echo ($availability == 4 ? 'selected="selected"' : ''); ?>>3 days out</option>
                            <option value="5" <?php echo ($availability == 5 ? 'selected="selected"' : ''); ?>>1 week out</option>
                        </select>
                        <button type="submit" class="nsm-button primary ms-0 mt-3" id="btn_save_time">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $url->assets ?>plugins/jquery-timepicker/jquery.timepicker.min.js"></script>
<script type="text/javascript">
    var click  = 0;
    $(document).ready(function() {
        initTimepicker();

        $("#btn_add_timeslot").on("click", function(){
            addRow();
        });

        $(document).on("click", ".delete-item", function(){
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Timeslot',
                text: "Are you sure you want to delete the selected timeslot?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('booking/delete_time_slot'); ?>",
                        data: {
                            tid: id
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Success',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Cannot find record',
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $("#btn_save_time").on("click", function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>booking/_save_time_slot",
                data: $("#frm-time-slots").serialize(),
                dataType: "json",
                success: function(result) {
                    if (result.is_success == true) {
                        Swal.fire({
                            title: 'Success!',
                            text: "Timeslot was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: "Timeslot update was unsuccessful.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error',
                        text: "Something went wrong, please try again later.",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                },

            });
        });
    });

    function initTimepicker(){
        $(".time-field").timepicker({ 'timeFormat': 'h:i A' });
    }

    function addRow(){
        var markup = '';
        click++;

        markup += '<tr class="tr-'+click+'">';
        markup += '<td class="fw-bold nsm-text-primary">';
        markup += '<input type="text" placeholder="Name" name="time['+click+'][time_start]" value="8:00 AM" class="nsm-field form-control d-inline-block w-auto time-field" autocomplete="off" />';
        markup += ' - ';
        markup += '<input type="text" placeholder="Name" name="time['+click+'][time_end]" value="10:00 AM" class="nsm-field form-control d-inline-block w-auto time-field" autocomplete="off" />';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][mon]" id="mon_'+click+'" value="Mon">';
        markup += '<label class="form-check-label" for="mon_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][tue]" id="tue_'+click+'" value="Tue">';
        markup += '<label class="form-check-label" for="tue_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][wed]" id="wed_'+click+'" value="Wed">';
        markup += '<label class="form-check-label" for="wed_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][thu]" id="thu_'+click+'" value="Thu">';
        markup += '<label class="form-check-label" for="thu_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][fri]" id="fri_'+click+'" value="Fri">';
        markup += '<label class="form-check-label" for="fri_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][sat]" id="sat_'+click+'" value="Sat">';
        markup += '<label class="form-check-label" for="sat_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="form-check">';
        markup += '<input class="form-check-input" type="checkbox" name="time['+click+'][days][sun]" id="sun_'+click+'" value="Sun">';
        markup += '<label class="form-check-label" for="sun_'+click+'"></label>';
        markup += '</div>';
        markup += '</td>';
        markup += '<td>';
        markup += '<div class="dropdown table-management">';
        markup += '<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">';
        markup += '<i class="bx bx-fw bx-dots-vertical-rounded"></i>';
        markup += '</a>';
        markup += '<ul class="dropdown-menu dropdown-menu-end">';
        markup += '<li>';
        markup += '<a class="dropdown-item delete-item" href="javascript:void(0);" data-id="'+click+'">Delete</a>';
        markup += '</li>';
        markup += '</ul>';
        markup += '</div>';
        markup += '</td>';
        markup += '</tr>';

        $(".nsm-table tbody").append(markup);
        initTimepicker();
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>