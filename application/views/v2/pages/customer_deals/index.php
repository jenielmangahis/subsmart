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
                    <div class="col-4 grid-mb text-end">
                        <div class="nsm-field-group search form-group" style="display:block;max-width:600px;">
                            <form id="frm-list-search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search-list" value="" placeholder="Search List..." style="width:92%; display:inline-block;" required>                            
                                <button class="nsm-button primary" id="btn-search-list" type="submit"><i class='bx bx-search-alt-2'></i></button>
                            </form>
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
                            </ul>
                        </div>
                    </div>
                </div>                
                <div class="row" id="deal-stages"></div>            
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/customer_deals/modals'); ?>
<?php include viewPath('v2/pages/customer_deals/js/customer_deals'); ?>
<?php include viewPath('v2/includes/footer'); ?>