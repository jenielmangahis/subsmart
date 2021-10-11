<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12 table-responsive">
            <h6>Activation Fee</h6>
            <button data-toggle="modal" data-target="#modal_activation_fee" class="btn btn-sm btn-primary pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> New Activation Fee
            </button>
            <table id="activation_fee" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Amount</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($activation_fee)): ?>
                    <?php foreach ($activation_fee as $fee) : ?>
                        <tr>
                            <td>$<?= $fee->amount; ?></td>
                            <td><?= date("d-m-Y h:i A",strtotime($fee->date_created)); ?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-default edit-activation-fee" data-id="<?= $fee->id; ?>" data-amount="<?= $fee->amount; ?>" title="Edit Lead Source" data-toggle="tooltip">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button id="<?= $fee->id; ?>" class="btn btn-sm btn-default delete_activation_fee">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>