<div class="row">
    <div class="text-left">
        <h1 for=""><?php echo ucwords(str_replace('_', ' ', $type)) ?> for <br><?php echo getLoggedName();?></h1>
        <?php if($type != "customer_source") : ?>
        <h3><?php echo $startDate ?> to <?php echo $endDate ?></h3>
        <?php endif;?>
    </div>
    <?php if ($orientation == "landscape") : ?>
        <img class="img-logo" src="assets/dashboard/images/logo.png" alt="" style="left:610; top:10; position:absolute; z-index:1;">
    <?php else :?>
        <img class="img-logo" src="assets/dashboard/images/logo.png" alt="" style="left:380; top:10; position:absolute; z-index:1;">
    <?php endif;?>
</div>
<div data-report="table">
    <?php if ($type === "monthly_closeout" || $type === "yearly_closeout") : ?>
    <table class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Month</th>
                <th class="text-right"># of Estimates</th>
                <th class="text-right">Estimated</th>
                <th class="text-right">Accepted</th>
                <th class="text-right"># of Invoices</th>
                <th class="text-right">Invoiced</th>
                <th class="text-right">Paid</th>
                <th class="text-right">Due</th>
                <th class="text-right"># of Expenses</th>
                <th class="text-right">Total Expense</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $item) : ?>
                <tr>
                    <td><?php echo $item[0] ?></td>
                    <td class="text-right"><?php echo $item[1] ?></td>
                    <td class="text-right"><?php echo $item[2] ?></td>
                    <td class="text-right"><?php echo $item[3] ?></td>
                    <td class="text-right"><?php echo $item[4] ?></td>
                    <td class="text-right"><?php echo $item[5] ?></td>
                    <td class="text-right"><?php echo $item[6] ?></td>
                    <td class="text-right"><?php echo $item[7] ?></td>
                    <td class="text-right"><?php echo $item[8] ?></td>
                    <td class="text-right"><?php echo $item[9] ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "profit_loss") : ?>
    <table class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Name</th>
                <th class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bold">Revenue</td>
                <td class="bold text-right"><span id="profitLossRevenue"><?php echo $data[0] ?></span></td>
            </tr>
            <tr>
                <td><span class="margin-left-sec">Invoices Paid</span></td>
                <td class="text-right"><span id="profitLossInvoice"><?php echo $data[1] ?></span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="bold">Expenses</td>
                <td class="bold text-right"><span id="profitLossExpenses"><?php echo $data[2] ?></span></td>
            </tr>
                    <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="bold">Net Profit</td>
                <td class="bold text-right"><span id="profitLossNetProfit"><?php echo $data[3] ?></span></td>
            </tr>
        </tbody>
    </table>
    <?php elseif($type === "payments_type_summary") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Month</th>
                <th class="text-right">Total Sales</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
            <?php if (substr($item[0], -1) == '0' || $item[0] == "Total") : ?>
                <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                    <td style='padding:10px;'><?php echo $item[0] ?></td>
                    <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                </tr>
            <?php else :?>
                <tr>
                    <td style='padding:10px;'><?php echo $item[0] ?></td>
                    <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                </tr>
            <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "payments_received") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th>Month / Customer</th>
                <th>Paid Date</th>
                <th>Details</th>
                <th>Payment Method</th>
                <th class="text-right">Total Sales</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if (substr($item[0], -1) == '0' || $item[0] == "Total") : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?></td>
                <td style='padding:10px;'><?php echo $item[2] ?></td>
                <td style='padding:10px;'><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?></td>
                <td style='padding:10px;'><?php echo $item[2] ?></td>
                <td style='padding:10px;'><?php echo $item[3] ?></td>
                <?php if ($item[3] == '') : ?>
                <td style='padding:10px; font-weight:bold;' class="text-right"><?php echo $item[4] ?></td>
                <?php else :?>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
                <?php endif;?>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "account_receivable") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Month</th>
                <th class="text-left-td"># of Invoices</th>
                <th class="text-right">Invoiced</th>
                <th class="text-right">Paid</th>
                <th class="text-right">Due</th>
                <th class="text-right">Tip</th>
                <th class="text-right">Fees</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if (substr($item[0], -6, 1) == ',') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[5] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[6] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?><br><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[5] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[6] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[7] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "commercial_vs_residential") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th></th>
                <th class="border-right"></th>
                <th colspan="6" class="text-center border-right">Commercial</th>
                <th colspan="6" class="text-center">Residential</th>
            </tr>
            <tr>
                <th>Month</th>
                <th class="border-right"></th>
                <th class="text-right">#Inv</th>
                <th class="text-right">Invoiced</th>
                <th class="text-right">Paid</th>
                <th class="text-right">Due</th>
                <th class="text-right">Tip</th>
                <th class="text-right border-right">Fees</th>
                <th class="text-right">#Inv</th>
                <th class="text-right">Invoiced</th>
                <th class="text-right">Paid</th>
                <th class="text-right">Due</th>
                <th class="text-right">Tip</th>
                <th class="text-right">Fees</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if (substr($item[0], -6, 1) == ',') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td ><?php echo $item[0] ?></td>
                <td class="border-right"></td>
                <td class="text-right"><?php echo $item[1] ?></td>
                <td class="text-right"><?php echo $item[2] ?></td>
                <td class="text-right"><?php echo $item[3] ?></td>
                <td class="text-right"><?php echo $item[4] ?></td>
                <td class="text-right"><?php echo $item[5] ?></td>
                <td class="text-right border-right"><?php echo $item[6] ?></td>
                <td class="text-right"><?php echo $item[7] ?></td>
                <td class="text-right"><?php echo $item[8] ?></td>
                <td class="text-right"><?php echo $item[9] ?></td>
                <td class="text-right"><?php echo $item[10] ?></td>
                <td class="text-right"><?php echo $item[11] ?></td>
                <td class="text-right"><?php echo $item[12] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td ><?php echo $item[0] ?></td>
                <td class="border-right"><?php echo $item[1] ?><br><?php echo $item[2] ?></td>
                <td class="text-right"><?php echo $item[3] ?></td>
                <td class="text-right"><?php echo $item[4] ?></td>
                <td class="text-right"><?php echo $item[5] ?></td>
                <td class="text-right"><?php echo $item[6] ?></td>
                <td class="text-right"><?php echo $item[7] ?></td>
                <td class="text-right border-right"><?php echo $item[8] ?></td>
                <td class="text-right"><?php echo $item[9] ?></td>
                <td class="text-right"><?php echo $item[10] ?></td>
                <td class="text-right"><?php echo $item[11] ?></td>
                <td class="text-right"><?php echo $item[12] ?></td>
                <td class="text-right"><?php echo $item[13] ?></td>
                <td class="text-right"><?php echo $item[14] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "sales_summary_by_customer") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Customer</th>
                <th class="text-left-td">Type</th>
                <th class="text-right">Invoices Paid #</th>
                <th class="text-right">Payments #</th>
                <th class="text-right">Total Sales</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
            <?php if ($item[0] == "Total") : ?>
            <tr style="font-weight:bold">
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><strong><?php echo $item[4] ?></strong></td>
            </tr>
            <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><strong><?php echo $item[4] ?></strong></td>
            </tr>
            <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "invoice_by_date") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Date</th>
                <th class="text-left-td"># of Invoices</th>
                <th class="text-right">Invoiced</th>
                <th class="text-right">Paid</th>
                <th class="text-right">Due</th>
                <th class="text-right">Tip</th>
                <th class="text-right">Fees</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if ($item[2] == '') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?><br><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[5] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[6] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[7] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;'><?php echo $item[1] ?><br><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[5] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[6] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[7] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "sales_by_customer_groups") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Customer Group</th>
                <th class="text-right">Payments #</th>
                <th class="text-right">Total Sales</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if ($item[0] == 'Total') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "sales_by_customer_source") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left">Source</th>
                <th class="text-right">Residential #</th>
                <th class="text-right">Residential Invoiced</th>
                <th class="text-right">Commercial #</th>
                <th class="text-right">Commercial Invoiced</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if ($item[0] == 'Total') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "estimate-status-by-month") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left">Date</th>
                <th class="text-right">Estimate #</th>
                <th class="text-right">Type</th>
                <th class="text-right">Due</th>
                <th class="text-right">Fees</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if ($item[0] == 'Total') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[4] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php elseif($type === "customer_source") : ?>
    <table id="tableToListReport" class="table table-hover table-to-list">
        <thead>
            <tr>
                <th class="text-left-td">Source</th>
                <th class="text-right">Customer Count (total)</th>
                <th class="text-right">Residential Count</th>
                <th class="text-right">Commercial Count</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $item) : ?>
        <?php if ($item[0] == 'Total') : ?>
            <tr style='background-color:#ededed; font-weight:bold; padding:10px;'>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
            </tr>
        <?php else :?>
            <tr>
                <td style='padding:10px;'><?php echo $item[0] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[1] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[2] ?></td>
                <td style='padding:10px;' class="text-right"><?php echo $item[3] ?></td>
            </tr>
        <?php endif;?>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
    <br>
    <hr style="border-color:#eaeaea;">
    <p style="color:#888; font: 14px; font-family: Sans-Serif;">
        Report generated on <?php echo date("d M Y") ?> through nSmartrac.
    </p>
</div>

<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
}
.text-right {
    text-align: right;
}

.border-right {
    border-right: 1px solid #dee2e6 !important;
}

.text-left-td {
    text-align: left;
}

.text-left {
    text-align: left;
    font-family: Sans-Serif;
    font-weight: 800;
    font: 14px;
}   

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, {
    padding: 6px;
    padding-top: 0px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    font: 14px;
    font-family: Sans-Serif;
}

.table > thead > tr > th {
    padding: 4px;
    padding-top: 0px;
    line-height: 1.42857143;
    vertical-align: top;
    font: 14px;
    font-family: Sans-Serif;
}

.img-logo {
    width: 200px;
    padding-top:20px;
}

.row {
    display: flex;
}
</style>