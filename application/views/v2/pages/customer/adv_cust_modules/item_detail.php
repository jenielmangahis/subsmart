<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Item Details</span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3 h-100 align-items-center justify-content-center">
                <div class="col-12">
                    <?php if(empty($item_details)): ?>
                    <div class="nsm-empty">
                        <i class='bx bx-meh-blank'></i>
                        <span>Item detail is empty.</span>
                    </div>
                    <?php else: ?>
                    <div style="overflow-y: scroll; height: 91px;">
                        <table class="table table-bordered table-striped"  border="1" cellspacing="0" cellpadding="0" style="font-size:12px;">
                            <thead>                                
                            <tr>
                                <th style="background-color: #34203f; color:#ffffff;padding:2px;">Title</th>
                                <th style="background-color: #34203f; color:#ffffff;padding:2px;">Type</th>
                                <th style="background-color: #34203f; color:#ffffff;padding:2px;">Qty</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($item_details as $item) : ?>
                                <tr class="gridrow1" >                                                
                                    <td height="15"   valign="top" ><?= $item->title ?></td>
                                    <td height="15"  valign="top" class="normaltext1" ><?= $item->type ?></td>
                                    <td height="15"  valign="top" ><?= $item->qty ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>