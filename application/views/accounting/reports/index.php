<?php include viewPath('v2/includes/accounting_header'); ?>

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
                            CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.
                        </div>
                    </div>
                </div>
                
                <?php foreach($reportGroups as $reportGroup) : ?>
                <div class="row g-3 grid-mb">
                    <div class="col-12">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?=$reportGroup->id?>" aria-expanded="true" aria-controls="collapse-<?=$reportGroup->id?>">
                                        <?=$reportGroup->description?>
                                    </button>
                                </h2>
                                <div id="collapse-<?=$reportGroup->id?>" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <?php $reportTypesColumns = count($reportGroup->report_types) > 8 ? array_chunk($reportGroup->report_types, ceil(count($reportGroup->report_types) / 2)) : [$reportGroup->report_types]; ?>
                                            <?php foreach($reportTypesColumns as $colRepTypes) : ?>
                                            <div class="col-12 col-md-5">
                                                <ul class="list-unstyled m-0">
                                                    <?php foreach($colRepTypes as $reportType) : ?>
                                                    <?php $favorite = $this->accounting_report_types_model->get_favorite_report_by_report_type_id($reportType->id, logged('company_id'));?>
                                                    <li class="border-bottom p-3 cursor-pointer">
                                                        <span onclick="location.href='<?=is_null($reportType->url) ? base_url('/accounting/reports/view-report/'.$reportType->id) : base_url($reportType->url)?>'"><?=$reportType->name?></span>
                                                        <a href="#" style="color: #888888" data-bs-toggle="collapse" data-bs-target="#<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-<?=$reportType->id?>-collapse" aria-expanded="false" aria-controls="<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-<?=$reportType->id?>-collapse">
                                                            <i class="bx bx-fw bx-help-circle"></i>
                                                        </a>

                                                        <div class="dropdown float-end d-inline-block" style="min-width: 23px; min-height: 1px">
                                                            <?php if($reportType->customizable) : ?>
                                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" style="color: #888888">
                                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item" href="#">Customize</a>
                                                                </li>
                                                            </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                        <?php if($reportType->favoritable === "1") : ?>
                                                        <a href="#" data-id="<?=$reportType->id?>" class="float-end <?=is_null($favorite) ? 'add-to-favorites' : 'remove-from-favorites'?>" style="color: <?=is_null($favorite) ? '#888888' : '#408854'?>">
                                                            <i class="bx bx-fw <?=is_null($favorite) ? 'bx-star' : 'bxs-star'?>"></i>
                                                        </a>
                                                        <?php endif; ?>
                                                        <div class="accordion-collapse collapse" id="<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-<?=$reportType->id?>-collapse">
                                                            <div class="accordion-body">
                                                                <p class="m-0"><?=$reportType->description?></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>