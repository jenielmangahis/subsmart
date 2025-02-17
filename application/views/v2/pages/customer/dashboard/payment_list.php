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
                            Track your customer invoice payments.
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
                                <td class="table-icon"></td>
                                <td data-name="Invoice Number">Invoice Number</td>
                                <td data-name="Date">Payment Date</td>       
                                <td data-name="Method">Payment Method</td>                                
                                <td data-name="Amount" style="text-align:right">Amount</td>
                                <td data-name="Amount" style="text-align:right">Balance</td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php if (!empty($payments)) { ?>
                            <?php foreach ($payments as $payment) { ?>
                            <tr>
                                <td><div class="table-row-icon"><i class='bx bx-dollar-circle'></i></div></td>
                                <td class="fw-bold nsm-text-primary"><?= $payment->invoice_number; ?></td>
                                <td class="nsm-text-primary"><?php echo date("m/d/Y", strtotime($payment->payment_date)); ?></td>
                                <td class="nsm-text-primary"><?php echo strtoupper($payment->payment_method); ?></td>
                                <td style="text-align:right;">$<?php echo number_format((float)$payment->invoice_amount, 2, '.', ',');  ?></td>
                                <td style="text-align:right;">$<?php echo number_format((float)$payment->balance, 2, '.', ',');  ?></td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
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