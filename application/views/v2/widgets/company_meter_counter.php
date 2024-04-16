<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="widget_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-estimate">
                        <i class="bx bx-bar-chart-square"></i>
                    </div>
                    <span style="color:#6a4a86" id='company_meter_title'><?php echo $companyName->business_name; ?> Meter</span>
                </div>
            </div>
        </div>
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?php echo $id; ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px);">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                    <label for="">Plaid Accounts</label>
                    <h1></h1>
                    <div class="plaid-accounts-thumbnail"></div>

                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class=" btn-sm m-0 me-2" href="estimate">
            <i class='bx bx-right-arrow-alt' style="color: #6a4a86"></i>
        </a>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
}
?>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script>
<?php if( $plaid_handler_open == 1 ){ ?>
$(function(){    
    var linkHandler = Plaid.create({
        env: '<?= PLAID_API_ENV ?>',
        clientName: '<?= $client_name; ?>',
        token: '<?= $plaid_token; ?>',
        product: ['auth','transactions'],
        receivedRedirectUri : window.location.href,
        selectAccount: true,
        onSuccess: function(public_token, metadata) {
            if( public_token != '' ){
                var url = base_url + '_create_plaid_account';
                var account_id = metadata.account.id;
                var ins_id     = metadata.institution.institution_id;
                var ins_name   = metadata.institution.name;
                var meta_data   = JSON.stringify(metadata);
                //console.log('metadata: ' + JSON.stringify(metadata));
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {public_token:public_token,meta_data:meta_data},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ){
                            //load bank details
                            load_plaid_accounts();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: result.msg
                            });
                        }
                    }
                }); 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: 'Cannot connect to Plaid. Please try again later.'
                });
            }                        
        },
    });
    linkHandler.open();
});
<?php } ?>
load_plaid_accounts();
function load_plaid_accounts(){
    var url = base_url + '_load_connected_bank_accounts_thumbnail';
    $('.plaid-accounts-thumbnail').html('<span class="bx bx-loader bx-spin"></span>');
    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         success: function(o)
         {          

            $('.plaid-accounts-thumbnail').html(o);
         }
      });
    }, 800);
}
</script>