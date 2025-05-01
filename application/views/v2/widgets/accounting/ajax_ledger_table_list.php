<hr />
<div class="row">
    <div class="col-6">
        <div class="nsm-page-buttons primary page-button-container w-100">
            <div class="dropdown d-inline-block">
                <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown" style="width:122px;">
                    <span>More Action <i class='bx bx-fw bx-chevron-down'></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?= url('customer/export_customer_ledger'); ?>"><i class='bx bx-spreadsheet'></i> Export to Excel</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" id="btn-send-email-customer-ledger"><i class='bx bx-envelope' ></i> Send to email</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" id="btn-print-customer-ledger"><i class='bx bx-printer' ></i>Print</a></li>
                </ul>     
            </div>
        </div>
    </div>
    <div class="col-6 text-end">
        <!-- <span class="fw-bold" style="font-size:15px;">BALANCE : $<?= number_format($balance, 2, '.', ','); ?></span> -->
    </div>
</div>

<div class="row">
    <div class="col-6">
        <span class="fw-bold" style="font-size:15px;"><?= $customer_address; ?></span>
    </div>
    <div class="col-6 text-end">
        <span class="fw-bold" style="font-size:15px;">BALANCE : $<?= number_format($balance, 2, '.', ','); ?></span>
    </div>
</div>
<?php if (!empty($ledger)) { ?>
    <table class="nsm-table table-fit" style="font-size:10px;width:130%; overflow: auto;">
        <thead>
            <tr style="font-size:10px !important;">
                <td data-name="No." style="width:5%;">#</td>
                <td data-name="Date" style="width:12%;">Date</td>       
                <td data-name="Description">Description</td>                                
                <td data-name="Income" style="text-align:right;">Invoice</td>
                <td data-name="Payment" style="text-align:right;">Payment</td>                
                <td data-name="Method">Method</td>                                
                <td data-name="Record Date">Record Date</td>                                
                <td data-name="Entry By">Entry By</td>  
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($ledger)) { ?>
            <?php $row = 1; ?>
            <?php foreach($ledger as $key => $value){ ?>
                <?php foreach($value as $ld){ ?>
                    <tr>
                        <td class="show"><?= $row; ?></td>
                        <td class="fw-bold nsm-text-primary show"><?= $key ?></td>
                        <td class="nsm-text-primary show"><?= $ld['description']; ?></td>
                        <td class="show" style="text-align:right;">$<?= number_format($ld['amount'], 2, '.', ','); ?></td>
                        <td class="show" style="text-align:right;">$<?= number_format($ld['payment'], 2, '.', ','); ?></td>                        
                        <td class="nsm-text-primary show"><?= $ld['payment_method']; ?></td>
                        <td class="nsm-text-primary show"><?= strtotime($ld['date_created']) > 0 ? date("m/d/y",strtotime($ld['date_created'])) : '---'; ?></td>
                        <td class="nsm-text-primary show"><?= $ld['user']; ?></td>
                        
                    </tr>                 
                <?php $row++; ?>
                <?php } ?>                            
            <?php } ?>
        <?php } ?>
            <tr>
                <td colspan="3" style="font-weight:bold;">TOTAL</td>
                <td style="text-align:right;font-weight:bold;">$<?= number_format($total_income, 2, '.', ','); ?></td>
                <td style="text-align:right;font-weight:bold;">$<?= number_format($total_payment, 2, '.', ','); ?></td>
                <td style="font-weight:bold;">&nbsp;</td>
                <td style="font-weight:bold;">&nbsp;</td>
                <td style="font-weight:bold;">&nbsp;</td>
            </tr>
        </tbody>
    </table>   
<?php }else { ?>
    <table class="nsm-table table-fit" style="font-size:12px;width:110%; overflow: auto;">
    <tr>
        <td colspan="8">
            <div class="nsm-empty">
                <span>No results found.</span>
            </div>
        </td>
    </tr>
    </table>
<?php } ?>