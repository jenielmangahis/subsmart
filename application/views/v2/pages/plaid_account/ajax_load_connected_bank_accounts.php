<style>
.bank-recent-transctions{
    list-style: none;
    padding: 0px;
    margin: 0px;
}
.bank-recent-transctions li{
    display: block;
    width: 100%;
}
.transaction-name{
    width: 70%;
    display: inline-block;
    font-weight: bold;
}
.transaction-amount{
    width: 20%;
    display: inline-block;
    text-align: right;
}
</style>
<?php if($is_valid == 1){ ?>
    <?php foreach($plaidBankAccounts as $pa){ ?>
    <div class="widget-item" id="plaid-grp-<?= $pa->id; ?>">
        <div class="nsm-list-icon">
            <i class='bx bx-building-house'></i>
        </div>
        <div class="content ms-2">
            <div class="details" style="width:70% !important;">
                <span class="content-title mb-1"><?= $pa->institution_name . ' - ' . $pa->account_name; ?></span>
                <span class="content-subtitle d-block">                    
                    <?php 
                        if( is_int($pa->balance_available) ){
                            echo 'Balance : $' . number_format($pa->balance_available, 2);
                        }else{
                            echo $pa->balance_available;
                        }   
                    ?>         
                </span>            
            </div>
            <div class="controls">
                <a class="nsm-button primary btn-widget-disconnect-plaid-bank-account" href="javascript:void(0);" data-id="<?= $pa->id; ?>">
                    <i class='bx bx-trash' style="position:relative;top:1px;"></i>
                </a>
                <!-- <span class="nsm-badge">Updated 1 day ago</span> -->
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#bank-recent-transactions" aria-expanded="true" aria-controls="bank-recent-transactions">
                    <i class='bx bxs-spreadsheet drawer-icon'></i> Recent Transactions
                </button>
            </h2>
            <div id="bank-recent-transactions" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <ul class="bank-recent-transctions">
                    <?php foreach($recentTransactions as $transcations){ ?>
                        <?php foreach($transcations as $t){ ?>
                        <li>
                            <div class="transaction-name">
                                <?= $t->name . ' - ' . $t->category[0]; ?>
                            </div>
                            <div class="transaction-amount">
                                $<?= $t->amount; ?>
                            </div>
                        </li>
                        <?php } ?>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
<div class="nsm-empty">
    <i class="bx bx-meh-blank"></i>
    <span>Invalid Plaid Account</span>
</div>
<?php } ?>
<script>
$(function(){
    $('.btn-widget-disconnect-plaid-bank-account').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Disconnect Bank Account';
        } 
    }); 

    $('.btn-widget-disconnect-plaid-bank-account').on('click', function(){
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
                                    //location.reload();
                                    $('#plaid-grp-'+pid).fadeOut('normal', function() {
                                        $(this).remove();
                                    });
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
});
</script>