<style>
.btn-set-customer-mobile{
    display: block;
    margin-top: 13px;
}
.accordion-button{
    background-color: #6a4a86 !important;
    color:#ffffff;
}
.accordion-button:focus {
    border: none !important;
}
.accordion-button:not(.collapsed) {
    color: #ffffff !important; 
}
.accordion-button::after {    
    background-color: #ffffff;
}
.accordion-button:not(.collapsed)::after{
    background-color: #ffffff;
    padding: 5px;
}
.btn-use-template{
    position:absolute;
    right:49px;
    top:12px;
    z-index: 99999;
}
.accordion-header{
    position:relative;
}
.btn-use-template:hover{
    background-color: #529562ba !important;
}
</style>
<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Profile</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <div class="nsm-profile me-3">
                            <?php if ($profile_info->customer_type === 'Business'): ?>
                                <span>
                                <?php 
                                    $parts = explode(' ', strtoupper(trim($profile_info->business_name)));
                                    echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                ?>
                                </span>
                            <?php else: ?>
                                <span><?= ucwords($profile_info->first_name[0]) . ucwords($profile_info->last_name[0]) ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="row w-100">
                            <div class="col-12 col-md-6">
                                <span class="content-title">
                                    <?php if ($profile_info->customer_type === 'Business'): ?>
                                        <?= $profile_info->business_name ?>
                                    <?php else: ?>
                                        <?= $profile_info->first_name . ' ' . $profile_info->last_name ?>
                                    <?php endif; ?>    
                                </span>
                                <span class="content-subtitle d-block"><?= $profile_info->email ?></span>
                            </div>
                            <div class="col-12 col-md-6 text-end">
                                <?php
                                switch (strtoupper($profile_info->status)):
                                    case "INSTALLED":
                                        $badge = "success";
                                        break;
                                    case "CANCELLED":
                                        $badge = "error";
                                        break;
                                    case "COLLECTIONS":
                                        $badge = "secondary";
                                        break;
                                    case "CHARGED BACK":
                                        $badge = "primary";
                                        break;
                                    default:
                                        $badge = "";
                                        break;
                                endswitch;
                                ?>
                                <span class="nsm-badge <?= $badge ?>"><?= !is_null($profile_info->status) ? $profile_info->status : 'Pending'; ?></span>
                                <span class="content-subtitle d-block"><?= $profile_info->phone_h ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url("/customer/preview/$profile_info->prof_id"); ?>">
                        View Profile
                    </a>
                    <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url("/customer/add_advance/$profile_info->prof_id"); ?>">
                        Edit Profile
                    </a>
                </div>                
                <div class="col-12 col-md-7 text-end">
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="checkbox" value="1" id="notify_by_sms" name="notify_by_sms" checked>
                        <label class="form-check-label" for="notify_by_sms">
                            Notify by SMS
                        </label>
                    </div>
                    <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="1" id="notify_by_email" name="notify_by_email" checked>
                        <label class="form-check-label" for="notify_by_email">
                            Notify by Email
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-12 mt-5">
                    <a role="button" class="nsm-button primary w-100 ms-0 mt-5 send-sms-message" href="javascript:void(0);" data-customer-name="<?= ucwords($profile_info->first_name) . ' ' . ucwords($profile_info->last_name) ?>" data-id="<?= $profile_info->prof_id; ?>" data-phone="<?= $profile_info->phone_m; ?>">
                        Send SMS
                    </a>
                </div>
                <div class="col-12 mb-2" id="customerquickactions">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="#" class="nsm-link" id="managequickactions">Manage Quick Actions</a>
                    </div>

                    <div class="nsm-empty empty-message">
                        Click Manage Quick Actions to view available shortcuts for this customer.
                    </div>

                    <div class="actions-wrapper" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 8px;"></div>
                    
                    <div class="d-none">
                        <!-- Actions will come from database -->
                        <button role="button" class="nsm-button w-100 ms-0">
                            <i class='bx bx-fw bx-import'></i> 1-Click Import and Audit, Pull reports & Create audit
                        </button>
                        <a href="<?=base_url('EsignEditor/wizard?customer_id=' . $profile_info->prof_id)?>" role="button" class="nsm-button d-flex justify-content-center align-items-center w-100 ms-0">
                            <i class='bx bx-fw bxs-magic-wand'></i> Run Dispute Wizard, Create letters/correct errors
                        </a>
                        <button role="button" class="nsm-button w-100 ms-0">
                            <i class='bx bx-fw bx-message-rounded-check'></i> Send Secure Message, Via Client Portal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="managequickactionsmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer Quick Actions</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Select the actions you would like to display in this customer's profile</p>

        <div>
            <div class="actions-loader d-flex align-items-center justify-content-center" style="min-height: 300px;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="actions-wrapper"></div>
        </div>

        <template>
            <div class="nsm-card mb-2 h-auto">
                <div class="nsm-card-content">
                    <div class="d-flex">
                        <div>
                            <span class="content-title d-block mb-1"></span>
                            <span class="content-subtitle d-block"></span>
                        </div>
                        <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0" type="checkbox" checked="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
      </div>
    </div>
  </div>
