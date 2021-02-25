<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
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
                    
					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                        This is Receipts gold band 
                    </div>
                <div class="row align-items-center mt-3">
                    <div class="col-md-12 px-0">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="receiptDZ" class="dropzone" style="border: 2px dashed gray;background: #fff;">
                                    <div class="dz-message" style="margin: 20px;">
                                        <i class="fa fa-cloud-upload fa-2x" style="display: block;color: #909194;"></i>
                                        <span style="font-size: 16px;color: #909194">Drag and drop files here or</span>
                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
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
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><img src="<?php echo base_url('uploads/accounting/').$receipt->receipt_img; ?>" alt="Image" height="100" width="100"></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->transaction_date == null || $receipt->transaction_date == "0000-00-00")?"Not found": $receipt->transaction_date; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->description == null)?"Not found" : $receipt->description; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->payee_id == 0)?"Not found": $receipt->payee_id ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->total_amount == null || $receipt->total_amount == 0.00)?"Not found" : $receipt->total_amount; ?></td>
                                            <td id="updateReceipt" data-toggle="modal" data-target="#receiptModal" data-id="<?php echo $receipt->id;?>"><?php echo ($receipt->category == null)?"Not found":$receipt->category; ?></td>
                                            <td>
                                                <a href="#" style="display: inline" data-toggle="modal" data-target="#receiptModal">Review</a>&nbsp;
                                                <div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">
                                                    <span class="fa fa-chevron-down" data-toggle="dropdown"></span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" type="submit" id="deleteReceipt" data-id="<?php echo $receipt->id;?>">Delete</a></li>
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
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>06/29/2020</td>
                                            <td>CHECK #2701 2701</td>
                                            <td>Mike Bell Jr</td>
                                            <td></td>
                                            <td></td>
                                            <td><a href="">View</a></td>
                                        </tr>
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
                    <div class="modal-body">
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
                                                <option>Receipt</option>
                                                <option>Bill</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="payeeID">Payee</label>
                                            <select name="payee_id" id="payeeID" class="form-control select2">
                                                <option disabled selected value="default">Select payee (optional)</option>
                                                <option disabled>&plus;&nbsp;Add new</option>
                                                <option value="1">Betty Fuller</option>
                                                <option value="2">Brian Boyden</option>
                                                <option value="3">Ken Curry</option>
                                                <option value="4">Mary Brown</option>
                                                <option value="5">Patricia Motes</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account">Bank/Credit Account</label>
                                            <select name="bank_account" id="bank_account" class="form-control select2">
                                                <option disabled selected value="default">Select an account</option>
                                                <option disabled>&plus;&nbsp;Add new</option>
                                                <option>Billable Expenses</option>
                                                <option>Gross Receipt</option>
                                                <option>Guardian</option>
                                                <option>Mary Brown</option>
                                                <option>Sales</option>
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
    <?php if ($this->session->flashdata('receipt_updated')){?>
        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('receipt_updated');?>
        </div>
    <?php }elseif ($this->session->flashdata('receipt_updateFailed')){?>
    <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('receipt_updateFailed');?>
    </div>
    <?php }?>
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


