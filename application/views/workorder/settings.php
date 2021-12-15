<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.settings-header{
    background-color: #32243d;
    padding: 10px;
    color: #ffffff;
}
</style>
    <!-- page wrapper start -->
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/workorder'); ?>
        <?php include viewPath('includes/notifications'); ?>
        <div wrapper__section>
            <div class="card">
            <div class="container-fluid">
                <!-- end row -->
                <div class="row">
                    <div class="col">
                        <h3 class="m-0">Settings</h3>
                    </div>
                </div>
                
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px;">
                    Configure your workorder settings.
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                        <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">

                        <?php echo form_open('workorder/settings', ['class' => 'form-validate require-validation', 'id' => 'workorder-settings', 'autocomplete' => 'off']); ?>
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="err-msg hide" style="display: none;"></div>
                                        <div class="form-group">
                                            <h5 class="settings-header">Work Order Number</h5>
                                            <div class="help help-sm help-block">Set the prefix and the next auto-generated
                                                number.
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="margin-bottom-qui">Prefix</div>
                                                    <input type="text" name="next_custom_number_prefix" id="number-prefix" value="<?php echo $prefix ?>" class="form-control" autocomplete="off">
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="margin-bottom-qui">Next number</div>
                                                    <input type="text" name="next_custom_number_base" id="number-base" value="<?php echo $order_num_next; ?>" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Work Order Template</label>
                                                    <div class="help help-sm help-block">Select from the options below the fields
                                                        you want hidden on your work order template.
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="checkbox" <?= $capture_signature > 0 ? 'checked="checked"' : ''; ?> name="hide_from_email" value="1" id="hide_from_email">
                                                                <label for="hide_from_email"><span>Hide business email</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="card-hr">
                                        <a href="<?php echo base_url('settings/notifications'); ?>" style="padding: 10px;" class="btn btn-outline-secondary">Manage work order notifications</a>
                                        <hr class="card-hr">
                                        <button class="btn btn-primary btn-update-workorder-settings" name="btn-submit" type="button">Save Changes</button>
                                </div>

                                <div class="col-md-6">
                                    <h5 class="settings-header">Custom Fields</h5> 
                                    <label style="float:right;"><a href="#" style="color:green;" data-toggle="modal" data-target="#addcustomfield">Add another field</a></label>
                                    <table class="table">
                                        <thead>
                                            <th style="width:50%;">Custom Field Name</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </thead>
                                        <?php 
                                        //print_r($fields); 
                                        foreach($fields as $field){  ?>
                                        <tr class="cf-row-<?php echo $field->id; ?>">
                                            <td><?php echo $field->name; ?></td>
                                            <td><?php echo $field->date_created; ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary field" field-id="<?php echo $field->id; ?>"  field-name="<?php echo $field->name; ?>" data-toggle="modal" data-target="#updatecustom_field">Update</a>
                                                <a href="javascript:void(0);" class="btn btn-danger field btn-delete-cf" data-id="<?php echo $field->id; ?>"  data-name="<?php echo $field->name; ?>">Delete</a>                                         <!-- <a href="#" class="btn btn-danger" field-id="<?php echo $field->id; ?>">Delete</a> -->
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php echo form_close(); ?>

                        <br><br>
                        <h5 class="settings-header">Work Order Header</h5> 
                        <div class="row">     
                            <div class="col-md-12 form-group">
                            <?php if($headers){ ?>
                                <?php echo form_open_multipart('workorder/updateheader', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                                    <textarea id="updateheader" name="update_header" class="form-control">
                                    <?php echo $headers->content; ?>
                                    </textarea><br>
                                    <input type="submit" value="Update Header" class="btn btn-primary">
                                <?php echo form_close(); ?>
                            <?php }else{ ?>

                                <?php echo form_open_multipart('workorder/addheader', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                                    <textarea id="updateheader" name="add_header" class="form-control">
                                    </textarea><br>
                                    <input type="submit" value="Add Header" class="btn btn-success">
                                <?php echo form_close(); ?>

                            <?php } ?>
                            
                            </div>
                        </div>

                        <br><br>
                        

                        <!-- Modal -->
                        <div class="modal fade" id="addcustomfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Custom Field</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php echo form_open_multipart('workorder/addcustomeField', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="custom_name" style="width:100%;" required>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Add" class="btn btn-primary">                                
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="updatecustom_field" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Field</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php echo form_open_multipart('workorder/updatecustomField', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                                <div class="modal-body">                                
                                    <label>Name</label>
                                    <input type="hidden" class="form-control" name="custom_id" id="custom_id"><br>
                                    <input type="text" class="form-control" name="custom_name" required="" id="custom_name_update" style="width:100%;"/>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Update" class="btn btn-primary">                                
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- end row -->
            </div>
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $(".btn-update-workorder-settings").click(function(){
        var url      = base_url + '/workorder/_update_workorder_settings';
        var is_saved = 0;
        var msg = '<div class="alert alert-danger" role="alert">Cannot update setting</div>';

        $(this).html('Saving...');

        if( $("#number-prefix").val() == '' ){
            Swal.fire({
              icon: 'error',
              title: 'Cannot update settings.',
              text: 'Please enter Work Order number prefix.'
            });
            $(this).html('Save Changes');
        }else if( $("#number-base").val() == '' ){
            msg = '<div class="alert alert-danger" role="alert">Please enter Work Order number.</div>';
            Swal.fire({
              icon: 'error',
              title: 'Cannot update settings.',
              text: 'Please enter Work Order number.'
            });
            $(this).html('Save Changes');
        }else{
            setTimeout(function () {
                $.ajax({
                   type: "POST",
                   url: url,
                   data: $("#workorder-settings").serialize(),
                   dataType: "json",
                   success: function(o)
                   {
                        if( o.is_success == 1 ){
                            Swal.fire({
                              title: 'Success',
                              text: 'Your workorder settings was successfully updated',
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#32243d',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Ok'
                            });                            
                        }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Cannot update settings.',
                              text: o.msg
                            });
                        }

                        $('.btn-update-workorder-settings').html('Save Changes');
                   }
                });
            }, 1000);
        }    
    });
});
</script>

