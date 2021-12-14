<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>
<style>
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
                            <a href="<?=url('/accounting/link_bank')?>" class="banking-tab" style="text-decoration: none">Banking</a>
                            <a href="<?=url('/accounting/rules')?>" class="banking-tab">Rules</a>
                            <a href="<?=url('/accounting/receipts')?>" class="banking-tab<?=($this->uri->segment(1) == "receipts") ?: '-active';?>">Receipts</a>
                            <a href="<?=url('/accounting/tags')?>" class="banking-tab">Tags</a>
                        </div>
                    </div>

                    <center>
                    <?php if ($this->session->flashdata('receipt_updated')): ?>
                        <div class="alert alert-success alert-dismissible col-md-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=$this->session->flashdata('receipt_updated');?>
                        </div>
                    <?php elseif ($this->session->flashdata('receipt_updateFailed')): ?>
                        <div class="alert alert-danger alert-dismissible col-md-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=$this->session->flashdata('receipt_updateFailed');?>
                        </div>
                    <?php endif;?>
                    </center>

					<div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:5px;">
                        This is Receipts gold band
                    </div>
                <div class="row align-items-center mt-3">
                    <div class="col-md-12 px-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="receiptsUploadDropzone" class="dropzone" style="border: 2px dashed gray;background: #fff;">
                                    <div class="dz-message" style="margin: 20px;">
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
                                    <input type="hidden" id="siteurl" value="<?=base_url();?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="googleDriveConnectButton" id="googleDriveConnectButton">
                                    <div class="row" align="center">
                                        <div class="col-sm-12">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 109.79" style="enable-background:new 0 0 122.88 109.79" xml:space="preserve" width="40">
                                                <path d="m9.29 94.1 5.42 9.36c1.13 1.97 2.74 3.52 4.65 4.64l19.35-33.5H0c0 2.18.56 4.36 1.69 6.33l7.6 13.17z" style="fill:#1967d2"/>
                                                <path d="M61.44 35.19 42.09 1.69c-1.9 1.13-3.52 2.67-4.65 4.65L1.69 68.27C.59 70.19 0 72.38 0 74.6h38.71l22.73-39.41z" style="fill:#34a853"/>
                                                <path d="M103.53 108.1c1.9-1.13 3.52-2.67 4.65-4.64l2.25-3.87 10.77-18.65a12.7 12.7 0 0 0 1.69-6.33H84.17l8.24 16.19 11.12 17.3z" style="fill:#ea4335"/>
                                                <path d="m61.44 35.19 19.35-33.5C78.89.56 76.71 0 74.46 0H48.42c-2.25 0-4.43.63-6.33 1.69l19.35 33.5z" style="fill:#188038"/>
                                                <path d="M84.17 74.6H38.71l-19.35 33.5c1.9 1.13 4.08 1.69 6.33 1.69h71.5c2.25 0 4.44-.63 6.33-1.69L84.17 74.6z" style="fill:#4285f4"/>
                                                <path d="M103.31 37.3 85.44 6.33c-1.13-1.97-2.74-3.52-4.64-4.65l-19.35 33.5L84.17 74.6h38.64c0-2.18-.56-4.36-1.69-6.33L103.31 37.3z" style="fill:#fbbc04"/>
                                            </svg>
                                            <br><br><b>Upload from Google Drive</b><br>
                                            <span>Access your Google account</span>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="receiptForwardingButton" id="receiptForwardingButton">
                                    <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-center">
                                            <img style="width: 50px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNzYiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA3NiA1MCI+CiAgICA8ZGVmcz4KICAgICAgICA8cGF0aCBpZD0iYSIgZD0iTS4wMzEuNDNoMzguMjA0djM4LjIwM0guMDN6Ii8+CiAgICA8L2RlZnM+CiAgICA8ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxwYXRoIGZpbGw9IiNGRkYiIGQ9Ik00LjE4NCA0Ny43MThhMS41OTggMS41OTggMCAwIDEtMS4xOTEtLjM5NiAxLjY2IDEuNjYgMCAwIDEtLjU1Ni0xLjE0NlYzLjA4NmExLjY2IDEuNjYgMCAwIDEgLjU1Ni0xLjE0NmMuMzI4LS4yOS43NTgtLjQzMyAxLjE5MS0uMzk2aDY3LjY5NWMuNDM0LS4wMzcuODYzLjEwNiAxLjE5Mi4zOTYuMzI4LjI5LjUyOS43MDMuNTU2IDEuMTQ2djQyLjg3NmMtLjA5OSAxLjA2LTEuMDE0IDEuODQyLTIuMDU1IDEuNzU2SDQuMTg0eiIvPgogICAgICAgIDxwYXRoIHN0cm9rZT0iIzAwODQ4MSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjMiIGQ9Ik00LjE4NCA0Ny43MThhMS41OTggMS41OTggMCAwIDEtMS4xOTEtLjM5NiAxLjY2IDEuNjYgMCAwIDEtLjU1Ni0xLjE0NlYzLjA4NmExLjY2IDEuNjYgMCAwIDEgLjU1Ni0xLjE0NmMuMzI4LS4yOS43NTgtLjQzMyAxLjE5MS0uMzk2aDY3LjY5NWMuNDM0LS4wMzcuODYzLjEwNiAxLjE5Mi4zOTYuMzI4LjI5LjUyOS43MDMuNTU2IDEuMTQ2djQyLjg3NmMtLjA5OSAxLjA2LTEuMDE0IDEuODQyLTIuMDU1IDEuNzU2SDQuMTg0eiIvPgogICAgICAgIDxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMyIDQuMDk5KSI+CiAgICAgICAgICAgIDxtYXNrIGlkPSJiIiBmaWxsPSIjZmZmIj4KICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI2EiLz4KICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjMDBDMUJGIiBmaWxsLW9wYWNpdHk9Ii4xNSIgZD0iTTM4LjIzNS40M3YzOC4yMDNILjAzeiIgbWFzaz0idXJsKCNiKSIvPgogICAgICAgIDwvZz4KICAgICAgICA8cGF0aCBzdHJva2U9IiMwMEMxQkYiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIyLjEyIiBkPSJNNyA3LjA5OWwzMC4zMTEgMTdMNjcgNy4wOTkiLz4KICAgIDwvZz4KPC9zdmc+Cg==" alt="Email">
                                        </div>
                                        <div class="col-sm-12 d-flex flex-column text-center">
                                            <br>
                                            <b>Set up receipt forwarding</b>
                                            <div>Ask your primary admin to set up receipt forwarding.</div>
                                        </div>
                                    </div>
                                </button>
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
                            <div class="tab-content mt-3">
                                <div class="tab-pane active" id="forReview">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="dropdown mr-2">
                                            <button class="btn btn-default batch-action-dp" type="button" data-toggle="dropdown" style="border-radius: 36px;">
                                                Batch actions&nbsp;<i class="fa fa-angle-down fa-lg"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-left" id="batchActions">
                                                <li><a href="#" class="dropdown-item" data-action="confirm">Confirm selected</a></li>
                                                <li><a href="#" class="dropdown-item" data-action="review">Review selected</a></li>
                                                <li><a href="#" class="dropdown-item" data-action="delete">Delete selected</a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown filter-dp">
                                            <i class="fa fa-sliders fa-2x fa-rotate-270 " data-toggle="dropdown"></i>
                                            <ul class="dropdown-menu">
                                                <li style="padding:1rem; min-height:unset;">
                                                    <form action="" method="" class="receiptsFilterForm" id="receiptsFilterForm">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="receiptsFilterForm__date">Dates</label>
                                                                <select id="receiptsFilterForm__date" class="form-control" data-type="date">
                                                                    <option value="all">All dates</option>
                                                                    <option value="custom">Custom</option>
                                                                    <option value="365_ago">Since 365 days ago</option>
                                                                    <option value="this_month">This month</option>
                                                                    <option value="this_quarter">This quarter</option>
                                                                    <option value="this_year">This year</option>
                                                                    <option value="last_month">Last month</option>
                                                                    <option value="last_quarter">Last quarter</option>
                                                                    <option value="last_year">Last year</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="receiptsFilterForm__from">From</label>
                                                                <input id="receiptsFilterForm__from" type="date" class="form-control" data-type="from">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="receiptsFilterForm__to">To</label>
                                                                <input id="receiptsFilterForm__to" type="date" class="form-control" data-type="to">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="receiptsFilterForm__category">Account/Category</label>
                                                                <select id="receiptsFilterForm__category" name="category" class="form-control select2" data-select2-type="bank_account" data-type="category_id">
                                                                    <option disabled selected value="">Select a category</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row amountWrapper" data-type="between">
                                                            <div class="col-md-6">
                                                                <label for="receiptsFilterForm__amount">Amount</label>
                                                                <select id="receiptsFilterForm__amount" class="form-control" data-type="amount">
                                                                    <option value="between">Between</option>
                                                                    <option value="less_than">Less Than</option>
                                                                    <option value="greater_than">Greater Than</option>
                                                                    <option value="equals">Equals</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row" data-amount-type="between">
                                                                    <div class="col-md-6">
                                                                        <label for="receiptsFilterForm__betweenMin">Minimum</label>
                                                                        <input id="receiptsFilterForm__betweenMin" type="number" class="form-control" data-type="between_min">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="receiptsFilterForm__betweenMax">Maximum</label>
                                                                        <input id="receiptsFilterForm__betweenMax" type="number" class="form-control" data-type="between_max">
                                                                    </div>
                                                                </div>
                                                                <div class="row" data-amount-type="less_than">
                                                                    <div class="col-md-12">
                                                                        <label for="receiptsFilterForm__lessThanMax">Maximum</label>
                                                                        <input id="receiptsFilterForm__lessThanMax" type="number" class="form-control" data-type="less_than_max">
                                                                    </div>
                                                                </div>
                                                                <div class="row" data-amount-type="greater_than">
                                                                    <div class="col-md-12">
                                                                        <label for="receiptsFilterForm__greaterThanMin">Minimum</label>
                                                                        <input id="receiptsFilterForm__greaterThanMin" type="number" class="form-control" data-type="greater_than_min">
                                                                    </div>
                                                                </div>
                                                                <div class="row" data-amount-type="equals">
                                                                    <div class="col-md-12">
                                                                        <label for="receiptsFilterForm__equals">Equals</label>
                                                                        <input id="receiptsFilterForm__equals" type="number" class="form-control" data-type="equals">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <button class="btn btn-default" type="reset">Reset</button>
                                                            <button class="btn btn-success receiptsButton" type="button">
                                                                <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                                Apply
                                                            </button>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <input type="hidden" id="uploadPath" value="<?=base_url('uploads/accounting/');?>" />
                                    <table id="receiptsReview" class="table table-striped table-bordered receiptsTable">
                                        <thead class="receiptsTable__head">
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="receiptsTable__checkbox receiptsTable__checkbox--primary"/>
                                                </th>
                                                <th class="receiptsTable__imgHeader">Receipt</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Payment Account</th>
                                                <th>Amount/Tax</th>
                                                <th>Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="reviewed">
                                    <table id="receiptsReviewed" class="table table-striped table-bordered receiptsTable">
                                        <thead class="receiptsTable__head">
                                            <tr>
                                                <th class="receiptsTable__imgHeader">Receipt</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount/Tax</th>
                                                <th>Linked Record</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
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
                    <form data-active-step="1">
                        <div class="modal-body" style="margin-bottom: 100px">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="viewer-backdrop-container">
                                        <div class="viewer-backdrop">
                                            <input type="hidden" id="base_url" value="<?=base_url()?>uploads/accounting/">
                                            <img src="" id="receiptImage" alt="Image">
                                        </div>
                                        <div class="label-imageContainer" style="margin-top: 15px;">
                                            <span id="receiptImageCreatedAt"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="receiptDetailsContainer" data-step="1">
                                        <input type="hidden" name="receipt_id" id="receipt_id" data-type="id">

                                        <div class="formError">
                                            <div class="formError__inner">
                                                <i class="fa fa-info-circle"></i>
                                                <div>
                                                    <p>Something’s not quite right</p>
                                                    <p>Please fill in all required details.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="step-header">Receipt details</div>
                                        <div class="step-header-text">Double-check the details and add any missing info.</div>
                                        <div class="form-group form-element">
                                            <span>Document Type</span>
                                            <select name="document_type" id="documentType" class="form-control" data-type="document_type">
                                                <option value="Receipt">Receipt</option>
                                                <option value="Bill">Bill</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label for="payeeID">Payee</label>
                                            <select name="payee_id" id="payeeID" class="form-control select2" data-select2-type="payee" data-type="payee">
                                                <option disabled selected value="">Select payee (optional)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account">Bank/Credit Account</label>
                                            <select required name="bank_account" id="bank_account" class="form-control select2" data-select2-type="bank_credit_account" data-type="bank_account_id">
                                                <option disabled selected value="">Select an account</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Payment Date</label>
                                            <input required type="date" name="transaction_date" id="paymentDate" class="form-control" placeholder="Select a date" data-type="transaction_date">
                                        </div>
                                        <div class="form-group">
                                            <label for="account_category">Account/Category</label>
                                            <select required name="category" id="account_category" class="form-control select2" data-select2-type="bank_account" data-type="category_id">
                                                <option disabled selected value="">Select a category</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <input type="text" name="description" id="description" class="form-control" placeholder="Enter a description" data-type="description">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total amount (Inclusive of tax)*</label>
                                            <input required type="number" name="total_amount" id="totalAmount" class="form-control" placeholder="Enter amount" data-type="total_amount">
                                        </div>
                                        <div class="form-group">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" cols="15" rows="5" class="memo-textarea" placeholder="Add note (optional)" data-type="memo"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:;" style="font-weight:bolder;color:#0077c5;" id="toggleRefNumber"><i class="fa fa-caret-right"></i>&nbsp;Additional Fields (optional)</a>
                                        </div>
                                        <div class="form-group" id="refNumber" style="display: none">
                                            <label for="refNumber">Ref no.</label>
                                            <input type="text" name="ref_number" id="refNumber" class="form-control" data-type="ref_number">
                                        </div>
                                    </div>

                                    <div class="receiptDetailsContainer" data-step="2">
                                        <div class="mb-2"><a href="" class="step-back" id="toEditReceipt">< Edit receipt details</a></div>
                                        <div class="step-header">No matches found</div>
                                        <div class="step-header-text">Create a new expense for this receipt. If a matching transaction comes into nSmarTrac later, we’ll mark it as a match.</div>

                                        <hr>

                                        <div class="receiptInfo">
                                            <div class="receiptInfo__inner">
                                                <div class="receiptInfo__box">
                                                    <div class="receiptInfo__row">
                                                        <div class="font-weight-bold">Draft Expense</div>
                                                        <div data-type="transaction_date"></div>
                                                    </div>
                                                    <div class="receiptInfo__row">
                                                        <div data-type="__select2_bank_account"></div>
                                                        <div class="font-weight-bold"><span data-type="total_amount"></span></div>
                                                    </div>
                                                    <hr/>
                                                    <div class="receiptInfo__row">
                                                        <div><span data-type="__select2_category"></span></div>
                                                        <div><span data-type="total_amount"></span></div>
                                                    </div>
                                                </div>

                                                <button type="button" class="receiptInfo__btn" id="searchManually">Search Manually</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="receiptDetailsContainer" data-step="3">
                                        <div class="mb-2"><a href="" class="step-back" id="toFindMatch">< Go back</a></div>
                                        <div class="step-header">Find other match</div>
                                        <div class="step-header-text">Please select one of payment account, payee or date fields to begin search.</div>

                                        <hr>

                                        <div class="formError">
                                            <div class="formError__inner">
                                                <i class="fa fa-info-circle"></i>
                                                <div>
                                                    <p>Cannot match</p>
                                                    <p>Select 1 transaction from the list to match the document to.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="transaction_type">Transaction type</label>
                                                    <select name="transaction_type" id="transaction_type" class="form-control select2" data-type="transaction_type">
                                                        <option disabled selected value="">Select transaction type</option>
                                                        <option value="bill" disabled>Bill</option>
                                                        <option value="expense">Expense</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="payment_account">Payment account</label>
                                                    <select required name="payment_account" id="payment_account" class="form-control select2" data-select2-type="payment_account" data-type="payment_account">
                                                        <option disabled selected value="">Select an account</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="payee">Payee</label>
                                                    <select required name="payee" id="payee" class="form-control select2" data-select2-type="payee" data-type="payee">
                                                        <option disabled selected value="">Select payee</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="starting_date">Starting Date</label>
                                                    <input required type="date" name="starting_date" id="starting_date" class="form-control" placeholder="Select a date" data-type="starting_date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ending_date">Ending Date</label>
                                                    <input required type="date" name="ending_date" id="ending_date" class="form-control" placeholder="Select a date" data-type="ending_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="minimum_transaction_amount">Minimum transaction amount</label>
                                                    <input required type="number" name="minimum_transaction_amount" id="minimum_transaction_amount" class="form-control" placeholder="Select a date" data-type="minimum_transaction_amount">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="maximum_transaction_amount">Maximum transaction amount</label>
                                                    <input required type="number" name="maximum_transaction_amount" id="maximum_transaction_amount" class="form-control" placeholder="Select a date" data-type="maximum_transaction_amount">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-default receiptsButton" id="searchExpenses" style="border-radius: 36px;">
                                                <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Search
                                            </button>
                                        </div>

                                        <hr />

                                        <table id="searchedReceipts" class="table table-striped table-bordered receiptsTable">
                                            <thead class="receiptsTable__head">
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" class="receiptsTable__checkbox receiptsTable__checkbox--primary"/>
                                                    </th>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Payee</th>
                                                    <th>Payment Account</th>
                                                    <th>Transaction Amount</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer-uploadedReceipt" style="display: flex;justify-content:space-between;">
                            <div>
                                <button type="button" data-dismiss="modal" class="btn btn-default btn-leftSide">Cancel</button>
                                <button type="button" class="btn btn-default btn-leftSide" style="margin-left: 10px" data-action="deletereceipt">Delete this receipt</button>
                            </div>

                            <div class="d-flex align-items-center formActions">
                                <!-- this checkbox should only show in step 2 -->
                                <div class="form-check mr-2">
                                    <input type="checkbox" class="form-check-input" id="handlenextreceipt">
                                    <label class="form-check-label" for="handlenextreceipt">Go to next</label>
                                </div>

                                <div class="dropdown d-flex">
                                    <div>
                                        <!-- this button should only show in step 1 -->
                                        <button
                                            type="button"
                                            class="btn btn-success receiptsButton"
                                            data-action="savereceipt"
                                            data-action-after="next"
                                        >
                                            <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Save and next
                                        </button>

                                        <!-- this button should only show in step 2 -->
                                        <button
                                            type="button"
                                            class="btn btn-success receiptsButton"
                                            data-action="createexpense"
                                        >
                                            <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Create expense
                                        </button>

                                        <!-- this button should only show in step 3 -->
                                        <button
                                            type="button"
                                            class="btn btn-success receiptsButton receiptsButton--match"
                                            data-action="matchreceipt"
                                        >
                                            <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Match
                                        </button>
                                    </div>


                                    <button class="btn btn-success receiptsButton__dropdown" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -3px;">
                                        <span class="fa fa-caret-down"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="#" class="dropdown-item" data-action="savereceipt" data-action-after="close">Save and close</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="googleDriveLoader" id="googleDriveLoader">
        <div class="googleDriveLoader__inner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="googleDriveLoader__text">
                Fetching your documents from Google Drive...
            </div>
        </div>
    </div>

    <div id="receiptForwardingModal" class="modal fade modal-fluid receiptModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Let's create your forwarding email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <p>Send receipts and bills to an email just for <span id="receiptCompany" class="font-weight-bold">[company name here]</span>.</p>
                    <div class="form-group">
                        <label for="receiptEmail">Email address *</label>
                        <input type="email" class="form-control" id="receiptEmail">
                    </div>

                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="mr-1">
                            <path d="m24 0-6 22-8.129-7.239 7.802-8.234-10.458 7.227L0 12 24 0zM9 16.668V24l3.258-4.431L9 16.668z" fill="#32243d"/>
                        </svg>
                        <span class="receiptModal__emailCopy"></span>
                    </div>

                    <hr />
                    <p class="receiptModal__note">Keep in mind that this email doesn't support auto-forwarding, so you'll need to send them directly. Be sure to forward receipts and bills from the email address you use to sign into nSmarTrac.</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary receiptsButton">
                    <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Next
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div id="modal-container">
        <div class="full-screen-modal"></div>
    </div>
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>
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
    $('#toggleRefNumber').click(function () {
       $('#refNumber').toggle();
    });
</script>

<script>
$("#createExpense").click(function () {
    var rID = $(this).attr('data-id');

    $.ajax({
        type : 'POST',
        url : "<?=base_url();?>accounting/receipt_create_expense",
        data : {rID: rID },
        dataType: 'json',
        success: function(response){

        },
    });

    $(".createPackage").modal("hide");

});
</script>


