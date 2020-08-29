<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
    <div class="wrapper accounting-sales" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
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
						<h2>Sales Transactions</h2>
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
								<a class="dropdown-item" href="#">Sales Receipt</a>
								<a class="dropdown-item" href="#">Credit Memo</a>
								<a class="dropdown-item" href="#">Delayed Charge</a>
								<a class="dropdown-item" href="#">Time Activity</a>
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
								<div class="bg-info px-3 py-2">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">ESTIMATES</h6>
								</div>
							</div>
							<div class="col px-0">
								<p class="text-primary mb-1">Unbilled Last 365 Days</p>
								<div class="bg-primary px-3 py-2">
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
								<div class="bg-warning px-3 py-2">
									<h4 class="text-white">0</h4>
									<h6 class="text-white">OVERDUE</h6>
								</div>
							</div>
							<div class="col px-0">
								<div class="bg-secondary px-3 py-2">
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
								<div class="bg-success px-3 py-2">
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
<!--    Creat Invoice Modal-->
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
                        <button type="button" class="close" id="closeCheckModal"><i class="fa fa-times fa-lg"></i></button>
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
                            
                            <div class="col-md-2">
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
                                <label for="">Invoice Date</label>
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="">Due Date</label>
                                <input type="date" name="invoice_date" id="invoice_date" class="form-control">
                            </div>
                            <div class="col-md-1">
							</div>
							<div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Location of sale</label>
                                    <input type="text" name="location_sale" id="location_sale" class="form-control" value="1">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
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
<!--    Creat Invoice Modal-->
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
                        <button type="button" class="close" id="closeCheckModal"><i class="fa fa-times fa-lg"></i></button>
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
<!--    Creat Estimate Modal-->
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
                        <button type="button" class="close" id="closeCheckModal"><i class="fa fa-times fa-lg"></i></button>
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
<?php include viewPath('includes/footer_accounting'); ?>