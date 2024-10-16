<?php
defined('BASEPATH') or exit('No direct script access allowed');
add_css(array(
    'assets/css/jquery.signaturepad.css',
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
    'assets/css/accounting/sales.css',
    'assets/textEditor/summernote-bs4.css',
));
?>

<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
     .input-group-prepend {
        height: 30px !important;
    }
    .table_head_customer{
        border-color: #999999;
        border-style: Solid;
        border-width: 1px;
    }
    .table_body_customer{
        border-color: #999999;
        border-style: Solid;
        border-width: 1px;
        background-color: #E5EBF2;
    }
</style>
    <div class="nsm-fab-container">
        <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_system_package_modal">
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
                            <button><i class='bx bx-x'></i></button>
                                    A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                                    Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div  id="settings">
                        <div class="banking-tab-container">
                            <div class="rb-01">
                                <ul class="nav nav-tabs border-0">
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'salesArea' || $active_tab == '' ?   "active" : '';  ?>" data-toggle="tab" href="#salesArea">Sales Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'leadSource' ?   "active" : '';  ?>" data-toggle="tab" href="#leadSource">Lead Source</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'leadTypes' ?   "active" : '';  ?>" data-toggle="tab" href="#leadTypes">Lead Types</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'ratePlan' ?   "active" : '';  ?>" data-toggle="tab" href="#ratePlan">Rate Plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'activationFee' ?   "active" : '';  ?>" data-toggle="tab" href="#activationFee">Activation Fee</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'spt' ?   "active" : '';  ?>" data-toggle="tab" href="#spt">System Package Type</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'header' ?   "active" : '';  ?>" data-toggle="tab" href="#header">Header</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="h6 mb-0 nav-link banking-sub-tab <?= $active_tab == 'customerStatus' ?   "active" : '';  ?>" data-toggle="tab" href="#customerStatus">Customer Status</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content mt-4" >
                                <div class="tab-pane <?= $active_tab == 'salesArea' || $active_tab == '' ? "active" : "fade"; ?> standard-accordion" id="salesArea">
                                    <?php include viewPath('customer/settings/sales_area'); ?>
                                </div>

                            <div class="tab-pane <?= $active_tab == 'leadSource' ? "active" : "fade"; ?> standard-accordion" id="leadSource">
                                <?php include viewPath('customer/settings/lead_source'); ?>
                            </div>

                            <div class="tab-pane <?= $active_tab == 'leadTypes' ? "active" : "fade"; ?> standard-accordion" id="leadTypes">
                                <?php include viewPath('customer/settings/lead_types'); ?>
                            </div>

                            <div class="tab-pane <?= $active_tab == 'ratePlan' ? "active" : "fade"; ?> standard-accordion" id="ratePlan">
                                <?php include viewPath('customer/settings/rate_plan'); ?>
                            </div>

                            <div class="tab-pane <?= $active_tab == 'activationFee' ? "active" : "fade"; ?> standard-accordion" id="activationFee">
                                <?php include viewPath('customer/settings/activation_fee'); ?>
                            </div>

                            <div class="tab-pane <?= $active_tab == 'spt' ? "active" : "fade"; ?> standard-accordion" id="spt">
                                <?php include viewPath('customer/settings/system_package_type'); ?>
                            </div>

                            <div class="tab-pane <?= $active_tab == 'header' ? "active" : "fade"; ?> standard-accordion" id="header">
                                <?php include viewPath('customer/settings/header'); ?>
                            </div>

                            <div class="tab-pane <?= $active_tab == 'customerStatus' ? "active" : "fade"; ?> standard-accordion" id="customerStatus">
                                <?php include viewPath('customer/settings/customer_settings'); ?>
                            </div>

                            <div class="tab-pane <?php if ($minitab == 'mt12') {
                                echo "active";
                            } else {
                                echo "fade";
                            } ?> standard-accordion" id="custom">
                                <div class="card">
                                    <div class="card-body hid-desk" style="padding-bottom:0px;">
                                        <div class="col-lg-12">
                                            <h6>Customizable</h6>
                                        </div>
                                        <?php if (isset($profile_info)) : ?>
                                            <div class="col-md-12">
                                                <div style="margin-right:15px; padding-top:1px;font-size: 12px !important;" align="left" class="normaltext1">
                                                    <button type="button" class="btn btn-secondary more_custom" ><span class="fa fa-plus"></span> Add New </button>
                                                </div>
                                                <br>
                                                <form id="customizable_form">
                                                    <table class="table table-hover table-bordered" id="custom_table">
                                                        <thead>
                                                        <tr>
                                                            <th>Field Name1</th>
                                                            <th>Field Value</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $custom_fields = json_decode($profile_info->custom_fields);
                                                        if (!empty($custom_fields)) {
                                                            foreach ($custom_fields as $key => $custom) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" class="form-control col-md-12" value="<?= !empty($custom->field_name) ? $custom->field_name : ''; ?>" name="fieldname[]" id="fieldname" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control col-md-12" value="<?= !empty($custom->field_value) ? $custom->field_value : ''; ?>" name="fieldvalue[]" id="fieldvalue" />
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:void(0);" type="button" class="delete_custom"><span class="fa fa-trash-o"></span></a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save / Update</button>
                                                    </div>
                                                    <input type="hidden" class="form-control" value="<?php if (isset($profile_info)) {
                                                        echo $profile_info->prof_id;
                                                    } ?>" name="prof_id" id="prof_id" />
                                                </form>
                                            </div>
                                        <?php else : ?>
                                            <span>No customer selected. Go to Customer Manager and select one.</span>
                                        <?php endif; ?>
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
 
