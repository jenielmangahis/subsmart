<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<link href="<?php echo $url->assets ?>dashboard/css/accounting.css"
        rel="stylesheet" type="text/css">
<!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" style="background-color:white;">
            <div style="padding-top:1%;">
                <h3 style="font-family: Sarabun, sans-serif">Deposits from Payments</h3>
            </div>

            <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;">
                Good accounting gives businesses an easy way to manage bookkeeping with tools to record payments,
                deposits, costs. Deposits are recorded in your account register making it easy to reverse any errors
                from your company’s payment record or un-deposited funds.
            </div>
            <div class="page-title-box mx-4">

            <div class="col-md-12 banking-tab-container" style="background-color:white;">

                <a href="<?php echo url('/accounting/sales-overview')?>"
                    class="banking-tab">Overview</a>
                <a href="<?php echo url('/accounting/all-sales')?>"
                    class="banking-tab">All Sales</a>
                <a href="<?php echo url('/accounting/newEstimateList')?>"
                    class="banking-tab">Estimates</a>
                <a href="<?php echo url('/accounting/customers')?>"
                    class="banking-tab">Customers</a>
                <a href="<?php echo url('/accounting/deposits')?>"
                    class="banking-tab-active text-decoration-none">Deposits</a>
                <a href="<?php echo url('/accounting/listworkOrder')?>"
                    class="banking-tab">Work Order</a>
                <a href="<?php echo url('/accounting/invoices')?>"
                    class="banking-tab">Invoices</a>
                <a href="<?php echo url('/accounting/jobs ')?>"
                    class="banking-tab">Jobs</a>
                <a href="<?php echo url('/accounting/products-and-services')?>"
                    class="banking-tab">Products and Services</a>
            </div>

            <!-- <div style="background-color:white;height:700px;padding:2%;margin-top:1.2%;margin-left:-24px;"> -->
            <!-- <h3 style="font-family: Sarabun, sans-serif">&nbsp;Deposits from Payments</h3> -->
            <div class="col-md-12">
                <!-- </div> -->
                <div class="row">
                    <div class="col-lg-12 px-0">
                    <br>
                    <p><h2>Deposits from <?php echo $clients->business_name; ?> Payments</h2></p> <br>
                        
                    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
                    <div class="accordion"> 
                        <ul class="accordion__list">
                            <?php foreach($invoices as $inv){ ?>
                            <li class="accordion__item">
                            <div class="accordion__itemTitleWrap">
                                <h3 class="accordion__itemTitle">Deposit yesterday <br>
                                    <small class="help help-sm">3 transactions</small>
                                    <small class="help help-sm" style="float:right;text-align:right;">$<?php echo number_format($inv->groupAmount,2); ?> <br> Fees: $1.82 </small>
                                </h3>
                                <div class="accordion__itemIconWrap"><svg viewBox="0 0 24 24"><polyline fill="none" points="21,8.5 12,17.5 3,8.5 " stroke="#000" stroke-miterlimit="10" stroke-width="2"/></svg></div>
                            </div>
                            <div class="accordion__itemContent">
                                <br>
                                <small class="help help-sm">Batch created: yesterday</small>
                                <small class="help help-sm" style="float:right;text-align:right;">Net amount: $48.09 </small>
                                <br>
                                <small class="help help-sm">Deposit ID: 6095509905</small>
                                <small class="help help-sm" style="float:right;text-align:right;">REGIONS BANK (...1234) </small>
                                <br>

                                <p>Your money is on the way.</p>

                                <table class="table">
                                    <thead>
                                        <th>Customer</th>
                                        <th>Payment Method</th>
                                        <th>Reference No.</th>
                                        <th>nSmarTrac Record</th>
                                        <th>Fees</th>
                                        <th>Amount</th>
                                    </thead>
                                    <tr>
                                        <td><?php echo $inv->first_name .' '. $inv->last_name; ?></td>
                                        <td><?php echo $inv->payment_method; ?></td>
                                        <td><?php echo $inv->reference_number; ?></td>
                                        <td><a target="_blank" href="<?php echo base_url('invoice/genview/' . $inv->id) ?>" style="color:blue;">Invoice</a></td>
                                        <td>Tip: $<?php echo number_format($inv->invoice_tip,2); ?></td>
                                        <td>$<?php echo number_format($inv->invoice_amount,2); ?></td>
                                    </tr>
                                </table>
                            </div>
                            </li>

                            <?php } ?>
                            
                        </ul>
                    </div>


                    </div>
                </div>
                <!-- end row -->
                <div class="row ml-2"></div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
