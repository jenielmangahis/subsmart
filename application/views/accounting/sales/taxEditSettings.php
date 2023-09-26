<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
?>
  <!-- dynamic assets goes  -->
  <?php echo put_header_assets(); ?>
    <style type="text/css">
        #signature {
            width: 100%;
            height: 200px;
            border: 1px solid black;
        }

        div#notificationList {
            height: auto !important;
        }

        button.swal2-close {
            display: block !important;
        }

        #topnav {
            font-family: "Ubuntu", "Trebuchet MS", sans-serif !important;
        }

        #division {
            padding: 20px !important;
            margin-right: 2%;
            border: solid black 2px;
        }

        .progress-bar-success {
            background-color: #5cb85c;
        }

        .clock {
            background: url("<?= base_url() ?>/assets/img/timesheet/clock-face-digital-clock-alarm-clocks-clock-png-clip-art.png");
            background-size: cover;
        }

        .progress-bar-info {
            background-color: rgb(0, 166, 164);
        }

        .modaldivision {
            padding: 10px;
            border: solid gray 2px;
            border-radius: 15px;
        }

        .card-pricing.popular {
            z-index: 1;
            border: 3px solid #007bff;
        }

        .card-pricing .list-unstyled li {
            padding: .5rem 0;
            color: #6c757d;
        }

        .file-upload {
            background-color: #ffffff;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            /* width: 100%; */
            margin: 0;
            color: #000;
            background: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            /* text-transform: uppercase; */
            font-weight: 10;
            text-align: left;

        }

        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #EAF3EE;
            position: relative;
            padding: 20px;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #EAF3EE;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        label {
            display: inline-block
        }

        label>input {
            /* HIDE RADIO */
            visibility: hidden;
            /* Makes input not-clickable */
            position: absolute;
            /* Remove input from document flow */
        }

        label>input+img {
            /* IMAGE STYLES */
            cursor: pointer;
            border: 2px solid transparent;
        }

        label>input:checked+img {
            /* (RADIO CHECKED) IMAGE STYLES */
            border: 2px solid #f00;
        }

        #sidebar {
            height: 100% !important;
            bottom: auto;
            margin-bottom: 0px;
        }
        #canvasb
        {
            width:780px;
            height:300px;
        }
        #canvas2b
        {
            width:780px;
            height:300px;
        }
        #canvas3b
        {
            width:780px;
            height:300px;
        }
    @media screen and (max-width:500px){
    #canvasb
    {
        width:360px !important;
    }
    #canvas2b
    {
        width:360px !important;
    }
    #canvas3b
    {
        width:360px !important;
    }
}
  
