<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #40c057; color:white;">
            <i class="fa fa-money" aria-hidden="true"></i> Top 5 Unpaid Invoices
        </div>
        <div class="card-body">
            <div class="row" id="unpaidInvoicesBody" style="height:<?= $rawHeight; ?>px; overflow-y: scroll;">
                <table class="table table-bordered table-stripped">
                    <tr>
                        <th style="font-weight: bold; color:gray;" class="col-lg-6 text-left">Customer</th>
                        <th style="font-weight: bold; color:gray;" class="text-right">Value</th>
                        <th style="font-weight: bold; color:gray;">Overdue</th>
                    </tr>
                    <tr>
                        <td>Juan Dela Cruz</td>
                        <td class="text-right">$ 400.00</td>
                        <td>2 days</td>
                    </tr>
                    <tr>
                        <td>Maria Clara</td>
                        <td class="text-right">$ 800.00</td>
                        <td>3 days</td>
                    </tr>
                    <tr>
                        <td>Chrisostomo Ibarra</td>
                        <td class="text-right">$ 1000.00</td>
                        <td>5 days</td>
                    </tr>
                    <tr>
                        <td>Micheal Victor</td>
                        <td class="text-right">$ 1000.00</td>
                        <td>6 days</td>
                    </tr>
                    <tr>
                        <td>Robert Fox</td>
                        <td class="text-right">$ 1200.00</td>
                        <td>7 days</td>
                    </tr>
                </table>
            </div>


        </div>

    </div>
</div>

