<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="<?=base_url('assets/dashboard/css/bootstrap.min.css')?>">
    <style>
        html {
            margin: 15px;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }

        .no-margin {
            margin: 0;
        }

        .no-padding {
            padding: 0;
        }


        .business-logo {
            position: relative;
        }

        .business-logo img {
            display: block;
            width: 100px;
            margin: auto;
            bottom: 0;
            right: 0;
        }

        .business-info h2.business-name {
            font-size: 15px;
            font-weight: 700;

        }

        .business-info p {
            margin: 0;
            font-size: 12px;
        }

        .customer-info h2 {
            font-size: 15px;
            font-weight: 700;
        }

        .receipt-info-section h2 {
            font-size: 35px;
            color: #8C97C0;
            margin: 0;
        }

        .receipt-info-section p {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
        }

        .receipt-info-section p span {
            font-weight: normal;
            padding-left: 10px;
        }

        .customer-info {
            padding-left: 50px;
        }

        .customer-info h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .customer-info p {
            margin: 0;
            font-size: 13px;
        }

        p.note {
            text-align: center;
            text-transform: uppercase;
            margin-top: 30px;
        }

        p.cutter {
            border: dashed 1px #909090;
            margin: 30px 0;
        }

        .amount-summary p {
            margin: 0;
            text-align: left;
            font-size: 14px;
        }

        .amount-summary p.amount {
            text-align: right;
        }

        .amount-summary p.balance-due.amount {
            font-size: 25px;
            font-weight: 500;
        }

        .items-table table {
            width: 100%;
        }

        .items-table table thead tr th:first-child,
        .items-table table tbody tr td:first-child {
            text-align: left;
            width: 50%;
        }

        .items-table table thead tr th,
        .items-table table tbody tr td {
            text-align: right;
        }

        .items-table table thead tr th {
            color: #8D97C0;
        }

        .items-table table thead tr {
            background-color: #E8EAF2;
        }

        .text-left {
            text-align: left;
        }
    </style>

</head>

