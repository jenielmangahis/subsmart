<div class="modal-right-side createRuleModalRight" id="createRuleModalRight">
    <div class="modal right fade nsm-modal" id="createRules" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="myModalLabel2">Create rule</span>
                    <button type="button" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
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
                                    <select name="apply_type" class="form-control" data-type="apply_type" required="">
                                        <option value="">Select Bank Account</option>
                                        <option value="all-bank-account">All bank accounts</option>
                                        <option value="checking">Checking</option>
                                    </select>
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
                                <div id="addCondition" class="addCondition">
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
                            <div class="action-section">
                                <span class="action-label">Tags</span>
                                <div style="width: 220px;display: inline-block;">
                                    <select
                                        id="accountingRulesTags"
                                        name="tags"
                                        class="form-control"
                                        data-type="assignments.tags"
                                        multiple="multiple"
                                    >
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
                    <button type="button" class="nsm-button" data-dismiss="modal">Cancel</button>
                    <button type="button" class="nsm-button primary" data-action="save">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="full-screen-modal">
    <div id="importRules" class="modal fade modal-fluid nsm-modal" role="dialog">
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