<?php include viewPath('v2/includes/accounting_header'); ?>
<style>
.accordion-body{
    min-height:224px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reports_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            CRM reporting helps businesses in a few key ways: It can helps you distill what is happening
                            in your business, a key advantage of deploying a CRM. Your data will help provides different
                            ways to make strategic business decisions. Your management team can track performance and
                            make tactical changes where necessary.
                        </div>
                    </div>
                </div>
                <div class="row g-3 grid-mb favorites-item-container">
                <?php foreach ($reportGroups as $reportGroup) { ?>                
                    <div class="col-6">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse-<?php echo $reportGroup->id; ?>" aria-expanded="true"
                                        aria-controls="collapse-<?php echo $reportGroup->id; ?>">
                                        <?php echo $reportGroup->description; ?>
                                    </button>
                                </h2>
                                <div id="collapse-<?php echo $reportGroup->id; ?>"
                                    class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <?php $reportTypesColumns = count($reportGroup->report_types) > 4 ? array_chunk($reportGroup->report_types, ceil(count($reportGroup->report_types) / 2)) : [$reportGroup->report_types]; ?>
                                            <?php foreach ($reportTypesColumns as $colRepTypes) { ?>
                                            <div class="col-12 col-md-6">
                                                <ul class="list-unstyled m-0">
                                                    <?php foreach ($colRepTypes as $reportType) { ?>
                                                    <?php $favorite = $this->accounting_report_types_model->get_favorite_report_by_report_type_id($reportType->id, logged('company_id')); ?>
                                                    <li class="p-3 cursor-pointer">
                                                        <span
                                                            onclick="location.href='<?php echo is_null($reportType->url) ? base_url('/accounting/reports/view-report/'.$reportType->id) : base_url($reportType->url); ?>'"><?php echo $reportType->name; ?></span>
                                                        <a href="#" style="color: #888888" data-bs-toggle="collapse"
                                                            data-bs-target="#<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse"
                                                            aria-expanded="false"
                                                            aria-controls="<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse">
                                                            <i class="bx bx-fw bx-help-circle report-help-popover" data-toggle="popover" data-bs-content="<?= $reportType->description; ?>"></i>
                                                        </a>

                                                        <div class="dropdown float-end d-inline-block"
                                                            style="min-width: 23px; min-height: 1px">                                                            
                                                            <a href="#" class="dropdown-toggle"
                                                                data-bs-toggle="dropdown" style="color: #888888">
                                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <?php if ($reportType->customizable) { ?>
                                                                    <li><a class="dropdown-item" href="#">Customize</a></li>
                                                                <?php } ?>
                                                                <li><a class="dropdown-item btn-add-to-management-reports" href="javascript:void(0);" data-name="<?= $reportType->name; ?>" data-id="<?= $reportType->id; ?>">Add to Management Reports</a></li>
                                                            </ul>                                                            
                                                        </div>
                                                        <?php if ($reportType->favoritable === '1') { ?>
                                                        <a href="#" data-id="<?php echo $reportType->id; ?>"
                                                            class="float-end <?php echo is_null($favorite) ? 'add-to-favorites' : 'remove-from-favorites'; ?>"
                                                            style="color: <?php echo is_null($favorite) ? '#888888' : '#408854'; ?>">
                                                            <i
                                                                class="bx bx-fw <?php echo is_null($favorite) ? 'bx-star' : 'bxs-star'; ?>"></i>
                                                        </a>
                                                        <?php } ?>

                                                      
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>                
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.report-help-popover').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus"
    }); 

    $('.btn-add-to-management-reports').on('click', function(){
        var rid = $(this).attr('data-id');
        var report_name = $(this).attr('data-name');
        var url = base_url + 'accounting/reports/_add_to_management_reports';

        Swal.fire({
            title: 'Management Reports',
            html: `Proceed with adding <b>${report_name}</b> report to management report list?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {rid:rid},
                    dataType:'json',
                    success: function(result) {
                        if( result.is_success == 1 ) {
                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Report was successfully updated',
                            }).then((result) => {
                                //window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.msg,
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>