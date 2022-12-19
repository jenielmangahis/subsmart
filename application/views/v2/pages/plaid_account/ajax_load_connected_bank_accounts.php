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
.custom-accordion-button {
    position: relative;
    display: block;
    align-items: center;
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 19px;
    color: #212529;
    text-align: left;
    background-color: #fff;
    border: 0;
    border-radius: 0;
    overflow-anchor: none;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,border-radius .15s ease;
}
</style>
<?php if($is_valid == 1){ ?>
    <?php foreach($plaidBankAccounts as $pa){ ?>
    <div class="widget-item">
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
                <!-- <span class="nsm-badge">Updated 1 day ago</span> -->
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="custom-accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bank-recent-transactions" aria-expanded="true" aria-controls="bank-recent-transactions">
                    <i class='bx bxs-spreadsheet drawer-icon'></i> Recent Transactions
                    <i class='bx bxs-chevron-up toggle-icon' style="float: right;"></i>
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
    $('.custom-accordion-button').click(function() {
        var toggle_icon = $('.toggle-icon');
        toggle_icon.toggleClass('bx bxs-chevron-up bx bxs-chevron-down');
    });
});
</script>