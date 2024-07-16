<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="nsm-callout primary"><button><i class="bx bx-x"></i></button><?php echo $page->description ?></div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="nsm-card primary">
                        <div class="nsm-card-header">
                            <div class="col-lg-12">
                                <span class="float-start">
                                    <button class="nsm-button addNotes">Add Notes</button>
                                </span>
                                <span class="float-end">
                                    <button data-bs-toggle="modal" data-bs-target="#emailReportModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-envelope icon-top"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#printPreviewModal" class="nsm-button border-0 top-button"><i class="bx bx-fw bx-printer icon-top"></i></button>
                                    <button class="nsm-button border-0 top-button" data-bs-toggle="dropdown"><i class="bx bx-fw bx-export icon-top"></i></button>
                                    <ul class="dropdown-menu dropdown-menu-end export-dropdown" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToXLSX">Export to Excel</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" id="exportToPDF" download>Export to PDF</a></li>
                                    </ul>
                                    <button class="nsm-button border-0 primary top-button" data-bs-toggle="modal" data-bs-target="#reportSettings"><i class="bx bx-fw bx-cog icon-top"></i></button>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mb-4">
                                <div class="col-lg-12 headerInfo">
                                    <img id="businessLogo" class="<?php echo ($reportSettings->show_logo == 0 || !isset($reportSettings->show_logo)) ? 'd-none-custom' : ''; ?>" src="<?php echo base_url("uploads/users/business_profile/") . "$companyInfo->id/$companyInfo->business_image"; ?>">
                                    <div class="reportTitleInfo">
                                        <h3 id="businessName"><?php echo ($reportSettings->company_name) ? $reportSettings->company_name : strtoupper($companyInfo->business_name) ?></h3>
                                        <h5><strong id="reportName"><?php echo $reportSettings->title ?></strong></h5>
                                        <h5><small id="report_date_text">As of <?php echo date('F d, Y'); ?></small></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <?php
                                    $tableID = "balanceSheetDetails_table";
                                    $reportCategory = "balance_sheet_details";
                                    ?>
                                    <table class="nsm-table balance-sheet-details-table" id="tableID">
                                        <thead>
                                            <tr>
                                                <td data-name="Date">DATE</td>
                                                <td data-name="Transaction Type">TRANSACTION TYPE</td>
                                                <td data-name="Num">NUM</td>
                                                <td data-name="Name">NAME</td>
                                                <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                                                <td data-name="Split">SPLIT</td>
                                                <td data-name="Debit">DEBIT</td>
                                                <td data-name="Credit">CREDIT</td>
                                                <td data-name="Amount">AMOUNT</td>
                                                <td data-name="Balance">BALANCE</td>
                                            </tr>
                                        </thead>
                                        <tbody id="reportTable">
                                            <!-- ASSETS -->
                                            <tr data-bs-toggle="collapse" data-bs-target="#assets" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> ASSETS</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>$22,544.77</td>
                                                <td>$1,404,676.97</td>
                                            </tr>
                                            <tr id="assets" class="collapse">
                                                <td colspan="10">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr data-bs-toggle="collapse" data-bs-target="#checking" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Checking</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="checking" class="collapse">
                                                                <td colspan="10">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Beginning balance</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>2,764,285.27</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Payment </td>
                                                                                <td>6194 </td>
                                                                                <td>Abrams, Christine</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$79.99</td>
                                                                                <td></td>
                                                                                <td>79.99</td>
                                                                                <td>2,764,365.26</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Brannon Nguyen </td>
                                                                                <td></td>
                                                                                <td>Commission </td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,763,865.26</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Kyle Nguyen</td>
                                                                                <td>Reimburstment</td>
                                                                                <td></td>
                                                                                <td>$500.00 </td>
                                                                                <td>-500.00</td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Tyler Nguyen</td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,762,865.26</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments </td>
                                                                                <td>System-recorded fee for QuickBooks Payments. Fee-name: MonthlyServiceFee, fee-type: Card.</td>
                                                                                <td>QuickBooks Payments Fees-1 </td>
                                                                                <td></td>
                                                                                <td>$19.95</td>
                                                                                <td>-19.95</td>
                                                                                <td>2,762,845.31</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments </td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily.</td>
                                                                                <td>QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$103.80</td>
                                                                                <td>103.80</td>
                                                                                <td>2,762,741.51</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments</td>
                                                                                <td>-Split-</td>
                                                                                <td>$3,412.49</td>
                                                                                <td></td>
                                                                                <td>3,412.49</td>
                                                                                <td>2,766,154.00</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$575.98</td>
                                                                                <td></td>
                                                                                <td>575.98</td>
                                                                                <td>2,766,729.98</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI </td>
                                                                                <td>$327.86 </td>
                                                                                <td></td>
                                                                                <td>327.86</td>
                                                                                <td>2,767,057.84</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI </td>
                                                                                <td>$283.36</td>
                                                                                <td></td>
                                                                                <td>283.36</td>
                                                                                <td>2,767,341.20</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Payment</td>
                                                                                <td>1030</td>
                                                                                <td>Robinson, Perry </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$1,128.72</td>
                                                                                <td></td>
                                                                                <td>1,128.72</td>
                                                                                <td>2,768,469.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Mike Bell Jr</td>
                                                                                <td></td>
                                                                                <td>License </td>
                                                                                <td></td>
                                                                                <td>$300.00</td>
                                                                                <td>-300.00 </td>
                                                                                <td>2,768,169.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Kyle Nguyen</td>
                                                                                <td></td>
                                                                                <td>Reimburstment</td>
                                                                                <td></td>
                                                                                <td>$300.00</td>
                                                                                <td>-300.00</td>
                                                                                <td>2,767,869.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Sandra Nguyen </td>
                                                                                <td></td>
                                                                                <td>Rental Reimbursement</td>
                                                                                <td></td>
                                                                                <td>$2,000.00 </td>
                                                                                <td>-2,000.00</td>
                                                                                <td>2,765,869.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Sandra Nguyen</td>
                                                                                <td></td>
                                                                                <td>Reimburstment</td>
                                                                                <td></td>
                                                                                <td>$2,000.00</td>
                                                                                <td>-2,000.00</td>
                                                                                <td>2,763,869.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td>5684</td>
                                                                                <td>IP</td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,763,369.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Josh Pemberton </td>
                                                                                <td></td>
                                                                                <td>License</td>
                                                                                <td></td>
                                                                                <td>$600.00 </td>
                                                                                <td>-600.00</td>
                                                                                <td>2,762,769.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td>5685</td>
                                                                                <td>IP</td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00 </td>
                                                                                <td>2,762,269.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Linda DeBolt</td>
                                                                                <td></td>
                                                                                <td>Reimburstment</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,761,769.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>TC Nguyen</td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,761,269.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Linda DeBolt </td>
                                                                                <td></td>
                                                                                <td>Reimburstment</td>
                                                                                <td>$0.00 </td>
                                                                                <td></td>
                                                                                <td>0.00</td>
                                                                                <td>2,760,769.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td>5686</td>
                                                                                <td>IP </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,760,269.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Lauren Williams </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td>$0.00</td>
                                                                                <td></td>
                                                                                <td>0.00</td>
                                                                                <td>2,760,269.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Payment</td>
                                                                                <td>19652306220</td>
                                                                                <td>Jordan, Sonora</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$49.99</td>
                                                                                <td></td>
                                                                                <td>49.99</td>
                                                                                <td>2,760,319.91</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/01/2024 </td>
                                                                                <td>Payment</td>
                                                                                <td>2622</td>
                                                                                <td>Welcome, Mamie</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable </td>
                                                                                <td>$56.91</td>
                                                                                <td></td>
                                                                                <td>56.91</td>
                                                                                <td>2,760,376.82</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$125.00</td>
                                                                                <td></td>
                                                                                <td>125.00</td>
                                                                                <td>2,760,501.82</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments</td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily. </td>
                                                                                <td>QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$8.04</td>
                                                                                <td>-8.04</td>
                                                                                <td>2,760,493.78</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$1,188.63</td>
                                                                                <td></td>
                                                                                <td>1,188.63</td>
                                                                                <td>2,761,682.41</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>-Split-</td>
                                                                                <td>$239.35</td>
                                                                                <td></td>
                                                                                <td>239.35</td>
                                                                                <td>2,761,921.76</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>13653</td>
                                                                                <td> Lucio Orfanello e</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivabl</td>
                                                                                <td>$222.49</td>
                                                                                <td></td>
                                                                                <td>222.49</td>
                                                                                <td>2,762,144.25</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>13653</td>
                                                                                <td> Scott's Marine </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$206.67</td>
                                                                                <td></td>
                                                                                <td>206.67</td>
                                                                                <td>2,762,350.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>13653</td>
                                                                                <td> Orfanello, Lucio </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$161.22</td>
                                                                                <td></td>
                                                                                <td>161.22</td>
                                                                                <td>2,762,512.14</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>996811</td>
                                                                                <td> Alboniga, Mario </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$86.99</td>
                                                                                <td></td>
                                                                                <td>86.99</td>
                                                                                <td>2,762,599.13</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>6728</td>
                                                                                <td> Flintroy, Herman </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$53.99</td>
                                                                                <td></td>
                                                                                <td>53.99</td>
                                                                                <td>2,762,653.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>995229</td>
                                                                                <td> Citizens Moving Forward </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$49.99</td>
                                                                                <td></td>
                                                                                <td>49.99</td>
                                                                                <td>2,762,703.11</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/02/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>52113004</td>
                                                                                <td> Arnold, Sally </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$45.34</td>
                                                                                <td></td>
                                                                                <td>45.34</td>
                                                                                <td>2,762,748.45</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$1,013.58</td>
                                                                                <td></td>
                                                                                <td>1,013.58</td>
                                                                                <td>2,763,762.03</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$2,803.89</td>
                                                                                <td></td>
                                                                                <td>2,803.89</td>
                                                                                <td>2,766,565.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments</td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily. </td>
                                                                                <td>QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$8.63</td>
                                                                                <td>-8.63</td>
                                                                                <td>2,766,557.29</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>CASH</td>
                                                                                <td></td>
                                                                                <td> Reimbursements/Bkcd Charge:ACH Settlement</td>
                                                                                <td></td>
                                                                                <td>$125.00</td>
                                                                                <td>-125.00</td>
                                                                                <td>2,766,432.29</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>-Split-</td>
                                                                                <td>$249.97</td>
                                                                                <td></td>
                                                                                <td>249.97</td>
                                                                                <td>2,766,682.26</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$909.76</td>
                                                                                <td></td>
                                                                                <td>909.76</td>
                                                                                <td>2,767,592.02</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Payment</td>
                                                                                <td></td>
                                                                                <td>Rivers, Claudia</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$49.99</td>
                                                                                <td></td>
                                                                                <td>49.99</td>
                                                                                <td>2,767,642.01</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>997550</td>
                                                                                <td>Beavers, Sandra</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$49.91</td>
                                                                                <td></td>
                                                                                <td>49.91</td>
                                                                                <td>2,767,691.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/03/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>215623938</td>
                                                                                <td>Simmons, Ronald</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$59.91</td>
                                                                                <td></td>
                                                                                <td>59.91</td>
                                                                                <td>2,767,751.83</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/04/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>-Split-</td>
                                                                                <td>$671.74</td>
                                                                                <td></td>
                                                                                <td>671.74</td>
                                                                                <td>2,768,423.57</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/04/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments</td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily. </td>
                                                                                <td>QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$21.66</td>
                                                                                <td>-21.66</td>
                                                                                <td>2,768,401.91</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments</td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily. </td>
                                                                                <td>QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$25.47</td>
                                                                                <td>-25.47</td>
                                                                                <td>2,768,376.44</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$2,433.35</td>
                                                                                <td></td>
                                                                                <td>2,433.35</td>
                                                                                <td>2,770,809.79</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>-Split-</td>
                                                                                <td>$1,001.94</td>
                                                                                <td></td>
                                                                                <td>1,001.94</td>
                                                                                <td>2,771,811.73</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$324.33</td>
                                                                                <td></td>
                                                                                <td>324.33</td>
                                                                                <td>2,772,136.06</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$136.38</td>
                                                                                <td></td>
                                                                                <td>136.38</td>
                                                                                <td>2,772,272.44</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Payment</td>
                                                                                <td></td>
                                                                                <td>Hammond, Emory </td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$53.49</td>
                                                                                <td></td>
                                                                                <td>53.49</td>
                                                                                <td>2,772,325.93</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Payment</td>
                                                                                <td></td>
                                                                                <td>Goff, Dorothy</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$49.99</td>
                                                                                <td></td>
                                                                                <td>49.99</td>
                                                                                <td>2,772,375.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/05/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>Regions</td>
                                                                                <td></td>
                                                                                <td> Reimbursements/Bkcd Charge:ACH Settlement</td>
                                                                                <td></td>
                                                                                <td>$3.00</td>
                                                                                <td>-3.00</td>
                                                                                <td>2,772,372.92</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>14261</td>
                                                                                <td>90 Works (Panama City)</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$53.99</td>
                                                                                <td></td>
                                                                                <td>53.99</td>
                                                                                <td>2,772,426.91</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>14260</td>
                                                                                <td> 90 Works (Pensacola)</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$62.99</td>
                                                                                <td></td>
                                                                                <td>62.99</td>
                                                                                <td>2,772,489.90</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>1047</td>
                                                                                <td>Butler, Earlean</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$102.11</td>
                                                                                <td></td>
                                                                                <td>102.11</td>
                                                                                <td>2,772,592.01</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>4769</td>
                                                                                <td>Fleming, Jane & Ed</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$194.97</td>
                                                                                <td></td>
                                                                                <td>194.97</td>
                                                                                <td>2,772,786.98</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>11714</td>
                                                                                <td>First Assembly of God</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$199.97</td>
                                                                                <td></td>
                                                                                <td>199.97</td>
                                                                                <td>2,772,986.95</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>121128</td>
                                                                                <td> Watson, Robbie:Watson, Robbie & Kim</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$379.59</td>
                                                                                <td></td>
                                                                                <td>379.59</td>
                                                                                <td>2,773,366.54</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>3333569</td>
                                                                                <td>Fitcher, Robert </td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$49.99</td>
                                                                                <td></td>
                                                                                <td>49.99</td>
                                                                                <td>2,773,416.53</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>6491</td>
                                                                                <td>Ebel, Dennis</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$53.92</td>
                                                                                <td></td>
                                                                                <td>53.92</td>
                                                                                <td>2,773,470.45</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>1067</td>
                                                                                <td>Lewis, Richard </td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$44.99</td>
                                                                                <td></td>
                                                                                <td>44.99</td>
                                                                                <td>2,773,515.44</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>1283</td>
                                                                                <td>Petroutson, Cindy</td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$49.91</td>
                                                                                <td></td>
                                                                                <td>49.91</td>
                                                                                <td>2,773,565.35</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>7938</td>
                                                                                <td> Sims, Joyce</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$49.91</td>
                                                                                <td></td>
                                                                                <td>49.91</td>
                                                                                <td>2,773,615.26</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/06/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>12108</td>
                                                                                <td> Salter, Carl & Katie</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$39.91</td>
                                                                                <td></td>
                                                                                <td>39.91</td>
                                                                                <td>2,773,655.17</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/07/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments</td>
                                                                                <td> -Split-</td>
                                                                                <td>$116.98</td>
                                                                                <td></td>
                                                                                <td>116.98</td>
                                                                                <td>2,773,772.15</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/07/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments</td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily.</td>
                                                                                <td> QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$2.22</td>
                                                                                <td>-2.22</td>
                                                                                <td>2,773,769.93</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td></td>
                                                                                <td>Preston, Robert</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$69.54</td>
                                                                                <td></td>
                                                                                <td>69.54</td>
                                                                                <td>2,773,839.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td>5687</td>
                                                                                <td> IP</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,773,339.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td>5688</td>
                                                                                <td> IP</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,772,839.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td>5689</td>
                                                                                <td> IP</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,772,339.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>TC Nguyen </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,771,839.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Brannon Nguyen</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,771,339.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Kyle Nguyen</td>
                                                                                <td></td>
                                                                                <td> Reimburstment</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,770,839.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Tyler Nguyen</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,770,339.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Kyle Nguyen</td>
                                                                                <td></td>
                                                                                <td> Reimburstment</td>
                                                                                <td></td>
                                                                                <td>$300.00</td>
                                                                                <td>-300.00</td>
                                                                                <td>2,770,039.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Lauren Williams</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td>$0.00</td>
                                                                                <td></td>
                                                                                <td>0.00</td>
                                                                                <td>2,770,039.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Lauren Williams</td>
                                                                                <td></td>
                                                                                <td> Commission</td>
                                                                                <td></td>
                                                                                <td>$0.00</td>
                                                                                <td>0.00</td>
                                                                                <td>2,770,039.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>9055</td>
                                                                                <td> Parker, Shelby</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$35.00</td>
                                                                                <td></td>
                                                                                <td>35.00</td>
                                                                                <td>2,770,074.47</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>4847</td>
                                                                                <td> Steudlein, Wanda</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$37.41</td>
                                                                                <td></td>
                                                                                <td>37.41</td>
                                                                                <td>2,770,111.88</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>22067937698</td>
                                                                                <td> Byrd, Costella</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$48.00</td>
                                                                                <td></td>
                                                                                <td>48.00</td>
                                                                                <td>2,770,159.88</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>7461</td>
                                                                                <td>Maddox, John </td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$49.97</td>
                                                                                <td></td>
                                                                                <td>49.97</td>
                                                                                <td>2,770,209.85</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>40491 </td>
                                                                                <td>Planet Fitness (Fairhope) </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$53.99</td>
                                                                                <td></td>
                                                                                <td>53.99</td>
                                                                                <td>2,770,263.84</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>995809</td>
                                                                                <td>Robinson, Perry </td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$60.00</td>
                                                                                <td></td>
                                                                                <td>60.00</td>
                                                                                <td>2,770,323.84</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>5038 </td>
                                                                                <td>Christian Service Center </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$149.97</td>
                                                                                <td></td>
                                                                                <td>149.97</td>
                                                                                <td>2,770,473.81</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$54.93</td>
                                                                                <td></td>
                                                                                <td>54.93</td>
                                                                                <td>2,770,528.74</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$99.47</td>
                                                                                <td></td>
                                                                                <td>99.47</td>
                                                                                <td>2,770,628.21</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$311.80</td>
                                                                                <td></td>
                                                                                <td>311.80</td>
                                                                                <td>2,770,940.01</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$614.05</td>
                                                                                <td></td>
                                                                                <td>614.05</td>
                                                                                <td>2,771,554.06</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments</td>
                                                                                <td> -Split-</td>
                                                                                <td>$888.56</td>
                                                                                <td></td>
                                                                                <td>888.56</td>
                                                                                <td>2,772,442.62</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$1,282.14</td>
                                                                                <td></td>
                                                                                <td>1,282.14</td>
                                                                                <td>2,773,724.76</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>Gateway Services </td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments Fees</td>
                                                                                <td></td>
                                                                                <td>$70.32</td>
                                                                                <td>-70.32</td>
                                                                                <td>2,773,654.44</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments </td>
                                                                                <td>System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily.</td>
                                                                                <td> QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$28.06</td>
                                                                                <td>-28.06</td>
                                                                                <td>2,773,626.38</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/08/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>Regions </td>
                                                                                <td></td>
                                                                                <td>Reimbursements/Bkcd Charge:ACH Settlement</td>
                                                                                <td>$3.00</td>
                                                                                <td></td>
                                                                                <td>-3.00</td>
                                                                                <td>2,773,623.38</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments </td>
                                                                                <td>System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily. </td>
                                                                                <td>QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$6.55</td>
                                                                                <td>-6.55</td>
                                                                                <td>2,773,616.83</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$90,000.00</td>
                                                                                <td></td>
                                                                                <td>90,000.00</td>
                                                                                <td>2,863,616.83</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td>George, Kay </td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$632.50</td>
                                                                                <td></td>
                                                                                <td>632.50</td>
                                                                                <td>2,864,249.33</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>ACH Settlement / NMI</td>
                                                                                <td>$484.25</td>
                                                                                <td></td>
                                                                                <td>484.25</td>
                                                                                <td>2,864,733.58</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$259.28</td>
                                                                                <td></td>
                                                                                <td>259.28</td>
                                                                                <td>2,864,992.86</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td>Grillot, Edwin</td>
                                                                                <td> System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>Undeposited Funds</td>
                                                                                <td>$199.96</td>
                                                                                <td></td>
                                                                                <td>199.96</td>
                                                                                <td>2,865,192.82</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/09/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$74.37</td>
                                                                                <td></td>
                                                                                <td>74.37</td>
                                                                                <td>2,865,267.19</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments</td>
                                                                                <td> System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily.</td>
                                                                                <td> QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$44.61</td>
                                                                                <td>-44.61</td>
                                                                                <td>2,865,222.58</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$30.85</td>
                                                                                <td></td>
                                                                                <td>30.85</td>
                                                                                <td>2,865,253.43</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$47.42</td>
                                                                                <td></td>
                                                                                <td>47.42</td>
                                                                                <td>2,865,300.85</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$167.97</td>
                                                                                <td></td>
                                                                                <td>167.97</td>
                                                                                <td>2,865,468.82</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>-Split-</td>
                                                                                <td>$1,494.32</td>
                                                                                <td></td>
                                                                                <td>1,494.32</td>
                                                                                <td>2,866,963.14</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$2,872.76</td>
                                                                                <td></td>
                                                                                <td>2,872.76</td>
                                                                                <td>2,869,835.90</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/10/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>CASH </td>
                                                                                <td></td>
                                                                                <td>Reimbursements/Bkcd Charge:ACH Settlement</td>
                                                                                <td></td>
                                                                                <td>$51.99</td>
                                                                                <td>-51.99</td>
                                                                                <td>2,869,783.91</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$217.86</td>
                                                                                <td></td>
                                                                                <td>217.86</td>
                                                                                <td>2,870,001.77</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$314.01</td>
                                                                                <td></td>
                                                                                <td>314.01</td>
                                                                                <td>2,870,315.78</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>CASH </td>
                                                                                <td></td>
                                                                                <td>Reimbursements/Bkcd Charge:ACH Settlement</td>
                                                                                <td></td>
                                                                                <td>$65.34</td>
                                                                                <td>-65.34</td>
                                                                                <td>2,870,250.44</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>6604</td>
                                                                                <td> Sims, Annette </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$46.97</td>
                                                                                <td></td>
                                                                                <td>46.97</td>
                                                                                <td>2,870,297.41</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>14477 </td>
                                                                                <td>Johnson, Debra </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$49.91</td>
                                                                                <td></td>
                                                                                <td>49.91</td>
                                                                                <td>2,870,347.32</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>422</td>
                                                                                <td>Robert W Johnson </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$53.99</td>
                                                                                <td></td>
                                                                                <td>53.99</td>
                                                                                <td>2,870,401.31</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>10712 </td>
                                                                                <td>Riley, Bernadette & John </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$59.41</td>
                                                                                <td></td>
                                                                                <td>59.41</td>
                                                                                <td>2,870,460.72</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>2325</td>
                                                                                <td>Hall, Linconyer</td>
                                                                                <td></td>
                                                                                <td> Accounts Receivable</td>
                                                                                <td>$103.73</td>
                                                                                <td></td>
                                                                                <td>103.73</td>
                                                                                <td>2,870,564.45</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/11/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$82.55</td>
                                                                                <td></td>
                                                                                <td>82.55</td>
                                                                                <td>2,870,647.00</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>System-recorded deposit for QuickBooks Payments </td>
                                                                                <td>-Split-</td>
                                                                                <td>$157.94</td>
                                                                                <td></td>
                                                                                <td>157.94</td>
                                                                                <td>2,870,804.94</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>Gateway Services </td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments Fees</td>
                                                                                <td></td>
                                                                                <td>$50.60</td>
                                                                                <td>-50.60</td>
                                                                                <td>2,870,754.34</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Expense</td>
                                                                                <td></td>
                                                                                <td>QuickBooks Payments </td>
                                                                                <td>System-recorded fee for QuickBooks Payments. Fee-name: DiscountRateFee, fee-type: Daily.</td>
                                                                                <td> QuickBooks Payments Fees-1</td>
                                                                                <td></td>
                                                                                <td>$5.72</td>
                                                                                <td>-5.72</td>
                                                                                <td>2,870,748.62</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>4447 </td>
                                                                                <td>Smith, Tony </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$21.99</td>
                                                                                <td></td>
                                                                                <td>21.99</td>
                                                                                <td>2,870,770.61</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>9084 </td>
                                                                                <td>Northrup, Doris </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$44.91</td>
                                                                                <td></td>
                                                                                <td>44.91</td>
                                                                                <td>2,870,815.52</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>52915664 </td>
                                                                                <td>Leedy, Fredric </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$47.99</td>
                                                                                <td></td>
                                                                                <td>47.99</td>
                                                                                <td>2,870,863.51</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>7833599 </td>
                                                                                <td>Bolden, Tameka </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$49.91</td>
                                                                                <td></td>
                                                                                <td>49.91</td>
                                                                                <td>2,870,913.42</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Payment</td>
                                                                                <td>471 </td>
                                                                                <td>Grosse, Ramona </td>
                                                                                <td></td>
                                                                                <td>Accounts Receivable</td>
                                                                                <td>$80.34</td>
                                                                                <td></td>
                                                                                <td>80.34</td>
                                                                                <td>2,870,993.76</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/12/2024</td>
                                                                                <td>Deposit</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>Sales</td>
                                                                                <td>$725.36</td>
                                                                                <td></td>
                                                                                <td>725.36</td>
                                                                                <td>2,871,719.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Brannon Nguyen </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,871,219.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td>5690 </td>
                                                                                <td>IP </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,870,719.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td>5691 </td>
                                                                                <td>IP </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,870,719.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td>5692 </td>
                                                                                <td>IP </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,870,719.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>TC Nguyen </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,869,219.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Kyle Nguyen </td>
                                                                                <td></td>
                                                                                <td>Reimbursement</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,868,719.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Tyler Nguyen </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td></td>
                                                                                <td>$500.00</td>
                                                                                <td>-500.00</td>
                                                                                <td>2,868,219.12
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Kyle Nguyen </td>
                                                                                <td></td>
                                                                                <td>Reimbursement</td>
                                                                                <td></td>
                                                                                <td>$300.00</td>
                                                                                <td>-300.00</td>
                                                                                <td>2,867,919.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>07/15/2024</td>
                                                                                <td>Check</td>
                                                                                <td></td>
                                                                                <td>Lauren Williams </td>
                                                                                <td></td>
                                                                                <td>Commission</td>
                                                                                <td>$0.00</td>
                                                                                <td></td>
                                                                                <td>0.00</td>
                                                                                <td>2,867,919.12</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Total for Checking</b></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td><b>$103,633.85</b></td>
                                                                                <td></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&emsp;<b>TOTAL ASSETS</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>$22,544.77</td>
                                                                <td>$1,404,676.97</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- LIABILITIES AND EQUITY -->
                                            <tr data-bs-toggle="collapse" data-bs-target="#liabilitiesEquity" class="clickable collapse-row collapsed">
                                                <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>$1,922,289.76</td>
                                                <td>$1,404,676.97</td>
                                            </tr>
                                            <tr id="liabilitiesEquity" class="collapse">
                                                <td colspan="10">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <!-- Liabilities -->
                                                            <tr data-bs-toggle="collapse" data-bs-target="#liabilities" class="clickable collapse-row collapsed">
                                                                <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Liabilities</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr id="liabilities" class="collapse">
                                                                <td colspan="10">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Accounts Payable</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>$10,000.00</td>
                                                                                <td>$15,000.00</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Short-term Loans</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>$5,000.00</td>
                                                                                <td>$7,000.00</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&emsp;<b>TOTAL LIABILITIES</b></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td>$15,000.00</td>
                                                                                <td>$22,000.00</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>&emsp;<b>TOTAL LIABILITIES AND EQUITY</b></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>$1,922,289.76</td>
                                                                <td>$1,404,676.97</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <span id="notesContent" class="text-muted">Loading Notes...</span>
                                    <form id="addNotesForm" method="POST" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-12 mt-1 mb-3">
                                                <div class="form-group">
                                                    <textarea id="NOTES" class="form-control" maxlength="4000"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="float-start noteCharMax">
                                                    4000 characters max
                                                </div>
                                                <div class="float-end">
                                                    <button type="button" id="cancelNotes" class="nsm-button">Cancel</button>
                                                    <button type="submit" class="nsm-button primary noteSaveButton">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                            $footer_css = '';
                            if ($reportSettings) {
                                if ($reportSettings->footer_align == 'C') {
                                    $footer_css = 'text-align:center;';
                                } elseif ($reportSettings->footer_align == 'L') {
                                    $footer_css = 'text-align:left;';
                                } elseif ($reportSettings->footer_align == 'R') {
                                    $footer_css = 'text-align:right;';
                                }
                            }
                            ?>
                            <div class="row footerInfo" style="<?= $footer_css; ?>">
                                <span class=""><?php echo date("l, F j, Y h:i A eP") ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>

