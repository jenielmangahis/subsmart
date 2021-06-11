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
								<a class="dropdown-item" href="<?php echo base_url('accounting/addnewInvoice') ?>">Invoice</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#receive-payment">Payment</a>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#newJobModal">Estimate</a>
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
                                        <?php foreach ($invoices as $inv):?>
										<tr>
											<td><input type="checkbox"></td>
											<td><?php echo $inv->date_issued; ?></td>
											<td><?php echo $inv->invoice_type; ?></td>
											<td><?php echo $inv->invoice_number; ?></td>
											<td><?php echo $inv->contact_name . '' . $inv->first_name."&nbsp;".$inv->last_name;?></td>
											<td><?php echo $inv->due_date; ?></td>
											<td><?php echo $inv->balance; ?></td>
											<td><?php echo $inv->total_due; ?></td>
											<td><?php echo $inv->status; ?></td>
											<td>
                                            <!-- <a href="">View</a> -->

                                            <div class="dropdown dropdown-btn">
                                                <a class="dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="fa fa-file-text-o icon"></span>Send</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href=""><span class="fa fa-envelope-o icon"></span>Share Invoice Link</a> </li>
                                                    <li role="separator" class="divider"></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#modalCloneWorkorder" data-id="" data-name="WO-00433"> <span class="fa fa-print icon"></span>Print Packing Slip</a> </li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#add-invoice" data-convert-to-invoice-modal="open" data-id="161983" data-name="WO-00433"><span class="fa fa-pencil-square-o icon"></span>View/Edit</a> </li>
                                                    <li role="presentation"> <a role="menuitem" href="#" class=""><span class="fa fa-files-o icon clone-workorder"></span>Copy</a></li>
                                                    <li role="presentation"> <a role="menuitem" target="_new" href="#" class=""> <span class="fa fa-trash-o icon"></span>Delete</a></li>
                                                    <li role="presentation"> <a role="menuitem" href="javascript:void(0);" class="btn-send-customer" data-id=""> <span class="fa fa-envelope-open-o icon"></span>Void</a></li>
                                                    <li><div class="dropdown-divider"></div></li>
                                                    <!-- <li role="presentation"> <a role="menuitem" href="#" onclick="return confirm('Do you really want to delete this item ?')" data-delete-modal="open"><span class="fa fa-trash-o icon"></span> Delete</a> -->
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            </td>
										</tr>
                                        <?php endforeach; ?>
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
                                    <?php foreach ($customers as $customer):?>
                                        <option value="<?php echo $customer->prof_id?>"><?php echo $customer->contact_name . '' . $customer->first_name."&nbsp;".$customer->last_name;?> </option>
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

<div class="modal fade" id="newEstimateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Estimate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- <div class="modal-body text-center">
        <p class="text-lg margin-bottom">
            What type of estimate you want to create
        </p>
        <div class="margin-bottom">
            <div class="help help-sm">Create a regular estimate with items</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add') ?>"><span class="fa fa-file-text-o"></span> Standard Estimate</a>
        </div>
        <div class="margin-bottom">
            <div class="help help-sm">Customers can select all or only certain options</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
        </div>
        <div>
            <div class="help help-sm">Customers can select only one package</div>
            <a class="btn btn-primary add-modal__btn-primary" href="<?php echo base_url('estimate/add?type=3') ?>"><span class="fa fa-cubes"></span> Packages Estimate</a>
        </div>
      </div> -->
      <div class="modal-body text-center">
        <p class="text-lg margin-bottom">
            What type of estimate you want to create
        </p><center>
        <div class="margin-bottom text-center" style="width:60%;">
            <div class="help help-sm">Create a regular estimate with items</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('estimate/add') ?>"><span class="fa fa-file-text-o"></span> Standard Estimate</a>
        </div>
        <div class="margin-bottom" style="width:60%;">
            <div class="help help-sm">Customers can select all <br>or only certain options</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('estimate/addoptions?type=2') ?>"><span class="fa fa-list-ul fa-margin-right"></span> Options Estimate</a>
        </div>
        <div  class="margin-bottom" style="width:60%;">
            <div class="help help-sm">Customers can select both Bundle Packages to obtain an overall discount</div>
            <a class="btn btn-primary add-modal__btn-success" style="background-color: #2ab363 !important" href="<?php echo base_url('estimate/addbundle?type=3') ?>"><span class="fa fa-cubes"></span> Bundle Estimate</a>
        </div></center>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<?php include viewPath('includes/footer_accounting'); ?>
<?php include viewPath('accounting/estimate_one_modal'); ?>

<script>