</div>

<!--Send Message Modal-->
<div class="modal fade nsm-modal fade" id="modalSendMessage" tabindex="-1" aria-labelledby="modalSendMessageLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Send Message</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <?php if( $default_sms != ''){ ?>
                <form action="" id="frm-send-sms-message">
                <input type="hidden" name="cid" id="cid" value="">
                <div class="modal-body">
                    <div class="row">                                                                
                        <div class="col-md-12 mt-3">
                            <label for="">Customer</label>
                            <input type="text" name="customer_name" id="customer-name" readonly="" disabled="" class="form-control" required="">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="">Phone Number</label>
                            <input type="text" name="customer_phone" id="customer-phone" readonly="" disabled="" class="form-control" required="">
                        </div>
                        <!-- <div class="form-check grp-send-sms-notification">
                          <input class="form-check-input" name="send_sms_notification" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            Send SMS Notification
                          </label>
                        </div> -->
                        <div class="col-md-12 mt-3">
                            <label for="" style="display:block;margin-bottom: 11px;">
                                Message
                                <a style="float: right;" class="nsm-button primary btn-sm btn-sms-template">Use SMS Template</a>
                            </label>
                            <div class="sms-message-container">
                                <textarea class="form-control" name="sms_txt_message" id="sms-txt" style="height:150px;"></textarea>                                    
                            </div>                                            
                        </div>                             
                        <div class="help help-sm margin-bottom-sec" style="display:none;">
                            message characters: <span class="margin-right-sec char-counter">0</span>
                            left characters: <span class="margin-right-sec char-counter-left">0</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary btn-send-message">Send</button>
                </div>
                </form>
            <?php }else{ ?>   
                <div class="modal-body">                  
                    <div class="alert alert-danger" style="text-align:center;" role="alert">
                      You do not have any active SMS API account.
                      <a class="nsm-button primary w-50 ms-0 mt-5" style="display: block;margin:15px auto !important;" href="<?= base_url('tools/api_connectors'); ?>">Setup SMS API</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!--SMS Templates Modal-->
<div class="modal fade nsm-modal fade" id="modalSmsTemplate" tabindex="-1" aria-labelledby="modalSmsTemplateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">SMS Template</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="smsTemplate">
                    <?php foreach($smsTemplates as $st){ ?>                                   
                    <div class="accordion-item">                                            
                        <h2 class="accordion-header" id="heading<?= $st->id; ?>" style="background-color: #6a4a86;">
                          <a class="nsm nsm-button primary btn-sm btn-use-template" data-id="<?= $st->id; ?>" href="javascript:void(0);">Use Template</a>
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $st->id; ?>" aria-expanded="true" aria-controls="collapse<?= $st->id; ?>">
                            <?= $st->title; ?>
                          </button>                                              
                        </h2>                                            
                        <div id="collapse<?= $st->id; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#smsTemplate">
                          <div class="accordion-body"><?= $st->sms_body; ?></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>                                     
        </div>
    </div>
</div>

<!--Set customer mobile number Modal-->
<div class="modal fade nsm-modal fade" id="modalSetCustomerMobile" tabindex="-1" aria-labelledby="modalSetCustomerMobileLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Set Mobile Number</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form action="" id="frm-update-customer-mobile">
            <input type="hidden" name="cid" id="smn-cid" value="">
            <div class="modal-body">
                <div class="row">                                                                
                    <div class="col-md-12 mt-3">
                        <label for="">Customer</label>
                        <input type="text" name="customer_name" id="smn-customer-name" readonly="" disabled="" class="form-control" required="">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Phone Number</label>
                        <input type="text" name="customer_phone" id="sms-customer-number" class="form-control" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary btn-update-mobile">Save</button>
            </div>
            </form>                      
        </div>
    </div>
</div>
<script>
function smsCharCounter(){
    var chars_max   = 250;
    var chars_total = $("#sms-txt").val().length;
    var chars_left  = chars_max - chars_total;

    $('.char-counter').html(chars_total);
    $(".char-counter-left").html(chars_left);

    return chars_left;
}

$("#sms-txt").keydown(function(e){
    var chars_left = smsCharCounter();
    if( chars_left <= 0 ){
        if (e.keyCode != 46 && e.keyCode != 8 ) return false;
    }else{
        return true;
    }
});
<?php if( $default_sms != ''){ ?>
smsCharCounter();
<?php } ?>

$(document).on('click', '.send-sms-message', function(){
    var customer_name = $(this).attr('data-customer-name');
    var profid = $(this).attr('data-id');
    var customer_phone = $(this).attr('data-phone');

    if( customer_phone != '' ){
        $('#cid').val(profid);
        $('#sms-txt').val("");
        $('#customer-name').val(customer_name);
        $('#customer-phone').val(customer_phone);
        $('#modalSendMessage').modal('show');
        $('#modalMessagesSent').modal('hide');
    }else{
        var msg = 'Phone number is needed to send sms. <br /><a href="javascript:void(0);" data-customer-name="'+customer_name+'" data-id="'+profid+'" class="nsm-button primary btn-set-customer-mobile">Set Mobile Number</a>'
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            html: msg,
            showConfirmButton: false
        });
    }        
});

