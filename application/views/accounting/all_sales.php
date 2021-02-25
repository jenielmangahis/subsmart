<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper accounting-sales" role="wrapper" >
        <!-- page wrapper start -->
        <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
			<div class="page-title-box mx-4">
				<div class="col-lg-6 px-0">
						<h3>Sales Transactions</h3>
					</div>
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                    The Sales page gives you a great at-a-glance view of the status of sales transactions, open invoices, and paid invoices. 
                    </div>
					<!-- <br> -->
				<!-- <div class="row pb-2"> -->
				<!-- <div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab-active text-decoration-none">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				</div> -->
                <br>
                <div class="row pb-2">
					<div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab-active text-decoration-none">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
				</div>
				<div class="row pt-3">
                    <div class="col-lg-6 px-0">
						<!-- <h2>Sales Transactions</h2> -->
					</div>
					<div class="col-lg-6">
						<div class="pull-right">
							<button class="btn btn-success rounded-20" type="button" id="dropNewTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								New Transaction&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropNewTraaction">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-invoice">Invoice</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#receive-payment">Payment</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-estimate">Estimate</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#sales-receipt">Sales Receipt</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#credit-memo">Credit Memo</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delayed-charge">Delayed Charge</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#sales-time-activity">Time Activity</a>
							</div>
						</div>
						<div class="pull-right mr-3">
							<button class="btn btn-default rounded-20" type="button" id="dropImportantTraaction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Important Transaction&ensp;<span class="fa fa-caret-down"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropImportantTraaction">
								<a class="dropdown-item" href="#">Square</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2 align-items-end">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end mr-1">
							<div class="col px-0">
								<div class="bg-info px-3 py-2" style="height:100px !important;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">ESTIMATES</h6>
								</div>
							</div>
							<div class="col px-0">
								<p class="text-primary mb-1">Unbilled Last 365 Days</p>
								<div class="bg-primary px-3 py-2" style="height:100px !important;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">UNBILLED ACTIVITY</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end mr-1">
							<div class="col px-0">
								<p class="text-primary mb-1">Unpaid Last 365 Days</p>
								<div class="bg-warning px-3 py-2" style="height:100px !important;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">OVERDUE</h6>
								</div>
							</div>
							<div class="col px-0">
								<div class="bg-secondary px-3 py-2" style="height:100px !important;">
									<h4 class="text-white">3</h4>
									<h6 class="text-white">OPEN INVOICES</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="row pt-3 align-items-end">
							<div class="col px-0">
								<p class="text-primary mb-1">Paid</p>
								<div class="bg-success px-3 py-2" style="height:100px !important;">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">PAID LAST 30 DAYS</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row mt-5">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Date</th>
											<th>Type</th>
											<th>No.</th>
											<th>Customer</th>
											<th>Due Date</th>
											<th>Balance</th>
											<th>Total</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><input type="checkbox"></td>
											<td>06/29/2020</td>
											<td>Invoice</td>
											<td>1002</td>
											<td>John Meyer</td>
											<td>06/29/2020</td>
											<td>$32</td>
											<td>$42</td>
											<td>Open</td>
											<td><a href="">View</a></td>
										</tr>
										</tbody>
								</table>
							</div>
					</div>
				</div>
				<!-- end row -->
				<div class="row ml-2"></div>
            <!-- end row -->
			</div>
        </div>
        <!-- end container-fluid -->
    </div>
	  <!-- page wrapper end -->
	  <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    </div>
