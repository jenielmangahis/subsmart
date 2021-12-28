<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.p-40 {
  padding-top: 40px !important;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/setting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <div class="row">
                <div class="col">
                    <h3 class="m-0">Add New SMS Template</h3>
                </div>
                <div style="background-color:#fdeac3;padding:.5%;margin-bottom:5px;margin-top:5px;margin-bottom:10px; width:100%;margin-left: 14px;">
                    Create you own sms template
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="card">
                            <form method="post" id="frm-add-sms-template">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="title">Template Name</label>
                                                    <input type="text" class="form-control" name="title" id="title" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label for="notes">SMS</label>
                                                <textarea id="summernote" name="sms_body"></textarea>
                                            </div>
                                            <div class=" col-md-12 form-group">
                                                <label class="" for="email-1">Template Type</label>
                                                <select class="form-control" data-style="btn-white" name="type_id" required>
                                                    <?php foreach($option_template_types as $key => $value){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class=" col-md-12 form-group">
                                                <label class="" for="email-1">Details</label>
                                                <select class="form-control" data-style="btn-white" name="details" required>
                                                    <?php foreach($option_details as $key => $value){ ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 mt-3">
                                                <button type="submit" class="btn btn-flat btn-primary btn-create-sms-template">Save</button>
                                                <a href="<?= base_url('settings/sms_templates') ?>" type="button" class="btn btn-flat btn-primary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
</div>

<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    //$('#summernote').summernote('code', '');
    $('#summernote').summernote({height: 300,focus: false});
    $("#frm-add-sms-template").submit(function(e){
        e.preventDefault();
        var url = base_url + 'settings/_create_sms_template';
        $(".btn-create-email-template").html('<span class="spinner-border spinner-border-sm m-0"></span> Saving');
        setTimeout(function () {
            $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#frm-add-sms-template").serialize(),
                 dataType: 'json',
                 success: function(o)
                 {
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Success',
                            text: 'SMS template was successfully created.',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            location.href = base_url + "/settings/sms_templates"; 
                        });
                    }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Cannot save data.',
                          text: o.msg
                        });
                    }

                    $(".btn-create-sms-template").html('Save');
                 }
            });
        }, 300);        
    });
});
</script>