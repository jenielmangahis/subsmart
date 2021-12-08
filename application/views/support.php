<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<section class="contact-spacing">
    <div class="container spacing-ft">
        <div class="row container-contact">
            <div class="col-sm-5 pt-1 mt-3 mobile-width-100">
              <div class="contact_container">
                <h2 class="contact-header">Support</h2>
                <h2 class="uppercase cn-tn">nSmarTrac</h2>
                <br/>
                <h4 class="cn-address">6866 Pine Forest Road <br/> Florida Headquarters <br/> Pensacola, FL 32526</h4>
                <br/>
                <div data-container="details" class="sp-ui">
                  <div class="sp-r contact-txt mb-15">
                    <span class="fa fa-phone"></span><span class="sp-txt ml-20">(844) 406-7286</span>
                  </div>
                  <div class="sp-r contact-txt mb-15">
                    <span class="fa fa-envelope"></span><a href="mailto:support@nsmartrac.com" class="contact-email">support@nsmartrac.com</a>
                  </div>
                </div>
                <br/>
                <h2 class="contact-header">Social Media</h2>
                <div class="social-cc text-left">
                  <a href="#" class="contact-social fb-color"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="contact-social twitter-color"><i class="fa fa-twitter"></i></a>
                </div>
              </div>
            </div>
            <?php echo form_open_multipart('contact/support_send', ['class' => 'form-validate', 'id' => 'frm-send-query', 'autocomplete' => 'off']); ?>
            <div class="col-sm-7 mobile-width-100">
              <div class="bg-contact-phone1">
                <div class="inquiry-container" style="width: 413px;margin-left: 78px;height: 459px;">
                  <p class="phone-header">Send us your concern</p>
                  <input type="text" value="" placeholder="Firstname" name="support_firstname" class="phone-input-contact" required="" /> 
                  <input type="text" value="" placeholder="Lastname" name="support_lastname" class="phone-input-contact" required="" />
                  <input type="text" value="" placeholder="Email" name="support_email" class="phone-input-contact" required="" />
                  <input type="text" value="" placeholder="Subject" name="support_subject" class="phone-input-contact" required="" />
                  <textarea placeholder="Message" class="phone-input-contact" style="height: 160px;" name="support_message"></textarea>
                  <button type="submit" class="btn-phone btn-support-send" style="width:120px;">Send</button>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
<script>
$(function(){
    $("#frm-send-query").submit(function(e){
        e.preventDefault();
        var url = base_url + 'contact/_support_send_email';
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

