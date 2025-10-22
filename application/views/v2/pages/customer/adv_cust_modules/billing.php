<div class="d-block mb-4 mt-4">
    <span style="font-size:18px; font-weight:bold;">Billing</span>    
</div>
<div class="clear"></div>
<div class="row g-3 payment-method-container">
    <div class="col-12 col-md-6">
        <div class="row g-2">
            <div class="col-12 col-md-6">
                <label class="content-title">Payment Method</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                <?php 
                if(isset($billing_info)){ 
                    if($billing_info->bill_method && $billing_info->bill_method != ''){                                    
                        if( $billing_info->bill_method == 'CC' ){
                            echo 'Credit Card';
                        }elseif( $billing_info->bill_method == 'DC' )
                            echo 'Debit Card'; 
                        }else{
                            echo $billing_info->bill_method; 
                        }
                        }else{
                        echo "&mdash;";
                        }
                    ?>
                </span>
            </div>
            <?php if( $billing_info->bill_method == 'CC' || $billing_info->bill_method == 'Credit Card' || $billing_info->bill_method == 'DC' || $billing_info->bill_method == 'OCCP' ){ ?>
                <div class="col-12 col-md-6">
                    <label class="content-title">Credit Card Number</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $credit_card_num = '&mdash;';
                            if( $billing_info && $billing_info->credit_card_num != '' ){
                                if (logged('user_type') == 7) {
                                    $credit_card_num = $billing_info->credit_card_num;
                                }else{
                                    $credit_card_num = maskString($billing_info->credit_card_num);
                                }
                            }
                        ?>
                        <?= $credit_card_num; ?>
                    </span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-title">Expiration</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php if(isset($billing_info)){ 
                            if($billing_info->credit_card_exp){
                            echo $billing_info->credit_card_exp; 
                            }else{
                                echo "&mdash;";
                            }
                        }
                        ?>
                    </span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-title">CCV</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $ccv = '&mdash;';
                            if( $billing_info && $billing_info->credit_card_exp_mm_yyyy != '' ){
                                if (logged('user_type') == 7) {
                                    $ccv = $billing_info->credit_card_exp_mm_yyyy;
                                }else{
                                    $ccv = '***';
                                }
                            }
                        ?>
                        <?= $ccv; ?>
                    </span>
                </div>
            <?php }elseif( $billing_info->bill_method == 'Check' ){ ?>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Check Number</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $check_num = '&mdash;';
                            if( $billing_info && $billing_info->check_num != '' ){
                                if (logged('user_type') == 7) {
                                    $check_num = $billing_info->check_num;
                                }else{
                                    $check_num = maskString($billing_info->check_num);
                                }
                            }
                        ?>
                        <?= $check_num; ?>
                    </span>
                </div>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Bank Name</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $bank_name = '&mdash;';
                            if( $billing_info && $billing_info->bank_name != '' ){
                                $bank_name = $billing_info->bank_name;
                            }
                        ?>
                        <?= $bank_name; ?>
                    </span>
                </div>
                <div class="col-12 col-md-6">
                    <label class="content-title">Routing Number</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                        if(isset($billing_info)){ 
                            if($billing_info->routing_num){
                            echo $billing_info->routing_num; 
                            }else{
                                echo "&mdash;";
                            } 
                        }
                        ?>
                    </span>
                </div>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Account Number</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $acct_num = '&mdash;';
                            if( $billing_info && $billing_info->acct_num != '' ){
                                if (logged('user_type') == 7) {
                                    $acct_num = $billing_info->acct_num;
                                }else{
                                    $acct_num = maskString($billing_info->acct_num);
                                }
                            }
                        ?>
                        <?= $acct_num; ?>
                    </span>
                </div>
                
            <?php }elseif( $billing_info->bill_method == 'ACH' ){ ?>
                <div class="col-12 col-md-6">
                    <label class="content-title">Routing Number</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                        if(isset($billing_info)){ 
                            if($billing_info->routing_num){
                            echo $billing_info->routing_num; 
                            }else{
                                echo "&mdash;";
                            } 
                        }
                        ?>
                    </span>
                </div>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Account Number</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $acct_num = '&mdash;';
                            if( $billing_info && $billing_info->acct_num != '' ){
                                if (logged('user_type') == 7) {
                                    $acct_num = $billing_info->acct_num;
                                }else{
                                    $acct_num = maskString($billing_info->acct_num);
                                }
                            }
                        ?>
                        <?= $acct_num; ?>
                    </span>
                </div>
            <?php }elseif( $billing_info->bill_method == 'VENMO' || $billing_info->bill_method == 'PP'  || $billing_info->bill_method == 'Square' ){ ?>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Account Credential</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $account_credential = '&mdash;';
                            if( $billing_info && $billing_info->account_credential != '' ){
                                $account_credential = $billing_info->account_credential;
                            }
                        ?>
                        <?= $account_credential; ?>
                    </span>
                </div>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Account Note</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $account_note = '&mdash;';
                            if( $billing_info && $billing_info->account_note != '' ){
                                $account_note = $billing_info->account_note;
                            }
                        ?>
                        <?= $account_note; ?>
                    </span>
                </div>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Confirmation</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $confirmation = '&mdash;';
                            if( $billing_info && $billing_info->confirmation != '' ){
                                $confirmation = $billing_info->confirmation;
                            }
                        ?>
                        <?= $confirmation; ?>
                    </span>
                </div>
            <?php }elseif( $billing_info->bill_method == 'WW' ){ ?>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Account Credential</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $account_credential = '&mdash;';
                            if( $billing_info && $billing_info->account_credential != '' ){
                                $account_credential = $billing_info->account_credential;
                            }
                        ?>
                        <?= $account_credential; ?>
                    </span>
                </div>
                <div class="c ol-12 col-md-6">
                    <label class="content-title">Account Note</label>
                </div>
                <div class="col-12 col-md-6">
                    <span class="content-subtitle">
                        <?php 
                            $account_note = '&mdash;';
                            if( $billing_info && $billing_info->account_note != '' ){
                                $account_note = $billing_info->account_note;
                            }
                        ?>
                        <?= $account_note; ?>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row g-2">
            <div class="col-12 col-md-6">
                <label class="content-title">MMR</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                $<?php if(isset($billing_info)){ echo $billing_info->mmr; }; ?>
                </span>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-title">Billing Freq.</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                    if(isset($billing_info)){ 
                        if($billing_info->bill_freq){
                            echo $billing_info->bill_freq; 
                            }else{
                                echo "&mdash;";
                            }
                            }
                            ?>
                </span>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-title">Billing Date</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                    if(isset($billing_info)){ 
                        if($billing_info->bill_day){
                            echo $billing_info->bill_day; 
                        }else{
                            echo "&mdash;";
                        }
                    }
                    ?>
                </span>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-title">Contract Term</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php if(isset($billing_info)){ echo $billing_info->contract_term. ' months'; }; ?>
                </span>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-title">Start Date</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                        $start_date = '&mdash;';
                        if( $billing_info && strtotime($billing_info->bill_start_date) > 0 ){
                            $start_date = date("m/d/Y",strtotime($billing_info->bill_start_date));
                        }elseif( $office_info && strtotime($office_info->install_date) > 0 ){
                            $start_date = date("m/d/Y",strtotime($office_info->install_date));
                        }
                    ?>
                    <?= $start_date; ?>
                </span>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-title">End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                        $end_date = '&mdash;';
                        if( $billing_info && strtotime($billing_info->bill_end_date) > 0 ){
                            $end_date = date("m/d/Y",strtotime($billing_info->bill_end_date));
                        }
                    ?>
                    <?= $end_date; ?>                            
                </span>
            </div>
        </div>
    </div>    
</div>
<script>
$(function(){
    $('#chkRecurringActive').click(function(){
        return false;
    });
});
</script>