<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
?>

<style>
div.disabled
{
  pointer-events: none;

  /* for "disabled" effect */
  opacity: 0.5;
  background: #CCC;
}

.ul-class{
    padding:1%;
}
.ul-class li{
    padding:1%;
    color:green;
}

.ul-class li a{
    color:#0077C5;
}
</style>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Payroll Tax Center</h3>
                    </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                            <!-- <h2>Rules</h2> -->
                                <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                    <a href="<?php echo url('/accounting/salesTax') ?>" class="banking-tab">Sales Tax</a>
                                    <a href="<?php echo url('/accounting/payrollTax') ?>" class="banking-tab active">Payroll Tax</a>
                                </div>
                            </div>
                        </div>
                            <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:5px;margin-top:20px;">
                            Go to Taxes and select Payroll Tax.<br>
                            Select Pay Taxes.<br>
                            Select Create payment on the tax you want to pay.<br>
                            Select E-pay.<br>
                            Always choose Earliest as it's the recommended date to pay taxes, then select Approve. ...<br>
                            An e-payment confirmation window appears, select Done.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="payrollTax">
                <div class="payrollTax__title">Payroll Tax Center</div>

                <div class="payrollTax__spacer"></div>

                <div class="payrollTaxTab">
                    <a href="<?=url('/accounting/payrollTax')?>" class="payrollTaxTab__btn payrollTaxTab__btn--first payrollTaxTab__btn--active">Payments</a>
                    <a href="<?=url('/accounting/payrollTaxFillings')?>" class="payrollTaxTab__btn payrollTaxTab__btn--last">Fillings</a>
                </div>

                <div class="payrollTax__spacer"></div>

                <div class="payrollTax__title payrollTax__title--sm">Upcoming tax payments</div>

                <div class="payrollTax__spacer"></div>

                <table class="table table-hover">
                    <template id="taxRowTemplate">
                        <tr class="payrollTax__row">
                            <td>
                                <div class="payrollTax__taxType">
                                    <button class="payrollTax__taxTypeBtn"><i class="fa fa-chevron-right"></i></button>
                                    <i class="fa fa-info-circle text-warning payrollTax__taxTypeIcon"></i>
                                    <div data-type="type.title" class="payrollTax__text700"></div>
                                    <div data-type="type.date_range" class="payrollTax__taxTypeDateRange"></div>
                                </div>
                            </td>
                            <td>
                                <div data-type="status" class="payrollTax__paymentStatus"></div>
                            </td>
                            <td>
                                <div class="payrollTax__text700">
                                    $<span data-type="amount"></span>
                                </div>
                            </td>
                            <td>
                                <div data-type="due_date" class="payrollTax__text700"></div>
                            </td>
                            <td>
                                <div class="payrollTax__paymentMethod">
                                    <div data-type="payment_method.primary_text" class="payrollTax__text700"></div>
                                    <div data-type="payment_method.secondary_text" class="payrollTax__paymentMethodDate"></div>
                                </div>
                            </td>
                            <td>
                                <div class="payrollTax__actions d-none">
                                    <button class="payrollTax__actionsBtn payrollTax__actionsBtn--disabled">Pay</button>
                                    <button class="payrollTax__actionsBtn payrollTax__actionsBtn--disabled">Mark as paid</button>
                                </div>
                            </td>
                        </tr>
                        <tr class="payrollTax__secondaryRow">
                            <td colspan="2">
                                <div class="payrollTax__taxType">
                                    <div data-type="secondary_data.type.title"></div>
                                </div>
                            </td>
                            <td colspan="4">
                                <div class="payrollTax__text400">
                                    $<span data-type="secondary_data.amount"></span>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <thead>
                        <tr>
                            <th scope="col">Tax type</th>
                            <th scope="col">Payment status</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Due date</th>
                            <th scope="col">Payment method</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="taxRowContainer">
                        <tr class="payrollTax__loaderRow">
                            <td colspan="6">Loading...</td>
                        </tr>
                    </tbody>
                </table>

                <div class="payrollTax__spacer"></div>

                <div class="payrollTax__resources">
                    <div class="payrollTax__title payrollTax__resourcesTitle">Payment resources</div>

                    <div class="payrollTax__spacer"></div>

                    <div class="payrollTax__resourcesItem">
                        <div><a class="payrollTax__resourcesLink" href="#">Tax payment history</a></div>
                        <div class="payrollTax__resourcesBody">Run reports to view your tax payments history.</div>
                    </div>

                    <div class="payrollTax__spacer"></div>

                    <div class="payrollTax__resourcesItem">
                        <div><a class="payrollTax__resourcesLink" href="#">Tax setup</a></div>
                        <div class="payrollTax__resourcesBody">Edit your federal and state tax info in Payroll Settings.</div>
                    </div>

                    <div class="payrollTax__spacer"></div>

                    <div class="payrollTax__resourcesItem">
                        <div><a class="payrollTax__resourcesLink" href="#">Tax liability report</a></div>
                        <div class="payrollTax__resourcesBody">Run reports to view your tax liabilities.</div>
                    </div>

                    <div class="payrollTax__spacer"></div>

                    <div class="payrollTax__resourcesItem">
                        <div><a class="payrollTax__resourcesLink" href="#">Prior tax history</a></div>
                        <div class="payrollTax__resourcesBody">Add payments to your prior tax history.</div>
                    </div>

                    <div class="payrollTax__spacer"></div>

                    <div class="payrollTax__resourcesItem">
                        <div><a class="payrollTax__resourcesLink" href="#">Compliance resources</a></div>
                        <div class="payrollTax__resourcesBody">Year-end info and resources to help stay in compliance.</div>
                    </div>

                    <div class="payrollTax__spacer"></div>

                    <div class="payrollTax__resourcesItem">
                        <div><a class="payrollTax__resourcesLink" href="#">COBRA premium assistance <div class="payrollTax__resourcesNew">NEW</div></a></div>
                        <div class="payrollTax__resourcesBody">Claim a tax credit as part of the American Rescue Plan Act of 2021 (eligibility applies).</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>

