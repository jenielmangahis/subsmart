<?php include viewPath('v2/includes/header'); ?>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer_deals') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            Customer deals are your ongoing conversations with people and organizations with whom you have already established a relationship.
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4 grid-mb">
                        <div class="btn-group view-style-container" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" id="btn-stage-view" class="btn btn-secondary btn-lg btn-active"><i class='bx bx-bar-chart-alt-2 bx-rotate-45'></i></button>
                            <!-- <button type="button" id="btn-list-view" class="btn btn-secondary btn-lg"><i class='bx bx-list-ul'></i></button> -->
                            <button type="button" id="btn-forecast-view" class="btn btn-secondary btn-lg"><i class='bx bx-dollar-circle'></i></button>
                            <button type="button" id="btn-archive" class="btn btn-secondary btn-lg"><i class='bx bx-box'></i></button>
                        </div>
                    </div>
                    <div class="col-8 grid-mb text-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-nsm" id="btn-new-deal"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Deal</button>
                            <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class=""><i class='bx bx-chevron-down' ></i></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" id="btn-add-new-stage" href="javascript:void(0);">Add Stages</a></li>                                
                                <li><a class="dropdown-item" id="btn-add-new-lost-reason" href="javascript:void(0);">Add Lost Reason</a></li>                                
                            </ul>
                        </div>
                    </div>
                </div>                
                <input type="hidden" id="customer-deal-modal-name" value="" />
                <div class="row" id="deal-stages"></div> 
                <div class="row mt-4" id="customer-deal-lost-container" style="display:none;">
                    <div class="col-md-4">
                        <div id="customer-deal-lost" ><h3>LOST</h3></div>
                    </div>
                    <div class="col-md-4">
                        <div id="customer-deal-won" ><h3>WON</h3></div>
                    </div>
                    <div class="col-md-4">
                        <div id="customer-deal-delete" ><h3>DELETE</h3></div>
                    </div>

                </div>     
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/customer_deals/modals'); ?>
<?php include viewPath('v2/pages/customer_deals/js/customer_deals'); ?>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<?php include viewPath('v2/includes/footer'); ?>