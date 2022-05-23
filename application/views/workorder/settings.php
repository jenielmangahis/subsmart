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
