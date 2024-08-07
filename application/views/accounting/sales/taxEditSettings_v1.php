<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
?>

<div class="wrapper" role="wrapper">
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
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
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>
