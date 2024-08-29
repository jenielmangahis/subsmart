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
                            Upcoming tax payments
                        </div>
                    </div>
                </div>      
                <div class="row mt-4">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search List">
                        </div>
                    </div>  
                </div>
                <table class="nsm-table" id="payroll-tax-list">
                    <template id="taxRowTemplate">
                        <tr class="payrollTax__row">
                            <td class="nsm-text-primary">
                                <div class="payrollTax__taxType">                                    
                                    <div data-type="type.title" class="payrollTax__text700"></div>
                                    <div data-type="type.date_range" class="payrollTax__taxTypeDateRange"></div>
                                </div>
                            </td>
                            <!-- <td class="nsm-text-primary">
                                <div data-type="status" class="payrollTax__paymentStatus"></div>
                            </td> -->
                            <td class="nsm-text-primary">
                                <div class="payrollTax__text700">
                                    $<span data-type="amount"></span>
                                </div>
                            </td>
                            <td class="nsm-text-primary">
                                <div data-type="due_date" class="payrollTax__text700"></div>
                            </td>
                            <!-- <td class="nsm-text-primary">
                                <div class="payrollTax__paymentMethod">
                                    <div data-type="payment_method.primary_text" class="payrollTax__text700"></div>
                                    <div data-type="payment_method.secondary_text" class="payrollTax__paymentMethodDate"></div>
                                </div>
                            </td> -->
                            <td class="nsm-text-primary">
                                <div class="dropdown table-management payrollTax__actions">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item btn-row-pay" href="javascript:void(0);">Pay</a></li>
                                        <li><a class="dropdown-item btn-row-mark-paid" href="javascript:void(0);">Mark as paid</a></li>
                                     </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- <tr class="payrollTax__secondaryRow">
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
                        </tr> -->
                    </template>

                    <thead>
                        <tr>
                            <td data-name="TaxType">Tax type</td>
                            <!-- <td data-name="PaymentStatus">Payment status</td> -->
                            <td data-name="Balance">Balance</td>
                            <td scope="DueDate">Due date</td>
                            <!-- <td scope="PaymentMethod">Payment method</td> -->
                            <td scope="Manamge" style="width:5%;"></td>
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
<script>
$(function(){
    $("#payroll-tax-list").nsmPagination({itemsPerPage:10});
});
</script>
<?php include viewPath('v2/includes/footer'); ?>