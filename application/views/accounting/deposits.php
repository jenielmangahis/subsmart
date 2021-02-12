<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <div class="wrapper" role="wrapper" >
        <!-- page wrapper start -->
           <div wrapper__section>
        <div class="container-fluid">
			<div class="page-title-box mx-4">
				<!-- <div class="row pb-2"> -->
					<!-- <div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab-active text-decoration-none">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div> -->
				<!-- </div> -->

                <div style="background-color:white;height:700px;padding:2%;margin-top:1.2%;margin-left:-24px;">
                <h3 style="font-family: Sarabun, sans-serif">&nbsp;Deposits from Payments</h3>
				<div class="row pt-3">
					<div class="col-lg-6 px-0">
						<!-- <h2>Deposits from Payments</h2> -->
                        <div class="col-md-12 banking-tab-container">
						<a href="<?php echo url('/accounting/sales-overview')?>" class="banking-tab">Overview</a>
						<a href="<?php echo url('/accounting/all-sales')?>" class="banking-tab">All Sales</a>
						<a href="<?php echo url('/accounting/invoices')?>" class="banking-tab">Invoices</a>
						<a href="<?php echo url('/accounting/customers')?>" class="banking-tab">Customers</a>
						<a href="<?php echo url('/accounting/deposits')?>" class="banking-tab-active text-decoration-none">Deposits</a>
						<a href="<?php echo url('/accounting/products-and-services')?>" class="banking-tab">Products and Services</a>
					</div>
					</div>
					<div class="col-lg-6">
					</div>
				</div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:28px;">
                Sample text here for Deposits from Payments tab.
                </div>
				<div class="row pt-3">
					<div class="col-lg-12 px-0">
						<div class="bg-white p-4">
							<table id="all_sales_table" class="table table-striped table-bordered w-100">
										<thead>
										<tr>
											<th></th>
											<th>Invoice</th>
											<th>Customer</th>
											<th>Date</th>
											<th>Deposited</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
										</thead>
										<tbody>
											<?php foreach($invoices as $invoice) : ?>
											<tr>
												<td><input type="checkbox"></td>
												<td><?php echo $invoice->id; ?></td>
												<td><?php echo $invoice->first_name .' '.$invoice->last_name; ?></td>
												<td><?php echo $invoice->invoice_date; ?></td>
												<td><?php echo $invoice->total_amount; ?></td>
												<td>Success</td>
												<td><a href="#" style="color: blue;" data-toggle="modal" data-target="#addinvoiceModal"><i class="fa fa-eye" aria-hidden="true"></i>View</a></td>
											</tr>
											<?php endforeach; ?>
											<!-- <tr>
												<td><input type="checkbox"></td>
												<td>1234</td>
												<td>John Meyer</td>
												<td>06/29/2020</td>
												<td>$42</td>
												<td>Success</td>
												<td><a href="">View</a></td>
											</tr> -->
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
               <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
            </div>
                <div class="modal-body">
                    <form action="<?php echo site_url()?>accounting/addInvoice" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Customer
                                        <select class="form-control" name="customer_id">
                                            <option></option>
                                            <?php foreach($customers as $customer) : ?>
                                            <option value="<?php echo $customer->prof_id; ?>"><?php echo $customer->first_name . ' ' . $customer->last_name; ?></option>
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
                                        <input type="checkbox" name="online_paymentss[]" value="2" checked> Bank Transfer
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
                                            <?php foreach($terms as $term) : ?>
                                            <option value="<?php echo $term->id; ?>"><?php echo $term->description . ' ' . $term->day; ?></option>
                                            <?php endforeach; ?>
                                        </select><br><br>
                                        Ship via<br>
                                        <input type="text" class="form-control" name="ship_via">
                                    </div>
                                    <div class="col-md-3">
                                        Invoice date<br>
                                        <input type="text" class="form-control" name="invoice_date" id="datepickerinv"><br>
                                        Shipping date<br>
                                        <input type="text" class="form-control" name="shipping_date" id="datepickerinv2">
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
                                        <textarea style="height:100px;width:100%;" name="shipping_to_address"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Tags <a href="#" style="float:right">Manage tags</a>
                                        <input type="text" class="form-control"> -->
                                        <div id="label">
                                            <label for="tags">Tags</label>
                                            <span class="float-right"><a href="#" class="text-info" data-toggle="modal" data-target="#tags-modal" id="open-tags-modal">Manage tags</a></span>
                                        </div>
                                        <select name="tags[]" id="tags" class="form-control js-example-basic-multiple js-data-example-ajax" multiple="multiple"></select>
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
                                <textarea style="height:100px;width:100%;" name="message_on_invoice"></textarea><br>
                                Message on statement<br>
                                <textarea style="height:100px;width:100%;" name="message_on_statement"></textarea>
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
                                    <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Attachements</button>

                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="file_name/>
                                        <div class="drag-text">
                                        <i>Drag and drop files here or click the icon</i>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded File</span></button>
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
                                    <button class="btn btn-dark cancel-button" id="closeCheckModal" type="button">Cancel</button>
                                    
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
                
                <div style="margin: auto;">
                    <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
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
 

</script>

<?php include viewPath('accounting/add_new_term'); ?>

<!-- end sa modal -->

	  <!-- page wrapper end -->
	  <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    </div>

<?php include viewPath('includes/footer_accounting'); ?>