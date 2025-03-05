<?php if (!empty($customerLedgers)) { ?>
    <?php
        $row = 1;
        $total_income  = 0;
        $total_payment = 0;   
    ?>                                       
    <?php foreach($customerLedgers as $key => $ledger){ ?>
        <?php foreach($ledger as $ld){ ?>
            <?php   
                $income  = 0;
                $payment = 0;
                $late_fee_income  = 0;
                $late_fee_payment = 0;
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
                    $late_fee_payment = $ld['late_fee'];
                    $total_payment += $ld['amount'];
                }
            ?>                                            
            <tr>
                <td class=""><span class="content-subtitle" ><?= get_format_date($key) ?></span></td>
                <td><span class="content-subtitle"><?= $ld['description']; ?></span></td>
                <td style="text-align:right;"><span class="content-subtitle">$<?= number_format($income, 2, '.', ','); ?></span></td>
                <td style="text-align:right;"><span class="content-subtitle">$<?= number_format($payment, 2, '.', ','); ?></span></td>
            </tr>
            <?php if($ld['late_fee'] > 0) { ?>
                <tr>
                    <td colspan="2" style="text-align:right;"><span class="content-subtitle"><strong>Interest Penalty:</strong></span></td>
                    <td style="text-align:right;"><span class="content-subtitle">$<?= number_format($late_fee_income, 2, '.', ','); ?></span></td>
                    <td style="text-align:right;"><span class="content-subtitle">$<?= number_format($late_fee_payment, 2, '.', ','); ?></span></td>
                </tr>
            <?php } ?>
        <?php } ?>
    <?php } ?>

        <tr>
            <td colspan="2" style="font-weight:bold;">TOTAL</td>
            <td style="text-align:right;">$<?= number_format($total_income, 2, '.', ','); ?></td>
            <td style="text-align:right;">$<?= number_format($total_payment, 2, '.', ','); ?></td>
        </tr>
        <tr>
            <?php $balance = $total_income - $total_payment; ?>
            <td colspan="2" style="font-weight:bold;font-size:22px;">BALANCE</td>
            <td colspan="2" style="font-weight:bold;font-size:22px;text-align:center;">$<?= number_format($balance, 2, '.', ','); ?></td>
        </tr>    
<?php }else { ?>
    <tr>
        <td colspan="4">
            <div class="nsm-empty">
                <span>No results found.</span>
            </div>
        </td>
    </tr>
<?php } ?>