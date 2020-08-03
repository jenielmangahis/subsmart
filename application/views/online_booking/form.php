<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_booking'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <?php include viewPath('includes/booking_tabs'); ?> 

                        <?php if($this->session->flashdata('message')) { ?>
                            <div class="row dashboard-container-1">
                                <div class="col-md-12">
                                    <div class="alert <?php echo $this->session->flashdata('alert_class'); ?>">
                                      <button type="button" class="close" data-dismiss="alert">&times</button>
                                      <?php echo $this->session->flashdata('message'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>                         

                        <div class="row">
                            <div class="col-md-6">
                                <form name="booking_component" id="booking_component" action="<?php echo base_url()."booking/save_form"; ?>" method="post">
                                    <div class="row dashboard-container-1">
                                        <div class="col-md-12" style="margin-bottom: 20px;">
                                            <strong>Customize the way the form looks and get notifications on new booking inquiries.</strong>
                                        </div>
                                        <div class="col-md-12">
                                            <strong>Customize Form Fields</strong>
                                            <br />
                                            Select the fields that will be part of the form and required ones.
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px;">
                                            <table class="table tbl-custom-fields">
                                              <thead>
                                                <tr>
                                                  <th width="40%" scope="col"><strong>Field</strong></th>
                                                  <th width="20%" scope="col"><strong>Visible</strong></th>
                                                  <th width="20%" scope="col"><strong>Required</strong></th>
                                                  <th width="20%" scope="col"><strong>-</strong></th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php if(!isset($booking_forms)) { ?>                                       
                                                    <?php foreach($default_form_fields as $dff_key => $default_form_field) { ?>
                                                        <?php 
                                                            $is_required = "";
                                                            $is_visible = "checked=''";

                                                            $is_required_disabled = "";
                                                            $is_visible_disabled = "";

                                                            if($default_form_field == 'full_name' || $default_form_field == 'contact_number') {
                                                                $is_required = "checked=''";
                                                                $is_visible = "checked=''";

                                                                $is_required_disabled = "disabled=''";
                                                                $is_visible_disabled = "disabled=''";
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td width="60%">
                                                                <?php echo $dff_key; ?>
                                                                <input type="hidden" id="is_field[<?php echo $default_form_field; ?>][]" name="is_field[<?php echo $default_form_field; ?>][]" value="<?php echo $dff_key; ?>">
                                                            </td>
                                                            <td width="20%">
                                                                <div class="checkbox checkbox-sm">
                                                                    <input type="checkbox" name="is_visible[<?php echo $default_form_field; ?>][]" value="1" class="checkbox-select select-form-field-visible" data-field-name="<?php echo $default_form_field; ?>" id="is_visible_<?php echo $default_form_field; ?>" <?= $is_visible ; ?> <?= $is_visible_disabled; ?> >
                                                                    <label for="is_visible_<?php echo $default_form_field; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td width="20%" style="">
                                                                <div class="checkbox checkbox-sm">
                                                                    <input type="checkbox" name="is_required[<?php echo $default_form_field; ?>][]" value="1" data-id="is_required[<?php echo $default_form_field; ?>][]" class="checkbox-select select-form-field-required" id="is_required_<?php echo $default_form_field; ?>" <?= $is_required ; ?> <?= $is_required_disabled; ?> >
                                                                    <label for="is_required_<?php echo $default_form_field; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                &nbsp;                                                   
                                                            </td>
                                                        </tr>
                                                    <?php } ?> 

                                                <?php } else { ?>
                                                    <?php $row_count = 1; ?>
                                                    <?php foreach($booking_forms as $dff_key => $booking_form) { ?>
                                                    <?php 
                                                        if($booking_form->is_required ==1) {
                                                            $is_required = "checked=''";
                                                        }else{
                                                            $is_required = "";
                                                        }    

                                                        if($booking_form->is_visible ==1) {
                                                            $is_visible = "checked=''";
                                                        }else{
                                                            $is_visible = "";
                                                        }

                                                        $is_required_disabled = "";
                                                        $is_visible_disabled = "";

                                                        if($booking_form->field_name == 'full_name' || $booking_form->field_name == 'contact_number') {
                                                            $is_required = "checked=''";
                                                            $is_visible = "checked=''";

                                                            $is_required_disabled = "disabled=''";
                                                            $is_visible_disabled = "disabled=''";
                                                        }
                                                    ?>
                                                    <?php if($booking_form->is_default==1){ ?> 
                                                       <tr>                
                                                    <?php }else{ ?>
                                                       <tr class="custom-row-<?php echo $row_count; ?>">
                                                    <?php } ?>
                                                        <td width="60%">
                                                            <?php echo $booking_form->label; ?>
                                                            <input type="hidden" name="is_field[<?php echo $booking_form->field_name; ?>][]" id="is_field[<?php echo $booking_form->field_name; ?>][]" value="<?php echo $booking_form->label; ?>">
                                                        </td>
                                                        <td width="20%">
                                                            <div class="checkbox checkbox-sm">
                                                                <input type="checkbox" name="is_visible[<?php echo $booking_form->field_name; ?>][]" value="1" class="checkbox-select select-form-field-visible" data-field-name="<?php echo $booking_form->field_name; ?>" id="is_visible_<?php echo $booking_form->field_name; ?>" <?= $is_visible ; ?> <?= $is_visible_disabled; ?> >
                                                                <label for="is_visible_<?php echo $booking_form->field_name; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td width="20%" style="">
                                                            <div class="checkbox checkbox-sm">
                                                                <input type="checkbox" name="is_required[<?php echo $booking_form->field_name; ?>][]" value="1" data-id="is_required[<?php echo $booking_form->field_name; ?>][]" class="checkbox-select select-form-field-required" id="is_required_<?php echo $booking_form->field_name; ?>" <?= $is_required ; ?> <?= $is_required_disabled; ?> >
                                                                <label for="is_required_<?php echo $booking_form->field_name; ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <?php if($booking_form->is_default==1){ ?> 
                                                                    &nbsp;
                                                            <?php }else{ ?>
                                                                   <a href="javascript:void(0);" class="delete-custom-field" data-field-name="<?php echo $booking_form->field_name; ?>" data-row="<?php echo $row_count; ?>"><i class="fa fa-trash"></i></a>          
                                                            <?php }?>
                                                        </td>
                                                    </tr>
                                                 <?php  $row_count++; }
                                                  } ?>
                                              </tbody>
                                            </table>   

                                            <div class="field-name-container" id="field-name-container" style="display: none;">

                                                <div class="form-group" id="">
                                                    <label>Field Name</label> <span class="help">(e.g. Do you have pets)</span>
                                                    <input type="text" name="field_name" value="" class="form-control" autocomplete="off">
                                                </div>
                                                <div class="form-group" id="">
                                                    <button class="btn btn-success">Add</button>
                                                    <a style="padding-left: 9px;" id="hide-add-form-field-row" data-time-slot="btn-add" href="javascript:void(0);">I'm done adding fields</a>
                                                </div>

                                            </div>

                                            <!-- <a style="padding-left: 9px;" id="add-form-field-row" data-time-slot="btn-add" href="javascript:void(0);"><span class="fa fa-plus-square fa-margin-right add-form-field-row"></span> Add Form Field</a> -->
                                            <a style="padding-left: 9px;" id="" href="javascript:void(0);" data-toggle="modal" data-target="#modalAddFormField">
                                                <span class="fa fa-plus-square fa-margin-right add-form-field-row"></span> Add Form Field
                                            </a>      
                                            <span class="form-message-saving"></span>
                                        </div>
                                    </div>                                 
                                </form>
                            </div>
                            <div class="col-md-6">

                                <div class="row dashboard-container-1">
                                    <div class="col-md-12">

                                        <div style="padding: 40px; border: 0px solid rgb(221, 221, 221); background: rgb(242, 242, 242) none repeat scroll 0% 0%;">
                                            <div class="weight-medium margin-bottom">Preview Form</div> 
                                            <div style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; padding: 30px;">
                                                <div id="app" class="markate-widget-contact" style="color: rgb(34, 34, 34); font-size: 16px; font-family: &quot;roboto&quot;, Arial, Helvetica, sans-serif;">
                                                    <form name="widget-contact" method="post">
                                                        <div class="form-fileds-container">
                                                            <div class="form-group form-group-full_name">
                                                                <label>Full Name</label> <span class="form-required">*</span> 
                                                                <input type="text" id="full_name" name="full_name" class="form-control">
                                                            </div>
                                                            <div class="form-group form-group-contact_number">
                                                                <label>Contact Number</label> <span class="form-required">*</span> 
                                                                <input type="tel" id="contact_number" name="contact_number" class="form-control">
                                                            </div>
                                                            <div class="form-group form-group-email">
                                                                <label>Email</label>
                                                                <input type="text" id="email" name="email" class="form-control">
                                                            </div>
                                                            <div class="form-group form-group-address">
                                                                <label>Address</label>
                                                                <input type="text" id="address" name="address" placeholder="" class="form-control pac-target-input" autocomplete="off">
                                                            </div>
                                                            <div class="form-group form-group-message">
                                                                <label>Message</label>
                                                                <textarea style="min-height: 100px;" name="message" id="message" rows="2" class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group form-group-preferred_time_to_contact">
                                                                <label>Preferred time to contact</label>
                                                                <select name="preferred_time_to_contact" id="preferred_time_to_contact" class="form-control">
                                                                    <option value="0" selected="selected">Any time</option> 
                                                                    <option value="1">7am to 10am</option> 
                                                                    <option value="2">10am to Noon</option> 
                                                                    <option value="3">Noon to 4pm</option> 
                                                                    <option value="4">4pm to 7pm</option>
                                                                </select>
                                                            </div>                                                        
                                                            <div class="form-group form-group-how_did_you_hear_about_us">
                                                                <label>How did you hear about us</label>
                                                                <input type="text" name="how_did_you_hear_about_us" id="how_did_you_hear_about_us" class="form-control">
                                                            </div>
                                                            <?php foreach($booking_forms_custom as $form_custom) { ?>
                                                                <div class="form-group form-group-<?php echo $form_custom->field_name; ?>">
                                                                    <label><?php echo $form_custom->label; ?></label>
                                                                    <input type="text" name="<?php echo $form_custom->field_name; ?>" id="<?php echo $form_custom->field_name; ?>" class="form-control">
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </form> 
                                                    <hr class="card-hr"> 
                                                    <div class="widget-contact-submit"><button class="btn btn-primary btn-lg">Book Now</button></div>
                                                </div>
                                            </div>
                                        </div> 

                                    </div>
                                </div>  
                                
                            </div>
                        </div> 
                        <hr />
                        <div>
                            <button class="btn btn-success">Save</button>
                            <a style="float: right;" href="<?php echo base_url('more/addon/booking/coupons') ?>" class="btn btn-success"> Continue >> </a>
                        </div>

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div><?php include viewPath('includes/booking_modals'); ?>   
<?php include viewPath('includes/footer_booking'); ?>
<script>
$(function(){
    var base_url = "<?php echo base_url(); ?>";

    $(".btn-success").click( function(){  

        $("#booking_component").submit();

        // var cid = $(this).attr("data-id");
        // var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        // var url = base_url + '/booking/save_form';
        
        // $(".form-message-saving").html(msg);
        // $.ajax({
        //    type: "POST",
        //    url: url,
        //    data: {cid:cid},
        //    success: function(o)
        //    {
        //       $(".form-message-saving").html(o);
        //    }
        // });
       
    });

    $(".delete-custom-field").click(function(){
        var row = $(this).attr('data-row');
        $(".custom-row-" + row).remove();
        $(".custom-field-" + row).remove();

        var field_name = $(this).attr("data-field-name");
        if($('#is_visible_' + field_name).is(':checked')) {
           $(".form-group-" + field_name).show();          
        } else {
           $(".form-group-" + field_name).hide();    
        }
    });    

});
</script>