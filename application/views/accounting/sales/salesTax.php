<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header'); ?>



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
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                        To start recording sales tax for your company, you need to turn on this feature and set up sales tax items or tax groups.  Go to the Edit menu, then select Preferences.<br>On the Preferences window, select Sales Tax then go to the Company Preferences tab.  Select Yes to turn on sales tax.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6" id="app-builder">
                        <div class="margin-bottom">
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-content">
                                    <div class="col-md-12" style="margin-top: 20px;">
                                    <h3><span id="totalTax">0.00</span></h3>
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

                                        <button class="nsm-button primary" id="refreshList" disabled>Refresh</button>
                                        <span class="dropdownWithSearchContainer__error d-none">
                                            Invalid date range, end date must be after start date.
                                        </span>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isLocalhost = ["localhost", "127.0.0.1"].includes(location.hostname);
        if (!isLocalhost) return;

        $.ajaxSetup({
            beforeSend: function (xhr,settings) {
                if (settings.url.startsWith("/accounting/")) {
                    settings.url = settings.url.replace("/accounting/", "/nsmartrac/accounting/")
                }
            }
        });
    });
</script>