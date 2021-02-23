<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
// CSS to add only Customer module
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
                                        <h2 class="page-title">Customer Manager List</h2>
                                    </div>
                                    <div class="col text-right-sm d-flex justify-content-end align-items-center">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <!--<input type="file" name="file" /> -->
                                            <a href="<?= url('customer/import_customer') ?>">
                                                <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-download"></span> Import</button>
                                            </a>
                                            <a href="<?= url('customer/customer_export') ?>">
                                                <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-upload"></span> Export</button>
                                            </a>
                                            <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_lead') ?>"><span class="fa fa-plus"></span> Add Lead</a>
                                            <a class="btn btn-primary btn-md" href="<?php echo url('customer/add_advance') ?>">
                                                <span class="fa fa-plus"></span> New Customer
                                            </a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="alert alert-warning col-md-12 mt-4" role="alert">
                                        <span style="color:black;">
                                            A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                                            Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div id="status_sorting"  class=""></div>
                                <table class="table"  id="customer_list_table">
                                    <thead>
                                    <tr>
                                        <th width="100px">Name</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Source</th>
                                        <th>Email</th>
                                        <th>Added</th>
                                        <th>Sales Rep</th>
                                        <th>Tech</th>
                                        <th>System Type</th>
                                        <th>MMR</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($profiles) && !empty($profiles)) : ?>
                                        <?php foreach ($profiles as $customer) : ?>
                                            <tr>
                                                <td>
                                                    <a href="<?= base_url('/customer/index/tab2/' . $customer->prof_id) . ''; ?>" style="color:#32243d;">
                                                        <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $customer->city; ?></td>
                                                <td><?php echo $customer->state; ?></td>
                                                <td><?php echo $customer->lead_source; ?></td>
                                                <td><?php echo $customer->email; ?></td>
                                                <td><?php echo $customer->entered_by; ?></td>
                                                <td><?php echo ($customer) ? $customer->FName . ' ' . $customer->LName : ''; ?></td>
                                                <td><?php echo $customer->technician; ?></td>
                                                <td><?php echo $customer->system_type; ?></td>
                                                <td><?php echo $customer->mmr; ?></td>
                                                <td><?php echo $customer->phone_h; ?></td>
                                                <td><?php echo $customer->status; ?></td>
                                                <td>
                                                    <a href="<?php echo url('/customer/add_advance/' . $customer->prof_id); ?>" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                                                        <img src="/assets/img/customer/actions/ac_edit.png" width="16px" height="16px" border="0" title="Edit Customer">
                                                    </a>
                                                    <!--<a href="#"  style="text-decoration:none;display:inline-block;" id="<?php echo $customer->prof_id; ?>" title="Delete Customer" class="delete_cust">
                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/cross.png" width="16px" height="16px" border="0">
                                                                                                </a>-->
                                                    <a href="mailto:<?= $customer->email; ?>" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_email.png" width="16px" height="16px" border="0" title="Email Customer">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_call.png" width="16px" height="16px" border="0" title="Call Customer">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;">
                                                        <img src="/assets/img/customer/actions/ac_invoice.png" width="16px" height="16px" border="0" title="Invoice Customer">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_work.png" width="16px" height="16px" border="0" title="Create Work Order">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_ticket.png" width="16px" height="16px" border="0" title="Create Service Ticket">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_sched.png" width="16px" height="16px" border="0" title="Schedule">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_sms.png" width="16px" height="16px" border="0" title="Message Customer">
                                                    </a>
                                                    <!--<a href="<?php echo url('/customer/index/tab2/' . $customer->prof_id); ?>"  style="text-decoration:none; display:inline-block;">
                                                                                                    <img src="https://app.creditrepaircloud.com/application/images/assign-contact.png" border="0" title="View Profile">
                                                                                                </a>-->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
    // 'assets/frontend/js/creditcard.js',
    // 'assets/frontend/js/customer/add.js',
));
?>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<?php include viewPath('customer/adv_cust/css_list'); ?>
<?php include viewPath('customer/adv_cust/js_list'); ?>
<style>
    .btn{
        font-size: 12px !important;
    }
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