<script>
$(document).ready(function(){

    $('.field').each(function(e){
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        // e.preventDefault();
        $(this).on('click', function(){
            var id = $(this).attr('field-id');
            var name = $(this).attr('field-name');
            $('#custom_id').val(id);
            $('#custom_name_update').val(name);
            // alert(id);
            
        });
    });

    $('.btn-delete-cf').click(function(){
        var cfid = $(this).attr('data-id');
        var cname = $(this).attr('data-name')
        var url = base_url + 'workorder/_delete_custom_field';
        Swal.fire({
          title: 'Delete custom field &nbsp<b>' + cname + '</b>?',
          html: '',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#ea2e4d',
          cancelButtonColor: '#32243d',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: {cfid:cfid},
             success: function(o)
             {
               if( o.is_deleted == 1 ){
                Swal.fire({
                  title: 'Success',
                  text: 'Custom Field was successfully deleted',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#32243d',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok'
                });

                $(".cf-row-"+ cfid).fadeOut("normal", function() {
                    $(this).remove();
                });

               }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot find data.',
                  text: o.msg
                });
               }
             }
            });


          }
        })
    });

});
</script>
<script>
// var value = $("#headerContent").text();
// if(value.indexOf("agreement") != -1)
// //   alert("true");
// return $(this).text().replace("agreement", "yeahhhhh"); 
// else
//   alert("false");
// $(".headerContent").text(function () {
//     return $(this).text().replace("agreement", "yeahhhhh"); 
// });​​​​​

jQuery(function($){

// Replace 'td' with your html tag
$("#updateheader").html(function() { 

// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
 var currentDate = $('#current_date').val();
      return $(this).html().replace("day", currentDate);  

});
});

jQuery(function($){

// Replace 'td' with your html tag
$("#updateheader").html(function() { 

    var companyName = $('#company_name').val();
// Replace 'ok' with string you want to change, you can delete 'hello everyone' to remove the text
      return $(this).html().replace("ADI", companyName);  

});
});
</script>
