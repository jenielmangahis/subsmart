<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12 table-responsive">
            <h6>Customer Status</h6>
            <button data-toggle="modal" data-target="#modal_customer_settings" class="btn btn-sm btn-primary pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> Add Status
            </button>
            <table id="customer_status" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($customer_status as $status) { ?>
                    <tr>
                        <td><?= $status->name; ?></td>
                        <td><?= date("m/d/Y",strtotime($status->date_created)); ?></td>
                        <td>
                            <button id="<?= $status->id; ?>" class="btn btn-sm btn-default deleteCustomerStatus">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>