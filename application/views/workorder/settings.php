<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/workorder'); ?>
        <?php include viewPath('includes/notifications'); ?>
        <div wrapper__section>
            <div class="card">
            <div class="container-fluid">
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <h1>Settings</h1>

                        <input type="hidden" id="company_name" value="<?php echo $clients->business_name; ?>">
                        <input type="hidden" id="current_date" value="<?php echo @date('m-d-Y'); ?>">

                        <?php echo form_open('workorder/settings', ['class' => 'form-validate require-validation', 'id' => 'workorder-settings', 'autocomplete' => 'off']); ?>
                        <div class="p-3">
                            <div class="err-msg hide" style="display: none;"></div>
                            <div class="form-group">
                                <label>Work Order Number</label>
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
                            <a href="www.google.com" style="padding: 10px;width: 18%;" class="btn btn-outline-secondary">Manage work order notifications</a>
                            <hr class="card-hr">
                            <button class="btn btn-primary btn-update-workorder-settings" name="btn-submit" type="button" style="width: 15%;">Save Changes</button>                            

                        </div>

                        <?php echo form_close(); ?>

                        <br><br>
                        <h5>Work Order Header</h5> 
                        <div class="row">     
                            <div class="col-md-8 form-group">
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
                        <h5>Custom Fields</h5> 
                        <div class="row"> 
                            <div class="col-md-6 form-group">
                                <label style="float:right;"><a href="#" style="color:green;" data-toggle="modal" data-target="#addcustomfield">Add another field</a></label>
                            </div>
                        </div>
                        <div class="row">                   
                            <div class="col-md-6 form-group">
                                <table class="table">
                                    <thead>
                                        <th>Custom Field Name</th>
                                        <th>Date Created</th>
                                        <th>Date Updated</th>
                                        <th>Action</th>
                                    </thead>
                                    <?php 
                                    //print_r($fields); 
                                    foreach($fields as $field){  ?>
                                    <tr>
                                        <td><?php echo $field->name; ?></td>
                                        <td><?php echo $field->date_created; ?></td>
                                        <td><?php echo $field->date_updated; ?></td>
                                        <td><a href="#" class="btn btn-warning field" field-id="<?php echo $field->id; ?>"  field-name="<?php echo $field->name; ?>" data-toggle="modal" data-target="#updatecustom_field">Update</a> 
                                        <!-- <a href="#" class="btn btn-danger" field-id="<?php echo $field->id; ?>">Delete</a> -->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                </table>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="addcustomfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
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
                                    <input type="text" class="form-control" name="custom_name" style="width:50%;" required><br>
                                    <input type="submit" value="Add" class="btn btn-success">
                                <?php echo form_close(); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="updatecustom_field" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Field</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php echo form_open_multipart('workorder/updatecustomField', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
                                    <label>Name</label>
                                    <input type="hidden" class="form-control" name="custom_id" id="custom_id"><br>
                                    <input type="text" class="form-control" name="custom_name" id="custom_name_update" style="width:50%;" ><br>
                                    <input type="submit" value="Update" class="btn btn-danger">
                                <?php echo form_close(); ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
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
            msg = '<div class="alert alert-danger" role="alert">Please enter Work Order number prefix.</div>';
            $(".err-msg").html(msg);
            $(".err-msg").fadeIn();
            $(this).html('Save Changes');
        }else if( $("#number-base").val() == '' ){
            msg = '<div class="alert alert-danger" role="alert">Please enter Work Order number.</div>';
            $(".err-msg").html(msg);
            $(".err-msg").fadeIn();
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
                            msg = '<div class="alert alert-info" role="alert">'+o.msg+'</div>';
                        }else{
                            msg = '<div class="alert alert-danger" role="alert">'+o.msg+'</div>';
                        }

                        $(".err-msg").html(msg);
                        $(".err-msg").fadeIn();

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
