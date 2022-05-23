<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #40c057; color:white;">
            <i class="fa fa-money" aria-hidden="true"></i> Income
            <a href="#" class="float-right text-light">Last 365 Days</a>
        </div>
        <div class="card-body">
            <div class="row" id="incomeBody" style="<?= $height; ?> overflow-y: scroll; padding:40px;">
                <div class="con-inner-container">
                    <div class="con-bar">
                        <div class="open-invoices box-invoices-bar"></div>
                        <div class="paid-invoices box-invoices-bar"></div>
                    </div>
                    <div class="con-data-label">
                        <div class="con-label">3</div>
                        <div class="con-sub-label">Open invoices</div>
                        <div class="con-label">0</div>
                        <div class="con-sub-label">Overdue invoices</div>
                        <div class="con-label">0</div>
                        <div class="con-sub-label">Paid last 30 days</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

