<div class="addInvoiceTax">
    <input type="hidden" name="agency_id" />
    <div class="form-group" style="margin-bottom: 0 !important;">
        <div class="taxRateSelect" id="invoiceTaxRate">
            <button class="taxRateSelect__main" type="button" disabled>
                <span class="type-text">Items total tax rate</span>
                <i class="fa fa-angle-down"></i>
            </button>

            <div class="taxRateSelect__options">
                <div class="taxRateSelect__item" value="items_tax" data-type-value="items_tax" default="true">Items total tax rate</div>
                <div class="taxRateSelect__item" value="location" data-type-value="location">Based on location</div>

                <div class="taxRateSelect__item taxRateSelect__item--customWrapper">
                    <div class="taxRateSelect__title">Custom Rates</div>
                    <div class="taxRateSelect__item taxRateSelect__item--custom" value="add_custom">
                        <i class="fa fa-plus"></i>
                        <span>Add rate</span>
                    </div>
                </div>
            </div>
            <input type="hidden" id="tax_rate" name="tax_rate" class="type-input">
        </div>
    </div>
</div>

<template id="addRateSidebarTemplate">
    <div class="sidebarForm customRate" id="addRateSidebar">
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
</template>

<script src="<?=$url->assets?>js/accounting/TaxRateAdder/TaxRateAdder.js"></script>
<script src="<?=$url->assets?>js/accounting/TaxRateAdder/accounting.min.js"></script>
<style>
    @import url("<?=$url->assets?>css/accounting/tax/settings/settings.css");
    @import url("<?=$url->assets?>css/accounting/tax/dropdown-with-search/dropdown-with-search.css");
    @import url("<?=$url->assets?>css/accounting/tax/taxrate-select/taxrate-select.css");
</style>
<script>
    $(document).ready(function() {
        if (!$("#addRateSidebar").length) {
            const $template = $("#addRateSidebarTemplate");
            const template = $template.get(0).content;
            const $copy = document.importNode(template, true);
            $(document.body).append($copy);
        }

        new TaxRateAdder($("#invoiceTaxRate"), {
            tableRows: "#jobs_items_table_body tr",
            totalTax: "#summaryContainer #total_tax_",
            grandTotal: "#summaryContainer #grand_total",
            subTotal: "#summaryContainer #span_sub_total_invoice",
        });
    });
</script>
