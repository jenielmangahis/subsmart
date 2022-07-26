<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <p class="m-0">Rows/columns</p>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-group-by">Group by</label>
                                        <select class="nsm-field form-select" name="filter_group_by" id="filter-group-by">
                                            <option value="none" selected>None</option>
                                            <option value="shipping-city">Shipping City</option>
                                            <option value="shipping-state">Shipping State</option>
                                            <option value="shipping-zip">Shipping ZIP</option>
                                            <option value="billing-city">Billing City</option>
                                            <option value="billing-state">Billing State</option>
                                            <option value="billing-zip">Billing ZIP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" selected>Default</option>
                                                    <option value="billing-city">Billing City</option>
                                                    <option value="billing-country">Billing Country</option>
                                                    <option value="billing-state">Billing State</option>
                                                    <option value="billing-street">Billing Street</option>
                                                    <option value="billing-zip">Billing ZIP</option>
                                                    <option value="cc-expires">CC Expires</option>
                                                    <option value="company-name">Company Name</option>
                                                    <option value="create-date">Create Date</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="credit-card-num">Credit Card #</option>
                                                    <option value="customer-type">Customer Type</option>
                                                    <option value="delivery-method">Delivery Method</option>
                                                    <option value="email">Email</option>
                                                    <option value="first-name">First Name</option>
                                                    <option value="full-name">Full Name</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="last-name">Last Name</option>
                                                    <option value="note">Note</option>
                                                    <option value="other">Other</option>
                                                    <option value="payment-method">Payment Method</option>
                                                    <option value="phone">Phone</option>
                                                    <option value="resale-num">Resale #</option>
                                                    <option value="shipping-city">Shipping City</option>
                                                    <option value="shipping-country">Shipping Country</option>
                                                    <option value="shipping-state">Shipping State</option>
                                                    <option value="shipping-street">Shipping Street</option>
                                                    <option value="shipping-zip">Shipping ZIP</option>
                                                    <option value="tax-rate">Tax Rate</option>
                                                    <option value="taxable">Taxable</option>
                                                    <option value="terms">Terms</option>
                                                    <option value="website">Website</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-customer" class="form-check-input" checked>
                                                            <label for="col-customer" class="form-check-label">Customer</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-create-date" class="form-check-input">
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-created-by" class="form-check-input">
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified" class="form-check-input">
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified-by" class="form-check-input">
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-phone" class="form-check-input">
                                                            <label for="col-phone" class="form-check-label">Phone</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-phone-numbers" class="form-check-input" checked>
                                                            <label for="col-phone-numbers" class="form-check-label">Phone Numbers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-email" class="form-check-input" checked>
                                                            <label for="col-email" class="form-check-label">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-full-name" class="form-check-input" checked>
                                                            <label for="col-full-name" class="form-check-label">Full Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-address" class="form-check-input" checked>
                                                            <label for="col-billing-address" class="form-check-label">Billing Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-address" class="form-check-input" checked>
                                                            <label for="col-shipping-address" class="form-check-label">Shipping Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-company-name" class="form-check-input">
                                                            <label for="col-company-name" class="form-check-label">Company Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-website" class="form-check-input">
                                                            <label for="col-website" class="form-check-label">Website</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-delivery-method" class="form-check-input">
                                                            <label for="col-delivery-method" class="form-check-label">Delivery Method</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-other" class="form-check-input">
                                                            <label for="col-other" class="form-check-label">Other</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-taxable" class="form-check-input">
                                                            <label for="col-taxable" class="form-check-label">Taxable</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-tax-rate" class="form-check-input">
                                                            <label for="col-tax-rate" class="form-check-label">Tax Rate</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-resale-no" class="form-check-input">
                                                            <label for="col-resale-no" class="form-check-label">Resale #</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-credit-card-no" class="form-check-input">
                                                            <label for="col-credit-card-no" class="form-check-label">Credit Card #</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-cc-expires" class="form-check-input">
                                                            <label for="col-cc-expires" class="form-check-label">CC Expires</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-payment-method" class="form-check-input">
                                                            <label for="col-payment-method" class="form-check-label">Payment Method</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-terms" class="form-check-input">
                                                            <label for="col-terms" class="form-check-label">Terms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-customer-type" class="form-check-input">
                                                            <label for="col-customer-type" class="form-check-label">Customer Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-note" class="form-check-input">
                                                            <label for="col-note" class="form-check-label">Note</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-street" class="form-check-input">
                                                            <label for="col-billing-street" class="form-check-label">Billing Street</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-city" class="form-check-input">
                                                            <label for="col-billing-city" class="form-check-label">Billing City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-state" class="form-check-input">
                                                            <label for="col-billing-state" class="form-check-label">Billing State</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-zip" class="form-check-input">
                                                            <label for="col-billing-zip" class="form-check-label">Billing ZIP</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-country" class="form-check-input">
                                                            <label for="col-billing-country" class="form-check-label">Billing Country</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-street" class="form-check-input">
                                                            <label for="col-shipping-street" class="form-check-label">Shipping Street</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-city" class="form-check-input">
                                                            <label for="col-shipping-city" class="form-check-label">Shipping City</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-state" class="form-check-input">
                                                            <label for="col-shipping-state" class="form-check-label">Shipping State</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-zip" class="form-check-input">
                                                            <label for="col-shipping-zip" class="form-check-label">Shipping ZIP</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-country" class="form-check-input">
                                                            <label for="col-shipping-country" class="form-check-label">Shipping Country</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-name" class="form-check-input">
                                                            <label for="col-last-name" class="form-check-label">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-first-name" class="form-check-input">
                                                            <label for="col-first-name" class="form-check-label">First Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold"><span class="company-name"><?=$clients->business_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="fw-bold">Customer Contact List</p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Customer">CUSTOMER</td>
                                            <td data-name="Phone Numbers">PHONE NUMBERS</td>
                                            <td data-name="Email">EMAIL</td>
                                            <td data-name="Full Name">FULL NAME</td>
                                            <td data-name="Billing Address">BILLING ADDRESS</td>
                                            <td data-name="Shipping Address">SHIPPING ADDRESS</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Test Customer</td>
                                            <td>Phone: (123) 456-7890</td>
                                            <td>test@test.com</td>
                                            <td>Test Customer</td>
                                            <td>Test billing address</td>
                                            <td>Test shipping address</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0"><?=date("l, F j, Y h:i A eP")?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>