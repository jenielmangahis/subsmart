<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                                    <button type="button" class="btn btn-success" id="btn-new-vendor-modal" style="border-radius: 20px 0 0 20px">New vendor</button>
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
                                        <th style="width:70px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<!--<?php if(count($vendors) > 0) { ?>
											<?php for($x = 0 ; $x < count($vendors) ; $x++) { ?>
												<tr>
													<td><input type="checkbox"></td>
													<td><?php echo $vendors[$x]->company; ?></td>
													<td><?php echo $vendors[$x]->phone; ?></td>
													<td><?php echo $vendors[$x]->email; ?></td>
													<td><?php echo $vendors[$x]->opening_balance; ?></td>
													<td><a href="">Create bill</a> <span class="caret"></span></td>
												</tr>
											<?php } ?>
										<?php }else{ ?>
											<tr><td cols="6">No data available.</td></tr>
										<?php } ?>-->
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
                            <div class="dropdown " style="margin-top: 20px">
                                <button class="btn btn-default" type="button" data-toggle="dropdown" style="border-radius: 20px;">Filter
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
				<form id="addVendorForm" class="addVendorForm-validation" novalidate>
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
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 106px">
                                        <label for="">First name</label>
                                        <input type="text" name="f_name" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 106px">
                                        <label for="">Middle name</label>
                                        <input type="text" name="m_name" class="form-control">
                                    </div>
                                    <div class="form-ib" style="width: 106px">
                                        <label for="">Last name</label>
                                        <input type="text" name="l_name" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 56px">
                                        <label for="">Suffix</label>
                                        <input type="text" name="suffix" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Company</label>
                                        <input type="text" name="company" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="" style="margin-right: 10px">Print on check as </label>
										<input type="checkbox" value="1" name="to_display"><span style="margin-left: 10px">Use display name</span>
                                        <input type="text" name="display_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="" style="margin-right: 10px">Address</label>
										<a href="https://www.google.com/maps?q=++++" target="_blank" style="color: #0b97c4;">map</a>
                                        <textarea name="street" id="street" cols="30" rows="2" class="form-control" placeholder="Street" required></textarea>
                                        <input name="city" type="text" class="form-control address-form" placeholder="City/Town" required>
                                        <input name="state" type="text" class="form-control address-form" placeholder="State/Province" required>
                                        <input name="zip" type="text" class="form-control address-form" placeholder="ZIP Code" required>
                                        <input name="country" type="text" class="form-control address-form" placeholder="Country" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="">Notes</label>
                                        <textarea name="notes" id="notes" cols="30" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib">
                                        <label for="" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
										<span>Maximum size: 20MB</span>
                                        <form action="/file-upload" class="dropzone" style="height: 50px;border:1px dashed grey;">
                                            <div class="fallback">
                                                <input name="attachFiles" type="file" multiple />
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
                                        <input type="text" class="form-control" name="email" placeholder="Separate multiple emails with commas" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 129px">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 129px">
                                        <label for="">Mobile</label>
                                        <input type="text" name="mobile" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 129px">
                                        <label for="">Fax</label>
                                        <input type="text" name="fax" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <!--<div class="form-ib" style="width: 126px;">
                                        <label for="">Other</label>
                                        <input type="text" class="form-control">
                                    </div>-->
                                    <div class="form-ib">
                                        <label for="">Website</label>
                                        <input type="text" name="website" class="form-control">
                                    </div>
                                </div>
                                <div class="form-ib-group">
									<div class="form-ib" style="width: 126px;">
                                        <label for="">Billing rate (/hr)</label>
                                        <input type="text" name="billing_rate" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 265px;">
                                        <label for="">Terms</label>
										<select class="form-control" name="terms" required>
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
                                        <input type="text" name="opening_balance" class="form-control" required>
                                    </div>
                                    <div class="form-ib" style="width: 190px">
                                        <label for="">as of</label>
                                        <input type="date" name="opening_balance_as_of_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 70%">
                                        <label for="">Account no.</label>
                                        <input type="text" name="account_number" class="form-control" placeholder="Appears in the memo of all payment" required>
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 50%">
                                        <label for="">Business ID No.</label>
                                        <input type="text" name="business_number" class="form-control" required>
                                        
                                    </div>
                                </div>
                                <div class="form-ib-group">
                                    <div class="form-ib" style="width: 60%">
                                        <label for="">Default expense account</label>
                                        <input type="text" name="default_expense_amount" class="form-control" placeholder="Choose Account" required>
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
<!--    Bill modal-->
    <div class="full-screen-modal">
        <div id="bill-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Bill
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="billForm">
						<div class="modal-body">
							<div class="row">
								<div class="col-md-3">
									<label for="">Vendor</label>
									<input type="hidden" name="bill_id" id="billID">
									<input type="hidden" name="transaction_id" id="billTransId">
									<select name="vendor_id" id="billVendorID" class="form-control select2-vendor">
										<option></option>
										<option disabled>&plus;&nbsp;Add new</option>
										<?php foreach ($vendors as $vendor):?>
											<option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-9" style="text-align: right">
									<div>Balance Due</div>
									<div><h1>$0.00</h1></div>
								</div>
							</div>
							<div class="row" style="margin-top: 20px;width: 80%;">
								<div class="col-md-3">
									<label for="">Mailing address</label>
									<textarea name="mailing_address" id="billMailingAddress" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
								</div>
								<div class="col-md-3">
									<label for="">Terms</label>
									<select name="terms" id="billTerms" class="form-control select2-bill-terms">
										<option></option>
										<option>Due on receipt</option>
										<option>Net 15</option>
										<option>Net 30</option>
										<option>Net 60</option>
									</select>
								</div>
								<div class="col-md-2">
									<label for="">Bill date</label>
									<input type="date" name="bill_date" id="billDate" class="form-control">
								</div>
								<div class="col-md-2">
									<label for="">Due date</label>
									<input type="date" name="due_date" id="billDueDate" class="form-control">
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="">Bill no.</label>
										<input type="text" name="bill_num" id="billNumber" class="form-control" value="">
									</div>
									<div class="form-group">
										<label for="">Permit no.</label>
										<input type="text" name="permit_num" id="billPermitNumber" class="form-control">
									</div>
								</div>
							</div>
							<div class="table-container">
								<!--                        DataTables-->
								<table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
									<thead>
									<tr>
										<th></th>
										<th>#</th>
										<th>CATEGORY</th>
										<th>DESCRIPTION</th>
										<th>AMOUNT</th>
										<th></th>
									</tr>
									</thead>
									<tbody id="line-container-bill">
									<tr id="tableLine-bill">
										<td></td>
										<td><span id="line-counter-bill">1</span></td>
										<td>
											<div id="" style="display:none;">
												<select name="category[]" id="" class="form-control billCategory select2-bill-category">
													<option></option>
													<?php foreach ($list_categories as $list): ?>
														<option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</td>
										<td><input type="text" name="description[]" class="form-control billDescription" id="tbl-input-bill" style="display: none;"></td>
										<td><input type="text" name="amount[]" class="form-control billAmount" id="tbl-input-bill" style="display: none;"></td>
										<td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
									</tr>
									<tr id="tableLine-bill">
										<td></td>
										<td><span id="line-counter-bill">2</span></td>
										<td>
											<div id="" style="display:none;">
												<select name="category[]" id="" class="form-control billCategory select2-bill-category">
													<option></option>
													<?php foreach ($list_categories as $list): ?>
														<option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</td>
										<td><input type="text" name="description[]" class="form-control billDescription" id="tbl-input-bill" style="display: none;"></td>
										<td><input type="text" name="amount[]" class="form-control billAmount" id="tbl-input-bill" style="display: none;"></td>
										<td style="text-align: center"><a href="#" id="delete-row-bill"><i class="fa fa-trash"></i></a></td>
									</tr>
									</tbody>
								</table>
							</div>
							<div class="addAndRemoveRow">
								<div class="total-amount-container">
									<span id="total-amount-bill">0.00</span>
								</div>
								<button type="button" class="add-remove-line" id="add-four-line-bill">Add lines</button>
								<button type="button" class="add-remove-line" id="clear-all-line-bill">Clear all lines</button>
							</div>
							<div class="form-group">
								<label for="">Memo</label>
								<textarea name="billMemo" id="billMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
							</div>
							<div class="form-group">
								<label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
								<span>Maximum size: 20MB</span>
								<div id="billAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
									<div class="dz-message" style="margin: 20px;border">
										<span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
										<a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer-check">
							<div class="row">
								<div class="col-md-5">
									<button class="btn btn-dark cancel-button" data-dismiss="modal" type="button">Cancel</button>
								</div>
								<div class="col-md-2" style="text-align: center;">
									<div>
										<a href="#" style="color: #ffffff;">Make recurring</a>
									</div>
								</div>
								<div class="col-md-5">
									<div class="dropdown" style="float: right;display: inline-block;position: relative;">
										<button type="button" class="btn btn-success" data-dismiss="modal" id="billSaved" style="border-radius: 20px 0 0 20px">Save and schedule payment</button>
										<button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
											<span class="fa fa-caret-down"></span></button>
										<ul class="dropdown-menu dropdown-menu-right" role="menu">
											<li><a href="#">Save and new</a></li>
											<li><a href="#">Save and close</a></li>
										</ul>
									</div>
									<div class="" style="display: inline-block;float: right;margin-right: 10px;">
										<button class="btn btn-transparent" id="billSaved" data-dismiss="modal" type="button">Save</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
