<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header');?>

<!-- add tax rate sidebar -->
<script src="<?=$url->assets?>js/accounting/TaxRateAdder/TaxRateAdder.js"></script>
<script src="<?=$url->assets?>js/accounting/TaxRateAdder/accounting.min.js"></script>
<style>
    @import url("<?=$url->assets?>css/accounting/tax/settings/settings.css");
    @import url("<?=$url->assets?>css/accounting/tax/dropdown-with-search/dropdown-with-search.css");
    @import url("<?=$url->assets?>css/accounting/tax/taxrate-select/taxrate-select.css");
</style>
<script>
    $(document).ready(function() {
        new TaxRateAdder($("#invoiceTaxRate"), {
            tableRows: "#jobs_items_table_body tr",
            totalTax: "#summaryContainer #total_tax_",
            grandTotal: "#summaryContainer #grand_total",
            subTotal: "#summaryContainer #span_sub_total_invoice",
        });
    });
</script>
<!-- end add tax rate sidebar -->

<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting');?>
    <style>
        .but:hover {
            font-weight: 900;
            color: black;
        }

        .but-red:hover {
            font-weight: 900;
            color: red;
        }

        .required:after {
            content: " *";
            color: red;
        }

        .signature_mobile {
            display: none;
        }

        .show_mobile_view {
            display: none;
        }

        @media only screen and (max-device-width: 600px) {
            .label-element {
                position: absolute;
                top: -8px;
                left: 25px;
                font-size: 12px;
                color: #666;
            }

            .input-element {
                padding: 30px 5px 10px 8px;
                width: 100%;
                height: 55px;
                /* border:1px solid #CCC; */
                font-weight: bold;
                margin-top: -15px;
            }

            .mobile_qty {
                background: transparent !important;
                border: none !important;
                outline: none !important;
                padding: 0px 0px 0px 0px !important;
                text-align: center;
            }

            .select-wrap {
                border: 2px solid #e0e0e0;
                /* border-radius: 4px; */
                margin-top: -10px;
                /* margin-bottom: 10px; */
                padding: 0 5px 5px;
                width: 100%;
                /* background-color:#ebebeb; */
            }

            .select-wrap label {
                font-size: 10px;
                text-transform: uppercase;
                color: #777;
                padding: 2px 8px 0;
            }

            .m_select {
                /* background-color: #ebebeb;
    border:0px; */
                border-color: white !important;
                border: 0px !important;
                outline: 0px !important;
            }

            .select2 .select2-container .select2-container--default {
                /* background-color: #ebebeb;
    border:0px; */
                border-color: white !important;
                border: 0px !important;
                outline: 0px !important;
            }

            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #fff !important;
                border-radius: 4px;
            }

            .sub_label {
                font-size: 12px !important;
            }

            .signature_web {
                display: none;
            }

            .signature_mobile {
                display: block;
            }

            .hidden_mobile_view {
                display: none;
            }

            .show_mobile_view {
                display: block;
            }

            .table_mobile {
                font-size: 14px;
            }

            div.dropdown-wrapper select {
                width: 115%
                    /* This hides the arrow icon */
                ;
                background-color: transparent
                    /* This hides the background */
                ;
                background-image: none;
                -webkit-appearance: none
                    /* Webkit Fix */
                ;
                border: none;
                box-shadow: none;
                padding: 0.3em 0.5em;
                font-size: 13px;
            }

            .signature-pad-canvas-wrapper {
                margin: 15px 0 0;
                border: 1px solid #cbcbcb;
                border-radius: 3px;
                overflow: hidden;
                position: relative;
            }

            .signature-pad-canvas-wrapper::after {
                content: 'Name';
                border-top: 1px solid #cbcbcb;
                color: #cbcbcb;
                width: 100%;
                margin: 0 15px;
                display: inline-flex;
                position: absolute;
                bottom: 10px;
                font-size: 13px;
                z-index: -1;
            }

            .tabs {
                list-style: none;
            }

            .tabs li {
                display: inline;
            }

            .tabs li a {
                color: black;
                float: left;
                display: block;
                /* padding: 4px 10px;  */
                /* margin-left: -1px;  */
                position: relative;
                /* left: 1px;  */
                background: #a2a5a3;
                text-decoration: none;
            }

            .tabs li a:hover {
                background: #ccc;
            }

            .group:after {
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0;
            }

            .box-wrap {
                position: relative;
                min-height: 250px;
            }

            .tabbed-area div div {
                background: white;
                padding: 20px;
                min-height: 250px;
                position: absolute;
                top: -1px;
                left: 0;
                width: 100%;
            }

            .tabbed-area div div,
            .tabs li a {
                border: 1px solid #ccc;
            }

            #box-one:target,
            #box-two:target,
            #box-three:target {
                z-index: 1;
            }

            .group li.active a,
            .group li a:hover,
            .group li.active a:focus,
            .group li.active a:hover {
                background-color: #52cc6e;
                color: black;
            }
        }
    </style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 style="font-family: Sarabun, sans-serif">New Invoice</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Complete the fields below to create a new invoice.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                                <a href="<?php echo base_url('invoice') ?>"
                                    class="btn btn-primary" aria-expanded="false">
                                    <i class="mdi mdi-settings mr-2"></i> Go Back to Invoices
                                </a>
                                <?php endif?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="validation-error" id="estimate-error" style="display: none;">You selected Credit
                            Card Payments as payment method for this invoice. Please configure the <a
                                href="https://www.markate.com/pro/settings/payments/main">Online Payment processor</a>
                            first to accept cart payments.</div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('accounting/addInvoice', ['class' => 'form-validate require-validation', 'id' => 'invoice_form', 'autocomplete' => 'off']); ?>

            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="background-color:white;">
                                <div class="col-md-5 form-group">
                                    <label for="invoice_customer">Customer</label>
                                    <!-- <select id="invoice_customer" name="customer_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select customer">
                                    </select> -->
                                    <select name="customer_id" id="sel-customer" class="form-control" required>
                                        <option>Select a customer</option>
                                        <?php foreach ($customers as $customer): ?>
                                        <option
                                            value="<?php echo $customer->prof_id ?>">
                                            <?php echo $customer->first_name . "&nbsp;" . $customer->last_name; ?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                        data-target="#modalNewCustomer" style="color:#02A32C;"><span
                                            class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New
                                        Customer</a>
                                </div>
                                <div class="col-md-4 form-group" style="text-align:right;">
                                    <div style="padding:10px;box-shadow: 0 0 5px 5px #F0F0F0;min-width:50%;float:right;">
                                        <p>BALANCE DUE</p>
                                        <h1>$<span id="balanceDueText">0.00</span></h1>
                                    </div>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="invoice_job_location">Job Location <small
                                            class="help help-sm">(optional, select or add new one)</small></label>
                                    <!-- <select id="invoice_job_location" name="invoice_job_location_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select Address">
                                    </select> -->
                                    <input type="text" class="form-control" name="invoice_job_location"
                                        id="job_location" />
                                </div>
                                <div class="col-md-5 form-group">
                                    <!-- <p>&nbsp;</p>
                                    <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                       data-target="#modalNewLocationAddress" style="color:#02A32C;"><span
                                                class="fa fa-plus fa-margin-right" style="color:#02A32C;"></span>New Location Address</a> -->
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="job_name">Job Name <small
                                            class="help help-sm">(optional)</small></label>
                                    <input type="text" class="form-control" name="job_name" id="job_name" />
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Terms</label>
                                            <select class="form-control" name="terms" id="addNewTermsInvoice">
                                                <option></option>
                                                <option value="0">Add New</option>
                                                <?php foreach ($terms as $term): ?>
                                                <option
                                                    value="<?php echo $term->id; ?>">
                                                    <?php echo $term->name . ' ' . $term->net_due_days; ?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Customer email</label>
                                            <input type="email" class="form-control" id="customer_email"
                                                name="customer_email">
                                            <p><input type="checkbox"> Send later </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Location of sale</label>
                                            <input type="text" class="form-control" name="location_scale" value="<?php echo $clients->business_address; ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Tracking no.</label>
                                            <input type="text" class="form-control" name="tracking_number">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label>Ship via</label>
                                            <input type="text" class="form-control" name="ship_via">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Shipping date</label>
                                            <input type="date" class="form-control" name="shipping_date">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Tags</label> <span class="float-right"><a href="#" class="text-info"
                                                    data-toggle="modal" data-target="#tags-modal"
                                                    id="open-tags-modal">Manage tags</a></span>
                                            <input type="text" class="form-control" name="tags">
                                            <!-- <div class="form-group">
                                                <div id="label">
                                                    <label for="tags">Tags</label>
                                                    <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                                </div>
                                                <select name="tags[]" id="tags" class="form-control" multiple="multiple"></select>
                                            </div> -->
                                        </div>
                                        <!-- </div>
                                    <div class="row form-group"> -->
                                        <div class="col-md-3">
                                            <label>Billing address</label>
                                            <textarea class="form-control" style="width:100%;" name="billing_address"
                                                id="billing_address"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row" style="background-color:white;">
                                <div class="col-md-3 form-group">
                                    <label for="estimate_date">Invoice Type <span style="color:red;">*</span></label>
                                    <select name="invoice_type" class="form-control">
                                        <option value="Deposit">Deposit</option>
                                        <option value="Partial Payment">Partial Payment</option>
                                        <option value="Final Payment">Final Payment</option>
                                        <option value="Total Due" selected="selected">Total Due</option>
                                    </select>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="work_order">Job# <small class="help help-sm">(optional)</small></label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover"
                                        data-placement="top" data-trigger="hover"
                                        data-content="Field is auto-populated on create Invoice from a Work Order."
                                        data-original-title="" title=""></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="work_order_number"
                                            name="work_order_number">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="purchase_order">Purchase Order# <small
                                            class="help help-sm">(optional)</small></label>
                                    <span class="fa fa-question-circle text-ter" data-toggle="popover"
                                        data-placement="top" data-trigger="hover"
                                        data-content="Optional if you want to display the purchase order number on invoice."
                                        data-original-title="" title=""></span>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="purchase_order"
                                            id="purchase_order">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Shipping to</label>
                                    <textarea class="form-control" style="width:100%;" name="shipping_to_address"
                                        id="shipping_address"></textarea>
                                </div>

                                <!-- <div class="col-md-3 form-group">
                                </div> -->

                                <div class="col-md-3 form-group">
                                    <label for="invoice_number">Invoice#</label>
                                    <!-- <input type="text" class="form-control" name="invoice_number"
                                           id="invoice_number" value="<?php echo "INV-" . date("YmdHis"); ?>"
                                    required placeholder="Enter Invoice#"
                                    autofocus onChange="jQuery('#customer_name').text(jQuery(this).val());"/> -->
                                    <input type="text" class="form-control" name="invoice_number" id="invoice_number"
                                        value="<?php echo "INV-";
                                        foreach ($number as $num):
                                            $next = $num->invoice_number;
                                            $arr = explode("-", $next);
                                            $date_start = $arr[0];
                                            $nextNum = $arr[1];
                                            //    echo $number;
                                        endforeach;
                                        $val = $nextNum + 1;
                                        echo str_pad($val, 9, "0", STR_PAD_LEFT);
                                        ?>" required placeholder="Enter Invoice#" readonly/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="date_issued">Date Issued <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" id="start_date_" name="date_issued"
                                        required />
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="due_date">Due Date <span style="color:red;">*</span></label>
                                    <input type="date" class="form-control" id="end_date_" name="due_date" required />
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="status">Status</label><br />
                                    <!-- <input type="text" name="status" class="form-control"> -->
                                    <select name="status" class="form-control">
                                        <option value="Draft" selected>Draft</option>
                                        <option value="Submitted">Submitted</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Declined">Declined</option>
                                        <option value="Schedule">Schedule</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="plansItemDiv" style="background-color:white;">
                                <div class="col-md-10 pt-2">
                                    <label for="">Manage invoice items</label>
                                </div>
                                <div class="col-md-2 row pr-0">
                                    <label for="" class="pt-2">Show qty as: </label>
                                    <select name="qty_type[]" id="show_qty_type" class="form-control mb-2"
                                        style="display:inline-block; width: 135px;">
                                        <option value="Quantity">Quantity</option>
                                        <option value="Hours">Hours</option>
                                        <option value="Square Feet">Square Feet</option>
                                        <option value="Rooms">Rooms</option>
                                    </select>
                                </div>
                                <div class="col-md-12 table-responsive" style="overflow: initial;">
                                    <table class="table table-hover">
                                        <input type="hidden" name="count" value="0" id="count">
                                        <thead>
                                            <tr style="background-color:#E8E9E8;">
                                                <th><b>Item</b></th>
                                                <th><b>Type</th>
                                                <th width="100px" id="qty_type_value"><b>Quantity</b></th>
                                                <th width="100px"><b>Price</b></th>
                                                <th width="100px"><b>Discount</b></th>
                                                <th><b>Tax(%)</b></th>
                                                <th><b>Total</b></th>
                                            </tr>
                                        </thead>
                                        <tbody id="jobs_items_table_body">
                                            <!-- <tr>
                                            <td><input type="text" class="form-control getItems"
                                                       onKeyup="getItems(this)" name="item[]">
                                                <ul class="suggestions"></ul>
                                            </td>
                                            <td><select name="item_type[]" class="form-control">
                                                    <option value="service">Service</option>
                                                    <option value="material">Material</option>
                                                    <option value="product">Product</option>
                                                </select></td>
                                            <td><input type="text" class="form-control quantity" name="quantity[]"
                                                       data-counter="0" id="quantity_0" value="1"></td>
                                            <td><input type="number" class="form-control price" name="price[]"
                                                       data-counter="0" id="price_0" min="0" value="0"></td>
                                            <td><input type="number" class="form-control discount" name="discount[]"
                                                       data-counter="0" id="discount_0" min="0" value="0" ></td>
                                            <td><input type="hidden" class="form-control tax" name="tax[]"
                                                       data-counter="0" id="tax_0" min="0" value="0">
                                                       <span id="span_tax_0">0.00 (7.5%)</span></td>
                                            <td><input type="hidden" class="form-control " name="total[]"
                                                       data-counter="0" id="item_total_0" min="0" value="0">
                                                       $<span id="span_total_0">0.00</span></td>
                                        </tr> -->
                                            <tr>
                                                <td width="30%">
                                                    <input type="text" class="form-control getItems"
                                                        onKeyup="getItems(this)" name="items[]">
                                                    <ul class="suggestions"></ul>
                                                    <div class="show_mobile_view"><span class="getItems_hidden"></span>
                                                    </div>
                                                    <input type="hidden" name="itemid[]" id="itemid" class="itemid">
                                                </td>
                                                <td width="20%">
                                                    <div class="dropdown-wrapper">
                                                        <select name="item_type[]" id="item_typeid"
                                                            class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                            <option value="fee">Fee</option>
                                                        </select>
                                                    </div>

                                                    <!-- <div class="show_mobile_view" style="color:green;"><span>Product</span></div> -->
                                                </td>
                                                <td width="10%"><input type="number"
                                                        class="form-control quantity_inv mobile_qty" name="quantity[]"
                                                        data-counter="0" id="quantity_0" value="1"></td>
                                                <td width="10%"><input type="number"
                                                        class="form-control price price_inv hidden_mobile_view" name="price[]"
                                                        data-counter="0" id="price_0" min="0" value="0"> <input
                                                        type="hidden" class="priceqty" id="priceqty_0">
                                                    <div class="show_mobile_view"><span class="price">0</span>
                                                        <!-- <input type="hidden" class="form-control price" name="price[]" data-counter="0" id="priceM_0" min="0" value="0"> -->
                                                    </div><input id="priceM_qty0" value="" type="hidden"
                                                        name="price_qty[]"
                                                        class="form-control hidden_mobile_view price_qty">
                                                </td>
                                                <td width="10%" class="hidden_mobile_view"><input type="number"
                                                        class="form-control discount" name="discount[]" data-counter="0"
                                                        id="discount_0" min="0" value="0" readonly></td>
                                                <td width="10%" class="hidden_mobile_view"><input type="text"
                                                        class="form-control tax_change" name="tax[]" data-counter="0"
                                                        id="tax1_0" min="0" value="0">
                                                    <!-- <span id="span_tax_0">0.0</span> -->
                                                </td>
                                                <td width="10%" class="hidden_mobile_view"><input type="hidden"
                                                        class="form-control " name="total[]" data-counter="0"
                                                        id="item_total_0" min="0" value="0">
                                                    $<span id="span_total_0">0.00</span></td>
                                                <td><a href="#" class="remove btn btn-sm btn-success" id="0"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <!-- <a class="link-modal-open pt-1 pl-2" href="#" id="add_another_new_invoice" style="color:#02A32C;"><span
                                                    class="fa fa-plus-square fa-margin-right" style="color:#02A32C;"></span>Add Items</a> -->
                                        <!-- <a href="#" id="add_another_new_invoice" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Add another line </a> -->
                                        <a class="link-modal-open" href="#" id="add_another_items" data-toggle="modal"
                                            data-target="#item_list"><span
                                                class="fa fa-plus-square fa-margin-right"></span>Add Items</a> &emsp;
                                        <!-- <a class="link-modal-open" href="#" id="add_package" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fa fa-plus-square fa-margin-right"></span>Add Package</a> -->
                                        <a class="link-modal-open" href="#" id="add_package" data-toggle="modal" data-target=".modal-add-by-group"><span class="fa fa-plus-square fa-margin-right"></span>Add By Group</a> &emsp;
                                        <a class="link-modal-open" href="#" id="create_package" data-toggle="modal" data-target=".createPackage"><span class="fa fa-plus-square fa-margin-right"></span>Add/Create Package</a>
                                        <hr style="display:inline-block; width:91%">
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-7">
                                        &nbsp;
                                        </div>
                                        <div class="col-md-5 row pr-0">
                                            <div class="col-sm-5">
                                                <label style="padding: 0 .75rem;">Subtotal</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                                $ <span id="span_sub_total_invoice">0.00</span>
                                                <input type="hidden" name="sub_total" id="item_total">
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" name="adjustment_name" id="adjustment_name" placeholder="Adjustment Name" class="form-control" style="width:200px; display:inline; border: 1px dashed #d1d1d1">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="number" name="adjustment_input" id="adjustment_input" value="0" class="form-control adjustment_input" style="width:100px; display:inline-block">
                                                <span class="fa fa-question-circle" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Optional it allows you to adjust the total amount Eg. +10 or -10." data-original-title="" title=""></span>
                                            </div>
                                            <div class="col-sm-3 text-right pt-2">
                                                <label id="adjustment_amount">0.00</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-sm-5">
                                                <label style="padding: .375rem .75rem;">Grand Total ($)</label>
                                            </div>
                                            <div class="col-sm-6 text-right pr-3">
                                                <span id="grand_total">0.00</span>
                                                <input type="hidden" name="markup_input_form" id="markup_input_form" class="markup_input" value="0">
                                                <input type="hidden" name="grand_total" id="grand_total_input" value='0'>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row" style="background-color:white;font-size:16px;">
                                        <div class="col-md-7">
                                        </div>
                                        <div class="col-md-5">
                                            <table class="table table_mobile" style="text-align:left;" id="summaryContainer">
                                                <tr>
                                                    <td>Subtotal</td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span
                                                            id="span_sub_total_invoice">0.00</span>
                                                        <input type="hidden" name="subtotal" id="item_total">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="addInvoiceTax">
                                                            <input type="hidden" name="agency_id" />
                                                            <div class="form-group" style="margin-bottom: 0 !important;">
                                                                <div class="taxRateSelect" id="invoiceTaxRate">
                                                                    <button class="taxRateSelect__main" type="button" disabled>
                                                                        <span class="type-text">Items total tax rate</span>
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </button>

                                                                    <div class="taxRateSelect__options">
                                                                        <div class="taxRateSelect__item" value="items_tax" data-type-value="items_tax" default="true">Items total tax rate</div>
                                                                        <div class="taxRateSelect__item" value="location" data-type-value="location">Based on location</div>

                                                                        <div class="taxRateSelect__item taxRateSelect__item--customWrapper">
                                                                            <div class="taxRateSelect__title">Custom Rates</div>
                                                                            <div class="taxRateSelect__item taxRateSelect__item--custom" value="add_custom">
                                                                                <i class="fa fa-plus"></i>
                                                                                <span>Add rate</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" id="tax_rate" name="tax_rate" class="type-input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!-- <td></td> -->
                                                    <td colspan="2" align="right">$ <span
                                                            id="total_tax_">0.00</span><input type="hidden" name="taxes"
                                                            id="total_tax_input"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:;"><input type="text" name="adjustment_name"
                                                            id="adjustment_name" placeholder="Adjustment Name"
                                                            class="form-control"
                                                            style="width:; display:inline; border: 1px dashed #d1d1d1">
                                                    </td>
                                                    <td align="center">
                                                        <input type="number" name="adjustment_value"
                                                            id="adjustment_input" value="0"
                                                            class="form-control adjustment_input"
                                                            style="width:50%;display:inline;">
                                                        <span class="fa fa-question-circle" data-toggle="popover"
                                                            data-placement="top" data-trigger="hover"
                                                            data-content="Optional it allows you to adjust the total amount Eg. +10 or -10."
                                                            data-original-title="" title=""></span>
                                                    </td>
                                                    <td><span id="adjustmentText">0.00</span></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Markup $<span id="span_markup"></td> -->
                                                <!-- <td><a href="#" data-toggle="modal" data-target="#modalSetMarkup" style="color:#02A32C;">set markup</a></td> -->
                                                <input type="hidden" name="markup_input_form" id="markup_input_form"
                                                    class="markup_input" value="0">
                                                <!-- </tr> -->
                                                <tr id="saved" style="color:green;font-weight:bold;display:none;">
                                                    <td>Amount Saved</td>
                                                    <td></td>
                                                    <td><span id="offer_cost">0.00</span><input type="hidden"
                                                            name="voucher_value" id="offer_cost_input"></td>
                                                </tr>
                                                <tr style="color:blue;font-weight:bold;font-size:16px;">
                                                    <td><b>Grand Total ($)</b></td>
                                                    <td></td>
                                                    <td><b><span id="grand_total">0.00</span>
                                                            <input type="hidden" name="grand_total"
                                                                id="grand_total_input" value='0'></b></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Request a Deposit</h5>
                                    <span class="help help-sm help-block">You can request an upfront payment on accept
                                        estimate.</span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <select name="deposit_request_type" class="form-control">
                                        <option value="$" selected="selected">Deposit amount $</option>
                                        <option value="%">Percentage %</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="input-group">
                                        <input type="text" name="deposit_amount" value="0" class="form-control"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Payment Schedule</h5>
                                    <span class="help help-sm help-block">Split the balance into multiple payment
                                        milestones.</span>
                                    <p><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus-square"
                                                aria-hidden="true"></i> Manage payment schedule </a></p>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Accepted payment methods</h5>
                                    <span class="help help-sm help-block">Select the payment methods that will appear on
                                        this invoice.</span>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="credit_card_payments" value="1" checked
                                            id="credit_card_payments">
                                        <label for="credit_card_payments"><span>Credit Card Payments ()</span></label>
                                    </div>
                                    <span class="help help-sm help-block">Your client can pay your invoice using credit
                                        card or bank account online. You will be notified when your client makes a
                                        payment and the money will be transferred to your bank account automatically.
                                    </span>
                                    <div class="float-left mini-stat-img mr-4"><img
                                            src="<?php echo $url->assets ?>frontend/images/credit_cards.png"
                                            alt=""></div>
                                </div>
                                <div class="col-md-12">
                                    <span class="help help-sm help-block">Your payment processor is not set up
                                        <a class="link-modal-open" href="javascript:void(0)" data-toggle="modal"
                                            data-target="#modalNewCustomer">setup payment</a></span>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="bank_transfer" value="1" checked
                                            id="bank_transfer">
                                        <label for="bank_transfer"><span>Bank Transfer</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="instapay" value="1" checked id="instapay">
                                        <label for="instapay"><span>Instapay</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="check" value="1" checked id="check">
                                        <label for="check"><span>Check</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="cash" value="1" checked id="cash">
                                        <label for="cash"><span>Cash</span></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                                        <input type="checkbox" name="deposit" value="1" checked id="deposit">
                                        <label for="deposit"><span>Deposit</span></label>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row" style="background-color:white;">
                                    <div class="col-md-12">
                                        <h5>Message to Customer</h5>
                                        <span class="help help-sm help-block">Add a message that will be displayed on
                                            the invoice.</span>
                                        <textarea name="message_to_customer" cols="40" rows="2"
                                            class="form-control">Thank you for your business.</textarea>
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <h5>Terms &amp; Conditions</h5>
                                        <span class="help help-sm help-block">Mention your company's T&amp;C that will
                                            appear on the invoice.</span>
                                        <textarea name="terms_and_conditions" cols="40" rows="2"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12">
                                    <h5>Attachments</h5>
                                    <div class="help help-sm help-block margin-bottom-sec">Optionally attach files to
                                        this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.</div>

                                    <ul class="attachments" data-fileupload="attachment-list">
                                    </ul>
                                    <script async="" src="https://www.google-analytics.com/analytics.js"></script>
                                    <script type="text/template" data-fileupload="attachment-list-template">
                                        <li data-attach-to-invoice="0">
                                            <a class="a-default" target="_blank" href="{{url}}"><span class="fa fa-{{icon}}"></span> {{name_original}}</a>
                                            <a class="attachments__delete a-default margin-left-sec" data-id="{{id}}" data-fileupload="attachment-delete" href="#"><span class="fa fa-trash-o icon"></span></a>
                                                        <input type="hidden" name="attachment_id[]" value="{{id}}">
                                                    </li>
                                        </script>
                                    <div class="alert alert-danger" data-fileupload="attachment-error" role="alert"
                                        style="display: none;"></div>
                                    <div class="" data-fileupload="attachment-progressbar" style="display: none;">
                                        <div class="text">Uploading</div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                    </div>
                                    <span class="btn btn-default btn-md fileinput-button vertical-top"><span
                                            class="fa fa-upload"></span> Upload File <input
                                            data-fileupload="attachment-file" name="attachment-file" type="file"></span>
                                </div>
                            </div>

                            <div class="row" style="background-color:white;">
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-light but"
                                        style="border-radius: 0 !important;border:solid gray 1px;"
                                        data-action="update">Save as Draft</button>
                                    <button class="btn btn-success but" style="border-radius: 0 !important;"
                                        data-action="send">Preview</button>
                                    <a href="<?php echo url('invoice') ?>"
                                        class="btn but-red">cancel this</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="modal right fade" id="tags-modal" tabindex="-1" role="dialog" aria-labelledby="tags-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="tags-list">
                        <div class="modal-header">
                            <h4 class="modal-title">Manage your tags</h4>
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                        </div>
                        <div class="modal-body pt-3">
                            <div class="row">
                                <div class="col-6 d-flex">
                                    <button type="button" class="btn btn-outline-secondary m-auto" onclick="getTagForm({}, 'create')">Create Tag</button>
                                </div>
                                <div class="col-6 d-flex">
                                    <button type="button" class="btn btn-outline-secondary m-auto" onclick="getGroupTagForm()">Create Group</button>
                                </div>
                                <div class="col-12 py-3">
                                    <input type="text" name="search_tag" id="search-tag" class="form-control" placeholder="Find tag by name">
                                </div>
                                <div class="col-12">
                                    <table id="tags-table" class="table table-bordered table-hover">
                                        <thead>
                                            <th>Tags</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!--    Modal for creating rules-->
            <div class="modal-right-side">
                <div class="modal right fade" id="createTagGroup" tabindex="" role="dialog"
                    aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel2">Create New Group</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body pt-3">
                                <!-- <div class="subheader">Rules only apply to unreviewed transactions.</div> -->
                                <form class="mb-3" id="tags_group_form">
                                    <div class="form-row mb-3">
                                        <div class="col-md-8">
                                            <label for="tag-group-name">Group name</label>
                                            <input type="text" name="tags_group_name" id="tag-group-name"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">&nbsp;</label>
                                            <select id="e2" class="form-control" name="group_color"
                                                style="background-color: green; color: white">
                                                <option value="green" style="background-color:green">Green</option>
                                                <option value="yellow" style="background-color:yellow; color: black">
                                                    Yellow</option>
                                                <option value="red" style="background-color:red">Red</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Save</button>
                                </form>
                                <table id="tags-group" class="table table-bordered mb-3 hide">
                                    <tbody></tbody>
                                </table>
                                <h6>Add tags to this group</h6>
                                <form class="mb-3" id="tags_form">
                                    <div class="form-row mb-3">
                                        <div class="col-md-8">
                                            <label for="tag_name">Tag name</label>
                                            <input type="text" name="tag_name" id="tag_name" class="form-control">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button class="btn btn-success w-100">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <table id="group-tags" class="table table-bordered mb-3 hide">
                                    <tbody></tbody>
                                </table>
                                <hr>
                                <div class="form-group">
                                    <label for="" style="position: relative;display: inline-block;">Put similar tags in
                                        the same group to get better reports. <a href="#">Find out more</a></label>
                                    <p><a href="#">Show me examples of groups</a></p>
                                </div>
                                <div class="form-group modaldivision">
                                    <div class="row">
                                        <div class="col-md-6">
                                            I have a clothing store. I want to see which seasonal collection sells the
                                            best.
                                        </div>
                                        <div class="col-md-6">
                                            Group: Collection
                                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                <div class="sc-krvtoX bjibjm">
                                                    <div class="sc-fYiAbW etmaub">
                                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>:
                                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Spring</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                <div class="sc-krvtoX bjibjm">
                                                    <div class="sc-fYiAbW etmaub">
                                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>:
                                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Summer</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group modaldivision">
                                    <div class="row">
                                        <div class="col-md-6">
                                            I run a gym. I want to see which fitness classes and instructors make the
                                            most money.
                                        </div>
                                        <div class="col-md-6">
                                            <p>Group: Fitness class</p>
                                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                <div class="sc-krvtoX bjibjm">
                                                    <div class="sc-fYiAbW etmaub">
                                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>:
                                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Yoga</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                <div class="sc-krvtoX bjibjm">
                                                    <div class="sc-fYiAbW etmaub">
                                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>:
                                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Rowing</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <p>Group: Instructor</p>
                                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                <div class="sc-krvtoX bjibjm">
                                                    <div class="sc-fYiAbW etmaub">
                                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>:
                                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Daniel</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                <div class="sc-krvtoX bjibjm">
                                                    <div class="sc-fYiAbW etmaub">
                                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>:
                                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Maria</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" data-dismiss="modal">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--    end of modal-->

            <!-- Modal Set Markup -->
            <div class="modal fade" id="modalSetMarkup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Set Markup</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Set percent or fixed markup that will be applied to each item.</p>
                            <p>The markup will not be visible to customer estimate.</p>

                            <div class="btn-group margin-right-sec" role="group" aria-label="...">
                                <button class="btn btn-default" type="button" name="markup_type_percent">%</button>
                                <button class="btn btn-success" type="button" name="markup_type_dollar"
                                    id="markup_type_dollar">$</button>&emsp;&emsp;
                                <input class="form-control" name="markup_input" id="markup_input" type="number"
                                    style="width: 260px;">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary setmarkup">Set Markup</button>
                        </div>
                    </div>
                </div>
            </div>


            <!--    Modal for creating rules-->
            <div class="modal-right-side">
                <div class="modal right fade" id="createTag" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="myModalLabel2">Create New Tag</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <form id="create-tag-form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Tag name</label>
                                        <input type="text" name="tag_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Group</label>
                                        <select class="form-control" name="group_id" id="group-tags-select2">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--    end of modal-->

            <div class="modal right fade" id="tags-modal" tabindex="-1" role="dialog" aria-labelledby="tags-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="tags-list">
                        <div class="modal-header">
                            <h4 class="modal-title">Manage your tags</h4>
                            <button type="button" class="close" data-dismiss="modal"><i
                                    class="fa fa-times fa-lg"></i></button>
                        </div>
                        <div class="modal-body pt-3">
                            <div class="row">
                                <div class="col-6 d-flex">
                                    <button type="button" class="btn btn-outline-secondary m-auto"
                                        onclick="getTagForm({}, 'create')">Create Tag</button>
                                </div>
                                <div class="col-6 d-flex">
                                    <button type="button" class="btn btn-outline-secondary m-auto"
                                        onclick="getGroupTagForm()">Create Group</button>
                                </div>
                                <div class="col-12 py-3">
                                    <input type="text" name="search_tag" id="search-tag" class="form-control"
                                        placeholder="Find tag by name">
                                </div>
                                <div class="col-12">
                                    <table id="tags-table" class="table table-bordered table-hover">
                                        <thead>
                                            <th>Tags</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document"
                    style="width:800px;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="items_table_estimate_sales" class="table table-hover"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <td> Name</td>
                                                <td>Rebate</td>
                                                <td> Qty</td>
                                                <td> Price</td>
                                                <td> Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($items as $item) { // print_r($item);?>
                                            <tr>
                                                <td><?php echo $item->title; ?>
                                                </td>
                                                <td><?php if ($item->rebate == 1) {?>
                                                    <!-- <label class="switch">
                                                    <input type="checkbox" id="rebatable_toggle" checked>
                                                    <span class="slider round"></span> -->
                                                    <input type="checkbox" class="toggle_checkbox" id="rebatable_toggle"
                                                        item-id="<?php echo $item->id; ?>"
                                                        value="1" data-toggle="toggle" data-size="xs" checked>
                                                    </label>
                                                    <?php } else {?>
                                                    <!-- <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider round"></span>
                                                    </label> -->

                                                    <!-- <input type="checkbox" data-toggle="toggle" data-size="xs"> -->
                                                    <input type="checkbox" class="toggle_checkbox" id="rebatable_toggle"
                                                        item-id="<?php echo $item->id; ?>"
                                                        value="0" data-toggle="toggle" data-size="xs">

                                                    <?php }?>
                                                </td>
                                                <td></td>
                                                <td><?php echo $item->price; ?>
                                                </td>
                                                <td><button
                                                        id="<?=$item->id;?>"
                                                        data-quantity="<?=$item->units;?>"
                                                        data-itemname="<?=$item->title;?>"
                                                        data-price="<?=$item->price;?>"
                                                        type="button" data-dismiss="modal"
                                                        class="btn btn-sm btn-default select_item">
                                                        <span class="fa fa-plus"></span>
                                                    </button></td>
                                            </tr>

                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-detail">
                            <div class="button-modal-list">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span
                                        class="fa fa-remove"></span> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal New Customer -->
            <div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:100px;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pt-0 pl-3 pb-3"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control" autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<div class="sidebarForm" id="addRateSidebar">
    <div class="sidebarForm__inner">
        <div class="sidebarForm__header">
            <div class="sidebarForm__title">Add a custom sales tax rate</div>
            <button data-action="close" class="sidebarForm__close">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <form>
            <div class="form-group">
                <div class="form-check">
                    <input data-type="type" class="form-check-input" type="radio" name="rateType" id="addRate__rateType1" value="single" checked>
                    <label class="form-check-label" for="addRate__rateType1">
                        Single
                    </label>
                </div>
                <div class="form-check">
                    <input data-type="type" class="form-check-input" type="radio" name="rateType" id="addRate__rateType2" value="combined">
                    <label class="form-check-label" for="addRate__rateType2">
                        Combined
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="addRate__name">Name</label>
                <input data-type="name" required type="text" class="form-control" id="addRate__name">
            </div>

            <div class="form-group">
                <label for="addRate__agency">Agency</label>
                <div class="dropdownWithSearch" id="rateAgencySelect">
                    <input required data-type="agency" type="text" class="form-control dropdownWithSearch__input" id="addRate__agency" placeholder="Select agency">
                    <button type="button" class="dropdownWithSearch__btn">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="addRate__rate">Rate</label>
                <div class="d-flex align-items-center">
                    <input required data-type="rate" type="number" class="form-control" id="addRate__rate">
                    <div class="ml-1" style="font-size: 20px; font-family: inherit;">%</div>
                </div>
            </div>
        </form>

        <div class="sidebarForm__footer">
            <button data-action="close" type="button" class="settings__btn mr-2">Cancel</button>
            <button id="addRateBtn" type="button" class="btn btn-primary">Save</button>
        </div>
    </div>
</div>

<div class="modal fade modal-add-by-group" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add By Group</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-0 pl-3 pb-3">
                                        <table id="items_table_newWorkorder" class="table table-hover" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <td> Name</td>
                                                <td> Action</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($packages as $package){ // print_r($item); ?>
                                                <tr>
                                                    <td><?php echo $package->name; ?></td>
                                                    <td>
                                                        <button id="<?= $package->item_categories_id ; ?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default select_package"><span class="fa fa-plus"></span> </button>
                                                </td>
                                                </tr>
                                                
                                            <?php } ?>
                                            </tbody>
                                        </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                    </div>
                </div>
            </div>

            <!-- add manual package -->
            <div class="modal fade createPackage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add/Create Package</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-0 pl-3 pb-3" id="divcreatePackage">
                                <section id="tabs" class="project-tab">
                                    <!-- <div class="container"> -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <nav>
                                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Package</a>
                                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Create Package</a>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent">
                                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        <!-- <div class="container"> -->
                                                            <table class="table table-condensed"  id="myTable">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID #</th>
                                                                        <th>Package Name</th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Amount</th>
                                                                        <th>Action</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="panel">
                                                                <?php foreach($itemPackages as $pItems){ ?>
                                                                    <tr data-toggle="collapse" data-target="#demo<?php echo  $pItems->id; ?>" data-parent="#myTable" id="packageID" pack-id="<?php echo  $pItems->id; ?>">
                                                                        <td><?php echo  $pItems->id; ?></td>
                                                                        <td><?php echo  $pItems->name; ?></td>
                                                                        <td></td>
                                                                        <td class="text-success"></td>
                                                                        <td class="text-success"><?php echo  $pItems->amount_set; ?></td>
                                                                        <td class="text-error"><button id="<?= $pItems->id; ?>" pack-id="<?= $pItems->id; ?>"  class="btn btn-sm btn-default addNewPackageToList"><span class="fa fa-plus"></span></button></td>
                                                                        <td><i class="fa fa-sort-down" style="font-size:24px"></i></td>
                                                                    </tr>
                                                                    <tr id="demo<?php echo  $pItems->id; ?>" class="collapse">
                                                                        <td colspan="6" class="hiddenRow"><div id="packageItems<?php echo  $pItems->id; ?>"></div> </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                    <!-- <tr data-toggle="collapse" data-target="#demo2" data-parent="#myTable">
                                                                        <td>2</td>
                                                                        <td>05 May 2013</td>
                                                                        <td></td>
                                                                        <td class="text-success"></td>
                                                                        <td class="text-error"></td>
                                                                        <td class="text-success">$600.00</td>
                                                                        <td><i class="fa fa-sort-down" style="font-size:24px"></i></td>
                                                                    </tr>
                                                                    <tr id="demo2" class="collapse">
                                                                        <td colspan="6" class="hiddenRow"><div>Demo2</div></td>
                                                                    </tr>
                                                                    <tr data-toggle="collapse" data-target="#demo3" data-parent="#myTable">
                                                                        <td>3</td>
                                                                        <td>05 May 2013</td>
                                                                        <td></td>
                                                                        <td class="text-success"></td>
                                                                        <td class="text-error"></td>
                                                                        <td class="text-success">$661.00</td>
                                                                        <td><i class="fa fa-sort-down" style="font-size:24px"></i></td>
                                                                    </tr>
                                                                    <tr id="demo3" class="collapse">
                                                                        <td colspan="6" class="hiddenRow"><div>Demo3</div></td>
                                                                    </tr> -->
                                                                </tbody>
                                                            </table>
                                                        <!-- </div> -->
                                                    </div>
                                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="width:100%;">
                                                        <input type="hidden" name="count" value="0" id="count">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            <h6>Package Name</h6> <input type="text" class="form-control" style="width:80%;" name="package_name" id="package_name">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <table class="table table-hover" style="width:100%;">
                                                            <input type="hidden" name="count" value="0" id="count">
                                                            <thead style="background-color:#E9E8EA;">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Group</th>
                                                                <!-- <th>Description</th> -->
                                                                <th width="150px">Quantity</th>
                                                                <!-- <th>Location</th> -->
                                                                <th width="150px">Price</th>
                                                                <!-- <th class="hidden_mobile_view" width="150px">Discount</th>
                                                                <th class="hidden_mobile_view" width="150px">Tax (Change in %)</th> -->
                                                                <!-- <th class="hidden_mobile_view">Total</th> -->
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="items_package_table">
                                                                <!-- <tr>
                                                                    <td width="35%">
                                                                        <input type="text" class="form-control getItemsPackage"
                                                                            onKeyup="getItemsPackage(this)" name="itemsPackage[]">
                                                                        <ul class="suggestions"></ul>
                                                                        <div class="show_mobile_view"><span class="getItems_hidden"></span></div>
                                                                        <input type="hidden" name="itemid[]" id="itemid" class="itemid_package" value="0">
                                                                    </td>
                                                                    <td width="25%">
                                                                    <div class="dropdown-wrapper">
                                                                        <select name="item_typePackage[]" id="item_typeid" class="form-control">
                                                                            <option value="product">Product</option>
                                                                            <option value="material">Material</option>
                                                                            <option value="service">Service</option>
                                                                            <option value="fee">Fee</option>
                                                                        </select>
                                                                    </div>
                                                                    </td>
                                                                    <td width=""><input type="number" class="form-control quantityPackage" name="quantityPackage[]"
                                                                            data-counter="0" id="quantity_package_0" value="1"></td>
                                                                    <td width=""><input type="number" class="form-control price_package hidden_mobile_view" name="pricePackage[]"
                                                                            data-counter="0" id="price_package_0" min="0" value="0"> <input type="hidden" class="priceqty priceqty_package" value="0" id="priceqty_0"> 
                                                                            <div class="show_mobile_view"><span class="price">0</span>
                                                                            </div><input id="priceqty_package_0" value="0"  type="hidden" name="price_qty[]" class="form-control hidden_mobile_view priceqty_package"></td>
                                                                    
                                                                    <td><a href="#" class="remove btn btn-sm btn-success" id="0"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                                </tr> -->
                                                                </tbody>
                                                        </table>
                                                        <a class="link-modal-open" href="#" id="add_another_itemss" data-toggle="modal" data-target="#item_list_package" style="float:left;"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <table>
                                                                    <tr>
                                                                        <td><b>Total Price</b> <input type="text" class="form-control" style="width:90%;" name="package_price" id="package_price"></td>
                                                                        <td><b>Set Package Price</b> <input type="text" class="form-control" style="width:90%;" name="package_price_set" id="package_price_set"></td>
                                                                    <tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                            </div>
                                                            <div class="col-md-6" align="right">
                                                                <!-- <div style="align:right;"> -->
                                                                    <button type="button" class="btn btn-primary addCreatePackage">Create/Add Package</button>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </section>
                                    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                    </div>
                </div>
            </div>
            
            <!-- edd package -->

<?php include viewPath('accounting/add_new_term');?>
<?php include viewPath('includes/footer_accounting');?>
<script>
    // document.getElementById('contact_mobile').addEventListener('input', function (e) {
    //     var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    //     e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    // });
    // document.getElementById('contact_phone').addEventListener('input', function (e) {
    //     var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    //     e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    // });

    // function validatecard() {
    //     var inputtxt = $('.card-number').val();

    //     if (inputtxt == 4242424242424242) {
    //         $('.require-validation').submit();
    //     } else {
    //         alert("Not a valid card number!");
    //         return false;
    //     }
    // }

    $(document).ready(function() {
        $('#datepickerinv222').datepicker({
            uiLibrary: 'bootstrap'
        });
    });
</script>
<script>
    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }


    $(document).ready(function () {
        $('#sel-customer').select2();
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";

        /*$('#customers')
            .empty() //empty select
            .append($("<option/>") //add option tag in select
                .val(customer_id) //set value for option to post it
                .text("<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>")) //set a text for show in select
            .val(customer_id) //select option of select2
            .trigger("change"); //apply to select2*/
    });
</script>

<script>

$(document).ready(function(){
 
    $('#sel-customer').change(function(){
    var id  = $(this).val();
    // alert(id);

        $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>accounting/addLocationajax",
            data: {id : id },
            dataType: 'json',
            success: function(response){
                // alert('success');
                // console.log(response['customer']);
            // $("#job_location").val(response['customer'].mail_add + ' ' + response['customer'].cross_street + ' ' + response['customer'].city + ' ' + response['customer'].state + ' ' + response['customer'].country);

            // var phone = response['customer'].phone_h;
            // var new_phone = phone.value.replace(/(\d{3})\-?/g,'$1-');
            var phone = response['customer'].phone_h;
                // phone = normalize(phone);
            
            var mobile = response['customer'].phone_m;
                // mobile = normalize(mobile);

            var test_p = phone.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            var test_m = mobile.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3")
            
            $("#job_location").val(response['customer'].mail_add);
            $("#email").val(response['customer'].email);
            $("#date_of_birth").val(response['customer'].date_of_birth);
            $("#phone_no").val(test_p);
            $("#mobile_no").val(test_m);
            $("#city").val(response['customer'].city);
            $("#state").val(response['customer'].state);
            $("#zip").val(response['customer'].zip_code);
            $("#cross_street").val(response['customer'].cross_street);
            $("#acs_fullname").val(response['customer'].first_name +' '+ response['customer'].last_name);

            $("#job_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);

            $("#primary_account_holder_name").val(response['customer'].first_name + ' ' + response['customer'].last_name);
        
            },
                error: function(response){
                alert('Error'+response);
       
                }
        });

        function normalize(phone) {
            //normalize string and remove all unnecessary characters
            phone = phone.replace(/[^\d]/g, "");

            //check if number length equals to 10
            if (phone.length == 10) {
                //reformat and return phone number
                return phone.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
            }

            return null;
        }

    });

});

