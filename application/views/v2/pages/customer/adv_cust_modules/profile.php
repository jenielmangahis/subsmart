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
/*Call*/
.dialpad-container .row {
  margin: 0 auto;
  width: auto;
  clear: both;
  text-align: center;
  font-family: 'Exo';  
}

.digit, .dig {
  float: left;
  padding: 10px 39px;
  width: 30px;
  font-size: 2rem;
  cursor: pointer;
}

.sub {
  font-size: 0.8rem;
  color: grey;
}

.dialpad-container{
  /*background-color: white;*/
  width: auto;
  padding: 0px;
  margin: 0 auto;
  height: 420px;
  text-align: center;
  /*box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);*/  

}

#output {
  font-family: "Exo";
  font-size: 2rem;
  height: 60px;
  font-weight: bold;
  color: #1976d2;
}

#call {
    display: inline-block;
    background-color: #66bb6a;
    padding: 10px 20px;
    margin: 10px;
    color: white;
    border-radius: 4px;
    float: left;
    cursor: pointer;
}

.botrow {
  margin: 0 auto;
  width: 280px;
  clear: both;
  text-align: center;
  font-family: 'Exo';
}

.digit:active,
.dig:active {
  background-color: #e6e6e6;
}

#call:hover {
  background-color: #81c784;
}

.dig {
  float: left;
  padding: 10px 20px;
  margin: 10px;
  width: 30px;
  cursor: pointer;
}
div#controls div#call-controls div#volume-indicators {
display: none;
padding: 10px;
margin-top: 20px;
width: 500px;
text-align: left;
}

div#controls div#call-controls div#volume-indicators > div {
  display: block;
  height: 20px;
  width: 0;
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
                                <span class="content-subtitle d-block"><?= substr($profile_info->phone_h, 0, 13); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <a role="button" class="nsm-button btn-sm m-0 me-2" onclick="window.open('<?= base_url('/customer/preview/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        View Profile
                    </a>
                    <a role="button" class="nsm-button btn-sm m-0 me-2"  onclick="window.open('<?= base_url('/customer/add_advance/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
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
                    <a role="button" class="nsm-button primary w-100 ms-0 mt-5 send-sms-message" href="javascript:void(0);" data-customer-name="<?= ucwords($profile_info->first_name) . ' ' . ucwords($profile_info->last_name) ?>" data-id="<?= $profile_info->prof_id; ?>" data-phone="<?= $profile_info->phone_m; ?>" style="width:100px !important;">
                        Send SMS
                    </a>
                    <?php $phone = cleanMobileNumber($profile_info->phone_m); ?>
                    <a role="button" class="nsm-button primary w-100 ms-0 mt-5 call-customer" href="javascript:void(0);" data-id="<?= $profile_info->prof_id; ?>" data-phone="<?= $phone; ?>" style="width:100px !important;">
                        Call
                    </a>
                </div>
                <div class="col-12 mb-2" id="customerquickactions">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="#" class="nsm-link" id="managequickactions">Manage Quick Actions</a>
                    </div>

                    <!-- <div class="nsm-empty empty-message">
                        Click Manage Quick Actions to view available shortcuts for this customer.
                    </div> -->

                    <button class="nsm-button light w-100 ms-0 mt-3" onclick="window.open('<?= base_url('/tickets/addTicketCust/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        <i class='bx bx-fw'></i> Submit Service Ticket
                    </button>

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
<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Activities</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="CUSTOMER_LOG_TABLE" class="table table-hover w-100">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 0%;">Date</th>
                                    <th>Logs</th>
                                    <a href="#"></a>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($log_info as $log_infos) {
                                ?>
                                <tr>
                                    <td><span class="badge bg-secondary"><?php echo $log_infos->date; ?></span></td>
                                    <td><?php echo $log_infos->logs; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #CUSTOMER_LOG_TABLE_length, 
    #CUSTOMER_LOG_TABLE_filter, 
    #CUSTOMER_LOG_TABLE_info {
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
        padding: 5px;
    }
    table.dataTable.no-footer {
        border: 1px solid lightgray;
    }
    table.dataTable, table.dataTable th, table.dataTable td {
        box-sizing: border-box;
    }
