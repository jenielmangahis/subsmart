<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Bank Accounts</span>
        </div>
        <div class="nsm-card-controls">
            <a href="javascript:void(0);" role="button" class="nsm-button btn-sm m-0 me-2 btn-connect-plaid" id="table-modal">
                Connect Bank Account
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">        
        <div class="nsm-widget-table">
            <?php foreach($accounts as $account) : ?>
                <div class="widget-item">
                    <div class="nsm-list-icon">
                        <i class='bx bx-building-house'></i>
                    </div>
                    <div class="content ms-2">
                        <div class="details">
                            <span class="content-title mb-1"><?=$account->name; ?></span>
                            <!-- <span class="content-subtitle d-block">Bank balance: $0.00</span> -->
                            <span class="content-subtitle d-block">In nSmartrac: <?=str_replace("$-", "-$", '$'.number_format(floatval($account->balance), 2, '.', ','))?></span>
                        </div>
                        <div class="controls">
                            <!-- <span class="nsm-badge">Updated 1 day ago</span> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="plaid-accounts"></div>
            <!-- <div class="widget-item">
                <div class="nsm-list-icon">
                    <i class='bx bx-wallet'></i>
                </div>
                <div class="content ms-2">
                    <div class="details">
                        <span class="content-title mb-1">Cash on hand</span>
                        <span class="content-subtitle d-block"></span>
                        <span class="content-subtitle d-block">In nSmartrac: $111,101.00</span>
                    </div>
                    <div class="controls">
                        <span class="nsm-badge">Updated</span>
                    </div>
                </div>

            </div>
            <div class="widget-item">
                <div class="nsm-list-icon">
                    <i class='bx bx-building-house'></i>
                </div>
                <div class="content ms-2">
                    <div class="details">
                        <span class="content-title mb-1">Corporate Account (XXXXXX 5850)</span>
                        <span class="content-subtitle d-block"></span>
                        <span class="content-subtitle d-block">In nSmartrac: $0</span>
                    </div>
                    <div class="controls">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
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
    var url = base_url + '_load_connected_bank_accounts';
    $('.plaid-accounts').html('<span class="bx bx-loader bx-spin"></span>');
    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         success: function(o)
         {          
            $('.plaid-accounts').html(o);
         }
      });
    }, 800);
}
$(document).on('click', '.btn-connect-plaid', function(){
    var url = base_url + '_launch_plaid_accounts';
    var redirect_url = '<?= PLAID_API_REDIRECT_URL_DASHBOARD; ?>';
    $.ajax({
         type: "POST",
         url: url,
         dataType:'json',
         data:{redirect_url:redirect_url},
         success: function(o)
         {          
            if( o.is_valid == 1 ){
                var linkHandler = Plaid.create({
                    env: '<?= PLAID_API_ENV ?>',
                    clientName: o.client_name,
                    token: o.plaid_token,
                    product: ['auth','transactions'],                    
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
            }else{
                var api_connect_url = base_url + 'tools/api_connectors';
                //var html_message = o.msg + "<br />To check your Plaid API credentials click <a href='"+api_connect_url+"'>API Connectors</a>";
                var html_message = o.msg;
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: html_message
                });
            }            
         }
    });
});
</script>