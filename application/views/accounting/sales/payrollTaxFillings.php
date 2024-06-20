<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
?>

<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #6a4a86;
        background-color: white;
        border: solid #6a4a86 2px;
    }

    div.disabled {
        pointer-events: none;

        /* for "disabled" effect */
        opacity: 0.5;
        background: #CCC;
    }

    .ul-class {
        padding: 1%;
    }

    .ul-class li {
        padding: 1%;
        color: green;
    }

    .ul-class li a {
        color: #0077C5;
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

    .nsm-table th,
    .nsm-table td {
        text-align: left;
        padding: 10px;
    }

    /* .payrollTax__row div {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    } */
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

                <div class="payrollTax__title payrollTax__title--sm">
                    <h4>Upcoming filings</h4>
                </div>

                <table class="nsm-table w-100 border-0 payrollTaxFillings">
                    <div class="row">
                        <div class="col-12 col-md-4 grid-mb">
                            <form id="search_form" action="javascript:void(0);" method="get">
                                <div class="nsm-field-group search">
                                    <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Search" value="<?php echo (!empty($search)) ? $search : '' ?>">
                                </div>
                            </form>
                        </div>
                    </div>
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
                            <!-- <td>
                                <div class="payrollTax__actions" style="margin-left: -8px;">
                                    <button class="nsm-button payrollTax__actionsBtn payrollTax__actionsBtn--disabled">File</button>
                                    <button class="nsm-button primary payrollTax__actionsBtn payrollTax__actionsBtn--disabled">Preview</button>
                                </div>
                            </td> -->
                            <td>
                                <div class="dropdown float-start">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item payrollTax__actionsBtn payrollTax__actionsBtn--disabled" href="#">File</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item payrollTax__actionsBtn payrollTax__actionsBtn--disabled" href="#">Preview</a>
                                        </li>
                                    </ul>
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
                    <tfoot>
                        <tr>
                            <td class="nsm-pagination" colspan="6">
                                <nav class="nsm-table-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link prev disabled" href="javascript:void(0);">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="">1</a></li>
                                        <li class="page-item"><a class="page-link next disabled" href="javascript:void(0);">Next</a></li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>

<script>
    // JavaScript for search functionality
    $(document).ready(function() {
        function performSearch() {
            var searchValue = $('#search_field').val().toLowerCase();
            var hasResults = false;

            $('#taxRowContainer .payrollTax__row').each(function() {
                var formType = $(this).find('[data-type="form_type"]').text().toLowerCase();
                var status = $(this).find('[data-type="status"]').text().toLowerCase();
                var periodQuarter = $(this).find('[data-type="period.quarter"]').text().toLowerCase();
                var periodDateRange = $(this).find('[data-type="period.date_range"]').text().toLowerCase();
                var duePrimary = $(this).find('[data-type="due.primary_text"]').text().toLowerCase();
                var dueSecondary = $(this).find('[data-type="due.secondary_text"]').text().toLowerCase();

                if (formType.indexOf(searchValue) === -1 &&
                    status.indexOf(searchValue) === -1 &&
                    periodQuarter.indexOf(searchValue) === -1 &&
                    periodDateRange.indexOf(searchValue) === -1 &&
                    duePrimary.indexOf(searchValue) === -1 &&
                    dueSecondary.indexOf(searchValue) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                    hasResults = true;
                }
            });

            $('.no-results').remove();

            if (!hasResults) {
                var noResultsRow = '<tr class="no-results">' +
                    '<td colspan="5">' +
                    '<div class="nsm-empty">' +
                    '<span>No results found.</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                $('#taxRowContainer').append(noResultsRow);
            }
        }

        $('#search_field').on('keydown', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                performSearch();
            }
        });

        $('.nsm-field-group.search').on('click', function() {
            performSearch();
        });
    });
</script>