</style>

<script type="text/javascript">
    $(function() {
       var CUSTOMER_LOG_TABLE = $("#CUSTOMER_LOG_TABLE").DataTable({
            "ordering": false,
            pageLength : 5,
            language: {
                processing: '<span>Fetching data...</span>'
            },
        }); 
    });
</script>

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
<div class="modal fade nsm-modal fade" id="modalSendMessageOld" tabindex="-1" aria-labelledby="modalSendMessageLabel" aria-hidden="true">
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

<!--Call Dialpad Modal-->
<div class="modal fade nsm-modal fade" id="modalCallDialPad" tabindex="-1" aria-labelledby="modalCallDialPadLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Make Call</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <?php if( $enable_ringcentral_call ){ ?>
                    <video id="remoteVideo" hidden="hidden"></video>
                    <video id="localVideo" hidden="hidden" muted="muted"></video>
                <?php } ?>
                <div class="container dialpad-container" id="call-controls" style="display:none;">
                  <div id="log" style="display:none;"></div>
                  <div id="output"></div>
                  <input type="hidden" name="customer_phone" id="phone-number" value="" />
                  <input type="hidden" name="cid" id="cid" value="" />
                  <div class="row">
                    <div class="digit" id="one">1</div>
                    <div class="digit" id="two">2
                      <div class="sub">ABC</div>
                    </div>
                    <div class="digit" id="three">3
                      <div class="sub">DEF</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="digit" id="four">4
                      <div class="sub">GHI</div>
                    </div>
                    <div class="digit" id="five">5
                      <div class="sub">JKL</div>
                    </div>
                    <div class="digit">6
                      <div class="sub">MNO</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="digit">7
                      <div class="sub">PQRS</div>
                    </div>
                    <div class="digit">8
                      <div class="sub">TUV</div>
                    </div>
                    <div class="digit">9
                      <div class="sub">WXYZ</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="digit">*
                    </div>
                    <div class="digit">0
                    </div>
                    <div class="digit">#
                    </div>
                  </div>
                  <div class="botrow">  
                    <!-- <i class='bx bx-star dig'></i> -->
                    <i class='bx bx-arrow-back dig' style="width:auto;"></i>
                    <div id="call">
                        <a id="button-call" href="javascript:void(0);">
                            <i class='bx bx-phone-call' style="font-size:17px;"></i>
                        </a>
                        <a id="button-hangup" href="javascript:void(0);" style="display: none;">
                            <i class='bx bx-phone-incoming' style="font-size:17px;"></i>
                        </a>
                    </div>
                  </div>
                </div>

                <div id="volume-indicators" style="display:none;">
                    <label>Mic Volume</label>
                    <div id="input-volume"></div><br/><br/>
                    <label>Speaker Volume</label>
                    <div id="output-volume"></div>
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
        //$('#modalMessagesSent').modal('hide');
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

/*$(document).on('submit', '#frm-send-sms-message', function(e){
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
});*/
</script>

