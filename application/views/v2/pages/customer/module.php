<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/customer/customer_module_modals'); ?>
<style>
.send-message{
    display: none;
}
#modules_container{
    max-height: 650px;
    overflow-y: auto;
}
.payment-method-container .content-title{
    font-size:13px;
}
.purple-label{    
    color: #6a4a86;
    font-weight:bold;
}
</style>
<style>
    .selectize-dropdown .selected {
        background-color: #6a4a8624 !important;
        color: unset !important;
    }
    
    .searchCustomerDashboardClear {
        background: white;
        right: 14px;
        top: 6px;
        z-index: 999;
        cursor: pointer;
        display: none;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_module_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Our customer dashboard is Visual and Easy-To-Use. Simply add a widget and quickly see the information you need to help better assist and maintain a well organized business.
                            Need us to create a customize widget with the table geared around your business. Send us a request and our support team will be glad to get you a quote.
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-8">
                        <button type="button" id="btn-statement-of-claims" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#statement_claim_modal">
                            <i class='bx bx-fw bx-spreadsheet'></i> Statement of Claim
                        </button>
                        <button type="button" id="btn-manage-modules" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#manage_modules_modal">
                            <i class='bx bx-fw bx-cog'></i>
                        </button>
                    </div>
                    <div class="col lg-4">
                        <div class="position-relative">
                            <select class="form-select w-100 searchCustomerDashboard">
                                <option value=""></option>
                            </select>
                            <div class="searchCustomerDashboardClear position-absolute text-muted"><i class="fas fa-times-circle"></i></div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-4 col-12 grid-mb">
                        
                    </div>
                    <div class="col-md-4 grid-mb text-end">
                                          
                    </div>
                </div> -->
                <div class="row h-100 g-3 grid-row-mb nsm-draggable-container" id="customer_modules">
                    <?php
                    $modules = explode(",", $module_sort->ams_values);
                    if ($module_sort->ams_values != "" && count($modules) > 0) :
                        foreach ($modules as $m) :
                            $view = $this->wizardlib->getModuleById($m);
                            //echo $view->ac_view_link;
                            $data['id'] = $view->ac_id;
                            if ($view->ac_view_link != "") {
                                $this->load->view('v2/pages/' . $view->ac_view_link, $data);
                            }
                        endforeach;
                    endif;
                    $datas['module_sort'] = $module_sort;
                    //$this->load->view('v2/pages/customer/adv_cust_modules/alarm-com', $datas);
                    //$this->load->view('v2/pages/customer/adv_cust_modules/share_page', '');
                    ?>
                </div>
                <input type="hidden" id="custom_modules" value="<?= $module_sort->ams_values ?>" />
            </div>
        </div>
    </div>
</div>

<!--SMS Messages Sent Modal-->
<div class="modal fade nsm-modal fade" id="modalMessagesSent" tabindex="-1" aria-labelledby="modalMessagesSentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="new_feed_modal_label">Messages Sent</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body sent-messages-container"></div>                                     
        </div>
    </div>
</div>

<?php include viewPath('customer/adv_cust/js_list'); ?>

<script>
    const selectSearchCustomerDashboardInput = $(".searchCustomerDashboard").selectize({
        placeholder: "Search and select customer...",
        valueField: 'id',
        labelField: 'customer',
        searchField: ['customer', 'email', 'phone'],
        render: {
            option: function(item, escape) {
                const name = item.customer.trim();
                const splitName = name.split(' ');
                const initials = (splitName[0]?.charAt(0) || '') + (splitName[1]?.charAt(0) || '');

                const phonePattern = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
                const phone = phonePattern.test(item.phone) ? item.phone : 'Not Specified';
                const email = item.email ? escape(item.email) : 'Not Specified';

                return `
                    <div style="display: flex; align-items: center; padding: 8px;">
                        <div style="
                            width: 40px;
                            height: 40px;
                            background: #6a4a86;
                            color: #fff;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: bold;
                            margin-right: 12px;
                            font-size: 14px;
                            flex: 0 0 auto;
                        ">${initials.toUpperCase()}</div>
                        <div style="max-width: 250px; word-wrap: break-word;">
                            <div style="font-weight: bold; word-wrap: break-word;">${escape(item.customer)}</div>
                            <div style="font-size: 12px; color: #555; word-wrap: break-word;">${phone} / ${email}</div>
                        </div>
                    </div>
                `;
            },
            item: function(item, escape) {
                return `<div>${escape(item.customer)}</div>`;
            }
        },
        onChange: function(value) {
            if (value) {
                window.location.href = `${window.origin}/customer/module/${value}`;
            }
        },
        onType: function(str) {
            if (str.length > 0) {
                $('.searchCustomerDashboardClear').show();
            } else {
                $('.searchCustomerDashboardClear').hide();
            }
        }
    });

    const selectizeSearchCustomerDashboardInstance = selectSearchCustomerDashboardInput[0].selectize;

    $.ajax({
        url: `${window.origin}/dashboard/thumbnailWidgetRequest`,
        type: "POST",
        data: {
            category: "customer_list",
            dateFrom: null,
            dateTo: null,
            filter3: null
        },
        beforeSend: function() {
            
        },
        success: function (response) {
            const customers = JSON.parse(response);
            selectizeSearchCustomerDashboardInstance.clearOptions();
            customers.forEach(customer => {
                selectizeSearchCustomerDashboardInstance.addOption(customer);
            });
            selectizeSearchCustomerDashboardInstance.refreshOptions(false);
        },
        error: function () {
            console.error("Failed to fetch customer data.");
        }
    });

    $(document).on('click', '.searchCustomerDashboardClear', function () {
        $(this).hide();
    });
</script>


<script type="text/javascript">
    let modules = [];
    $(document).ready(function() {
        loadScoreChart();

        $("#manage_modules_modal").on("show.bs.modal", function() {
            $.ajax({
                url: '<?= base_url('customer/getModulesList') ?>',
                method: 'get',
                data: {},
                success: function(response) {
                    $('#modules_container').html(response);
                }
            });
        });

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
            if( repo.name != null ){
                return repo.name;      
            }else{
                return repo.text;
            }
        }

        function formatRepoCustomer(repo) {
            if (repo.loading) {
                return repo.text;
            }
            var $container = $(
                '<div class="contact-acro">'+repo.acro+'</div><div class="contact-info"><i class="bx bx-user-pin"></i> '+repo.name +'<br><small><i class="bx bx-mobile"></i> '+repo.phone_m+' / <i class="bx bx-envelope"></i> '+repo.email+'</div>'
            );
            return $container;
        }

        $(document).on('click', '#sendEsign', function(){
            var prof_id = $(this).attr('data-id');

            $('#customer-esign').val(prof_id);
            $('#modal-send-esign').modal('show');

            $.ajax({
                type: "POST",
                url: base_url + "customer/_send_esign_form",
                data: {prof_id:prof_id},
                beforeSend: function(data) {
                    $("#customer-send-esign").html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(html) {
                    $("#customer-send-esign").html(html);
                },
                complete: function() {

                },
                error: function(e) {
                    console.log(e);
                }
            });
        });

        $(document).on('click', '#btn-customer-send-esign-template', function(){
            var prof_id = $('#customer-esign').val();
            var esign_template_id = $('#customer-send-esign-template').val();
            var url = base_url + `eSign_v2/templatePrepare?id=${esign_template_id}&job_id=0&customer_id=${prof_id}`;

            window.open(
                url,
                '_blank'
            );

            $('#modal-send-esign').modal('hide');
        });

        // $('#frm-statement-claim').on('submit', function(e){
        //     e.preventDefault();
        // });
    });

    $(document).on('click', '.sent-messages', function(){
        var cid = $(this).attr('data-cid');

        $('#modalMessagesSent').modal('show');

        var url = base_url + 'messages/_load_customer_sent_messages';
        $(".sent-messages-container").html('<span class="bx bx-loader bx-spin"></span>');

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {cid:cid},
             success: function(o)
             {          
                $(".sent-messages-container").html(o);
             }
          });
        }, 800);

    });

    function loadScoreChart() {
        var chart = $("#score_chart");

        try{
            new Chart(chart, {
                type: 'bar',
                data: {},
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    aspectRatio: 1.5
                }
            });
        }
        catch(e){}
    }

    function manipulateModules(dis, id) {
        if ($(dis).is(":checked")) {
            addModule(id);
        } else {
            removeModule(id);
        }
    }

    function addModule(id) {
        var mod = $('#custom_modules').val();
        var arr = mod.split(',');
        if (mod != "") {
            for (var i = 0; i < arr.length; i++) {
                modules.push(arr[i]);
            }
        }
        modules.push(id)
        var cleanModules = removeDuplicates(modules)

        $('#custom_modules').val(cleanModules);
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/customer/ac_module_sort/" + id,
            data: {
                ams_values: cleanModules.toString(),
                ams_id: <?php echo $module_sort->ams_id; ?>
            }, // serializes the form's elements.
            success: function(data) {
                // $(data).insertBefore($('#addModuleBody'));
                $("#customer_modules").append(data);
            }
        });
    }

    function removeDuplicates(data) {
        let unique = [];
        data.forEach(element => {
            if (!unique.includes(element)) {
                unique.push(element);
            }
        });

        return unique;
    }

    function pushMod(item) {
        modules.push(item);
    }

    function removeModule(dis) {
        var mod = $('#custom_modules').val();

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/customer/remove_module",
            data: {
                ams_values: mod,
                ams_id: <?php echo $module_sort->ams_id; ?>,
                id: dis
            }, // serializes the form's elements.
            success: function(data) {
                $('#' + dis).remove();
                $('#custom_modules').val(data)
            }
        });
    }
</script>
<script type="module"  src="<?= base_url("assets/js/customer/dashboard/index.js") ?>"></script>
<?php include viewPath('v2/includes/footer'); ?>