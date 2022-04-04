<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<div class="wrapper" role="wrapper" id="wizard">
    <div class="container mt-4">
        <div>
            <h1 class="esigneditor__title">Letter Wizard (<span>Sample Client</span>)</h1>
        </div>

        <p>This is where you select items to dispute so you can build your letter. All new clients start with a Round 1 Dispute. Next "Add New Items" manually or "Add Saved/Pending Items".</p>

        <form class="mt-3 wizardForm">
            <div class="step step-1 step--active">
                <div class="step__1Selects">
                    <h2 class="step__title">
                        Step 1: <span>Choose Letter Type</span>
                    </h2>

                    <div class="step__inner">
                        <div class="step__radioGroup">
                            <div class="form-check">
                                <input class="form-check-input step__radio" name="round" type="radio" value="round1" id="round1" data-action="on_choose_letter_type">
                            </div>
                            <label for="round1">
                                Round 1: Basic Dispute - Credit Bureaus
                            </label>
                        </div>
                        <div class="step__radioGroup">
                            <div class="form-check">
                                <input class="form-check-input step__radio" name="round" type="radio" value="round2" id="round2" data-action="on_choose_letter_type">
                            </div>
                            <label for="round2">
                                Round 2 or Higher: All Other Letters - Credit Bureaus, Creditors/Furnishers, or Collectors
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a class="link" href="javascript:void(0);" data-action="on_no_dispute">Generate a letter (with no dispute items)</a>
                </div>

                <div class="step__chooseLetter d-none">
                    <h2 class="step__title mb-3">
                        Choose a Letter (No Dispute Items)
                    </h2>

                    <div class="wizardForm__step1">
                        <div class="form-group">
                            <label for="category">Letter Category</label>
                            <select class="form-control" id="category" data-name="category_id"></select>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="letter">Letter Name</label>
                                <a href="<?=base_url('EsignEditor/create');?>" class="link">Create Letter</a>
                            </div>
                            <select class="form-control" id="letter" data-name="letter_id"></select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="link mr-4" type="button" data-action="on_no_dispute_back">Back</button>
                            <button class="btn btn-primary esigneditor__btn" type="button">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Next
                            </button>
                        </div>
                    </div>
                </div>

                <div class="step__letterRecipient d-none">
                    <h2 class="step__title mb-3">
                        Letter Recipient
                    </h2>

                    <div class="step__radioGroup">
                        <div class="form-check">
                            <input class="form-check-input step__radio" name="recipient" type="radio" value="credit_bureau" id="recipient1" data-action="on_choose_letter_recipient" checked>
                        </div>
                        <label for="recipient1">
                            Credit Bureau
                        </label>
                    </div>
                    <div class="step__radioGroup">
                        <div class="form-check">
                            <input class="form-check-input step__radio" name="recipient" type="radio" value="credito_or_furnisher" id="recipient2" data-action="on_choose_letter_recipient">
                        </div>
                        <label for="recipient2">
                            Creditor/Furnisher Reporting the Item
                        </label>
                    </div>
                </div>
            </div>

            <div class="step step-2 step--disabled mt-3">
                <h2 class="step__title">Step 2: <span>Choose Dispute Items</span></h2>
                <p class="mt-4 step__step2Message">
                    We recommend never sending more than 5 dispute items per month to each credit bureau (unless it’s identity theft and you are including a police report), otherwise the bureaus may mark your disputes as "frivolous and irrelevant" and reject them.
                </p>

                <div class="mt-5 step__step2Form d-none">
                    <div class="d-flex" style="gap: 1rem;">
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#additemmodal">+ Add Saved Pending Items</button>
                        <button class="btn btn-ghost" type="button" data-toggle="modal" data-target="#newdisputemodal">+ Add New Dispute Items</button>
                    </div>

                    <table class="mt-4 table" id="selecteddisputeitemstable">
                        <thead>
                            <tr>
                                <th>Creditor/Furnisher</th>
                                <th class="accountnum">Account #</th>
                                <th>Dispute items</th>
                                <th>
                                    <img alt="" src="<?=base_url('/assets/img/customer/images/equifax.png');?>"/>
                                </th>
                                <th>
                                    <img alt="" src="<?=base_url('/assets/img/customer/images/experian.png');?>"/>
                                </th>
                                <th>
                                    <img alt="" src="<?=base_url('/assets/img/customer/images/trans_union.png');?>"/>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>

                    <div class="mt-4 d-flex justify-content-end">
                        <button class="btn btn-primary" type="button" data-action="step2_generate_letter">Next: Generate Letter</button>
                        <button class="btn btn-primary" type="button" data-action="step2_save_and_continue">Save and Continue</button>
                    </div>
                </div>
            </div>

            <div class="step step-3 step--disabled mt-3 d-none">
                <h2 class="step__title">Step 3: <span>Choose A Letter</span></h2>

                <div class="mt-5">
                    <div class="wizardForm__step1">
                        <div class="form-group">
                            <label for="step3_category">Letter Category</label>
                            <select class="form-control" id="step3_category" data-name="category_id"></select>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="step3_letter">Letter Name</label>
                                <a href="<?=base_url('EsignEditor/create');?>" class="link">Create Letter</a>
                            </div>
                            <select class="form-control" id="step3_letter" data-name="letter_id"></select>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary esigneditor__btn" type="button">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Next: Generate Letter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="newdisputemodal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Dispute Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6 d-flex flex-column">
                <h2 class="newdisputemodal__title">Select Credit Bureaus <span class="text-danger">*</span></h2>

                <div class="newdisputemodal__bureaus">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="newdisputemodal_equifax">
                        <label class="form-check-label" for="newdisputemodal_equifax">
                            <img alt="" src="<?=base_url('/assets/img/customer/images/equifax.png');?>"/>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="newdisputemodal_experian">
                        <label class="form-check-label" for="newdisputemodal_experian">
                            <img alt="" src="<?=base_url('/assets/img/customer/images/experian.png');?>"/>
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="newdisputemodal_transunion">
                        <label class="form-check-label" for="newdisputemodal_transunion">
                            <img alt="" src="<?=base_url('/assets/img/customer/images/trans_union.png');?>"/>
                        </label>
                    </div>
                </div>

                <div class="mt-auto newdisputemodal__accnumber">
                    <div class="mb-2">Account Number (optional)</div>
                    <div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" id="newdisputemodal_samebureaus" name="newdisputemodal_accnum">
                            <label class="form-check-label" for="newdisputemodal_samebureaus">
                                Same for all bureaus
                            </label>
                        </div>
                        <div class="form-check mb-1">
                            <input class="form-check-input" type="radio" id="newdisputemodal_diffbureaus" name="newdisputemodal_accnum">
                            <label class="form-check-label" for="newdisputemodal_diffbureaus">
                                Different for each bureau
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="newdisputemodal__selects">
                    <div class="form-group">
                        <label for="newdisputemodal_creditor">Creditor/Furnisher</label>
                        <select class="form-control" id="newdisputemodal_creditor">
                            <option>Select a Creditor/Furnisher</option>
                        </select>
                        <a href="" class="link">Add Creditor/Furnisher</a>
                    </div>

                    <div class="form-group">
                        <label for="newdisputemodal_reason">Reason <span class="text-danger">*</span></label>
                        <select class="form-control" id="newdisputemodal_reason">
                            <option>Select a reason for your dispute</option>
                        </select>
                        <a href="" class="link">Manage Reasons</a>
                    </div>

                    <div class="form-group">
                        <label for="newdisputemodal_instruction">Instruction</label>
                        <select class="form-control" id="newdisputemodal_instruction">
                            <option>Choose instructions</option>
                        </select>
                        <a href="" class="link">Add a New Instruction</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
        </button>

        <button type="button" class="btn btn-primary esigneditor__btn">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Save
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="additemmodal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Saved/Pending Items</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
            These are the negative items from your client's credit report. To see a list of all credit items and status, view the <a class="link" href="">dispute items tab</a> on the My Clients page.
        </p>

        <p>
            Select the item(s) to include in your letter. On the next page you can choose which bureaus to include.
        </p>

        <div class="table-wraper">
            <table class="mt-4 table" id="customerdisputestable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" class="table__checkbox table__checkbox--primary"/>
                        </th>
                        <th>Creditor/Furnisher</th>
                        <th class="accountnum">Account #</th>
                        <th>Reason</th>
                        <th>Disputed</th>
                        <th>
                            <img alt="" src="<?=base_url('/assets/img/customer/images/equifax.png');?>"/>
                        </th>
                        <th>
                            <img alt="" src="<?=base_url('/assets/img/customer/images/experian.png');?>"/>
                        </th>
                        <th>
                            <img alt="" src="<?=base_url('/assets/img/customer/images/trans_union.png');?>"/>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Cancel
        </button>
        <button type="button" class="btn btn-primary" data-action="on_add_to_dispute">
            Add to Dispute
        </button>
      </div>
    </div>
  </div>
</div>

<?php include viewPath('includes/footer');?>