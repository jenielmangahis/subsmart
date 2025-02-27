<div class="tab-content mt-4">
    <table class="nsm-table" style="font-size:12px;">
        <thead>
            <tr>
                <td data-name="No." style="width:5%;font-size:12px;">#</td>
                <td data-name="Date" style="width:20%;font-size:12px;">Date</td>       
                <td data-name="Description" style="font-size:12px;">Description</td>                                
                <td data-name="Income" style="text-align:right;width:15%;font-size:12px;">Income</td>
                <td data-name="Payment" style="text-align:right;width:15%;font-size:12px;">Payment</td>
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
                        <td><?= $row; ?></td>
                        <td class="fw-bold nsm-text-primary"><?= $key ?></td>
                        <td class="nsm-text-primary"><?= $ld['description']; ?></td>
                        <td style="text-align:right;">$<?= number_format($income, 2, '.', ','); ?></td>
                        <td style="text-align:right;">$<?= number_format($payment, 2, '.', ','); ?></td>
                    </tr>
                    <?php if($ld['late_fee'] > 0) { ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td class="fw-bold nsm-text-primary">&nbsp;</td>
                            <td class="nsm-text-primary" style="text-align:right;"><strong>Late Fee:</strong></td>
                            <td style="text-align:right;">$<?= number_format($late_fee_income, 2, '.', ','); ?></td>
                            <td style="text-align:right;">$<?= number_format($late_fee_payment, 2, '.', ','); ?></td>
                        </tr>
                    <?php } ?>
                <?php $row++; ?>
                <?php } ?>                            
            <?php } ?>
        <?php } ?>
        <tr>
                <td colspan="3">TOTAL</td>
                <td style="text-align:right;">$<?= number_format($total_income, 2, '.', ','); ?></td>
                <td style="text-align:right;">$<?= number_format($total_payment, 2, '.', ','); ?></td>
            </tr>
            <tr>
                <?php $balance = $total_income - $total_payment; ?>
                <td colspan="3" style="font-weight:bold;font-size:22px;">BALANCE</td>
                <td colspan="2" style="font-weight:bold;font-size:22px;text-align:center;">$<?= number_format($balance, 2, '.', ','); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>