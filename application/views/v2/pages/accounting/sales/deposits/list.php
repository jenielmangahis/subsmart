<?php include viewPath('v2/includes/accounting_header'); ?>
<?php //include viewPath('v2/includes/accounting/customers_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Good accounting gives businesses an easy way to manage bookkeeping with tools to record payments, deposits, costs. Deposits are recorded in your account register making it easy to reverse any errors from your company’s payment record or un-deposited funds.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="accordion">
                            <?php $index = 0; ?>
                            <?php foreach($deposits as $date => $deposit) : ?>
                            <div class="row g-3 grid-mb">
                                <div class="col-12">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button content-title  <?=$index > 0 ? 'collapsed' : ''?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?=$index?>" aria-expanded="<?=$index > 0 ? 'false' : 'true'?>" aria-controls="collapse-<?=$index?>">
                                                <div class="row w-100">
                                                    <div class="col-12 col-md-6">
                                                        <p>
                                                            Deposited
                                                            <?php 
                                                                $now = date("m/d/Y");
                                                                $yesterday = date('m/d/Y',strtotime("-1 days"));

                                                                if ($date == $now)
                                                                {
                                                                    echo "Today";
                                                                } 
                                                                elseif ($date == $yesterday)
                                                                {
                                                                    echo "Yesterday";
                                                                }
                                                                else
                                                                {
                                                                    echo date('m/d/Y', strtotime($date));
                                                                }
                                                            
                                                            ?>
                                                        </p>
                                                        <small class="help help-sm"><?=count($deposit['invoices'])?> transactions</small>
                                                    </div>
                                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                                        <small class="help help-sm text-end"><?=str_replace('$-', '-$', '$'.number_format($deposit['total'],2))?> <br> Fees: <?=str_replace('$-', '-$', '$'.number_format($deposit['fees'],2))?></small>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse-<?=$index?>" class="accordion-collapse collapse <?=$index > 0 ? '' : 'show'?>">
                                            <div class="accordion-body">
                                                <small class="help help-sm">Batch created: 
                                                    <?php 
                                                        $now = date("Y-m-d");
                                                        $yesterday = date('Y-m-d',strtotime("-1 days"));
                                                        
                                                        if ($date == $now)
                                                        {
                                                            echo "Today";
                                                        } 
                                                        elseif ($date == $yesterday)
                                                        {
                                                            echo "Yesterday";
                                                        }
                                                        else
                                                        {
                                                            echo date('m/d/Y', strtotime($date));
                                                        }
                                                    
                                                    ?>
                                                </small>
                                                <small class="help help-sm float-end text-end">Net amount: <?=str_replace('$-', '-$', '$'.number_format($deposit['total'] - $deposit['fees'], 2))?> </small>
                                                <!-- <br>
                                                <small class="help help-sm">Deposit ID: 6095509905</small>
                                                <small class="help help-sm float-end text-end">REGIONS BANK (...1234) </small> -->
                                                <br>

                                                <table class="nsm-table">
                                                    <thead>
                                                        <td>Customer</td>
                                                        <td>Account Name</td>
                                                        <td>Payment Method</td>
                                                        <td>Reference No.</td>
                                                        <td>nSmarTrac Record</td>
                                                        <td>Fees</td>
                                                        <td>Amount</td>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($deposit['invoices'] as $invoice) : ?>
                                                        <tr>
                                                            <td><?=$invoice['customer_name'] != '' ? $invoice['customer_name'] : '---';?></td>
                                                            <td><?=$invoice['account_name']?></td>
                                                            <td><?=$invoice['payment_method']?></td>
                                                            <td><?=$invoice['ref_no'] != '' ? $invoice['ref_no'] : 'Not Specified'?></td>
                                                            <td>
                                                                <?php if( $invoice['type'] == 'invoice' ){ ?>
                                                                    <?php if( $invoice['invoice_id'] > 0 ){ ?>
                                                                        <a target="_blank" href="<?php echo base_url('invoice/genview/'.$invoice['invoice_id']) ?>">View Invoice</a>
                                                                    <?php }else{ ?>
                                                                        <a target="_blank" href="<?php echo base_url('invoice') ?>">Missing Invoice Data</a>
                                                                    <?php } ?>
                                                                <?php }else{ ?>
                                                                    Linked Bank Account
                                                                <?php } ?>
                                                            </td>
                                                            <td><?=str_replace('$-', '-$', '$'.number_format($invoice['fees'],2))?></td>
                                                            <td><?=str_replace('$-', '-$', '$'.number_format($invoice['amount'],2))?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $index++; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>