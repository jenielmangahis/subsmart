<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            List all SMS.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('sms') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search SMS" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                        </form>
                    </div>
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-send-sms">
                                <i class='bx bx-fw bx-message-square-add'></i> Send SMS
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="ToNumber" style="width:10%;">Sender</td>
                            <td data-name="ToNumber" style="width:10%;">To</td>
                            <td data-name="TextMessage">Text Message</td>
                            <td data-name="DateSent" style="width:10%;">Date Sent</td>                            
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($companySms)) : ?>
                            <?php foreach ($companySms as $sms) : ?>
                                <tr>
                                    <td><?= $sms->sender_name; ?></td>
                                    <td><?= $sms->to_number; ?></td>                                    
                                    <td><?= $sms->txt_message; ?></td>
                                    <td><?= date("m/d/Y g:i A"); ?></td>
                                    <td></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item resend-sms" data-id="<?= $sms->id; ?>" href="javascript:void(0);">Resend</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-sms" href="javascript:void(0);" data-id="<?= $sms->id; ?>">Delete</a>
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
            </div>

            <!--Send SMS Modal-->
            <div class="modal fade nsm-modal fade" id="modalSendSms" tabindex="-1" aria-labelledby="modalSendSmsLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Send SMS</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-send-sms">
                        <div class="modal-body">
                            <div class="row">                                                                
                                <div class="col-md-12 mt-3">
                                    <label for="">To Number</label>
                                    <input type="text" name="sms_to_number" id="to-number" class="form-control" required="">
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
                            <button type="submit" class="nsm-button primary btn-send-sms">Send</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

            <!--Resend SMS Modal-->
            <div class="modal fade nsm-modal fade" id="modalResendSms" tabindex="-1" aria-labelledby="modalResendSmsLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Re-send SMS</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form action="" id="frm-resend-sms">
                        <div class="modal-body resend-sms-container"></div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary btn-resend-sms">Send</button>
                        </div>
                        </form>                      
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#to-number").inputmask({"mask": "(999) 999-9999"});
    });

    $(document).on('click', '.btn-send-sms', function(){
        $('#modalSendSms').modal('show');
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

    $(document).on('submit', '#frm-send-sms', function(e){
        e.preventDefault();
        var url = base_url + 'sms/_company_send';
        $(".btn-send-sms").html('<span class="bx bx-loader bx-spin"></span>');

        var formData = new FormData($("#frm-send-sms")[0]);   

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
                    $("#modalSendSms").modal("hide");         
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

                $(".btn-send-sms").html('Save');
             }
          });
        }, 800);
    });

    $(document).on("click", ".delete-sms", function(e) {
        var smsid = $(this).attr("data-id");        
        var url = base_url + 'sms/_company_delete';

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
        var url = base_url + 'sms/_company_resend_form';

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
        var url = base_url + 'sms/_company_send';
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

</script>
<?php include viewPath('v2/includes/footer'); ?>