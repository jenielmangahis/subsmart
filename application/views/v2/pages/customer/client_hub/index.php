<?php include viewPath('v2/includes/header_clienthub'); ?>

<style>
    .nsm-table {
        /*display: none;*/
    }
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }
        table {
        width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
        display: none;
    }
        table.dataTable thead th, table.dataTable thead td {
        padding: 10px 18px;
        border-bottom: 1px solid lightgray;
    }
    table.dataTable.no-footer {
        border-bottom: 0px solid #111; 
        margin-bottom: 10px;
    }
    #CUSTOM_FILTER_DROPDOWN:hover {
        border-color: gray !important; 
        background-color: white !important; 
        color: black !important; 
        cursor: pointer;
    }

    .techs {
        display: flex;
        padding-left: 12px;
    }
    .techs > .nsm-profile {
        border: 2px solid #fff;
        box-sizing: content-box;
        margin-left: -12px;
    }
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
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>
                    </div>
                </div>   

                <div class="row">
                                     
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('v2/includes/footer_clienthub'); ?>
