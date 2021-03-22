<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-money" aria-hidden="true"></i> Top 5 Unpaid Invoices
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
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
</div>

