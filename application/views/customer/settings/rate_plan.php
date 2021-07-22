<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12 table-responsive">
            <h6>Rate Plan</h6>
            <button data-toggle="modal" data-target="#modal_rate_plan" class="btn btn-sm btn-primary pull-right sa" title="Add Sales Area" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> New Rate Plan
            </button>
            <table id="rate_plan" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Plan Name</th>
                    <th>Amount</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($rate_plans)): ?>
                    <?php foreach ($rate_plans as $rate) : ?>
                        <tr>
                            <td><?= $rate->plan_name; ?></td>
                            <td>$<?= $rate->amount; ?></td>
                            <td><?= date("d-m-Y h:i A",strtotime($rate->date_created)); ?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-default edit-rate-plan" data-id="<?= $rate->id; ?>" data-amount="<?= $rate->amount; ?>"  title="Edit Rate Plan" data-name="<?= $rate->plan_name; ?>" data-toggle="tooltip">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button id="<?= $rate->id; ?>" class="btn btn-sm btn-default delete_rate_plan">
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