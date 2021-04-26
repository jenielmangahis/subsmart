<div class="card">
    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Existing Notes</h6>
    </div>
    <div class="card-body">
        <?php if(isset($customer_notes)) :?>
            <div class="row">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tbody>
                    <?php foreach ($customer_notes as $note) : ?>
                        <tr>
                            <td style="width: 880px; text-align: left; vertical-align: top; font-size: 11px; color: #336699">
                                <?= $note->datetime; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; border: 1px; border-style: solid; border-color: #999999; background-color: #FFFF71; font-size: 11px">
                                <?= $note->note; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="card-header">
        <span style="position: absolute;right: 0;margin-right: 25px;font-size: 20px;padding-top:10px;" class="fa fa-ellipsis-v"></span>

        <h6 ><span class="fa fa-user"></span>&nbsp; &nbsp;Devices</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Sold by</td>
                    <td>Points</td>
                    <td>Retail Cost</td>
                    <td>Purchase Price</td>
                    <td>Qty</td>
                    <td>Total Points</td>
                    <td>Total Cost</td>
                    <td>Total Purcahse Price</td>
                    <td>Net</td>
                </tr>

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
</div>