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
                <div class="row">
                    <div class="col-md-4 col-12 grid-mb">
                        <button type="button" id="btn-statement-of-claims" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#statement_claim_modal">
                            <i class='bx bx-fw bx-spreadsheet'></i> Statement of Claim
                        </button>
                    </div>
                    <div class="col-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container" style="width:450px;">
                            <select class="" id="search-customer"></select>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" id="btn-manage-modules" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#manage_modules_modal">
                                <i class='bx bx-fw bx-cog'></i>
                            </button>
                        </div>                        
                    </div>
                </div>
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