<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
    /* #thumbwrap {
	position:relative;
	margin:75px auto;
	width:252px; height:252px;
} */
    .thumb img { 
	border:1px solid #000;
	margin:3px;
	float:left;
}
.thumb span { 
	position:absolute;
	visibility:hidden;
}
    .thumb:hover, .thumb:hover span { 
	visibility:visible;
	top:0; left:250px; 
	z-index:1;
    /* height:500px;
    width:500px; */
}
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box mx-4">

                    <div class="col-lg-6 px-0">
						<h3>Receipts</h3>
					</div>
                    <div class="row pb-2">
                        <div class="col-md-12 banking-tab-container">
                            <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab" style="text-decoration: none">Banking</a>
                            <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                            <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="receipts")?:'-active';?>">Receipts</a>
                            <a href="<?php echo url('/accounting/tags')?>" class="banking-tab">Tags</a>
                        </div>
                    </div>

                    
                
                    <center><?php if ($this->session->flashdata('receipt_updated')){?>
                        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('receipt_updated');?>
                        </div>
                    <?php }elseif ($this->session->flashdata('receipt_updateFailed')){?>
                    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $this->session->flashdata('receipt_updateFailed');?>
                    </div>
                    <?php }?></center>
                    
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                        This is Receipts gold band 
                    </div>
                <div class="row align-items-center mt-3">
                    <div class="col-md-12 px-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="receiptDZ" class="dropzone" style="border: 2px dashed gray;background: #fff;">
                                    <div class="dz-message" style="margin: 20px;">
                                        <!-- <span style="font-size: 16px;color: #909194">Drag and drop files here or</span> -->
                                        <!-- <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a> -->
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <i class="fa fa-cloud-upload fa-2x" style="display: block;color: #909194;"></i>
                                            </div>
                                            <div class="col-sm-10" style="font-size:16px;">
                                                <strong><span>Upload from computer</span></strong> <br>
                                                <span>Select files or drag and drop</span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="siteurl" value="<?php echo base_url(); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="border: 2px solid #d4d7dc;padding: 10px 10px 10px 10px;width: 100%;height: 100%">
                                    <div class="row" align="center">
                                        <div class="col-sm-12"><img src="data:image/png;base64,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" alt="Email" height="" width="" style="display: inline-block;width: 51px;height: 51px;margin: 13px 12px 0;">

                                        <br><br><b>Upload from Google Drive</b>  <br>   
                                        <span>Access your Google account</span>
                                        </div>
                                        <!-- <div class="col-sm-6">Email your receipts and bills, and we’ll create transactions from them. Ask your master admin to set up receipt forwarding.</div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="border: 2px solid #d4d7dc;padding: 10px 10px 10px 10px;width: 100%;height: 100%">
                                    <h5>RECEIPT AND BILL FORWARDING</h5>
                                    <div class="row">
                                        <div class="col-sm-6"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNzYiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA3NiA1MCI+CiAgICA8ZGVmcz4KICAgICAgICA8cGF0aCBpZD0iYSIgZD0iTS4wMzEuNDNoMzguMjA0djM4LjIwM0guMDN6Ii8+CiAgICA8L2RlZnM+CiAgICA8ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxwYXRoIGZpbGw9IiNGRkYiIGQ9Ik00LjE4NCA0Ny43MThhMS41OTggMS41OTggMCAwIDEtMS4xOTEtLjM5NiAxLjY2IDEuNjYgMCAwIDEtLjU1Ni0xLjE0NlYzLjA4NmExLjY2IDEuNjYgMCAwIDEgLjU1Ni0xLjE0NmMuMzI4LS4yOS43NTgtLjQzMyAxLjE5MS0uMzk2aDY3LjY5NWMuNDM0LS4wMzcuODYzLjEwNiAxLjE5Mi4zOTYuMzI4LjI5LjUyOS43MDMuNTU2IDEuMTQ2djQyLjg3NmMtLjA5OSAxLjA2LTEuMDE0IDEuODQyLTIuMDU1IDEuNzU2SDQuMTg0eiIvPgogICAgICAgIDxwYXRoIHN0cm9rZT0iIzAwODQ4MSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjMiIGQ9Ik00LjE4NCA0Ny43MThhMS41OTggMS41OTggMCAwIDEtMS4xOTEtLjM5NiAxLjY2IDEuNjYgMCAwIDEtLjU1Ni0xLjE0NlYzLjA4NmExLjY2IDEuNjYgMCAwIDEgLjU1Ni0xLjE0NmMuMzI4LS4yOS43NTgtLjQzMyAxLjE5MS0uMzk2aDY3LjY5NWMuNDM0LS4wMzcuODYzLjEwNiAxLjE5Mi4zOTYuMzI4LjI5LjUyOS43MDMuNTU2IDEuMTQ2djQyLjg3NmMtLjA5OSAxLjA2LTEuMDE0IDEuODQyLTIuMDU1IDEuNzU2SDQuMTg0eiIvPgogICAgICAgIDxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMyIDQuMDk5KSI+CiAgICAgICAgICAgIDxtYXNrIGlkPSJiIiBmaWxsPSIjZmZmIj4KICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI2EiLz4KICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjMDBDMUJGIiBmaWxsLW9wYWNpdHk9Ii4xNSIgZD0iTTM4LjIzNS40M3YzOC4yMDNILjAzeiIgbWFzaz0idXJsKCNiKSIvPgogICAgICAgIDwvZz4KICAgICAgICA8cGF0aCBzdHJva2U9IiMwMEMxQkYiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIyLjEyIiBkPSJNNyA3LjA5OWwzMC4zMTEgMTdMNjcgNy4wOTkiLz4KICAgIDwvZz4KPC9zdmc+Cg==" alt="Email" height="80" width="180"></div>
                                        <div class="col-sm-6">Email your receipts and bills, and we’ll create transactions from them. Ask your master admin to set up receipt forwarding.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-white mt-4">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs banking-tab-container">
                                <li class="nav-item banking-sub-active">
                                    <a class="nav-link active banking-sub-tab" data-toggle="tab" href="#forReview">For Review</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link banking-sub-tab" data-toggle="tab" href="#reviewed">Reviewed</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding-top: 10px">
                                <div class="tab-pane active" id="forReview">
                                    <div class="dropdown" style="position: relative;display: inline-block;margin-left: 10px;margin-bottom: 10px;">
                                        <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;">
                                            Batch actions&nbsp;<i class="fa fa-angle-down fa-lg"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#" class="dropdown-item disabled">Confirm selected</a></li>
                                            <li><a href="#" class="dropdown-item disabled" >Review selected</a></li>
                                            <li><a href="#" class="dropdown-item disabled" >Delete selected</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown filter-dp" style="position: relative;display: inline-block;margin-left: 20px;margin-top: 10px;">
                                        <i class="fa fa-sliders fa-2x fa-rotate-270 " data-toggle="dropdown"></i>
                                        <ul class="dropdown-menu">
                                            <li style="padding:30px">
                                                <form action="" method="" class="">
                                                    <div>
                                                        <div style="width: 180px;position:relative; display: inline-block;">
                                                            <label for="type">Dates</label>
                                                            <select name="type" id="type" class="form-control" >
                                                                <option value="">All dates</option>
                                                                <option value="">Customs</option>
                                                                <option value="">Since 365 days ago</option>
                                                                <option value="">This month</option>
                                                                <option value="">This quarter</option>
                                                                <option value="">This year</option>
                                                                <option value="">Last month</option>
                                                                <option value="">Last quarter</option>
                                                                <option value="">Last year</option>
                                                            </select>
                                                        </div>
                                                        <div style="position: relative; display: inline-block;width: 120px;">
                                                            <label for="">From</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div style="position:relative; display: inline-block;margin-left: 10px;width: 120px;">
                                                            <label for="">To</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 20px;width: 100%;">
                                                        <div style="position: relative; display: inline-block;">
                                                            <label for="" style="display: block">Payee</label>
                                                            <input type="text" list="selectpayee" placeholder="Select Payee" class="filter-datalist" />
                                                            <datalist id="selectpayee">
                                                                <option>Test</option>
                                                                <option>Test</option>
                                                                <option>Test</option>
                                                                <option>Test</option>
                                                            </datalist>
                                                        </div>
                                                        <div style="position:relative; display: inline-block;margin-left: 10px;">
                                                            <label for="" style="display: block">Account/Category</label>
                                                            <input type="text" list="selectCategory" placeholder="Select Category" class="filter-datalist" />
                                                            <datalist id="selectCategory">
                                                                <option>Test</option>
                                                                <option>Test</option>
                                                                <option>Test</option>
                                                                <option>Test</option>
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 20px;">
                                                        <div style="position:relative; display: inline-block;width: 45%" >
                                                            <label for="">Actions</label>
                                                            <select name="status" id="type" class="form-control">
                                                                <option value="">All Actions</option>
                                                                <option value="">Create</option>
                                                                <option value="">Match</option>
                                                                <option value="">Review</option>
                                                            </select>
                                                        </div>
                                                        <div style="position:relative; display: inline-block;width: 45%">
                                                            <label for="">Document type</label>
                                                            <select name="status" id="type" class="form-control" >
                                                                <option value="">Receipt</option>
                                                                <option value="">Bill</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 20px;">
                                                        <div style="width: 180px;position:relative; display: inline-block;">
                                                            <label for="type">Amount</label>
                                                            <select name="type" id="type" class="form-control" >
                                                                <option value="">Between</option>
                                                                <option value="">Less Than</option>
                                                                <option value="">Greater Than</option>
                                                                <option value="">Equals</option>
                                                            </select>
                                                        </div>
                                                        <div style="position: relative; display: inline-block;width: 120px;">
                                                            <label for="">Minimum</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                        <div style="position:relative; display: inline-block;margin-left: 10px;width: 120px;">
                                                            <label for="">Maximum</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <button class="btn btn-default" type="reset" style="border-radius: 36px">Reset</button>
                                                        <button class="btn btn-success" type="submit" style="border-radius: 36px; float: right;">Apply</button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <table id="forReview_receipts_tbl" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>Receipt</th>
                                            <th>Transaction Date</th>
                                            <th>Description/Vendor</th>
                                            <th>Payment account</th>
                                            <th>Total amount/Taxes</th>
                                            <th>Category or Matched</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($receipts as $receipt): ?>
                                        <tr class="receiptRow">
                                            <td><input type="checkbox" value="<?php echo $receipt->id;?>"></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>" height="100" width="100">
                                        
                                                <div id="thumbwrap">
                                                    <a class="thumb" href="#"><img src="<?php echo base_url('uploads/accounting/').$receipt->receipt_img; ?>" alt="" alt="Image" height="100" width="100">
                                                    <span><img src="<?php echo base_url('uploads/accounting/').$receipt->receipt_img; ?>" alt="" height="400" width="400"></span></a> 
                                                </div>
                                            </td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->transaction_date == null || $receipt->transaction_date == "0000-00-00")?"Not found": $receipt->transaction_date; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->description == null)?"Not found" : $receipt->description; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->payee_id == 0)?"Not found": $receipt->payee_id ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->total_amount == null || $receipt->total_amount == 0.00)?"Not found" : $receipt->total_amount; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->category == null)?"Not found":$receipt->category; ?></td>
                                            <td>
                                                <?php if($receipt->for_expense == 0){ ?>
                                                    <a id="updateReceipt" href="#" style="display: inline;color:#0077c5;font-weight:bold;" data-id="<?php echo $receipt->id;?>" data-toggle="modal" data-target="#receiptModal">Review</a>
                                                <?php }else{ ?>
                                                    <a id="createExpense" href="#" style="display: inline;color:#0077c5;font-weight:bold;" data-id="<?php echo $receipt->id;?>">Create Expense</a>
                                                <?php } ?>
                                                    
                                                    &nbsp;
                                                <div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">
                                                    <span class="fa fa-chevron-down" data-toggle="dropdown"></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" type="submit" id="deleteReceipt" data-id="<?php echo $receipt->id;?>">Delete</a></li>
                                                        <?php if($receipt->for_expense == 1){ ?>
                                                            <a id="updateReceipt" href="#" style="display: inline" data-id="<?php echo $receipt->id;?>" data-toggle="modal" data-target="#receiptModal">Review</a>
                                                        <?php } ?>
                                                    </ul>
                                                </div>&nbsp;
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="reviewed">
                                    <table id="reviewed_receipts_tbl" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" ></th>
                                            <th>Receipt</th>
                                            <th>Transaction Date</th>
                                            <th>Description/Vendor</th>
                                            <th>Total amount/Tax</th>
                                            <th>Linked Record</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- <tr>
                                            <td><input type="checkbox"></td>
                                            <td>06/29/2020</td>
                                            <td>CHECK #2701 2701</td>
                                            <td>Mike Bell Jr</td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="">View</a></td>
                                        </tr> -->
                                        <?php foreach ($receipts_two as $receipt_t): ?>
                                        <tr class="receiptRow">
                                            <td><input type="checkbox" value="<?php echo $receipt_t->id;?>"></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt_t->id;?>" height="100" width="100">
                                        
                                                <div id="thumbwrap">
                                                    <a class="thumb" href="#"><img src="<?php echo base_url('uploads/accounting/').$receipt_t->receipt_img; ?>" alt="" alt="Image" height="100" width="100">
                                                    <span><img src="<?php echo base_url('uploads/accounting/').$receipt_t->receipt_img; ?>" alt="" height="400" width="400"></span></a> 
                                                </div>
                                            </td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt_t->id;?>"><?php echo ($receipt_t->transaction_date == null || $receipt_t->transaction_date == "0000-00-00")?"Not found": $receipt_t->transaction_date; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt_t->id;?>"><?php echo ($receipt_t->description == null)?"Not found" : $receipt->description; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt_t->id;?>"><?php echo ($receipt_t->total_amount == null || $receipt_t->total_amount == 0.00)?"Not found" : $receipt_t->total_amount; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt_t->id;?>"><?php echo ($receipt_t->category == null)?"Not found":$receipt_t->category; ?></td>
                                            <td>
                                                <a id="updateReceipt" href="#" style="display: inline;color:#0077c5;font-weight:bold;" data-id="<?php echo $receipt_t->id;?>" data-toggle="modal" data-target="#receiptModal">Undo add</a> &nbsp;
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
    <div class="full-screen-modal">
        <!--Modal for file upload-->
        <div id="receiptModal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Upload receipt</h2>
                        <i class="fa fa-times fa-lg" data-dismiss="modal"></i>
                    </div>
                    <form action="<?php echo site_url()?>accounting/updateReceipt" method="post">
                    <div class="modal-body" id="first_step_receipt">
                        <div class="row" style="margin-bottom: 100px">
                            <div class="col-md-7">
                                <div class="viewer-backdrop-container">
                                    <div class="viewer-backdrop">
                                        <input type="hidden" id="base_url" value="<?php echo base_url()?>uploads/accounting/">
                                        <img src="" id="receiptImage" alt="Image">
                                    </div>
                                    <div class="label-imageContainer" style="margin-top: 15px;">
                                        <span>Added 5:57 PM 07/06/2020</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="receiptDetailsContainer">
                                    <div class="step-header">Receipt details</div>
                                    <div class="step-header-text">Double-check the details and add any missing info.</div>
                                        <div class="form-group form-element">
                                            <span>Document Type</span>
                                            <input type="hidden" name="receipt_id" id="receipt_id">
                                            <select name="document_type" id="documentType" class="form-control">
                                                <option value="Receipt">Receipt</option>
                                                <option value="Bill">Bill</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="payeeID">Payee</label>
                                            <select name="payee_id" id="payeeID" class="form-control select2">
                                                <option disabled selected value="default">Select payee (optional)</option>
                                                <!-- <option disabled>&plus;&nbsp;Add new</option>
                                                <option value="1">Betty Fuller</option>
                                                <option value="2">Brian Boyden</option>
                                                <option value="3">Ken Curry</option>
                                                <option value="4">Mary Brown</option>
                                                <option value="5">Patricia Motes</option> -->
                                                <!-- <option value="" disabled="" selected>Payee</option> -->
                                                <option value="fa fa-plus">&#xf067; Add new</option>
                                                <?php
                                                foreach($this->AccountingVendors_model->select() as $ro)
                                                {
                                                ?>
                                                <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account">Bank/Credit Account</label>
                                            <select name="bank_account" id="bank_account" class="form-control select2">
                                                <option disabled selected value="default">Select an account</option>
                                                <!-- <option disabled>&plus;&nbsp;Add new</option>
                                                <option>Billable Expenses</option>
                                                <option>Gross Receipt</option>
                                                <option>Guardian</option>
                                                <option>Mary Brown</option>
                                                <option>Sales</option> -->
                                                <?php
                                                    $i=1;
                                                    foreach($this->chart_of_accounts_model->select() as $row)
                                                    {
                                                        ?>
                                                        <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                                        <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                                                    <?php
                                                    $i++;
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Payment Date</label>
                                            <input type="date" name="transaction_date" id="paymentDate" class="form-control" placeholder="Select a date">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Account/Category</label>
                                            <select name="category" id="category" class="form-control select2">
                                                <option disabled selected value="default">Select a category</option>
                                                <option disabled>&plus;&nbsp;Add new</option>
                                                <option>Commissions & Fees</option>
                                                <option>Billable Expenses</option>
                                                <option>Gross Receipt</option>
                                                <option>Guardian</option>
                                                <option>Mary Brown</option>
                                                <option>Sales</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" name="description" id="description" class="form-control" placeholder="Enter a description">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total amount (Inclusive of tax)*</label>
                                            <input type="text" name="total_amount" id="totalAmount" class="form-control" placeholder="Enter amount">
                                        </div>
                                        <div class="form-group">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" cols="15" rows="5" class="memo-textarea" placeholder="Add note (optional)"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="#" style="font-weight: bolder;color: color: #0077c5;" id="toggleRefNumber"><i class="fa fa-caret-right"></i>&nbsp;Additional Fields (optional)</a>
                                        </div>
                                        <div class="form-group" id="refNumber" style="display: none">
                                            <label for="refNumber">Ref no.</label>
                                            <input type="text" name="ref_number" id="refNumber" class="form-control">
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-uploadedReceipt">
                        <button type="button" data-dismiss="" class="btn btn-default btn-leftSide">Cancel</button>
                        <button class="btn btn-default btn-leftSide" style="margin-left: 10px">Delete this receipt</button>
                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                            <button type="submit" class="btn btn-success save_next"  style="border-radius: 36px 0 0 36px">Save and next</button>
                            <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -3px;">
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#" class="dropdown-item">Save and close</a></li>
                            </ul>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="full-screen-modal">
        <!--Modal for file upload-->
        <div id="nextreceiptModal" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Upload receipt</h2>
                        <i class="fa fa-times fa-lg" data-dismiss="modal"></i>
                    </div>
                    <form action="<?php echo site_url()?>accounting/nextupdateReceipt" method="post">
                    <div class="modal-body" id="first_step_receipt">
                        <div class="row" style="margin-bottom: 100px">
                            <div class="col-md-7">
                                <div class="viewer-backdrop-container">
                                    <div class="viewer-backdrop">
                                        <input type="hidden" id="base_url" value="<?php echo base_url()?>uploads/accounting/">
                                        <img src="" id="receiptImage" alt="Image">
                                    </div>
                                    <div class="label-imageContainer" style="margin-top: 15px;">
                                        <span>Added 5:57 PM 07/06/2020</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="receiptDetailsContainer">
                                    <div class="step-header">No matches found</div>
                                    <div class="step-header-text">Create a new expense for this receipt. If a matching transaction comes into QuickBooks later, we’ll mark it as a match.</div>
                                        <div class="form-group form-element">
                                            <span>Document Type</span>
                                            <input type="hidden" name="receipt_id" id="receipt_id">
                                            <select name="document_type" id="documentType" class="form-control">
                                                <option value="Receipt">Receipt</option>
                                                <option value="Bill">Bill</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="payeeID">Payee</label>
                                            <select name="payee_id" id="payeeID" class="form-control select2">
                                                <option disabled selected value="default">Select payee (optional)</option>
                                                <!-- <option disabled>&plus;&nbsp;Add new</option>
                                                <option value="1">Betty Fuller</option>
                                                <option value="2">Brian Boyden</option>
                                                <option value="3">Ken Curry</option>
                                                <option value="4">Mary Brown</option>
                                                <option value="5">Patricia Motes</option> -->
                                                <!-- <option value="" disabled="" selected>Payee</option> -->
                                                <option value="fa fa-plus">&#xf067; Add new</option>
                                                <?php
                                                foreach($this->AccountingVendors_model->select() as $ro)
                                                {
                                                ?>
                                                <option value="<?=$ro->id?>"><?php echo $ro->f_name." ".$ro->l_name?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account">Bank/Credit Account</label>
                                            <select name="bank_account" id="bank_account" class="form-control select2">
                                                <option disabled selected value="default">Select an account</option>
                                                <!-- <option disabled>&plus;&nbsp;Add new</option>
                                                <option>Billable Expenses</option>
                                                <option>Gross Receipt</option>
                                                <option>Guardian</option>
                                                <option>Mary Brown</option>
                                                <option>Sales</option> -->
                                                <?php
                                                    $i=1;
                                                    foreach($this->chart_of_accounts_model->select() as $row)
                                                    {
                                                        ?>
                                                        <option <?php if($this->reconcile_model->checkexist($row->id) != $row->id): echo "disabled"; ?>
                                                        <?php endif ?> value="<?=$row->id?>"><?=$row->name?></option>
                                                    <?php
                                                    $i++;
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Payment Date</label>
                                            <input type="date" name="transaction_date" id="paymentDate" class="form-control" placeholder="Select a date">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Account/Category</label>
                                            <select name="category" id="category" class="form-control select2">
                                                <option disabled selected value="default">Select a category</option>
                                                <option disabled>&plus;&nbsp;Add new</option>
                                                <option>Commissions & Fees</option>
                                                <option>Billable Expenses</option>
                                                <option>Gross Receipt</option>
                                                <option>Guardian</option>
                                                <option>Mary Brown</option>
                                                <option>Sales</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" name="description" id="description" class="form-control" placeholder="Enter a description">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total amount (Inclusive of tax)*</label>
                                            <input type="text" name="total_amount" id="totalAmount" class="form-control" placeholder="Enter amount">
                                        </div>
                                        <div class="form-group">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" cols="15" rows="5" class="memo-textarea" placeholder="Add note (optional)"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="#" style="font-weight: bolder;color: color: #0077c5;" id="toggleRefNumber"><i class="fa fa-caret-right"></i>&nbsp;Additional Fields (optional)</a>
                                        </div>
                                        <div class="form-group" id="refNumber" style="display: none">
                                            <label for="refNumber">Ref no.</label>
                                            <input type="text" name="ref_number" id="refNumber" class="form-control">
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-uploadedReceipt">
                        <button type="button" data-dismiss="" class="btn btn-default btn-leftSide">Cancel</button>
                        <button class="btn btn-default btn-leftSide" style="margin-left: 10px">Delete this receipt</button>
                        <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                            <button type="submit" class="btn btn-success"  style="border-radius: 36px 0 0 36px">Save and next</button>
                            <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -3px;">
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#" class="dropdown-item">Save and close</a></li>
                            </ul>
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

    // DataTable JS
    $(document).ready(function() {
        $('#forReview_receipts_tbl').DataTable({
            "paging":false,
            "filter":false
        });
    } );
    $(document).ready(function() {
        $('#reviewed_receipts_tbl').DataTable();
    } );
    // Active menu jquery
    $('.banking-sub-tab').click(function(){
        $(this).parent().addClass('banking-sub-active').siblings().removeClass('banking-sub-active')
    });
    $("#totalAmount").change(function () {
        if (!$.isNumeric($(this).val()))
            $(this).val('0').trigger('change');
        $(this).val(parseFloat($(this).val(),10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
    });

    $('#toggleRefNumber').click(function () {
       $('#refNumber').toggle();
    });
</script>

<script>
$(".save_next").click(function () {
    $('#nextreceiptModal').modal('toggle');
});
</script>

<script>
$("#createExpense").click(function () {
    var rID = $(this).attr('data-id');

    $.ajax({
        type : 'POST',
        url : "<?php echo base_url(); ?>accounting/receipt_create_expense",
        data : {rID: rID },
        dataType: 'json',
        success: function(response){

        },
    });

    $(".createPackage").modal("hide");

});
</script>


