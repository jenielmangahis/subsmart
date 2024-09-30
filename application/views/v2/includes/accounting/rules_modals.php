<div class="modal-right-side createRuleModalRight" id="createRuleModalRight">
    <div class="modal right fade nsm-modal" id="createRules" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="myModalLabel2">Create rule</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <form id="addRuleForm" class="addRuleForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <p>Rules only apply to unreviewed transactions.</p>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="form-group m-0">
                                    <label for="rule-name">What do you want to call this rule? *</label>
                                    <input required type="text" id="rule-name" name="rule_name" class="nsm-field form-control" placeholder="Name this rule">
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="form-group m-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Apply this to transactions that are</label>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <select name="transaction_type" class="nsm-field form-control" id="transaction-type" required>
                                                <option value="money-out" selected>Money out</option>
                                                <option value="money-in">Money in</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-center">in</div>
                                        <div class="col-12 col-md-5">
                                            <select name="accounts" class="nsm-field form-control" id="for-accounts" multiple="multiple" required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center grid-mb">
                                <div class="form-group m-0">
                                    <label>and include the following:</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 grid-mb">
                                <div class="form-group m-0">
                                    <select name="include" class="nsm-field form-control" id="include">
                                        <option value="all" selected>All</option>
                                        <option value="any">Any</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="col-12 col-md-12 text-rule-condition-alert" id="text-rule-condition-alert" style="text-align: center;"></div>
                                <table class="nsm-table" id="conditions-table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="field[]" class="nsm-field form-control">
                                                    <option value="description" selected>Description</option>
                                                    <option value="bank-text">Bank text</option>
                                                    <option value="amount">Amount</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="condition[]" class="nsm-field form-control">
                                                    <option value="contain" selected>Contain</option>
                                                    <option value="doesnt-contain">Doesn't contain</option>
                                                    <option value="is-exactly">Is exactly</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input required type="text" name="text_rule[]" id="text-rule[]" class="nsm-field form-control text-rule" placeholder="Enter Text">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <button class="nsm-button" id="add-condition"><i class="bx bx-fw bx-plus"></i> Add a condition</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <button type="button" class="nsm-button button-test-rule" id="button-test-rule">Test Rule</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="form-group m-0">
                                    <label>Then</label>
                                    <div class="dropdown d-inline-block">
                                        <a href="#" class="dropdown-toggle text-decoration-none" role="button" data-bs-toggle="dropdown" aria-expanded="false">Assign <i class="bx bx-fw bx-chevron-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item active" href="javascript:void(0);" id="assign-rule">Assign</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" id="exclude-rule">Exclude</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="row">
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        Transaction type
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="assign_to_transac" class="nsm-field form-control" id="assign-to-transac">
                                            <option value="expenses" selected>Expenses</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="check">Check</option>
                                            <option value="cc-payment">Credit card payment</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="row">
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        Category
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="assign_to_category" class="nsm-field form-control" id="assign-to-category" required></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="row">
                                    <div class="col-12 col-md-4"></div>
                                    <div class="col-12 col-md-8">
                                        <button class="nsm-button primary" id="add-split">
                                            <i class="bx bx-fw bx-plus"></i> Add a split
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="row">
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        Payee
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="assign_to_payee" class="nsm-field form-control" id="assign-to-payee"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="row">
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        Customer
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="assign_to_customer" class="nsm-field form-control" id="assign-to-customer"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="row">
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        Tags
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select name="assign_to_tags[]" class="nsm-field form-control" id="assign-to-tags" multiple="multiple"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 grid-mb">
                                <button class="nsm-button primary" id="assign-more">
                                    <i class="bx bx-fw bx-plus"></i> Assign more
                                </button>
                            </div>
                            <div class="col-12 grid-mb">
                                <div class="form-group">
                                    <label for="">Automatically confirm transactions this rule applies to</label>
                                    <div class="custom-control custom-switch">
                                        <label class="custom-control-label" for="auto-add-switch">Auto-add</label>
                                        <input type="checkbox" name="auto" class="custom-control-input" id="auto-add-switch" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button primary">Save</button>
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
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
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
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-default close-item-modal">Cancel</button>                    
                    <button class="btn btn-success" style="float: right;" id="importRulesNext">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="payee-modal" class="modal fade modal-fluid nsm-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <form id="new-payee-form" class="w-50 m-auto">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Add New Payee</span>
                    <button type="button" class="cancel-add-payee" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col-6">
                            <label for="name"><span class="text-danger">*</span> First Name</label>
                            <input type="text" name="first_name" id="first_name" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-6">
                            <label for="name"><span class="text-danger">*</span> Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="nsm-field form-control mb-2" required />
                        </div>
                        <div class="col-12" id="business_name_container" style="display: none;">
                            <label for="business_name"><span class="text-danger"></span> Business Name</label>
                            <input type="text" name="business_name" id="business_name" class="nsm-field form-control mb-2">
                        </div>
                        <input type="hidden" name="payee_type" value="vendor" />
                        <?php if ($type !== 'vendor' && $type !== 'customer') : ?>
                            <!-- <div class="col-12">
                                <label for="name">Type</label>
                                <select name="payee_type" id="payee_type" class="nsm-field form-control">
                                    <option value="vendor">Vendor</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div> -->
                        <?php endif; ?>
                        <?php if ($type === 'customer') : ?>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input data-type="customer_email" type="email" class="form-control nsm-field mb-2" name="email" id="email" required />
                            </div>
                            <div class="col-12">
                                <label for="phone-m">Mobile</label>
                                <input type="text" class="form-control nsm-field phone_number mb-2" maxlength="12" placeholder="xxx-xxx-xxxx" name="mobile" id="phone-m" required />
                            </div>
                            <div class="col-12 mb-2">
                                <label for="customer-type">Customer Type</label>
                                <select id="customer-type" name="customer_type" data-customer-source="dropdown" class="form-control input_select" required>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="street">Address</label>
                                <input name="street" id="street" class="form-control nsm-field mb-2" placeholder="Street" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="city" type="text" class="form-control nsm-field mb-2" placeholder="City" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="state" type="text" class="form-control nsm-field mb-2" placeholder="State" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="zip_code" type="text" class="form-control nsm-field mb-2" placeholder="ZIP Code" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="country" type="text" class="form-control nsm-field mb-2" placeholder="Country">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <?php if ($type === 'vendor' || $type === 'payee') : ?>
                        <button type="button" class="nsm-button" id="add-payee-details"><i class="bx bx-fw bx-plus"></i> Details</button>
                    <?php endif; ?>
                    <button type="submit" class="nsm-button success float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="payee-modal-customer" class="modal fade modal-fluid nsm-modal" role="dialog">
    <?php $type = 'customer'; ?>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <!-- Modal content-->
        <form id="new-payee-form" class="w-50 m-auto">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">New Customer</span>
                    <button type="button" class="cancel-add-payee" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col-6">
                            <label for="name"><span class="text-danger">*</span> First Name</label>
                            <input type="text" name="first_name" id="first_name" class="nsm-field form-control mb-2 payee-firstname" required />
                        </div>
                        <div class="col-6">
                            <label for="name"><span class="text-danger">*</span> Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="nsm-field form-control mb-2 payee-lastname" required />
                        </div>
                        <div class="col-12" id="business_name_container" style="display: none;">
                            <label for="business_name"><span class="text-danger"></span> Business Name</label>
                            <input type="text" name="business_name" id="business_name" class="nsm-field form-control mb-2">
                        </div>
                        <input type="hidden" name="payee_type" id="payee_type" value="customer">
                        <?php if ($type !== 'vendor' && $type !== 'customer') : ?>
                            <div class="col-12">
                                <label for="name">Type</label>
                                <select name="payee_type" id="payee_type" class="nsm-field form-control">
                                    <option value="vendor">Vendor</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>
                        <?php endif; ?>
                        <?php if ($type === 'customer') : ?>
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input data-type="customer_email" type="email" id="customer_email" class="form-control nsm-field mb-2" name="email" id="email" required />
                            </div>
                            <div class="col-12">
                                <label for="phone-m">Mobile</label>
                                <input type="text" class="form-control nsm-field phone_number mb-2" maxlength="12" placeholder="xxx-xxx-xxxx" name="mobile" id="phone-m" required />
                            </div>
                            <div class="col-12 mb-2">
                                <label for="customer-type">Customer Type</label>
                                <select id="customer-type" name="customer_type" data-customer-source="dropdown" class="form-control input_select" required>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="street">Address</label>
                                <input name="street" id="street" class="form-control nsm-field mb-2" placeholder="Street" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="city" type="text" id="city" class="form-control nsm-field mb-2" placeholder="City" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="state" type="text" id="state" class="form-control nsm-field mb-2" placeholder="State" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="zip_code" type="text" id="zip_code" class="form-control nsm-field mb-2" placeholder="ZIP Code" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <input name="country" type="text" id="country" class="form-control nsm-field mb-2" placeholder="Country">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <?php if ($type === 'vendor' || $type === 'payee') : ?>
                        <button type="button" class="nsm-button" id="add-payee-details"><i class="bx bx-fw bx-plus"></i> Details</button>
                    <?php endif; ?>
                    <button type="submit" class="nsm-button success float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#customer-type').change(function() {
            var customerType = $(this).val();
            console.log('Customer Type:', customerType); 
            var businessNameContainer = $('#business_name_container');

            if (customerType === 'Commercial') {
                console.log('Showing business name input');
                businessNameContainer.show();
            } else {
                console.log('Hiding business name input');
                businessNameContainer.hide();
            }
        });

        $('#phone-m').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });        
    }); 
</script>