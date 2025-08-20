<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>
<style>
.row-header{
    background-color: #32243d;
    color: #ffffff;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 5px !important;
  padding-left: 39px !important;
  margin-top: 55px !important;
}
.add-text{
    padding-left: 9px; 
    float: right;
    text-decoration: none;
    color: #259e57;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/online_booking_tabs'); ?>
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
                            Customize the way the form looks and get notifications on new booking inquiries.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <form name="booking_component" id="frm-booking-form" action="<?php echo base_url('booking/save_form'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span><i class='bx bx-fw bx-list-ol'></i> Customize Form Fields <span class="bx bx-fw bx-help-circle" id="popover-customize-form-fields"></span></span>
                                                <?php if( checkRoleCanAccessModule('online-booking', 'write') ){ ?>  
                                                <a class="nsm-button btn-small float-end mb-4" id="btn-add-new-form-field" href="javascript:void(0);" data-toggle="modal" data-target="#modalAddFormField">
                                                    <i class='bx bx-plus'></i> Add Form Field
                                                </a>                                            
                                            <?php } ?>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                        <div class="col-md-12" style="margin-top: 20px;">                                           
                                            <?php 
                                                $disabled = '';
                                                if( !checkRoleCanAccessModule('online-booking', 'write') ){
                                                    $disabled = 'disabled=""';
                                                }
                                            ?>
                                            <table class="nsm-table" style="clear:both;margin-top: 20px;">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" scope="col"><strong></strong></th>
                                                        <th width="20%" scope="col"><strong>Visible</strong></th>
                                                        <th width="20%" scope="col"><strong>Required</strong></th>
                                                        <th width="20%" scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!$booking_forms) { ?>                                       
                                                        <?php foreach($default_form_fields as $dff_key => $default_form_field) { ?>
                                                            <?php 
                                                                $is_required = "";
                                                                $is_visible = "checked=''";

                                                                $is_required_disabled = "";
                                                                $is_visible_disabled = "";

                                                                if($default_form_field == 'full_name' || $default_form_field == 'contact_number' || $default_form_field == 'email') {
                                                                    $is_required = "checked=''";
                                                                    $is_visible = "checked=''";

                                                                    $is_required_disabled = "disabled=''";
                                                                    $is_visible_disabled = "disabled=''";
                                                                }
                                                            ?>
                                                            <tr>
                                                                <td width="60%">
                                                                    <?php echo $dff_key; ?>
                                                                    <input type="hidden" id="is_field[<?php echo $default_form_field; ?>][]" name="is_field[<?php echo $default_form_field; ?>]" value="<?php echo $dff_key; ?>">
                                                                </td>
                                                                <td width="20%">
                                                                    <div class="checkbox checkbox-sm">
                                                                        <input type="checkbox" name="is_visible[<?php echo $default_form_field; ?>]" value="1" class="checkbox-select form-check-input select-form-field-visible" data-field-name="<?php echo $default_form_field; ?>" id="is_visible_<?php echo $default_form_field; ?>" <?= $is_visible ; ?> <?= $is_visible_disabled; ?> >
                                                                        <label for="is_visible_<?php echo $default_form_field; ?>"></label>
                                                                    </div>
                                                                </td>
                                                                <td width="20%" style="">
                                                                    <div class="checkbox checkbox-sm">
                                                                        <input type="checkbox" name="is_required[<?php echo $default_form_field; ?>]" value="1" data-id="is_required[<?php echo $default_form_field; ?>][]" class="form-check-input checkbox-select select-form-field-required" id="is_required_<?php echo $default_form_field; ?>" <?= $is_required ; ?> <?= $is_required_disabled; ?> >
                                                                        <label for="is_required_<?php echo $default_form_field; ?>"></label>
                                                                    </div>
                                                                </td>
                                                                <td></td>
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

                                                            if($booking_form->field_name == 'full_name' || $booking_form->field_name == 'contact_number' || $booking_form->field_name  == 'email') {
                                                                $is_required = "checked=''";
                                                                $is_visible = "checked=''";

                                                                $is_required_disabled = "disabled=''";
                                                                $is_visible_disabled = "disabled=''";
                                                                //$disabled = '';
                                                            }
                                                        ?>
                                                        <?php if($booking_form->is_default==1){ ?> 
                                                        <tr>                
                                                        <?php }else{ ?>
                                                        <tr class="custom-row-<?php echo $row_count; ?>">
                                                        <?php } ?>
                                                            <td width="60%">
                                                                <?php echo $booking_form->label; ?>
                                                                <input type="hidden" name="is_field[<?php echo $booking_form->field_name; ?>]" id="is_field[<?php echo $booking_form->field_name; ?>][]" value="<?php echo $booking_form->label; ?>">
                                                            </td>
                                                            <td width="20%">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="is_visible[<?php echo $booking_form->field_name; ?>]" value="1" class="form-check-input select-form-field-visible" data-field-name="<?php echo $booking_form->field_name; ?>" id="is_visible_<?php echo $booking_form->field_name; ?>" <?= $is_visible ; ?> <?= $is_visible_disabled; ?> <?= $disabled; ?>>
                                                                    <label for="is_visible_<?php echo $booking_form->field_name; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <td width="20%" style="">
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="is_required[<?php echo $booking_form->field_name; ?>]" value="1" data-id="is_required[<?php echo $booking_form->field_name; ?>][]" class="form-check-input select-form-field-required" id="is_required_<?php echo $booking_form->field_name; ?>" <?= $is_required ; ?> <?= $is_required_disabled; ?> <?= $disabled; ?>>
                                                                    <label for="is_required_<?php echo $booking_form->field_name; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <?php if( checkRoleCanAccessModule('online-booking', 'delete') ){ ?>  
                                                                <td width="20%">
                                                                    <?php if($booking_form->is_default==1){ ?> 
                                                                            &nbsp;
                                                                    <?php }else{ ?>
                                                                        <a href="javascript:void(0);" class="nsm-button btn-small delete-custom-field" data-field-name="<?php echo $booking_form->field_name; ?>" data-row="<?php echo $row_count; ?>"><i class="fa fa-trash"></i></a>          
                                                                    <?php }?>
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php  $row_count++; }
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <?php if( checkRoleCanAccessModule('online-booking', 'write') ){ ?> 
                                                <div class="row mt-4">
                                                    <div class="col-12">
                                                        <button type="submit" id="btn-update-booking-form" class="nsm-button primary">Save</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header d-block">
                                        <div class="nsm-card-title">
                                            <span><i class='bx bx-search-alt-2'></i> Form Preview</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <div id="form-preview-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end custom form -->
        </div>
    </div>
</div>



<?php include viewPath('v2/includes/online_booking/booking_modals'); ?>   
<?php include viewPath('v2/includes/footer'); ?>
<script>
$(function(){

    load_booking_form_preview();

    $('#btn-add-new-form-field').on('click', function(){
        $('#modalAddFormField').modal('show');
    });
    
    $(".btn-success").click( function(){  
        $("#booking_component").submit();
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

    $('#frm-booking-form').on('submit', function(e){
        e.preventDefault();

        var formData = new FormData($("#frm-booking-form")[0]);

        $.ajax({
            type: 'POST',
            url: base_url + "booking/_update_custom_booking_form",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',                
            success: function(result) {
                if( result.is_success === 1 ){
                    Swal.fire({
                        title: 'Booking Form',
                        text: 'Booking form has been updated successfully.',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            load_booking_form_preview();
                        //}
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            //location.reload();
                        //}
                    });
                }   
                
                $('#btn-update-booking-form').html("Save");
            },
            beforeSend: function(){
                $('#btn-update-booking-form').html('<span class="bx bx-loader bx-spin"></span>');
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: "Something went wrong, please try again later.",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    //if (result.value) {
                        //location.reload();
                    //}
                });
            },
        });
    });
    
    $('#frm-booking-add-field').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "booking/_create_form_field",
            dataType: 'json',
            data: $('#frm-booking-add-field').serialize(),
            success: function(data) {    
                $('#btn-save-form-field').html('Save');                   
                if (data.is_success) {
                    $('#modalAddFormField').modal('hide');
                    location.reload();  
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: data.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#btn-save-form-field').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    function load_booking_form_preview()
    {
        $.ajax({
            method: 'POST',
            url: base_url + 'booking/_load_custom_booking_form_preview',
            success: function(o) {                        
                $('#form-preview-container').html(o);
            },
            beforeSend: function(){
                $('#form-preview-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }

});
</script>