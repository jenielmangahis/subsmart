<?php include viewPath('includes/header'); ?>
<link rel="stylesheet" href="<?php echo $url->assets ?>builder/css/alarm.css">
<style>
  .custom-signaturepad {
    padding-left: 0;
    padding-right: 0;
  }
  .custom-signaturepad .sigWrapper canvas {
      width: 100%;
  }
  .custom-signaturepad .sigPad  {
    width: 100% !important;
  }
</style>
<style>

.my-div-container .card { 
    padding:3px !important;
    border:0px ;
}

.my-div-container .card .card-body { 
    padding:0px !important;
}

.my-div-container .card .card-body .row { 
    padding:0px !important;
}

.my-div-container .card .card-body .row .form-group { 
    padding-left:5px;
    padding-right:5px;
    margin-bottom:0px !important;
}

body {
    background: white !important;
}
.my-div-container .card .card-body .row .form-group .box-title { margin:0px; }
 
.float-left { float:left !important; }
.remove-padding { padding:0px !important; }
.one-row-label { line-height: 46px;margin-bottom: 0px !important; }

#table_body tr td {
    padding: 3px 2px !important;
}

label { margin-bottom:0px !important; }
</style>
<div class="wrapper " role="wrapper">
    <?php include viewPath('includes/sidebars/workorder'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid my-div-container">
            <div class="page-title-box">
                <h1 class="page-title">ALARM DIRECT</h1>
                <div class="row align-items-center">
                    <div class="col-sm-8">                        
                        <div class="fogm-bx">
                            <h5 class="box-title">ZONE LIST</h5>
                            <textarea class="form-control" rows="3" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="fogm-bx">
                            <h5 class="box-title">Office use only</h5>
                            <textarea class="form-control" rows="3" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('workorder/save', ['class' => 'form-validate require-validation', 'id' => 'workorder_form', 'autocomplete' => 'off']); ?>


            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- ====== CUSTOMER ====== -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label class="col-md-6 float-left one-row-label pl-0">Customer Type</label>
                                            <select name="customer[customer_type]"
                                                    class="form-control float-left col-md-6"
                                                    id="customer_type">
                                                <?php foreach (get_config_item('customer_types') as $key => $customer_type) { ?>
                                                    <option value="<?php echo $customer_type ?>">
                                                        <?php echo $customer_type ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h5 class="box-title">Customer</h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Customer Name</label>
                                            <input type="text" name="" placeholder="Name" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="" placeholder="Phone Number" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Acct #</label>
                                            <input type="text" name="" placeholder="Acct" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Panel Type/DVR Type</label>
                                            <input type="text" name="" placeholder="Panel Type/DVR Type" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Monitored Location</label>
                                            <input type="text" name="" placeholder="Monitored Location" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>City</label>
                                            <input type="text" name="" placeholder="City" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>State</label>
                                            <input type="text" name="" placeholder="State" class="form-control">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Zip Code</label>
                                            <input type="text" name="" placeholder="Zip Code" class="form-control">
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>

                            <!-- ====== EMERGENCY CALL LIST ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Tech</h5>
                                </div>
                                
                                <div class="col-md-4 form-group">
                                    <label>Tech :</label>
                                    <select class="form-control">
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>2nd Tech :</label>
                                    <select class="form-control">
                                        <option>Tyler</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>3rd Tech :</label>
                                    <select class="form-control">
                                        <option>Tyler</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Panel :</label>
                                    <select class="form-control">
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Location :</label>
                                    <input type="text" name="" placeholder="" class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Plan Type :</label>
                                    <select class="form-control">
                                        <option>Interactive Gold</option>
                                        <option>Brannon</option>
                                        <option>Brannon</option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>RMR :</label>
                                    <input type="text" name="" placeholder="" class="form-control">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Platform :</label>
                                    <select class="form-control">
                                        <option></option>
                                        <option></option>
                                        <option></option>
                                    </select>
                                </div>
                            </div>

                            <!-- ====== EQUIPMENT ====== -->
                            <?php /* ?>
                            <div class="row">
                                
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Additional Equipment/Services</h5>
                                </div>
                                
                                <div class="col-md-3 form-group">
                                    <div class="col-md-6 pl-0" style="float:left;">
                                        <label for="last_name">Type</label>
                                        <select name="panel_communication" class="form-control" id="customer_type">
                                            <option>--SELECT--</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 pr-0 pl-0" style="float:left;">
                                        <label for="last_name">Description</label>
                                        <select name="panel_communication" class="form-control" id="customer_type">
                                            <option>--SELECT--</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-9 form-group">

                                    <div class="col-md-1 form-group" style="float:left;">
                                        <label for="last_name">Qty</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required value="1"/>
                                    </div>

                                    <div class="col-md-4 form-group" style="float:left;">
                                        <label for="last_name">Location</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>
                                    
                                    <div class="col-md-1 form-group" style="float:left;">
                                        <label for="last_name">Cost</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Discount</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Tax</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>

                                    <div class="col-md-2 form-group" style="float:left;">
                                        <label for="last_name">Total</label>
                                        <input type="text" class="form-control" name="customer[company_name]" id="customer_company_name" required />
                                    </div>
                                </div>
                                
                                <div class="col-md-2 form-group">
                                    <button class="btn btn-xs btn-primary">Add Items</button>
                                </div>
                            </div>
                            <?php */ ?>



                            <!-- ====== Additional Equipment/Services ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Equipment</h5>
                                </div>
                                <div class=" col-md-12">
                                    <?php if (!empty($estimate)) { ?>

                                        <div class="row" id="plansItemDiv">
                                            <?php if ($estimate->estimate_items != '') {

                                                $estimate_items = unserialize($estimate->estimate_items);
                                            } else {

                                                $estimate_items = [];
                                            } ?>
                                            <div class="col-md-12 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Intrusion Items</th>
                                                        <th>QTY</th>                                                
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    <?php if (count($estimate_items) > 0) { ?>
                                                        <input type="hidden" name="count"
                                                               value="<?php echo count($estimate_items) > 0 ? count($estimate_items) - 1 : 0; ?>"
                                                               id="count">
                                                        <?php $i = 0;
                                                        foreach ($estimate_items as $row) { ?>

                                                            <tr>
                                                            <td>
                                                                <select name="item_type[]" class="form-control">

                                                                    <option value="material" <?php if ($row['item_type'] == 'material') echo 'selected'; ?>>
                                                                        Material
                                                                    </option>
                                                                    <option value="product" <?php if ($row['item_type'] == 'product') echo 'selected'; ?>>
                                                                        Product
                                                                    </option>
                                                                    <option value="service" <?php if ($row['item_type'] == 'service') echo 'selected'; ?>>
                                                                        Service
                                                                    </option>
                                                                    </select></td><td>
                                                                    <input type="text" class="form-control getItems"
                                                                           onKeyup="getItems(this)" name="item[]"
                                                                           value="<?php echo $row['item']; ?>">
                                                                    <ul class="suggestions"></ul>
                                                                </td>
                                                                
                                                                <td>
                                                                    <input type="text" class="form-control quantity"
                                                                           name="quantity[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="quantity_<?php echo $i; ?>"
                                                                           value="<?php echo $row['quantity'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                           name="location[]"
                                                                           value="<?php echo $row['location'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control price"
                                                                           name="price[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="price_<?php echo $i; ?>" min="0"
                                                                           value="<?php echo $row['price'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="number"
                                                                           value="<?php echo $row['discount'] ?>"
                                                                           class="form-control discount"
                                                                           name="discount[]"
                                                                           data-counter="<?php echo $i; ?>"
                                                                           id="discount_<?php echo $i; ?>" min="0"
                                                                           value="0"
                                                                           readonly>
                                                                </td>
                                                                <td>
															<span id="span_tax_<?php echo $i; ?>"><?php $tax = ($row['price'] * 7.5 / 100) * $row['quantity'];
                                                                echo number_format($tax, 2) ?></span>
                                                                </td>
                                                                <td>
															<span id="span_total_<?php echo $i; ?>"><?php $price = ($row['price'] + $tax) * $row['quantity'];
                                                                echo number_format($price, 2); ?></span>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="remove">X</a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++;
                                                        } ?>

                                                    <?php } else { ?>
                                                        <input type="hidden" name="count" value="0" id="count">
                                                        <tr>
                                                            <td><input type="text" class="form-control getItems"
                                                                       onKeyup="getItems(this)" name="item[]">
                                                                <ul class="suggestions"></ul>
                                                            </td>
                                                            <td><select name="item_type[]" class="form-control">
                                                                    <option value="service">Service</option>
                                                                    <option value="material">Material</option>
                                                                    <option value="product">Product</option>
                                                                </select></td>
                                                            <td><input type="text" class="form-control quantity"
                                                                       name="quantity[]" data-counter="0"
                                                                       id="quantity_0"
                                                                       value="1"></td>
                                                            <td><input type="text" class="form-control"
                                                                       name="location[]"></td>
                                                            <td><input type="number" class="form-control price"
                                                                       name="price[]"
                                                                       data-counter="0" id="price_0" min="0" value="0">
                                                            </td>
                                                            <td><input type="number" class="form-control discount"
                                                                       name="discount[]" data-counter="0"
                                                                       id="discount_0"
                                                                       min="0" value="0" readonly></td>
                                                            <td><span id="span_tax_0">0.00 (7.5%)</span></td>
                                                            <td><span id="span_total_0">0.00</span></td>
                                                        </tr>

                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                               &nbsp; <a href="#" class="btn btn-primary" id="add_another">Add Items</a>
                                            </div>
                                        </div><br/>

                                        <?php
                                        if ($estimate->estimate_eqpt_cost != '') {

                                            $estimate_eqpt_cost = unserialize($estimate->estimate_eqpt_cost);
                                        } else {

                                            $estimate_eqpt_cost = [];
                                        }
                                        ?>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Equipment Cost</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['eqpt_cost'] : 0.00; ?>"
                                                                                               name="eqpt_cost"
                                                                                               id="eqpt_cost"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sales Tax</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['sales_tax'] : 0.00; ?>"
                                                                                               name="sales_tax"
                                                                                               id="sales_tax"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden"
                                                       value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['inst_cost'] : 0.00; ?>"
                                                       name="inst_cost"
                                                       id="inst_cost"
                                                       onfocusout="cal_total_due()"
                                                       class="form-control">
                                                <td>One Time Program and Setup</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['one_time'] : 0.00; ?>"
                                                                                               name="one_time"
                                                                                               id="one_time"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Monthly Monitoring</td>
                                                <td class="d-flex align-items-center">$ <input type="text"
                                                                                               value="<?php echo !empty($estimate_eqpt_cost) ? $estimate_eqpt_cost['m_monitoring'] : 0.00; ?>"
                                                                                               name="m_monitoring"
                                                                                               id="m_monitoring"
                                                                                               onfocusout="cal_total_due()"
                                                                                               class="form-control">
                                                </td>
                                            </tr>
                                        </table>


                                    <?php } else { ?>

                                        <div class="row" id="plansItemDiv">

                                            <div class="col-md-6 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover mb-0">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Intrusion Items</th>
                                                        <th width="100px">QTY</th>
                                                        <th width="100px">Price</th>
                                                        <th width="100px">Total</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    <tr>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select></td>
                                                        <td><input type="text" class="form-control getItems"
                                                                   onKeyup="getItems(this)" name="item[]">
                                                            <ul class="suggestions"></ul>
                                                        </td>
                                                        
                                                        <td><input type="text" class="form-control quantity"
                                                                   name="quantity[]"
                                                                   data-counter="0" id="quantity_0" value="1"></td>
                                                        <td><input type="text" class="form-control" name="location[]">
                                                        </td>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="#" class="btn btn-primary" style="margin-left:5px;" id="add_another">Add Items</a>
                                            </div>
                                            <div class="col-md-6 table-responsive pl-0 pr-0 mb-0">
                                                <table class="table table-hover mb-0">
                                                    <input type="hidden" name="count" value="0" id="count">
                                                    <thead>
                                                    <tr>
                                                        <th>Intrusion Items</th>
                                                        <th width="100px">QTY</th>
                                                        <th width="100px">Price</th>
                                                        <th width="100px">Total</th>
                                                        <th>Stock</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_body">
                                                    <tr>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select></td>
                                                        <td><input type="text" class="form-control getItems"
                                                                   onKeyup="getItems(this)" name="item[]">
                                                            <ul class="suggestions"></ul>
                                                        </td>
                                                        
                                                        <td><input type="text" class="form-control quantity"
                                                                   name="quantity[]"
                                                                   data-counter="0" id="quantity_0" value="1"></td>
                                                        <td><input type="text" class="form-control" name="location[]">
                                                        </td>
                                                        <td><select name="item_type[]" class="form-control">
                                                            <option value="product">Product</option>
                                                            <option value="material">Material</option>
                                                            <option value="service">Service</option>
                                                        </select>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="#" class="btn btn-primary" style="margin-left:5px;" id="add_another">Add Items</a>
                                            </div>

                                            <div class="offset-md-3 col-md-3 pl-0 pr-0 mb-0">
                                                <div class="form-group">
                                                    <label>Total $</label>
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>
                                            <div class="offset-md-3 col-md-3 pl-0 pr-0 mb-0">
                                                <div class="form-group">
                                                    <label>Total $</label>
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="offset-md-9 col-md-3 pl-0 pr-0 mb-0">
                                                <div class="form-group">
                                                    <label>Grand Total $</label>
                                                    <input type="text" name="" class="form-control">
                                                </div>
                                            </div>
                                        </div><br/>

                                    <?php } ?>
                                </div>
                            </div>

                            <!-- ====== TOTAL / BILLING ====== -->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Zone Information</h5>
                                </div>
                                <div class="col-sm-12 col-md-6 pl-0">                                    
                                    <div class="col-md-12 pl-0">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Entry/Exit</th>
                                                    <th>Zn#</th>
                                                    <th>Verified</th>
                                                    <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>1</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>2</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>3</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>4</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c1">
                                                            <label for="c1"></label>
                                                        </div>
                                                    </td>
                                                    <td>5</td>
                                                    <td>
                                                        <div class="checkbox checkbox-sec margin-right mr-4">
                                                            <input type="radio" name="" value="" id="c2">
                                                            <label for="c2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" placeholder="" class="form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- <button class="btn btn-block btn-lg btn-primary">Import</button>-->
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Entry/Exit</th>
                                                <th>Zn#</th>
                                                <th>Verified</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>6</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>7</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>8</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>9</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c1">
                                                        <label for="c1"></label>
                                                    </div>
                                                </td>
                                                <td>10</td>
                                                <td>
                                                    <div class="checkbox checkbox-sec margin-right mr-4">
                                                        <input type="radio" name="" value="" id="c2">
                                                        <label for="c2"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="" placeholder="" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Add Additional Zones</h5>

                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Visa"
                                                       checked="checked"
                                                       id="radio_credit_card">
                                                <label for="radio_credit_card"><span>Duress (92)</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Amex"
                                                       id="radio_credit_cardAmex">
                                                <label for="radio_credit_cardAmex"><span>Fire (95)</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Mastercard"
                                                       id="radio_credit_cardMastercard">
                                                <label for="radio_credit_cardMastercard"><span>Medical (96)</span></label>
                                            </div>
                                            <div class="checkbox checkbox-sec margin-right mr-4">
                                                <input type="radio" name="card[radio_credit_card]" value="Discover"
                                                       id="radio_credit_cardMasterDiscover">
                                                <label for="radio_credit_cardMasterDiscover"><span>Police (99)</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <div class="form-group">
                                                <input type="text" name="" placeholder="# of Key FOBS" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Instalation Notes/Comments :</label>
                                    <textarea class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <h5 class="box-title">Post - Service Summary</h5>
                                </div>

                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Interactive UserID:</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Interactive Password:</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Post-Install Conf #</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Panel Location :</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Transformer Location :</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>Communicator MAC :</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4">
                                    <div class="form-group">
                                        <label>CRC :</label>
                                        <input type="text" name="" placeholder="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="button" onClick="validatecard();"
                                            class="btn btn-flat btn-primary">
                                        Submit
                                    </button>
                                    <a href="<?php echo url('workorder') ?>" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>

                        </div>
                        <!-- end card -->
                    </div>
                </div>


                <div class="modal fade" id="checklistModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select Checklists</h4>
                            </div>
                            <div class="modal-body">
                                <p></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Add Selected</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- page wrapper end -->
    </div>
</div>

<?php echo $file_selection; ?>
<?php include viewPath('includes/footer'); ?>

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

        // phone type change, add the value to hiddend field and show the text
        $(document.body).on('click', '.changePhoneType', function () {
            $(this).closest('.phone-input').find('.type-text').text($(this).text());
            $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
        });


        $('#user_agreementupload').change(function (e) {

            var file = this.files[0];
            var form = new FormData();
            form.append('upload', file);
            $.ajax({
                url: '/docread.php',
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                success: function (response) {
                    /* alert(response); */
                    $('#showuploadagreement').empty().html(response);
                }
            });
        });

    });
</script>
