<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #40c057; color:white;">
            <i class="fa fa-money" aria-hidden="true"></i> Paid Invoices
        </div>
        <div class="card-body">
            <div class="row" id="paidInvoicesBody" style="height:<?= $rawHeight-20; ?>px; overflow-y: scroll;">
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

