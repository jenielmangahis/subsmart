<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

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
            <h1>eSign Editor Letters</h1>
            <div class="alert alert-warning" role="alert">
                <p>These letter templates with parameters are used by the Dispute Wizard. Never type customer information directly into these templates. Modifying templates may prevent them from functioning.</p>
            </div>

            <div class="esignEditorLetters">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex">
                        <select class="form-control" id="category">
                            <option value="-1" selected>All Categories</option>
                        </select>
                        <select class="form-control" id="status">
                            <option value="-1" selected>All Statuses</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <a class="btn btn-primary" href="<?=base_url()?>EsignEditor/create">
                        <i class="fa fa-plus mr-1"></i>
                        Create Letter
                    </a>
                </div>
                <table id="letters" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Letter Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Favorite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="previewLetterModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="preview"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">
            Close
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="customersModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
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

<div class="modal fade" id="sendLetterModal" tabindex="-1" role="dialog" data-step-active="email">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
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

<?php include viewPath('includes/footer');?>