</div>


<!-- Start modal  -->

<style>
    #modal-dialog2 {
        position: absolute;
        top: 50px;
        right: 100px;
        bottom: 0;
        left: 10%;
        z-index: 10040;
        overflow: auto;
        overflow-y: auto;
    }
</style>

<!-- Modal for add account-->
<div class="full-screen-modal">
    <div id="addinvoiceModal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                        Details
                    </div>
                    <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal"
                        aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <form
                        action="<?php echo site_url()?>accounting/addInvoice"
                        method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Customer
                                        <select class="form-control" name="customer_id">
                                            <option></option>
                                            <?php foreach ($customers as $customer) : ?>
                                            <option
                                                value="<?php echo $customer->prof_id; ?>">
                                                <?php echo $customer->first_name . ' ' . $customer->last_name; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        Customer email
                                        <input type="email" class="form-control" name="customer_email">
                                        <input type="checkbox"> Send later
                                    </div>
                                    <div class="col-md-3">
                                        Online payments<br>
                                        <input type="checkbox" name="online_payments" value="1" checked> Cards<br>
                                        <input type="checkbox" name="online_paymentss[]" value="2" checked> Bank
                                        Transfer
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Billing address
                                        <textarea style="height:100px;width:100%;" name="billing_address"></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        Terms
                                        <select class="form-control" name="terms" id="addNewTerms1">
                                            <option></option>
                                            <!-- <option>Add New</option>
                                            <option>John Doe</option>-->
                                            <option value="0">Add New</option>
                                            <?php foreach ($terms as $term) : ?>
                                            <option
                                                value="<?php echo $term->id; ?>">
                                                <?php echo $term->description . ' ' . $term->day; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select><br><br>
                                        Ship via<br>
                                        <input type="text" class="form-control" name="ship_via">
                                    </div>
                                    <div class="col-md-3">
                                        Invoice date<br>
                                        <input type="text" class="form-control" name="invoice_date"
                                            id="datepickerinv"><br>
                                        Shipping date<br>
                                        <input type="text" class="form-control" name="shipping_date"
                                            id="datepickerinv2">
                                    </div>
                                    <div class="col-md-3">
                                        Due date<br>
                                        <input type="text" class="form-control" name="due_date" id="datepickerinv3"><br>
                                        Tracking no.<br>
                                        <input type="text" class="form-control" name="tracking_number">
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        Shipping to
                                        <textarea style="height:100px;width:100%;"
                                            name="shipping_to_address"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Tags <a href="#" style="float:right">Manage tags</a>
                                        <input type="text" class="form-control"> -->
                                        <div id="label">
                                            <label for="tags">Tags</label>
                                            <span class="float-right"><a href="#" class="text-info" data-toggle="modal"
                                                    data-target="#tags-modal" id="open-tags-modal">Manage
                                                    tags</a></span>
                                        </div>
                                        <select name="tags[]" id="tags"
                                            class="form-control js-example-basic-multiple js-data-example-ajax"
                                            multiple="multiple"></select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6" align="right">
                                AMOUNT<h2>$0.00</h2><br>
                                Location of sale<br>
                                <input type="text" name="total_amount" id="total_amount">
                                <input type="text" class="form-control" style="width:200px;" name="location_scale">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="reportstable">
                                    <thead>
                                        <th></th>
                                        <th>#</th>
                                        <th>PRODUCT/SERVICE</th>
                                        <th>DESCRIPTION</th>
                                        <th>QTY</th>
                                        <th>RATE</th>
                                        <th>AMOUNT</th>
                                        <th>TAX</th>
                                        <th></th>
                                    </thead>
                                    <tr>
                                        <td></td>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="prod[]"></td>
                                        <td><input type="text" class="form-control" name="desc[]"></td>
                                        <td><input type="text" class="form-control" name="qty[]"></td>
                                        <td><input type="text" class="form-control" name="rate[]"></td>
                                        <td><input type="text" class="form-control" name="amount[]"></td>
                                        <td><input type="text" class="form-control" name="tax[]"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" name="prod[]"></td>
                                        <td><input type="text" class="form-control" name="desc[]"></td>
                                        <td><input type="text" class="form-control" name="qty[]"></td>
                                        <td><input type="text" class="form-control" name="rate[]"></td>
                                        <td><input type="text" class="form-control" name="amount[]"></td>
                                        <td><input type="text" class="form-control" name="tax[]"></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-1">
                                        <button class="btn1">Add lines</button>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn1">Clear all lines</button>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn1">Add subtotal</button>
                                    </div>
                                    <div class="col-md-7">
                                    </div>
                                    <div class="col-md-1">
                                        <b>Subtotal</b>
                                    </div>
                                    <div class="col-md-1">
                                        <b>$0.00</b>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-2">
                                        Message on invoice<br>
                                        <textarea style="height:100px;width:100%;"
                                            name="message_on_invoice"></textarea><br>
                                        Message on statement<br>
                                        <textarea style="height:100px;width:100%;"
                                            name="message_on_statement"></textarea>
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-2">
                                        Taxable subtotal <b>$0.00</b><br>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td></td>
                                                <td><b>$0.00</b><br><a href="">See the math</a></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>Tax on shipping</td>
                                                <td>0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Balance due</td>
                                                <td>$0.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="file-upload">
                                            <button class="file-upload-btn" type="button"
                                                onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" type='file' onchange="readURL(this);"
                                                    accept="image/*" name="file_name/>
                                        <div class=" drag-text">
                                                <i>Drag and drop files here or click the icon</i>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()"
                                                    class="remove-image">Remove <span class="image-title">Uploaded
                                                        File</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                </div>
                            </div>
                            <hr>
                            <div class="modal-footer-check">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button class="btn btn-dark cancel-button" id="closeCheckModal"
                                            type="button">Cancel</button>

                                    </div>
                                    <div class="col-md-5" align="center">
                                        <div class="middle-links">
                                            <a href="">Print or Preview</a>
                                        </div>
                                        <div class="middle-links end">
                                            <a href="">Make recurring</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="dropdown" style="float: right">
                                            <button class="btn btn-dark cancel-button px-4" type="submit">Save</button>
                                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                                id="checkSaved" style="border-radius: 20px 0 0 20px">Save and
                                                new</button>
                                            <button class="btn btn-success" type="button" data-toggle="dropdown"
                                                style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="#" data-dismiss="modal" id="checkSaved">Save and close</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>

                </div>

                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg"
                            style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and
                        security of your information are top priorities.</span>
                </div>
                <div style="margin: auto">
                    <a href="" style="text-align: center">Privacy</a>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>
