<?php include viewPath('v2/includes/header_clienthub'); ?>

<style>
    .nsm-profile {
        --size: 35px;
        max-width: var(--size);
        height: var(--size);
        min-width: var(--size);
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_portal_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Your personal information.
                        </div>
                    </div>
                </div>   

                <div class="row">
                    <div class="col-md-6">
                        <?php include viewPath('v2/pages/customer/client_hub/_customer_info_a'); ?>            
                    </div>
                    <div class="col-md-6">
                        <?php include viewPath('v2/pages/customer/client_hub/_customer_info_b'); ?>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer_clienthub'); ?>
