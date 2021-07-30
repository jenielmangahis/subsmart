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
                                    <a href="<?php echo url('/accounting/payrollTax') ?>" class="banking-tab active" style="text-decoration: none">Payroll Tax</a>
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
                    <a href="<?=url('/accounting/payrollTax')?>" class="payrollTaxTab__btn payrollTaxTab__btn--first">Payments</a>
                    <a href="<?=url('/accounting/payrollTaxFillings')?>" class="payrollTaxTab__btn payrollTaxTab__btn--last payrollTaxTab__btn--active">Fillings</a>
                </div>

                <div class="payrollTax__spacer"></div>

                <div class="payrollTax__title payrollTax__title--sm">Upcoming filings</div>

                <div class="payrollTax__spacer"></div>

                <table class="table table-hover">
                    <template id="taxRowTemplate">
                        <tr class="payrollTax__row">
                            <td>
                                <div data-type="form_type" class="payrollTax__text700"></div>
                            </td>
                            <td>
                                <div data-type="status" class="payrollTax__fillingStatus"></div>
                            </td>
                            <td>
                                <div>
                                    <div data-type="period.quarter" class="payrollTax__text700"></div>
                                    <div data-type="period.date_range" class="payrollTax__text400"></div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div data-type="due.primary_text" class="payrollTax__text700"></div>
                                    <div data-type="due.secondary_text" class="payrollTax__text400"></div>
                                </div>
                            </td>
                            <td>
                                <div class="payrollTax__actions">
                                    <button class="payrollTax__actionsBtn payrollTax__actionsBtn--disabled">File</button>
                                    <button class="payrollTax__actionsBtn payrollTax__actionsBtn--disabled">Preview</button>
                                </div>
                            </td>
                        </tr>
                    </template>

                    <thead>
                        <tr>
                            <th scope="col">Form type</th>
                            <th scope="col">Filing status</th>
                            <th scope="col">Period</th>
                            <th scope="col">Due</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="taxRowContainer">
                        <tr class="payrollTax__loaderRow">
                            <td colspan="6">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>

<?php include viewPath('includes/footer_accounting');?>

