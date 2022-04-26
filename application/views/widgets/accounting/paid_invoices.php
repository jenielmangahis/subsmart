
<div class="<?= $class ?>" data-id="<?= $id ?>"  id="widget_<?= $id ?>">
    <div  class="wid_header">
        <i class="fa fa-money" aria-hidden="true"></i> Paid Invoices
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-3" style="padding:5px 10px; height: <?= $rawHeight ?>px;">
                <div class="card-body">
                    <div class="row" id="paidInvoicesBody" style="height:<?= $rawHeight - 50; ?>px; overflow-y: scroll;">
                        <div class="col-lg-12 text-center">
                            <h4>Paid</h4>
                            <h4>$<?= number_format((float)$total_amount_invoice->total,2,'.',','); ?></h4>
                            <h4 class="mt-5"><?= $total_invoice_paid->total; ?></h4>
                            <h6 style="color:gray; font-weight: bold">all time paid invoices</h6>
                        </div>
                    </div>

                    <div class="text-center">
                        <a class="text-info text-center" href="<?= base_url() ?>">See Reports</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