<!--    end of modal-->
<!--    Expense modal-->
    <div class="full-screen-modal">
        <div id="expense-modal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Expense
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="expenseForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <input type="hidden" id="expenseTransId">
                                <input type="hidden" id="expenseId">
                                <select name="vendor_id" id="expenseVendorId" class="form-control select2-payee" required>
                                    <option value=""></option>
                                    <option disabled>&plus;&nbsp;Add new</option>
                                    <?php foreach ($vendors as $vendor):?>
                                        <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Payment account <i class="fa fa-question-circle"></i></label>
                                <select name="payment_account" id="expensePaymentAccount" class="form-control select2-account" required>
                                    <option>Cash on hand</option>
                                    <option value="1">Cash on hand:Cash on hand</option>
                                    <option value="2">Corporate Account (XXXXXX 5850)</option>
                                    <option value="3">Corporate Account (XXXXXX 5850)Te</option>
                                    <option >Investment Asset</option>
                                    <option >Payroll Refunds</option>
                                    <option >Uncategorized Asset</option>
                                    <option >Undeposited Funds</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$133,101.00</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;width: 80%;">
                            <div class="col-md-3">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" id="expensePaymentDate" class="form-control" required>
                            </div>
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3">
                                <label for="">Payment method</label>
                                <select name="payment_method" id="expensePaymentMethod" class="form-control select2-method" required>
                                    <option value=""></option>
                                    <option>Cash</option>
                                    <option>Check</option>
                                    <option>Credit Card</option>
                                </select>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Ref no.</label>
                                    <input type="text" name="ref_num" id="expenseRefNumber" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" id="expensePermitNumber" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-expense">
                                <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">1</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr id="tableLine-expense">
                                    <td></td>
                                    <td><span id="line-counter-expense">2</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <select name="category[]" id="" class="form-control expenseCategory select2-expense-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control expenseDescription" id="" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control expenseAmount" id="" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-row-expense"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <span id="total-amount-expense">0.00</span>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line-expense">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line-expense">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="memo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
                            <div id="expenseAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;">
                                <div class="dz-message" style="margin: 20px;border">
                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-5">
                                <button class="btn btn-dark cancel-button" type="button">Cancel</button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <div>
                                    <a href="#" style="color: #ffffff;">Make recurring</a>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="dropdown" style="float: right;display: inline-block;position: relative;">
                                    <button type="button" data-dismiss="modal" id="expenseSaved" class="btn btn-success" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                                <div class="" style="display: inline-block;float: right;margin-right: 10px;">
                                    <button class="btn btn-transparent" data-dismiss="modal" id="expenseSaved" type="button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