</script>
<!-- <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlMWhWMHlxQzuolWb2RrfUeb0JyhhPO9c&libraries=places"></script> -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=google_credentials()['api_key']?>&callback=initialize&libraries=&v=weekly"></script>
<script>
    function initialize() {
        var input = document.getElementById('job_location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
    $(document).ready(function() {

        $('#sel-customer').change(function() {
            var id = $(this).val();
            // alert(id);

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>accounting/addLocationajax",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // alert('success');
                    // console.log(response['customer']);

                    if (response['customer'].cross_street.trim().length == 0) {
                        var cross = '';
                    } else {
                        var cross = response['customer'].cross_street;
                    }

                    if (response['customer'].city.trim().length == 0) {
                        var city = '';
                    } else {
                        var city = response['customer'].city;
                    }

                    if (response['customer'].state.trim().length == 0) {
                        var state = '';
                    } else {
                        var state = response['customer'].state;
                    }

                    if (response['customer'].country.trim().length == 0) {
                        var country = '';
                    } else {
                        var country = response['customer'].country;
                    }


                    $("#job_location").val(cross + ' ' + city + ' ' + state + ' ' +
                        country);
                    $("#customer_email").val(response['customer'].email);
                    $("#shipping_address").val(response['customer'].mail_add);
                    $("#billing_address").val(response['customer'].mail_add);

                },
                error: function(response) {
                    alert('Error' + response);

                }
            });
        });
        $(document).on('click', '.setmarkup', function() {
            // alert('yeah');
            var markup_amount = $('#markup_input').val();

            $("#markup_input_form").val(markup_amount);
            $("#span_markup_input_form").text(markup_amount);
            $("#span_markup").text(markup_amount);

            $('#modalSetMarkup').modal('toggle');
        });
    });
