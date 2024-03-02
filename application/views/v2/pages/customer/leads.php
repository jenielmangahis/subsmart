<?php include viewPath('v2/includes/header'); ?>
<style>
.row-lead-status{
    font-size: 14px;
}
.swal2-html-container{
    overflow:hidden !important;
}
.swal2-html-container p{
    padding: 5px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and potential customers 
                            is to have one powerful platform that can provide an immediate response to your customer needs. 
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your 
                            customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('customer/leads') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="search" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Leads" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
                                <i class='bx bx-fw bx-chart'></i> Add New Lead
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Address">Address</td>
                            <td data-name="SalesRep">Sales Representative</td>                            
                            <td data-name="LeadType">Lead Type</td>
                            <td data-name="Status">Status</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($leads)) :
                        ?>
                            <?php
                            foreach ($leads as $lead) :
                                switch($lead->status):
                                    case 'New':
                                        $badge = 'primary';
                                        break;
                                    case 'Contacted':
                                        $badge = 'secondary';
                                        break;
                                    case 'Follow Up':
                                        $badge = 'secondary';
                                        break;
                                    case 'Converted':
                                        $badge = 'success';
                                        break;                                   
                                    case 'Closed':
                                        $badge = 'error';
                                        break;
                                    default:
                                        $badge = '';
                                        break;
                                endswitch;
                            ?>
                                <tr>
                                    <td>
                                        <?php 
                                            $n = ucwords($lead->firstname[0]) . ucwords($lead->lastname[0]);
                                        ?>
                                        <div class="table-row-icon">
                                            <div class='nsm-profile'><span><?= $n; ?></span></div>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary">
                                        <?= $lead->firstname.' '.$lead->lastname; ?><br />
                                        <small class="text-muted"><i class='bx bx-envelope'></i> <?=  $lead->email_add; ?></small>
                                    </td>
                                    <td>
                                        <i class='bx bx-map-pin' ></i> <?= $lead->address; ?><br />
                                        <small class="text-muted"><?= $lead->city . ', ' . $lead->state . ' ' . $lead->zip; ?><small>
                                    </td>
                                    <td><?= $lead->FName ? $lead->FName . ' ' . $lead->LName : 'Not Specified';  ?></td>
                                    <td><?= $lead->lead_type ? $lead->lead_type : 'Not Specified'; ?></td>
                                    <td><span class="nsm-badge row-lead-status <?= $badge ?>"><?= $lead->status; ?></span></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo url('/customer/add_lead/'.$lead->leads_id); ?>">Edit</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item btn-convert-to-customer" data-id="<?= $lead->leads_id; ?>" href="javascript:void(0);">Convert to Customer</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item lead-send-sms-message" data-customer-name="<?= ucwords($lead->firstname) . ' ' . ucwords($lead->lastname) ?>" data-id="<?= $lead->leads_id; ?>" data-phone="<?= $lead->phone_cell; ?>" href="javascript:void(0);">Send SMS</a>
                                                </li>
                                                <li>
                                                    <!-- <a class="dropdown-item" href="mailto:<?= $lead->email_add; ?>">Send Email</a> -->
                                                    <a class="dropdown-item lead-send-email" href="javascript:void(0);" data-id="<?= $lead->leads_id; ?>" data-email="<?= $lead->email_add; ?>">Send Email</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $lead->leads_id; ?>">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td colspan="11">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="send_email_modal" tabindex="-1" aria-labelledby="send_email_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="frm-send-email">
                <input type="hidden" name="cid" id="customer-send-email-eid" />
                <div class="modal-header">
                    <span class="modal-title content-title">Send Email</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Lead Email" name="lead_email" id="lead-email" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Subject" name="lead_email_suject" id="email-subject" class="nsm-field form-control mb-2" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <textarea class="nsm-field form-control mb-2" style="height:250px;" name="lead_email_message" id="email-message" placeholder="Message" required></textarea>                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn_send_email">Send</button>
                </div>
                </form>                
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="leadModalSendMessage" tabindex="-1" aria-labelledby="leadModalSendMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="new_feed_modal_label">Send Message</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <?php if( $default_sms == ''){ ?>
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
                                </label>
                                <div class="sms-message-container">
                                    <textarea class="form-control" name="sms_txt_message" id="sms-txt" style="height:150px;"></textarea>                                    
                                </div>                                            
                            </div>                             
                            <div class="help help-sm margin-bottom-sec" style="">
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
    

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination({
            itemsPerPage: 10,
        });

        $("#search_field").on("input", debounce(function() {
            let _form = $(this).closest("form");

            _form.submit();
        }, 1500));

        $('.btn-convert-to-customer').on('click', function(){
            var lead_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Confirmation',
                text: "Convert the selected lead to customer?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: base_url + "customer/_convert_lead_to_customer",
                        data: {
                            lead_id: lead_id
                        },
                        dataType:'json',
                        success: function(r) {
                            if(r.is_success == 1){
                                Swal.fire({
                                    text: "Lead was successfully converted to customer",
                                    icon: 'success',
                                    showCancelButton: true,
                                    cancelButtonText: 'Reload List',
                                    confirmButtonText: "Edit New Customer",
                                }).then((swal_result) => {
                                    if(swal_result.value){
                                        location.href = base_url + 'customer/add_advance/'+r.prof_id;
                                    }else{
                                        location.reload();
                                    }
                                })
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: r.msg
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on('click', '.lead-send-sms-message', function(){
            var customer_name = $(this).attr('data-customer-name');
            var lid = $(this).attr('data-id');
            var customer_phone = $(this).attr('data-phone');

            if( customer_phone != '' ){
                $('#cid').val(lid);
                $('#sms-txt').val("");
                $('#customer-name').val(customer_name);
                $('#customer-phone').val(customer_phone);
                $('#leadModalSendMessage').modal('show');                
            }else{
                var msg = '<p>Phone number is needed to send sms.</p> <br /><a href="javascript:void(0);" data-customer-name="'+customer_name+'" data-id="'+lid+'" class="nsm-button primary btn-set-customer-mobile">Set Mobile Number</a>'
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: msg,
                    showConfirmButton: false
                });
            }           
        });

        $(document).on('click', '.btn-set-customer-mobile', function(){
            var lid = $(this).attr('data-id');
            location.href = base_url + 'customer/add_lead/' + lid;
        });

        $(document).on('click', '.lead-send-email', function(){
            var lead_email = $(this).attr('data-email');
            var lead_eid   = $(this).attr('data-id');
            
            $('#send_email_modal').modal('show');
            $('#lead-email').val(lead_email);
            $('#lead-send-email-eid').val(lead_eid);
            $('#email-message').val('');
            $('#email-subject').val('');
        });

        $(document).on('submit', '#frm-send-email', function(e){
            e.preventDefault();
            
            var url = base_url + 'leads/_lead_send_email';
            $.ajax({
                type: "POST",
                url: url,   
                dataType: "json",          
                data: $('#frm-send-email').serialize(),
                beforeSend: function(data) {
                    $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(o)
                {          
                    $("#btn_send_email").html('Send');
                    if(o.is_success  == 1){
                        Swal.fire({
                            html: 'Email sent',                        
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            
                        });
                        $("#send_email_modal").modal('hide');                
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: o.msg
                        });
                    }                
                },
                complete : function(){
                                
                },
                error: function(e) {
                    console.log(e);
                }
            });

            $("#btn_send_email").html('<span class="bx bx-loader bx-spin"></span>');
        });

        $(document).on('submit', '#frm-send-sms-message', function(e){
            e.preventDefault();
            var url = base_url + 'messages/_company_lead_send';
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
                        $("#leadModalSendMessage").modal("hide");         
                        Swal.fire({                            
                            text: "Your sms message was successfully sent.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                            
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

        $(document).on("click", ".delete-item", function() {
            let lead_id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Lead',
                text: "Are you sure you want to delete this lead?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>customer/remove_lead",
                        data: {
                            lead_id: lead_id
                        },
                        success: function(result) {
                            if(result === "Done"){
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>