element.style {
}
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
<div class="wrapper" role="wrapper">
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;"> <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/dashboard'); ?>
    </div>
        <div class="settings">
            <div class="settings__back">
                <a href="<?=url('/accounting/salesTax');?>">
                    <i class="fa fa-chevron-left"></i>
                    Back to sales tax center
                </a>
            </div>

            <div class="settings__header">
                <div class="settings__title">Edit settings</div>
                <div class="d-flex">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="includeInactive">
                        <label class="custom-control-label" for="includeInactive" style="cursor: pointer; font-size: 15px;">Include inactive records</label>
                    </div>

                    <button class="settings__btn d-none">Turn off sales tax</button>
                    <div class="settings__dropdown ml-1 d-none">
                        <button class="settings__btn settings__btn--icon" id="settingsButton">
                            <i class="fa fa-cog"></i>
                        </button>
                        <ul class="settings__dropdownOptions">
                            <li class="settings__dropdownOptionsItem">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="includeInactive">
                                    <label class="custom-control-label" for="includeInactive" style="cursor: pointer; font-size: 15px;">Include inactive</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="settings__spacer"></div>

            <div class="settings__taxAgencies">
                <div class="settings__header settings__header--table">
                    <div class="settings__title settings__title--secondary">Tax agencies</div>
                    <button data-action="addAgency" class="settings__btn">Add agency</button>
                </div>

                <table class="table table-hover settings__table" id="agencyTable">
                    <thead>
                        <tr>
                            <th class="settings__tableHead" scope="col">Agency</th>
                            <th class="settings__tableHead" scope="col">Filling Frequency</th>
                            <th class="settings__tableHead" scope="col">Start Of Tax Period</th>
                            <th class="settings__tableHead" scope="col">Start Date</th>
                            <th class="settings__tableHead" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="settings__spacer"></div>

            <div class="settings__customRates">
                <div class="settings__header settings__header--table">
                    <div class="settings__title settings__title--secondary">Custom rates</div>
                    <div>
                        <button data-action="addRate" class="settings__btn">Add Rate</button>
                    </div>
                </div>

                <table class="table table-hover settings__table" id="rateTable">
                    <thead>
                        <tr>
                            <th class="settings__tableHead" scope="col">Name</th>
                            <th class="settings__tableHead" scope="col">Agency</th>
                            <th class="settings__tableHead" scope="col">Rate</th>
                            <th class="settings__tableHead" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="sidebarForm" id="editAgency">
        <div class="sidebarForm__inner">
            <div class="sidebarForm__header">
                <div class="sidebarForm__title">Florida details</div>
                <button data-action="close" class="sidebarForm__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form>
                <div class="form-group">
                    <label for="editAgency__agency">Agency</label>
                    <input readonly data-type="name" type="text" class="form-control" id="editAgency__agency" placeholder="Select agency">
                </div>

                <div class="form-group">
                    <label for="editAgency__filingFrequency">Filing frequency</label>
                    <select data-type="frequency" class="form-control" id="editAgency__filingFrequency">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="half-yearly">Half-yearly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="editAgency__dateStart">Start Date</label>
                    <input data-type="start_date" type="date" class="form-control" id="editAgency__dateStart" value="January">
                </div>

                <div class="form-group">
                    <label for="editAgency__taxPeriodStart">Start of tax period</label>
                    <input readonly data-type="start_period" type="text" class="form-control" id="editAgency__taxPeriodStart" value="January">
                </div>
            </form>

            <div class="sidebarForm__footer">
                <button id="editAgencyInactiveBtn" type="button" class="settings__btn mr-2">Make inactive</button>
                <button id="editAgencyBtn" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

    <div class="sidebarForm" id="addAgency">
        <div class="sidebarForm__inner">
            <div class="sidebarForm__header">
                <div class="sidebarForm__title">Add Agency</div>
                <button data-action="close" class="sidebarForm__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form>
                <div class="form-group">
                    <label for="addAgency__agency">Agency</label>
                    <div class="dropdownWithSearch" id="agencySelect">
                        <input required data-type="name" type="text" class="form-control dropdownWithSearch__input" id="addAgency__agency" placeholder="Select agency">
                        <button type="button" class="dropdownWithSearch__btn">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addAgency__filingFrequency">Filing frequency</label>
                    <select required data-type="frequency" class="form-control" id="addAgency__filingFrequency">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="half-yearly">Half-yearly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="addAgency__dateStart">Start Date</label>
                    <input required data-type="start_date" type="date" class="form-control" id="addAgency__dateStart">
                </div>
            </form>

            <div class="sidebarForm__footer">
                <button data-action="close" type="button" class="settings__btn mr-2">Cancel</button>
                <button id="addAgencyBtn" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

    <div class="sidebarForm customRate" id="addRate">
        <div class="sidebarForm__inner">
            <div class="sidebarForm__header">
                <div class="sidebarForm__title">Add a custom sales tax rate</div>
                <button data-action="close" class="sidebarForm__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form class="sidebarForm__form">
                <div class="form-group">
                    <div class="form-check">
                        <input data-type="type" class="form-check-input" type="radio" name="rateType" id="addRate__rateType1" value="single" checked>
                        <label class="form-check-label" for="addRate__rateType1">
                            Single
                        </label>
                    </div>
                    <div class="form-check">
                        <input data-type="type" class="form-check-input" type="radio" name="rateType" id="addRate__rateType2" value="combined">
                        <label class="form-check-label" for="addRate__rateType2">
                            Combined
                        </label>
                    </div>
                </div>

                <div id="rateSingleWrapper">
                    <div class="form-group">
                        <label for="addRate__name">Name</label>
                        <input data-type="name" required type="text" class="form-control" id="addRate__name">
                    </div>

                    <div class="form-group">
                        <label for="addRate__agency">Agency</label>
                        <div class="dropdownWithSearch" id="rateAgencySelect">
                            <input required data-type="agency" type="text" class="form-control dropdownWithSearch__input" id="addRate__agency" placeholder="Select agency">
                            <button type="button" class="dropdownWithSearch__btn">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="addRate__rate">Rate</label>
                        <div class="d-flex align-items-center">
                            <input required data-type="rate" type="number" class="form-control" id="addRate__rate">
                            <div class="ml-1" style="font-size: 20px; font-family: inherit;">%</div>
                        </div>
                    </div>
                </div>


                <div id="rateCombinedWrapper">
                    <template>
                        <div class="rateCombined">
                            <div class="rateCombined__header">
                                <div class="rateCombined__title"></div>
                                <button class="rateCombined__btn rateCombined__btn--delete" type="button">
                                    <i class="fa fa-trash"></i>Remove
                                </button>
                            </div>

                            <div class="form-group">
                                <label class="rateCombined__label">Nickname</label>
                                <input required data-type="name" type="text" class="form-control">
                            </div>

                            <div class="rateCombined__groupForm">
                                <div class="form-group">
                                    <label class="rateCombined__label">Agency</label>
                                    <div class="dropdownWithSearch">
                                        <input required data-type="agency" type="text" class="form-control dropdownWithSearch__input" placeholder="Select agency">
                                        <button type="button" class="dropdownWithSearch__btn">
                                            <i class="fa fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="rateCombined__label">Rate</label>
                                    <div class="d-flex align-items-center">
                                        <input required data-type="rate" type="number" class="form-control">
                                        <div class="ml-1" style="font-size: 20px; font-family: inherit;">%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="rateCombined__exampleToggle">
                        <button type="button">Show example</button>
                    </div>

                    <div class="rateCombined__example">
                        <table class="rateCombined__table">
                            <tr>
                                <th>NAME</th>
                                <th class="text-right">CUSTOM RATE TOTAL</th>
                            </tr>
                            <tr>
                                <td>Your custom rate</td>
                                <td class="text-right">8.31%</td>
                            </tr>
                        </table>

                        <table class="rateCombined__table">
                            <tr>
                                <th>NICKNAME</th>
                                <th>AGENCY</th>
                                <th>RATE</th>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>nSmarTrac Department of Revenue</td>
                                <td>2.90%</td>
                            </tr>
                            <tr>
                                <td>County</td>
                                <td>Intuit Treasury Division</td>
                                <td>4.31%</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>nSmarTrac Department of Revenue</td>
                                <td>1.10%</td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-group">
                        <label class="rateCombined__label">Name</label>
                        <input required data-type="name" type="text" class="form-control">
                    </div>

                    <div id="rateCombinedItems"></div>

                    <button type="button" class="rateCombined__btn" id="addCombinedItemBtn">+ Add another rate</button>
                </div>

            </form>

            <div class="sidebarForm__footer">
                <button data-action="close" type="button" class="settings__btn mr-2">Cancel</button>
                <button id="addRateBtn" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

    <div class="sidebarForm editCustomRate" id="editRate">
        <div class="sidebarForm__inner">
            <div class="sidebarForm__header">
                <div class="sidebarForm__title">Edit custom sales tax rate</div>
                <button data-action="close" class="sidebarForm__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="sidebarForm__messageWrapper">
                <div class="sidebarForm__message">
                    <div><i class="fa fa-info-circle text-info sidebarForm__messageIcon"></i></div>
                    <div class="sidebarForm__messageText">Changes you make will update the rates everywhere except for any in past returns.</div>
                </div>
            </div>

            <form class="sidebarForm__form">
                <div id="editSingleWrapper">
                    <div class="form-group">
                        <label for="editRate__name">Name</label>
                        <input data-type="name" required type="text" class="form-control" id="editRate__name">
                    </div>

                    <div class="form-group">
                        <label for="editRate__rate">Rate</label>
                        <div class="d-flex align-items-center">
                            <input required data-type="rate" type="number" class="form-control" id="editRate__rate">
                            <div class="ml-1" style="font-size: 20px; font-family: inherit;">%</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editRate__agency">Agency</label>
                        <input readonly data-type="agency" class="form-control" id="editRate__agency">
                    </div>
                </div>

                <div id="editCombinedWrapper">
                    <template>
                        <div class="rateCombinedItem">
                            <div class="rateCombinedItem__title" data-type="title"></div>

                            <div class="rateCombinedItem__label">Name</div>
                            <div class="rateCombinedItem__value">
                                <span data-type="name"></span>
                            </div>

                            <div class="rateCombinedItem__label">Rate</div>
                            <div class="rateCombinedItem__value">
                                <span data-type="rate"></span>%
                            </div>

                            <div class="rateCombinedItem__label">Agency</div>
                            <div class="rateCombinedItem__value">
                                <span data-type="agency"></span>
                            </div>
                        </div>
                    </template>

                    <div class="form-group">
                        <label for="editRate__name">Name</label>
                        <input data-type="name" required type="text" class="form-control" id="editRate__name">
                    </div>

                    <div id="editRateCombinedItems"></div>
                </div>
            </form>

            <div class="sidebarForm__footer">
                <button data-action="close" type="button" class="settings__btn mr-2">Cancel</button>
                <button id="editRateBtn" type="button" class="btn btn-primary">Continue</button>
            </div>
        </div>
    </div>
	<?php //include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('v2/includes/footer');?>
