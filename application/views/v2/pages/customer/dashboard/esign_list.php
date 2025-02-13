<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<style>
.dataTables_filter, .dataTables_length{
    display: none;
}
.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button name="button"><i class='bx bx-x'></i></button>
                            Electronic signatures, or e-signatures, are transforming the ways companies do business. Not only do they eliminate the hassle of manually routing paper agreements, but they also dramatically speed up the signature and approval process. Implementing e-signatures into your existing workflows is easier than you think. Explore all various tools.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="custom-esign-searchbar" name="search" placeholder="Search" value="">
                        </div>
                    </div>
                </div>

                <div class="tab-content mt-4">
                    
                    <table class="nsm-table" id="esign-list-table">
                        <thead>
                            <tr>
                                <td class="table-icon"></td>
                                <td data-name="EstimateNumber">Template Name</td>       
                                <td data-name="Date" style="width:15%;">Subject</td>
                                <td data-name="Date" style="width:10%;">Status</td>
                                <td data-name="Status" style="width:8%;">Date Created</td>
                                <td data-name="Status" style="width:8%;">Last Changed</td>                                                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($docfiles)) { ?>
                                <?php foreach ($docfiles as $docfile) { ?>
                                <tr>
                                    <td style="width:1%;">
                                        <div class="table-row-icon">
                                            <i class='bx bx-file'></i>
                                        </div>
                                    </td>
                                    <td class="fw-bold nsm-text-primary"><?= $docfile->name; ?></td>     
                                    <td class="nsm-text-primary"><?= $docfile->subject; ?></td> 
                                    <td class="nsm-text-primary"><?= $docfile->status; ?></td> 
                                    <td class="nsm-text-primary"><?php echo date('m/d/Y', strtotime($docfile->created_at)); ?></td>
                                    <td class="nsm-text-primary"><?php echo date('m/d/Y', strtotime($docfile->updated_at)); ?></td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>
<script>
$(document).ready(function() {
    var esignListTable = $("#esign-list-table").DataTable({
        "ordering": false,
        language: {
            processing: '<span>Fetching data...</span>'
        }     
    });

    $("#custom-esign-searchbar").keyup(function() {
        esignListTable.search($(this).val()).draw()
    });
});
</script>