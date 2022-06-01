<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3 align-items-start">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>API Keys</span>
                                </div>
                                <label class="nsm-subtitle">Set the keys for API Integrations.</label>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                        <input type="text" placeholder="API Key" name="api_key" class="nsm-field form-control" value="" autocomplete="off"/>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" placeholder="API Secret Key" name="secret_key" class="nsm-field form-control" value="" autocomplete="off"/>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" placeholder="Redirect URL" name="redirect_url" class="nsm-field form-control" value="" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>