</script>

<script>
    //dropdown checkbox
    var expanded = false;

    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#group-tags-select2').select2({
            ajax: {
                url: '/accounting/get-group-tags',
                dataType: 'json'
            }
        });

        $('#tags_table').DataTable({
            autoWidth: false,
            searching: false,
            processing: true,
            serverSide: true,
            lengthChange: false,
            pageLength: 50,
            ordering: false,
            info: false,
            paging: false,
            ajax: {
                url: 'load-all-tags/',
                dataType: 'json',
                contentType: 'application/json',
                type: 'POST',
                data: function(d) {
                    return JSON.stringify(d);
                },
                pagingType: 'full_numbers',
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'transactions',
                    name: 'transactions',
                },
                {
                    data: 'actions',
                    name: 'actions',
                }
            ],
            fnCreatedRow: function(nRow, aData, iDataIndex) {
                if (aData['type'] === 'group-tag') {
                    $(nRow).attr('id', `child-${aData['parentIndex']}`);
                    $(nRow).addClass('collapse bg-muted');
                }
            }
        });
    });
</script>
<script>
        // function validatecard() {
        //     var inputtxt = $('.card-number').val();

        //     if (inputtxt == 4242424242424242) {
        //         $('.require-validation').submit();
        //     } else {
        //         alert("Not a valid card number!");
        //         return false;
        //     }
        // }

        $(document).ready(function () {

            // phone type change, add the value to hiddend field and show the text
            $(document.body).on('click', '.taxRateSelect__item', function () {
                $(this).closest('.taxRateSelect').find('.type-text').text($(this).text());
                $(this).closest('.taxRateSelect').find('.type-input').val($(this).data('type-value'));
            });
        });
