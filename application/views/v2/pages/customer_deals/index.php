<?php include viewPath('v2/includes/header'); ?>
<style>
.deal-stage-container .text-muted{
    font-size:11px !important;
}
.btn-nsm, .btn-nsm:hover{
    background-color:#6a4a86;
    color:#ffffff;
}
.btn-edit-deal-stage i, .btn-delete-deal-stage i{
    font-size:25px;
}   
.select2-selection--multiple .select2-search__field{
    width:auto !important;
}
.stage-quick-add-deal-btn{
    display:block;
    width:100%;   
    font-size:15px; 
}
.stage-create-deal-container{
    display:block;
    height:50px;
    width:100%;
}
.stage-deal-name{
    font-size:16px;
    font-weight:bold;
}
.stage-deal-title-container{
    display:block;
    margin-bottom:6px;
}
.stage-deals-actions a:hover{
    cursor:pointer !important;
}
.btn-edit-deal-stage, .btn-delete-deal-stage{
    color:#6a4a86 !important;
}
#view-customer-deals-container .bg-primary {
    background-color: #6a4a86 !important;
}
#view-customer-deals-container .card-header {
    color:#ffffff;
}
#view-customer-deals-container .bg-primary .card-body {
    background-color: #f7f7f9;
}
#view-customer-deals-container .details {
    list-style: none;
    padding: 0px;
    margin: 0px;
}
#view-customer-deals-container .details li {
    font-size: 17px;
    display: inline-block;
    width: 49%;
    margin-bottom: 0px;
    vertical-align: top;
}
.customer-deals-view-details .label{
    font-weight:bold;
    font-size:15px;
}
.view-customer-deals-actions button{
    display:inline-block;
    width:92px;
}
.view-customer-deals-actions i{
    position: relative;
    top: 1px;
}

.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center
}

.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 40px;
    text-align: center
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}

.steps .step .step-icon-wrap::before {
    left: 0
}

.steps .step .step-icon-wrap::after {
    right: 0
}

.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 40px;
    height: 40px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 23px;
    line-height: 40px !important;
    z-index: 5
}

.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.steps .step:first-child .step-icon-wrap::before {
    display: none
}

.steps .step:last-child .step-icon-wrap::after {
    display: none
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
    background-color: #6a4a86
}

.steps .step.completed .step-icon {
    border-color: #6a4a86;
    background-color: #6a4a86;
    color: #fff
}

@media (max-width: 576px) {
    .flex-sm-nowrap .step .step-icon-wrap::before,
    .flex-sm-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 768px) {
    .flex-md-nowrap .step .step-icon-wrap::before,
    .flex-md-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 991px) {
    .flex-lg-nowrap .step .step-icon-wrap::before,
    .flex-lg-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 1200px) {
    .flex-xl-nowrap .step .step-icon-wrap::before,
    .flex-xl-nowrap .step .step-icon-wrap::after {
        display: none
    }
}
#view-customer-deals-container .card-header i{
    position:relative;
    top:2px;
}
#customer-deal-lost{
    display:block;
    color:#721c24;
    /* background-color:#f8d7da; */
    padding:10px;
    text-align:center;
    border-style: dashed;
}
#customer-deal-won{
    display:block;
    color:#155724;
    /* background-color:#d4edda; */
    padding:10px;
    text-align:center;
    border-style: dashed;
}
.lost-container {
    border-style: solid !important;
    background-color:#f8d7da;
}
.won-container {
    border-style: solid !important;
    background-color:#d4edda;
}
.deal-stage-summary{
    font-weight:bold;
}
.btn-create-schedule-activity{
    display: block;
    border: none;
    font-size: 16px;
    padding: 5px;
    margin: 0px;
}
.autocomplete-container {
    position: relative;
}
.activity-card{
    border-top:1px solid #dee2e6;
    padding:11px;
    z-index:8000;
}
.activity-name{
    font-weight:bold;
}
.activity-notes{
    display:block;
    margin-top:5px;
    background-color:#e2e3e5 !important;
    border-color:#d6d8db;
    color:#383d41;
    padding:5px;
    border-radius:6px;
}
.activity-overdue-text{
    color:#f95754;
}
.activity-schedule{
    font-size:12px;
}
.activity-today{
    color:#155724;
}
.activity-card:hover{
    background-color:#005ce6;
    border-color:#005ce6;
    color:#ffffff !important;
    cursor:pointer;
}
.activity-card:hover span{
    color:#ffffff !important;
}
.opt-done-container{
    display: flex;
    align-items: center;
    justify-content: center;
    z-index:9999;
}
.opt-done-container #flexRadioDefault1:hover{
    cursor:pointer;
}
.btn-activity-scheduled-with-overdue{
    background-color:#f95754;
    border-color:#f95754;
}
.btn-activity-scheduled-with-overdue i{
    color:#ffffff !important;
}
.select-label-action-buttons a{
    color:#ffffff;
}
.view-style-container a{
    margin:0px;
}
.view-style-container .btn-active{
    background-color: #6a4a86 !important;
    color: #ffffff !important;
}
</style>
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
                            Track your customer deals
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-4 grid-mb">
                        <!-- <div class="btn-group view-style-container" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-secondary btn-lg btn-active"><i class='bx bx-bar-chart-alt-2'></i></button>
                            <button type="button" class="btn btn-secondary btn-lg"><i class='bx bx-dollar-circle' ></i></button>
                        </div> -->
                    </div>
                    <div class="col-8 grid-mb text-end">
                        <div class="btn-group">
                            <button type="button" class="btn btn-nsm" id="btn-new-deal"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Deal</button>
                            <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class=""><i class='bx bx-chevron-down' ></i></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" id="btn-add-new-stage" href="javascript:void(0);">Add Stages</a></li>                                
                            </ul>
                        </div>
                    </div>
                </div>                
                <input type="hidden" id="customer-deal-modal-name" value="" />
                <div class="row" id="deal-stages"></div> 
                <div class="row mt-4" id="customer-deal-lost-container" style="display:none;">
                    <div class="col-md-6">
                        <div id="customer-deal-lost" ><h3>LOST</h3></div>
                    </div>
                    <div class="col-md-6">
                        <div id="customer-deal-won" ><h3>WON</h3></div>
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