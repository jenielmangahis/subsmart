<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
?>

<div class="wrapper" role="wrapper">
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="settings">
            <div class="settings__back">
                <a href="#">
                    <i class="fa fa-chevron-left"></i>
                    Back to sales tax center
                </a>
            </div>

            <div class="settings__header">
                <div class="settings__title">Edit settings</div>
                <button class="settings__btn">Turn off sales tax</button>
            </div>

            <div class="settings__spacer"></div>

            <div class="settings__taxAgencies">
                <div class="settings__header settings__header--table">
                    <div class="settings__title settings__title--secondary">Tax agencies</div>
                    <div>
                        <button data-action="addAgency" class="settings__btn">Add agency</button>
                        <button class="settings__btn settings__btn--icon" disabled><i class="fa fa-cog"></i></button>
                    </div>
                </div>

                <table class="table table-hover settings__table">
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
                        <tr>
                            <td data-type="agency">Florida Department of Revenue</td>
                            <td data-type="filling_frequency">Monthly</td>
                            <td data-type="tax_period_start">January</td>
                            <td data-type="date_start">01/01/2012</td>
                            <td data-type="agency">
                                <div class="btn-group btnGroup">
                                    <button data-action="agencyInfo" type="button" class="btn btn-sm btnGroup__main">Edit</button>
                                    <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Make inactive</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
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

                <table class="table table-hover settings__table">
                    <thead>
                        <tr>
                            <th class="settings__tableHead" scope="col">Name</th>
                            <th class="settings__tableHead" scope="col">Agency</th>
                            <th class="settings__tableHead" scope="col">Rate</th>
                            <th class="settings__tableHead" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-type="name">Escambia county</td>
                            <td data-type="agency">Florida Department of Revenue</td>
                            <td data-type="rate">7.5%</td>
                            <td data-type="agency">
                                <div class="btn-group btnGroup">
                                    <button data-action="agencyInfo" type="button" class="btn btn-sm btnGroup__main">Edit</button>
                                    <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Make inactive</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="sidebarForm" id="agencyInfo">
        <div class="sidebarForm__inner">
            <div class="sidebarForm__header">
                <div class="sidebarForm__title">Florida details</div>
                <button data-action="close" class="sidebarForm__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <p>Florida Department of Revenue</p>

            <form>
                <div class="form-group">
                    <label for="agencyInfo__filingFrequency">Filing frequency</label>
                    <select class="form-control" id="agencyInfo__filingFrequency">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="half_yearly">Half-yearly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="agencyInfo__taxPeriodStart">Start of tax period</label>
                    <input type="text" class="form-control" id="agencyInfo__taxPeriodStart" value="January">
                </div>

                <div class="form-group">
                    <label for="agencyInfo__dateStart">Start Date</label>
                    <input type="date" class="form-control" id="agencyInfo__dateStart" value="January">
                </div>
            </form>

            <div class="sidebarForm__footer">
                <button type="button" class="settings__btn mr-2">Make inactive</button>
                <button type="button" class="btn btn-primary">Save</button>
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
                    <input type="text" class="form-control" id="addAgency__agency">
                </div>

                <div class="form-group">
                    <label for="addAgency__filingFrequency">Filing frequency</label>
                    <select class="form-control" id="addAgency__filingFrequency">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="half_yearly">Half-yearly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="addAgency__dateStart">Start Date</label>
                    <input type="date" class="form-control" id="addAgency__dateStart">
                </div>
            </form>

            <div class="sidebarForm__footer">
                <button data-action="close" type="button" class="settings__btn mr-2">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

    <div class="sidebarForm" id="addRate">
        <div class="sidebarForm__inner">
            <div class="sidebarForm__header">
                <div class="sidebarForm__title">Add a custom sales tax rate</div>
                <button data-action="close" class="sidebarForm__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rateType" id="addRate__rateType1" checked>
                        <label class="form-check-label" for="addRate__rateType1">
                            Single
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rateType" id="addRate__rateType2">
                        <label class="form-check-label" for="addRate__rateType2">
                            Combined
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addRate__name">Name</label>
                    <input type="text" class="form-control" id="addRate__name">
                </div>

                <div class="form-group">
                    <label for="addRate__agency">Agency</label>
                    <input type="text" class="form-control" id="addRate__agency">
                </div>

                <div class="form-group">
                    <label for="addRate__rate">Rate</label>
                    <input type="text" class="form-control" id="addRate__rate">
                </div>
            </form>

            <div class="sidebarForm__footer">
                <button data-action="close" type="button" class="settings__btn mr-2">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>
