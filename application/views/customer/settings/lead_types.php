<div class="card">
    <div class="card-body hid-desk">
        <div class="col-lg-12 table-responsive">
            <h6>Lead Types</h6>
            <button id="add_ls" data-toggle="modal" data-target="#modal_lead_type"  class="btn btn-sm btn-default pull-right" title="New Lead Type" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> New Lead Type
            </button>
            <table id="leadtype" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tb_leadsource">
                <?php if(isset($lead_types)) : ?>
                    <?php foreach ($lead_types as $lead_type) : ?>
                        <tr>
                            <td><?= $lead_type->lead_name; ?></td>
                            <td>
                                <a href="" class="btn btn-sm btn-default" title="Edit Lead Type" data-toggle="tooltip">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <button id="<?= $lead_type->lead_id; ?>" class="btn btn-sm btn-default delete_leadtype" title="Delete Lead Type" data-toggle="tooltip">
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