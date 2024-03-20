<div class="modal-right-side createRuleModalRight" id="createRuleModalRight">
    <div class="modal right fade nsm-modal" id="createRules" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="myModalLabel2">Create rule</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <form id="addRuleForm">
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
                                            <input required type="text" name="text[]" class="nsm-field form-control" placeholder="Enter Text">
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
                                            <button class="nsm-button" id="test-rule">Test Rule</button>
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
                    <h4>Import Link Bank</h4>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="close-item-modal"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer-importRules">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-default close-item-modal">Cancel</button>                    
                    <button class="btn btn-success" style="float: right;" id="importRulesNext">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>