<!-- Call Script -->
<script type="text/javascript">
    $(document).ready(function() {
        var count = 0;
        $(".digit").on('click', function() {

          var num = ($(this).clone().children().remove().end().text());
          if (count < 11) {
            var phoneNumber = $('#phone-number').val();
            var newNumber   = phoneNumber + num.trim();

            $('#phone-number').val(newNumber);
            $('#output').html(newNumber);

            count++
          }
        });

        $('.bx-arrow-back').on('click', function() {
          var phoneNumber = $('#phone-number').val();
          var newNumber   = phoneNumber.slice(0, -1);

          $('#phone-number').val(newNumber);
          $('#output').html(newNumber);
          count--;
        });

        $(document).on('click', '.call-customer',function(){
            var cphone = $(this).attr('data-phone');
            var cid    = $(this).attr('data-id');

            count = cphone.length;

            $('#output').html(cphone);
            $('#phone-number').val(cphone);
            $('#cid').val(cid);
            $('#modalCallDialPad').modal('show');
        });

        $(".nsm-table").nsmPagination();
    });

    <?php if( $enable_ringcentral_call ){ ?>
    //RingCentral
    $(function() {
        var session = null;
        /** @type {RingCentral.SDK} */
        var sdk = null;
        /** @type {Platform} */
        var platform = null;
        /** @type {WebPhone} */
        var webPhone = null;

        var logLevel = 0;
        var username = null;
        var extension = null;
        var sipInfo = null;
        var $app = $('#app');

        var $loginTemplate = $('#template-login');
        var $callTemplate = $('#template-call');
        var $incomingTemplate = $('#template-incoming');
        var $acceptedTemplate = $('#modalCallDialPad');

        /**
         * @param {jQuery|HTMLElement} $tpl
         * @return {jQuery|HTMLElement}
         */
        function cloneTemplate($tpl) {
            return $($tpl.html());
        }

        function login(server, appKey, appSecret, login, ext, password, ll) {
            sdk = new RingCentral.SDK({
                appKey: appKey,
                appSecret: appSecret,
                server: server
            });

            platform = sdk.platform();

            // TODO: Improve later to support international phone number country codes better
            if (login) {
                login = (login.match(/^[\+1]/)) ? login : '1' + login;
                login = login.replace(/\W/g, '')
            }

            platform
                .login({
                    username: login,
                    extension: ext || null,
                    password: password
                })
                .then(function() {

                    logLevel = ll;
                    username = login;

                    localStorage.setItem('webPhoneServer', server || '');
                    localStorage.setItem('webPhoneAppKey', appKey || '');
                    localStorage.setItem('webPhoneAppSecret', appSecret || '');
                    localStorage.setItem('webPhoneLogin', login || '');
                    localStorage.setItem('webPhoneExtension', ext || '');
                    localStorage.setItem('webPhonePassword', password || '');
                    localStorage.setItem('webPhoneLogLevel', logLevel || 0);

                    return platform.get('/restapi/v1.0/account/~/extension/~');

                })
                .then(function(res) {

                    extension = res.json();

                    console.log('Extension info', extension);

                    return platform.post('/client-info/sip-provision', {
                        sipInfo: [{
                            transport: 'WSS'
                        }]
                    });

                })
                .then(function(res) { return res.json(); })
                .then(register)
                .then(function(res){
                    $('#call-controls').show();
                })
                .catch(function(e) {
                    console.error('Error in main promise chain');
                    console.error(e.stack || e);
                });

        }

        function register(data) {

            sipInfo = data.sipInfo[0] || data.sipInfo;

            webPhone = new RingCentral.WebPhone(data, {
                appKey: localStorage.getItem('webPhoneAppKey'),
                audioHelper: {
                    enabled: true
                },
                logLevel: parseInt(logLevel, 10)
            });
            webPhone.userAgent.audioHelper.loadAudio({
                incoming: '<?= base_url('assets/js/ringcentral/audio/incoming.ogg'); ?>',
                outgoing: '<?= base_url('assets/js/ringcentral/audio/outgoing.ogg'); ?>'
            })

            webPhone.userAgent.audioHelper.setVolume(.3);

            webPhone.userAgent.on('invite', onInvite);
            webPhone.userAgent.on('connecting', function() { console.log('UA connecting'); });
            webPhone.userAgent.on('connected', function() { console.log('UA Connected'); });
            webPhone.userAgent.on('disconnected', function() { console.log('UA Disconnected'); });
            webPhone.userAgent.on('registered', function() { console.log('UA Registered'); });
            webPhone.userAgent.on('unregistered', function() { console.log('UA Unregistered'); });
            webPhone.userAgent.on('registrationFailed', function() { console.log('UA RegistrationFailed', arguments); });
            webPhone.userAgent.on('message', function() { console.log('UA Message', arguments); });

            return webPhone;

        }

        function onInvite(session) {

            console.log('EVENT: Invite', session.request);
            console.log('To', session.request.to.displayName, session.request.to.friendlyName);
            console.log('From', session.request.from.displayName, session.request.from.friendlyName);

            var $modal = cloneTemplate($incomingTemplate).modal({backdrop: 'static'});

            var acceptOptions = {
                media: {
                    render: {
                        remote: document.getElementById('remoteVideo'),
                        local: document.getElementById('localVideo')
                    }
                }
            };

            $modal.find('.answer').on('click', function() {
                $modal.find('.before-answer').css('display', 'none');
                $modal.find('.answered').css('display', '');
                session.accept(acceptOptions)
                    .then(function() {
                        $modal.modal('hide');
                        onAccepted(session);
                    })
                    .catch(function(e) { console.error('Accept failed', e.stack || e); });
            });

            $modal.find('.decline').on('click', function() {
                session.reject();
            });

            $modal.find('.forward-form').on('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                session.forward($modal.find('input[name=forward]').val().trim(), acceptOptions)
                    .then(function() {
                        console.log('Forwarded');
                        $modal.modal('hide');
                    })
                    .catch(function(e) { console.error('Forward failed', e.stack || e); });
            });

            session.on('rejected', function() {
                $modal.modal('hide');
            });

        }

        function onAccepted(session) {

            console.log('EVENT: Accepted', session.request);
            console.log('To', session.request.to.displayName, session.request.to.friendlyName);
            console.log('From', session.request.from.displayName, session.request.from.friendlyName);

            var $modal = cloneTemplate($acceptedTemplate).modal();

            var $info = $modal.find('.info').eq(0);
            var $dtmf = $modal.find('input[name=dtmf]').eq(0);
            var $transfer = $modal.find('input[name=transfer]').eq(0);
            var $flip = $modal.find('input[name=flip]').eq(0);

            var interval = setInterval(function() {

                var time = session.startTime ? (Math.round((Date.now() - session.startTime) / 1000) + 's') : 'Ringing';

                $info.text(
                    'time: ' + time + '\n' +
                    'startTime: ' + JSON.stringify(session.startTime, null, 2) + '\n'
                );

            }, 1000);

            session.on('accepted', function() { console.log('Event: Accepted'); });
            session.on('progress', function() { console.log('Event: Progress'); });
            session.on('rejected', function() {
                console.log('Event: Rejected');
                close();
            });
            session.on('failed', function() {
                console.log('Event: Failed');
                close();
            });
            session.on('terminated', function() {
                console.log('Event: Terminated');
                close();
            });
            session.on('cancel', function() {
                console.log('Event: Cancel');
                close();
            });
            session.on('refer', function() {
                console.log('Event: Refer');
                close();
            });
            session.on('replaced', function(newSession) {
                console.log('Event: Replaced: old session', session, 'has been replaced with', newSession);
                close();
                onAccepted(newSession);
            });
            session.on('dtmf', function() { console.log('Event: DTMF'); });
            session.on('muted', function() { console.log('Event: Muted'); });
            session.on('unmuted', function() { console.log('Event: Unmuted'); });
            session.on('connecting', function() { console.log('Event: Connecting'); });
            session.on('bye', function() {
                console.log('Event: Bye');
                close();
            });

            session.mediaHandler.on('iceConnection', function() { console.log('Event: ICE: iceConnection'); });
            session.mediaHandler.on('iceConnectionChecking', function() { console.log('Event: ICE: iceConnectionChecking'); });
            session.mediaHandler.on('iceConnectionConnected', function() { console.log('Event: ICE: iceConnectionConnected'); });
            session.mediaHandler.on('iceConnectionCompleted', function() { console.log('Event: ICE: iceConnectionCompleted'); });
            session.mediaHandler.on('iceConnectionFailed', function() { console.log('Event: ICE: iceConnectionFailed'); });
            session.mediaHandler.on('iceConnectionDisconnected', function() { console.log('Event: ICE: iceConnectionDisconnected'); });
            session.mediaHandler.on('iceConnectionClosed', function() { console.log('Event: ICE: iceConnectionClosed'); });
            session.mediaHandler.on('iceGatheringComplete', function() { console.log('Event: ICE: iceGatheringComplete'); });
            session.mediaHandler.on('iceGathering', function() { console.log('Event: ICE: iceGathering'); });
            session.mediaHandler.on('iceCandidate', function() { console.log('Event: ICE: iceCandidate'); });
            session.mediaHandler.on('userMedia', function() { console.log('Event: ICE: userMedia'); });
            session.mediaHandler.on('userMediaRequest', function() { console.log('Event: ICE: userMediaRequest'); });
            session.mediaHandler.on('userMediaFailed', function() { console.log('Event: ICE: userMediaFailed'); });

        }

        function makeCall(number, homeCountryId) {

            homeCountryId = homeCountryId
                          || (extension && extension.regionalSettings && extension.regionalSettings.homeCountry && extension.regionalSettings.homeCountry.id)
                          || null;

            session = webPhone.userAgent.invite(number, {
                media: {
                    render: {
                        remote: document.getElementById('remoteVideo'),
                        local: document.getElementById('localVideo')
                    }
                },
                fromNumber: username,
                homeCountryId: homeCountryId
            });

            var url = base_url + 'calls/_log_start_call';
            var phoneNumber = document.getElementById('phone-number').value;
            var cid = document.getElementById('cid').value;
            var apiType = 'ringcentral';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {cid:cid,phoneNumber:phoneNumber,apiType:apiType},
                 success: function(o)
                 {          
                    
                 }
            });

            onAccepted(session);

        }

        function makeCallForm() {

            var $form = cloneTemplate($callTemplate);

            var $number = $form.find('input[name=number]').eq(0);
            var $homeCountry = $form.find('input[name=homeCountry]').eq(0);

            $number.val(localStorage.getItem('webPhoneLastNumber') || '');

            $form.on('submit', function(e) {

                e.preventDefault();
                e.stopPropagation();

                localStorage.setItem('webPhoneLastNumber', $number.val() || '');

                makeCall($number.val(), $homeCountry.val());

            });

            $app.empty().append($form);

        }

        function connectRingCentral() {

            var $form = cloneTemplate($loginTemplate);

            var $server = $form.find('input[name=server]').eq(0);            
            var $appKey = $form.find('input[name=appKey]').eq(0);            
            var $appSecret = $form.find('input[name=appSecret]').eq(0);            
            var $login = $form.find('input[name=login]').eq(0);            
            var $ext = $form.find('input[name=extension]').eq(0);            
            var $password = $form.find('input[name=password]').eq(0);
            
            var $logLevel = $form.find('input[name=logLevel]').eq(0);

            /*$server.val(localStorage.getItem('webPhoneServer') || RingCentral.SDK.server.sandbox);
            $appKey.val(localStorage.getItem('webPhoneAppKey') || '');
            $appSecret.val(localStorage.getItem('webPhoneAppSecret') || '');
            $login.val(localStorage.getItem('webPhoneLogin') || '');
            $ext.val(localStorage.getItem('webPhoneExtension') || '');
            $password.val(localStorage.getItem('webPhonePassword') || '');
            $logLevel.val(localStorage.getItem('webPhoneLogLevel') || logLevel);*/            
            login($server.val(), $appKey.val(), $appSecret.val(), $login.val(), $ext.val(), $password.val(), $logLevel.val());

        }

        $(document).on('click', '.call-customer', function(){
            connectRingCentral();
        });

        $(document).on('click', '#button-call', function(){
            var phone_number = $('#phone-number').val();
            var countryid    = 1;   

            $('#button-call').hide();
            $('#button-hangup').show();
            makeCall(phone_number, countryid);
        });

        $(document).on('click', '#button-hangup', function(){
            session.terminate();            
            $('#button-call').show();
            $('#button-hangup').hide();  

            var url = base_url + 'calls/_log_end_call';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {},
                 success: function(o)
                 {          
                    
                 }
            });          
        });
    });    
    <?php } ?>

    <?php if( $enable_twilio_call ){ ?>
    //Twilio
    //var speakerDevices = document.getElementById('speaker-devices');
    $(function(){
        $.getJSON('https://bubbles-shark-3469.twil.io/capability-token')
          //Paste URL HERE
        .done(function (data) {
          log('Got a token.');
          console.log('Token: ' + data.token);

          // Setup Twilio.Device
          Twilio.Device.setup(data.token);

          Twilio.Device.ready(function (device) {
            log('Twilio.Device Ready!');
            document.getElementById('call-controls').style.display = 'block';
          });

          Twilio.Device.error(function (error) {
            log('Twilio.Device Error: ' + error.message);
          });

          Twilio.Device.connect(function (conn) {            
            var url = base_url + 'calls/_log_start_call';
            var phoneNumber = document.getElementById('phone-number').value;
            var cid = document.getElementById('cid').value;
            var apiType = 'twilio';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {cid:cid,phoneNumber:phoneNumber,apiType:apiType},
                 success: function(o)
                 {          
                    
                 }
            });

            log('Successfully established call!');
            /*document.getElementById('button-call').style.display = 'none';
            document.getElementById('button-hangup').style.display = 'inline';*/
            volumeIndicators.style.display = 'block';
            bindVolumeIndicators(conn);
          });

          Twilio.Device.disconnect(function (conn) {
            var url = base_url + 'calls/_log_end_call';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {},
                 success: function(o)
                 {          
                    
                 }
            });

            log('Call ended.');
            document.getElementById('button-call').style.display = 'inline';
            document.getElementById('button-hangup').style.display = 'none';
            volumeIndicators.style.display = 'none';
          });

          Twilio.Device.incoming(function (conn) {
            log('Incoming connection from ' + conn.parameters.From);
            var archEnemyPhoneNumber = '+12099517118';

            if (conn.parameters.From === archEnemyPhoneNumber) {
              conn.reject();
              log('It\'s your nemesis. Rejected call.');
            } else {
              // accept the incoming connection and start two-way audio
              conn.accept();
            }
          });

          //setClientNameUI(data.identity);

          Twilio.Device.audio.on('deviceChange', updateAllDevices);

          // Show audio selection UI if it is supported by the browser.
          if (Twilio.Device.audio.isSelectionSupported) {
            document.getElementById('output-selection').style.display = 'block';
          }
        })
        .fail(function () {
          log('Could not get a token from server!');
        });

        function bindVolumeIndicators(connection) {
          connection.volume(function(inputVolume, outputVolume) {
          var inputColor = 'red';
          if (inputVolume < .50) {
            inputColor = 'green';
          } else if (inputVolume < .75) {
            inputColor = 'yellow';
          }

          inputVolumeBar.style.width = Math.floor(inputVolume * 300) + 'px';
          inputVolumeBar.style.background = inputColor;

          var outputColor = 'red';
          if (outputVolume < .50) {
            outputColor = 'green';
          } else if (outputVolume < .75) {
            outputColor = 'yellow';
          }

          outputVolumeBar.style.width = Math.floor(outputVolume * 300) + 'px';
          outputVolumeBar.style.background = outputColor;
        });
        }

        function updateAllDevices() {
            //updateDevices(speakerDevices, Twilio.Device.audio.speakerDevices.get());
            //updateDevices(ringtoneDevices, Twilio.Device.audio.ringtoneDevices.get());
        }

        // Bind button to make call
        document.getElementById('button-call').onclick = function () {
            // get the phone number to connect the call to
            var params = {
              To: document.getElementById('phone-number').value
            };

            $('#button-call').hide();
            $('#button-hangup').show();
            console.log('Calling ' + params.To + '...');
            Twilio.Device.connect(params);
        };

        // Bind button to hangup call
        document.getElementById('button-hangup').onclick = function () {
            log('Hanging up...');
            Twilio.Device.disconnectAll();
        };
    });   
    // Update the available ringtone and speaker devices
    function updateDevices(selectEl, selectedDevices) {
      selectEl.innerHTML = '';
      Twilio.Device.audio.availableOutputDevices.forEach(function(device, id) {
        var isActive = (selectedDevices.size === 0 && id === 'default');
        selectedDevices.forEach(function(device) {
          if (device.deviceId === id) { isActive = true; }
        });

        var option = document.createElement('option');
        option.label = device.label;
        option.setAttribute('data-id', id);
        if (isActive) {
          option.setAttribute('selected', 'selected');
        }
        selectEl.appendChild(option);
      });
    }

    // Activity log
    function log(message) {
      var logDiv = document.getElementById('log');
      logDiv.innerHTML += '<p>&gt;&nbsp;' + message + '</p>';
      logDiv.scrollTop = logDiv.scrollHeight;
    }

    // Set the client name in the UI
    function setClientNameUI(clientName) {
      var div = document.getElementById('client-name');
      div.innerHTML = 'Your client name: <strong>' + clientName +
        '</strong>';
    } 
    <?php } ?>
</script>