<!--    Add/Edit Checks Modal-->
    <div class="full-screen-modal">
        <div id="edit-expensesCheck" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Check #<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body" style="margin-bottom: 100px">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Payee</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" id="checktransID">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option></option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Bank Account</label>
                                <select name="bank_id" id="bank_account" class="form-control select2-account">
                                    <option></option>
                                    <option value="1">Cash on hand</option>
                                    <option value="2">Corporate Account(XXXXXX 5850)</option>
                                    <option value="3">Corporate Account(XXXXXX 5850)Te</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="line-height: 100px">
                                <span style="font-weight: bold">Balance</span>
                                <span>$113,101.00</span>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1>$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Mailing address</label>
                                <textarea name="mailing_address" id="check_mailing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label for="">Payment date</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control">
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Check no.</label>
                                    <input type="text" name="check_num" id="check_number" class="form-control" value="1">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="print_later" id="print_later" value="1">
                                    <label for="">Print later</label>
                                </div>
                                <div class="form-group">
                                    <label for="">Permit no.</label>
                                    <input type="text" name="permit_num" id="permit_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="table-container">
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>CATEGORY</th>
                                    <th>DESCRIPTION</th>
                                    <th>AMOUNT</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="line-container-check">
                                <tr id="tableLine">
                                    <td></td>
                                    <td><span id="line-counter">1</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <input type="hidden" id="prevent_process" value="true">
                                            <select name="category[]" id="" class="form-control checkCategory select2-check-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control checkDescription" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr id="tableLine">
                                    <td></td>
                                    <td><span id="line-counter">2</span></td>
                                    <td>
                                        <div id="" style="display:none;">
                                            <input type="hidden" id="prevent_process" value="true">
                                            <select name="category[]" id="" class="form-control checkCategory select2-check-category">
                                                <option></option>
                                                <?php foreach ($list_categories as $list): ?>
                                                    <option value="<?php echo $list->id?>"><?php echo $list->category_name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" name="description[]" class="form-control checkDescription" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <span id="total-amount-check">0.00</span>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="" id="checkMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                            <span>Maximum size: 20MB</span>
                            <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                <div class="dz-message" style="margin: 20px;">
                                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                    <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" data-dismiss="modal" type="button">Cancel</button>
                                <button class="btn btn-dark cancel-button" type="reset">Revert</button>
                            </div>
                            <div class="col-md-5">
                                <div class="middle-links">
                                    <a href="">Print check</a>
                                </div>
                                <div class="middle-links">
                                    <a href="">Order checks</a>
                                </div>
                                <div class="middle-links">
                                    <a href="">Make recurring</a>
                                </div>
                                <div class="middle-links end">
                                    <a href="">More</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#">Save and close</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!--    end of modal-->
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>


