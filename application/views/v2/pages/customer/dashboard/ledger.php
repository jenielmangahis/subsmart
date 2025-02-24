<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            Track your customer payments.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-4">
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td data-name="Row Number">No.</td>
                                <td data-name="Date">Date</td>       
                                <td data-name="Description">Description</td>                                
                                <td data-name="Income" style="text-align:right">Income</td>
                                <td data-name="Payment" style="text-align:right">Payment</td>
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
                                        if( $ld['type'] == 'income' ){
                                            $income = $ld['amount'];
                                            $total_income += $ld['amount'];
                                        }else{
                                            $payment = $ld['amount'];
                                            $total_payment += $ld['amount'];
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $row; ?></td>
                                        <td class="fw-bold nsm-text-primary"><?= $key ?></td>
                                        <td class="nsm-text-primary" style="width:70% !important;"><?= $ld['description']; ?></td>
                                        <td style="text-align:right;" style="width:10% !important;">$<?= number_format($income, 2, '.', ','); ?></td>
                                        <td style="text-align:right;" style="width:10% !important;">$<?= number_format($payment, 2, '.', ','); ?></td>
                                    </tr>
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

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            tableSearch($(this));        
        }, 1000));
    });
</script>