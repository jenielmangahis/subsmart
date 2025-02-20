<?php include viewPath('v2/includes/accounting_header'); ?>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<style>
.row-report-name{
    width:80%;
    display:inline-block;
}
.accordion-body{
    
}

.hoverSelection:hover {
    outline: 1px solid #80808036;
    background: #6a4a860d;
    border-radius: 5px;
}

.headerColor {
    background: #6a4a8624;
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
                <div id="masonryContainer" class="row favorites-item-container">
                <?php foreach ($reportGroups as $reportGroup) { ?>                
                    <div class="<?= $reportGroup->description == 'Favorites' ? 'col-6 mb-3' : 'col-6 mb-3'; ?>">
                        <div class="card">
                            <div class="card-header headerColor"><strong><?php echo $reportGroup->description; ?></strong></div>
                            <div class="card-body">
                                <?php $reportTypesColumns = count($reportGroup->report_types) > 8 ? array_chunk($reportGroup->report_types, ceil(count($reportGroup->report_types) / 2)) : [$reportGroup->report_types]; ?>
                                <?php $favorite = $this->accounting_report_types_model->get_favorite_report_by_report_type_id($reportType->id, logged('company_id')); ?>
                                <div class="row">
                                <?php foreach ($reportTypesColumns as $colRepTypes) { ?>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled m-0">
                                            <?php foreach ($colRepTypes as $reportType) { ?>
                                            <?php $favorite = $this->accounting_report_types_model->get_favorite_report_by_report_type_id($reportType->id, logged('company_id')); ?>
                                            <li class="p-2 cursor-pointer hoverSelection">
                                                <span class="row-report-name" onclick="location.href='<?php echo is_null($reportType->url) ? base_url('/accounting/reports/view-report/'.$reportType->id) : base_url($reportType->url); ?>'"><?php echo $reportType->name; ?>
                                                    <a href="#" style="color: #888888" data-bs-toggle="collapse" data-bs-target="#<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse" aria-expanded="false" aria-controls="<?php echo str_replace(' ', '-', strtolower($reportGroup->description)); ?>-<?php echo $reportType->id; ?>-collapse">
                                                        <i class="bx bx-info-circle report-help-popover" data-toggle="popover" data-bs-content="<?= $reportType->description; ?>"></i>
                                                    </a>
                                                </span>

                                                <div class="dropdown float-end d-inline-block" style="min-width: 23px; min-height: 1px">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" style="color: #888888">
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
                                                <a href="#" data-id="<?php echo $reportType->id; ?>" class="float-end <?php echo is_null($favorite) ? 'add-to-favorites' : 'remove-from-favorites'; ?>" style="color: <?php echo is_null($favorite) ? '#888888' : '#408854'; ?>">
                                                    <i class="bx bx-fw <?php echo is_null($favorite) ? 'bx-checkbox' : 'bxs-check-square'; ?>"></i>

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
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    var masonry = new Masonry(document.getElementById('masonryContainer'), {percentPosition: true,});

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