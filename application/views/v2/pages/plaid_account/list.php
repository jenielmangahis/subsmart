<?php include viewPath('v2/includes/header'); ?>
<style>
.hoverEffect {
    font-size: 29px;
    position: absolute;
    margin: 30px 55px;
    cursor: pointer;
}
.bs-popover-top .arrow:after, .bs-popover-top .arrow:before {
  border-top-color: #32243D !important;
}
.bs-popover-bottom .arrow:after, .bs-popover-bottom .arrow:before {
  border-bottom-color: #32243D !important;
}
.autocomplete-img {
    height: 50px;
    width: 50px;
}
.autocomplete-left {
    display: inline-block;
    width: 65px;
}
.autocomplete-right {
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
.list-chk-options{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.list-chk-options li{
    display: inline-block;
    width: 30%;
    margin: 5px;
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
                            Connect your Plaid Bank Accounts.<br /> Note: You need to have a valid Plaid API account to connect your bank account. Please set your Plaid API account in our <a href="<?= base_url('tools/api_connectors'); ?>">API Connectors list</a>.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-connect-plaid">
                                <i class='bx bx-fw bx-cog'></i> Connect Bank Account
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Bank">Bank</td>
                            <td data-name="Account Name">Account Name</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Balance" style="width: 10%;">Balance</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($is_valid == 1) { ?>
                            <?php foreach ($plaidAccounts as $pa){ ?>
                            <tr>
                                <td><?= $pa->institution_name; ?></td>
                                <td><?= $pa->account_name; ?></td>
                                <td><?= ucwords($pa->subtype); ?></td>
                                <td><?= number_format($pa->balance_current, 2); ?></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">     
                                            <li>
                                                <a class="dropdown-item transactions-bank-account" href="javascript:void(0);" data-id="<?= $pa->id; ?>">View Bank Transactions</a>
                                            </li>                                       
                                            <li>
                                                <a class="dropdown-item recurring-transactions" href="javascript:void(0);" data-id="<?= $pa->id; ?>">View Recurring Transactions</a>
                                            </li>                                       
                                            <li>
                                                <a class="dropdown-item delete-bank-account" href="javascript:void(0);" data-id="<?= $pa->id; ?>">Delete</a>
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

                <div class="modal fade nsm-modal fade" id="modalPlaidTransactionsList" aria-labelledby="modalPlaidTransactionsListLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Bank Transactions</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>                            
                            <div class="modal-body modal-bank-transactions-container"></div>                            
                        </div>
                    </div>
                </div>

                <div class="modal fade nsm-modal fade" id="modalPlaidRecurringTransactionsList" aria-labelledby="modalPlaidRecurringTransactionsListLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Recurring Transactions</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>                            
                            <div class="modal-body modal-recurring-transactions-container"></div>                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination(); 

    <?php if( $plaid_handler_open == 1 ){ ?>
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
    <?php } ?>
});

$(document).on('click', '.transactions-bank-account', function(){
    var url = base_url + 'plaid_account/_bank_account_transactions';
    var pid = $(this).attr('data-id');

    $('#modalPlaidTransactionsList').modal('show');
    $(".modal-bank-transactions-container").html('<span class="bx bx-loader bx-spin"></span>');

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         data: {pid:pid},
         success: function(o)
         {          
            $(".modal-bank-transactions-container").html(o);
         }
      });
    }, 800);
});

$(document).on('click', '.recurring-transactions', function(){
    var url = base_url + 'plaid_account/_bank_account_recurring_transactions';
    var pid = $(this).attr('data-id');

    $('#modalPlaidRecurringTransactionsList').modal('show');
    $(".modal-recurring-transactions-container").html('<span class="bx bx-loader bx-spin"></span>');

    setTimeout(function () {
      $.ajax({
         type: "POST",
         url: url,
         data: {pid:pid},
         success: function(o)
         {          
            $(".modal-recurring-transactions-container").html(o);
         }
      });
    }, 800);
});

$(document).on('click', '.btn-connect-plaid', function(){
    var redirect_url = '<?= PLAID_API_REDIRECT_URL_MAIN; ?>';
    var url = base_url + '_launch_plaid_accounts';
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
                                        location.reload();
                                        //load_plaid_accounts();
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
                var html_message = o.msg + "<br />To check your Plaid API credentials click <a href='"+api_connect_url+"'>API Connectors</a>";
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    html: html_message
                });
            }            
         }
    });
});

$(document).on("click", ".delete-bank-account", function(e) {
        var pid = $(this).attr("data-id");
        var url = base_url + 'plaid_account/_delete_bank_account';

        Swal.fire({
            title: 'Delete Connected Bank Account',
            html: "Are you sure you want to delete selected bank account?",
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
                    data: {pid:pid},
                    success: function(o) {
                        if( o.is_success == 1 ){   
                            Swal.fire({
                                title: 'Delete Successful!',
                                text: "Bank Account was Deleted Successfully!",
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
</script>
<?php include viewPath('v2/includes/footer'); ?>