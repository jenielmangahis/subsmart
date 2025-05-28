<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/link_bank_modals'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }

    svg#svg-sprite-menu-close {
        position: relative;
        bottom: 178px !important;
    }

    .nav-close {
        margin-top: 52% !important;
    }

    .bank-img-container img {
        width: auto !important;
    }

    .btn {
        border-radius: 0 !important;
    }

    .card {
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    label>input {
        visibility: visible !important;
        position: inherit !important;
    }

    .fdx-entity-container {
        display: flex;
        flex: 1 1 auto;
        justify-content: center;
        max-width: 98%;
    }

    .fdx-recommended-entity-desc-container {
        height: 40px;
        display: flex;
        -moz-align-items: flex-start;
        align-items: flex-start;
        justify-content: center;
        -moz-flex-direction: column;
        flex-direction: column;
        margin: auto 100px;
        box-sizing: border-box;
        overflow: hidden;
        flex: 1 1;
    }

    .fdx-recommended-entity-name {
        width: 100%;
        height: 24px;
        font-weight: 600;
        font-size: 16px;
        padding-bottom: 4px;
        -webkit-margin-before: 0;
        margin-block-start: 0;
        -webkit-margin-after: 0;
        margin-block-end: 0;
        text-align: left;
        margin-bottom: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: inherit;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .fdx-recommended-entity-desc {
        min-height: 18px;
        font-size: 12px;
        -webkit-margin-before: 0px;
        margin-block-start: 0px;
        -webkit-margin-after: 0px;
        margin-block-end: 0px;
        text-align: left;
        color: #6b6c72;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 400;
        cursor: inherit;
    }

    .fdx-provider-logo {
        width: 100%;
        height: auto;
    }

    .fdx img {
        border: 0;
    }

    .fdx img {
        background: transparent !important;
    }

    .fdx-provider-logo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <!-- <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/link_bank_subtabs'); ?>
    </div> -->
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When you connect an account, accounting will automatically downloads and categorizes bank and credit card transactions for you.
                            It enters the details so you don't have to enter transactions manually. All you have to do is approve the work.
                        </div>
                    </div>
                </div>
                <?php if(checkRoleCanAccessModule('accounting-link-bank', 'write')){ ?>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-6 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary btn-connect-plaid">
                                <i class='bx bx-link'></i> Connect Bank Account
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Bank" style="width: 40%;">Bank</td>
                            <td data-name="Account Name" style="width: 30%;">Account Name</td>
                            <td data-name="Type">Type</td>
                            <td data-name="Balance" style="width: 10%;text-align:right;">Balance</td>
                            <td data-name="Manage" style="width: 5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($is_valid == 1) { ?>
                            <?php foreach ($plaidAccounts as $pa){ ?>
                            <tr>
                                <td><div class="table-row-icon"><i class='bx bxs-bank'></i></div></td>
                                <td class="fw-bold nsm-text-primary show"><?= $pa->institution_name; ?></td>
                                <td><?= $pa->account_name; ?></td>
                                <td><?= ucwords($pa->subtype); ?></td>
                                <td style="text-align:right;">                                    
                                    <?php 
                                        if( is_int($pa->balance_current) && $pa->balance_current > 0 ){
                                            echo number_format($pa->balance_current, 2);
                                        }else{
                                            echo '0.00';
                                        }   
                                    ?>        
                                </td>
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
                                            <?php if(checkRoleCanAccessModule('accounting-link-bank', 'delete')){ ?>                                  
                                            <li>
                                                <a class="dropdown-item delete-bank-account" href="javascript:void(0);" data-id="<?= $pa->id; ?>">Delete</a>
                                            </li>
                                            <?php } ?>
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
                    <div class="modal-dialog modal-lg modal-dialog-centered">
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
                    <div class="modal-dialog modal-lg modal-dialog-centered">
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
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));

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

$(document).on("click", ".delete-bank-account", function(e) {
        var pid = $(this).attr("data-id");
        var url = base_url + 'plaid_account/_delete_bank_account';

        Swal.fire({
            title: 'Delete Bank Account',
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
                                title: 'Delete Bank Account',
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