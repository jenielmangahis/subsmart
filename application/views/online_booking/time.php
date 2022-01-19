<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.row-header{
    background-color: #32243d;
    color: #ffffff;
}
.row-time{
    background-color: #cccccc;
}
.time-input{
    display: inline-block;
    width: 45%;
}
.ui-timepicker-pm, .ui-timepicker-am{
    background-color: #32243d;
    color: #ffffff;
    padding: 5px;
}
.ui-timepicker-selected{
    background-color: #45a73c !important;
}
.ui-timepicker-list{
    max-height: 300px;
    overflow: auto;
}
.modal-time-slot-msg{
    font-size: 17px;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-20">
            <div class="row">
                <div class="col">
                  <h3 class="page-title mt-0">Online Booking</h3>
                </div>
                <div class="col-auto">
                    <div class="h1-spacer">
                        <a class="btn btn-primary" id="add-timeslots-row" data-time-slot="btn-add" href="javascript:void(0);"><span class="fa fa-plus-square fa-margin-right add-timeslots-row"></span> Add Time Slot</a>                        
                    </div>
                </div>
            </div>
            <div class="pl-3 pr-3 mt-2 row" style="position: relative;top: 7px;">
              <div class="col mb-4 left alert alert-warning mt-0 mb-0">
                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Set the time intervals customers can book.</span>
              </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('booking/save_time_slot', ['id' => 'frm-time-slots', 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="row time-container" id="time-container">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?>   
                        <?php include viewPath('flash'); ?>
                        <div class="row dashboard-container-2 table-time-slots">                            
                            <table class="table table-timeslots" id="table-timeslots">
                              <thead>
                                <tr class="row-header">
                                  <th width="" scope="col" style="width: 25%;">Time Start - End</th>
                                  <th width="" scope="col" style="text-align:center;">Mon</th>
                                  <th width="" scope="col" style="text-align:center;">Tue</th>
                                  <th width="" scope="col" style="text-align:center;">Wed</th>
                                  <th width="" scope="col" style="text-align:center;">Thu</th>
                                  <th width="" scope="col" style="text-align:center;">Fri</th>
                                  <th width="" scope="col" style="text-align:center;">Sat</th>
                                  <th width="" scope="col" style="text-align:center;">Sun</th>
                                  <th width="" scope="col" style="text-align:center;">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $availability = 1; ?>
                                <?php if( $bookingTimeSlots ){ ?>
                                    <?php $row = 0; foreach( $bookingTimeSlots as $t ){ ?>
                                        <?php 
                                            $availability = $t->availability;
                                            $days = unserialize($t->days); 
                                        ?>
                                        <?php if(is_array($days)) { ?>
                                            <tr id="tr_<?php echo $row; ?>" class="row-time">
                                                <td width="">
                                                    <div class="time-cnt">
                                                        <input type="text" name="time[<?php echo $row; ?>][time_start]" value="<?php echo $t->time_start; ?>" class="form-control time-input" autocomplete="off">
                                                        &nbsp; - &nbsp;
                                                        <input type="text" name="time[<?php echo $row; ?>][time_end]" value="<?php echo $t->time_end; ?>" class="form-control time-input" autocomplete="off">
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][mon]" value="Mon" <?php echo( in_array("Mon", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="mon_0">
                                                        <label for="mon_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][tue]" value="Tue" <?php echo( in_array("Tue", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="tue_0">
                                                        <label for="tue_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][wed]" value="Wed" <?php echo( in_array("Wed", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="wed_0">
                                                        <label for="wed_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][thu]" value="Thu" <?php echo( in_array("Thu", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="thu_0">
                                                        <label for="thu_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][fri]" value="Fri" <?php echo( in_array("Fri", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="fri_0">
                                                        <label for="fri_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][sat]" value="Sat" <?php echo( in_array("Sat", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="sat_0">
                                                        <label for="sat_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <div class="checkbox checkbox-sm">
                                                        <input type="checkbox" name="time[<?php echo $row; ?>][days][sun]" value="Sun" <?php echo( in_array("Sun", $days) ? 'checked="checked"' : '' ); ?> class="checkbox-select" id="sun_0">
                                                        <label for="sun_<?php echo $row; ?>"></label>
                                                    </div>
                                                </td>
                                                <td width="" style="text-align:center;">
                                                    <a class="time-slot-delete" data-id="<?php echo $t->id; ?>" href="javascript:void(0)">
                                                        <span class="fa fa-trash"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php $row++; } ?>
                                <?php }else{ ?>
                                    <tr id="tr_0" class="row-time">
                                        <td>
                                            <div class="time-cnt">
                                                <input type="text" name="time[0][time_start]" value="8:00 AM" class="form-control time-input" autocomplete="off">
                                                &nbsp; - &nbsp;
                                                <input type="text" name="time[0][time_end]" value="10:00 AM" class="form-control time-input" autocomplete="off">
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][mon]" value="Mon" class="checkbox-select" id="mon_0">
                                                <label for="mon_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][tue]" value="Tue" class="checkbox-select" id="tue_0">
                                                <label for="tue_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][wed]" value="Wed" class="checkbox-select" id="wed_0">
                                                <label for="wed_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][thu]" value="Thu" class="checkbox-select" id="thu_0">
                                                <label for="thu_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][fri]" value="Fri" class="checkbox-select" id="fri_0">
                                                <label for="fri_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][sat]" value="Sat" class="checkbox-select" id="sat_0">
                                                <label for="sat_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <div class="checkbox checkbox-sm">
                                                <input type="checkbox" name="time[0][days][sun]" value="Sun" class="checkbox-select" id="sun_0">
                                                <label for="sun_0"></label>
                                            </div>
                                        </td>
                                        <td width="" style="text-align:center;">
                                            <a class="service-item-delete" data-category-delete-modal="open" data-id="0" onclick="deleteTimeSlotRow(0);" href="javascript:void(0)">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>                                
                              </tbody>
                            </table>  
                        </div>

                        <div class="row dashboard-container-1">
                            <div class="col-md-8"><strong>Soonest Availability</strong><br />Select how many days should be excluded from the booking calendar starting from current day.
                            <select name="soonest_availability" class="form-control" style="width: 400px;">
                                <option value="1" <?php echo( $availability == 1 ? 'selected="selected"' : '' ); ?>>Same Day</option>
                                <option value="2" <?php echo( $availability == 2 ? 'selected="selected"' : '' ); ?>>Next Day</option>
                                <option value="3" <?php echo( $availability == 3 ? 'selected="selected"' : '' ); ?>>2 days out</option>
                                <option value="4" <?php echo( $availability == 4 ? 'selected="selected"' : '' ); ?>>3 days out</option>
                                <option value="5" <?php echo( $availability == 5 ? 'selected="selected"' : '' ); ?>>1 week out</option>
                            </select>
                            </div>
                        </div>       
                        <hr />
                        <button type="button" class="btn btn-primary btn-save-time" style="width: 10%;">Save</button>                         
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->

</div>
<?php include viewPath('includes/booking_modals'); ?>
<?php include viewPath('includes/footer_booking'); ?>

<script>
$(function(){
    $('.time-input').timepicker({ 'timeFormat': 'h:i A' });

    $(".btn-save-time").click(function(){
        $("#modalUpdateTimeSlot").modal('show');

        var msg = '<div class="alert alert-info" role="alert"><span class="spinner-border spinner-border-sm m-0"></span> Saving...</div>';
        var url = base_url + '/booking/_save_time_slot';

        $(".modal-time-slot-msg").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: $("#frm-time-slots").serialize(),
               success: function(o)
               {
                    var obj = jQuery.parseJSON( o );
                    if(obj.is_success == true) {
                        $(".modal-time-slot-msg").html("<p class='alert alert-info'><i class='fa fa-check'></i> Timeslot was successfully updated</p>");
                    } else {
                        $(".modal-time-slot-msg").html("<p class='alert alert-danger'><i class='fa fa-check'></i> Timeslot update unsuccessfull</p>");
                    }           
               }
            });
        }, 1000);
    });

    $(".time-slot-delete").click(function(){
        var tid = $(this).attr('data-id');

        $("#tid").val(tid);
        $("#modalDeleteTimeSlot").modal('show');
    });

});
</script>