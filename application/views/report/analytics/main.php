<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/report'); ?>
    <?php include viewPath('includes/notifications'); ?>
	
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                       <div class="container-fluid">
                        <div class="row">
						    <div class="col-md-10">
                                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

                                <h1>Analytics for <?php echo getLoggedName();?></h1>
                                <div class="row" style="margin-bottom: 40px;">
                                    <div class="col-sm-8 col-md-8">
                                        Insights for your Business. See how your Business performs daily and analyse the trends to optimise it.
                                    </div>
                                    <div class="col-sm-4 col-md-4 text-right">
                                        <a class="margin-right-sec link-modal-open" href="<?php echo base_url() . 'report/main/preview?format=csv&type=summary_report' ?>" target="_blank"><span class="fa fa-download"></span> CSV Export</a>
                                        <a class="link-modal-open" href="<?php echo base_url() . 'report/main/preview?format=pdf&type=summary_report' ?>" target="_blank"><span class="fa fa-file-pdf-o"></span> Get PDF</a>
                                    </div>
                                </div>
                                <ul class="stats">
                                    <li>
                                        <a href="<?php echo base_url() . 'report/main/summary?type=invoices' ?>">
                                            <span class="stats-name">Invoices Total</span>
                                            <span class="stats-value">$10,575.48</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url() . 'report/main/summary?type=estimates' ?>">
                                            <span class="stats-name">Estimates Total</span>
                                            <span class="stats-value">$10,996.24</span>
                                        </a>
                                    </li>
                                        <li>
                                        <a href="https://www.markate.com/pro/track/customers">
                                            <span class="stats-name">Customers Total</span>
                                            <span class="stats-value">381</span>
                                        </a>
                                    </li>
                                        <li>
                                        <a href="https://www.markate.com/pro/promote/deals/main">
                                            <span class="stats-name">Active Deals</span>
                                            <span class="stats-value">0</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="header-top">
                                    <h3>Business Profile</h3>
                                    <div class="avatar">
                                        <img class="user-avatar" src="https://www.markate.com/cdn/20200131/avatar_14356_2efeea8595_xs.jpg">
                                        <div class="avatar-cnt">
                                            ADi<br><a class="a-ter" href="https://www.markate.com/business/adi-0">view public profile</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p class="margin-bottom">Views per day for period: Mar 31, 2020 - Apr 30, 2020</p>
                                <div id="chart-profile" style="text-align: left; width: 100%; height: 300px;"></div>
                                <table class="table table-hover table-to-list fix-reponsive-table">
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            <th class="text-right" style="width: 40px;"></th>
                                            <th class="text-right" style="width: 10%">Feb '20</th>
                                            <th class="text-right" style="width: 10%">Mar '20</th>
                                            <th class="text-right" style="width: 10%">Apr '20</th>
                                            <th class="text-right" style="width: 10%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-title="Metric">
                                                Your business viewed<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">How many times your business has been viewed by customers</p>
                                            </td>
                                            <td class="text-right" data-title="">
                                                <span class="bubble-set bubble-set-0"></span>
                                            </td>
                                            <td class="text-right" data-title="Feb '20">21</td>
                                            <td class="text-right" data-title="Mar '20">15</td>
                                            <td class="text-right" data-title="Apr '20">10</td>
                                            <td class="text-right" data-title="Total">81</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Metric">
                                                Your business shown on homepage / search<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">How many times your business has been shown to customers on home page and in search results</p>
                                            </td>
                                            <td class="text-right" data-title="">
                                                <span class="bubble-set bubble-set-1"></span>
                                            </td>
                                            <td class="text-right" data-title="Feb '20">0</td>
                                            <td class="text-right" data-title="Mar '20">0</td>
                                            <td class="text-right" data-title="Apr '20">0</td>
                                            <td class="text-right" data-title="Total">0</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Metric">
                                                Customers who viewed your contact details<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">How many times customers have seen your contact details</p>
                                            </td>
                                            <td class="text-right" data-title=""></td>
                                            <td class="text-right" data-title="Feb '20">20</td>
                                            <td class="text-right" data-title="Mar '20">15</td>
                                            <td class="text-right" data-title="Apr '20">10</td>
                                            <td class="text-right" data-title="Total">80</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="margin: 40px 0;"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>Job Leads</h3>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <a class="a-ter" href="https://www.markate.com/pro/jobs/search">view job leads</a>
                                    </div>
                                </div>
                                <hr>

                                <p class="margin-bottom">Jobs per day for time period: Mar 31, 2020 - Apr 30, 2020</p>

                                <div id="chart-jobs" style="text-align: left; width: 100%; height: 300px;"></div>
                                <table class="table table-hover table-to-list fix-reponsive-table">
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            <th class="text-right" style="width: 40px;"></th>
                                            <th class="text-right" style="width: 10%">Feb '20</th>
                                            <th class="text-right" style="width: 10%">Mar '20</th>
                                            <th class="text-right" style="width: 10%">Apr '20</th>
                                            <th class="text-right" style="width: 10%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-title="Metric">
                                                Total jobs posted<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">All jobs posted in your coverage areas, that are requesting business services you are offering</p>
                                            </td>
                                            <td class="text-right" data-title="">
                                                <span class="bubble-set bubble-set-0"></span>
                                            </td>
                                            <td class="text-right" data-title="Feb '20">0</td>
                                            <td class="text-right" data-title="Mar '20">0</td>
                                            <td class="text-right" data-title="Apr '20">0</td>
                                            <td class="text-right" data-title="Total">0</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Metric">
                                                Your exclusive job leads<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">The total number of job leads, you have been invited to estimate</p>
                                            </td>
                                            <td class="text-right" data-title="">
                                                <span class="bubble-set bubble-set-1"></span>
                                            </td>
                                            <td class="text-right" data-title="Feb '20">0</td>
                                            <td class="text-right" data-title="Mar '20">0</td>
                                            <td class="text-right" data-title="Apr '20">0</td>
                                            <td class="text-right" data-title="Total">0</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div style="margin: 40px 0;"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>Deals</h3>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <a class="a-ter" href="https://www.markate.com/pro/promote/deals/main">view deals</a>
                                    </div>
                                </div>
                                <hr>

                                <p class="margin-bottom">Views per day for period: Mar 31, 2020 - Apr 30, 2020</p>
                                <div id="chart-deals" style="text-align: left; width: 100%; height: 300px;"></div>
                                <table class="table table-hover table-to-list fix-reponsive-table">
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            <th class="text-right" style="width: 40px;"></th>
                                            <th class="text-right" style="width: 10%">Feb '20</th>
                                            <th class="text-right" style="width: 10%">Mar '20</th>
                                            <th class="text-right" style="width: 10%">Apr '20</th>
                                            <th class="text-right" style="width: 10%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-title="Metric">
                                                Your deal viewed<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">How many times your deal has been viewed by customers</p>
                                            </td>
                                            <td class="text-right" data-title="">
                                                <span class="bubble-set bubble-set-0"></span>
                                            </td>
                                            <td class="text-right" data-title="Feb '20">0</td>
                                            <td class="text-right" data-title="Mar '20">0</td>
                                            <td class="text-right" data-title="Apr '20">0</td>
                                            <td class="text-right" data-title="Total">0</td>
                                        </tr>
                                        <tr>
                                            <td data-title="Metric">
                                                Your deal shown on homepage / search<br>
                                                <p class="help help-sm" style="margin-top: 5px; margin-bottom: 5px;">How many times your deal has been shown to customers on home page and in search results</p>
                                            </td>
                                            <td class="text-right" data-title="">
                                                <span class="bubble-set bubble-set-1"></span>
                                            </td>
                                            <td class="text-right" data-title="Feb '20">0</td>
                                            <td class="text-right" data-title="Mar '20">0</td>
                                            <td class="text-right" data-title="Apr '20">0</td>
                                            <td class="text-right" data-title="Total">0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
