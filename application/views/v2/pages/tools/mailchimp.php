<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<style>
.api-label{
    display: block;
    margin-bottom: 4px;
    font-weight: bold;
    font-size: 16px;
}
.f-green{
    color: #2ab363;
}
.date-filter{
    display: inline-block;
    margin-left: 16px;
    width: 12%;
}
.select2-hr{
    margin: 2px;
}
.select2-bx-icon{
    font-size: 16px;
    position: relative;
    top: 2px;
    margin-right: 8px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-5">
                        <h1>MailChimp</h1>
                        <p style="margin-top: 21px;">Get the Tools You Need to Grow Your Business and Automate Your Marketing. Mailchimp Makes It Easy to Find New Audiences and Reach People When It Matters Most.</p>
                    </div>
                    <div class="col-7" style="text-align:right;">
                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_mailchimp.png">
                    </div>
                </div>

                <?php if( $is_with_error == 1 ){ ?>
                    <div class="row">
                        <div class="col-4">
                            <div class="alert alert-danger">Cannot connect to MailChimp.</div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($companyMailChimp && $companyMailChimp->status == 1 && $companyMailChimp->mailchimp_account_info != ''){ ?>
                    <?php $account_info = unserialize($companyMailChimp->mailchimp_account_info); ?>
                    <div class="row mt-4">
                        <div class="col-2">
                            <span class="api-label">MailChimp Status</span>
                            <span class="api-label f-green">You are connected</span>
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="nsm-button primary btn-disconnect-mailchimp">Disconnect</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <span class="api-label">MailChimp Account</span>
                        <span class="api-label f-green"><?= $account_info['accountname']; ?></span>
                        <span class="api-label f-green"><?= $account_info['email']; ?></span>
                    </div>

                    <div class="row mt-5">                                     
                        <div class="col-12">
                            <a class="nsm-button primary" id="btn-mailchimp-export-customer" href="javascript:void(0);">
                                <i class='bx bx-export'></i> Add Customer Email to MailChimp List
                            </a>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12" id="attendance-list">
                            <table class="nsm-table mt-5">                        
                                <thead>
                                    <tr>
                                        <td class="table-icon" style="width:40%;">List</td>
                                        <td data-name="TotalRecords">Exported</td>
                                        <td data-name="TotalExported">Failed</td>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($mailchimpList->lists as $list){ ?>
                                        <tr>
                                            <td><b><?= $list->name; ?></b></td>
                                            <td>
                                                <?php if( $logs_summary ){ ?>
                                                    <?= $logs_summary[$list->id]['total_success']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if( $logs_summary ){ ?>
                                                    <?= $logs_summary[$list->id]['total_failed']; ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>                            
                        </div>                        
                    </div>
                    <a href="<?= base_url('tools/mailchimp_logs') ?>" class="nsm-button default">View Logs</a>
                <?php }else{ ?>
                    <div class="row mt-5">
                        <div class="col-8">                        
                            <label class="d-block mb-5">
                                Connect to <b>Mailchimp</b> to subscribe your customer to your List.
                            </label>                        
                            <button class="nsm-button primary" id="btn-connect-mailchimp">Connect to Mailchimp</button>                            
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="mailchimp-export-modal" tabindex="-1" aria-labelledby="mailchimp_export_label" aria-hidden="true" style="margin-top:10%;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form id="frm-export-mailchimp" method="POST">                        
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Export customer to your Mailchimp list</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">   
                                    <div class="row g-3">         
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Mailchimp List</label>
                                            <select class="form-control" name="mailchimp_list" id="mailchimp-list" required="">                                                
                                                <?php foreach($mailchimpList->lists as $list){ ?>
                                                    <option value="<?= $list->id; ?>"><?= $list->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Mailchimp Status</label>
                                            <select class="form-control" name="mailchimp_status" id="mailchimp-status" required="">                                                
                                                <?php foreach($mailchimpStatusOptions as $key => $value){ ?>
                                                    <option value="<?= $key; ?>"><?= $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Customer</label>
                                            <select name="mailchimp_customer[]" id="mailchimp-customer" class="form-control" required="" multiple="">
                                                <option value="">Select Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                        <div class="modal-footer">
                            <button name="btn_close_create_auto_sms" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary" id="btn-export-mailchimp">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mailchimp-export-modal').modal({backdrop: 'static', keyboard: false});
        
        $('#btn-connect-mailchimp').on('click', function(){
            location.href = base_url + 'tools/mailchimp_connect';
        });

        $('#btn-mailchimp-export-customer').on('click', function(){
            $('#mailchimp-export-modal').modal('show');
        });

        $('.btn-disconnect-mailchimp').on('click', function(){
            Swal.fire({            
                html: "Disconnect your MailChimp Account?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    var url = base_url + "tools/_disconnect_mailchimp_account";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        beforeSend: function(data) {
                            $('#loading_modal').modal('show');
                            $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Disconnecting MailChimp Account....');
                        },
                        success: function(data) {                                                
                            setTimeout(
                                function() 
                                {                                
                                    $('#loading_modal').modal('hide');
                                    Swal.fire({                        
                                        text: "MailChimp Account was successfully disconnected.",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });                    
                                }, 
                            1000);                                        
                        },
                        complete : function(){
                            
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        });

        $('#frm-export-mailchimp').on('submit', function(e){
            e.preventDefault();

            var url = base_url + 'tools/_create_mailchimp_customer_export';
            var formData = new FormData($('#frm-export-mailchimp')[0]);   
            $('#btn-export-mailchimp').html('<span class="bx bx-loader bx-spin"></span>');

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
                        $('#mailchimp-export-modal').modal("hide");         
                        Swal.fire({
                            title: 'Save Successful!',
                            html: "Mailchimp export data was successfully created.",
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

                    $('#btn-export-mailchimp').html('Save');
                 }
              });
            }, 800);
        });

        $('#mailchimp-list').select2({
            dropdownParent: $("#mailchimp-export-modal"),
            placeholder: 'Select Mailchimp List'
        });

        $('#mailchimp-status').select2({
            dropdownParent: $("#mailchimp-export-modal"),
            placeholder: 'Select Mailchimp Status'
        });

        $('#mailchimp-customer').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Select Customer',
            dropdownParent: $("#mailchimp-export-modal"),
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        function formatRepoCustomer(repo) {
            if (repo.loading) {
                return repo.text;
            }

            var $container = $(
                '<div><b><i class="bx bxs-user-pin select2-bx-icon"></i>' + repo.first_name + ' ' + repo.last_name + '</b><hr class="select2-hr" /><small><i class="bx bxs-envelope select2-bx-icon"></i>' + repo.email + '</small></div>'
            );

            return $container;
        }

        function formatRepoCustomerSelection(repo) {
            if (repo.first_name != null) {
                return repo.first_name + ' ' + repo.last_name;
            } else {
                return repo.text;
            }
        }
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>