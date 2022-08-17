<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reports_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Filter by name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> CSV Export
                            </button>
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bxs-file-pdf'></i> Get PDF
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3 grid-mb">
                    <div class="col-12 col-md-2">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title"><span>Business Profile</span></div>
                                <label class="nsm-subtitle"><?=$clients->business_name?></label>
                            </div>
                            <div class="nsm-card-content">
                                <div class="col-12 grid-mb">
                                    <img src="<?= getCompanyBusinessProfileImage(); ?>" class="w-100 rounded-circle">
                                </div>
                                <div class="col-12">
                                    <button type="button" class="nsm-button primary w-100">View Public Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="nsm-card-title"><span>Analytics for <?=getLoggedName()?></span></div>
                                    </div>
                                </div>
                                <div class="row g-1">
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Invoices Total</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">$10,575.48</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Estimates Total</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">$10,996.24</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Customers Total</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">381</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle fw-bold">Active Deals</label>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="content-subtitle">0</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row grid-mb">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="nsm-card-title"><span>Business Profile</span></div>
                                        <label class="nsm-subtitle">Views per day for period: Mar 31, 2020 - Apr 30, 2020</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="nsm-table">
                                            <thead>
                                                <tr>
                                                    <td>Metric</td>
                                                    <td>Feb '20</td>
                                                    <td>Mar '20</td>
                                                    <td>Apr '20</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Your business viewed</label>
                                                        <label class="default content-subtitle fst-italic d-block">How many times your business has been viewed by customers</label>
                                                    </td>
                                                    <td>21</td>
                                                    <td>15</td>
                                                    <td>10</td>
                                                    <td>81</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Your business shown on homepage/search</label>
                                                        <label class="default content-subtitle fst-italic d-block">How many times your business has been shown to customers on home page and in search results</label>
                                                    </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Customers who viewed your contact details</label>
                                                        <label class="default content-subtitle fst-italic d-block">How many times customers have seen your contact details</label>
                                                    </td>
                                                    <td>20</td>
                                                    <td>15</td>
                                                    <td>10</td>
                                                    <td>80</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row grid-mb">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="nsm-card-title"><span>Job Leads</span></div>
                                        <label class="nsm-subtitle">Jobs per day for time period: Mar 31, 2020 - Apr 30, 2020</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="nsm-table">
                                            <thead>
                                                <tr>
                                                    <td>Metric</td>
                                                    <td>Feb '20</td>
                                                    <td>Mar '20</td>
                                                    <td>Apr '20</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Total jobs posted</label>
                                                        <label class="default content-subtitle fst-italic d-block">All jobs posted in your coverage areas, that are requesting business services you are offering</label>
                                                    </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Your exclusive job leads</label>
                                                        <label class="default content-subtitle fst-italic d-block">The total number of job leads, you have been invited to estimate</label>
                                                    </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row grid-mb">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="nsm-card-title"><span>Deals</span></div>
                                        <label class="nsm-subtitle">Views per day for period: Mar 31, 2020 - Apr 30, 2020</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="nsm-table">
                                            <thead>
                                                <tr>
                                                    <td>Metric</td>
                                                    <td>Feb '20</td>
                                                    <td>Mar '20</td>
                                                    <td>Apr '20</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Your deal viewed</label>
                                                        <label class="default content-subtitle fst-italic d-block">How many times your deal has been viewed by customers</label>
                                                    </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="default d-block fw-bold">Your deal shown on homepage / search</label>
                                                        <label class="default content-subtitle fst-italic d-block">How many times your deal has been shown to customers on home page and in search results</label>
                                                    </td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Employee">EMPLOYEE</td>
                            <td data-name="Created By">ROLE</td>
                            <td data-name="Last Modified">START DATE</td>
                            <td data-name="Report Period">LOCATION</td>
                            <td data-name="Report Period">SALARY</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>