</script>

<script>
// $('.addCreatePackage').on('click', function(){
$(".addCreatePackage").click(function () {
// var item = $("#itemidPackage").val();
var item = $('input[name="itemidPackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var type = $('input[name="item_typePackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var quantity = $('input[name="quantityPackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var price = $('input[name="pricePackage[]"]').map(function () {
    return this.value; // $(this).val()
}).get();

var package_name =  $("#package_name").val();
var package_price =  $("#package_price").val();
var package_price_set =  $("#package_price_set").val();

// console.log('items '+item);
// console.log('type '+type);
// console.log('quantity '+quantity);
// console.log('price '+price);
    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/createPackage",
        data : {item: item, type:type, quantity:quantity, price:price, package_price:package_price, package_name:package_name, package_price_set:package_price_set },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

                $("#balanceDueText").text(grand_total_w.toFixed(2));

        },
    });

    

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    $("#divcreatePackage").load(" #divcreatePackage");

});
</script>

<script>
$(".addNewPackageToList").click(function () {
    var packId = $(this).attr('pack-id');

    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>workorder/addNewPackageToList",
        data : {packId: packId },
        dataType: 'json',
        success: function(response){

        // console.log(result);
        var Randnumber = 1 + Math.floor(Math.random() * 99999);

        console.log(response['pName']);

                    // var inputs1 = "";
                        $.each(response['pName'], function (a, b) {
                            // inputs1 += b.name;
                            var pName = b.name;
                            // var Rnumber = 3 + Math.floor(Math.random() * 9);
                            var Rnumber = Math.floor(Math.random()*(9999-10000+1)+100);

                        

                markup = "<tr id=\"ss\">" +
                        // "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control getItems\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"><div class=\"show_mobile_view\"><span class=\"getItems_hidden\">"+title+"</span></div><input type=\"hidden\" name=\"itemidPackage[]\" id=\"itemidPackage\" class=\"itemid\" value='"+idd+"'></td>\n" +
                        // "<td width=\"25%\"><div class=\"dropdown-wrapper\"><select name=\"item_typePackage[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></div></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='quantity_package_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantityPackage[]\" data-counter=\"0\"  min=\"0\" class=\"form-control quantityPackage2\"></td>\n" +
                        // "<td width=\"\"><input data-itemid='"+idd+"' id='price_package_"+idd+"' value='"+price+"'  type=\"number\" name=\"pricePackage[]\" class=\"form-control price_package2 hidden_mobile_view\" placeholder=\"Unit Price\"><input type=\"hidden\" class=\"priceqty\" id='priceqty_package_"+idd+"' value='"+total_+"'><div class=\"show_mobile_view\"><span class=\"price\">"+price+"</span></div></td>\n" +
                        // "<td>\n" +
                        // "<a href=\"#\" class=\"remove btn btn-sm btn-success\" id='"+idd+"'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>\n" +
                        // "</td>\n" +
                        "<td colspan=\"6\" ><h6>"+ pName +"</h6><div><table class=\"table table-hover\" ><thead><th width=\"10%\" ></th><th>Item Name</th><th>Quantity</th><th>Price</th></thead> <tbody id='packageBody"+Randnumber+"'>" +
                        "<input type=\"hidden\" class=\"priceqty\" id='priceqty_"+Rnumber+"' value='"+b.amount_set+"'><input type=\"hidden\" name=\"itemid[]\" value=\"0\"><input type=\"hidden\" name=\"packageID[]\" value='"+b.id+"'><input type=\"hidden\" name=\"quantity[]\" value=\"1\"><input type=\"hidden\" name=\"price[]\" value='"+b.amount_set+"'><input type=\"hidden\" name=\"tax[]\" value=\"0\"><input type=\"hidden\" name=\"discount[]\" value=\"0\">"+

                        "</tbody></table></div></td>\n" +
                        "<td style=\"text-align: center\" class=\"hidden_mobile_view\" width=\"15%\">$ <span data-subtotal='"+b.amount_set+"' id='span_total_"+Rnumber+"' class=\"total_per_item\">"+b.amount_set+
                        "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+Rnumber+"' value='"+b.amount_set+"'></td>" +
                    "</tr>";
                    tableBody = $("#jobs_items_table_body");
                    tableBody.append(markup);
                });
                    
                    var inputs = "";
                        $.each(response['details'], function (i, v) {
                            inputs += v.package_name ;
                            // "<tr>"+
                            // "<td>"+ v.item_id +"</td>"+
                            // "<td>"+ v.quantity +"</td>"+
                            // "<td>"+ v.price +"</td>"+
                            // "</tr>"+
                        // });

                    markup2 = "<tr width=\"10%\" id=\"sss\">" +
                        // "<tr>"+
                            "<td></td>"+
                            "<td>"+ v.title +"</td>"+
                            "<td>"+ v.quantity +"</td>"+
                            "<td>"+ v.price +"</td>"+
                        "</tr>";
                    tableBody2 = $("#packageBody"+Randnumber);
                    tableBody2.append(markup2);

                });


                var priceqty2 = 0;
                $('*[id^="priceqty_"]').each(function(){
                priceqty2 += parseFloat($(this).val());
                });
                $("#item_total").val(priceqty2.toFixed(2));
                $("#span_sub_total_invoice").text(priceqty2.toFixed(2));

                
                var subtotal = 0;
                // $("#span_total_0").each(function(){
                $('*[id^="span_total_"]').each(function(){
                subtotal += parseFloat($(this).text());
                });
                var s_total = subtotal.toFixed(2);
                var adjustment = $("#adjustment_input").val();
                var grand_total = s_total - parseFloat(adjustment);
                var markup = $("#markup_input_form").val();
                var grand_total_w = grand_total + parseFloat(markup);
                $("#grand_total_inputs").val(grand_total_w.toFixed(2));
                $("#grand_total").text(grand_total_w.toFixed(2));
                $("#grand_total_input").val(grand_total_w.toFixed(2));
                $("#payment_amount").val(grand_total_w.toFixed(2));

                $("#balanceDueText").text(grand_total_w.toFixed(2));

        },
    });

    $(".createPackage").modal("hide");
    // $('#divcreatePackage').load(window.location.href +  '#divcreatePackage');
    // $(document.body).on('hidden.bs.modal', function () {
    //     $('.createPackage').removeData('bs.modal')
    // });
    // $("#divcreatePackage").load(" #divcreatePackage");

});
</script>
<script>
// $("#packageID").click(function () {
$(document).ready(function()
{
    // $( "#packageID" ).each(function(i) {
    //     $(this).on("click", function(){
    //     var packId = $(this).attr('pack-id');
    //     alert(packId);
        $.ajax({
            type : 'POST',
            url : "<?php echo base_url(); ?>workorder/getPackageItemsById",
            // data : {packId: packId },
            dataType: 'json',
            success: function(response){
                var inputs = "";
                $.each(response['pItems'], function (i, v) {
                    // inputs += v.package_name ;
                    markup2 = "<tr>" +
                                "<td></td>"+
                                "<td>"+ v.title +"</td>"+
                                "<td>"+ v.quantity +"</td>"+
                                "<td>"+ v.price +"</td>"+
                            "</tr>";
                        tableBody2 = $("#packageItems"+v.package_id);
                        tableBody2.append(markup2);
                });
            },
        // });
        // });
    });
});
</script>