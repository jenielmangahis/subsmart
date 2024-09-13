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
                            If you are having mismatched figures and they don't tally with your bank then reconciliation will be the only option left. In order to print your reconciliation summary report, you first need to create one.
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 grid-mb text-center">
                        <h3>nSmarTrac</h3>
                        <h6>RECONCILIATION SUMMARY</h6>
                    </div>
                </div>
                <table class="nsm-table" id="reconSummary">
                    <thead>
                        <tr>
                            <td data-name="Account">ACCOUNT</td>
                            <td data-name="chrg">CHRG</td>
                            <td data-name="Memo Sc">MEMO SC</td>
                            <td data-name="Memo It">MEMO IT</td>
                            <td data-name="Ending Balance" align="right">ENDING BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($rows) > 0) { ?>
                            <?php foreach($rows as $row) { ?>
                                <tr>
                                    <td><?php echo $row->expense_account; ?></td>
                                    <td><?php echo $row->CHRG; ?></td>
                                    <td><?php echo $row->memo_sc; ?></td>
                                    <td><?php echo $row->memo_it; ?></td>
                                    <td align="right"><?php echo number_format($row->ending_balance,2); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4">
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
                            <td data-name="Account">ACCOUNT</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Statement Ending Data">STATEMENT ENDING DATE</td>
                            <td data-name="Reconciled On">RECONCILED ON</td>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td colspan="4">
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
        $("#reconSummary").nsmPagination({
            itemsPerPage: 10
        });
    });    
</script>

<?php include viewPath('v2/includes/footer'); ?>