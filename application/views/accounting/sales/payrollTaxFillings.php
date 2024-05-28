<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header'); 
?>

<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #6a4a86;
        background-color: white;
        border: solid #6a4a86 2px;
    }
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

    .payrollTax__resources .payrollTax__spacer {
        height: 20px;
    }
    .payrollTax__resources {
        font-family: var(--font-family-sans-serif);
        font-weight: 400;
    }
    .payrollTax__resourcesLink {
        color: #055393;
        font-weight: 500;
    }
    .payrollTax__resourcesBody {
        color: #6b6c72;
    }
</style>

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

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/payroll_tax'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/payroll_tax_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Payroll Tax Center</h3>
                                </div>
                                <div class="col-md-12">
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
                    </div>
                </div>

                <div class="payrollTax__title payrollTax__title--sm"><h4>Upcoming filings</h4></div>

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
</div>

<?php include viewPath('v2/includes/footer'); ?>