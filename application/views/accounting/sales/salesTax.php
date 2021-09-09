<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
?>

<template id="overdueItemTemplate">
    <div class="taxItem">
        <div>
            <div class="taxItem__textSecondary" data-value="date"></div>
            <div class="taxItem__textPrimary" data-value="address"></div>
        </div>
        <div class="text-right pr-4">
            <div class="taxItem__textSecondary">
                <i class="fa fa-info-circle text-danger"></i>
                Was due <span data-value="due_date"></span>
            </div>
            <div class="taxItem__textPrimary" data-value="price"></div>
        </div>
        <div>
            <button class="btn btn-primary">View return</button>
        </div>
    </div>
</template>

<template id="dueItemTemplate">
    <div class="taxItem">
        <div>
            <div class="taxItem__textSecondary" data-value="date"></div>
            <div class="taxItem__textPrimary" data-value="address"></div>
        </div>
        <div class="text-right pr-4">
            <div class="taxItem__textSecondary">
                <i class="fa fa-info-circle text-warning"></i>
                Due <span data-value="due_date"></span>
            </div>
            <div class="taxItem__textPrimary" data-value="price"></div>
        </div>
        <div>
            <button class="btn btn-primary">View return</button>
        </div>
    </div>
</template>

<template id="upcomingItemTemplate">
    <div class="taxItem taxItem--isUpcoming">
        <div>
            <div class="taxItem__textSecondary" data-value="due_date"></div>
            <div class="taxItem__textPrimary" data-value="address"></div>
        </div>
        <div class="text-right">
            <div class="taxItem__textSecondary">
                Accruing
            </div>
            <div class="taxItem__textPrimary" data-value="price"></div>
        </div>
    </div>
</template>

