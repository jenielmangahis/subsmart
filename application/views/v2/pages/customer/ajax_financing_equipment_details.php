<hr />
<div class="d-block mb-4">
    <span style="font-size:18px; font-weight:bold;">Financing Payment Schedule</span>    
</div>
<div class="clear"></div>
<div class="row g-3 payment-method-container">
    <div class="col-12 col-md-6">
        <div class="row g-2">
            <div class="c ol-12 col-md-6">
                <label class="content-title">Finance Amount</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= $billing_info && $billing_info->finance_amount > 0 ? number_format($billing_info->finance_amount,2,".",",") : '$0.00'; ?>
                </span>
            </div>  
            <div class="c ol-12 col-md-6">
                <label class="content-title">Recurring Start Date</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                        $recurring_start_date = '---';
                        if( $billing_info && strtotime($billing_info->recurring_start_date) > 0 ){
                            $recurring_start_date = date("m/d/Y", strtotime($billing_info->recurring_start_date));
                        }

                        echo $recurring_start_date;
                    ?>
                </span>
            </div>  
            <div class="c ol-12 col-md-6">
                <label class="content-title">Recurring End Date</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?php 
                        $recurring_end_date = '---';
                        if( $billing_info && strtotime($billing_info->recurring_end_date) > 0 ){
                            $recurring_end_date = date("m/d/Y", strtotime($billing_info->recurring_end_date));
                        }
                        
                        echo $recurring_end_date;
                    ?>
                </span>
            </div>            
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row g-2">
            <div class="col-12 col-md-6">
                <label class="content-title">Category</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= $billing_info && $billing_info->transaction_category != '' ? $billing_info->transaction_category : '---'; ?>
                </span>
            </div>
            <div class="col-12 col-md-6">
                <label class="content-title">Billing Frequency</label>
            </div>
            <div class="col-12 col-md-6">
                <span class="content-subtitle">
                    <?= $billing_info && $billing_info->frequency != '' ? $billing_info->frequency : '---'; ?>
                </span>
            </div>
        </div>
    </div>    
</div>