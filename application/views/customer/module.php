<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #draggable { width: 150px; height: 150px; padding: 0.5em; }
</style>
<style>
    .switch {
        position: relative !important;
        display: inline-block !important;
        width: 50px;
        height: 24px;
        float: right;
        margin-top: 6px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute !important;
        cursor: pointer !important;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute !important;
        content: "";
        height: 24px;
        width: 26px;
        left: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background: linear-gradient(to bottom, #45a73c 0%, #67ce5e 100%) !important;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3 !important;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px) !important;
        -ms-transform: translateX(26px) !important;
        transform: translateX(26px) !important;
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px !important;
    }

    .slider.round:before {
        border-radius: 50% !important;
    }
    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .required{
        color : red!important;
    }
    .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
    .nsm-button {
        border: 1px solid #d3d3d3;
        border-radius: 5px;
        padding: 0.5em 0.7em;
        background-color: transparent;
        font-size: 14px;
        font-weight: 700;
    }
    .content-title {
        font-size: 15px !important;
        font-weight: bold;
        line-height: 1.3;
        display: block;
        margin-bottom: 14px !important;
    }
    .nsm-button.primary {
        background-color: #6a4a86;
        color: #fff;
    }
    .nsm-button:not(:first-child), .nsm-button:not(:last-child) {
        margin-left: 5px;
        margin-bottom: 15px;
    }
    .mb-2 {
        margin-bottom: 0.5rem!important;
    }
</style>

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" >
                            <div class="row margin-bottom-ter align-items-center">
                                <!-- Nav tabs -->
                                <div class="col-auto">
                                    <h2 class="page-title">Customer Dashboard</h2>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4 mb-4" role="alert">
                                    <span style="color:black;">
                                        Our customer dashboard is Visual and Easy-To-Use. Simply add a widget and quickly see the information you need to help better assist and maintain a well organized business.
                                        Need us to create a customize widget with the table geared around your business.  Send us a request and our support team will be glad to get you a quote.
                                    </span>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div  id="settings">
                                    <div class="banking-tab-container">
                                        <div class="rb-01">
                                            <?php include_once('cus_module_tabs.php'); ?>
                                        </div>
                                    </div>
                                    <div class="tab-content mt-4" >

                                    </div>
                                </div>
                            </div>
                        </div>
                    <style>
                        .btn{
                            font-size: 12px !important;
                        }
                    </style>

                    <div class="tab-pane active standard-accordion" id="advance">
                        <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 text-right-sm" style="align:right;">
                                        <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                                        <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-customize="open" id="onoff-customize">
                                            <label class="onoffswitch-label" for="onoff-customize">
                                                <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="indata sortable2" id="sorting">
                                    <?php
                                    $modules = explode(",", $module_sort->ams_values);
                                    if($module_sort->ams_values!="" && count($modules) > 0):
                                        foreach ($modules as $m):
                                            $view = $this->wizardlib->getModuleById($m);
                                            //echo $view;
                                            $data['id'] = $view->ac_id;
                                            if($view->ac_view_link != ""){
                                                $this->load->view($view->ac_view_link, $data);
                                            }
                                        endforeach;
                                    endif;
                                    $datas['module_sort'] = $module_sort;
                                    $this->load->view('customer/adv_cust_modules/alarm-com', $datas);
                                    $this->load->view('customer/adv_cust_modules/add_module', $datas);
                                    ?>
                                    <input type="hidden" id="custom_modules" value="<?= $module_sort->ams_values ?>" />
                                </div>
                        </div>
                    </div>

                    </div>

                    <div class="modal fade nsm-modal fade" id="new_estimate_modal" tabindex="-1" aria-labelledby="new_estimate_modal_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="modal-title content-title" id="new_estimate_modal_label">New Estimate</span>
                                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center gy-3">
                                        <div class="col-12">
                                            <label class="content-title">What type of estimate you want to create</label>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle d-block mb-2">Create a regular estimate with items</label>
                                            <button type="button" class="nsm-button w-50 primary" onclick="window.open('<?= base_url('estimate/add?cus_id='.$cus_id); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">Standard Estimate</button>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle d-block mb-2">Customers can select all or only certain options</label>
                                            <button type="button" class="nsm-button w-50 primary" onclick="window.open('<?= base_url('estimate/addoptions?type=2&cus_id='.$cus_id); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">Options Estimate</button>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle d-block mb-2">Customers can select both Bundle Packages to<br>obtain an overall discount</label>
                                            <button type="button" class="nsm-button w-50 primary" onclick="window.open('<?= base_url('estimate/addbundle?type=3&cus_id='.$cus_id); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">Bundle Estimate</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .individual-module-big h6 {
        transform: rotate(-90deg);
        width: 380px;
        text-align: center;
        background: #34203f;
        padding: 5px;
        position: absolute;
        float: left;
        left: -215px;
        top: 155px;
        color: white;
        border-radius: 10px 10px 0 0;
        cursor: pointer;
    }
</style>


<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>

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

    });
</script>