</div>

<!-- Modals -->

<!-- Modals -->

<!-- Lead Type Modal -->
<?php include viewPath('customer/adv_modals/modal_lead_type'); ?>

<!-- Sales Area Modal -->
<?php include viewPath('customer/adv_modals/modal_sales_area'); ?>

<!-- Lead Source Modal -->
<?php include viewPath('customer/adv_modals/modal_lead_source'); ?>

<!-- Task Modal -->
<?php include viewPath('customer/adv_modals/modal_task'); ?>

<!-- Impoer Credit Modal -->
<?php include viewPath('customer/adv_modals/modal_import_credit'); ?>

<!-- Fusnishers Modal -->
<?php include viewPath('customer/adv_modals/modal_furnishers'); ?>

<!-- Reasons Modal -->
<?php include viewPath('customer/adv_modals/modal_reasons'); ?>

<!-- Rate PLan Modal -->
<?php include viewPath('customer/adv_modals/modal_rate_plan'); ?>

<!-- Activation Fee Modal -->
<?php include viewPath('customer/adv_modals/modal_activation_fee'); ?>

<!-- Activation Fee Modal -->
<?php include viewPath('customer/adv_modals/modal_system_package_type'); ?>

<!-- Customer Status Modal -->
<?php include viewPath('customer/adv_modals/modal_customer_status'); ?>

<!-- End Modals -->

<?php
// JS to add only Customer module
add_footer_js(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
    'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    'assets/textEditor/summernote-bs4.js'
));
?>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/js/settings_js'); ?>

<style>
    #sortable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
    #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 4em; text-align: center; }

    .alarm_label, .alarm_answer{
        font-size: 12px !important;
    }
    .input_select{
        color: #363636;
        box-shadow: none;
        display: inline-block !important;
        background-color: #fff;
        background-clip: padding-box;
    }

    .dispute_link{
        text-decoration: none;
        color: #1e5da9 !important;
        margin-top : 2px !important;
    }
</style>

<script>
    $(document).ready(function () {

        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

        //$(".module").draggable({axis:"y"});
        ///$( ".sortable2" ).sortable("disable");
        $('#onoff-customize').change(function () {
            if (this.checked) {
                $('.module').mouseover(function(){
                    if($(this).attr('id')=='addModuleBody'){
                        $(".sortable2").sortable("disable");
                    }else{
                        $(".sortable2").sortable("enable");
                    }
                });
            } else {
                $(".sortable2").sortable("disable");
            }

        });
        $(".sortable2").sortable({
            start: function (e, ui) {
                // creates a temporary attribute on the element with the old index
                $(this).attr('data-previndex', ui.item.index());
                $(this).attr('style', 'top:0;cursor: grabbing');

            },
            change(event, ui)
            {
                $(this).attr('style', 'top:0;cursor: grabbing ');
            },
            update: function (e, ui)
            {
                $(this).attr('style', 'top:0;cursor: pointer');
                var oldOrder = $(this).attr('data-previndex');
                var idsInOrder = $(".sortable2").sortable("toArray",{ attribute: 'data-id' });
                var filteredArray = idsInOrder.filter(function(e){return e});

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>/customer/ac_module_sort",
                    data: {ams_values: filteredArray.toString(), ams_id: <?php echo $module_sort->ams_id; ?>}, // serializes the form's elements.
                    success: function (data)
                    {
                        console.log(data);
                    }
                });

                console.log(filteredArray.toString());
            }
        });

        $(".sortable2").sortable("disable");

        $(".remove_task").on("click", function (event) {
            var ID = this.id;
            //alert(ID);
            $.ajax({
                type: "POST",
                url: "/customer/remove_task",
                data: {id: ID}, // serializes the form's elements.
                success: function (data) {
                    if (data === "Done") {
                        window.location.reload();
                    } else {
                        console.log(data);
                    }
                }
            });
        });
    });

</script>