$(document).on("focusout", ".adjustment_input_cm_c", function () {
  // var counter = $(this).data("counter");
  // alert('yeah');
  // calculationcm(counter);
  var grand_total = $("#grand_total_input").val();
  var adjustment = $("#adjustment_input_cm").val();

  grand_total = parseFloat(grand_total) + parseFloat(adjustment);

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });

  // alert(subtotaltax);
  
  var s_total = subtotal.toFixed(2);
  var grand_total_w = s_total - parseFloat(adjustment);
  // var markup = $("#markup_input_form").val();
  // var grand_total_w = s_total + parseFloat(adjustment);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));

  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#adjustment_area").text(adjustment);
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  // alert(adjustment);
});

</script>

<script>
$(document).ready(function(){
 
 $('#sel-customer').change(function(){
 var id  = $(this).val();
//  alert(id);

     $.ajax({
         type: 'POST',
         url:"<?php echo base_url(); ?>accounting/addLocationajax",
         data: {id : id },
         dataType: 'json',
         success: function(response){
            //  alert('success');
             console.log(response);
         $("#email").val(response['customer'].email);
         $("#billing_address").html(response['customer'].billing_address);
     
         },
             error: function(response){
             alert('Error'+response);
    
             }
     });
 });
    });
</script>

<script>

function getItemscm(obj) {
  var sk = jQuery(obj).val();
  var site_url = jQuery("#siteurl").val();
  jQuery.ajax({
    url: site_url + "items/getitems_cm",
    data: { sk: sk },
    type: "GET",
    success: function (data) {
      /* alert(data); */
      jQuery(obj).parent().find(".suggestions").empty().html(data);
    },
    error: function () {
      alert("An error has occurred");
    },
  });
}
over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

function setitemCM(obj, title, price, discount, itemid) {

// alert('setitemCM');
  jQuery(obj).parent().parent().find(".getItemsCM").val(title);
  jQuery(obj).parent().parent().parent().find(".pricecm").val(price);
  jQuery(obj).parent().parent().parent().find(".discountcm").val(discount);
  jQuery(obj).parent().parent().parent().find(".itemid").val(itemid);
  var counter = jQuery(obj)
    .parent()
    .parent()
    .parent()
    .find(".pricecm")
    .data("counter");
  jQuery(obj).parent().empty();
  calculationcm(counter);
}

$(document).on("focusout", ".pricecm", function () {
  var counter = $(this).data("counter");
  calculationcm(counter);
});

// $(document).on("focusout", ".quantitycm", function () {
//   var counter = $(this).data("counter");
//   calculationcm(counter);
// });
$(document).on("focusout", ".discountcm", function () {
  var counter = $(this).data("counter");
  calculationcm(counter);
});


$(document).on("focusout", ".quantitycm2", function () {
  // var counter = $(this).data("counter");
//   calculationcm(counter);
// var idd = this.id;
var idd = $(this).attr('data-itemid');
var in_id = idd;
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }

  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

//   alert( 'yeah' + total);

  $("#span_total_" + in_id).text(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_" + in_id).val(tax1);
  $("#discount_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_'+ in_id).length ){
    $('#item_total_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotalcm = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotalcm += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotalcm);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_cm").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_").val(subtotaltax.toFixed(2));


  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
});

function calculationcm(counter) {
  var price = $("#price_" + counter).val();
  var quantity = $("#quantity_" + counter).val();
  var discount = $("#discount_" + counter).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }

  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + counter).text(total);
  $("#tax_1_" + counter).text(tax1);
  $("#tax_111_" + counter).text(tax1);
  $("#tax_1_" + counter).val(tax1);
  $("#discount_" + counter).val(discount);
  $("#tax1_" + counter).val(tax1);
  // $("#tax1_" + counter).val(tax1);
  // $("#tax_" + counter).val(tax1);
  // alert(tax1);

  if( $('#tax_1_'+ counter).length ){
    $('#tax_1_'+counter).val(tax1);
  }

  if( $('#item_total_'+ counter).length ){
    $('#item_total_'+counter).val(total);
  }

  // alert('dri');

  var eqpt_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);
  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

//   alert(subtotal);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_cm").text(subtotal.toFixed(2));
  $("#item_total").val(subtotal.toFixed(2));

  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  $("#total_tax_").text(subtotaltax.toFixed(2));
  $("#total_tax_input").val(subtotaltax.toFixed(2));


  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grandtotal_input").val(grand_total_w.toFixed(2));

  if($("#grand_total").length && $("#grand_total").val().length)
  {
    // console.log('none');
    // alert('none');
  }else{
    $("#grand_total_cm").text(grand_total_w.toFixed(2));
    $("#grand_total_input").val(grand_total_w.toFixed(2));

    var bundle1_total = $("#grand_total").text();
    var bundle2_total = $("#grand_total2").text();
    var super_grand = parseFloat(bundle1_total) + parseFloat(bundle2_total);

    $("#supergrandtotal").text(super_grand.toFixed(2));
    $("#supergrandtotal_input").val(super_grand.toFixed(2));
  }

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
}

