<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

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
                <table class="nsm-table">
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
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>