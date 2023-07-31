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
                        <h1>Zillow</h1>
                        <p style="margin-top: 21px;">As the most-visited real estate website in the United States, Zillow and its affiliates offer customers an on-demand experience for selling, buying, renting and financing with transparency and nearly seamless end-to-end service.</p>
                    </div>
                    <div class="col-7" style="text-align:right;">
                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/zillow.png" style="width:21%;">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-8">                        
                        <iframe src="https://www.zillow.com/homedetails/1-Anchorage-Way-APT-1505-Freeport-NY-11520/2094629656_zpid/" width="420" height="315" frameborder="0" allowfullscreen="allowfullscreen"><iframe>                       
                    </div>
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