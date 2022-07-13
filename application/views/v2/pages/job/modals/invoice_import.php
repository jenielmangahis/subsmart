<div class="modal fade" id="invoice_import" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select Invoice To Make a Job</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="invoices_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Invoice #</td>
                                <td> Job Name</td>
                                <td> Date</td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($invoices)): ?>
                                <?php foreach ($invoices as $invoice): ?>
                                    <tr>
                                        <td><?= $invoice->invoice_number; ?></td>
                                        <td><?= $invoice->job_name; ?></td>
                                        <td><?= date('M d, Y', strtotime($invoice->date_issued)); ?></td>
                                        <td>
                                            <button id="<?= $invoice->customer_id; ?>" type="button" data-bs-dismiss="modal" class="btn btn-sm btn-default invoice_select">
                                                <span class="fa fa-plus"></span>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
