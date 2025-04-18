<table class="table table-borderless" id="tbl-print-customer-ledger" style="font-size:13px;">
    <thead>
        <tr>
            <td data-name="No." style="width:5%;">#</td>
            <td data-name="Date" style="width:10%;">Date</td>       
            <td data-name="Description">Description</td>                                
            <td data-name="Description">Method</td>                                
            <td data-name="Description">Recorded Date</td>                                
            <td data-name="Description">Entered By</td>                                
            <td data-name="Income" style="text-align:right;width:10%;">Invoice</td>
            <td data-name="Payment" style="text-align:right;width:10%;">Payment</td>
        </tr>
    </thead>

    <tbody>
    <?php if (!empty($ledger)) { ?>
        <?php 
            $row = 1;
            $total_income  = 0;
            $total_payment = 0;    
        ?>
        <?php foreach($ledger as $key => $value){ ?>
            <?php foreach($value as $ld){ ?>
                <?php   
                    $income  = 0;
                    $payment = 0;
                    $late_fee_income  = 0;
                    $late_fee_payment = 0;
                    $payment_method = "-";

                    if( $ld['type'] == 'income' ){
                        $income = $ld['amount'];
                        if($ld['late_fee']) {
                            $income = $ld['amount'] - $ld['late_fee'];
                        }
                        $late_fee_income = $ld['late_fee'];
                        $total_income += $ld['amount'];
                    }else{
                        $payment = $ld['amount'];
                        if($ld['late_fee']) {
                            $payment = $ld['amount'] - $ld['late_fee'];
                        }
                        if($ld['payment_method'] == 'cc') {
                            $payment_method = "Credit Card";
                        } else {
                            $payment_method = ucwords($ld['payment_method']);
                        }
                        
                        $late_fee_payment = $ld['late_fee'];
                        $total_payment += $ld['amount'];
                    }
                ?>
                <tr>
                    <td class="show"><?= $row; ?></td>
                    <td class="fw-bold nsm-text-primary show"><?= $key ?></td>
                    <td class="nsm-text-primary show"><?= $ld['description']; ?></td>
                    <td class="nsm-text-primary show"><?= $ld['payment_method']; ?></td>
                    <td class="nsm-text-primary show"><?= date("m/d/Y",strtotime($ld['date_created'])); ?></td>
                    <td class="nsm-text-primary show"><?= $ld['user']; ?></td>
                    <td class="show" style="text-align:right;">$<?= number_format($income, 2, '.', ','); ?></td>
                    <td class="show" style="text-align:right;">$<?= number_format($payment, 2, '.', ','); ?></td>
                </tr>
                <?php if($ld['late_fee'] > 0) { ?>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="fw-bold nsm-text-primary">&nbsp;</td>
                        <td class="fw-bold nsm-text-primary">&nbsp;</td>
                        <td class="fw-bold nsm-text-primary">&nbsp;</td>
                        <td class="fw-bold nsm-text-primary">&nbsp;</td>
                        <td class="nsm-text-primary" style="text-align:right;"><strong>Interest Penalty:</strong></td>
                        <td style="text-align:right;">$<?= number_format($late_fee_income, 2, '.', ','); ?></td>
                        <td style="text-align:right;">$<?= number_format($late_fee_payment, 2, '.', ','); ?></td>
                    </tr>
                <?php } ?>                  
            <?php $row++; ?>
            <?php } ?>                            
        <?php } ?>
    <?php } ?>
        <tr>
            <td colspan="6" style="font-weight:bold;">TOTAL</td>
            <td style="text-align:right;font-weight:bold;">$<?= number_format($total_income, 2, '.', ','); ?></td>
            <td style="text-align:right;font-weight:bold;">$<?= number_format($total_payment, 2, '.', ','); ?></td>
        </tr>
        <tr>
            <?php $balance = $total_income - $total_payment; ?>
            <td class="show" colspan="6" style="font-weight:bold;font-size:22px;">BALANCE</td>
            <td class="show" colspan="2" style="font-weight:bold;font-size:22px;text-align:right;">$<?= number_format($balance, 2, '.', ','); ?></td>
        </tr>
    </tbody>
</table>