<div class="<?= $class ?>"  data-id="<?= $id ?>" id="widget_<?= $id ?>">
    <div class="wid_header">
        <i class="fa fa-money" aria-hidden="true"></i> Top 5 Unpaid Invoices
        
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
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="unpaidInvoicesBody" style="height:<?= $rawHeight; ?>px; overflow-y: scroll; padding:20px;">
                    <table class="table table-bordered table-stripped">
                        <tr>
                            <th style="font-weight: bold; color:gray;" class="col-lg-6 text-left">Customer</th>
                            <th style="font-weight: bold; color:gray;" class="text-right">Value</th>
                            <th style="font-weight: bold; color:gray;">Overdue</th>
                        </tr>
                        <tr>
                            <td><strong>INV-0001</strong><br /><small class="text-success">Juan Dela Cruz</small></td>
                            <td class="text-right">$ 400.00</td>
                            <td>2 days</td>
                        </tr>
                        <tr>
                            <td><strong>INV-0002</strong><br /><small class="text-success">Maria Clara</small></td>
                            <td class="text-right">$ 800.00</td>
                            <td>3 days</td>
                        </tr>
                        <tr>
                            <td><strong>INV-0003</strong><br /><small class="text-success">Chrisostomo Ibarra</small></td>
                            <td class="text-right">$ 1000.00</td>
                            <td>5 days</td>
                        </tr>
                        <tr>
                            <td><strong>INV-0004</strong><br /><small class="text-success">Micheal Victor</small></td>
                            <td class="text-right">$ 1000.00</td>
                            <td>6 days</td>
                        </tr>
                        <tr>
                            <td><strong>INV-0005</strong><br /><small class="text-success">Robert Fox</small></td>
                            <td class="text-right">$ 1200.00</td>
                            <td>7 days</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