<!-- START: PRINT/SAVE MODAL -->
<div class="modal fade" id="printPreviewModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 mt-1 mb-3">
                        <h6>Report print settings</h6>
                        <hr>
                        <div class="form-group mb-2">
                            <label>Orientation</label>
                            <select id="pageOrientation" name="pageOrientation" class="form-select">
                                <option value="p" selected>Portrait</option>
                                <option value="l">Landscape</option>
                            </select>
                        </div>
                        <!-- <div class="form-check">
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
                        </div> -->
                    </div>
                    <div class="col-sm-9">
                        <iframe id="pdfPreview" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="float-end">
                            <button type="button" class="nsm-button primary savePDF">Save as PDF</button>
                            <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal fade" id="emailReportModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="sendEmailForm">
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="emailTo" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <!-- <input id="emailSubject" class="form-control" type="text" value="<?php echo $companyInfo ? strtoupper($companyInfo->business_name) : ''; ?>: <?php echo $page->title; ?>" required> -->
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $page->title; ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="input-group borderRadius0 pdfAttachment">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox"></div>
                                        <input id="pdfReportFilename" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                    </div>
                                    <div class="input-group borderRadius0">
                                        <div class="input-group-text"><input class="form-check-input mt-0 xlsxAttachmentCheckbox" type="checkbox"></div>
                                        <input id="xlsxReportFileName" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".xlsx" style="max-width: 60px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="emailCloseModal" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary sendEmail"><span class="sendEmail_Loader"></span>Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: EMAIL REPORT MODAL -->
