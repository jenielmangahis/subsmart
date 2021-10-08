<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12 table-responsive">
            <h6>Sales Area</h6>
            <button data-toggle="modal" data-target="#modal_sales_area" class="btn btn-sm btn-primary pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> New Sales Area
            </button>
            <table id="salesarea" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sales_area as $sa) { ?>
                    <tr>
                        <td><?= $sa->sa_name; ?></td>
                        <td><?= date("d-m-Y h:i A",strtotime($sa->date_created)); ?></td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-sm btn-default edit-sales-area" data-id="<?= $sa->sa_id; ?>" data-name="<?= $sa->sa_name; ?>" title="Edit Sales Area" data-toggle="tooltip">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <button id="<?= $sa->sa_id; ?>" class="btn btn-sm btn-default delete_sales_area">
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