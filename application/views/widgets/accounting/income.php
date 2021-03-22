<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-money" aria-hidden="true"></i> Income
        <a href="#" class="float-right text-light">Last 365 Days</a>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
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
</div>

