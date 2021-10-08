<div class="card">
    <div class="card-body hid-desk">
        <div class="col-lg-12 table-responsive">
            <h6>Lead Source</h6>
            <button id="add_ls" class="btn btn-sm btn-primary pull-right sa" title="New Lead Source" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> New Lead Source
            </button>
            <table id="leadsource" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tb_leadsource">
                <?php if(isset($lead_source)) : ?>
                    <?php foreach ($lead_source as $source) : ?>
                        <tr>
                            <td><?= $source->ls_name; ?></td>
                            <td><?= date("d-m-Y h:i A",strtotime($source->date_created)); ?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-default edit-lead-source" data-id="<?= $source->ls_id; ?>" data-name="<?= $source->ls_name; ?>" title="Edit Lead Source" data-toggle="tooltip">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button id="<?= $source->ls_id; ?>" class="btn btn-sm btn-default delete_lead_source">
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