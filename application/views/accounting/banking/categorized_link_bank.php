<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/link_bank_modals'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
<style>
    tr.hide-table-padding td {
        padding: 0;
    }

    svg#svg-sprite-menu-close {
        position: relative;
        bottom: 178px !important;
    }

    .nav-close {
        margin-top: 52% !important;
    }

    .bank-img-container img {
        width: auto !important;
    }

    .btn {
        border-radius: 0 !important;
    }

    .card {
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }

    label>input {
        visibility: visible !important;
        position: inherit !important;
    }

    .fdx-entity-container {
        display: flex;
        flex: 1 1 auto;
        justify-content: center;
        max-width: 98%;
    }

    .fdx-recommended-entity-desc-container {
        height: 40px;
        display: flex;
        -moz-align-items: flex-start;
        align-items: flex-start;
        justify-content: center;
        -moz-flex-direction: column;
        flex-direction: column;
        margin: auto 100px;
        box-sizing: border-box;
        overflow: hidden;
        flex: 1 1;
    }

    .fdx-recommended-entity-name {
        width: 100%;
        height: 24px;
        font-weight: 600;
        font-size: 16px;
        padding-bottom: 4px;
        -webkit-margin-before: 0;
        margin-block-start: 0;
        -webkit-margin-after: 0;
        margin-block-end: 0;
        text-align: left;
        margin-bottom: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        cursor: inherit;
        white-space: nowrap;
        box-sizing: border-box;
    }

    .fdx-recommended-entity-desc {
        min-height: 18px;
        font-size: 12px;
        -webkit-margin-before: 0px;
        margin-block-start: 0px;
        -webkit-margin-after: 0px;
        margin-block-end: 0px;
        text-align: left;
        color: #6b6c72;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 400;
        cursor: inherit;
    }

    .fdx-provider-logo {
        width: 100%;
        height: auto;
    }

    .fdx img {
        border: 0;
    }

    .fdx img {
        background: transparent !important;
    }

    .fdx-provider-logo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
</style>
<?php
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //'assets/frontend/css/workorder/main.css',
    // 'assets/css/beforeafter.css',
));
?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/link_bank_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When you connect an account, accounting will automatically downloads and categorizes bank and credit card transactions for you.
                            It enters the details so you don't have to enter transactions manually. All you have to do is approve the work.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by name or conditions">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="delete">Delete</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="disable">Disable</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="enable">Enable</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" id="importRulesLink">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button" id="newRuleButton" data-bs-toggle="modal" data-bs-target="#createRules">
                                <i class='bx bx-fw bx-list-plus'></i> New Rule
                            </button>
                            <button type="button" class="nsm-button" id="exportButton">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <li>
                                    <p class="m-0">Columns</p>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" data-col="col-conditions" class="form-check-input col-checkbox" id="chk_conditions">
                                        <label for="chk_conditions" class="form-check-label">Conditions</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" data-col="col-settings" class="form-check-input col-checkbox" id="chk_settings">
                                        <label for="chk_settings" class="form-check-label">Settings</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" data-col="col-status" class="form-check-input col-checkbox" id="chk_status">
                                        <label for="chk_status" class="form-check-label">Status</label>
                                    </div>
                                </li>
                                <li>
                                    <p class="m-0">Page Size</p>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="radio" checked="checked" name="page_size" id="page-size-50" class="form-check-input">
                                        <label for="page-size-50" class="form-check-label">50</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="radio" name="page_size" id="page-size-75" class="form-check-input">
                                        <label for="page-size-75" class="form-check-label">75</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="radio" name="page_size" id="page-size-100" class="form-check-input">
                                        <label for="page-size-100" class="form-check-label">100</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="radio" name="page_size" id="page-size-200" class="form-check-input">
                                        <label for="page-size-200" class="form-check-label">200</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="radio" name="page_size" id="page-size-300" class="form-check-input">
                                        <label for="page-size-300" class="form-check-label">300</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <th class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </th>
                            <th class="col-priority" data-name="Priority">PRIORITY</th>
                            <th class="col-rule-name" data-name="Rule Name">RULE NAME</th>
                            <th class="col-applied-to" data-name="Applied To">APPLIED TO</th>
                            <th class="col-conditions" data-name="Conditions">CONDITIONS</th>
                            <th class="col-settings" data-name="Settings">SETTINGS</th>
                            <th class="col-auto-add" data-name="Auto Add">AUTO ADD</th>
                            <th class="col-status" data-name="Status">STATUS</th>
                            <th class="col-manage" data-name="Manage"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count([]) > 0) : ?>
                            <?php foreach ([] as $rule) : ?>
                                <tr>
                                    <td>
                                        <div class="table-row-icon table-checkbox">
                                            <input class="form-check-input select-one table-select" type="checkbox">
                                        </div>
                                    </td>
                                    <td class="col-priority"></td>
                                    <td class="col-rule-name"></td>
                                    <td class="col-applied-to"></td>
                                    <td class="col-conditions"></td>
                                    <td class="col-settings"></td>
                                    <td class="col-auto-add"></td>
                                    <td class="col-status"></td>
                                    <td class="col-manage">
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
<script>
    $(function() {
        $('#importRulesLink').on('click', function() {
            $('#importRules').modal('show');
        });
    });

    function exportTableToCSV() {
        var headers = ['PRIORITY', 'RULE NAME', 'APPLIED TO', 'CONDITIONS', 'SETTINGS', 'AUTO ADD', 'STATUS'];

        var csvContent = "data:text/csv;charset=utf-8,";

        csvContent += headers.join(",") + "\r\n";

        return encodeURI(csvContent);
    }

    function downloadCSV(csvContent) {
        var link = document.createElement("a");
        link.setAttribute("href", csvContent);
        link.setAttribute("download", "link_bank_data.csv");
        document.body.appendChild(link);
        link.click();
    }

    $(document).ready(function() {
        $('#exportButton').on('click', function() {
            var csvContent = exportTableToCSV();
            downloadCSV(csvContent);
        });
    });

    const colCheckboxes = document.querySelectorAll('.col-checkbox');

    colCheckboxes.forEach(element => {
        element.checked = true;
        element.addEventListener('change', (event) => {
            const checked = event.target.checked;
            const colName = element.getAttribute('data-col');

            hideShowTableCol(colName, checked)
        });
    });

    function hideShowTableCol(colName, checked) {
        const cells = document.querySelectorAll(`.${colName}`);
        cells.forEach(cell => {
            cell.style.display = (checked) ? 'table-cell' : 'none';
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>