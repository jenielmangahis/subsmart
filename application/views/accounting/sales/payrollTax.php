<?php include viewPath('v2/includes/header');  ?>

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
                            Go to Taxes and select Payroll Tax.<br>
                            Select Pay Taxes.<br>
                            Select Create payment on the tax you want to pay.<br>
                            Select E-pay.<br>
                            Always choose Earliest as it's the recommended date to pay taxes, then select Approve.<br>
                            An e-payment confirmation window appears, select Done.
                        </div>
                    </div>
                </div>              

                <div class="payrollTax__title payrollTax__title--sm"><h4>Upcoming tax payments</h4></div>

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
                
                <!-- 
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
                -->             

            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>