<body>

    <table style="width: 100%; margin-bottom: 10px; font-size: 10px;">
        <tbody>
            <tr>
                <td style="width:30%"><img src="<?= base_url('assets/frontend/images/sales_tax_return.jpg'); ?>"  style="max-width: 100px" /></td>
                <td style="width:30%;text-align:center;"><h4>Sales and Use Tax Return</h4></td>
                <td style="width:30%;text-align:right;">
                    <p style="font-weight:bold;margin:0px;">DR-15</p>
                    <p style="font-weight:bold;margin:0px;">R. 01/25</p>
                    <p style="font-weight:bold;font-size:12px;margin:0px;">Rule 12A-1.097, F.A.C.</p>
                    <p style="font-weight:bold;font-size:12px;margin:0px;">Page 1 of 2</p>
                </td>            
            </tr>
            
        </tbody>
    </table>

    <table style="width: 100%; margin-bottom: 10px;">
        <tbody>
            <tr>
                <td style="width:60%"></td>
                <td style="width:40%">
                    <p style="font-size:10px;margin-right:29px;float:right;">You may file and pay tax online or you may complete this return and pay tax by check or money order and mail to:</p>
                    <div style="clear:both;"></div>
                    <p style="font-size:12px;margin-right:29px;float:right;">Florida Department 2 of Revenue 5050 W Tennessee StreetTallahassee, FL 32399-0120</p>
                    <div style="clear:both;"></div>
                    <p style="font-size:10px;margin-right:29px;float:right;">Please read the Instructions for DR-15 Sales and Use Tax Returns (Form DR-15N), incorporated by reference in Rule 12A-1.097, F.A.C., before you complete this return. Instructions are posted at <b>floridarevenue.com/forms</b>. </p>
                    <div style="clear:both;"></div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; font-size:10px;">
        <tbody>
            <tr>
                <td style="">Certificate Number:</td>
                <td colspan="2" style="text-align:center;"><b>Sales and Use Tax Return</b></td>
                <td><b>HD/PM Date:            /             /  </b></td>
                <td><b>DR-15 R. 01/25</b></td>
            </tr>
            <tr>
                <td><b>Florida</b></td>
                <td><b>1. Gross Sales</b></td>
                <td><b>2. Exempt Sales</b></td>
                <td><b>3. Taxable Amount</b></td>
                <td><b>4. Tax Due</b></td>
            </tr>
            <tr>
                <td>A. Sales/Services/Electricity</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>B. Taxable Purchases</td>
                <td style="border:rgb(255,109,106) 1px solid; color:rgb(255,109,106);text-align:center;" colspan="2">Include use tax on Internet / out-of-state untaxed purchases</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>C. Commercial Rentals</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>D. Transient Rentals</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>E. Food & Beverages Vending</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style=""></td>
                <td style="">Reporting Period</td>
                <td style="">5. Total Amount of Tax Due</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="">Surtax Rate</td>
                <td style=""></td>
                <td style="">6. Less Lawful Deductions</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td rowspan="4" style="border-right:rgb(255,109,106) 1px solid; color:rgb(255,109,106);text-align:right;">
                    <p>Name : <?= $company->business_name; ?><br />Address : <?= $company->street; ?><br />City/St <?= $company->city . '/' . $company->state; ?><br />Zip</p>
                </td>
                <td style=""></td>
                <td style=""></td>
                <td style="">7. Net tax due</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <!-- <td>&nbsp;</td> -->
                <td style=""></td>
                <td style=""></td>
                <td style="">8. Less Est Tax Pd / DOR Cr Memo</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <!-- <td>&nbsp;</td> -->
                <td style=""></td>
                <td style=""></td>
                <td style="">9. Plus Est Tax Due Current Month</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <!-- <td>&nbsp;</td> -->
                <td style=""></td>
                <td style=""></td>
                <td style="">9. Amount Due</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">FLORIDA DEPARTMENT OF REVENUE </td>
                <!-- <td style=""></td> -->
                <td style=""></td>
                <td style="">11. Less Collection Allowance</td>
                <td style="border:rgb(255,109,106) 1px solid; background-color: rgb(166, 166, 166); text-align:center;"><strong>E-file/E-pay Only</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">5050 W TENNESSEE ST</td>
                <!-- <td style=""></td> -->
                <td style=""></td>
                <td style="">12. Plus Penalty</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">TALLAHASSEE FL 32399-0120</td>
                <!-- <td style=""></td> -->
                <td style=""></td>
                <td style="">13. Plus Interest</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td style=""></td>
                <td style=""></td>
                <td style=""></td>
                <td style="">14. Amount Due With Return</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td style=""><b>Due Date:</b></td>
                <td colspan="4" style="text-align:center;">&nbsp;</td>
            </tr>
            <tr>
                <td style=""><b>Late After:</b></td>
                <td colspan="4" style="text-align:center; font-size:20px; border-top:rgb(255,109,106) 1px solid; border-left:rgb(255,109,106) 1px solid">9100&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;&nbsp;20259999&nbsp;&nbsp;&nbsp;0001003031&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;4999999999&nbsp;&nbsp;&nbsp;0000&nbsp;&nbsp;&nbsp;5</td>
            </tr>  
            <tr>
                <td style="">&nbsp;</td>
                <td colspan="4">&nbsp;</td>
            </tr>

            <tr>
                <td style="font-size:12px;">Certificate Number:</td>
                <td colspan="2" style="text-align:center;"><b>Sales and Use Tax Return</b></td>
                <td><b>HD/PM Date:            /             /  </b></td>
                <td><b>DR-15 R. 01/25</b></td>
            </tr>
            <tr>
                <td><b>Florida</b></td>
                <td><b>1. Gross Sales</b></td>
                <td><b>2. Exempt Sales</b></td>
                <td><b>3. Taxable Amount</b></td>
                <td><b>4. Tax Due</b></td>
            </tr>

            <tr>
                <td>A. Sales/Services/Electricity</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>B. Taxable Purchases</td>
                <td style="border:rgb(255,109,106) 1px solid; color:rgb(255,109,106);text-align:center;" colspan="2">Include use tax on Internet / out-of-state untaxed purchases</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>C. Commercial Rentals</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>D. Transient Rentals</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>E. Food & Beverages Vending</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style=""></td>
                <td style="">Reporting Period</td>
                <td style="">5. Total Amount of Tax Due</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="">Surtax Rate</td>
                <td style=""></td>
                <td style="">6. Less Lawful Deductions</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td rowspan="4" style="border-right:rgb(255,109,106) 1px solid; color:rgb(255,109,106);text-align:right;">
                    <p>Name<br />Address<br />City/St<br />Zip</p>
                </td>
                <td style=""></td>
                <td style=""></td>
                <td style="">7. Net tax due</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <!-- <td>&nbsp;</td> -->
                <td style=""></td>
                <td style=""></td>
                <td style="">8. Less Est Tax Pd / DOR Cr Memo</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <!-- <td>&nbsp;</td> -->
                <td style=""></td>
                <td style=""></td>
                <td style="">9. Plus Est Tax Due Current Month</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <!-- <td>&nbsp;</td> -->
                <td style=""></td>
                <td style=""></td>
                <td style="">9. Amount Due</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">FLORIDA DEPARTMENT OF REVENUE </td>
                <!-- <td style=""></td> -->
                <td style=""></td>
                <td style="">11. Less Collection Allowance</td>
                <td style="border:rgb(255,109,106) 1px solid; background-color: rgb(166, 166, 166); text-align:center;"><strong>E-file/E-pay Only</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">5050 W TENNESSEE ST</td>
                <!-- <td style=""></td> -->
                <td style=""></td>
                <td style="">12. Plus Penalty</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">TALLAHASSEE FL 32399-0120</td>
                <!-- <td style=""></td> -->
                <td style=""></td>
                <td style="">13. Plus Interest</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td style=""></td>
                <td style=""></td>
                <td style=""></td>
                <td style="">14. Amount Due With Return</td>
                <td style="border:rgb(255,109,106) 1px solid"></td>
            </tr>
            <tr>
                <td style=""><b>Due Date:</b></td>
                <td colspan="4" style="text-align:center;">&nbsp;</td>
            </tr>
            <tr>
                <td style=""><b>Late After:</b></td>
                <td colspan="4" style="text-align:center; font-size:20px; border-top:rgb(255,109,106) 1px solid; border-left:rgb(255,109,106) 1px solid">9100&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;&nbsp;20259999&nbsp;&nbsp;&nbsp;0001003031&nbsp;&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;4999999999&nbsp;&nbsp;&nbsp;0000&nbsp;&nbsp;&nbsp;5</td>
            </tr>  
            <tr>
                <td style="">&nbsp;</td>
                <td colspan="4">&nbsp;</td>
            </tr>

        </tbody>
    </table>    

    <br />
    <table style="width: 100%; margin-bottom: 10px; font-size: 10px;">
        <tbody>
            <tr>
                <td style="width:30%">&nbsp;</td>
                <td style="width:30%;text-align:center;">&nbsp;</td>
                <td style="width:30%;text-align:right;">
                    <p style="font-weight:bold;margin:0px;">DR-15</p>
                    <p style="font-weight:bold;margin:0px;">R. 01/25</p>
                    <p style="font-weight:bold;font-size:12px;margin:0px;">Rule 12A-1.097, F.A.C.</p>
                    <p style="font-weight:bold;font-size:12px;margin:0px;">Page 2 of 2</p>
                </td>            
            </tr>
            
        </tbody>
    </table>   

    <p style="font-size: 11px;"><b>File and Pay Online to Receive a Collection Allowance.</b> When you electronically file your tax return and pay timely, you are entitled
