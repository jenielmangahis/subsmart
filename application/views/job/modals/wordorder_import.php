<!-- Word Order Modal -->
<div class="modal fade" id="workorder_import" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select WorkOrder To Make a Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="workorder_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> WorkOrder #</td>
                                <td> Job Name</td>
                                <td> Date</td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($workorders)): ?>
                                <?php foreach ($workorders as $workorder): ?>
                                    <tr>
                                        <td><?= $workorder->work_order_number; ?></td>
                                        <td><?= $workorder->job_name; ?></td>
                                        <td><?= !empty($workorder->date_created) ? date('M d, Y', strtotime($workorder->date_created)) : ''; ?></td>
                                        <td>
                                            <button id="<?= $workorder->id; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default workorder_select">
                                                <span class="fa fa-plus"></span> Convert to Job
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
            <div class="modal-footer modal-footer-detail">
                <div class="button-modal-list">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