</script>
<script>


$(".select_itemcm").click(function () {
            var idd = this.id;
            console.log(idd);
            console.log($(this).data('itemname'));
            var title = $(this).data('itemname');
            var price = $(this).data('price');
            
            if(!$(this).data('quantity')){
              // alert($(this).data('quantity'));
              var qty = 0;
            }else{
              // alert('0');
              var qty = $(this).data('quantity');
            }

            var count = parseInt($("#count").val()) + 1;
            $("#count").val(count);
            var total_ = price * qty;
            var tax_ =(parseFloat(total_).toFixed(2) * 7.5) / 100;
            var taxes_t = parseFloat(tax_).toFixed(2);
            var total = parseFloat(total_).toFixed(2);
            var withCommas = Number(total).toLocaleString('en');
            total = '$' + withCommas + '.00';
            // console.log(total);
            // alert(total);
            markup = "<tr id=\"ss\">" +
                "<td width=\"35%\"><input value='"+title+"' type=\"text\" name=\"items[]\" class=\"form-control\" ><input type=\"hidden\" value='"+idd+"' name=\"item_id[]\"></td>\n" +
                "<td width=\"20%\"><select name=\"item_type[]\" class=\"form-control\"><option value=\"product\">Product</option><option value=\"material\">Material</option><option value=\"service\">Service</option><option value=\"fee\">Fee</option></select></td>\n" +
                "<td width=\"10%\"><input data-itemid='"+idd+"' id='quantity_"+idd+"' value='"+qty+"' type=\"number\" name=\"quantity[]\" data-counter=\"0\"  min=\"0\" class=\"form-control qtyest\"></td>\n" +
                // "<td>\n" + '<input type="number" class="form-control qtyest" name="quantity[]" data-counter="' + count + '" id="quantity_' + count + '" min="1" value="1">\n' + "</td>\n" +
                "<td width=\"10%\"><input id='price_"+idd+"' value='"+price+"'  type=\"number\" name=\"price[]\" class=\"form-control\" placeholder=\"Unit Price\"></td>\n" +
                // "<td width=\"10%\"><input type=\"number\" class=\"form-control discount\" name=\"discount[]\" data-counter="0" id=\"discount_0\" min="0" value="0" ></td>\n" +
                // "<td width=\"10%\"><small>Unit Cost</small><input type=\"text\" name=\"item_cost[]\" class=\"form-control\"></td>\n" +
                "<td width=\"10%\"><input type=\"number\" name=\"discount[]\" class=\"form-control discount\" id='discount_"+idd+"'></td>\n" +
                // "<td width=\"25%\"><small>Inventory Location</small><input type=\"text\" name=\"item_loc[]\" class=\"form-control\"></td>\n" +
                "<td width=\"20%\"><input type=\"text\" data-itemid='"+idd+"' class=\"form-control tax_change2\" name=\"tax[]\" data-counter=\"0\" id='tax1_"+idd+"' min=\"0\" value='"+taxes_t+"'></td>\n" +
                "<td style=\"text-align: center\" class=\"d-flex\" width=\"15%\"><span data-subtotal='"+total_+"' id='span_total_"+idd+"' class=\"total_per_item\">"+total+
                // "</span><a href=\"javascript:void(0)\" class=\"remove_item_row\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></a>"+
                "</span> <input type=\"hidden\" name=\"total[]\" id='sub_total_text"+idd+"' value='"+total+"'></td>" +
                "</tr>";
            tableBody = $("#items_table_body_credit_memo");
            tableBody.append(markup);
            markup2 = "<tr id=\"sss\">" +
                "<td >"+title+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >"+price+"</td>\n" +
                "<td ></td>\n" +
                "<td >"+qty+"</td>\n" +
                "<td ></td>\n" +
                "<td ></td>\n" +
                "<td >0</td>\n" +
                "<td ></td>\n" +
                "<td ><a href=\"#\" data-name='"+title+"' data-price='"+price+"' data-quantity='"+qty+"' id='"+idd+"' class=\"edit_item_list\"><span class=\"fa fa-edit\"></span></i></a> <a href=\"javascript:void(0)\" class=\"remove_audit_item_row\"><span class=\"fa fa-trash\"></span></i></a></td>\n" +
                "</tr>";
            tableBody2 = $("#device_audit_datas");
            tableBody2.append(markup2);
            // calculate_subtotal();
            // var counter = $(this).data("counter");
            // calculation(idd);

  var in_id = idd;
  var price = $("#price_" + in_id).val();
  var quantity = $("#quantity_" + in_id).val();
  var discount = $("#discount_" + in_id).val();
  var tax = (parseFloat(price) * 7.5) / 100;
  var tax1 = (((parseFloat(price) * 7.5) / 100) * parseFloat(quantity)).toFixed(
    2
  );
  if( discount == '' ){
    discount = 0;
  }
  
  var total = (
    (parseFloat(price) + parseFloat(tax)) * parseFloat(quantity) -
    parseFloat(discount)
  ).toFixed(2);

  // alert( 'yeah' + total);

  $("#span_total_" + in_id).text(total);
  $("#sub_total_text" + in_id).val(total);
  $("#tax_1_" + in_id).text(tax1);
  $("#tax1_" + in_id).val(tax1);
  $("#discount_" + in_id).val(discount);

  if( $('#tax_1_'+ in_id).length ){
    $('#tax_1_'+in_id).val(tax1);
  }

  if( $('#item_total_'+ in_id).length ){
    $('#item_total_'+in_id).val(total);
  }

  var eqpt_cost = 0;
  // var total_cost = 0;
  var cnt = $("#count").val();
  var total_discount = 0;
  for (var p = 0; p <= cnt; p++) {
    var prc = $("#price_" + p).val();
    var quantity = $("#quantity_" + p).val();
    var discount = $("#discount_" + p).val();
    // var discount= $('#discount_' + p).val();
    // eqpt_cost += parseFloat(prc) - parseFloat(discount);
    // total_cost += parseFloat(prc);
    eqpt_cost += parseFloat(prc) * parseFloat(quantity);
    total_discount += parseFloat(discount);
  }
//   var subtotal = 0;
// $( total ).each( function(){
//   subtotal += parseFloat( $( this ).val() ) || 0;
// });

var total_cost = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="price_"]').each(function(){
      total_cost += parseFloat($(this).val());
  });

