<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box mx-4">
                <div class="row pb-2">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/expenses')?>" class="banking-tab" style="text-decoration: none">Expenses</a>
                        <a href="<?php echo url('/accounting/vendors')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="vendors")?:'-active';?>">Vendors</a>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                    <div class="col-md-12 px-0" >
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Vendors</h2>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <div class="dropdown" style="position: relative;display: inline-block;">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#pay-bills-modal" style="border-radius: 20px 0 0 20px">Pay bills</button>
                                    <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#">Prepare 1099s</a></li>
                                        <li><a href="#">Order Checks</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown" style="position: relative;display: inline-block;">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#new-vendor-modal" style="border-radius: 20px 0 0 20px">New vendor</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -3px;">
                                        <span class="fa fa-caret-down"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-left">
                                        <li><a href="#">Import vendors</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tableContainer moneyBar">
                                    <div class="unpaid-bar-container">
                                        <div class="unpaid-bar-header">
                                            Unpaid 365 days
                                        </div>
                                        <div class="overdue-bar">
                                            <div class="overdue-bar-header">
                                                <h4>0</h4>
                                                <span>OPEN BILLS</span>
                                            </div>
                                            <div class="openbills-bar">
                                                <div class="openbills-bar-header">
                                                    <h4>0</h4>
                                                    <span>OVERDUE</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paid-bar-container">
                                        <div class="paid-header">
                                            Paid
                                        </div>
                                        <div class="paid-bar">
                                            <div class="paid-bar-header">
                                                <h4>39</h4>
                                                <span>PAID LAST 30 DAYS</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3 bg-white mt-3 mx-0">
                            <div class="col-md-12">
                                <div style="position: relative;">
                                    <div class="arrow-level-down">
                                        <i class="fa fa-level-down fa-flip-horizontal fa-2x icon-arrow"></i>
                                    </div>
                                    <div class="dropdown batch-action-btn" style="display: inline-block;position: relative">
                                        <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px">Batch Action
                                            <span class="fa fa-caret-down"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Email</a></li>
                                            <li><a href="#">Pay Bills Online</a></li>
                                            <li><a href="#">Make inactive</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--                        DataTables-->
                                <table id="vendors_table" class="table table-striped table-bordered" style="width:100%;margin-top: 10px;">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox"></th>
                                        <th>Vendor/Company</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Open Balance</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>Test</td>
                                        <td>Test</td>
                                        <td>Test</td>
                                        <td></td>
                                        <td><a href="">Create bill</a> <span class="caret"></span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- end row -->
            <div class="row">

			</div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <!-- Modal for Pay Bills-->
    <div class="full-screen-modal">
        <div id="pay-bills-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Pay Bills
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-2x"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Payment account</label>
                                <select name="" id="" class="form-control">
                                    <option selected>Cash on hand</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="line-height: 45px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$111,111.00</span>
                            </div>
                            <div class="col-md-2">
                                <label for="">Payment date</label>
                                <input type="text" class="form-control" placeholder="" value="07/09/2020">
                            </div>
                            <div class="col-md-2">
                                <label for="">Starting check no.</label>
                                <input type="text" class="form-control" value="1">
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox">
                                <label for="">Print later</label>
                            </div>
                            <div class="col-md-2" style="text-align: right">
                                <div>TOTAL PAYMENT AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="table-container">
                            <div class="dropdown" style="margin-top: 20px">
                                <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px 20px 20px 20px">Filter
                                    <span class="fa fa-caret-down"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li style="padding: 30px 30px 30px 30px">
                                        <form action="" method="" class="">
                                            <div class="" style="position: relative; display: inline-block;">
                                                <label for="duedate">Due Date</label>
                                                <select name="type" id="duedate" class="form-control">
                                                    <option value="">All transaction</option>
                                                    <option value="">Expenses</option>
                                                    <option value="">Bill</option>
                                                    <option value="">Bill payments</option>
                                                    <option value="">Check</option>
                                                    <option value="">Recently paid</option>
                                                    <option value="">Vendor credit</option>
                                                    <option value="">Credit Card Payment</option>
                                                </select>
                                            </div>
                                            <div style="position: relative; display: inline-block;">
                                                <label for="">From</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div style="position:relative; display: inline-block;margin-left: 10px">
                                                <label for="">To</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="">
                                                <label for="">Payee</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="" selected>All</option>
                                                    <option value="" >Test1</option>
                                                    <option value="" >Test2</option>
                                                </select>
                                            </div>
                                            <div class="">
                                                <input type="checkbox" >
                                                <label for="">Overdue status only</label>
                                            </div>
                                            <div class="">
                                                <button class="btn btn-default" type="reset" style="border-radius: 20px 20px 20px 20px">Reset</button>
                                                <button class="btn btn-success" type="submit" style="border-radius: 20px 20px 20px 20px; float: right;">Apply</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!--                        DataTables-->
                            <table id="payBillsTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>PAYEE</th>
                                    <th>REF NO.</th>
                                    <th>DUE DATE</th>
                                    <th>OPEN BALANCE</th>
                                    <th>CREDIT APPLIED</th>
                                    <th>PAYMENT</th>
                                    <th>TOTAL AMOUNT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer-print">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success print-button">Schedule payment online</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end of modal-->
