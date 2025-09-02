<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/expenses_modals'); ?>
<!-- ================ -->
<?php include viewPath('v2/pages/accounting/check/libraries'); ?>
<?php include viewPath('v2/pages/accounting/check/check.css'); ?>
<?php include viewPath('v2/pages/accounting/check/check.js'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/expenses'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Manage your outgoing check payments with ease using the Check module. Just enter payee details, the amount, and a memo to quickly generate and print checks for vendors, payroll, and other expenses.
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="float-start d-flex align-items-center gap-2">
                            <input class="form-control checkTableSearch mt-0" type="text" placeholder="Search...">
                            <select class="form-select checkShowEntries">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="float-end d-flex align-items-center gap-2 mb-2">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="checkBatchActions" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                    Batch Actions&ensp;<i class="fas fa-caret-down text-muted"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="checkBatchActions">
                                    <li><a class="dropdown-item checkBatchPrint" href="javascript:void(0);">Print</a></li>
                                    <li><a class="dropdown-item checkBatchVoid" href="javascript:void(0);">Void</a></li>
                                    <li><a class="dropdown-item checkBatchDelete" href="javascript:void(0);">Delete</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-light checkAdd" type="button"><i class="fas fa-plus text-muted"></i>&ensp;Add New</button>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="checkSettings" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="checkSettings">
                                    <li><a class="dropdown-item checkExportPDF" href="javascript:void(0);">Export as .pdf</a></li>
                                    <li><a class="dropdown-item checkExportXLSX" href="javascript:void(0);">Export as .xlsx</a></li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-bordered checkTable w-100">
                            <thead style="background: #00000008;">
                                <tr>
                                    <th class="width0"><input class="form-check-input checkSelectAll" type="checkbox"></th>
                                    <th>Payee</th>
                                    <th>Date</th>
                                    <th>Check No.</th>
                                    <!-- <th>Method</th> -->
                                    <th class="categoryColumn">Category</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <!-- <th>Balance</th> -->
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="width0"><i class="fas fa-paperclip text-muted"></i></th>
                                    <th class="width0"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade checkAddModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-modal="true"  role="dialog">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body pt-3"></div>
        </div>
    </div>
</div>
<div class="modal fade checkEditModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-modal="true"  role="dialog">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body pt-3"></div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer'); ?>