<div class="modal fade nsm-modal fade" id="modal-import-estimate" tabindex="-1" aria-labelledby="modal-import-estimate_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="frm-quick-add-job-type">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_add_job_type_modal_label">Import Estimate Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-md-12">    
                    <div class="nsm-field-group search" style="max-width:100% !important;">
                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_import_estimate" name="search" value="" placeholder="Search Estimate">
                    </div>
                </div>
                <div id="import-estimate-container"></div>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-import-workorder" tabindex="-1" aria-labelledby="modal-import-workorder_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="frm-quick-add-job-type">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_add_job_type_modal_label">Import Workorder Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-md-12">    
                    <div class="nsm-field-group search" style="max-width:100% !important;">
                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_import_workorder" name="search" value="" placeholder="Search Workorder">
                    </div>
                </div>
                <div id="import-workorder-container"></div>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal fade" id="modal-import-invoice" tabindex="-1" aria-labelledby="modal-import-invoice_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="frm-quick-add-job-type">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="quick_add_job_type_modal_label">Import Invoice Data</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-md-12">    
                    <div class="nsm-field-group search" style="max-width:100% !important;">
                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_import_invoice" name="search" value="" placeholder="Search Invoice">
                    </div>
                </div>
                <div id="import-invoice-container"></div>
            </div>
        </div>
        </form>
    </div>
</div>

<div class="modal fade nsm-modal" id="estimates_import" tabindex="-1" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Select Estimate To Make a Job</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="estimates_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td> Estimate #</td>
                                <td> Job & Customer</td>
                                <td> Date</td>
                                <td> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($estimates)): ?>
                                <?php foreach ($estimates as $estimate): ?>
                                    <?php if ($estimate->status === 'Accepted'): ?>
                                        <tr>
                                            <td><?= $estimate->estimate_number; ?></td>
                                            <td><?= $estimate->job_name; ?></td>
                                            <td><?= date('M d, Y', strtotime($estimate->estimate_date)); ?></td>
                                            <td>
                                                <a href="<?= base_url('job/estimate_job/'. $estimate->id) ?>" id="<?= $estimate->id; ?>" type="button" class="btn btn-sm btn-default">
                                                    <span class="fa fa-briefcase"></span> Convert To Job
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
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