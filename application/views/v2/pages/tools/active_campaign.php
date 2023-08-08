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
                        <h1>Active Campaign</h1>
                        <p style="margin-top: 21px;">Export customer to your <b>Active Campaign</b> lists.</p>
                    </div>
                    <div class="col-7" style="text-align:right;">
                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_active_campaign.png">
                    </div>
                </div>

                <?php if( $is_with_error == 1 ){ ?>
                    <div class="row">
                        <div class="col-4">
                            <div class="alert alert-danger">Invalid credentials</div>
                        </div>
                    </div>
                <?php } ?>  

                <?php if( $companyActiveCampaign && $companyActiveCampaign->status == 1 ){ ?>
                    <div class="row g-3">
                        <div class="col-3">
                            <div class="nsm-counter h-100">
                                <div class="row h-100">
                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                        <i class='bx bxs-contact'></i>
                                    </div>
                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                        <span>Total Active Campaign Contacts</span>
                                        <h2><?= $activeCampaignContacts['contacts']->meta->total; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="nsm-counter success h-100">
                                <div class="row h-100">
                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                        <i class='bx bxs-envelope' ></i>
                                    </div>
                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                        <span>Total Active Campaign Automation</span>
                                        <h2><?= $activeCampaignAutomations['automations']->meta->total; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="nsm-counter h-100">
                                <div class="row h-100">
                                    <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                                        <i class='bx bxs-contact'></i>
                                    </div>
                                    <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                                        <span>Total Active Campaign Lists</span>
                                        <h2><?= $activeCampaignLists['lists']->meta->total; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>                   
                    </div>
                    <div class="row" style="margin-top:85px;">                                     
                        <div class="col-10">
                            <a class="nsm-button primary" id="btn-active-campaign-export-customer-list" href="javascript:void(0);">
                                <i class='bx bx-export'></i> Export Customer to List
                            </a>
                            <a class="nsm-button primary" id="btn-active-campaign-export-customer-automation" href="javascript:void(0);">
                                <i class='bx bx-export'></i> Export Customer to Automation
                            </a>
                        </div>
                        <div class="col-2" style="text-align:right;">
                            <a class="nsm-button primary" id="btn-active-campaign-disconnect" href="javascript:void(0);">Disconnect</a>
                        </div>
                    </div>
                    <div class="row mt-3">   
                        <div class="col-12" id="attendance-list">
                            <table class="nsm-table">                        
                                <thead>
                                    <tr>
                                        <td class="table-icon" style="width:40%;"></td>
                                        <td data-name="TotalRecords">Exported</td>
                                        <td data-name="TotalExported">Failed</td>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Exported Contacts</td>
                                        <td><?= intval($companyActiveCampaign->active_campaign_customer_total_exported); ?></td>
                                        <td><?= intval($companyActiveCampaign->active_campaign_customer_total_failed);  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Exported Contacts to List</td>
                                        <td><?= intval($companyActiveCampaign->active_campaign_list_total_exported); ?></td>
                                        <td><?= intval($companyActiveCampaign->active_campaign_list_total_failed); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Exported Contacts to Automation</td>
                                        <td><?= intval($companyActiveCampaign->active_campaign_automation_total_exported); ?></td>
                                        <td><?= intval($companyActiveCampaign->active_campaign_automation_total_failed); ?></td>
                                    </tr>
                                </tbody>
                            </table>                                                                                    
                        </div>                          
                        <a href="<?= base_url('tools/active_campaign_list_automation_logs') ?>" class="nsm-button default mt-4" style="width:5%;">View Logs</a>                        
                    </div>                    
                <?php }else{ ?>
                    <form id="frm-connect-active-campaign" method="POST">                        
                        <div class="mb-4">
                          <label for="formApiKey" class="form-label">API Key</label>
                          <input type="text" class="form-control" id="formApiKey" name="api_key" placeholder="API Key" style="width:50%;">
                        </div>
                        <div class="mb-4">
                          <label for="formApiUrl" class="form-label">API URL</label>
                          <input type="text" class="form-control" id="formApiUrl" name="api_url" placeholder="https://account-name.api-us1.com" style="width:50%;">
                        </div>  
                        <label class="content-subtitle mt-2">
                            To locate your API Key and API URL - <a class="nsm-link" href="https://support.exitbee.com/email-marketing-crm-integrations/how-to-find-your-activecampaign-api-key" target="_new">How to find your ActiveCampaign API KEY and API URL</a>
                        </label>

                        <div class="col-auto mt-5">
                            <button class="nsm-button primary" id="btn-connect-active-campaign">Save</button>
                        </div>                
                    </form>                    
                <?php } ?>                
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="active-campaign-export-list-modal" tabindex="-1" aria-labelledby="active_campaign_export_list_modal_label" aria-hidden="true" style="margin-top:10%;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form id="frm-export-list" method="POST">                        
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Export Customer to your Active Campaign List</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">   
                                    <div class="row g-3">         
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Active Campaign List</label>
                                            <select class="form-control" name="active_campaign_list" id="active-campaign-list" required="">
                                                <?php foreach($activeCampaignLists['lists']->lists as $list){ ?>
                                                    <option value="<?= $list->id; ?>"><?= $list->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Customer</label>
                                            <select name="company_customer[]" id="list-company-customer" class="form-control" required="" multiple="">
                                                <option value="">Select Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                        <div class="modal-footer">
                            <button name="btn_close_create_auto_sms" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary" id="btn-export-list">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="active-campaign-export-automation-modal" tabindex="-1" aria-labelledby="active_campaign_export_automation_modal_label" aria-hidden="true" style="margin-top:10%;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form id="frm-export-automation" method="POST">                        
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">Export Customer to your Active Campaign Automation</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="nsm-card primary">
                                <div class="nsm-card-content">   
                                    <div class="row g-3">         
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Active Campaign Automation</label>
                                            <select class="form-control" name="active_campaign_automation" id="active-campaign-automation" required="">
                                                <?php foreach($activeCampaignAutomations['automations']->automations as $automation){ ?>
                                                    <option value="<?= $automation->id; ?>"><?= $automation->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2 create-tech-attendees">Customer</label>
                                            <select name="company_customer[]" id="automation-company-customer" class="form-control" required="" multiple="">
                                                <option value="">Select Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        </div>
                        <div class="modal-footer">
                            <button name="btn_close_create_auto_sms" type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button name="btn_close_modal" type="submit" class="nsm-button primary" id="btn-export-automation">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#active-campaign-export-list-modal').modal({backdrop: 'static', keyboard: false});
        $('#active-campaign-export-automation-modal').modal({backdrop: 'static', keyboard: false});

        $('#active-campaign-list').select2({
            dropdownParent: $("#active-campaign-export-list-modal"),
            placeholder: 'Select Active Campaign List'
        });

        $('#active-campaign-automation').select2({
            dropdownParent: $("#active-campaign-export-automation-modal"),
            placeholder: 'Select Active Campaign Automation'
        });

        $('#btn-active-campaign-export-customer-list').on('click', function(){
            $('#active-campaign-export-list-modal').modal('show');
        });

        $('#btn-active-campaign-export-customer-automation').on('click', function(){
           $('#active-campaign-export-automation-modal').modal('show'); 
        });

        $('#list-company-customer').select2({
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
            dropdownParent: $("#active-campaign-export-list-modal"),
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        $('#automation-company-customer').select2({
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
            dropdownParent: $("#active-campaign-export-automation-modal"),
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

        $('#btn-active-campaign-disconnect').on('click', function(){
            Swal.fire({            
                html: "Disconnect your Active Campaign Account?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    var url = base_url + "tools/_disconnect_active_campaign_account";
                    $.ajax({
                        type: 'POST',
                        url: url,
                        dataType: 'json',
                        beforeSend: function(data) {
                            $('#loading_modal').modal('show');
                            $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Disconnecting Active Campaign Account....');
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

        $('#frm-connect-active-campaign').on('submit', function(e){
            e.preventDefault();

            var url = base_url + 'tools/_verify_connect_active_campaign';
            var formData = new FormData($('#frm-connect-active-campaign')[0]);   
            $('#btn-connect-active-campaign').html('<span class="bx bx-loader bx-spin"></span>');

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
                        Swal.fire({
                            title: 'Connect Successful!',
                            html: "You can now export your customer to your Active Campaign List and Automation.",
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

                    $('#btn-connect-active-campaign').html('Save');
                 }
              });
            }, 800);
        });  

        $('#frm-export-list').on('submit', function(e){
            e.preventDefault();

            var url = base_url + 'tools/_create_active_campaign_export_list';
            var formData = new FormData($('#frm-export-list')[0]);               

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                data: formData,
                beforeSend: function(data) {
                    $('#btn-export-list').html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(o)
                {          
                    if( o.is_success == 1 ){                           
                        Swal.fire({
                            title: 'Save Successful!',
                            html: "Active Campaign export customer to list was successfully created.",
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
                complete : function(){
                    $('#btn-export-list').html('Save');
                    $('#active-campaign-export-list-modal').modal('hide');                
                },
            });
        });

        $('#frm-export-automation').on('submit', function(e){
            e.preventDefault();

            var url = base_url + 'tools/_create_active_campaign_export_automation';
            var formData = new FormData($('#frm-export-automation')[0]);               

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                data: formData,
            beforeSend: function(data) {
                $('#btn-export-automation').html('<span class="bx bx-loader bx-spin"></span>');
            },
            success: function(o)
            {          
                if( o.is_success == 1 ){                           
                    Swal.fire({
                        title: 'Save Successful!',
                        html: "Active Campaign export customer to automation was successfully created.",
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
            complete : function(){
                $('#btn-export-automation').html('Save');
                $('#active-campaign-export-automation-modal').modal('hide');                
            },
          });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>