$(document).on('click', ".btn-use-template", function(){
    var stid = $(this).attr('data-id');         
    var url = base_url + 'sms/_use_sms_template';
    $.ajax({
        type: 'POST',
        url: url,                
        data: {stid:stid},
        success: function(o) {
            $('.sms-message-container').html(o);
            $('#modalSendMessage').modal('show');
            $('#modalSmsTemplate').modal('hide');
        },
    });
});

$(document).on('click', '.btn-sms-template', function(){
    $('#modalSendMessage').modal('hide');
    $('#modalSmsTemplate').modal('show');
});

$(document).on('click', '.btn-set-customer-mobile', function(){
    var customer_name = $(this).attr('data-customer-name');
    var cid = $(this).attr('data-id');

    swal.close()

    $('#smn-customer-name').val(customer_name);
    $('#smn-cid').val(cid);
    $('#modalSendMessage').modal('hide');
    $('#modalSetCustomerMobile').modal('show');
});

$(document).on('submit', '#frm-send-sms-message', function(e){
    e.preventDefault();
    var url = base_url + 'messages/_company_send';
    $(".btn-send-message").html('<span class="bx bx-loader bx-spin"></span>');

    var formData = new FormData($("#frm-send-sms-message")[0]);   

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData:false,
         data: formData,
         success: function(o)
         {          
            if( o.is_success == 1 ){   
                $("#modalSendMessage").modal("hide");         
                Swal.fire({
                    title: 'Save Successful!',
                    text: "Your message was successfully sent to customer.",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    //if (result.value) {
                    location.reload();
                    //}
                });
            }else{
              Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: o.msg
              });
            } 

            $(".btn-send-message").html('Save');
         }
      });
    }, 800);
});
</script>