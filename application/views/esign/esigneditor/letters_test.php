<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('v2/includes/header');
ini_set('max_input_vars', 30000);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="<?=base_url("assets/css/esign/esign-editor/esign-editor.css")?>">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

<div class="wrapper wrapper--loading" role="wrapper">
    <div class="esigneditor__loader">
        <div class="esigneditor__loaderInner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </div>
    </div>

    <div class="nsm-content">
        <div class="page-content">
            <div class="nsm-callout primary" role="alert">
              <button><i class="bx bx-x"></i></button>
              <p>These letter templates with parameters are used by the Dispute Wizard. Never type customer information directly into these templates. Modifying templates may prevent them from functioning.</p>
            </div>

            <div class="esignEditorLetters">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex">
                        <select class="form-control form-select" id="category">
                            <option value="-1" selected>All Categories</option>
                        </select>
                        <select class="form-control form-select" id="status">
                            <option value="-1" selected>All Statuses</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <a class="nsm-button primary" href="<?=base_url()?>EsignEditor/create">
                        <i class="fa fa-plus mr-1"></i>
                        Create Letter
                    </a>
                </div>
                <table id="letters" class="nsm-table">
                    <thead>
                        <tr>
                            <th>Letter Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Favorite</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="previewLetterModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Letter</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
          <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="preview"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="nsm-button " data-bs-dismiss="modal">
            Close
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade nsm-modal" id="customersModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Customer</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
          <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="customers"></div>

        <template>
          <div class="customer">
            <img class="customer__img" />
            <div>
              <div class="customer__name"></div>
              <div class="customer__email"></div>
            </div>
          </div>
        </template>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary esigneditor__btn">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Next
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade nsm-modal" id="sendLetterModal" tabindex="-1" role="dialog" data-step-active="email">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Letter</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
          <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
          <div class="alert alert-danger d-none" role="alert">
              Something went wrong sending this email.
          </div>
          <form>
              <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input class="form-control" data-type="subject">
              </div>
              <div class="mb-3">
                  <label class="form-label">Recipient</label>
                  <input type="email" class="form-control" data-type="email">
              </div>
              <div class="mb-3">
                  <label class="form-label">Message</label>
                  <textarea class="form-control" rows="3" data-type="message"></textarea>
              </div>
              <div class="preview"></div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary esigneditor__btn" data-action="email">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Send Email
        </button>
      </div>
    </div>
  </div>
</div>

<style>
  .link {
    text-decoration:none;
    color:#6a4a86;
  }
  #letters_filter .icon{
    z-index: 900;
    margin-top:-12px;
  }
  #letters_filter [type="search"]{
    margin-bottom:12px;
  }
</style>

<script src="https://localhost/nsmartrac/assets/js/v2/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<?php include viewPath('includes/footer');?>