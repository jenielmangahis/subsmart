<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section style="margin-top:1.8%;padding-left:1.4%;">
        <div class="container-fluid" style="background-color:white;">
            <div class="page-title-box">
                <div>
                    <div class="col-sm-12">
                          <h3 class="page-title left" style="font-family: Sarabun, sans-serif !important;font-size: 1.75rem !important;font-weight: 600 !important;">Rules</h3>
                    </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                            <!-- <h2>Rules</h2> -->
                            <div class="col-md-12 banking-tab-container" style="padding-top:2%;width:350px;">
                                <a href="<?php echo url('/accounting/link_bank') ?>" class="banking-tab">Banking</a>
                                <a href="<?php echo url('/accounting/rules') ?>" class="banking-tab<?php echo ($this->uri->segment(1) == "link_bank") ?: '-active'; ?>" style="text-decoration: none">Rules</a>
                                <a href="<?php echo url('/accounting/receipts') ?>" class="banking-tab">Receipts</a>
                                <a href="<?php echo url('/accounting/tags') ?>" class="banking-tab">Tags</a>
                            </div>
                            </div>
                            <div class="col-md-6" style="text-align: right">
                                <a href="" style="font-size: 14px;line-height: 40px;">Learn more about bank rules.</a>
                                <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                    <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px" id="newRuleButton">New rule</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" class="dropdown-item" id="exportRules">Export rules</a></li>
                                        <li><a href="#" class="dropdown-item" id="importRulesLink">Import rules</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <div style="background-color:#fdeac3; width:100%;padding:.5%;margin-bottom:28px;margin-top:28px;">
                The more you uses your bank rules, the better it gets at categorizing. After a while, it can even scan transactions and add details like payees. Step 1: Create a bank rule. Go to the Banking menu or Transactions menu. Then select the Rules tab. Select New rule. Enter a name in the Rule field. From the drop-down, select Money in or Money out.  Simply acknowledge and our accounting platform will remember your selection for that particular entry for the next time.  Saving you time and money.
                </div>
                        <div class="dropdown rulesDropdown d-none" id="batchActions">
                            <button
                                class="btn dropdown-toggle rulesDropdown__btn"
                                type="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Batch Actions
                            </button>

                            <ul class="dropdown-menu dropdown-menu-left">
                                <li><a href="#" class="dropdown-item" data-action="batchDelete">Delete</a></li>
                                <li><a href="#" class="dropdown-item" data-action="batchMakeInactive">Disable</a></li>
                                <li><a href="#" class="dropdown-item" data-action="batchMakeActive">Enable</a></li>
                            </ul>
                        </div>

                        <table id="rulesTable" class="table table-striped table-bordered rulesTable">
                            <thead class="rulesTable__head">
                                <tr>
                                    <th></th>
                                    <th>
                                        <input type="checkbox" class="rulesTable__checkbox rulesTable__checkbox--primary"/>
                                    </th>
                                    <th>
                                        <div>
                                            Priority
                                            <i
                                                title="You can reorder your rules to change a rule's priority. The rule with the highest priority will always be applied first."
                                                class="fa fa-info-circle"
                                            ></i>
                                        </div>
                                    </th>
                                    <th>Rule Name</th>
                                    <th>Applied To</th>
                                    <th>Conditions</th>
                                    <th>Settings</th>
                                    <th>Auto-add</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
    </div>
        <!-- end container-fluid -->
