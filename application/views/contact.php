<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<section class="contact-spacing">
    <div class="container spacing-ft">
        <div class="row container-contact">
            <div class="col-sm-5 pt-1 mt-3 mobile-width-100">
              <div class="contact_container">
                <h2 class="contact-header">Get in touch</h2>
                <h2 class="uppercase cn-tn">nSmarTrac</h2>
                <br/>
                <h4 class="cn-address">6866 Pine Forest Road <br/> Florida Headquarters <br/> Pensacola, FL 32526</h4>
                <br/>
                <div data-container="details" class="sp-ui">
                  <div class="sp-r contact-txt mb-15">
                    <span class="fa fa-phone"></span><span class="sp-txt ml-20">(844) 406-7286</span>
                  </div>
                  <div class="sp-r contact-txt mb-15">
                    <span class="fa fa-envelope"></span><a href="mailto:websupport@nsmartrac.com" class="contact-email">websupport@nsmartrac.com</a>
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
            <div class="col-sm-7 mobile-width-100">
              <div class="bg-contact-phone">
                <div class="inquiry-container">
                  <p class="phone-header">Drop us a line</p>
                  <form id="frm-contact-us">
                    <input type="text" value="" name="contact_us_name" placeholder="Name" class="phone-input-contact" required />
                    <input type="text" value="" name="contact_us_address" placeholder="Address" class="phone-input-contact" />
                    <input type="text" value="" name="contact_us_phone" placeholder="Phone number" class="phone-input-contact" required />
                    <input type="email" value="" name="contact_us_email" placeholder="Email" class="phone-input-contact" required />
                    <textarea placeholder="Message" name="contact_us_message" class="phone-input-contact" style="height: 95px;" required></textarea>
                    <input type="hidden" name="contact_chk" value="" id="contact-chk" >
                    <button type="submit" id="btn-send-contact-us" class="btn-phone">Send</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
<script>
$(function(){
  $('#frm-contact-us').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url: base_url + 'contact/_support_send_email',
        type: "POST",
        dataType: "json",
        data: $('#frm-contact-us').serialize(),
        success: function(data) {
            $("#btn-send-contact-us").prop('disabled', false);
            $('#btn-send-contact-us').html('Send');
            if (data.is_success == 1) {                  
                Swal.fire({
                title: 'Contact Us',
                text: "Your inquiry was successfully sent.",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
                }).then((result) => {
                //if (result.value) {
                    
                //}
                });
            } else {
                Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: 'Failed',
                text: data.msg,
                icon: 'warning'
                });
            }

            $('#frm-contact-us').trigger("reset");
        },
        beforeSend: function() {
            $("#btn-send-contact-us").prop('disabled', true);
            $('#btn-send-contact-us').html('Sending');
        }
    });
  })
});
</script>
