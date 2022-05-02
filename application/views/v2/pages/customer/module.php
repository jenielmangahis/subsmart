<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>
<?php include viewPath('v2/includes/customer/customer_module_modals'); ?>

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
                    <div class="col-12 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#manage_modules_modal">
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
                            //echo $view;
                            $data['id'] = $view->ac_id;
                            if ($view->ac_view_link != "") {
                                $this->load->view('v2/pages/' . $view->ac_view_link, $data);
                            }
                        endforeach;
                    endif;
                    $datas['module_sort'] = $module_sort;
                    $this->load->view('v2/pages/customer/adv_cust_modules/alarm-com', $datas);
                    ?>
                </div>
                <input type="hidden" id="custom_modules" value="<?= $module_sort->ams_values ?>" />
            </div>
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
        console.log(mod);
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
                console.log(data)
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
<script type="text/javascript" src="<?= base_url("assets/js/customer/dashboard/index.js") ?>"></script>
<?php include viewPath('v2/includes/footer'); ?>