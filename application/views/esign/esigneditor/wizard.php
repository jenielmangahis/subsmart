<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<style>
/* https://github.com/select2/select2/issues/4939#issuecomment-306176634 */
html,
body {
  height: 100%;
}
.footer {
    display: none;
}
</style>

<div class="wrapper wrapper--loading" role="wrapper">
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

        <form class="mt-3 wizardForm" id="selectLetterForm">
            <div class="wizardForm__step1">
                <div class="form-group">
                    <label for="category">Letter Category</label>
                    <select class="form-control" id="category" data-name="category_id"></select>
                </div>

                <div class="form-group">
                    <label for="letter">Letter Name</label>
                    <select class="form-control" id="letter" data-name="letter_id"></select>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary esigneditor__btn" type="button">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Next
                    </button>
                </div>
            </div>

            <div class="wizardForm__step2">
                <div class="form-group">
                    <textarea class="form-control" id="letterContent"></textarea>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <button class="link mr-3" data-action="back">
                            Back
                        </button>

                        <button class="link esigneditor__btn" data-action="export">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Export as PDF
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-secondary" data-action="save_for_later" type="button">
                            Save For Later
                        </button>

                        <button class="btn btn-primary" data-action="save_and_print" type="button">
                            Save & Continue To Print
                        </button>
                    </div>
                </div>

                <fieldset class="mt-3">
                    <legend class="d-flex justify-content-between align-items-center">
                        <h2>Customer Placeholders</h2>
                        <a class="link" href="#" data-toggle="modal" data-target="#manageCustomFieldsModal">
                            Manage Customer Custom Field
                        </a>
                    </legend>
                    <ul class="placeholders__list mb-3"></ul>
                </fieldset>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="saveLetterModal" tabindex="-1" role="dialog">
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

<div class="modal fade" id="manageCustomFieldsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Manage Custom Fields</h5>
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


<?php include viewPath('includes/footer');?>