<!--    Add vendor modal-->
        <div id="new-vendor-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
				<form id="addVendorForm" class="needs-validation" novalidate>
                <div class="modal-content max-width">
                    <div class="modal-header" style="border-bottom: 0">
                        <div class="modal-title">Vendor Information</div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
						
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 56px">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 106px">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 106px">
                                        <label for="">Middle name</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 106px">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 56px">
                                        <label for="">Suffix</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Company</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="" style="margin-right: 10px">Print on check as </label>
										<input type="checkbox"><span style="margin-left: 10px">Use display name</span>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="" style="margin-right: 10px">Address</label>
										<a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                        <textarea name="" id="" cols="30" rows="2" class="form-control" placeholder="Street" required></textarea>
                                        <input type="text" class="form-control address-form" placeholder="City/Town" required>
                                        <input type="text" class="form-control address-form" placeholder="State/Province" required>
                                        <input type="text" class="form-control address-form" placeholder="ZIP Code" required>
                                        <input type="text" class="form-control address-form" placeholder="Country" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Notes</label>
                                        <textarea name="" id="" cols="30" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
										<span>Maximum size: 20MB</span>
                                        <form action="/file-upload" class="dropzone" style="height: 50px;border:1px dashed grey;">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <h4>Get custom fields with Advanced</h4>
                                    <p>Custom fields let you add more detailed info about your customers and transactions.
                                        Sort, track, and report info that's important to you.
                                    </p>
                                    <a href="#" style="color: #0b97c4;">Learn more</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" placeholder="Separate multiple emails with commas" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 126px">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 126px">
                                        <label for="">Mobile</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 126px">
                                        <label for="">Fax</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 126px;">
                                        <label for="">Other</label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-ib" style="width: 255px;">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Billing rate (/hr)</label>
                                        <input type="text" class="form-control" style="width: 35%" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Terms</label>
										<select class="form-control" required>
										  <option value="1">Due on Receipt</option>
										  <option value="2">Net 15</option>
										  <option value="3">Net 30</option>
										  <option value="4">Net 60</option>
										</select>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 147px">
                                        <label for="">Opening balance</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 120px">
                                        <label for="">as of</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 70%">
                                        <label for="">Account no.</label>
                                        <input type="text" class="form-control" placeholder="Appears in the memo of all payment" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 50%">
                                        <label for="">Business ID No.</label>
                                        <input type="text" class="form-control" required>
                                        <input type="checkbox"> <span>Track payment for 1099</span>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 60%">
                                        <label for="">Default expense account</label>
                                        <input type="text" class="form-control" placeholder="Choose Account" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-vendor">
                        <div class="row">
                            <div class="col-md-5">
                                <button type="button" class="btn btn-default btn-tranparent">Cancel</button>
                                <button type="button" class="btn btn-default btn-tranparent">Make inactive</button>
                            </div>
                            <div class="col-md-2" style="text-align: center">
                                <a href="#" >Privacy</a>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-success" type="submit" style="float: right;">Save</button>
                            </div>
                        </div>
						
                    </div>
                </div>
				</form>
            </div>
        </div>
<!--    end of modal-->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // DataTable JS
    $(document).ready(function() {
        $('#vendors_table').DataTable({
            "paging": false,
        });
        $(document).ready(function() {
            $('#payBillsTable').DataTable({
                "paging": false,
                "filter":false
            });
        } );
    } );
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
		  console.log(123);;
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
