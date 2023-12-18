<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/receipts_modals'); ?>

<style>
    #receiptsReviewed_length {
        display: none;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/receipts_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-1 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by name or conditions">
                        </div> -->
                        <div class="form-group row">
                            <div class="col-sm-7">
                                <select id="receiptsReviewed_showentries" class="form-select form-select">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <label for="receiptsReview_showentries" class="col-sm-3 col-form-label">Entries</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-11 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-upload'></i> Upload
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="receiptsUploadDropzone">Upload from computer</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="googleDriveConnectButton">Upload from Google Drive</a></li>
                            </ul>
                            <button type="button" class="nsm-button" id="receiptForwardingButton">
                                Set up receipt forwarding
                            </button>
                        </div>
                    </div>
                    <div class="col-12-md">
                        <table class="table nsm-table w-100" id="receiptsReviewed">
                        <thead>
                            <tr>
                                <th data-name="Receipt">RECEIPT</th>
                                <th data-name="Created by">CREATED BY</th>
                                <th data-name="Date">DATE</th>
                                <th data-name="Description">DESCRIPTION</th>
                                <th data-name="Amount/Tax">AMOUNT/TAX</th>
                                <th data-name="Linked Record">LINKED RECORD</th>
                                <th data-name="Manage"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count([]) > 0) : ?>
                            <?php foreach([] as $receipt) : ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Copy</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Disable</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else : ?>
                            <tr>
                                <td colspan="19">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>