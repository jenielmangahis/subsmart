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
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div>
                    </div>  
                </div>
                <table class="nsm-table" id="nsm-payroll-tax-list">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="TaxType" style="width:80%;">Tax type</td>
                            <td data-name="DueDate">Due Date</td>     
                            <td data-name="Balance" style="text-align:right;width:10%;">Balance</td>                                                   
                            <!-- <td data-name="Manage" style="width:5%;"></td> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($payrollTax as $tax){ ?>
                        <tr>
                            <td>
                                <div class="table-row-icon">
                                    <i class='bx bx-dollar-circle'></i>
                                </div>
                            </td>
                            <td class="fw-bold nsm-text-primary">
                                <div class="payrollTax__taxType">                         
                                    <div data-type="type.title" class="payrollTax__text700"><?= $tax->name; ?></div>
                                    <!-- <div data-type="type.date_range" class="payrollTax__taxTypeDateRange"><?= $tax->date_range; ?></div> -->
                                </div>
                            </td>                                 
                            <td class="nsm-text-primary">
                                <div data-type="due_date" class="payrollTax__text700"><?= $tax->time_date; ?></div>
                            </td>
                            <td class="nsm-text-primary" style="text-align:right;width:10%;">
                                <div class="payrollTax__text700">
                                    $<span data-type="amount"><?= number_format($tax->balance,2,'.',','); ?></span>
                                </div>
                            </td>                                                   
                            <!-- <td class="nsm-text-primary">
                                <div class="dropdown table-management payrollTax__actions">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item btn-row-pay" href="javascript:void(0);">Pay</a></li>
                                        <li><a class="dropdown-item btn-row-mark-paid" href="javascript:void(0);">Mark as paid</a></li>
                                     </ul>
                                </div>
                            </td> -->
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>    

            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#nsm-payroll-tax-list").nsmPagination({itemsPerPage:10});
    $("#search_field").on("input", debounce(function() {
        tableSearch($(this));        
    }, 1000));   
});
</script>
<?php include viewPath('v2/includes/footer'); ?>