<!-- Modal for Report Settings -->
<div class="modal fade" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Company Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" checked></div>
                                        <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?= $reportSettings && $reportSettings->company_name != '' ? $reportSettings->company_name : $companyInfo->business_name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : 'Balance Sheet Details'; ?>" required>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="filter-date">Date</label>
                                    <div class="">
                                        <input type="date" name="date" id="report-date" class="form-control nsm-field date" value="<?= $reportSettings && $reportSettings->report_date_text != '' ? date("Y-m-d", strtotime($reportSettings->report_date_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div> -->
                                <div class="col-md-4 mb-3">
                                    <label for="filter-date">Date</label>
                                    <div class="">
                                        <input type="date" id="filter-date" class="form-control nsm-field date" value="<?= $reportSettings && $reportSettings->report_date_text != '' ? date("Y-m-d", strtotime($reportSettings->report_date_text)) : date("Y-m-d"); ?>" data-type="filter-date">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <option value="1" <?= $reportSettings && $reportSettings->show_logo == 1 ? 'selected="selected"' : ''; ?> selected>Show</option>
                                        <option value="0" <?= $reportSettings && $reportSettings->show_logo == 0 ? 'selected="selected"' : ''; ?>>Hide</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="C" <?= $reportSettings && $reportSettings->header_align == 'C' ? 'selected="selected"' : ''; ?>>Center</option>
                                        <option value="L" <?= $reportSettings && $reportSettings->header_align == 'L' ? 'selected="selected"' : ''; ?>>Left</option>
                                        <option value="R" <?= $reportSettings && $reportSettings->header_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="C" <?= $reportSettings && $reportSettings->footer_align == 'C' ? 'selected="selected"' : ''; ?>>Center</option>
                                        <option value="L" <?= $reportSettings && $reportSettings->footer_align == 'L' ? 'selected="selected"' : ''; ?>>Left</option>
                                        <option value="R" <?= $reportSettings && $reportSettings->footer_align == 'R' ? 'selected="selected"' : ''; ?>>Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Page Size</label>
                                    <select name="page_size" id="page-size" class="nsm-field form-select">
                                        <option value="10" <?= $reportSettings && $reportSettings->page_size == 10 ? 'selected="selected"' : ''; ?>>10</option>
                                        <option value="25" <?= $reportSettings && $reportSettings->page_size == 25 ? 'selected="selected"' : ''; ?>>25</option>
                                        <option value="50" <?= $reportSettings && $reportSettings->page_size == 50 ? 'selected="selected"' : ''; ?>>50</option>
                                        <option value="100" <?= $reportSettings && $reportSettings->page_size == 100 ? 'selected="selected"' : ''; ?>>100</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="date" <?= $reportSettings && $reportSettings->sort_by == 'date' ? 'selected="selected"' : ''; ?>>Date</option>
                                                <option value="transaction-type" <?= $reportSettings && $reportSettings->sort_by == 'transaction-type' ? 'selected="selected"' : ''; ?>>Transaction Type</option>
                                                <option value="num" <?= $reportSettings && $reportSettings->sort_by == 'num' ? 'selected="selected"' : ''; ?>>Num</option>
                                                <option value="name" <?= $reportSettings && $reportSettings->sort_by == 'name' ? 'selected="selected"' : ''; ?>>Name</option>
                                                <option value="memo-description" <?= $reportSettings && $reportSettings->sort_by == 'memo-description' ? 'selected="selected"' : ''; ?>>Memo/Description</option>
                                                <option value="split" <?= $reportSettings && $reportSettings->sort_by == 'split' ? 'selected="selected"' : ''; ?>>Split</option>
                                                <option value="debit" <?= $reportSettings && $reportSettings->sort_by == 'debit' ? 'selected="selected"' : ''; ?>>Debit</option>
                                                <option value="credit" <?= $reportSettings && $reportSettings->sort_by == 'credit' ? 'selected="selected"' : ''; ?>>Credit</option>
                                                <option value="amount" <?= $reportSettings && $reportSettings->sort_by == 'amount' ? 'selected="selected"' : ''; ?>>Amount</option>
                                                <option value="balance" <?= $reportSettings && $reportSettings->sort_by == 'balance' ? 'selected="selected"' : ''; ?>>Balance</option>

                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select" style="margin-left:2px;">
                                                <option value="ASC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'ASC' ? 'selected="selected"' : ''; ?>>ASC</option>
                                                <option value="DESC" <?= $reportSettings && $reportSettings->sort_asc_desc == 'DESC' ? 'selected="selected"' : ''; ?>>DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="mb-1 fw-xnormal">Display Density</label><br />
                                    <input type="checkbox" id="compact_display" name="compact_display" class="form-check-input">
                                    <label for="compact-display" class="form-check-label">Compact</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="mb-1 fw-xnormal">Change Columns</label><br />
                                        <div class="checkbox-grid">
                                            <div class="form-check">
                                                <input type="checkbox" id="date" class="form-check-input">
                                                <label for="date" class="form-check-label">Date</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="create-date" class="form-check-input">
                                                <label for="create-date" class="form-check-label">Create Date</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="last-modified-by" class="form-check-input">
                                                <label for="last-modified-by" class="form-check-label">Last Modified By</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="split" class="form-check-input">
                                                <label for="split" class="form-check-label">Split</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="payment-method" class="form-check-input">
                                                <label for="payment-method" class="form-check-label">Payment Method</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="transaction-type" class="form-check-input">
                                                <label for="transaction-type" class="form-check-label">Transaction Type</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="created-by" class="form-check-input">
                                                <label for="created-by" class="form-check-label">Created By</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="name" class="form-check-input">
                                                <label for="name" class="form-check-label">Name</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="debit" class="form-check-input">
                                                <label for="debit" class="form-check-label">Debit</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="amount" class="form-check-input">
                                                <label for="amount" class="form-check-label">Amount</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="num" class="form-check-input">
                                                <label for="num" class="form-check-label">Num</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="last-modified" class="form-check-input">
                                                <label for="last-modified" class="form-check-label">Last Modified</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="memo-description" class="form-check-input">
                                                <label for="memo-description" class="form-check-label">Memo/Description</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="credit" class="form-check-input">
                                                <label for="credit" class="form-check-label">Credit</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="balance" class="form-check-input">
                                                <label for="balance" class="form-check-label">Balance</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary settingsApplyButton">Apply</button>
                                <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Report Settings -->

<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('accounting/reports/reports_assets/balance_sheet_details_js'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>