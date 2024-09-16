<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/accounting'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reconcile_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            When you open your chart of accounts, you'll see a long list of accounts. These are known as account histories. Each account has its own account history.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Filter by name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="filter-account">Account</label>
                                        <select class="nsm-field form-select filter-account" name="filter_account" id="filter-account">
                                            <option value="all">All</option>
                                            <?php foreach($this->chart_of_accounts_model->select() as $row) : ?>
                                                <?php $is_selected = $row->id == $selected_account ? 'selected="selected"' : ''; ?>
                                                <option <?php echo $is_selected; ?>value="<?=$row->id?>"><?=$row->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <!-- <div class="col-12">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
                                            <option value="all-dates" selected="selected">All Dates</option>
                                            <option value="since-365-days-ago">Since 365 DaysAgo</option>
                                        </select>
                                    </div> -->
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="reconHistoryByAccount">
                    <thead>
                        <tr>
                            <td data-name="Account">ACCOUNT</td>
                            <td data-name="Statement Ending Date">STATEMENT ENDING DATE</td>
                            <td data-name="Ending Balance">ENDING BALANCE</td>
                            <td data-name="Chrg">CHRG</td>
                            <td data-name="Memo Sc">MEMO SC</td>
                            <td data-name="Memo It">MEMO IT</td>
                            <td data-name="Action">ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($rows) > 0) { ?>
                            <?php foreach($rows as $row) { ?>
                                <tr>
                                    <td><?php echo $row->expense_account; ?></td>
                                    <td>
                                        <?php //echo $row->ending_date; ?>
                                        <?php 
                                            if( strtotime($row->ending_date) > 0 ){
                                                echo date("m/d/Y", strtotime($row->ending_date));
                                            }else{
                                                echo '--';
                                            }
                                        ?>                                         
                                    </td>
                                    <td><?php echo number_format($row->ending_balance,2); ?></td>
                                    <td><?php echo $row->CHRG; ?></td>
                                    <td><?php echo $row->memo_sc; ?></td>
                                    <td><?php echo $row->memo_it; ?></td>
                                    <td><?php echo $row->action; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Statement Ending Date">STATEMENT ENDING DATE</td>
                            <td data-name="Reconciled On">RECONCILED ON</td>
                            <td data-name="Ending Balance">ENDING BALANCE</td>
                            <td data-name="Changes">CHANGES</td>
                            <td data-name="Auto Adjustment">AUTO ADJUSTMENT</td>
                            <td data-name="Statements">STATEMENTS</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#reconHistoryByAccount").nsmPagination({
            itemsPerPage: 10
        });

        $( ".filter-account" ).on( "change", function() {
            var account_type = $("#filter-account").val();
            var url = base_url + 'accounting/reconcile/view/history-by-account?account_type=' + account_type;
            window.location.href = url
        });        
    });    
</script>
<?php include viewPath('v2/includes/footer'); ?>