<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //select2 initialization
    $('.select2-sub-account').select2({
        placeholder: 'Enter parent account',
        allowClear: true
    });
    $('.select2-payee').select2({
        placeholder: 'Who did you pay?',
        allowClear: true
    });
    $('.select2-account').select2({
        allowClear: true
    });
    $('.select2-bill-terms').select2({
        placeholder: 'Choose a terms',
        allowClear: true
    });
    $('.select2-method').select2({
        placeholder: 'What did you pay with?',
        allowClear: true
    });
    $('.select2-credit-card').select2({
        placeholder: 'Select credit card',
        allowClear: true
    });
    $('.select2-bank-account').select2({
        placeholder: 'Select bank account',
        allowClear: true
    });
    $('.select2-vendor').select2({
        placeholder: 'Choose a vendor',
        allowClear: true
    });
    $('.select2-tbl-category').select2({
        placeholder: 'Choose a vendor',
        allowClear: true
    });
    $('.select2-vendor-credit').select2({
        placeholder: 'Choose a vendor',
        allowClear: true
    });
    $('.select2-vc-category').select2({
        placeholder: 'Choose a category',
        allowClear: true
    });
    $('.select2-check-category').select2({
        placeholder: 'Choose a category',
        allowClear: true
    });
    $('.select2-bill-category').select2({
        placeholder: 'Choose a category',
        allowClear: true
    });
    $('.select2-expense-category').select2({
        placeholder: 'Choose a category',
        allowClear: true
    });

    // DataTable JS
    $(document).ready(function() {
        $('#expenses_table').DataTable({
            "paging": false,
            "filter":false
        });
    } );
    $(document).ready(function() {
        $('#printChecktbl').DataTable({
            "paging": false,
            "filter":false
        });
        $('#expensesCheckTable').DataTable({
            "paging": false,
            "filter":false,
            "info":false,
            "sort": false
        });
    } );
    // Add & Remove line in dataTable Check modal
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line").click(function() {
                var id = $('#line-container-check > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine').clone(true);
                    row.find("#line-counter").html(id);
                    row.appendTo('#line-container-check');
                }
            });
        });
            // Clear Lines
        $('#clear-all-line').click(function (e) {
            var num = $('#line-container-check > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine").last().remove();
                    $('#line-counter-check').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-line-row",function (e) {
            var count = $('#line-container-check > tr').length;
            if (count > 2){
                $('#tableLine').last().remove();
            }else{
                e.preventDefault();
            }

        });
        //Table input text show
        $(document).on("click","#tableLine",function (e) {
            if ($('td > div > #prevent_process',this).val() == 'true'){
                $('.select2-check-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true
                });
                $('.select2-check-category').last().next().next().remove();
                $('#tableLine > td >input').hide();
                $('#tableLine > td >div').hide();
                $('#tableLine > td > #category-preview-check').show();
                $('#tableLine > td > #description-preview-check').show();
                $('#tableLine > td > #amount-preview-check').show();
                $('#tableLine >td > div > #prevent_process').val('true');
                $('td > input,div', this).show();
                $('td > #category-preview-check', this).hide();
                $('td > #description-preview-check', this).hide();
                $('td > #amount-preview-check', this).hide();
                $('td > div > #prevent_process',this).val('false');

                if ($(this).next().length == 0){
                    $('#line-container-check').append($('#tableLine').last().clone());
                    var count = $('#line-container-check > tr').length;
                    $('td > #line-counter').last().html(count);
                    $('td > #category-preview-check').last().html(null);
                    $('td > #description-id-check').last().val(null);
                    $('td > #description-preview-check').last().html(null);
                    $('td > #amount-preview-check').last().html(null);
                    $('td > #amount-id-check').last().val(0);
                }
            }
        });

        $(document).on('change','.select2-check-category',function () {
            $(this).parent('div').prev("span#category-preview-check").text($(this).find(":selected").text());
        });
        $(document).on('change','.checkDescription',function () {
            $(this).prev('span').text($(this).val());
        });
        $(document).on('change','.checkAmount',function () {
           $(this).prev('span').text($(this).val());
        });

        $(document).on('keyup','.checkAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.checkAmount').each(function () {
                var num = $(this).val().replace(',','');
                total += parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-check').text(total.toFixed(2));
            }

        });

    });

    // Bill modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-bill").click(function() {
                var id = $('#line-container-bill > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine-bill').clone(true);
                    row.find("#line-counter-bill").html(id);
                    row.appendTo('#line-container-bill');
                }
            });
        });
        // Clear Lines
        $('#clear-all-line-bill').click(function (e) {
            var num = $('#line-container-bill > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine-bill").last().remove();
                    $('#line-counter-bill').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-bill",function (e) {
            var count = $('#line-container-bill > tr').length;
            if (count > 2){
                $('#tableLine-bill').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-bill",function () {
            if ($('td > div > #prevent_process',this).val() == 'true'){
                $('.select2-bill-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true
                });
                $('.select2-bill-category').last().next().next().remove();

                $('#tableLine-bill > td >input').hide();
                $('#tableLine-bill > td >div').hide();
                $('#tableLine-bill > td > #category-preview-bill').show();
                $('#tableLine-bill > td > #description-preview-bill').show();
                $('#tableLine-bill > td > #amount-preview-bill').show();
                $('#tableLine-bill >td > div > #prevent_process').val('true');
                $('td > input,div', this).show();
                $('td > #category-preview-bill', this).hide();
                $('td > #description-preview-bill', this).hide();
                $('td > #amount-preview-bill', this).hide();
                $('td > div > #prevent_process',this).val('false');

                if ($(this).next().length == 0){
                    $('#line-container-bill').append($('#tableLine-bill').last().clone());
                    var count = $('#line-container-bill > tr').length;
                    $('td > #line-counter-bill').last().html(count);
                    $('td > #category-preview-bill').last().html(null);
                    $('td > #description-id-bill').last().val(null);
                    $('td > #description-preview-bill').last().html(null);
                    $('td > #amount-preview-bill').last().html(null);
                    $('td > #amount-id-bill').last().val(0);
                }
            }
        });
        $(document).on('change','.select2-bill-category',function () {
            $(this).parent('div').prev("span#category-preview-bill").text($(this).find(":selected").text());
        });
        $(document).on('change','.billDescription',function () {
            $(this).prev('span').text($(this).val());
        });
        $(document).on('change','.billAmount',function () {
            $(this).prev('span').text($(this).val());
        });

        $(document).on('keyup','.billAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.billAmount').each(function () {
                var num = $(this).val().replace(',','');
                total += parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-bill').text(total.toFixed(2));
            }

        });

    });
    // Expense modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-expense").click(function() {
                var id = $('#line-container-expense > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine-expense').clone(true);
                    row.find("#line-counter-expense").html(id);
                    row.appendTo('#line-container-expense');
                }
            });
        });
        // Clear Lines
        $('#clear-all-line-expense').click(function (e) {
            var num = $('#line-container-expense > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine-expense").last().remove();
                    $('#line-counter-expense').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-expense",function (e) {
            var count = $('#line-container-expense > tr').length;
            if (count > 2){
                $('#tableLine-expense').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show

        $(document).on("click","#tableLine-expense",function () {
            if ($('td > div > #prevent_process',this).val() == 'true'){
                $('.select2-expense-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true
                });
                $('.select2-expense-category').last().next().next().remove();
                $('#tableLine-expense > td >input').hide();
                $('#tableLine-expense > td >div').hide();
                $('#tableLine-expense > td > #category-preview-expense').show();
                $('#tableLine-expense > td > #description-preview-expense').show();
                $('#tableLine-expense > td > #amount-preview-expense').show();
                $('#tableLine-expense >td > div > #prevent_process').val('true');
                $('td > input,div', this).show();
                $('td > #category-preview-expense', this).hide();
                $('td > #description-preview-expense', this).hide();
                $('td > #amount-preview-expense', this).hide();
                $('td > div > #prevent_process',this).val('false');

                if ($(this).next().length == 0){
                    $('#line-container-expense').append($('#tableLine-expense').last().clone());
                    var count = $('#line-container-expense > tr').length;
                    $('td > #line-counter-expense').last().html(count);
                    $('td > #category-preview-expense').last().html(null);
                    $('td > #description-id-expense').last().val(null);
                    $('td > #description-preview-expense').last().html(null);
                    $('td > #amount-preview-expense').last().html(null);
                    $('td > #amount-id-expense').last().val(0);
                }
            }
        });
        $(document).on('change','.select2-expense-category',function () {
            $(this).parent('div').prev("span#category-preview-expense").text($(this).find(":selected").text());
        });
        $(document).on('change','.expenseDescription',function () {
            $(this).prev('span').text($(this).val());
        });
        $(document).on('change','.expenseAmount',function () {
            $(this).prev('span').text($(this).val());
        });

        $(document).on('keyup','.expenseAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.expenseAmount').each(function () {
                var num = $(this).val().replace(',','');
                total += parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-expense').text(total.toFixed(2));
            }

        });


    });
    // Vendor Credit modal js
    $(document).ready(function () {
        jQuery(document).ready(function() {
            $("#add-four-line-vendorCredit").click(function() {
                var id = $('#line-container-vendorCredit > tr').length;
                for (var x = 1;x <= 4;x++){
                    id++;
                    var row = $('#tableLine-vendorCredit').clone(true);
                    row.find("#line-counter-vendorCredit").html(id);
                    row.appendTo('#line-container-vendorCredit');
                }
            });
        });
        // Clear Lines
        $('#clear-all-line-vendorCredit').click(function (e) {
            var num = $('#line-container-vendorCredit > tr').length;
            if (num == 2){
                e.preventDefault();
            }else{
                for (var x = 1;x <= num-2;x++){
                    $("#tableLine-vendorCredit").last().remove();
                    $('#line-counter-vendorCredit').html(2);
                }
            }
        });
        //Delete Line
        $(document).on("click","#delete-row-vendorCredit",function (e) {
            var count = $('#line-container-vendorCredit > tr').length;
            if (count > 2){
                $('#tableLine-vendorCredit').last().remove();
            }else{
                e.preventDefault();
            }

        });

        //Table input text show
        $(document).on("click","#tableLine-vendorCredit",function () {
            if ($('td > div > #prevent_process',this).val() == 'true'){
                $('.select2-vc-category').select2({
                    placeholder: 'Choose a category',
                    allowClear: true
                });
                $('.select2-vc-category').last().next().next().remove();
                $('#tableLine-vendorCredit > td >input').hide();
                $('#tableLine-vendorCredit > td >div').hide();
                $('#tableLine-vendorCredit > td > #category-preview-vc').show();
                $('#tableLine-vendorCredit > td > #description-preview-vc').show();
                $('#tableLine-vendorCredit > td > #amount-preview-vc').show();
                $('#tableLine-vendorCredit > td > div > #prevent_process').val('true');
                $('td > input,div', this).show();
                $('td > #category-preview-vc', this).hide();
                $('td > #description-preview-vc', this).hide();
                $('td > #amount-preview-vc', this).hide();
                $('td > div > #prevent_process',this).val('false');

                if ($(this).next().length == 0){
                    $('#line-container-vendorCredit').append($('#tableLine-vendorCredit').last().clone());
                    var count = $('#line-container-vendorCredit > tr').length;
                    $('td > #line-counter-vendorCredit').last().html(count);
                    $('td > #category-preview-vc').last().html(null);
                    $('td > #description-id-vc').last().val(null);
                    $('td > #description-preview-vc').last().html(null);
                    $('td > #amount-preview-vc').last().html(null);
                    $('td > #amount-id-vc').last().val(0);
                }
            }
        });
        $(document).on('change','.select2-vc-category',function () {
            $(this).parent('div').prev("span#category-preview-vc").text($(this).find(":selected").text());
        });
        $(document).on('change','.vcDescription',function () {
            $(this).prev('span').text($(this).val());
        });
        $(document).on('change','.vcAmount',function () {
            $(this).prev('span').text($(this).val());
        });

        $(document).on('keyup','.vcAmount',function () {
            this.defaultValue = 0;
            this.value = this.value.trim() || this.defaultValue;
            var total = 0;
            $('.vcAmount').each(function () {
                var num = $(this).val();
                total = total + parseFloat(num);
            });
            if (isNaN(total)){
                total = 0;
                total = total.toFixed(2);
            }else{
                $('#total-amount-vc').text(total.toFixed(2));
            }

        });
    });

    //Pay Down
    $(document).ready(function () {
       $('#showHiddenOption').click(function () {
          $('#hiddenOption').toggle(this.checked);
       });
       $('#printLater').click(function () {
          $('#checkNumber').prop("disabled",this.checked);
       });

        $("#amountSelector").change(function () {
            if (!$.isNumeric($(this).val()))
                $(this).val('0').trigger('change');
            $(this).val(parseFloat($(this).val(),10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
        });
    });
    //Billable Toggle
    $('#billable').click(function () {
       $('#hideTaxable').toggle(this.checked);
        if($('#hideTextBox').attr('type') == 'hidden'){
            $('#hideTextBox').attr('type','text');
        }else{
            $('#hideTextBox').attr('type','hidden');
        }
    });
    //Start and End time toggle
    $('#start_end_times').click(function () {
       $('#startEndRow').toggle(this.checked);
       if($('#timeRow').css('display')=='none'){
           $('#timeRow').css('display','');
       }else{
           $('#timeRow').css('display','none');
       }
    });

    //Memo and Attachmennt promt
    $('#memoAttachPromt').click(function () {
        $('.memoAttachContainer').toggle(this.checked);
        var $target = $('.modal');
        $target.animate({scrollTop: $target.height()}, 1000);
    });
</script>