<!--    Create Invoice Modal-->
    <div class="full-screen-modal">
        <div id="add-invoice" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Invoice<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeAddInvoiceModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Customer</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option>Select a customer</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
									<label for="">Customer Email</label>
									<input type="text" class="form-control" placeholder="Separate emails with a comma">
								
								<div class="form-group mt-2">
                                    <input type="checkbox" name="send_later" id="send_later" value="1">
                                    <label for="">Send later</label>
                                </div>
                            </div>
                            <div class="col-md-3" style="line-height: 1.2">
                                <p style="font-weight: bold">Online Payments</p>
                                
                                    <input type="checkbox" name="cards" id="cards" value="1">
                                    <label for="" style="line-height:1">Cards</label>
                              
								<div class="form-group"  style="line-height:1">
                                    <input type="checkbox" name="bank_transfer" id="bank_transfer" value="1">
                                    <label for="" style="line-height:1">Bank Transfer</label>
                                </div>
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-check">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Billing address</label>
                                <textarea name="billing_address" id="billing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
                             <div class="col-md-6">
								<div class="row">
									<div class="col-md-4">
										<label for="">Terms</label>
										<select name="terms" id="billTerms" class="form-control select2-bill-terms">
											<option></option>
											<option>Due on receipt</option>
											<option>Net 15</option>
											<option>Net 30</option>
											<option>Net 60</option>
										</select>
									</div>
									<div class="col-md-4">
										<label for="">Invoice Date</label>
										<input type="date" name="invoice_date" id="invoice_date" class="form-control">
									</div>
									<div class="col-md-4">
										<label for="">Due Date</label>
										<input type="date" name="invoice_date" id="invoice_date" class="form-control">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-4">
										<label for="">Ship Via</label>
										<input type="text" name="ship_via" id="ship_via" class="form-control">
									</div>
									<div class="col-4">
										<label for="">Shipping Date</label>
										<input type="date" name="shipping_date" id="shipping_date" class="form-control">
									</div>
									<div class="col-4">
										<label for="">Tracking No.</label>
										<input type="text" name="tracking_no" id="tracking_no" class="form-control">
									</div>
								</div>
							</div>
                            <div class="col-md-1">
							</div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Location of sale</label>
                                    <input type="text" name="location_sale" id="location_sale" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
						<div class="row" style="margin-top: 20px">
                             <div class="col-3">
                                <label for="">Shipping to</label>
                                <textarea name="shipping_to_address" id="shipping_to_address" cols="30" rows="4" placeholder="" style="resize: none;" spellcheck="false"></textarea>
                            </div>
                        </div>
                        <div class="table-container mt-5">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <p>
									<span style="margin-right: 200px;font-size: 20px">Subtotal</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Taxable subtotal $0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Total</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Balance due</span>
									$ 0.00
								</p>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Message on invoice</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="This will show up on the invoice" style="width: 350px;resize: none;" ></textarea>
                        </div>
						 <div class="form-group">
                            <label for="">Message on statement</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="If you send statements to customers, this will show up as the description for this invoice." style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<!--    Create Invoice Modal-->
    <div class="full-screen-modal">
        <div id="receive-payment" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Receive Payment<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeReceivePaymentModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Customer</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option>Select a customer</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
								<button class="btn btn-default">Find by invoice no.</button>
								<p>Don't have an invoice? <a href="#">Create new sale</a></p>
                            </div>
                            
                        </div>
						<div class="row" style="margin-top: 20px">
							<div class="col-md-2">
                                <label for="">Payment Date</label>
                                <input type="date" name="payment_date" id="payment_date" class="form-control">
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-2">
								<label for="">Payment method </label>
								<select name="terms" id="billTerms" class="form-control select2-bill-terms">
									<option></option>
									<option>Cash</option>
									<option>Check</option>
									<option>Credit Card</option>
								</select>
							</div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Referene no.</label>
                                    <input type="text" name="reference_num" id="reference_num" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-2">
								<label for="">Deposit to</label>
								<select name="terms" id="billTerms" class="form-control select2-bill-terms">
									<option></option>
									<option>Due on receipt</option>
									<option>Net 15</option>
									<option>Net 30</option>
									<option>Net 60</option>
								</select>
							</div>
                            <div class="col-md-4">
							</div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Amount received</label>
                                    <input type="text" name="amoun_received" id="amoun_received" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="Note" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<!--    Create Estimate Modal-->
    <div class="full-screen-modal">
        <div id="add-estimate" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Estimate<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeAddEstimateModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Customer</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option>Select a customer</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
									<label for="">Customer Email</label>
									<input type="text" class="form-control" placeholder="Separate emails with a comma">
								
								<div class="form-group mt-2">
                                    <input type="checkbox" name="send_later" id="send_later" value="1">
                                    <label for="">Send later</label>
                                </div>
                            </div>
							<div class="col-md-3">
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-check">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Billing address</label>
                                <textarea name="billing_address" id="billing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
							<div class="col-md-2">
                                <label for="">Estimate Date</label>
                                <input type="date" name="estimate_date" id="estimate_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="">Expiration Date</label>
                                <input type="date" name="invoice_date" id="expiration_date" class="form-control">
                            </div>
                            <div class="col-md-3">
							</div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Location of sale</label>
                                    <input type="text" name="location_sale" id="location_sale" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="table-container mt-5">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <p>
									<span style="margin-right: 200px;font-size: 20px">Subtotal</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Taxable subtotal $0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Total</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Balance due</span>
									$ 0.00
								</p>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Message displayed on estimate</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="This will show up on the invoice" style="width: 350px;resize: none;" ></textarea>
                        </div>
						 <div class="form-group">
                            <label for="">Message displated on statement</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="If you convert an estimate into an invoice and send a statement, this will show up as the description for the invoice." style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<!--    Create Sales Receipt Modal-->
    <div class="full-screen-modal">
        <div id="sales-receipt" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Sales Receipt<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeSalesReceiptModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Customer</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option>Select a customer</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
									<label for="">Customer Email</label>
									<input type="text" class="form-control" placeholder="Separate emails with a comma">
								
								<div class="form-group mt-2">
                                    <input type="checkbox" name="send_later" id="send_later" value="1">
                                    <label for="">Send later</label>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-check">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Billing address</label>
                                <textarea name="billing_address" id="billing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
							<div class="col-md-5">
								<div class="row">
									<div class="col-4">
										<label for="">Sales Receipt Date</label>
										<input type="date" name="sales_receipt_date" id="sales_receipt_date" class="form-control">
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-4">
										<label for="">Ship Via</label>
										<input type="text" name="ship_via" id="ship_via" class="form-control">
									</div>
									<div class="col-4">
										<label for="">Shipping Date</label>
										<input type="date" name="shipping_date" id="shipping_date" class="form-control">
									</div>
									<div class="col-4">
										<label for="">Tracking No.</label>
										<input type="text" name="tracking_no" id="tracking_no" class="form-control">
									</div>
								</div>
                            </div>
                            <div class="col-md-2">
							</div>
							<div class="col-md-2">
                                   <label for="">Location of sale</label>
                                   <input type="text" name="location_sale" id="location_sale" class="form-control" value="1">
                            </div>
                        </div>
						<div class="row" style="margin-top: 20px">
                             <div class="col-3">
                                <label for="">Shipping to</label>
                                <textarea name="shipping_to_address" id="shipping_to_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
                        </div>
						<div class="row" style="margin-top: 20px">
                            <div class="col-md-2">
								<label for="">Payment method</label>
								<select name="payment_method" id="payment_method" class="form-control select2-bill-terms">
									<option></option>
									<option>Cash</option>
									<option>Check</option>
									<option>Credit Card</option>
								</select>
							</div>
							<div class="col-md-2">
								<label for="">Referene No.</label>
								<input type="text" name="reference_no" id="reference_no" class="form-control">
							</div>
							 <div class="col-md-2">
								<label for="">Deposit to</label>
								<select name="payment_method" id="payment_method" class="form-control select2-bill-terms">
									<option></option>
									<option>Cash on hand</option>
									<option>Corporate Account</option>
									<option>Inventory Asset</option>
									<option>Payroll Refunds</option>
								</select>
							</div>
                        </div>
                        <div class="table-container mt-5">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <p>
									<span style="margin-right: 200px;font-size: 20px">Subtotal</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Taxable subtotal $0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Total</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Balance due</span>
									$ 0.00
								</p>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Message displayed on sales receipt</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="This will show up on the invoice" style="width: 350px;resize: none;" ></textarea>
                        </div>
						 <div class="form-group">
                            <label for="">Message displayed on statement</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="If you send statements to customers, this will show up as the description for this invoice." style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<!--    Create Credit Memo Modal-->
    <div class="full-screen-modal">
        <div id="credit-memo" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Credit Memo<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeCreditMemoModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Customer</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option>Select a customer</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
									<label for="">Customer Email</label>
									<input type="text" class="form-control" placeholder="Separate emails with a comma">
								
								<div class="form-group mt-2">
                                    <input type="checkbox" name="send_later" id="send_later" value="1">
                                    <label for="">Send later</label>
                                </div>
                            </div>
							<div class="col-md-3">
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-check">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-3">
                                <label for="">Billing address</label>
                                <textarea name="billing_address" id="billing_address" cols="30" rows="4" placeholder="" style="resize: none;"></textarea>
                            </div>
							<div class="col-md-2">
                                <label for="">Credit Memo Date</label>
                                <input type="date" name="credit_memo_date" id="credit_memo_date" class="form-control">
                            </div>
                            <div class="col-md-5">
							</div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Location of sale</label>
                                    <input type="text" name="location_sale" id="location_sale" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="table-container mt-5">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
                                <p>
									<span style="margin-right: 200px;font-size: 20px">Subtotal</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Taxable subtotal $0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Total</span>
									$<span id="total-amount-check">0.00</span>
								</p>
								<p>
									<span style="margin-right: 200px;font-size: 20px">Balance due</span>
									$ 0.00
								</p>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Message displayed on credit memo</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="This will show up on the invoice" style="width: 350px;resize: none;" ></textarea>
                        </div>
						 <div class="form-group">
                            <label for="">Message displated on statement</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="If you convert an estimate into an invoice and send a statement, this will show up as the description for the invoice." style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<!--    Create Delayed Charge Modal-->
    <div class="full-screen-modal">
        <div id="delayed-charge" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Delayed Charge<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeDelayedChargeModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Customer</label>
                                <input type="hidden" name="check_id" id="checkID" value="">
                                <input type="hidden" name="transaction_id" class="transaction_id" id="checktransID">
                                <input type="hidden" id="checkType" class="expenseType" value="Check">
                                <select name="vendor_id" id="checkVendorID" class="form-control select2-payee">
                                    <option>Select a customer</option>
                                    <?php foreach ($vendors as $vendor):?>
                                    <option value="<?php echo $vendor->vendor_id?>"><?php echo $vendor->f_name."&nbsp;".$vendor->l_name;?> </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
							<div class="col-md-6">
                            </div>
                            <div class="col-md-3" style="text-align: right">
                                <div>AMOUNT</div>
                                <div><h1 id="h1_amount-check">$0.00</h1></div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px">
							<div class="col-md-2">
                                <label for="">Delayed Charge Date</label>
                                <input type="date" name="delayed_charge_date" id="delayed_charge_date" class="form-control">
                            </div>
                        </div>
                        <div class="table-container mt-5">
                            <div class="table-loader">
                                <p class="loading-text">Loading records</p>
                            </div>
                            <!--                        DataTables-->
                            <table id="expensesCheckTable" class="table table-striped table-bordered" style="width:100%;margin-top: 20px;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>PRODUCT/SERVICE</th>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                    <th>TAX</th>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
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
                                    <td><input type="text" name="qty[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="rate[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="amount[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td><input type="text" name="tax[]" class="form-control checkAmount" id="tbl-input" style="display: none;"></td>
                                    <td style="text-align: center"><a href="#" id="delete-line-row"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="addAndRemoveRow">
                            <div class="total-amount-container">
								<h5>
									<span style="margin-right: 200px;font-size: 20px">Total</span>
									$<span id="total-amount-check">0.00</span>
								</h5>
                            </div>
                            <button type="button" class="add-remove-line" id="add-four-line">Add lines</button>
                            <button type="button" class="add-remove-line" id="clear-all-line">Clear all lines</button>
                        </div>
                        <div class="form-group">
                            <label for="">Memo</label>
                            <textarea name="name" id="checkMemo" cols="30" rows="3" placeholder="" style="width: 350px;resize: none;" ></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""><i class="fa fa-paperclip"></i>&nbsp;Attachment</label>
                                    <span>Maximum size: 20MB</span>
                                    <div id="checkAttachment" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 423px;overflow: inherit">
                                        <div class="dz-message" style="margin: 20px;">
                                            <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                            <span style="font-size: 16px;color: #0b97c4">browse to upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" style="padding-top: 30px;">
                                    <div class="file-container-list" id="file-list-check"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="show-existing-file">
                                <a href="#" id="showExistingFile">Show existing file</a>
                            </div>
                        </div>
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
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
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<!--    Create Time Activity Modal-->
    <div class="full-screen-modal">
        <div id="sales-time-activity" class="all_sales_modal modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content h-100">
                    <div class="modal-header">
                        <div class="modal-title">
                            <a href=""><i class="fa fa-history fa-lg" style="margin-right: 10px"></i></a>
                            Time Activity<span id="checkNUmberHeader"></span>
                        </div>
                        <button type="button" class="close" id="closeSalesTimeActivityModal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <form action="" method="post" id="addEditCheckmodal">
                    <div class="modal-body">
                          <div class="row">
                            <div class="col-md-5">
                                   <table class="form-inline-group">
                                       <tr>
                                           <td><label for="">Date</label></td>
                                           <td>
                                               <input type="date" name="date" class="form-inline" style="width: 45%">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Name</label></td>
                                           <td>
                                               <input type="text" name="name" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Customer</label></td>
                                           <td>
                                               <input type="text" name="customer" class="form-inline">
                                           </td>
                                       </tr>
                                       <tr>
                                           <td><label for="">Service</label></td>
                                           <td>
                                               <select name="service" id="" class="form-inline">
                                                   <option disabled selected>Chose the service worked on</option>
                                                   <option>Credit</option>
                                                   <option>Discount</option>
                                                   <option>Hours</option>
                                                   <option>Installation</option>
                                                   <option>Labor</option>
                                                   <option>Material</option>
                                               </select>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td></td>
                                           <td>
                                               <input type="checkbox"  id="billable" value="1" >
                                               <span>Billable (/hr)</span>
                                               <input type="hidden" class="form-control" name="billable" id="hideTextBox" style="display: inline-block; width: 60px;height: 36px">
                                               <div style="display: none;" id="hideTaxable">
                                                   <input type="checkbox" name="taxable">
                                                   <span>Taxable</span>
                                               </div>
                                           </td>
                                       </tr>
                                   </table>
                            </div>
                            <div class="col-md-5">
                                <table class="form-inline-group">
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="checkbox" name="start_end_times" id="start_end_times" value="1">
                                            <span>Enter Start and End Times</span>
                                        </td>
                                    </tr>
                                    <tr id="timeRow">
                                        <td><label for="">Time</label></td>
                                        <td>
                                            <input type="time" name="time" class="form-inline" id="time" placeholder="hh:mm" style="width: 35%">

                                        </td>
                                    </tr>
                                    <tr id="startEndRow" style="display: none;">
                                        <td><label for="">Time</label></td>
                                        <td>
                                            <div>
                                                <input type="time" name="start_time" class="form-control"  style="width: 25%;display: inline-block;margin-bottom: 10px">
                                                <span>Start time</span>
                                            </div>
                                            <div>
                                                <input type="time" name="end_time" class="form-control" style="width: 25%;display: inline-block;margin-bottom: 10px">
                                                <span>End time</span>
                                            </div>
                                            <div >
                                                <input type="time" name="break" class="form-control" style="width: 30%;display: inline-block;" placeholder="hh:mm">
                                                <span>Break</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="">Description</label></td>
                                        <td>
                                            <textarea name="description" id="" cols="60" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    
                        <div class="privacy">
                            <a href="#">Privacy</a>
                        </div>
						</div>
                    </div>
                    <div class="modal-footer-check">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-3">
                                <div class="dropdown" style="float: right">
									<button class="btn btn-dark cancel-button px-4" type="submit">Save</button>
                                    <button type="button" class="btn btn-success" data-dismiss="modal" id="checkSaved" style="border-radius: 20px 0 0 20px">Save and new</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 20px 20px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="#" data-dismiss="modal" id="checkSaved" >Save and close</a></li>
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
<?php include viewPath('includes/footer_accounting'); ?>