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
                                <span id="num-checked"></span> <span> With Selected </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions rules-batch-actions">
                                <li><a class="dropdown-item dropdown-item-delete-rule disabled" href="javascript:void(0);" id="multiDeleteRules">Delete</a></li>
                            </ul>
                        </div>
                        <?php if(checkRoleCanAccessModule('accounting-rules', 'write')){ ?>

                            <!-- <div class="nsm-page-buttons page-button-container">
                                <button type="button" class="nsm-button" id="importRulesLink">
                                    <i class='bx bx-fw bx-import'></i> Import
                                </button>                                
                                <button type="button" class="nsm-button" id="exportButton">
                                    <i class='bx bx-fw bx-export'></i> Export
                                </button>
                                <button type="button" class="nsm-button primary" id="newRuleButton" data-bs-toggle="modal" data-bs-target="#createRules">
                                    <i class='bx bx-fw bx-plus' ></i> Add New
                                </button>
                            </div>-->

                            <div class="btn-group nsm-main-buttons" style="margin-bottom: 5px;">
                                <button type="button" class="btn btn-nsm"  id="newRuleButton" data-bs-toggle="modal" data-bs-target="#createRules"><strong><i class='bx bx-plus' style="position:relative;top:1px;"></i> Rules</strong></button>
                                <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class=""><i class='bx bx-chevron-down' ></i></span>
                                </button>
                                <ul class="dropdown-menu">                                                                    
                                    <li><a class="dropdown-item" href="javascript:void(0);" id="exportButton">Export</a></li>      
                                    <li><a class="dropdown-item" href="javascript:void(0);" id="importRulesLink">Import</a></li>                                                        
                                </ul>
                            </div>                            
                        <?php } ?>
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
                                                <input type="checkbox" name="rule_ids[]" value="<?php echo $rule->id; ?>" id="check-input-rules" class="form-check-input select-one table-select row-select check-input-rules" />
                                            </div>
                                        </td>
                                        <td><?= $rule->rules_name ?></td>
                                        <td><?= $rule->apply_type; ?></td>
                                        <td>
                                            <?php if (!empty($rule->conditions)) { ?>
                                                    <?php foreach ($rule->conditions as $condition) { ?><?php echo $condition . "<br />"; ?><?php } ?>                                            
                                            <?php } else { ?>
                                                No conditions set
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($rule->auto == 1) { ?>
                                                <span class="badge bg-success">Yes</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">No</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($rule->priority == 1) { ?>
                                                <span class="badge bg-success">Yes</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">No</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($rule->is_active == 1) { ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php } else { ?>
                                                <span class="badge bg-warning">Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <?php if(checkRoleCanAccessModule('accounting-rules', 'write')){ ?>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                    </li>                                                    
                                                    <li>
                                                        <a class="dropdown-item dropdown-item-copy-rule copyRule" href="javascript:void(0);" data-rule-name="<?php echo $rule->rules_name; ?>" data-id="<?php echo $rule->id ?>" id="copyRule">Copy</a>
                                                    </li>                                                    
                                                    <li>
                                                        <a class="dropdown-item dropdown-item-disable-rule disableRule" href="javascript:void(0);" data-rule-name="<?php echo $rule->rules_name; ?>" data-id="<?php echo $rule->id ?>" id="disableRule">Disable</a>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if(checkRoleCanAccessModule('accounting-rules', 'delete')){ ?>
                                                    <li>
                                                        <a class="dropdown-item dropdown-item-copy-rule deleteSingleRules" href="javascript:void(0);" data-rule-name="<?php echo $rule->rules_name; ?>" data-id="<?php echo $rule->id ?>" id="deleteSingleRules">Delete</a>
                                                    </li>
                                                    <?php } ?>
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

            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }            

            var rowData = [];
            $(this).find('td:not(:first-child)').each(function(index) {
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
        $('#exportButton').on('click', function() {
            var csvContent = exportTableToCSV();
            if (csvContent) {
                downloadCSV(csvContent);
            }
        });
    });

    $(document).on('change', '#select-all-rules', function(){
        $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
        let total= $('#rulesTable tr:visible input[name="rule_ids[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#rulesTable input[name="rule_ids[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

</script>
<?php include viewPath('v2/includes/footer'); ?>