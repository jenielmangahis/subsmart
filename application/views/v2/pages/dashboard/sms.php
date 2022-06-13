<?php include viewPath('v2/includes/header'); ?>
<style>
.grp-send-sms-notification{
    margin-left: 12px;
    margin-top: 5px;
}    
.btn-set-customer-mobile{
    display: block;
    margin-top: 13px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Send sms to customer.
                        </div>
                    </div>
                </div>
                <?php if( $is_with_sms_api ){ ?>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <form action="<?php echo base_url('sms') ?>" method="GET">
                                <div class="nsm-field-group search">
                                    <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Customer" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                                </div>
                                <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                            </form>
                        </div>
                    </div>
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Name">Name</td>
                                <td data-name="Phone" style="width:10%;">Phone</td>
                                <td data-name="Date" style="width:10%;">Date Last Message</td>            
                                <td data-name="Manage" style="width:5%;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($customers)) : ?>
                                <?php foreach ($customers as $customer) : ?>
                                    <tr>
                                        <td>
                                            <div class="nsm-profile">
                                                <?php if ($customer->customer_type === 'Business'): ?>
                                                    <span>
                                                    <?php 
                                                        $parts = explode(' ', strtoupper(trim($customer->business_name)));
                                                        echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                                    ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span><?= ucwords($customer->first_name[0]) . ucwords($customer->last_name[0]); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="nsm-text-primary">
                                            <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('/customer/module/' . $customer->prof_id); ?>'">
                                                <?php if ($customer->customer_type === 'Business'): ?>
                                                    <?= $customer->business_name ?>
                                                <?php else: ?>
                                                    <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                <?php endif; ?>
                                            </label>
                                            <label class="nsm-link default content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                        </td>                              
                                        <td><?php echo $customer->phone_m; ?></td>
                                        <td>
                                            <?php 
                                                if( $customer->phone_m != '' ){
                                                    if( $default_sms == 'ring_central' ){
                                                        $msg = ringCentralLastMessage($ringCentralAccount, $customer->prof_id);
                                                        if( !empty($msg) ){
                                                            foreach($msg as $m){
                                                                echo timeLapsedString($m['date']);
                                                            }
                                                        }else{
                                                            echo "---";  
                                                        }                                                        

                                                    }else{
                                                        echo "---";    
                                                    }
                                                }else{
                                                    echo "---";
                                                }                                                
                                            ?>        
                                        </td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item send-message" data-customer-name="<?= ucwords($customer->first_name) . ' ' . ucwords($customer->last_name) ?>" data-id="<?= $customer->prof_id; ?>" data-phone="<?= $customer->phone_m; ?>" href="javascript:void(0);">Send SMS</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item sent-messages" data-cid="<?= $customer->prof_id; ?>" href="javascript:void(0);">View Messages</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <nav class="nsm-table-pagination">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <!--Send Message Modal-->
                    <div class="modal fade nsm-modal fade" id="modalSendMessage" tabindex="-1" aria-labelledby="modalSendMessageLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title content-title" id="new_feed_modal_label">Send Message</span>
                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                </div>
                                <form action="" id="frm-send-message">
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
                                            <label for="">Message</label>
                                            <textarea class="form-control" name="sms_txt_message" id="sms-txt" style="height:150px;"></textarea>                                    
                                        </div>                                
                                        <div class="help help-sm margin-bottom-sec">
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

                    <!--Messages Sent Modal-->
                    <div class="modal fade nsm-modal fade" id="modalMessagesSent" tabindex="-1" aria-labelledby="modalMessagesSentLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title content-title" id="new_feed_modal_label">Messages Sent</span>
                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                </div>
                                <div class="modal-body sent-messages-container"></div>                                     
                            </div>
                        </div>
                    </div>

                <?php }else{ ?>
                    <div class="alert alert-danger" role="alert">
                      You haven't set your preferred SMS api in our api connectors. Please specify which sms api will you use.                       
                      <br />
                      <a class="nsm-button primary" style="display: inline-block;margin-top: 20px;" href="<?= base_url('tools/api_connectors'); ?>">Set SMS API</a>
                    </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php if( $is_with_sms_api ){ ?>
        $(document).ready(function() {
            $(".nsm-table").nsmPagination();
            $("#to-number").inputmask({"mask": "(999) 999-9999"});
            $("#sms-customer-number").inputmask({"mask": "(999) 999-9999"});
        });

        $(document).on('click', '.sent-messages', function(){
            var cid = $(this).attr('data-cid');

            $('#modalMessagesSent').modal('show');

            var url = base_url + 'messages/_load_customer_sent_messages';
            $(".sent-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

            setTimeout(function () {
              $.ajax({
                 type: "POST",
                 url: url,
                 data: {cid:cid},
                 success: function(o)
                 {          
                    $(".sent-messages-container").html(o);
                 }
              });
            }, 800);

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

        $(document).on('click', '.send-message', function(){
            var customer_name = $(this).attr('data-customer-name');
            var profid = $(this).attr('data-id');
            var customer_phone = $(this).attr('data-phone');

            if( customer_phone != '' ){
                $('#cid').val(profid);
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

        smsCharCounter();

        $(document).on('submit', '#frm-send-message', function(e){
            e.preventDefault();
            var url = base_url + 'messages/_company_send';
            $(".btn-send-message").html('<span class="bx bx-loader bx-spin"></span>');

            var formData = new FormData($("#frm-send-message")[0]);   

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

        $(document).on('submit', '#frm-update-customer-mobile', function(e){
            e.preventDefault();
            var url = base_url + 'customer/_update_customer_mobile_number';
            $(".btn-update-mobile").html('<span class="bx bx-loader bx-spin"></span>');

            var formData = new FormData($("#frm-update-customer-mobile")[0]);   

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
                        $("#modalSetCustomerMobile").modal("hide");         
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Your customer mobile was successfully updated.",
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

                    $(".btn-update-mobile").html('Save');
                 }
              });
            }, 800);
        });

        $(document).on("click", ".delete-sms", function(e) {
            var smsid = $(this).attr("data-id");        
            var url = base_url + 'messages/_company_delete';

            Swal.fire({
                title: 'Delete SMS',
                html: "Are you sure you want to delete selected SMS?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        data: {smsid:smsid},
                        success: function(o) {
                            if( o.is_success == 1 ){   
                                Swal.fire({
                                    title: 'Delete Successful!',
                                    text: "SMS Deleted Successfully!",
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
                        },
                    });
                }
            });
        });

        $(document).on("click", ".resend-sms", function(e) {
            var smsid = $(this).attr("data-id");        
            var url = base_url + 'messages/_company_resend_form';

            $('#modalResendSms').modal('show');
            $(".resend-sms-container").html('<span class="bx bx-loader bx-spin"></span>');

            setTimeout(function () {
              $.ajax({
                 type: "POST",
                 url: url,
                 data: {smsid:smsid},
                 success: function(o)
                 {          
                    $(".resend-sms-container").html(o);
                 }
              });
            }, 800);
        });

        $(document).on('submit', '#frm-resend-sms', function(e){
            e.preventDefault();
            var url = base_url + 'messages/_company_send';
            $(".btn-resend-sms").html('<span class="bx bx-loader bx-spin"></span>');

            var formData = new FormData($("#frm-resend-sms")[0]);   

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
                        $("#modalResendSms").modal("hide");         
                        Swal.fire({
                            title: 'SMS Sent!',
                            //text: "We will let you know if your sms was sent.",
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

                    $(".btn-resend-sms").html('Save');
                 }
              });
            }, 800);
        });
    <?php } ?>
</script>
<?php include viewPath('v2/includes/footer'); ?>