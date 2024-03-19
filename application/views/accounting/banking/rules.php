<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/rules_modals'); ?>
<style>
    .custom-badge {
        font-size: 14px;
    }

    .nsm-badge.danger {
        background-color: #dc3545;
        color: #ffffff;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/banking'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The more you uses your bank rules, the better it gets at categorizing. After a while, it can even scan transactions and add details like payees. Step 1: Create a bank rule. Go to the Banking menu or Transactions menu. Then select the Rules tab. Select New rule. Enter a name in the Rule field. From the drop-down, select Money in or Money out. Simply acknowledge and our accounting platform will remember your selection for that particular entry for the next time. Saving you time and money.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <form action="<?php echo base_url('accounting/rules') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Search by name or conditions" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions rules-batch-actions">
                                <li><a class="dropdown-item dropdown-item-delete-rule disabled" href="javascript:void(0);" id="multiDeleteRules">Delete</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" id="importRulesLink">
                                <i class='bx bx-fw bx-import'></i> Import
                            </button>
                            <button type="button" class="nsm-button" id="newRuleButton" data-bs-toggle="modal" data-bs-target="#createRules">
                                <i class='bx bx-fw bx-list-plus'></i> New Rule
                            </button>
                            <button type="button" class="nsm-button" id="exportRules">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <!-- <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_conditions" id="chk_conditions" class="form-check-input">
                                    <label for="chk_conditions" class="form-check-label">Conditions</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_settings" id="chk_settings" class="form-check-input">
                                    <label for="chk_settings" class="form-check-label">Settings</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_status" id="chk_status" class="form-check-input">
                                    <label for="chk_status" class="form-check-label">Status</label>
                                </div>
                                <p class="m-0">Page Size</p>
                                <div class="form-check">
                                    <input type="radio" checked="checked" name="page_size" id="page-size-50" class="form-check-input">
                                    <label for="page-size-50" class="form-check-label">50</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-75" class="form-check-input">
                                    <label for="page-size-75" class="form-check-label">75</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-100" class="form-check-input">
                                    <label for="page-size-100" class="form-check-label">100</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-200" class="form-check-input">
                                    <label for="page-size-200" class="form-check-label">200</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="page_size" id="page-size-300" class="form-check-input">
                                    <label for="page-size-300" class="form-check-label">300</label>
                                </div>
                            </ul> -->
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="rulesTable">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select select-all-rules" id="select-all-rules" type="checkbox">
                            </td>
                            <td data-name="Rule Name">RULE NAME</td>
                            <td data-name="Applied To">APPLIED TO</td>
                            <td data-name="Conditions">CONDITIONS</td>
                            <td data-name="Auto Add">AUTO ADD</td>
                            <td data-name="Priority">PRIORITY</td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <form id="rulesTblFrm" class="rulesTblFrm">
                            <?php if (count($rules) > 0) : ?>
                                <?php foreach ($rules as $rule) : ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon table-checkbox">
                                                <input type="checkbox" name="rule_ids[]" value="<?php echo $rule->id; ?>" id="check-input-rules" class="form-check-input select-one table-select check-input-rules" />
                                            </div>
                                        </td>
                                        <td><?= $rule->rules_name ?></td>
                                        <td><?= $rule->apply_type; ?></td>
                                        <td>
                                            <?php if (!empty($rule->conditions)) { ?>
                                                <ul>
                                                    <?php foreach ($rule->conditions as $c) { ?>
                                                        <li><?= $c; ?></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } else { ?>
                                                No conditions set
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($rule->auto == 1) { ?>
                                                <span class="nsm-badge success custom-badge">Yes</span>
                                            <?php } else { ?>
                                                <span class="nsm-badge danger custom-badge">No</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($rule->priority == 1) { ?>
                                                <span class="nsm-badge success custom-badge">Yes</span>
                                            <?php } else { ?>
                                                <span class="nsm-badge danger custom-badge">No</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($rule->is_active == 1) { ?>
                                                <span class="nsm-badge success custom-badge">Active</span>
                                            <?php } else { ?>
                                                <span class="nsm-badge custom-badge">Inactive</span>
                                            <?php } ?>
                                        </td>
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
                                                        <a class="dropdown-item dropdown-item-copy-rule copyRule" href="javascript:void(0);" data-rule-name="<?php echo $rule->rules_name; ?>" data-id="<?php echo $rule->id ?>" id="copyRule">Copy</a>
                                                    </li>
                                                    <li>

                                                        <a class="dropdown-item dropdown-item-disable-rule disableRule" href="javascript:void(0);" data-rule-name="<?php echo $rule->rules_name; ?>" data-id="<?php echo $rule->id ?>" id="disableRule">Disable</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item dropdown-item-copy-rule deleteSingleRules" href="javascript:void(0);" data-rule-name="<?php echo $rule->rules_name; ?>" data-id="<?php echo $rule->id ?>" id="deleteSingleRules">Delete</a>
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
                        </form>
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
        var tableData = [];

        var headers = ['RULE NAME', 'APPLIED TO', 'CONDITIONS', 'AUTO ADD', 'PRIORITY', 'STATUS'];

        tableData.push(headers);

        $('#rulesTable tbody tr').each(function() {
            var rowData = [];
            $(this).find('td:not(:first-child)').each(function(index) { // Exclude the first column (checkbox column)
                if (index < headers.length) {
                    rowData.push($(this).text().trim());
                }
            });
            tableData.push(rowData);
        });

        if (tableData.length === 1) {
            alert("No data to export.");
            return;
        }

        var csvContent = "data:text/csv;charset=utf-8,";
        tableData.forEach(function(rowArray) {
            var row = rowArray.join(",");
            csvContent += row + "\r\n";
        });

        return encodeURI(csvContent);
    }

    function downloadCSV(csvContent) {
        var link = document.createElement("a");
        link.setAttribute("href", csvContent);
        link.setAttribute("download", "rules_data.csv");
        document.body.appendChild(link);
        link.click();
    }

    $(document).ready(function() {
        $('#exportRules').on('click', function() {
            var csvContent = exportTableToCSV();
            if (csvContent) {
                downloadCSV(csvContent);
            }
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>