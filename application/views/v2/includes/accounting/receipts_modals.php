<div class="full-screen-modal">
    <!--Modal for file upload-->
    <div id="receiptModal" class="modal fade modal-fluid nsm-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Upload receipt</h2>
                    <i class="fa fa-times fa-lg" data-bs-dismiss="modal"></i>
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
                            <button type="button" data-bs-dismiss="modal" class="btn btn-default btn-leftSide">Cancel</button>
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

<!-- <div id="receiptForwardingModal-remove" class="modal fade modal-fluid receiptModal nsm-modal" role="dialog">
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div> -->

<div class="modal" id="receiptForwardingModal" role="dialog" data-bs-keyboard="true" aria-modal="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <span class="modal-title content-title" style="font-size: 17px;">Let's create your forwarding email</span>
            <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
         </div>
         <div class="modal-body" style="padding-top: 10px;">
            <form>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="row">
                     <div class="col-md-12 mb-3">
                            <span class="text-muted">Send receipts and bills to an email just for <span id="receiptCompany" class="font-weight-bold">[company name here]</span>.</span>
                        </div>
                        <div class="col-md-12 mb-3">
                           <label class="mb-1 fw-xnormal">Email Address</label>
                              <input id="receiptEmail" class="nsm-field form-control" type="text" name="company_name" placeholder="Enter your email address" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <span class="text-muted">Keep in mind that this email doesn't support auto-forwarding, so you'll need to send them directly. Be sure to forward receipts and bills from the email address you use to sign into nSmarTrac.</span>
                        </div>
                     </div>
                  </div>
               </div>
               <hr class="mt-0">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="float-start">
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                     </div>
                     <div class="float-end">
                        <button type="submit" class="nsm-button primary receiptsButton">Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>