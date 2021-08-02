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
                        <button class="settings__btn">Add agency</button>
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
                                <a class="settings__link" href="#">Edit</a>
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
                        <button class="settings__btn">Add Rate</button>
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
                                <a class="settings__link" href="#">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="editTaxAgency">
        <div class="editTaxAgency__inner">
            <div class="editTaxAgency__header">
                <div class="editTaxAgency__title">Florida details</div>
                <button class="editTaxAgency__close">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <p>Florida Department of Revenue</p>

            <form>
                <div class="form-group">
                    <label for="filing_frequency">Filing frequency</label>
                    <select class="form-control" id="filing_frequency">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="half_yearly">Half-yearly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tax_period_start">Start of tax period</label>
                    <input type="text" class="form-control" id="tax_period_start" value="January">
                </div>

                <div class="form-group">
                    <label for="date_start">Start Date</label>
                    <input type="date" class="form-control" id="date_start" value="January">
                </div>
            </form>

            <div class="editTaxAgency__footer">
                <button type="button" class="settings__btn mr-2">Make inactive</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>
<?php include viewPath('includes/footer_accounting');?>
