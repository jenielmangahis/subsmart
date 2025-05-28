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
                            <button type="button" id="btn-stage-view" class="btn btn-secondary btn-lg"><i class='bx bx-bar-chart-alt-2 bx-rotate-45'></i></button>
                            <button type="button" id="btn-forecast-view" class="btn btn-secondary btn-active btn-lg"><i class='bx bx-dollar-circle'></i></button>
                            <button type="button" id="btn-archive" class="btn btn-secondary btn-lg"><i class='bx bx-box'></i></button>
                        </div>
                    </div>
                    <div class="col-8 grid-mb text-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary"><i class='bx bx-chevron-left'></i></button>
                            <button type="button" class="btn btn-secondary btn-nsm">Current Month</button>
                            <button type="button" class="btn btn-secondary"><i class='bx bx-chevron-right' ></i></button>
                        </div>
                    </div>
                </div>   
                <div class="row" id="deal-forecast"></div>  
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
<?php include viewPath('v2/pages/customer_deals/js/forecast'); ?>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<?php include viewPath('v2/includes/footer'); ?>