<script>
  var Accordion = function() {
  
  var
    toggleItems,
    items;
  
  var _init = function() {
    toggleItems     = document.querySelectorAll('.accordion__itemTitleWrap');
    toggleItems     = Array.prototype.slice.call(toggleItems);
    items           = document.querySelectorAll('.accordion__item');
    items           = Array.prototype.slice.call(items);
    
    _addEventHandlers();
    TweenLite.set(items, {visibility:'visible'});
    TweenMax.staggerFrom(items, 0.9,{opacity:0, x:-100, ease:Power2.easeOut}, 0.3)
  }
  
  var _addEventHandlers = function() {
    toggleItems.forEach(function(element, index) {
      element.addEventListener('click', _toggleItem, false);
    });
  }
  
  var _toggleItem = function() {
    var parent = this.parentNode;
    var content = parent.children[1];
    if(!parent.classList.contains('is-active')) {
      parent.classList.add('is-active');
      TweenLite.set(content, {height:'auto'})
      TweenLite.from(content, 0.6, {height: 0, immediateRender:false, ease: Back.easeOut})
      
    } else {
      parent.classList.remove('is-active');
      TweenLite.to(content, 0.3, {height: 0, immediateRender:false, ease: Power1.easeOut})
    }
  }
  
  return {
    init: _init
  }
  
}();

Accordion.init();
</script>

<?php include viewPath('accounting/add_new_term'); ?>

<!-- end sa modal -->

<!-- page wrapper end -->
<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>

<?php include viewPath('includes/footer_accounting');