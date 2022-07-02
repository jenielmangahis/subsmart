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
.chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}
.chat {
    list-style: none;
    margin: 0;
    padding: 0;
}
.pull-left {
    float: left!important;
}
.img-circle {
    border-radius: 50%;
}
.chat li.left .chat-body {
    margin-left: 60px;
}
.pull-right {
    float: right!important;
}
.text-muted {
    color: #777;
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
                            SMS list.
                        </div>
                    </div>
                </div>                
                <?php if( $sentMessages ){ ?>
                <div class="row">
                    <div class="col-12 col-md-12 grid-mb text-end">
                        <!-- <div class="nsm-page-buttons page-button-container">                
                            <a class="nsm-button primary send-message" href="javascript:void(0);" style="margin-left: 10px;"><i class="bx bx-fw bx-file"></i> Send SMS</a>
                        </div> -->
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name" style="width:20%;">Name</td>
                            <td data-name="Date">Date Sent</td>                            
                            <td data-name="Message" style="width:60%;">Message</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($sentMessages as $s){ ?>
                            <tr>
                                <td>
                                    <div class="nsm-profile">
                                        <?php if( $s['from'] == $companySms->from_number ){ ?>
                                            <span><?= 'NS'; ?></span>
                                        <?php }else{ ?>
                                            <span><?= ucwords($companySms->first_name[0]) . ucwords($companySms->last_name[0]); ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <label class="nsm-link default d-block fw-bold">
                                        <?php if( $s['from'] == $companySms->from_number ){ ?>
                                            nSmarTrac
                                        <?php }else{ ?>
                                            <?= $companySms->first_name . ' ' . $companySms->last_name; ?>
                                        <?php } ?>
                                    </label>
                                </td>
                                <td><?= timeLapsedString($s['date']); ?></td>
                                <td><p><?= $s['msg']; ?></p></td>
                            </tr>
                        <?php } ?>                       
                    </tbody>
                </table>
                <?php }else{ ?>
                <div class="nsm-empty alert alert-danger">
                    <span>No messages found.</span>
                </div>
                <?php } ?>

                <!--Send Message Modal-->
                <div class="modal fade nsm-modal fade" id="modalSendMessage" tabindex="-1" aria-labelledby="modalSendMessageLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Send Message</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <form action="" id="frm-send-message">
                            <div class="modal-body">
                                <div class="row"> 
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
        $('#modalSendMessage').modal('show');
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