<div class="wrapper" role="wrapper">
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Sales Tax</h3>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                        <a href="<?php echo url('/accounting/salesTax') ?>" class="banking-tab active">Sales Tax</a>
                                        <a href="<?php echo url('/accounting/payrollTax') ?>" class="banking-tab" style="text-decoration: none">Payroll Tax</a>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:20px;">
                                To start recording sales tax for your company, you need to turn on this feature and set up sales tax items or tax groups.  Go to the Edit menu, then select Preferences.<br>On the Preferences window, select Sales Tax then go to the Company Preferences tab.  Select Yes to turn on sales tax.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <h3>$<span id="totalTax">0.00</span></h3>
                    <h5>SALES TAX DUE</h5>

                    <br>

                    <div class="dropdownWithSearchContainer" id="dueDateInputs">
                        <div>
                            <label>Due Date Start</label>
                            <div data-type="due_start" class="dropdownWithSearch">
                                <input type="text" class="form-control dropdownWithSearch__input">
                                <button class="dropdownWithSearch__btn">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div>
                            <label>Due Date End</label>
                            <div data-type="due_end" class="dropdownWithSearch">
                                <input type="text" class="form-control dropdownWithSearch__input">
                                <button class="dropdownWithSearch__btn">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>

                        <button class="btn btn-primary" id="refreshList" disabled>Refresh</button>
                        <span class="dropdownWithSearchContainer__error d-none">
                            Invalid date range, end date must be after start date.
                        </span>
                    </div>

                    <br>

                    <div class="taxList">
                        <h6 class="taxList__title">Overdue</h6>
                        <div id="overdueContainer">
                            <div class="taxList__loader"></div>
                        </div>
                    </div>

                    <div class="taxList">
                        <h6 class="taxList__title">Due</h6>
                        <div id="dueContainer">
                            <div class="taxList__loader"></div>
                        </div>
                    </div>

                    <div class="taxList">
                        <h6 class="taxList__title">Upcoming</h6>
                        <div id="upcomingContainer">
                            <div class="taxList__loader"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" style="padding:3%;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3" align="center">
                                    <a href="#" style="color:#0077C5;">History</a>
                                </div>
                                <div class="col-md-1" align="center">
                                    |
                                </div>
                                <div class="col-md-4" align="center">
                                    <a href="#" style="color:#0077C5;">Sales tax settings</a>
                                </div>
                                <div class="col-md-1" align="center">
                                    |
                                </div>
                                <div class="col-md-2" align="center">
                                    <a href="#" style="color:#0077C5;">Reports</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shortcuts mt-4">
                        <div class="shortcuts__header">
                            Shortcuts
                        </div>

                        <ul class="shortcuts__list">
                            <li class="shortcuts__item">
                                <a href="<?=url('/accounting/taxEditSettings');?>" class="shortcuts__itemMain">
                                    <div class="shortcuts__logo">
                                        <img src="<?php echo $url->assets ?>img/taxlogo/l1.png">
                                    </div>
                                    <div class="shortcuts__text">
                                        <div class="shortcuts__title">Tell us where you collect tax</div>
                                        <div class="shortcuts__body">
                                            Make sure you're only charging tax in the right states.
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="shortcuts__item">
                                <a href="<?php echo url('/accounting/products-and-services') ?>" class="shortcuts__itemMain">
                                    <div class="shortcuts__logo">
                                        <img src="<?php echo $url->assets ?>img/taxlogo/l2.png">
                                    </div>
                                    <div class="shortcuts__text">
                                        <div class="shortcuts__title">Update products and services</div>
                                        <div class="shortcuts__body">
                                            Get the most accurate rates by categorizing what you sell.
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="shortcuts__item">
                                <a href="<?php echo url('/accounting/customers') ?>" class="shortcuts__itemMain">
                                    <div class="shortcuts__logo">
                                        <img src="<?php echo $url->assets ?>img/taxlogo/l3.png">
                                    </div>
                                    <div class="shortcuts__text">
                                        <div class="shortcuts__title">Double-check client addresses</div>
                                        <div class="shortcuts__body">
                                            Don't forget that tax rates can depend on customer location.
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="shortcuts__item">
                                <a href="<?php echo url('/accounting/reports') ?>" class="shortcuts__itemMain">
                                    <div class="shortcuts__logo">
                                        <img src="<?php echo $url->assets ?>img/taxlogo/l4.png">
                                    </div>
                                    <div class="shortcuts__text">
                                        <div class="shortcuts__title">Run sales tax reports</div>
                                        <div class="shortcuts__body">
                                            Get a detailed look at the taxes you owe and why you owe them.
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li class="shortcuts__item">
                                <a href="#" class="shortcuts__itemMain">
                                    <div class="shortcuts__logo">
                                        <img src="<?php echo $url->assets ?>img/taxlogo/l5.png">
                                    </div>
                                    <div class="shortcuts__text">
                                        <div class="shortcuts__title">Look at past returns</div>
                                        <div class="shortcuts__body">
                                            Quickly see all the sales tax payments you've made so far.
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="modal fade taxModal" tabindex="-1" role="dialog" id="reviewSalesTaxModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review your sales tax</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="taxModal__section row mb-3">
                    <div class="col">
                        <div>
                            <div class="taxModal__title" data-type="agency_name">Florida Department of Revenue</div>
                            <div>Tax Period: <span data-type="date_issued"></span></div>
                            <div>Due date:  <span data-type="due_date"></span></div>
                        </div>

                        <div class="taxModal__spacer"></div>

                        <div>
                            <div class="taxModal__title taxModal__title--secondary">
                                <span data-type="company.business_name"></span>
                            </div>
                            <div data-type="company.business_address"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="taxModal__title">File your sales tax now</div>
                        <ol class="taxModal__list">
                            <li>Print the tax form from your state's website and fill it out.</li>
                            <li>Write a check to your agency or print one.</li>
                            <li>Mail the form and check to your agency.</li>
                            <li>When you're done, come back to record the payment in QuickBooks.</li>
                        </ol>
                    </div>
                </div>

                <div class="taxModal__section">
                    <table class="table table-hover table-sm" id="taxItemsTable">
                        <thead>
                            <tr>
                                <th>Tax Agency</th>
                                <th class="text-right">Gross Sales</th>
                                <th class="text-right">Nontaxable Sales</th>
                                <th class="text-right">Taxable Sales</th>
                                <th class="text-right">Tax Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="emptyMessageRow">
                                <td colspan="5">
                                    <div class="text-center">No transactions available for this period.</div>
                                </td>
                            </tr>

                            <tr class="dataRow d-none">
                                <th data-table-type="agency_name"></th>
                                <td data-table-type="gross" class="text-right"></td>
                                <td data-table-type="nontaxable" class="text-right"></td>
                                <td data-table-type="taxable" class="text-right"></td>
                                <td data-table-type="tax" class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="taxModal__total">
                        <div class="taxModal__title taxModal__title--secondary">Total tax</div>
                        <div class="taxModal__title taxModal__title--secondary">
                            $<span data-table-type="tax"></span>
                        </div>
                    </div>

                    <div id="adjustmentsWrapper"></div>

                    <div class="taxModal__spacer"></div>

                    <a class="taxModal__link" href="#" id="addAdjustmentLink">+ Add an adjustment</a>

                    <div class="taxModal__spacer"></div>

                    <div class="taxModal__total taxModal__total--big">
                        <div class="taxModal__title taxModal__title--secondary">Total after adjustments</div>
                        <div class="taxModal__title taxModal__title--secondary">
                            $<span data-table-type="tax_adjusted"></span>
                        </div>
                    </div>

                    <div class="taxModal__spacer"></div>

                    <div class="text-center">
                        <a class="taxModal__link" href="#">View tax liability report</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="openRecordPaymentBtn">Record Payment</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade recordModal" tabindex="-1" role="dialog" id="recordPaymentModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Record payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="recordModal__title">File your sales tax</div>

                        <div class="recordModal__taxPayment">
                            <span>Total tax payment</span>
                            <span>-$<span data-type="tax_adjusted"></span></span>
                        </div>

                        <div class="recordModal__taxDue">
                            <span>Tax due</span>
                            <span>-$<span data-type="tax_adjusted"></span></span>
                        </div>

                        <ol class="recordModal__steps">
                            <li class="recordModal__stepsItem">
                                Download your full <a class="recordModal__link" href="#">report</a>.
                            </li>
                            <li class="recordModal__stepsItem">
                                Fill out the tax form on your tax agency's <a class="recordModal__link" href="#">website</a>.
                            </li>
                            <li class="recordModal__stepsItem">
                                Send the form and payment to your agency.
                            </li>
                            <li class="recordModal__stepsItem">
                                Don't forget to record the payment!
                            </li>
                        </ol>

                        <div>
                            <div class="recordModal__title">Record payment</div>

                            <form>
                                <div class="recordModal__formGroup">
                                    <div class="form-group">
                                        <label for="tax_amount">Tax amount</label>
                                        <input data-type="tax_amount" class="form-control" id="tax_amount">
                                    </div>

                                    <div class="form-group">
                                        <label for="Payment_date">Payment date</label>
                                        <input data-type="Payment_date" type="date" class="form-control" id="Payment_date">
                                    </div>

                                    <div class="form-group">
                                        <label for="bank_acount">Bank acount</label>
                                        <input data-type="bank_acount" class="form-control" id="bank_acount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="memo">Memo</label>
                                    <textarea data-type="memo" class="form-control" id="memo" placeholder="Enter memo text here"></textarea>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="print_check">
                                    <label class="form-check-label" for="print_check">Print check</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Record Payment</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="addAdjustment" id="addAdjustment">
        <div class="addAdjustment__inner">
            <div class="addAdjustment__header">
                <div class="addAdjustment__title">Add an adjustment</div>
                <button class="addAdjustment__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <p>
                An adjustment is an increase or decrease to the sales tax, including credits discounts, interest, penalties and corrections.
            </p>

            <form>
                <div class="form-group">
                    <label for="reason">Reason</label>
                    <select data-type="reason" class="form-control" id="reason">
                        <option value="" selected hidden>Reason</option>
                        <option value="credit_or_discount">Credit/Discount</option>
                        <option value="prior_prepayments">Prior prepayments</option>
                        <option value="pre_payments">Pre payments</option>
                        <option value="other">Other (penalties, interest, rounding errors)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="adjustment_date">Adjustment Date</label>
                    <input data-type="adjustment_date" type="date" class="form-control" id="adjustment_date">
                </div>

                <div class="form-group">
                    <label for="account">Account</label>
                    <div class="dropdownWithSearch" id="adjustmentAccount">
                        <input data-type="account" type="text" class="form-control dropdownWithSearch__input" id="account" placeholder="Select account">
                        <button type="button" class="dropdownWithSearch__btn">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input data-type="amount" type="number" class="form-control" id="amount" placeholder="Enter amount">
                </div>

                <div class="form-group d-none" id="memoFormGroup">
                    <label for="amount">Memo</label>
                    <textarea  data-type="memo" class="form-control" id="memo" placeholder="Enter memo text here"></textarea>
                </div>

                <div>
                    <div class="addAdjustment__title addAdjustment__title--small">Total tax due</div>
                    <div class="addAdjustment__total">$<span data-type="tax_adjusted"></span></div>
                </div>
            </form>

            <div class="addAdjustment__footer">
                <button type="button" class="btn btn-primary" id="addAdjustmentBtn">Add Adjustment</button>
            </div>

        </div>
    </div>

	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>
