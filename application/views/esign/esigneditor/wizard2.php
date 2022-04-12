<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<div class="wrapper wrapper--loading" role="wrapper" id="wizard">
    <div class="esigneditor__loader">
        <div class="esigneditor__loaderInner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </div>
    </div>

    <div class="container mt-4">
        <div>
            <h1 class="esigneditor__title">Letter Wizard (<span></span>)</h1>
        </div>

        <p class="letterInfo">This is where you select items to dispute so you can build your letter. All new clients start with a Round 1 Dispute. Next "Add New Items" manually or "Add Saved/Pending Items".</p>

        <form class="mt-3 wizardForm">
            <div class="part1">
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
                                <label for="chooseLetter_category">Letter Category</label>
                                <select class="form-control" id="chooseLetter_category" data-name="category_id" data-letter="#chooseLetter_letter"></select>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="chooseLetter_letter">Letter Name</label>
                                    <a href="<?=base_url('EsignEditor/create');?>" class="link">Create Letter</a>
                                </div>
                                <select class="form-control" id="chooseLetter_letter" data-name="letter_id"></select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="link mr-4" type="button" data-action="on_no_dispute_back">Back</button>
                                <button class="btn btn-primary esigneditor__btn" type="button" data-action="on_no_dispute_next">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="step__letterRecipient d-none" style="display: none !important;">
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
                            <button class="btn btn-primary esigneditor__btn" type="button" data-action="step2_generate_letter">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Next: Generate Letter
                            </button>
                            <button class="btn btn-primary" type="button" data-action="step2_save_and_continue">
                                Next: Choose Letter
                            </button>
                        </div>
                    </div>
                </div>

                <div class="step step-3 step--disabled mt-3 d-none">
                    <h2 class="step__title">Step 3: <span>Choose A Letter</span></h2>

                    <div class="mt-5">
                        <div class="wizardForm__step1">
                            <div class="form-group">
                                <label for="step3_category">Letter Category</label>
                                <select class="form-control" id="step3_category" data-name="category_id" data-letter="#step3_letter"></select>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="step3_letter">Letter Name</label>
                                    <a href="<?=base_url('EsignEditor/create');?>" class="link">Create Letter</a>
                                </div>
                                <select class="form-control" id="step3_letter" data-name="letter_id"></select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary esigneditor__btn" type="button" data-action="step3_generate_letter">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Next: Generate Letter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-none part2">
                <div class="disputetab">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="part2equifaxtab" data-bureau="equifax" data-toggle="tab" href="#part2equifaxtabpane" role="tab" aria-controls="part2equifaxtabpane" aria-selected="true">
                                <img alt="" src="<?=base_url('/assets/img/customer/images/equifax.png');?>"/>
                            </a>
                            <a class="nav-item nav-link" id="part2experiantab" data-bureau="experian" data-toggle="tab" href="#part2experiantabpane" role="tab" aria-controls="part2experiantabpane" aria-selected="false">
                                <img alt="" src="<?=base_url('/assets/img/customer/images/experian.png');?>"/>
                            </a>
                            <a class="nav-item nav-link" id="part2transuniontab" data-bureau="trans_union" data-toggle="tab" href="#part2transuniontabpane" role="tab" aria-controls="part2transuniontabpane" aria-selected="false">
                                <img alt="" src="<?=base_url('/assets/img/customer/images/trans_union.png');?>"/>
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="part2equifaxtabpane" role="tabpanel" aria-labelledby="part2equifaxtab"></div>
                        <div class="tab-pane" id="part2experiantabpane" role="tabpanel" aria-labelledby="part2experiantab"></div>
                        <div class="tab-pane" id="part2transuniontabpane" role="tabpanel" aria-labelledby="part2transuniontab"></div>

                        <template>
                            <div class="row">
                                <div class="col">
                                    <div>Send From Address:</div>
                                    <strong data-detail="customer"></strong>
                                </div>
                                <div class="col">
                                    <div>Send To Address:</div>
                                    <strong data-detail="bureau"></strong>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="letterContent"></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <button class="link mr-3" type="button" data-action="on_back_to_part1">
                            Back
                        </button>

                        <button class="link esigneditor__btn" type="button" data-action="on_export_pdf">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Export as PDF
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-secondary" type="button" data-action="save_for_later">
                            Save For Later
                        </button>

                        <button class="btn btn-primary" type="button" data-action="save_and_print">
                            Save & Continue To Print
                        </button>
                    </div>
                </div>

                <fieldset class="mt-3">
                    <legend class="d-flex justify-content-between align-items-center">
                        <h2>Customer Placeholders</h2>
                        <a class="link" href="#" data-toggle="modal" data-target="#manageCustomFieldsModal">
                            Manage Customer Custom Fields
                        </a>
                    </legend>
                    <ul class="placeholders__list mb-3"></ul>
                </fieldset>
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

                <div class="newdisputemodal__accnumber">
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
                        <select class="form-control" id="newdisputemodal_creditor"></select>
                        <a href="javascript:void(0);" class="link" data-action="show_creditor_modal">Add Creditor/Furnisher</a>
                    </div>

                    <div class="form-group">
                        <label for="newdisputemodal_reason">Reason <span class="text-danger">*</span></label>
                        <select class="form-control" id="newdisputemodal_reason"></select>
                        <a href="javascript:void(0);" class="link" data-action="show_manage_reasons_modal">Manage Reasons</a>
                    </div>

                    <div class="instructions">
                        <div class="form-group selectgroup">
                            <label for="newdisputemodal_instruction">Instruction</label>
                            <select class="form-control" id="newdisputemodal_instruction"></select>
                            <a href="javascript:void(0);" class="link" data-action="toggle_instructions">Add a New Instruction</a>
                        </div>

                        <div class="form-group inputgroup">
                            <label for="newdisputemodal_instruction_input">Instruction</label>
                            <input class="form-control" id="newdisputemodal_instruction_input">
                            <a href="javascript:void(0);" class="link" data-action="toggle_instructions">Choose from list</a>

                            <span class="d-block text-muted mt-2">(i.e: "This is not my account. Please remove")</span>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="newdisputemodal_instruction_save_explanation">
                                <label class="form-check-label" for="newdisputemodal_instruction_save_explanation">
                                    Save "explanation" for future use
                                </label>
                            </div>
                        </div>
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

