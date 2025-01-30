<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<style>
    #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
    .search-customer-container{
        display:block;
        float:right;
        margin-top:10px;
        margin-bottom:10px;
    }
    #customer-add-advance .nsm-card{
        margin-top:10px;
    }
    #customer-add-advance .btn-small{
        display:inline-block;
        margin:5px 0px;
    }
    .customer-inputs .form-control, .customer-inputs .select2, .customer-inputs .input-group-text{
        margin:2px 0px !important;
    }
    .customer-inputs .input-group-text{
        border-radius: .25rem .25rem 0px 0.25rem;
        position: relative;
        left: 1px;
    }
    .btn-fixed-width{
        width:18% !important;
    }
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('customer/add_lead') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>
<div id="overlay">
    <div>
        <img src="<?=base_url()?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p>Processing...</p></center></div>
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
                            <button><i class='bx bx-x'></i></button>
                            This powerful module widget will help you gather and customized each field information you like to gather from each customer. 
                            Each fields can be group into categories to smoothly log the entries of each customer.
                        </div>
                        <div class="search-customer-container" style="width:450px;">
                            <select class="" id="search-customer" style="width: 100%"></select>
                        </div>
                    </div>
                </div>
                <form id="customer_form">
                    <div class="row g-3 align-items-start" id="customer-add-advance">
                        <?php if( in_array(logged('company_id'), adi_company_ids()) ){ ?>
                            <div class="col-12 col-md-12">
                                <div class="row">
                                    <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_papers'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 customer-inputs">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_profile'); ?>
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_property'); ?>
                            </div>
                            <div class="col-md-4 customer-inputs">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_office_info'); ?>
                            </div>
                            <div class="col-md-4 customer-inputs">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_alarm_info'); ?>
                            </div>
                        <?php }else{ ?>                            
                            <div class="col-md-6 customer-inputs">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_profile_non_adi'); ?>
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_office_info_no_funding'); ?>
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_property'); ?>
                            </div>
                            <div class="col-md-6 customer-inputs">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_billing_info'); ?>
                            </div>
                            <div class="col-md-4 customer-inputs">
                                <?php include viewPath('v2/pages/customer/advance_customer_forms/customer_other_info'); ?>
                            </div>
                        <?php } ?>
                        
                        <div class="col-md-12">
                            <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />
                            <input type="hidden" value="<?php if(isset($billing_info)){ echo $billing_info->bill_method; } ?>" class="form-control" name="default_bill_method" id="default_bill_method" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include viewPath('v2/pages/customer/advance_customer_forms/quick_add_modal_forms'); ?>
</div>

<!-- <div class="modal duplicateWarningModal" data-bs-backdrop="static" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title content-title" style="font-size: 17px;"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<span class="modalTitle">Duplicate Found!</span></div>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p><span class="customerNameType"></span> <strong class="duplicateCustomer"></strong> was already exist in the customer's list.</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive duplicateEntryTable">
                            
                        </div>
                    </div>
                </div>
                <hr class="mt-0 g-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-end">
                            <button type="button" class="nsm-button normal" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<script src="<?= base_url("assets/js/v2/printThis.js") ?>"></script>
<?php include viewPath('v2/includes/footer'); ?>
    <script >
    window.document.addEventListener("DOMContentLoaded", () => {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        const $section = document.querySelector(`[data-section=${params.section}]`);
        if ($section) {
            const $header = document.getElementById("topnav");
            const sectionRect = $section.getBoundingClientRect();
            const headerRect = $header.getBoundingClientRect();
            window.scroll({top: ((sectionRect.top + window.scrollY) - headerRect.height * 2), behavior: "smooth"});
            $section.classList.add("active-section");
        }
    });

    $(function(){
        $('.btn-cancel').on('click', function(){
            location.href = base_url + 'customer';
        });
        <?php if($profile_info){ ?>
        $('.btn-view-subscription').on('click', function(){
            location.href = base_url + 'customer/subscription/<?= $profile_info->prof_id; ?>';
        });
        <?php } ?>
        $('#search-customer').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Search Customer',            
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        $('#search-customer').on('change', function(){
            var selected = $(this).val();
            location.href = base_url + 'customer/module/' + selected;
        });

        function formatRepoCustomerSelection(repo) {
            if( repo.first_name != null ){
                return repo.first_name + ' ' + repo.last_name;      
            }else{
                return repo.text;
            }
        }

        function formatRepoCustomer(repo) {
            if (repo.loading) {
                return repo.text;
            }
            var $container = $(
                '<div class="contact-acro">'+repo.acro+'</div><div class="contact-info"><i class="bx bx-user-pin"></i> '+repo.first_name + ' ' + repo.last_name+'<br><small><i class="bx bx-mobile"></i> '+repo.phone_m+' / <i class="bx bx-envelope"></i> '+repo.email+'</div>'
            );
            return $container;
        }
    });
</script>
<style>
.active-section {
    transition: background-color 0.3s;
    animation: active-section 0.5s 2;
}
@keyframes active-section {
  0%, 49% { background-color: transparent; }
  50%, 100% { background-color: #e4e4e4; }
}
</style>
<?php include viewPath('v2/pages/customer/js/add_advance_js'); ?>