var tax_tot = 0;
$('*[id^="tax1_"]').each(function(){
  tax_tot += parseFloat($(this).val());
});

over_tax = parseFloat(tax_tot).toFixed(2);
// alert(over_tax);

$("#sales_taxs").val(over_tax);
$("#total_tax_input").val(over_tax);
$("#total_tax_").text(over_tax);


  eqpt_cost = parseFloat(eqpt_cost).toFixed(2);
  total_discount = parseFloat(total_discount).toFixed(2);
  stotal_cost = parseFloat(total_cost).toFixed(2);
  // var test = 5;

  var subtotal = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="span_total_"]').each(function(){
    subtotal += parseFloat($(this).text());
  });
  // $('#sum').text(subtotal);

  var subtotaltax = 0;
  // $("#span_total_0").each(function(){
    $('*[id^="tax_1_"]').each(function(){
      subtotaltax += parseFloat($(this).text());
  });

  // alert(subtotaltax);

  $("#eqpt_cost").val(eqpt_cost);
  $("#total_discount").val(total_discount);
  $("#span_sub_total_0").text(total_discount);
  $("#span_sub_total_invoice").text(subtotal.toFixed(2));
  // $("#item_total").val(subtotal.toFixed(2));
  $("#item_total").val(stotal_cost);
  
  var s_total = subtotal.toFixed(2);
  var adjustment = $("#adjustment_input_cm").val();
  var grand_total = s_total - parseFloat(adjustment);
  var markup = $("#markup_input_form").val();
  var grand_total_w = grand_total + parseFloat(markup);

  // $("#total_tax_").text(subtotaltax.toFixed(2));
  // $("#total_tax_").val(subtotaltax.toFixed(2));
  
  
  
  $("#item_total").val(grand_total_w.toFixed(2));
  $("#grand_total").text(grand_total_w.toFixed(2));
  $("#grand_total_input").val(grand_total_w.toFixed(2));
  $("#grand_total_cm_t").text(grand_total_w.toFixed(2));
  $("#grand_total_cm").text(grand_total_w.toFixed(2));
  $("#span_sub_total_cm").text(grand_total_w.toFixed(2));

  var sls = (parseFloat(eqpt_cost).toFixed(2) * 7.5) / 100;
  sls = parseFloat(sls).toFixed(2);
  $("#sales_tax").val(sls);
  cal_total_due();
        });
</script>
<script>
// $('#addcreditmemoModal').modal({
//     backdrop: 'static',
//     keyboard: false
// });
</script>