to deduct a collection allowance of 2.5% (.025) of the first $1,200 of tax due, not to exceed $30. To pay timely, you must initiate
payment and receive a confirmation number, no later than 5:00 p.m. ET on the business day prior to the 20th. More information on
filing and paying electronically, including a Florida eServices Calendar of Electronic Payment Deadlines (Form DR-659), is available at
<b>floridarevenue.com</b></p>

    <p style="font-size: 11px;">Due Dates. Returns and payments are <b>due on the 1st and late after the 20th day of the month</b> following each reporting period.
<b>A return must be filed for each reporting period, even if no tax is due.</b> If the 20th falls on a Saturday, Sunday, or a state or federal
holiday, returns are timely if postmarked or hand delivered on the first business day following the 20th.
<b>Penalty</b>. If you file your return or pay tax late, a late penalty of 10% of the amount of tax owed, but not less than $50, may be charged.
The $50 minimum penalty applies even if no tax is due. A floating rate of interest also applies to late payments and underpayments of
tax.</p>
    <br /><br />
    
    <table style="width: 100%; margin-bottom: 10px; font-size:10px;">
        <tbody>
            <tr>
                <td colspan="10" style="text-align:center; padding-bottom: 25px;">Under penalties of perjury, I declare that I have read this return and the facts stated in it are true.</td>
            </tr>
            <tr>
                <td style="text-align:center">_____________________________</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">_____________</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">_____________________________</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">_____________</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">Signature of Tax Payer</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">Date</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">Signature of Preparer</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">Date</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">(______)_______________________</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">(______)_______________________</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">Telephone Number</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">Telephone Number</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>
            
        </tbody>
    </table>

    <table style="width: 100%; font-size:10px;">
        <tbody>
            <tr>
                <td colspan="4" style="font-size:25px;">Discretionary Sales Surtax - Lines 15(a) through 15(d)</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; font-size:10px;">
        <tbody style="">
            <tr style="">
                <td style="border-left:rgb(255,109,106) 1px solid; border-top:rgb(255,109,106) 1px solid">15(a).</td>
                <td style="border-top:rgb(255,109,106) 1px solid">Exempt Amount of Items Over $5,000 (included in Column 3) ...................................................................................</td>
                <td style="border-right:rgb(255,109,106) 1px solid; border-top:rgb(255,109,106) 1px solid">15(a). __________________________</td>
            </tr>
            <tr>
                <td style="border-left:rgb(255,109,106) 1px solid">15(b).</td>
                <td style="">Other Taxable Amounts NOT Subject to Surtax (included in Column 3)......................................................................</td>
                <td style="border-right:rgb(255,109,106) 1px solid;">15(b). __________________________</td>
            </tr>
            <tr>
                <td style="border-left:rgb(255,109,106) 1px solid">15(c).</td>
                <td style="">Amounts Subject to Surtax at a Rate Different Than Your County Surtax Rate (included in Column 3)......................</td>
                <td style="border-right:rgb(255,109,106) 1px solid;">15(c). __________________________</td>
            </tr>
            <tr>
                <td style="border-left:rgb(255,109,106) 1px solid; border-bottom:rgb(255,109,106) 1px solid">15(d)</td>
                <td style="border-bottom:rgb(255,109,106) 1px solid"><b>Total Amount of Discretionary Sales Surtax Due</b> (included in Column 4)...............................................................</td>
                <td style="border-right:rgb(255,109,106) 1px solid; border-bottom:rgb(255,109,106) 1px solid">15(d). __________________________</td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; font-size:10px;">
        <tbody>
            <tr>
                <td style="">16.</td>
                <td style=""><b>Florida Tax Credit Scholarship Program Motor Vehicle Sales Tax Credits</b> (included in Line 6)...............................</td>
                <td style="">16. __________________________</td>
            </tr>
            <tr>
                <td style="">17.</td>
                <td style="">Taxable Sales/Untaxed Purchases or Uses of Electricity (included in Line A) ...............................................................</td>
                <td style="">17. __________________________</td>
            </tr>
            <tr>
                <td style="">18.</td>
                <td style="">Taxable Sales/Untaxed Purchases of Dyed Diesel Fuel (included in Line A).................................................................</td>
                <td style="">18. __________________________</td>
            </tr>
            <tr>
                <td style="">19.</td>
                <td style="">Taxable Sales from <b>Amusement Machines</b> (included in Line A) ...................................................................................</td>
                <td style="">19. __________________________</td>
            </tr>
            <tr>
                <td style="">20.</td>
                <td style="">Rural or Urban High Crime Area Job Tax Credits ............................................................................................................</td>
                <td style="">20. __________________________</td>
            </tr>
            <tr>
                <td style="">21.</td>
                <td style="">Other Authorized Credits..................................................................................................................................................</td>
                <td style="">21. __________________________</td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; font-size:10px; margin-bottom: 10px; margin-top: 60px;">
        <tbody>
            <tr>
                <td colspan="10" style="text-align:center; padding-bottom: 25px;">Under penalties of perjury, I declare that I have read this return and the facts stated in it are true.</td>
            </tr>
            <tr>
                <td style="text-align:center">_____________________________</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">_____________</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">_____________________________</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">_____________</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">Signature of Tax Payer</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">Date</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">Signature of Preparer</td>
                <td style="">&nbsp;</td>
                <td style="text-align:center">Date</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">(______)_______________________</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">(______)_______________________</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center">Telephone Number</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="text-align:center">Telephone Number</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td colspan="2" style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>
            <tr>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
                <td style="">&nbsp;</td>
            </tr>
            
        </tbody>
    </table>    

</body>

</html>