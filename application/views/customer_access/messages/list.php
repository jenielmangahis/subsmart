<?php include viewPath('v2/includes/header_customer'); ?>
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
                            Messages list.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('acs_access/messages') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search User" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                        </form>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name" style="width:80%;">Name</td>
                            <td data-name="Name" style="width:20%;">Mobile</td>
                            <td data-name="Date">Date Last Message</td>                            
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $messages ){ ?>
                            <?php foreach($messages as $msg){ ?>
                                <tr>
                                    <td>
                                        <div class="nsm-profile">
                                            <span><?= ucwords($msg->FName[0]) . ucwords($msg->LName[0]); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <label class="nsm-link default d-block fw-bold">
                                            <?= ucwords($msg->FName) . ' ' . ucwords($msg->LName); ?>
                                        </label>
                                        <label class="nsm-link default content-subtitle fst-italic d-block">
                                            <?= $msg->user_email; ?>                                                
                                        </label>
                                    </td>
                                    <td><?= $msg->mobile; ?></td>
                                    <td>
                                        <?php 
                                            $lastMessage = getCustomerLastMessage($msg->user_id, $msg->prof_id);
                                            echo timeLapsedString($lastMessage->date_created);
                                        ?>        
                                    </td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item send-message" data-agent-name="<?= ucwords($msg->FName) . ' ' . ucwords($msg->LName) ?>" data-id="<?= $msg->user_id; ?>" data-phone="<?= $msg->mobile; ?>" href="javascript:void(0);">Send Message</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item sent-messages" data-aid="<?= $msg->user_id; ?>" href="javascript:void(0);">View Messages</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                       <?php }else{ ?>
                            <tr>
                                <td colspan="4">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
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
                            <input type="hidden" name="aid" id="aid" value="">
                            <div class="modal-body">
                                <div class="row">                                                                
                                    <div class="col-md-12 mt-3">
                                        <label for="">To</label>
                                        <input type="text" name="agent_name" id="agent-name" readonly="" disabled="" class="form-control" required="">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="agent_phone" id="agent-phone" readonly="" disabled="" class="form-control" required="">
                                    </div>
                                    <div class="form-check grp-send-sms-notification">
                                      <input class="form-check-input" name="send_sms_notification" type="checkbox" value="" id="flexCheckDefault">
                                      <label class="form-check-label" for="flexCheckDefault">
                                        Send SMS Notification
                                      </label>
                                    </div>
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

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();

        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));
        }, 1000));
    });

    $(document).on('click', '.send-message', function(){
        var agent_name = $(this).attr('data-agent-name');
        var aid = $(this).attr('data-id');
        var agent_phone = $(this).attr('data-phone');

        $('#aid').val(aid);
        $('#agent-name').val(agent_name);
        $('#agent-phone').val(agent_phone);
        $('#modalSendMessage').modal('show');
        $('#modalMessagesSent').modal('hide');
    });

    function smsCharCounter(){
        var chars_max   = 250;
        var chars_total = $("#sms-txt").val().length;
        var chars_left  = chars_max - chars_total;

        $('.char-counter').html(chars_total);
        $(".char-counter-left").html(chars_left);

        return chars_left;
    }

    smsCharCounter();

    $("#sms-txt").keydown(function(e){
        var chars_left = smsCharCounter();
        if( chars_left <= 0 ){
            if (e.keyCode != 46 && e.keyCode != 8 ) return false;
        }else{
            return true;
        }
    });

    $(document).on('submit', '#frm-send-message', function(e){
        e.preventDefault();
        var url = base_url + 'acs_access/_send_message_reply';
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
                        text: "Your message was successfully sent.",
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

    $(document).on('click', '.sent-messages', function(){
        var aid = $(this).attr('data-aid');

        $('#modalMessagesSent').modal('show');

        var url = base_url + 'acs_access/_load_sent_messages';
        $(".sent-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {aid:aid},
             success: function(o)
             {          
                $(".sent-messages-container").html(o);
             }
          });
        }, 800);

    });
</script>
<?php include viewPath('v2/includes/footer_customer'); ?>