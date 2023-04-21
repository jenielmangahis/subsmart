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
                            <button id="<?= $status->id; ?>" class="btn btn-sm btn-primary updateCustomerStatus" data-toggle="modal" data-target="#updateStatusModal" data-statusid="<?php echo $status->id;; ?>" data-statusname="<?php echo $status->name;; ?>"><i class='bx bxs-edit'></i> Update</button>
                            <button id="<?= $status->id; ?>" class="btn btn-sm btn-danger deleteCustomerStatus"><i class='bx bxs-trash-alt'></i> Delete</button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="updateStatusModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Update Status</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="updateStatusForm">
                    <div class="row">
                        <div class="col-md-12 mb-3 d-none">
                            <h6>Status ID</h6>
                            <input class="form-control" type="text" name="statusID" readonly required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6>Status Name</h6>
                            <input class="form-control" type="text" name="statusName" required>
                        </div>
                        <div class="col-md-12">
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary" data-action="approve">Update</button>
                                <button type="button" class="nsm-button" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>