<!--    Modal for creating rules-->
    <div class="modal-right-side createRuleModalRight" id="createRuleModalRight">
        <div class="modal right fade" id="createRules" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel2" >Create rule</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id="addRuleForm">
                    <div class="modal-body">

                        <div class="formError">
                            <div class="formError__inner">
                                <i class="fa fa-info-circle"></i>
                                <p>Something’s not quite right</p>
                            </div>
                        </div>

                        <div class="subheader">Rules only apply to unreviewed transactions.</div>
                            <div class="form-group">
                                <label>What do you want to call this rule? *</label>
                                <input
                                    required
                                    type="text"
                                    name="rules_name"
                                    class="form-control"
                                    placeholder="Name this rule"
                                    data-type="rules_name"
                                >
                            </div>
                            <div class="form-group">
                                <div>
                                    <label>Apply this to transactions that are</label>
                                </div>
                                <div class="createRuleModalRight__transactions">
                                    <div class="tab-select">
                                        <select
                                            name="apply_type"
                                            class="form-control"
                                            data-type="apply_type"
                                        >
                                            <option selected>Money in</option>
                                            <option>Money out</option>
                                        </select>
                                    </div>
                                    <span style="margin-right: 5px;margin-left: 5px;">in</span>
                                    <div class="tab-select">
                                        <div class="selectWithCheckbox" id="transactionsBankSelect">
                                            <button type="button" class="selectWithCheckbox__btn">
                                                <span class="selectWithCheckbox__text">No bank account selected</span>
                                                <i class="fa fa-angle-down"></i>
                                            </button>

                                            <div class="selectWithCheckbox__options">
                                                <div class="form-group selectWithCheckbox__optionsItem">
                                                    <input
                                                        name="banks"
                                                        type="checkbox"
                                                        class="form-check-input"
                                                        id="allBankAccountsCb"
                                                        data-type="banks"
                                                    >
                                                    <label class="form-check-label" for="allBankAccountsCb">All bank accounts</label>
                                                </div>

                                                <div class="form-group selectWithCheckbox__optionsItem">
                                                    <input type="checkbox" class="form-check-input" id="checkingCb">
                                                    <label class="form-check-label" for="checkingCb">Checking</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="position: relative;display: inline-block;">and include the following:</label>
                                <select
                                    name="include"
                                    class="form-control inline-select"
                                    data-type="include"
                                >
                                    <option selected>All</option>
                                    <option>Any</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="addCondition-container">
                                    <div id="addCondition">
                                        <div class="tab-select">
                                            <input type="hidden" id="counterCondition" value="1">
                                            <select
                                                name="description[]"
                                                class="form-control"
                                                data-type="conditions.description"
                                            >
                                                <option selected>Description</option>
                                                <option>Bank text</option>
                                                <option>Amount</option>
                                            </select>
                                        </div>
                                        <div class="tab-select">
                                            <select
                                                name="contain[]"
                                                class="form-control"
                                                style="max-width: 140px"
                                                data-type="conditions.contain"
                                            >
                                                <option  selected>Contain</option>
                                                <option>Doesn't contain</option>
                                                <option>Is exactly</option>
                                            </select>
                                        </div>
                                        <div class="tab-select" style="max-width: 140px">
                                            <input
                                                required
                                                type="text"
                                                name="comment[]"
                                                class="form-control"
                                                placeholder="Enter Text"
                                                data-type="conditions.comment"
                                            >
                                        </div>
                                        <div class="tab-select deleteCondition" id="deleteCondition" style="display: none;">
                                            <a href="#" id="btnDeleteCondition"><i class="fa fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 15px;">
                                    <a href="#" id="btnAddCondition" style="color: #0b62a4;"><i class="fa fa-plus"></i> Add a condition</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Then assign</label>
                                <div class="action-section">
                                    <span class="action-label">Transaction type</span>
                                    <select
                                        name="trans_type"
                                        class="form-control"
                                        data-type="assignments.transaction_type"
                                    >
                                        <option selected>Expenses</option>
                                        <option>Transfer</option>
                                        <option>Check</option>
                                    </select>
                                </div>
                                <div class="action-section" >
                                    <div id="categoryDefault">
                                        <span class="action-label" style="margin-right: 70px">Category</span>
                                        <div style="width: 220px;display: inline-block;">
                                            <select
                                                name="category[]"
                                                id="mainCategory"
                                                class="form-control select2-rules-category"
                                                data-type="assignments.category"
                                                data-main-category="true"
                                                required
                                            >
                                                <!-- <option></option>
                                                <option disabled>&plus; Add new</option>
                                                <option>Advertising</option>
                                                <option>Bad Debts</option>
                                                <option>Bank Charges</option> -->
                                            </select>
                                        </div>
                                        <span class="action-label d-none" style="margin-left: 5px;"><a href="#" id="btnAddSplit" style="color: #0b62a4;">Add split</a></span>
                                    </div>
                                    <!--Add Split Div-->
                                    <div class="add-split-container">
                                        <div class="add-split-section">
                                            <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                                Split detail #<span class="splitNum">1</span>
                                                <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text" >Percentage</span>
                                                <input
                                                    type="number"
                                                    name="percentage[]"
                                                    class="form-control"
                                                    style="width: 205px"
                                                    data-type="assignments.category_percent"
                                                    required
                                                >
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text">Category</span>
                                                <div style="width: 220px;display: inline-block;">
                                                    <select
                                                        name="category[]"
                                                        class="form-control select2-rules-category"
                                                        data-type="assignments.category"
                                                        required
                                                    >
                                                        <option></option>
                                                        <option>Advertising</option>
                                                        <option>Bad Debts</option>
                                                        <option>Bank Charges</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr id="border-category">
                                        </div>
                                        <div class="add-split-section">
                                            <div class="split-header" style="margin-bottom: 12px;font-weight: bold">
                                                Split detail #<span class="splitNum">2</span>
                                                <a href="#" id="deleteSplitLine" style="float: right;right: 0;position: absolute;"><i class="fa fa-trash fa-lg"></i></a>
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text" >Percentage</span>
                                                <input
                                                    type="number"
                                                    name="percentage[]"
                                                    class="form-control"
                                                    style="width: 205px"
                                                    data-type="assignments.category_percent"
                                                    required
                                                >
                                            </div>
                                            <div class="split-content">
                                                <span class="split-category-text">Category</span>
                                                <div style="width: 220px;display: inline-block;">
                                                    <select
                                                        name="category[]"
                                                        class="form-control select2-rules-category"
                                                        data-type="assignments.category"
                                                        required
                                                    >
                                                        <option></option>
                                                        <option>Advertising</option>
                                                        <option>Bad Debts</option>
                                                        <option>Bank Charges</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr id="border-category">
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: 10px;margin-bottom: 10px;">
                                    <a href="#" id="btnAddLine"  style="color: #0b97c4;display: none;">Add a line</a>
                                </div>
                                <div class="action-section">
                                    <span class="action-label">Payee</span>
                                    <div style="width: 220px;display: inline-block;">
                                        <select
                                            name="payee"
                                            class="form-control select2-rules-payee"
                                            data-type="assignments.payee"
                                        >
                                            <!-- <option></option>
                                            <option>Abacus Accounting</option>
                                            <option>Absolute Power</option>
                                            <option>ADSC</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="action-section" id="assignMore" style="display: none;">
                                    <span class="action-label">Add memo</span>
                                    <textarea
                                        name="memo"
                                        cols="30"
                                        rows="5"
                                        placeholder="Enter Text"
                                        style="resize: none;"
                                        data-type="memo"
                                    ></textarea>
                                </div>
                                <div style="margin-top: 15px;">
                                    <a href="#" id="btnAssignMore" style="color: #0b62a4;"><i class="fa fa-plus"></i> Assign more</a>
                                </div>
                                <div style="margin-top: 15px;">
                                    <a href="#" style="display: none;color: #0b62a4;" id="btnClear"><i class="fa fa-trash"></i> Clear</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Automatically confirm transactions this rule applies to</label>
                                <div class="custom-control custom-switch">
                                    <input
                                        type="checkbox"
                                        name="auto"
                                        class="custom-control-input"
                                        id="autoAddswitch"
                                        data-type="auto"
                                    >
                                    <label class="custom-control-label" for="autoAddswitch">Auto-add</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" data-action="save">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--    end of modal-->

    <div class="full-screen-modal">
        <div id="importRules" class="modal fade modal-fluid" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Import rules</h4>
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                    </div>
                    <div class="modal-body">

                        <div class="progressSection">
                            <div class="bs-stepper" id="importRulesStepper">
                                <div class="bs-stepper-header" role="tablist">
                                    <div class="step" data-target="#stepper-upload-list">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="stepper-upload-list" id="stepper-upload-list-trigger">
                                            <span class="bs-stepper-circle">1</span>
                                            <span class="bs-stepper-label">Upload List</span>
                                        </button>
                                    </div>

                                    <div class="line"></div>

                                    <div class="step" data-target="#stepper-select-rules">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="stepper-select-rules" id="stepper-select-rules-trigger">
                                            <span class="bs-stepper-circle">2</span>
                                            <span class="bs-stepper-label">Select Rules</span>
                                        </button>
                                    </div>

                                    <div class="line"></div>

                                    <div class="step" data-target="#stepper-set-rule-details">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="stepper-set-rule-details" id="stepper-set-rule-details-trigger">
                                            <span class="bs-stepper-circle">3</span>
                                            <span class="bs-stepper-label">Set Rule Details</span>
                                        </button>
                                    </div>

                                    <div class="line"></div>

                                    <div class="step" data-target="#stepper-finish">
                                        <button type="button" class="step-trigger" role="tab" aria-controls="stepper-finish" id="stepper-finish-trigger">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Finish</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="bs-stepper-content">
                                    <div id="stepper-upload-list" class="content" role="tabpanel" aria-labelledby="stepper-upload-list-trigger">
                                        <div class="stepperError">
                                            <div class="stepperError__header">
                                                <i class="fa fa-exclamation-circle" class="stepperError__icon"></i>
                                                <div class="stepperError__title">Something’s not quite right</div>
                                            </div>
                                            <div class="stepperError__body">
                                                Sorry, this isn’t the correct file type. You can only import a file that was exported from the Rules page in your other company.
                                            </div>
                                        </div>

                                        <div class="uploadList">
                                            <div class="step-title">Upload list of rules</div>
                                            <div class="sub-title">Please select the rules list you exported from your other company.</div>
                                            <div class="instruction">Select the file to upload</div>

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="stepRulesFile" accept=".xls,.xlsx">
                                                <label class="custom-file-label" for="stepRulesFile">No file selected</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="stepper-select-rules" class="content" role="tabpanel" aria-labelledby="stepper-select-rules-trigger">
                                        <div class="uploadList">
                                            <div class="step-title">Select rules to import</div>

                                            <table id="stepRulesTable" class="table table-striped table-bordered rulesTable">
                                                <thead class="rulesTable__head">
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" class="rulesTable__checkbox rulesTable__checkbox--primary"/>
                                                        </th>
                                                        <th>Rule Name</th>
                                                        <th>For</th>
                                                        <th>Conditions</th>
                                                        <th>Settings</th>
                                                        <th>Auto-add</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="stepper-set-rule-details" class="content" role="tabpanel" aria-labelledby="stepper-set-rule-details-trigger">
                                        <div class="uploadList">
                                            <div class="step-title">Select rule details</div>

                                            <div class="stepRuleDetails">
                                                <div class="stepRuleDetails__column">
                                                    <div class="stepRuleDetails__title">Import Rule Details</div>
                                                    <div class="stepRuleDetails__group">
                                                        <div class="stepRuleDetails__label">Payees</div>
                                                        <div class="stepRuleDetails__value">ABI</div>
                                                    </div>
                                                    <div class="stepRuleDetails__group">
                                                        <div class="stepRuleDetails__label">Categories</div>
                                                        <div class="stepRuleDetails__value">Accounting</div>
                                                    </div>
                                                </div>

                                                <div class="stepRuleDetails__icon">
                                                    <i class="fa fa-arrow-circle-right"></i>
                                                </div>

                                                <div class="stepRuleDetails__column">
                                                    <div class="stepRuleDetails__title">Company Details</div>
                                                    <div class="stepRuleDetails__group">
                                                        <select
                                                            id="importRulesPayee"
                                                            class="form-control select2-rules-payee"
                                                        >
                                                        </select>
                                                    </div>
                                                    <div class="stepRuleDetails__group">
                                                        <select
                                                            id="importRulesCategory"
                                                            class="form-control select2-rules-category"
                                                        >
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="stepper-finish" class="content" role="tabpanel" aria-labelledby="stepper-finish-trigger">
                                        <div class="uploadList">
                                            <div class="stepperCompleteWrapper">
                                                <div class="stepperComplete">
                                                    <div class="stepperComplete__inner">
                                                        <i class="fa fa-check-circle stepperComplete__icon"></i>
                                                        <div class="stepperComplete__body">
                                                            <span class="stepperComplete__count">0</span> rule was successfully imported.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stepperComplete stepperComplete--error">
                                                    <div class="stepperComplete__inner">
                                                        <i class="fa fa-exclamation-circle stepperComplete__icon"></i>
                                                        <div class="stepperComplete__body">
                                                            <span class="stepperComplete__count">0</span> rule was not imported.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer-importRules">
                        <button class="btn btn-default" style="float: left;" id="importRulesCancel">Cancel</button>
                        <button class="btn btn-success" style="float: right;" id="importRulesNext">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-container">
        <div class="full-screen-modal"></div>
    </div>
<!--    end of modal-->
	<?php include viewPath('includes/sidebars/accounting/accounting');?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting');?>
<script>
    //dropdown checkbox
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#rules_table').DataTable({
            "paging":false,
            "language": {
                "emptyTable": "<h5>Use rules to save time</h5> <span>Make rules for your frequently occurring transactions and tell nSmartrac exactly what should happen when conditions are met. <a href='#' data-toggle=\"modal\" data-target=\"#createRules\" style='color: #0b97c4'>Create a rule</a></span>"
            }
        });
    } );
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isLocalhost = ["localhost", "127.0.0.1"].includes(location.hostname);
        if (!isLocalhost) return;

        $.ajaxSetup({
            beforeSend: function (xhr,settings) {
                if (settings.url.startsWith("/accounting/")) {
                    settings.url = settings.url.replace("/accounting/", "/nsmartrac/accounting/")
                }
            }
        });
    });
</script>