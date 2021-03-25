<!--<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #40c057; color:white;">
            <i class="fa fa-money" aria-hidden="true"></i> Paid Invoices
        </div>
        <div class="card-body">
            <div class="row" id="paidInvoicesBody" style="height:<?= $rawHeight - 20; ?>px; overflow-y: scroll;">
                <div class="col-lg-12 text-center">
                    <h4>Paid</h4>
                    <h4>$1,180,000</h4>
                    <h4 class="mt-5">1811</h4>
                    <h6 style="color:gray; font-weight: bold">all time paid invoices</h6>
                </div>
            </div>

            <div class="text-center">
                <a class="text-info text-center" href="<?= base_url() ?>">See Reports</a>
            </div>

        </div>

    </div>
</div>-->
<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
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
            <div class="card-body mt-3" style="padding:5px 10px; height: 300px;">
                <div class="card-body">
                    <div class="row" id="paidInvoicesBody" style="height:<?= $rawHeight - 20; ?>px; overflow-y: scroll;">
                        <div class="col-lg-12 text-center">
                            <h4>Paid</h4>
                            <h4>$1,180,000</h4>
                            <h4 class="mt-5">1811</h4>
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

