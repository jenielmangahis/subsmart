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
<?php }else{ ?>
<div class="nsm-empty">
    <i class="bx bx-meh-blank"></i>
    <span>Invalid Plaid Account</span>
</div>
<?php } ?>