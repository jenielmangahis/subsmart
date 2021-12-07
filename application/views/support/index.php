<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.left {
  float: left;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-40 {
  padding-top: 40px !important;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <?php echo form_open_multipart('support/send', ['class' => 'form-validate', 'id' => 'frm-send-query', 'autocomplete' => 'off']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mt-0">

                        <div class="row">
                          <div class="col-sm-6 left">
                            <h3 class="page-title">Support</h3>
                          </div>                          
                        </div>
                        <div class="alert alert-warning mt-2 mb-0" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Send email to our support so that we may assist you.
                            </span>
                        </div>

                        <div class="card-body row">    
                            <div class="col-md-6">                                                    
                                <div class="row mt-2">
                                    <div class="col-md-10 form-group">
                                        <label for="customers">First Name</label>
                                        <input type="text" value="<?php echo $user->FName; ?>" name="first_name" id="first_name" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-10 form-group">
                                        <label for="customers">Last Name</label>
                                        <input type="text" value="<?php echo $user->LName; ?>" name="last_name" id="last_name" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-10 form-group">
                                        <label for="customers">Email</label>
                                        <input type="email" value="<?php echo $user->email; ?>" name="email" id="email" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-10 form-group">
                                        <label for="customers">Subject</label>
                                        <input type="text" value="" name="subject" id="subject" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-10 form-group">
                                        <label for="customers">Message</label>
                                        <textarea class="form-control" name="message" style="height:150px;" id="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <button type="submit" class="btn btn-flat btn-primary btn-support-send">Send</button>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">                                  
                                <img src="<?php echo $url->assets ?>img/support.png" style="margin: 5% auto;" class="card-img card-features" alt="card 1">
                                <h2 style="font-size:28px;text-align: center;">Our support team are here to help you.</h2>                                
                            </div>
                        </div>                    
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
<?php include viewPath('includes/footer'); ?>
<script>
$(function(){
    $("#frm-send-query").submit(function(e){
        e.preventDefault();
        var url = base_url + 'support/_send_email';
        Swal.fire({
          title: 'Are all entries correct?',
          text: "Your concern will be sent to our support team",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#32243d',
          cancelButtonColor: '#32243d',
          confirmButtonText: 'Send'
        }).then((result) => {
          if (result.isConfirmed) {
            $(".btn-support-send").html('<span class="spinner-border spinner-border-sm m-0"></span>  Sending');
            $.ajax({
             type: "POST",
             url: url,
             dataType: "json",
             data: $("#frm-send-query").serialize(),
             success: function(o)
             {
               if( o.is_sent == 1 ){
                Swal.fire({
                  title: 'Success',
                  html: '<p>Your concern was successfully sent.</p><p>Our support team will contact you soon via your email.</p>',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#32243d',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok'
                });

                $("#frm-send-query")[0].reset();

               }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Cannot send email.',
                  text: o.msg
                });
               }
               $(".btn-support-send").html('Send'); 
             }
            });


          }
        })
    });
});
</script>