<div class="modal fade" tabindex="-1" role="dialog" id="manageCustomFieldsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer Custom Fields</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <template>
                <div class="customerCustomField">
                    <div class="form-group">
                        <label>Name</label>
                        <input data-key="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input data-key="value" class="form-control" placeholder="Enter value">
                    </div>
                    <button class="btn btn-sm btn-primary" type="button">
                        <span class="fa fa-trash-o"></span>
                    </button>
                </div>
            </template>

            <div class="fields"></div>
            <div class="mt-3">
                <button class="link mr-3">+ Add field</button>
                <a class="link" data-base-url="<?=base_url('customer/add_advance')?>" href="#" target="_blank">
                    View advance customer
                </a>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary esigneditor__btn" data-action="submit">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Save
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="saveLetterModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Save Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <label>Name of this letter</label>
                <input data-name="name" class="form-control">
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary esigneditor__btn">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Save Letter
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="addCreditorModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a href="javascript:void(0);" class="link" data-action="back_to_add_dispute_modal">< Back to Add New Dispute Item</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="modal-title mb-3">Add Creditor/Furnisher</h5>

        <div class="info">
            <i class="fa fa-info-circle info__logo"></i>
            <p class="info__msg">Creditors/Furnishers may have multiple addresses. Always double check that the company’s mailing address is correct for your client’s account.</p>
        </div>

        <form class="pt-3 pb-3">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="addCreditorModal__company_name">Company name <span class="text-danger">*</span></label>
                        <input class="form-control" id="addCreditorModal__company_name" data-type="name" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group optional">
                        <label for="addCreditorModal__address">Address</label>
                        <input class="form-control" id="addCreditorModal__address" data-type="address">
                    </div>
                </div>
            </div>

            <div class="optional">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="addCreditorModal__company_name">City</label>
                            <input class="form-control" id="addCreditorModal__city" data-type="city">
                        </div>
                        <div class="d-flex">
                            <div class="form-group mr-2 w-100">
                                <label for="addCreditorModal__phone">Phone</label>
                                <input type="number" class="form-control" id="addCreditorModal__phone" data-type="phone">
                            </div>
                            <div class="form-group">
                                <label for="addCreditorModal__phone_ext">&nbsp;</label>
                                <input class="form-control text-muted" id="addCreditorModal__phone_ext" placeholder="Ext." data-type="ext">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <div class="form-group mr-2 w-100">
                                <label for="addCreditorModal__state">State</label>
                                <select class="form-control" id="addCreditorModal__state" data-type="state">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="addCreditorModal__zip">Zip Code</label>
                                <input class="form-control" id="addCreditorModal__zip" data-type="zip_code">
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="addCreditorModal__acc_type">Account type</label>
                            <input class="form-control" id="addCreditorModal__acc_type" data-type="account_type">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="addCreditorModal__notes">Notes</label>
                            <input class="form-control" id="addCreditorModal__notes" data-type="note">
                        </div>
                    </div>
                </div>
            </div>

            <a href="javascript:void(0);" class="link" data-action="toggle_add_creaditor_modal_optional_inputs">
                +More Details (optional)
            </a>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-action="back_to_add_dispute_modal">
            Cancel
        </button>
        <button type="button" class="btn btn-primary" data-action="save_creditor">
            Save
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="manageReasonModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <a href="javascript:void(0);" class="link" data-action="back_to_add_dispute_modal">< Back to Add New Dispute Item</a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="modal-title mb-3">Manage Reason</h5>

        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary mb-3" data-action="add_new_reasons">
                + Add New Reasons
            </button>
        </div>

        <template>
            <tr>
                <td data-detail="name"></td>
                <td class="text-right actions">
                    <span class="lock" data-detail="locked">
                        <i class="fa fa-lock"></i>
                    </span>
                    <div class="d-inline-flex align-items-center" data-detail="actions">
                        <button class="btn-action mr-2" data-action="edit">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button class="btn-action" data-action="delete">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </template>

        <div class="tableWrapper">
            <table class="table" id="reasonsTable">
                <thead>
                    <tr>
                        <th>Reasons</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="form">
                        <td>
                            <input class="form-control" data-type="reason">
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary mr-2" data-action="save_reason">
                                    Save
                                </button>
                                <button class="btn btn-secondary" data-action="hide_reason_form">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include viewPath('includes/footer');?>