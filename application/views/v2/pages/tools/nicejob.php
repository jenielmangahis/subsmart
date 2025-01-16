<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<style>
.nj-trust__gravatar{
    color: red !important;
    font-size: 40px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nj-badge" data-show-reviews="1"></div>
                    <div class="nj-engage" data-position="left"></div>
                    <a href="https://nicejob.com/nsmartrac/invite" class="nj-review">Leave us a review!</a>      
                    <script type="text/javascript" src="https://cdn.nicejob.co/js/sdk.min.js?id=5148370948849664" defer></script>                    
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="nsm-empty page-empty">
                    <i class='bx bx-smile'></i>
                    <label class="content-title mb-2">Coming Soon!</label>
                    <label class="content-subtitle d-block mb-2">Open sidebar to see more available pages.</label>                                        
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {});
</script>
<?php include viewPath('v2/includes/footer'); ?>