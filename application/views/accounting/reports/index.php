<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    #myTabContent a.remove-from-favorites {
        color: #28a745;
    }

    #myTabContent a.remove-from-favorites:hover, #myTabContent a.remove-from-favorites:focus {
        color: #6c757d;
    }

    #myTabContent a.remove-from-favorites:hover i::before, #myTabContent a.remove-from-favorites:focus i::before {
        content: "\f006";
    }

    #myTabContent a.add-to-favorites {
        color: #6c757d;
    }

    #myTabContent a.add-to-favorites:hover, #myTabContent a.add-to-favorites:focus {
        color: #28a745;
    }

    #myTabContent a.add-to-favorites:hover i::before, #myTabContent a.add-to-favorites:focus i::before {
        content: "\f005";
    }

    #myTabContent a.collapse-toggle:not(.collapsed) span.rotate-icon {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Reports</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/reports')?>" class="banking-tab-active text-decoration-none">Standard</a>
                                    <a href="<?php echo url('/accounting/reports/custom')?>" class="banking-tab">Custom Reports</a>
                                    <a href="<?php echo url('/accounting/reports/management')?>" class="banking-tab">Management Reports</a>
                                    <a href="<?php echo url('/accounting/reports/activities')?>" class="banking-tab">Activities Reports</a>
                                    <a href="<?php echo url('/accounting/reports/analytics')?>" class="banking-tab">Analytics</a>
                                    <a href="<?php echo url('/accounting/reports/payscale')?>" class="banking-tab">PayScale</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <?php foreach($reportGroups as $reportGroup) : ?>
                                <div id="<?=str_replace(' ', '-', strtolower($reportGroup->description))?>">
                                    <div class="card p-0">
                                        <div class="card-header p-4">
                                            <a href="#<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-collapse" class="card-link h5 text-dark collapse-toggle" data-toggle="collapse" aria-expanded="true">
                                                <span class="fa fa-chevron-right rotate-icon"></span>
                                                <span class="pl-3"><?=$reportGroup->description?></span>
                                            </a>
                                        </div>
                                        <div class="collapse p-3 show" id="<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-collapse" data-parent="#<?=str_replace(' ', '-', strtolower($reportGroup->description))?>" style="background-image: url(<?=assets_url($reportGroup->icon_link)?>); background-repeat: no-repeat; background-position: right bottom;">
                                            <div class="row">
                                                <?php $reportTypesColumns = count($reportGroup->report_types) > 8 ? array_chunk($reportGroup->report_types, ceil(count($reportGroup->report_types) / 2)) : [$reportGroup->report_types]; ?>
                                                <?php foreach($reportTypesColumns as $colRepTypes) : ?>
                                                <div class="col-md-5">
                                                    <ul class="list-unstyled">
                                                        <?php foreach($colRepTypes as $reportType) : ?>
                                                            <?php $favorite = $this->accounting_report_types_model->get_favorite_report_by_report_type_id($reportType->id, logged('company_id'));?>
                                                            <li class="border-bottom p-3 cursor-pointer">
                                                                <a href="<?=is_null($reportType->url) ? '/accounting/reports/view-report/'.$reportType->id : $reportType->url?>" class=" font-weight-normal"><?=$reportType->name?></a>
                                                                <a href="#<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-<?=$reportType->id?>-collapse" data-toggle="collapse" aria-expanded="false" class="collapse-toggle pl-1 text-secondary h6 position-relative top-1">
                                                                    <i class="fa fa-question-circle-o "></i>
                                                                </a>
                                                                <div class="dropdown pull-right d-inline-block" style="min-width: 4px; min-height: 1px">
                                                                    <?php if($reportType->customizable) : ?>
                                                                    <span type="button" data-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v fa-lg"></i>
                                                                    </span>
                                                                    <ul class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                                        <li><a href="#" class="dropdown-item">Customize</a></li>
                                                                    </ul>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <?php if($reportType->favoritable === "1") : ?>
                                                                <a href="#" data-id="<?=$reportType->id?>" class="pr-4 h6 pull-right <?=is_null($favorite) ? 'add-to-favorites' : 'remove-from-favorites'?>">
                                                                    <i class="fa <?=is_null($favorite) ? 'fa-star-o' : 'fa-star'?> fa-lg"></i>
                                                                </a>
                                                                <?php endif; ?>
                                                                <div class="collapse py-3" id="<?=str_replace(' ', '-', strtolower($reportGroup->description))?>-<?=$reportType->id?>-collapse">
                                                                    <p class="m-0"><?=$reportType->description?></p>
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
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>


<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>