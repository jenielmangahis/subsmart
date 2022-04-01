<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <?php if (isset($qb_info)) : ?>
                    <div class="row">
                        <div class="col-6 grid-mb"></div>
                        <div class="col-6 grid-mb text-end">
                            <div class="nsm-page-buttons page-button-container">
                                <button type="button" class="nsm-button error" onclick="location.href='<?php if (isset($authurl)): echo $authurl; endif; ?>'">
                                    <i class='bx bx-fw bx-extension'></i> Disconnect To Quickbooks
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="nsm-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="Customer">Customer</td>
                                <td data-name="Contact ID">Contact ID</td>
                                <td data-name="Status">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($qb_customers)) :
                            ?>
                                <?php foreach ($qb_customers as $customers) : ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-extension'></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary"><?= $customers->DisplayName ?></td>
                                        <td><?= $customers->Id ?></td>
                                        <td><span class="nsm-badge"><?= $customers->Active ?></span></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            <?php
                            else :
                            ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center" style="height: 70vh;">
                            <div class="d-block text-center">
                                <label class="content-title d-block mb-2 fs-4">Export timesheet entries to Quickbooks</label>
                                <label class="d-block mb-5">
                                    Connect to QuickBooks to link your employees and export timesheet entries.
                                </label>
                                <button class="nsm-button primary" onclick="location.href='<?php if (isset($authurl)): echo $authurl; endif; ?>'">Connect to Quickbooks</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>